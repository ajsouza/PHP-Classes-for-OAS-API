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
	
	public function findIDXML(){
		$xml = '<AdXML><Request type="Advertiser"><Database action="read"><Advertiser>';
		$xml .= $this->adxml();
		$xml .= '</Advertiser></Database></Request></AdXML>';
		
		return $xml;
	}
	
	public function searchXML(){
		$xml = '<AdXML><Request type="Advertiser"><Database action="list"><SearchCriteria>';
		$xml .= $this->adxml();
		$xml .= '</SearchCriteria></Database></Request></AdXML>';
		
		return $xml;
	}
	
	public function map($xml){		
		$this->Id = $xml->getElementsByTagName('Id')->item(0)->nodeValue;
		$this->Organization = $xml->getElementsByTagName('Organization')->item(0)->nodeValue;
		$this->Notes = $xml->getElementsByTagName('Notes')->item(0)->nodeValue;
		$this->ContactFirstName = $xml->getElementsByTagName('ContactFirstName')->item(0)->nodeValue;
		$this->ContactLastName = $xml->getElementsByTagName('ContactLastName')->item(0)->nodeValue;
		$this->ContactTitle = $xml->getElementsByTagName('ContactTitle')->item(0)->nodeValue;
		$this->Email = $xml->getElementsByTagName('Email')->item(0)->nodeValue;
		$this->Phone = $xml->getElementsByTagName('Phone')->item(0)->nodeValue;
		$this->Fax = $xml->getElementsByTagName('Fax')->item(0)->nodeValue;
		$this->UserId = null;
		$this->BillingMethod = null;
		$this->Address = null;
		$this->City = null;
		$this->State = null;
		$this->Country = null;
		$this->Zip = null;
		$this->BillingEmail = null;
		$this->InternalQuickReport = null;
		$this->ExternalQuickReport = null;
		
		$this->WhoCreated = $xml->getElementsByTagName('WhoCreated')->item(0)->nodeValue;
		$this->WhenCreated = $xml->getElementsByTagName('WhenCreated')->item(0)->nodeValue;
		$this->WhoModified = $xml->getElementsByTagName('WhoModified')->item(0)->nodeValue;
		$this->WhenModified = $xml->getElementsByTagName('WhenModified')->item(0)->nodeValue;
	}
}
?>