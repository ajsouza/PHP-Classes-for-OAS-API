#PHP Library for Open AdStream
This is an attempt to create a full PHP library for 247Media's Open AdStream. The idea is to simplify development cycle by allow PHP developers to focus less on parsing XML and more on getting stuff done. Additional info forthcoming on my [blog](http://openadstream.blogspot.com/)

Sample Usage
============ 
The example below shows how you would use the Advertiser entity to retrieve all advertisers whose name is like %A%.

```PHP
<?php
include "api.oas.php";

/* 
  Just for clarity of what to pass to Connect
  I have separated out the variables
*/
$API = new OAS();

$wsdl = "https://[YOUR API DOMAIN]/oasapi/OaxApi?wsdl";
$account = "[YOUR OAS ACCOUNT]";
$user = "[YOUR USER]";
$pass = "[YOUR PASS]";

$OAS = $API->Connect($wsdl, $account, $user, $pass);

/* 
  Create an OAS Entity {advertiser, agency, campaign, 
  campaign group, product, etc...}
*/
$Advertiser = $OAS->Entity("advertiser");
$Advertiser->Organization = "A";

$OAS->search($Advertiser);
foreach( $Advertiser->instances as $inst ) {
	echo $inst->Id . "\n";
	echo $inst->Organization . "\n";
	echo $inst->WhoCreated . "\n";
	echo $inst->WhenCreated . "\n\n";
}
?>
```

Future Development
==================
We are planning on creating an oas.reporting.php library.