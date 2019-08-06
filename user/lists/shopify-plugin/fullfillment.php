<?php
	require __DIR__.'/vendor/autoload.php';
	require_once("../../../connect.php");
	use phpish\shopify;

	require __DIR__.'/conf.php';
	
	
	
	$shopurl=$_POST["shopname"];
	$tcode = $_POST["tcode"];
	
	
	$query = "SELECT * from shops where shopurl='$shopurl'";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
    while($row = $result->fetch_assoc()) {
        $acode=$row["acode"];
    }

	$shopify = shopify\client($shopurl, SHOPIFY_APP_API_KEY, $acode);
	$order_id = $_POST["onumber"]; // shopify order ID.
	

	try
	{
		# Making an API request can throw an exception
		$postarray['fulfillment']=[];
		$postarray['fulfillment']['tracking_number']= $tcode;
		$postarray['fulfillment']['notify_customer'] = true; // false if do not want to send email notification to customer for full fill
		$postarray['fulfillment']['location_id']= "123456789";
		
		
		$fulfillment_status= $shopify('POST /admin/api/2019-04/orders/'.$order_id.'/fulfillments.json', $postarray);
		$tcode = $fulfillment_status['fulfillment']['id']; // save to DB
		
		$query = "UPDATE orders set tcode='$tcode' where onumber='$order_id'";
        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
        
        header("Location: https://findsellfulfill.com/app/admin/orders/");
	}
	catch (shopify\ApiException $e)
	{
		# HTTP status code was >= 400 or response contained the key 'errors'
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	// Show the access token (don't do this in production!)
?>