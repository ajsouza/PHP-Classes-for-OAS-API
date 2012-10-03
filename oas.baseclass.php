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
	$message = DOMDocument::loadXML($client->OASXmlRequest($this->account, $this->user, $this->pass, $adxml));

	return $message->saveXML();
  }
  
  public function create($oasentity){
	return $this->request($oasentity->create());
  }
  public function update($oasentity){
	return $this->request($oasentity->update());
  }
  public function findexact($oasentity){
	return $this->requestXML($oasentity->findexact());
  }
  public function findall($oasentity){
	return $this->requestXML($oasentity->findall());
  }
}

abstract class OASEntity{
	public $entity = array();
	public $WhoCreated = null;
	public $WhenCreated = null;
	public $WhoModified = null;
	public $WhenModified = null;

	abstract public function create();
	abstract public function update();
	abstract public function findexact();
	abstract public function findall();
	
	abstract public function entity_def();
	abstract public function clean_instance(&$inst);
	
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
}

?>