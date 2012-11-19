<?php
include_once "baseclass.oas.php";

class product extends OASEntity {
	public $Id = null;
	public $Name = null;
	public $Notes = null;
	
	public $main_id = "Id";
	public $main_tag = "Product";
	
	public function entity_def() {
	  $inst = array(
		  "Id" => &$this->Id,
		  "Name" => &$this->Name,
		  "Notes" => &$this->Notes
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){

	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Name = $this->return_xml_value($xml, $i, "Name");
		$inst->Notes = $this->return_xml_value($xml, $i, "Notes");
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>