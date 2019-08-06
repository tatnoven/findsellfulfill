<?php

require_once("connect.php");

$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256']; // verify HMAC if you want using PHP code at https://help.shopify.com/en/api/getting-started/webhooks#configure-through-api
// or you can just parse the data
$shopname = $_SERVER['HTTP_X_SHOPIFY_SHOP_DOMAIN']; //shop name
$data = file_get_contents('php://input'); // data in json format decode this data to use

$phpdata = json_decode($data, true);

$sprice = $phpdata["total_price_usd"];

$line_items = $phpdata["line_items"];

$sku = $line_items[0]["sku"];
$qty = $line_items[0]["quantity"];
$pname = $line_items[0]["title"];



$onumber = $phpdata["order_number"];
$cname = $phpdata["shipping_address"]["name"];

$a1 = $phpdata["shipping_address"]["address1"];
$a2 = $phpdata["shipping_address"]["address2"];

$city = $phpdata["shipping_address"]["city"];
$province = $phpdata["shipping_address"]["province"];
$zip = $phpdata["shipping_address"]["zip"];
$country = $phpdata["shipping_address"]["country"];

$pnumber = $phpdata["shipping_address"]["phone"];


$query = "INSERT into orders (shopname , sku, sprice, onumber, qty, pname, cname, a1, a2, city, province, zip, country, pnumber) VALUES ('$shopname','$sku','$sprice','$onumber','$qty', '$pname', '$cname', '$a1', '$a2', '$city', '$province', '$zip','$country','$pnumber')";
$result =mysqli_query($conn,$query) or die(mysqli_error($conn));


/*
// comment following lines once you verify the data indexes to be used
$fp = fopen('test.txt','w');  // as soon as an order is created and webhook is triggered a new data is written to following file to test 
fwrite($fp,$data);
fclose($fp);
*/
?>