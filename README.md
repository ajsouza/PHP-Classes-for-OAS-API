#PHP Library for Open AdStream
**In BETA currently, not yet a stable release, we may still tweak object structures, properties and methods.** This is an attempt to create a full PHP library for 247Media's Open AdStream. The idea is to simplify development cycle by allow PHP developers to focus less on parsing XML and more on getting stuff done. Additional information resources:
* [Wiki](https://github.com/ajsouza/PHP-Classes-for-OAS-API/wiki) : OAS PHP Library Documentation.
* [Blog](http://openadstream.blogspot.com/) : Technical blog, cool stuff you can develop.

Entities
========
Currently this PHP library has support for the following entities;
* Advertiser
* Agency
* Campaign
* Campaign Group
* Creative
* Insertion Order
* Page
* Product
* Site
* Site Group
* Section

I decided to **drop development of Notification temporarily**, the object is less structured (than other AdXML objects) and requires a little more analysis before we feel confident to suport it.

Methods
=======
* create; Create a new entity
* update; Update an entity
* find; Find a specific instance of an entity [usually based on id]
* search; Find all entities based on a search criteria, it returns instances of entity in **$entity->instances**

In addition to these, we are also developing some bulk update methods;
* add; Add to **$entity->instances** an instance of an entity.
* updateAll; Update all instances of entity.
* createAll; Create all instances of entity.

Sample Usage
============ 
The example below shows how you would use the Advertiser entity to retrieve all advertisers whose name is like %A%.

```PHP
<?php
include "api.oas.php";

/* 
  Just for clarity of what to pass to Connect
  I created the above variables (should be self explanatory)
*/
$wsdl = "https://[YOUR API DOMAIN]/oasapi/OaxApi?wsdl";
$account = "[YOUR OAS ACCOUNT]";
$user = "[YOUR USER]";
$pass = "[YOUR PASS]";

/* 
  Instantiate a connection
*/
$API = new OAS();
$OAS = $API->Connect($wsdl, $account, $user, $pass);

/* 
  Create an OAS Entity {advertiser, agency, campaign, 
  campaign group, product, etc...} - and develop cool
  products!
*/
$Advertisers = $OAS->Entity("advertiser");
$Advertisers->Organization = "A";

$OAS->search($Advertisers);
foreach( $Advertisers->instances as $Advertiser ) {
	echo $Advertiser->Id . "\n";
	echo $Advertiser->Organization . "\n";
	echo $Advertiser->WhoCreated . "\n";
	echo $Advertiser->WhenCreated . "\n\n";
}
?>
```

Future Development
==================
We are planning on creating an oas.reporting.php library.