<?php
include "oas.baseclass.php";

class Advertiser extends OASEntity {
	public $Id = null;
	public $Organization = null;
	public $Notes = null;
	public $ContactFirstName = null;
	public $ContactLastName = null;
	public $ContactTitle = null;
	public $Email = null;
	public $Phone = null;
	public $Fax = null;
	public $UserId = null;
	public $BillingMethod = null;
	public $Address = null;
	public $City = null;
	public $State = null;
	public $Country = null;
	public $Zip = null;
	public $BillingEmail = null;
	public $InternalQuickReport = null;
	public $ExternalQuickReport = null;
	
	public function entity_def() {
	  $inst = array(
		  "Id" => &$this->Id,
		  "Organization" => &$this->Organization,
		  "Notes" => &$this->Notes,
		  "ContactFirstName" => &$this->ContactFirstName,
		  "ContactLastName" => &$this->ContactLastName,
		  "ContactTitle" => &$this->ContactTitle,
		  "Email" => &$this->Email,
		  "Phone" => &$this->Phone,
		  "Fax" => &$this->Fax,
		  "ExternalUsers" => array(
			"UserId" => &$this->UserId,
			"@arrUserId" => true
		  ),
		  "BillingInformation" => array(
			"Method" => array(
			  "Code" => &$this->BillingMethod
			),
			"Address" => &$this->Address,
			"City" => &$this->City,
			"State" => &$this->State,
			"Country" => array(
			  "Code" => &$this->Country
			),
			"Zip" => &$this->Zip,
			"Email" => &$this->BillingEmail
		  ),
		  "InternalQuickReport" => &$this->InternalQuickReport,
		  "ExternalQuickReport" => &$this->ExternalQuickReport
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){
	  if( count($inst['BillingInformation']) == 0 )
	    unset($inst['BillingInformation']);
	
	  if( count($inst['ExternalUsers']) == 1 )
	    unset($inst['ExternalUsers']);
	}
	
	public function create(){
		$xml = '<AdXML><Request type="Advertiser"><Database action="add"><Advertiser>';
		$xml .= $this->adxml();
		$xml .= '</Advertiser></Database></Request></AdXML>';
		
		return $xml;
	}
	
	public function update(){
		$xml = '<AdXML><Request type="Advertiser"><Database action="update"><Advertiser>';
		$xml .= $this->adxml();
		$xml .= '</Advertiser></Database></Request></AdXML>';
		
		return $xml;
	}
	
	public function find($Id, $headless = false){
		if($headless) {
			$xml = '<Request type="Advertiser"><Database action="read"><Advertiser>';
			$xml .= '<Id>' . $Id . '</Id>';
			$xml .= '</Advertiser></Database></Request>';
		} else {
			$xml = '<AdXML><Request type="Advertiser"><Database action="read"><Advertiser>';
			$xml .= '<Id>' . $Id . '</Id>';
			$xml .= '</Advertiser></Database></Request></AdXML>';
		}
		return $xml;
	}
	
	public function search(){
		$xml = '<AdXML><Request type="Advertiser"><Database action="list"><SearchCriteria>';
		$xml .= $this->adxml();
		$xml .= '</SearchCriteria></Database></Request></AdXML>';
		
		return $xml;
	}
	
	public function build_search_results($xml, $websvc){
	    $nodeList = $xml->getElementsByTagName('Id');
		$tmpxml = null;
		
		foreach( $nodeList as $node )
			$tmpxml .= $this->find($node->nodeValue, true);
			
		$tmpxml = "<AdXML>" . $tmpxml . "</AdXML>";
		$xml = $websvc->requestXML($tmpxml);
		
		$nodes = $xml->getElementsByTagName ("Advertiser");
		$nodeListLength = $nodes->length;
		for ($i = 0; $i < $nodeListLength; $i ++)
		{
			$tmp = new Advertiser();
			$tmp->map($xml, $tmp, $i);
			$this->instances[] = $tmp;
		}
	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $xml->getElementsByTagName('Id')->item($i)->nodeValue;
		$inst->Organization = $xml->getElementsByTagName('Organization')->item($i)->nodeValue;
		$inst->Notes = $xml->getElementsByTagName('Notes')->item($i)->nodeValue;
		$inst->ContactFirstName = $xml->getElementsByTagName('ContactFirstName')->item($i)->nodeValue;
		$inst->ContactLastName = $xml->getElementsByTagName('ContactLastName')->item($i)->nodeValue;
		$inst->ContactTitle = $xml->getElementsByTagName('ContactTitle')->item($i)->nodeValue;
		$inst->Email = $xml->getElementsByTagName('Email')->item($i)->nodeValue;
		$inst->Phone = $xml->getElementsByTagName('Phone')->item($i)->nodeValue;
		$inst->Fax = $xml->getElementsByTagName('Fax')->item($i)->nodeValue;
		$inst->UserId = null;
		$inst->BillingMethod = null;
		$inst->Address = null;
		$inst->City = null;
		$inst->State = null;
		$inst->Country = null;
		$inst->Zip = null;
		$inst->BillingEmail = null;
		$inst->InternalQuickReport = null;
		$inst->ExternalQuickReport = null;
		
		$inst->WhoCreated = $xml->getElementsByTagName('WhoCreated')->item($i)->nodeValue;
		$inst->WhenCreated = $xml->getElementsByTagName('WhenCreated')->item($i)->nodeValue;
		$inst->WhoModified = $xml->getElementsByTagName('WhoModified')->item($i)->nodeValue;
		$inst->WhenModified = $xml->getElementsByTagName('WhenModified')->item($i)->nodeValue;
	}
}
?>