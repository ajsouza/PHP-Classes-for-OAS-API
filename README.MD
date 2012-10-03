#PHP Library for Open AdStream
This is an attempt to create a full PHP library for 247Media's Open AdStream. The idea is to simplify development cycle by allow PHP developers to focus less on parsing XML and more on getting stuff done. Additional info forthcoming on my [blog](http://openadstream.blogspot.com/)

```PHP
<?php
include "oas.entities.php";

$Advertiser = new Advertiser();
$OASSvc = new OASWebService('https://[YOUR DOMAIN]/oasapi/OaxApi?wsdl');

$OASSvc->account = "[YOUR OAS ACCOUNT]";
$OASSvc->user = "[YOUR USER]";
$OASSvc->pass = "[YOUR PASS]";

$Advertiser->Organization = "OAS";

echo $OASSvc->findall($Advertiser);
?>
```

Future Development
==================
We are planning on creating an oas.reporting.php library.