<?php
include_once "baseclass.oas.php";

class sitegroup extends OASEntity {
	public $Id = null;
	public $Description = null;
	public $Sites = null;
	public $Notes = null;
	public $ExternalUsers = null;
	public $InternalQuickReport = null;
	public $ExternalQuickReport = null;
	
	public $main_id = "Id";
	public $main_tag = "SiteGroup";
	
	public function entity_def() {
	  $inst = array(
		  "Id" => &$this->Id,
		  "Description" => &$this->Description,
			"Sites" => array(
			  "SiteId" => &$this->Sites,
				"@arrSiteId" => true
			),
		  "Notes" => &$this->Notes,
			"ExternalUsers" => array(
			  "UserId" => &$this->ExternalUsers,
				"@arrUserId" => true
			),
		  "InternalQuickReport" => &$this->InternalQuickReport,
		  "ExternalQuickReport" => &$this->ExternalQuickReport
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){
	  if( count($inst['Sites']) == 1 )
	    unset($inst['Sites']);

	  if( count($inst['ExternalUsers']) == 1 )
	    unset($inst['ExternalUsers']);
	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Description = $this->return_xml_value($xml, $i, "Description");
		$inst->Sites = $this->return_xml_value($xml, $i, "SiteId", array( "Sites" ), true );
		$inst->Notes = $this->return_xml_value($xml, $i, "Notes");
		$inst->ExternalUsers = $this->return_xml_value($xml, $i, "UserId", array( "ExternalUsers" ), true );
		$inst->InternalQuickReport = $this->return_xml_value($xml, $i, "InternalQuickReport");
		$inst->ExternalQuickReport = $this->return_xml_value($xml, $i, "ExternalQuickReport");
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>