<?php
include_once "oas.baseclass.php";

class advertiser extends OASEntity {
	public $Id = null;
	public $Description = null;
	public $Notes = null;
	public $UserId = null;
	public $InternalQuickReport = null;
	public $ExternalQuickReport = null;
	
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

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Description = $this->return_xml_value($xml, $i, "Description");
		$inst->Notes = $this->return_xml_value($xml, $i, "Notes");
		$inst->UserId = $this->return_xml_value($xml, $i, "UserId", array( "ExternalUsers" ), true );
		$inst->InternalQuickReport = $this->return_xml_value($xml, $i, "InternalQuickReport");
		$inst->ExternalQuickReport = $this->return_xml_value($xml, $i, "ExternalQuickReport");
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>