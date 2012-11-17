<?php
include_once "baseclass.oas.php";

class section extends OASEntity {
	public $Id = null;
	public $Pages = null;
	public $InternalQuickReport = null;
	public $ExternalQuickReport = null;
	
	public $main_id = "Id";
	public $main_tag = "Section";
	
	public function entity_def() {
	  $inst = array(
		  "Id" => &$this->Id,
			"Pages" => array(
			  "Url" => &$this->Pages,
				"@arrUrl" => true
			),
		  "InternalQuickReport" => &$this->InternalQuickReport,
		  "ExternalQuickReport" => &$this->ExternalQuickReport
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){
	  if( count($inst['Pages']) == 1 )
	    unset($inst['Pages']);
	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Pages = $this->return_xml_value($xml, $i, "Url", array( "Pages" ), true );
		$inst->InternalQuickReport = $this->return_xml_value($xml, $i, "InternalQuickReport");
		$inst->ExternalQuickReport = $this->return_xml_value($xml, $i, "ExternalQuickReport");
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>