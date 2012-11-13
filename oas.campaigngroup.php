<?php
include_once "baseclass.oas.php";

class campaigngroup extends OASEntity {
	public $Id = null;
	public $Description = null;
	public $Notes = null;
	public $UserId = null;
	public $Campaigns = null;
	public $InternalQuickReport = "to-date";
	public $ExternalQuickReport = "short";
	
	public $main_id = "Id";
	public $main_tag = "CampaignGroup";
	
	public function entity_def() {
	  $inst = array(
		  "Id" => &$this->Id,
		  "Description" => &$this->Description,
		  "Notes" => &$this->Notes,
		  "ExternalUsers" => array(
				"UserId" => &$this->UserId,
				"@arrUserId" => true
		  ),
		  "InternalQuickReport" => &$this->InternalQuickReport,
		  "ExternalQuickReport" => &$this->ExternalQuickReport
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){
	  if( count($inst['ExternalUsers']) == 1 )
	    unset($inst['ExternalUsers']);
	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Description = $this->return_xml_value($xml, $i, "Description");
		$inst->Notes = $this->return_xml_value($xml, $i, "Notes");
		$inst->UserId = $this->return_xml_value($xml, $i, "UserId", array( "ExternalUsers" ), true );
		$inst->InternalQuickReport = $this->return_xml_value($xml, $i, "InternalQuickReport");
		$inst->ExternalQuickReport = $this->return_xml_value($xml, $i, "ExternalQuickReport");
		$inst->Campaigns = $this->return_xml_value($xml, $i, "CampaignId", array( "Campaigns" ), true );
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>