#PHP Library for Open AdStream
This is an attempt to create a full PHP library for 247Media's Open AdStream. The idea is to simplify development cycle by allow PHP developers to focus less on parsing XML and more on getting stuff done. Additional info forthcoming on my [blog](http://openadstream.blogspot.com/)

Entities
========
Currently this PHP library has support for the following entities;
* Advertiser
* Agency
* Campaign Group

The entities we plan to support are (work in progress);
* Insertion Order
* Campaign
* Creative
* Pages
* Section
* Site
* Site Group
* Notification

Methods
=======
* create; Create a new entity
* update; Update an entity
* find; Find a specific instance of an entity [usually based on id]
* search; Find all entities based on a search criteria [return instances of entity in **$entity->instances**]

Sample Usage
============ 
The example below shows how you would use the Advertiser entity to retrieve all advertisers whose name is like %A%.

```PHP
<?php
include "api.oas.php";

$wsdl = "https://[YOUR API DOMAIN]/oasapi/OaxApi?wsdl";
$account = "[YOUR OAS ACCOUNT]";
$user = "[YOUR USER]";
$pass = "[YOUR PASS]";

/* 
  Just for clarity of what to pass to Connect
  I created the above variables (should be self explanatory)
*/
$API = new OAS();
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