<?php
class OASWebService{
  public $user = null;
  public $pass = null;
  public $account = null;
  
  private $wsdl;

  function __construct($url){
     $this->wsdl = $url;
  }

  public function request($adxml){
	$client = new SoapClient($this->wsdl, array( 'connection_timeout' => 120, 'max_execution_time' => 120));
	$message = DOMDocument::loadXML($client->OASXmlRequest($this->account, $this->user, $this->pass, $adxml));
	$rtmsg = $message->getElementsByTagName('Exception');
	
	if($rtmsg->length != 0){
		return $rtmsg->item(0)->nodeValue;
	} else {
		return true;
	}
  }

  public function requestXML($adxml){
	$client = new SoapClient($this->wsdl, array( 'connection_timeout' => 120, 'max_execution_time' => 120));
	return DOMDocument::loadXML($client->OASXmlRequest($this->account, $this->user, $this->pass, $adxml));
  }
  
  public function create($oasentity){
	return $this->request($oasentity->create());
  }
  public function update($oasentity){
	return $this->request($oasentity->update());
  }
  public function find($oasentity){
	$oasentity->map($this->requestXML($oasentity->find($oasentity->Id)), $oasentity, 0);
  }
  public function search($oasentity){
	$oasentity->build_search_results($this->requestXML($oasentity->search()), $this);
  }
}

abstract class OASEntity{
	public $entity = array();
	public $instances = array();
	
	public $WhoCreated = null;
	public $WhenCreated = null;
	public $WhoModified = null;
	public $WhenModified = null;

	abstract public function create();
	abstract public function update();
	abstract public function search();
	abstract public function find($Id);
	
	abstract public function entity_def();
	abstract public function clean_instance(&$inst);
	abstract public function map($xml, &$inst, $i);
	
	public function adxml() {
	  $this->entity = $this->entity_def();
	  
	  $this->compact_xml_array($this->entity);
	  
	  // Customized Cleaning Rules
	  $this->clean_instance($this->entity);
	  
	  return $this->build_xml($this->entity);
	}
	
	private function build_xml(&$inst){
	  $xml = null;
	  
	  foreach($inst as $key=>$val){
		if( (substr($key, 0, 4) != "@arr") ) 
		{
			$KExists = array_key_exists("@arr" . $key, $inst);
			
			if(!$KExists)
			  $xml .= "<" . $key . ">";
			
			if( is_array($val) ) {
			  if( $KExists ) {
				foreach($val as $k=>$v)
				  $xml .= "<" . $key . ">" . $v . "</" . $key . ">";
			  } else {
			    $xml .= $this->build_xml($val); }
			} else {
				if( $KExists ) {
					$expl = explode(";", $val);
					foreach($expl as $v)
					  $xml .= "<" . $key . ">" . trim($v) . "</" . $key . ">";
				} else {
				  $xml .= $val; }
			  }
			if(!$KExists)
			  $xml .= "</" . $key . ">";
		}
	  }
	  
	  return $xml;
	}
	
	public function build_search_results($xml, $websvc){
	    $nodeList = $xml->getElementsByTagName($this->main_id);
		$tmpxml = null;
		
		foreach( $nodeList as $node ) {
			$tmpxml .= $this->find($node->nodeValue);
			$tmpxml = str_replace("<AdXML>", "", $tmpxml);
			$tmpxml = str_replace("</AdXML>", "", $tmpxml);
		}
			
		$tmpxml = "<AdXML>" . $tmpxml . "</AdXML>";
		$xml = $websvc->requestXML($tmpxml);
		echo $xml->saveXML();
		$nodes = $xml->getElementsByTagName($this->main_tag);
		$nodeListLength = $nodes->length;
		for ($i = 0; $i < $nodeListLength; $i ++)
		{
			$tmp = new Advertiser();
			$tmp->map($xml, $tmp, $i);
			$this->instances[] = $tmp;
		}
	}
	
	private function compact_xml_array(&$inst){
		$this->prune_empty_vals($inst);
		$this->prune_empty_arrs($inst);
	}
	
	private function prune_empty_vals(&$inst){
	  foreach( $inst as $key=>&$val ) {
		if( !is_array($val) && is_null($val) )
		  unset($inst[$key]);
		
		if( is_array($val) )
		  $this->prune_empty_vals($val);
	  }
	}
	
	private function prune_empty_arrs(&$inst){
	  foreach( $inst as $key=>&$val ) {
		if( is_array($val) && count($val) == 0 )
		  unset($inst[$key]);
		
		if( is_array($val) )
		  $this->prune_empty_arrs($val);
	  }
	}
	
	public function return_xml_value($xml, $i, $tag){
	  return $xml->getElementsByTagName($tag)->item($i)->nodeValue;
	}
}

?>