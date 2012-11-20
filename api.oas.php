<?php
// TORONTO [AN AWESOME, WONDERFUL, MAGNIFICENT CITY] TIME
date_default_timezone_set('America/Toronto');

/*
PHP LIB SPECIAL SETTINGS
========================
LOG_EXT				 - Extension Date/Time format for log name, generated per day
								 you could change this to generate a new file per hour, etc
STD_LOG_FORMAT - Date/Time format within logs
VERBOSE_MODE   - Output each ADXML Request & Response
VERBOSE_LOG		 - Verbose log name
DEBUGGER			 - Generate Error Logs
DEBUG_LOG		 	 - Verbose log name
*/
define("LOG_EXT", "Y-m-d");
define("STD_LOG_FORMAT", "j-m-y H:i:s");

define("VERBOSE", "VERBOSE");
define("VERBOSE_MODE", false);
define("VERBOSE_LOG", "verbose-log-");

define("DEBUG", "DEBUG");
define("DEBUGGER", true);
define("DEBUG_LOG", "error-log-");

// FILES & PATHS
define("PATH_API_FILES", "");
define("PATH_LOG_FILES", "logs");
define("BASECLASS", "baseclass.oas.php");

// AdXML OPTIMIZATIONS
define("MAX_ADXML_CALLS", 50);

class OAS{
	public $log;

  function __construct(){
     $this->log = new LogGenerator();
  }

	public function Entity($name){
		try {
			if(!class_exists($name))
				include PATH_API_FILES."oas.".$name.".php";

			$Entity = new $name();

			return $Entity;

		} catch (Exception $e) {
			$this->log->LogMe( DEBUG, 'Entity error: '.$e->getMessage()."\n" );
		}
	}

	public function Connect($wsdl, $account, $user, $pass){
		try {
			if(!class_exists("OASWebService"))
				include PATH_API_FILES.BASECLASS;

			$OAS =  new OASWebService($wsdl);

			$OAS->user = $user;
			$OAS->pass = $pass;
			$OAS->account = $account;

			return $OAS;

		} catch (Exception $e) {
			$this->log->LogMe( DEBUG, 'Connection error: '.$e->getMessage()."\n" );
		}
	}
}

class LogGenerator{
	public function LogMe($type, $message){
		$logname = null;
		if ( $type == "DEBUG" ) {
			if ( !DEBUGGER ) return null;
			$logname = DEBUG_LOG.date(LOG_EXT).".log";
		} elseif ( $type == "VERBOSE" ) {
			if ( !VERBOSE_MODE ) return null;
			$logname = VERBOSE_LOG.date(LOG_EXT).".log";
		}

		if ( file_exists(PATH_LOG_FILES."/".$logname) )
			file_put_contents(PATH_LOG_FILES."/".$logname, date(STD_LOG_FORMAT)."\n".$message, FILE_APPEND | LOCK_EX);
		else
			file_put_contents(PATH_LOG_FILES."/".$logname, date(STD_LOG_FORMAT)."\n".$message, LOCK_EX);
	}
}
?>