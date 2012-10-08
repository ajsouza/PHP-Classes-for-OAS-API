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
	
	public $main_id = "Id";
	public $main_tag = "Advertiser";
	
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
	
	public function find($Id){
		$xml = '<AdXML><Request type="Advertiser"><Database action="read"><Advertiser>';
		$xml .= '<Id>' . $Id . '</Id>';
		$xml .= '</Advertiser></Database></Request></AdXML>';
			
		return $xml;
	}
	
	public function search(){
		$xml = '<AdXML><Request type="Advertiser"><Database action="list"><SearchCriteria>';
		$xml .= $this->adxml();
		$xml .= '</SearchCriteria></Database></Request></AdXML>';
		
		return $xml;
	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Organization = $this->return_xml_value($xml, $i, "Organization");
		$inst->Notes = $this->return_xml_value($xml, $i, "Notes");
		$inst->ContactFirstName = $this->return_xml_value($xml, $i, "ContactFirstName");
		$inst->ContactLastName = $this->return_xml_value($xml, $i, "ContactLastName");
		$inst->ContactTitle = $this->return_xml_value($xml, $i, "ContactTitle");
		$inst->Email = $this->return_xml_value($xml, $i, "Email");
		$inst->Phone = $this->return_xml_value($xml, $i, "Phone");
		$inst->Fax = $this->return_xml_value($xml, $i, "Fax");
		$inst->UserId = null;
		$inst->BillingMethod = null;
		$inst->Address = null;
		$inst->City = null;
		$inst->State = null;
		$inst->Country = null;
		$inst->Zip = null;
		$inst->BillingEmail = null;
		$inst->InternalQuickReport = $this->return_xml_value($xml, $i, "InternalQuickReport");
		$inst->ExternalQuickReport = $this->return_xml_value($xml, $i, "ExternalQuickReport");
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>