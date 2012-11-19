<?php
include_once "baseclass.oas.php";

class site extends OASEntity {
	public $Id = null;
	public $Name = null;
	public $Domain = null;
	public $Notes = null;
	public $Sections = null;
	public $ExternalUsers = null;
	public $SiteGroups = null;
	public $InternalQuickReport = null;
	public $ExternalQuickReport = null;
	
	public $main_id = "Id";
	public $main_tag = "Site";
	
	public function entity_def() {
	  $inst = array(
		  "Id" => &$this->Id,
		  "Name" => &$this->Name,
		  "Domain" => &$this->Domain,
		  "Notes" => &$this->Notes,
			"Sections" => array(
			  "SectionId" => &$this->Sections,
				"@arrSectionId" => true
			),
			"ExternalUsers" => array(
			  "UserId" => &$this->ExternalUsers,
				"@arrUserId" => true
			),
			"SiteGroups" => array(
			  "SiteGroupId" => &$this->SiteGroups,
				"@arrSiteGroupId" => true
			),
		  "InternalQuickReport" => &$this->InternalQuickReport,
		  "ExternalQuickReport" => &$this->ExternalQuickReport
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){
	  if( count($inst['Sections']) == 1 )
	    unset($inst['Sections']);

	  if( count($inst['ExternalUsers']) == 1 )
	    unset($inst['ExternalUsers']);

	  if( count($inst['SiteGroups']) == 1 )
	    unset($inst['SiteGroups']);
	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Name = $this->return_xml_value($xml, $i, "Name");
		$inst->Domain = $this->return_xml_value($xml, $i, "Domain");
		$inst->Notes = $this->return_xml_value($xml, $i, "Notes");
		$inst->Sections = $this->return_xml_value($xml, $i, "SectionId", array( "Sections" ), true );
		$inst->ExternalUsers = $this->return_xml_value($xml, $i, "UserId", array( "ExternalUsers" ), true );
		$inst->SiteGroups = $this->return_xml_value($xml, $i, "SiteGroupId", array( "SiteGroups" ), true );
		$inst->InternalQuickReport = $this->return_xml_value($xml, $i, "InternalQuickReport");
		$inst->ExternalQuickReport = $this->return_xml_value($xml, $i, "ExternalQuickReport");
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>