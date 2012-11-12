<?php

// FILES & PATHS
define("PATH_API_FILES", "");
define("PATH_LOG_FILES", "/logs");
define("BASECLASS", "baseclass.oas.php");

// AdXML OPTIMIZATIONS
define("MAX_ADXML_CALLS", 50);

class OAS{
	public function Entity($name){
		try {
			if(!class_exists($name))
				include PATH_API_FILES."oas.".$name.".php";

			$Entity = new $name();

			return $Entity;

		} catch (Exception $e) {
			echo 'Entity error: ',  $e->getMessage(), "\n";
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
			echo 'Connection error: ',  $e->getMessage(), "\n";
		}
	}
}
?>