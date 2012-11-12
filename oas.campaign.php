<?php
include_once "baseclass.oas.php";

class agency extends OASEntity {
	// Overview
	public $Id = null;
	public $AdvertiserId = "unknown_advertiser";
	public $Name = null;
	public $AgencyId = "unknown_agency";
	public $Description = null;
	public $CampaignManager = null;
	public $ProductId = "default-product";
	public $CampaignGroups = null;
	public $CompetitiveCategories = null;
	public $ExternalUsers = null;
	public $InternalQuickReport = "to-date";
	public $ExternalQuickReport = "short";

	// Schedule
	public $Impressions = null;
	public $Clicks = null;
	public $Uniques = null;
	public $Weight = null;
	public $PriorityLevel = null;
	public $Completion = null;
	public $StartDate = null;
	public $EndDate = null;
	public $Reach = null;
	public $DailyImp = null;
	public $DailyClicks = null;
	public $DailyUniq = null;
	public $SmoothOrAsap = null;
	public $ImpOverrun = null;
	public $CompanionPositions = null;
	public $StrictCompanions = null;
	public $ImpPerVisitor1 = null;
	public $ClickPerVisitor1 = null;
	public $FreqScope1 = null;
	public $ImpPerVisitor2 = null;
	public $FreqScope2 = null;
	public $HourOfDay = null;
	public $DayOfWeek = null;
	public $UserTimeZone = null;
	public $Sections = null;

	// Pages
	public $Pages = null;

	// Target
	public $ExcludeTargets = null;
	public $TopLevelDomain = null;
	public $Domain = null;
	public $Bandwidth = null;
	public $Continent = null;
	public $Country = null;
	public $State = null;
	public $AreaCode = null;
	public $Msa = null;
	public $Dma = null;
	public $City = null;
	public $Zip = null;
	public $Os = null;
	public $Browser = null;
	public $BrowserV = null;
	public $SearchType = null;
	public $SearchTerm = null;
	public $Cookie = null;

	// Exclude - For now we're not supporting this

	// Billing
	public $Cpm = null;
	public $Cpc = null;
	public $Cpa = null;
	public $FlatRate = null;
	public $Tax = null;
	public $AgencyCommission = null;
	public $PaymentMethod = null;
	public $PurchaseOrder = null;
	public $SalesRepresentative = null;
	public $CommissionPercent = null;
	public $Notes = null;
	public $IsYieldManaged = null;
	public $BillTo = null;
	
	// API CONFIG VARS
	public $main_id = "Id";
	public $main_tag = "Campaign";
	
	public function entity_def() {
	  $inst = array(
		"Overview" => array(
			"Id" => &$this->Id,
			"AdvertiserId" => &$this->AdvertiserId,
			"Name" => &$this->Name,
			"AgencyId" => &$this->AgencyId,
			"Description" => &$this->Description,
			"CampaignManager" => &$this->CampaignManager,
			"ProductId" => &$this->ProductId,
			"CampaignGroups" => array(
				"CampaignGroupId" => &$this->CampaignGroups,
				"@arrCampaignGroupId" => true
				),
			"CompetitiveCategories" => array(
				"CompetitiveCategoryId" => &$this->CompetitiveCategories,
				"@arrCompetitiveCategoryId" => true
				),
			  "ExternalUsers" => array(
				"UserId" => &$this->ExternalUsers,
				"@arrUserId" => true
			  ),
			"InternalQuickReport" => &$this->InternalQuickReport,
			"ExternalQuickReport" => &$this->ExternalQuickReport
			),
		"Schedule" => array(
			"Impressions" => &$this->Impressions,
			"Clicks" => &$this->Clicks,
			"Uniques" => &$this->Uniques,
			"Weight" => &$this->Weight,
			"PriorityLevel" => &$this->PriorityLevel,
			"Completion" => &$this->Completion,
			"StartDate" => &$this->StartDate,
			"EndDate" => &$this->EndDate,
			"Reach" => &$this->Reach,
			"DailyImp" => &$this->DailyImp,
			"DailyClicks" => &$this->DailyClicks,
			"DailyUniq" => &$this->DailyUniq,
			"SmoothOrAsap" => &$this->SmoothOrAsap,
			"ImpOverrun" => &$this->ImpOverrun,
			"CompanionPositions" => array(
				"CompanionPosition" => &$this->CompanionPositions,
				"@arrCompanionPosition" => true
				),
			"StrictCompanions" => &$this->StrictCompanions,
			"PrimaryFrequency" => array(
				"ImpPerVisitor" => &$this->ImpPerVisitor1,
				"ClickPerVisitor" =>&$this->ClickPerVisitor1,
				"FreqScope" => &$this->FreqScope1
				),
			"SecondaryFrequency" => array(
				"ImpPerVisitor" => &$this->ImpPerVisitor2,
				"FreqScope" => &$this->FreqScope2
				),
			"HourOfDay" => array(
				"Hour" => &$this->HourOfDay,
				"@arrHour" => true
				),
			"DayOfWeek" => array(
				"Day" => &$this->DayOfWeek,
				"@arrDay" => true
				),
			"UserTimeZone" => &$this->UserTimeZone,
			"Sections" => array(
				"SectionId" => &$this->Sections,
				"@arrSectionId" => true
				)
			),
		"Pages" => array(
			"Url" => &$this->Pages,
			 "@arrUrl"  => true
			),
		"Target" => array(
			"ExcludeTargets" => &$this->ExcludeTargets,
			"TopLevelDomain" => array(
				"Code" => &$this->TopLevelDomain,
				 "@arrCode"  => true
				),
			"Domain" => &$this->Domain,
			"Bandwidth" => array(
				"Code" => &$this->Bandwidth,
				 "@arrCode"  => true
				),
			"Continent" => array(
				"Code" => &$this->Continent,
				 "@arrCode"  => true
				),
			"Country" => array(
				"Code" => &$this->Country,
				 "@arrCode"  => true
				),
			"State" => array(
				"Code" => &$this->State,
				 "@arrCode"  => true
				),
			"AreaCode" => array(
				"Code" => &$this->AreaCode,
				 "@arrCode"  => true
				),
			"Msa" => array(
				"Code" => &$this->Msa,
				 "@arrCode"  => true
				),
			"Dma" => array(
				"Code" => &$this->Dma,
				 "@arrCode"  => true
				),
			"City" => array(
				"Code" => &$this->City,
				 "@arrCode"  => true
				),
			"Zip" => array(
				"Code" => &$this->Zip,
				 "@arrCode"  => true
				),
			"Os" => array(
				"Code" => &$this->Os,
				 "@arrCode"  => true
				),
			"Browser" => array(
				"Code" => &$this->Browser,
				 "@arrCode"  => true
				),
			"BrowserV" => array(
				"Code" => &$this->BrowserV,
				 "@arrCode"  => true
				),
			"SearchType" => &$this->SearchType,
			"SearchTerm" => &$this->SearchTerm,
			"Cookie" => &$this->Cookie
			),
		"Billing" => array(
			"Cpm" => &$this->Cpm,
			"Cpc" => &$this->Cpc,
			"Cpa" => &$this->Cpa,
			"FlatRate" => &$this->FlatRate,
			"Tax" => &$this->Tax,
			"AgencyCommission" => &$this->AgencyCommission,
			"PaymentMethod" => &$this->PaymentMethod,
			"PurchaseOrder" => &$this->PurchaseOrder,
			"SalesRepresentative" => &$this->SalesRepresentative,
			"CommissionPercent" => &$this->CommissionPercent,
			"Notes" => &$this->Notes,
			"IsYieldManaged" => &$this->IsYieldManaged,
			"BillTo" => &$this->BillTo
			)
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
		$inst->Organization = $this->return_xml_value($xml, $i, "Organization");
		$inst->Notes = $this->return_xml_value($xml, $i, "Notes");
		$inst->ContactFirstName = $this->return_xml_value($xml, $i, "ContactFirstName");
		$inst->ContactLastName = $this->return_xml_value($xml, $i, "ContactLastName");
		$inst->ContactTitle = $this->return_xml_value($xml, $i, "ContactTitle");
		$inst->Email = $this->return_xml_value($xml, $i, "Email");
		$inst->Phone = $this->return_xml_value($xml, $i, "Phone");
		$inst->Fax = $this->return_xml_value($xml, $i, "Fax");
		$inst->UserId = $this->return_xml_value($xml, $i, "UserId", array( "ExternalUsers" ), true );
		$inst->BillingMethod = $this->return_xml_value($xml, $i, "Code", array( "BillingInformation", "Method" ) );
		$inst->Address = $this->return_xml_value($xml, $i, "Address", array( "BillingInformation" ) );
		$inst->City = $this->return_xml_value($xml, $i, "City", array( "BillingInformation" ) );
		$inst->State = $this->return_xml_value($xml, $i, "Code", array( "BillingInformation", "State" ) );
		$inst->Country = $this->return_xml_value($xml, $i, "Code", array( "BillingInformation", "Country" ) );
		$inst->Zip = $this->return_xml_value($xml, $i, "Zip", array( "BillingInformation" ) );
		$inst->InternalQuickReport = $this->return_xml_value($xml, $i, "InternalQuickReport");
		$inst->ExternalQuickReport = $this->return_xml_value($xml, $i, "ExternalQuickReport");
		
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated");
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated");
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified");
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified");
	}
}
?>