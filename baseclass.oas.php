<?php
/*
	 PHP LIB SPECIAL SETTINGS
	 ========================
	 VERBOSE_MODE   - Output each ADXML Request & Response
	 DEBUGGER			  - Generate Error Logs (WORK IN PROGRESS)
	 STD_LOG_FORMAT - Date/Time format for logs
*/
define("VERBOSE_MODE", false);
define("DEBUGGER", false);
define("STD_LOG_FORMAT", "j-m-y H:i:s");

class OASWebService{
  public $user = null;
  public $pass = null;
  public $account = null;
  
  private $wsdl;

  function __construct($url){
     $this->wsdl = $url;
  }

  public function request($adxml){
  	if ( VERBOSE_MODE )
  		$this->verbose_output("ADXML REQUEST", $adxml);

		$client = new SoapClient($this->wsdl, array( 'connection_timeout' => 120, 'max_execution_time' => 120));
		$message = DOMDocument::loadXML($client->OASXmlRequest($this->account, $this->user, $this->pass, $adxml));

  	if ( VERBOSE_MODE )
  		$this->verbose_output("ADXML RESPONSE", $message->saveXML());

		$rtmsg = $message->getElementsByTagName('Exception');
		
		if($rtmsg->length != 0){
			return $rtmsg->item(0)->nodeValue;
		} else {
			return true;
		}
  }

  public function requestXML($adxml){
  	if ( VERBOSE_MODE )
  		$this->verbose_output("ADXML REQUEST", $adxml);

		$client = new SoapClient($this->wsdl, array( 'connection_timeout' => 120, 'max_execution_time' => 120));
		$message = DOMDocument::loadXML($client->OASXmlRequest($this->account, $this->user, $this->pass, $adxml));

  	if ( VERBOSE_MODE )
  		$this->verbose_output("ADXML RESPONSE", $message->saveXML());

		return $message;
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

  private function verbose_output($msgtype, $message){
  	echo "[== ".date(STD_LOG_FORMAT)." - $msgtype ==]\n";
  	echo "$message\n\n";
  }
}

abstract class OASEntity{
	public $entity = array();
	public $instances = array();
	
	public $WhoCreated = null;
	public $WhenCreated = null;
	public $WhoModified = null;
	public $WhenModified = null;
	
	abstract public function entity_def();
	abstract public function clean_instance(&$inst);
	abstract public function map($xml, &$inst, $i);
	
	abstract public function validate();

	public function create(){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><Database action="add"><'.$this->main_tag.'>';
		$xml .= $this->adxml();
		$xml .= '</'.$this->main_tag.'></Database></Request></AdXML>';
		
		return $xml;
	}
	
	public function update(){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><Database action="update"><'.$this->main_tag.'>';
		$xml .= $this->adxml();
		$xml .= '</'.$this->main_tag.'></Database></Request></AdXML>';
		
		return $xml;
	}
	
	public function find($Id){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><Database action="read"><'.$this->main_tag.'>';
		$xml .= '<Id>' . $Id . '</Id>';
		$xml .= '</'.$this->main_tag.'></Database></Request></AdXML>';
			
		return $xml;
	}
	
	public function search(){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><Database action="list"><SearchCriteria>';
		$xml .= $this->adxml();
		$xml .= '</SearchCriteria></Database></Request></AdXML>';
		
		return $xml;
	}

	public function adxml() {
	  $this->entity = $this->entity_def();
	  
	  $this->compact_xml_array($this->entity);
	  
	  // Customized Cleaning Rules
	  $this->clean_instance($this->entity);
	  
	  return $this->build_xml($this->entity);
	}
	
	protected function build_xml(&$inst){
	  $xml = null;
	  
	  foreach($inst as $key=>$val){
			if( (substr($key, 0, 4) != "@arr") ) {
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

		// echo $xml->saveXML(); // USE FOR DEBUG
		$nodes = $xml->getElementsByTagName($this->main_tag);
		$nodeListLength = $nodes->length;
		for ($i = 0; $i < $nodeListLength; $i ++)
		{
			$classname = strtolower($this->main_tag);
			$tmp = new $classname();
			$tmp->map($xml, $tmp, $i);
			$this->instances[] = $tmp;
		}
	}
	
	protected function compact_xml_array(&$inst){
		$this->prune_empty_vals($inst);
		$this->prune_empty_arrs($inst);
	}
	
	protected function prune_empty_vals(&$inst){
	  foreach( $inst as $key=>&$val ) {
		if( !is_array($val) && is_null($val) )
		  unset($inst[$key]);
		
		if( is_array($val) )
		  $this->prune_empty_vals($val);
	  }
	}
	
	protected function prune_empty_arrs(&$inst){
	  foreach( $inst as $key=>&$val ) {
		if( is_array($val) && count($val) == 0 )
		  unset($inst[$key]);
		
		if( is_array($val) )
		  $this->prune_empty_arrs($val);
	  }
	}
	
	public function return_xml_value($xml, $i, $tag, $isChild = false, $return_array = false){
	  if ( !$isChild ) {
	  	return $xml->getElementsByTagName($tag)->item($i)->nodeValue;
	  } else {
	  	$rtnVal = array();

	  	foreach ($isChild as $level) {
	  		$nodes = $xml->getElementsByTagName($level)->item($i);
	  	}

	  	foreach ($nodes->getElementsByTagName($tag) as $node) {
	  		$rtnVal[] = $node->nodeValue;
	  	}

	  	if ( $return_array )
	  		return $rtnVal;
	  	else
	  		if ( count($rtnVal) == 0 )
	  			return $rtnVal;
	  		else 
	  			return $rtnVal[0];
	  }
	}
}

?>