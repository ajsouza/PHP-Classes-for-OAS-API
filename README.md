#PHP Library for Open AdStream
This is an attempt to create a full PHP library for 247Media's Open AdStream. The idea is to simplify development cycle by allow PHP developers to focus less on parsing XML and more on getting stuff done. Additional info forthcoming on my [blog](http://openadstream.blogspot.com/)

Sample Usage
============ 
The example below shows how you would use the Advertiser entity to retrieve all advertisers whose name is like %A%.

```PHP
<?php
include "oas.entities.php";

$Advertiser = new Advertiser();
$OASSvc = new OASWebService('https://[YOUR DOMAIN]/oasapi/OaxApi?wsdl');

$OASSvc->account = "[YOUR OAS ACCOUNT]";
$OASSvc->user = "[YOUR USER]";
$OASSvc->pass = "[YOUR PASS]";

$Advertiser->Organization = "A";
$OASSvc->search($Advertiser);
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