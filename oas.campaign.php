<?php
include_once "baseclass.oas.php";

class campaign extends OASEntity {
	// Overview
	public $Id = null;
	public $AdvertiserId = null;
	public $Name = null;
	public $AgencyId = null;
	public $Description = null;
	public $CampaignManager = null;
	public $ProductId = null;
	public $Status = null;
	public $CampaignGroups = null;
	public $CompetitiveCategories = null;
	public $ExternalUsers = null;
	public $InternalQuickReport = null;
	public $ExternalQuickReport = null;

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
	public $AgeFrom = null;
	public $AgeTo = null;
	public $Gender = null;
	public $IncomeFrom = null;
	public $IncomeTo = null;
	public $SubscriberCode = null;
	public $PreferenceFlags = null;

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

	public function change_status($id, $status){
		return '<AdXML><Request type="Campaign"><Campaign action="update"><Overview><Id>'.$id.
					 '</Id><Status>'.$status.'</Status></Overview></Campaign></Request></AdXML>';
	}
	
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
			"Status" => &$this->Status,
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
			"Cookie" => &$this->Cookie,
			"AgeFrom" => &$this->AgeFrom,
			"AgeTo" => &$this->AgeTo,
			"Gender" => &$this->Gender,
			"IncomeFrom" => &$this->IncomeFrom,
			"IncomeTo" => &$this->IncomeTo,
			"SubscriberCode" => &$this->SubscriberCode,
			"PreferenceFlags" => &$this->PreferenceFlags
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
	
	  if( count($inst['Overview']['CampaignGroups']) == 1 )
	    unset($inst['Overview']['CampaignGroups']);
	
	  if( count($inst['Overview']['CompetitiveCategories']) == 1 )
	    unset($inst['Overview']['CompetitiveCategories']);
	
	  if( count($inst['Overview']['ExternalUsers']) == 1 )
	    unset($inst['Overview']['ExternalUsers']);
	
	  if( count($inst['Schedule']['CompanionPositions']) == 1 )
	    unset($inst['Schedule']['CompanionPositions']);
	
	  if( count($inst['Schedule']['HourOfDay']) == 1 )
	    unset($inst['Schedule']['HourOfDay']);
	
	  if( count($inst['Schedule']['DayOfWeek']) == 1 )
	    unset($inst['Schedule']['DayOfWeek']);
	
	  if( count($inst['Schedule']['Sections']) == 1 )
	    unset($inst['Schedule']['Sections']);
	
	  if( count($inst['Schedule']) == 0 )
	    unset($inst['Schedule']);
	
	  if( count($inst['Pages']) == 1 )
	    unset($inst['Pages']);
	
	  if( count($inst['Target']['TopLevelDomain']) == 1 )
	    unset($inst['Target']['TopLevelDomain']);
	
	  if( count($inst['Target']['Bandwidth']) == 1 )
	    unset($inst['Target']['Bandwidth']);
	
	  if( count($inst['Target']['Continent']) == 1 )
	    unset($inst['Target']['Continent']);
	
	  if( count($inst['Target']['Country']) == 1 )
	    unset($inst['Target']['Country']);
	
	  if( count($inst['Target']['State']) == 1 )
	    unset($inst['Target']['State']);
	
	  if( count($inst['Target']['AreaCode']) == 1 )
	    unset($inst['Target']['AreaCode']);
	
	  if( count($inst['Target']['Msa']) == 1 )
	    unset($inst['Target']['Msa']);
	
	  if( count($inst['Target']['Dma']) == 1 )
	    unset($inst['Target']['Dma']);
	
	  if( count($inst['Target']['City']) == 1 )
	    unset($inst['Target']['City']);
	
	  if( count($inst['Target']['Zip']) == 1 )
	    unset($inst['Target']['Zip']);
	
	  if( count($inst['Target']['Os']) == 1 )
	    unset($inst['Target']['Os']);
	
	  if( count($inst['Target']['Browser']) == 1 )
	    unset($inst['Target']['Browser']);
	
	  if( count($inst['Target']['BrowserV']) == 1 )
	    unset($inst['Target']['BrowserV']);
	
	  if( count($inst['Target']) == 0 )
	    unset($inst['Target']);

	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){

		// Overview
		$inst->Id = $this->return_xml_value($xml, $i, "Id", array( "Overview" ) );
		$inst->AdvertiserId = $this->return_xml_value($xml, $i, "AdvertiserId", array( "Overview" ) );
		$inst->Name = $this->return_xml_value($xml, $i, "Name", array( "Overview" ) );
		$inst->AgencyId = $this->return_xml_value($xml, $i, "AgencyId", array( "Overview" ) );
		$inst->Description = $this->return_xml_value($xml, $i, "Description", array( "Overview" ) );
		$inst->CampaignManager = $this->return_xml_value($xml, $i, "CampaignManager", array( "Overview" ) );
		$inst->ProductId = $this->return_xml_value($xml, $i, "ProductId", array( "Overview" ) );
		$inst->Status = $this->return_xml_value($xml, $i, "Status", array( "Overview" ) );
		$inst->CampaignGroups = $this->return_xml_value($xml, $i, "CampaignGroupId", array( "Overview", "CampaignGroups" ), true );
		$inst->CompetitiveCategories = $this->return_xml_value($xml, $i, "CompetitiveCategoryId", array( "Overview", "CompetitiveCategories" ), true );
		$inst->ExternalUsers = $this->return_xml_value($xml, $i, "UserId", array( "Overview", "ExternalUsers" ), true );
		$inst->InternalQuickReport = $this->return_xml_value($xml, $i, "InternalQuickReport", array( "Overview" ) );
		$inst->ExternalQuickReport = $this->return_xml_value($xml, $i, "ExternalQuickReport", array( "Overview" ) );
		$inst->WhoCreated = $this->return_xml_value($xml, $i, "WhoCreated", array( "Overview" ) );
		$inst->WhenCreated = $this->return_xml_value($xml, $i, "WhenCreated", array( "Overview" ) );
		$inst->WhoModified = $this->return_xml_value($xml, $i, "WhoModified", array( "Overview" ) );
		$inst->WhenModified = $this->return_xml_value($xml, $i, "WhenModified", array( "Overview" ) );

		// Schedule
		$inst->Impressions = $this->return_xml_value($xml, $i, "Impressions", array( "Schedule" ) );
		$inst->Clicks = $this->return_xml_value($xml, $i, "Clicks", array( "Schedule" ) );
		$inst->Uniques = $this->return_xml_value($xml, $i, "Uniques", array( "Schedule" ) );
		$inst->Weight = $this->return_xml_value($xml, $i, "Weight", array( "Schedule" ) );
		$inst->PriorityLevel = $this->return_xml_value($xml, $i, "PriorityLevel", array( "Schedule" ) );
		$inst->Completion = $this->return_xml_value($xml, $i, "Completion", array( "Schedule" ) );
		$inst->StartDate = $this->return_xml_value($xml, $i, "StartDate", array( "Schedule" ) );
		$inst->EndDate = $this->return_xml_value($xml, $i, "EndDate", array( "Schedule" ) );
		$inst->Reach = $this->return_xml_value($xml, $i, "Reach", array( "Schedule" ) );
		$inst->DailyImp = $this->return_xml_value($xml, $i, "DailyImp", array( "Schedule" ) );
		$inst->DailyClicks = $this->return_xml_value($xml, $i, "DailyClicks", array( "Schedule" ) );
		$inst->DailyUniq = $this->return_xml_value($xml, $i, "DailyUniq", array( "Schedule" ) );
		$inst->SmoothOrAsap = $this->return_xml_value($xml, $i, "SmoothOrAsap", array( "Schedule" ) );
		$inst->ImpOverrun = $this->return_xml_value($xml, $i, "ImpOverrun", array( "Schedule" ) );
		$inst->CompanionPositions = $this->return_xml_value($xml, $i, "CompanionPosition", array( "Schedule", "CompanionPositions" ), true );
		$inst->StrictCompanions = $this->return_xml_value($xml, $i, "StrictCompanions", array( "Schedule" ) );
		$inst->ImpPerVisitor1 = $this->return_xml_value($xml, $i, "ImpPerVisitor", array( "Schedule", "PrimaryFrequency" ) );
		$inst->ClickPerVisitor1 = $this->return_xml_value($xml, $i, "ClickPerVisitor", array( "Schedule", "PrimaryFrequency" ) );
		$inst->FreqScope1 = $this->return_xml_value($xml, $i, "FreqScope", array( "Schedule", "PrimaryFrequency" ) );
		$inst->ImpPerVisitor2 = $this->return_xml_value($xml, $i, "ImpPerVisitor", array( "Schedule", "SecondaryFrequency" ) );
		$inst->FreqScope2 = $this->return_xml_value($xml, $i, "FreqScope", array( "Schedule", "SecondaryFrequency" ) );
		$inst->HourOfDay = $this->return_xml_value($xml, $i, "Hour", array( "Schedule", "HourOfDay" ), true );
		$inst->DayOfWeek = $this->return_xml_value($xml, $i, "Day", array( "Schedule", "DayOfWeek" ), true );
		$inst->UserTimeZone = $this->return_xml_value($xml, $i, "UserTimeZone", array( "Schedule" ) );
		$inst->Sections = $this->return_xml_value($xml, $i, "SectionId", array( "Schedule", "Sections" ), true );

		// Pages
		$inst->Pages = $this->return_xml_value($xml, $i, "Url", array( "Pages" ), true );

		// Target
		$inst->ExcludeTargets = $this->return_xml_value($xml, $i, "ExcludeTargets", array( "Target" ) );
		$inst->TopLevelDomain = $this->return_xml_value($xml, $i, "Code", array( "Target", "TopLevelDomain" ), true );
		$inst->Domain = $this->return_xml_value($xml, $i, "Domain", array( "Target" ) );
		$inst->Bandwidth = $this->return_xml_value($xml, $i, "Code", array( "Target", "Bandwidth" ), true );
		$inst->Continent = $this->return_xml_value($xml, $i, "Code", array( "Target", "Continent" ), true );
		$inst->Country = $this->return_xml_value($xml, $i, "Code", array( "Target", "Country" ), true );
		$inst->State = $this->return_xml_value($xml, $i, "Code", array( "Target", "State" ), true );
		$inst->AreaCode = $this->return_xml_value($xml, $i, "Code", array( "Target", "AreaCode" ), true );
		$inst->Msa = $this->return_xml_value($xml, $i, "Code", array( "Target", "Msa" ), true );
		$inst->Dma = $this->return_xml_value($xml, $i, "Code", array( "Target", "Dma" ), true );
		$inst->City = $this->return_xml_value($xml, $i, "Code", array( "Target", "City" ), true );
		$inst->Zip = $this->return_xml_value($xml, $i, "Code", array( "Target", "Zip" ), true );
		$inst->Os = $this->return_xml_value($xml, $i, "Code", array( "Target", "Os" ), true );
		$inst->Browser = $this->return_xml_value($xml, $i, "Code", array( "Target", "Browser" ), true );
		$inst->BrowserV = $this->return_xml_value($xml, $i, "Code", array( "Target", "BrowserV" ), true );
		$inst->SearchType = $this->return_xml_value($xml, $i, "SearchType", array( "Target" ) );
		$inst->SearchTerm = $this->return_xml_value($xml, $i, "SearchTerm", array( "Target" ) );
		$inst->Cookie = $this->return_xml_value($xml, $i, "Cookie", array( "Target" ) );
		$inst->AgeFrom = $this->return_xml_value($xml, $i, "AgeFrom", array( "Target" ) );
		$inst->AgeTo = $this->return_xml_value($xml, $i, "AgeTo", array( "Target" ) );
		$inst->Gender = $this->return_xml_value($xml, $i, "Gender", array( "Target" ) );
		$inst->IncomeFrom = $this->return_xml_value($xml, $i, "IncomeFrom", array( "Target" ) );
		$inst->IncomeTo = $this->return_xml_value($xml, $i, "IncomeTo", array( "Target" ) );
		$inst->SubscriberCode = $this->return_xml_value($xml, $i, "SubscriberCode", array( "Target" ) );
		$inst->PreferenceFlags = $this->return_xml_value($xml, $i, "PreferenceFlags", array( "Target" ) );

		// Billing
		$inst->Cpm = $this->return_xml_value($xml, $i, "Cpm", array( "Billing" ) );
		$inst->Cpc = $this->return_xml_value($xml, $i, "Cpc", array( "Billing" ) );
		$inst->Cpa = $this->return_xml_value($xml, $i, "Cpa", array( "Billing" ) );
		$inst->FlatRate = $this->return_xml_value($xml, $i, "FlatRate", array( "Billing" ) );
		$inst->Tax = $this->return_xml_value($xml, $i, "Tax", array( "Billing" ) );
		$inst->AgencyCommission = $this->return_xml_value($xml, $i, "AgencyCommission", array( "Billing" ) );
		$inst->PaymentMethod = $this->return_xml_value($xml, $i, "PaymentMethod", array( "Billing" ) );
		$inst->PurchaseOrder = $this->return_xml_value($xml, $i, "PurchaseOrder", array( "Billing" ) );
		$inst->SalesRepresentative = $this->return_xml_value($xml, $i, "SalesRepresentative", array( "Billing" ) );
		$inst->CommissionPercent = $this->return_xml_value($xml, $i, "CommissionPercent", array( "Billing" ) );
		$inst->Notes = $this->return_xml_value($xml, $i, "Notes", array( "Billing" ) );
		$inst->IsYieldManaged = $this->return_xml_value($xml, $i, "IsYieldManaged", array( "Billing" ) );
		$inst->BillTo = $this->return_xml_value($xml, $i, "BillTo", array( "Billing" ) );
		
	}

	// OVERIDE STANDARD METHODS
	/*
		SEARCH - In Campaign, search criteria does not need the OAS header
		segments that OAS has for ADD & UPDATE, we must exclude this. Also
		the LIST action has a non-standard signature compared to the rest

		FIND - Uses the segment headers
		CREATE - Different AdXML structure from Database Items
		UPDATE - Different AdXML structure from Database Items
	*/
	public function adxml() {
	  $this->entity = $this->entity_def();

	  $this->compact_xml_array($this->entity);
	  
	  // Customized Cleaning Rules
	  $this->clean_instance($this->entity);
	  
	  $tmpxml = $this->build_xml($this->entity);

	  if ( $this->getFunctionName() == "search" ) {
	  	$excludes = array( "Overview", "Schedule", "Pages", "Target", "Billing" );
	  	
	  	// GET RID OF SEPARATION NODES
	  	foreach ($excludes as $exclude) {
				$tmpxml = str_replace("<".$exclude.">", "", $tmpxml);
				$tmpxml = str_replace("</".$exclude.">", "", $tmpxml);
	  	}
	  }

	  return $tmpxml;
	}

	private function getFunctionName() {
		$backtrace = debug_backtrace();
		return $backtrace[2]['function'];
	}
	
	public function find($Id){
		$xml = '<AdXML><Request type="'.$this->main_tag.'"><'.$this->main_tag.' action="read">';
		$xml .= '<Overview><Id>' . $Id . '</Id></Overview>';
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