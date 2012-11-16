<?php
include_once "baseclass.oas.php";

define("FILE_MARKER", '<File>[**CONTENT**]</File>');
define("FILE_TAG", '<File contentType="[**CONTENT_TYPE**]" encoding="base64" fileType="[**FILE_TYPE**]" fileName="[**FILE_NAME**]">[**CONTENT**]</File>');

class creative extends OASEntity {
	public $CampaignId = null;
	public $Id = null;
	public $Name = null;
	public $Description = null;
	public $ClickUrl = null;
	public $Positions = null;
	public $CreativeTypesId = null;
	public $RedirectUrl = null;
	public $Display = null;
	public $Height = null;
	public $Width = null;
	public $TargetWindow = null;
	public $AltText = null;
	public $DiscountImpressions = null;
	public $StartDate = null;
	public $EndDate = null;
	public $Weight = null;
	public $ExpireImmediately = null;
	public $NoCache = null;
	public $File = "[**CONTENT**]";
	public $ExtraHTML = null;
	public $ExtraText = null;
	public $BrowserV = null;
	public $SequenceNo = null;
	
	public $main_id = "CampaignId";
	public $main_tag = "Creative";
	public $Files = null;

	public function load_file($file, $html = null) {
		$data = array();
		$types = array( 
			IMAGETYPE_GIF => '.gif', 
			IMAGETYPE_JPEG => '.jpg', 
			IMAGETYPE_PNG => '.png', 
			IMAGETYPE_SWF => '.swf' );

		try {
			// DEAL WITH IMAGE or COMPONENT
			if ( $file != "" ) {
				$exifType = exif_imagetype( $file );

				if (!isset($types[$exifType])) {
					throw new Exception("$file is an unsupported file type", 1);
				} else {
					$data['fileName'] = basename($file);
					$data['contentType'] = mime_content_type($file);
					if ( $html != null || $this->Files != null ) {
						$data['fileType'] = "component";
					} else {
						$data['fileType'] = "creative";
					}
					$data['content'] = base64_encode(file_get_contents($file));
				}

				$tag = str_replace("[**CONTENT**]", $data['content'], FILE_TAG);
				$tag = str_replace("[**FILE_NAME**]", $data['fileName'], $tag);
				$tag = str_replace("[**FILE_TYPE**]", $data['fileType'], $tag);
				$tag = str_replace("[**CONTENT_TYPE**]", $data['contentType'], $tag);

				$this->Files .= $tag;
			}

			// DEAL WITH HTML or CREATIVE if Exists
			if ( $html != null ) {
				$data = array();

				$data['fileName'] = "template.html";
				$data['contentType'] = "text/html";
				$data['fileType'] = "creative";
				$data['content'] = base64_encode($html);

				$tag = str_replace("[**CONTENT**]", $data['content'], FILE_TAG);
				$tag = str_replace("[**FILE_NAME**]", $data['fileName'], $tag);
				$tag = str_replace("[**FILE_TYPE**]", $data['fileType'], $tag);
				$tag = str_replace("[**CONTENT_TYPE**]", $data['contentType'], $tag);

				$this->Files .= $tag;
			}

		} catch (Exception $e) {
			
		}

	}
	
	public function entity_def() {
	  $inst = array(
		  "CampaignId" => &$this->CampaignId,
		  "Id" => &$this->Id,
		  "Name" => &$this->Name,
		  "Description" => &$this->Description,
		  "ClickUrl" => &$this->ClickUrl,
		  "Positions" => array(
				"Position" => &$this->Positions,
				"@arrPosition" => true
		  ),
		  "CreativeTypesId" => &$this->CreativeTypesId,
		  "RedirectUrl" => &$this->RedirectUrl,
		  "Display" => &$this->Display,
		  "Height" => &$this->Height,
		  "Width" => &$this->Width,
		  "TargetWindow" => &$this->TargetWindow,
		  "AltText" => &$this->AltText,
		  "DiscountImpressions" => &$this->DiscountImpressions,
		  "StartDate" => &$this->StartDate,
		  "EndDate" => &$this->EndDate,
		  "Weight" => &$this->Weight,
		  "ExpireImmediately" => &$this->ExpireImmediately,
		  "NoCache" => &$this->NoCache,
		  "File" => &$this->File,
		  "ExtraHTML" => &$this->ExtraHTML,
		  "ExtraText" => &$this->ExtraText,
		  "BrowserV" => array(
				"Code" => &$this->BrowserV,
				"@arrCode" => true
		  ),
		  "SequenceNo" => &$this->SequenceNo
		);
		
		return $inst;
	}
	
	public function clean_instance(&$inst){
	  if( count($inst['Positions']) == 1 )
	    unset($inst['Positions']);
	
	  if( count($inst['BrowserV']) == 1 )
	    unset($inst['BrowserV']);
	}

	public function validate(){

	}
	
	public function map($xml, &$inst, $i){
		$inst->CampaignId = $this->return_xml_value($xml, $i, "CampaignId");
		$inst->Id = $this->return_xml_value($xml, $i, "Id");
		$inst->Name = $this->return_xml_value($xml, $i, "Name");
		$inst->Description = $this->return_xml_value($xml, $i, "Description");
		$inst->ClickUrl = $this->return_xml_value($xml, $i, "ClickUrl");
		$inst->Positions = $this->return_xml_value($xml, $i, "Position", array( "Positions" ), true );
		$inst->CreativeTypesId = $this->return_xml_value($xml, $i, "CreativeTypesId");
		$inst->RedirectUrl = $this->return_xml_value($xml, $i, "RedirectUrl");
		$inst->Display = $this->return_xml_value($xml, $i, "Display");
		$inst->Height = $this->return_xml_value($xml, $i, "Height");
		$inst->Width = $this->return_xml_value($xml, $i, "Width");
		$inst->TargetWindow = $this->return_xml_value($xml, $i, "TargetWindow");
		$inst->AltText = $this->return_xml_value($xml, $i, "AltText");
		$inst->DiscountImpressions = $this->return_xml_value($xml, $i, "DiscountImpressions");
		$inst->StartDate = $this->return_xml_value($xml, $i, "StartDate");
		$inst->EndDate = $this->return_xml_value($xml, $i, "EndDate");
		$inst->Weight = $this->return_xml_value($xml, $i, "Weight");
		$inst->ExpireImmediately = $this->return_xml_value($xml, $i, "ExpireImmediately");
		$inst->NoCache = $this->return_xml_value($xml, $i, "NoCache");
		$inst->ExtraHTML = $this->return_xml_value($xml, $i, "ExtraHTML");
		$inst->ExtraText = $this->return_xml_value($xml, $i, "ExtraText");
		$inst->BrowserV = $this->return_xml_value($xml, $i, "Code", array( "BrowserV" ), true );
		$inst->SequenceNo = $this->return_xml_value($xml, $i, "SequenceNo");
		
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
		ADXML  - Add the creative files
	*/
	public function adxml() {
	  $this->entity = $this->entity_def();
	  
	  $this->compact_xml_array($this->entity);
	  
	  // Customized Cleaning Rules
	  $this->clean_instance($this->entity);

	  $temp = $this->build_xml($this->entity);

	  if ( $this->getFunctionName() == "create" ) {
			$temp = str_replace(FILE_MARKER, $this->Files, $temp);
		} elseif ( $this->getFunctionName() == "update" ) {
			$xml = '<Request type="'.$this->main_tag.'"><'.$this->main_tag.' action="update">';
			$xml .= str_replace(FILE_MARKER, "", $temp);
			$xml .= '</'.$this->main_tag.'></Request>';
			if ( $this->Files != null ) {
				$template = '<Request type="'.$this->main_tag.'"><Creative action="upload"><CampaignId>'.$this->CampaignId.'</CampaignId>'.
										'<Id>'.$this->Id.'</Id>'.$this->Files.'</Creative></Request>';
				$temp = "<AdXML>".$xml.$template."</AdXML>";
			}
			else { $temp = str_replace(FILE_MARKER, "", $temp); } 			
		}

	  return $temp;
	}

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
		return $this->adxml();
	}

	private function getFunctionName() {
		$backtrace = debug_backtrace();
		return $backtrace[2]['function'];
	}
}
?>