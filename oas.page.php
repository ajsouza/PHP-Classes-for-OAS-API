<?php
include_once "baseclass.oas.php";

class page extends OASEntity {
	public $Url = null;
	public $Description = null;
	public $Sections = null;
	public $LocationKey = null;
	public $Site = null;
	public $SiteId = null;
	public $Domain = null;
	
	public $main_id = "Url";
	public $main_tag = "Page";
	
	public function entity_def() {
	  $inst = array(
		  "Url" => &$this->Url,
		  "Domain" => &$this->Domain,
		  "Description" => &$this->Description,
		  "LocationKey" => &$this->LocationKey,
			"Sections" => array(
			  "SectionId" => &$this->Sections,
				"@arrSectionId" => true
			)
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){
	  if( count($inst['Sections']) == 1 )
	    unset($inst['Sections']);
	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->LocationKey = $this->return_xml_value($xml, $i, "LocationKey");
		$inst->Url = $this->return_xml_value($xml, $i, "Url");
		$inst->Site = $this->return_xml_value($xml, $i, "Site");
		$inst->SiteId = $this->return_xml_value($xml, $i, "SiteId");
		$inst->Description = $this->return_xml_value($xml, $i, "Description");
		$inst->Sections = $this->return_xml_value($xml, $i, "SectionId", array( "Sections" ), true );
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>