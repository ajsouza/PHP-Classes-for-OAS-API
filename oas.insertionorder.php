<?php
include_once "baseclass.oas.php";

class insertionorder extends OASEntity {
	public $Id = null;
	public $Description = null;
	public $CampaignsBy = null;
	public $AdvertiserId = null;
	public $AgencyId = null;
	public $Status = null;
	public $BookedImpressions = null;
	public $BookedClicks = null;
	public $StartDate = null;
	public $EndDate = null;
	public $SalesPerson = null;
	public $InternalPO = null;
	public $AgencyPO = null;
	public $BookedRevenue = null;
	public $ExternalUsers = null;
	public $Campaigns = null;
	public $InternalQuickReport = null;
	public $ExternalQuickReport = null;
	
	public $main_id = "Id";
	public $main_tag = "InsertionOrder";
	
	public function entity_def() {
	  $inst = array(
		  "Id" => &$this->Id,
		  "Description" => &$this->Description,
		  "CampaignsBy" => &$this->CampaignsBy,
		  "AdvertiserId" => &$this->AdvertiserId,
		  "AgencyId" => &$this->AgencyId,
		  "Status" => &$this->Status,
		  "BookedImpressions" => &$this->BookedImpressions,
		  "BookedClicks" => &$this->BookedClicks,
		  "StartDate" => &$this->StartDate,
		  "EndDate" => &$this->EndDate,
		  "SalesPerson" => &$this->SalesPerson,
		  "InternalPO" => &$this->InternalPO,
		  "AgencyPO" => &$this->AgencyPO,
		  "BookedRevenue" => &$this->BookedRevenue,
		  "ExternalUsers" => array(
				"UserId" => &$this->ExternalUsers,
				"@arrUserId" => true
		  ),
		  "Campaigns" => array(
				"CampaignId" => &$this->Campaigns,
				"@arrCampaignId" => true
		  ),
		  "InternalQuickReport" => &$this->InternalQuickReport,
		  "ExternalQuickReport" => &$this->ExternalQuickReport
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){
	  if( count($inst['ExternalUsers']) == 1 )
	    unset($inst['ExternalUsers']);

	  if( count($inst['Campaigns']) == 1 )
	    unset($inst['Campaigns']);
	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Description = $this->return_xml_value($xml, $i, "Description");
		$inst->CampaignsBy = $this->return_xml_value($xml, $i, "CampaignsBy");
		$inst->AdvertiserId = $this->return_xml_value($xml, $i, "AdvertiserId");
		$inst->AgencyId = $this->return_xml_value($xml, $i, "AgencyId");
		$inst->Status = $this->return_xml_value($xml, $i, "Status");
		$inst->BookedImpressions = $this->return_xml_value($xml, $i, "BookedImpressions");
		$inst->BookedClicks = $this->return_xml_value($xml, $i, "BookedClicks");
		$inst->StartDate = $this->return_xml_value($xml, $i, "StartDate");
		$inst->EndDate = $this->return_xml_value($xml, $i, "EndDate");
		$inst->SalesPerson = $this->return_xml_value($xml, $i, "SalesPerson");
		$inst->InternalPO = $this->return_xml_value($xml, $i, "InternalPO");
		$inst->AgencyPO = $this->return_xml_value($xml, $i, "AgencyPO");
		$inst->BookedRevenue = $this->return_xml_value($xml, $i, "BookedRevenue");
		$inst->ExternalUsers = $this->return_xml_value($xml, $i, "UserId", array( "ExternalUsers" ), true );
		$inst->Campaigns = $this->return_xml_value($xml, $i, "CampaignId", array( "Campaigns" ), true );
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}


	// OVERIDE STANDARD METHODS
	/*
		SEARCH - Different AdXML structure from Database Items
		FIND   - Different AdXML structure from Database Items
		CREATE - Different AdXML structure from Database Items
		UPDATE - Different AdXML structure from Database Items
	*/
	public function find($Id){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><'.$this->main_tag.' action="read">';
		$xml .= '<Id>' . $Id . '</Id>';
		$xml .= '</'.$this->main_tag.'></Request></AdXML>';
			
		return $xml;
	}
	
	public function search(){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><'.$this->main_tag.' action="list"><SearchCriteria>';
		$xml .= $this->adxml();
		$xml .= '</SearchCriteria></'.$this->main_tag.'></Request></AdXML>';
		
		return $xml;
	}

	public function create(){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><'.$this->main_tag.' action="add">';
		$xml .= $this->adxml();
		$xml .= '</'.$this->main_tag.'></Request></AdXML>';
		
		return $xml;
	}
	
	public function update(){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><'.$this->main_tag.' action="update">';
		$xml .= $this->adxml();
		$xml .= '</'.$this->main_tag.'></Request></AdXML>';
		
		return $xml;
	}
}
?>