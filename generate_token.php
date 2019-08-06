<?php
session_start();
//ob_start();
// Get our helper functions
require_once("inc/functions.php");
require_once("user/lists/shopify-plugin/vendor/autoload.php");
	use phpish\shopify;
require_once("user/lists/shopify-plugin/conf.php");

// Set variables for our request
$api_key = "a5c0b7602ded409fe288bcbc7f7e0d09";
$shared_secret = "59b54e1e319e299648f6445c88edb33e";
$params = $_GET; 
$hmac = $_GET['hmac']; 

$params = array_diff_key($params, array('hmac' => '')); 
ksort($params); 

$computed_hmac = hash_hmac('sha256', http_build_query($params), $shared_secret);

if (hash_equals($hmac, $computed_hmac)) {

	// Set variables for our request
	$query = array(
		"client_id" => $api_key, // Your API key
		"client_secret" => $shared_secret, // Your app credentials (secret key)
		"code" => $params['code'] // Grab the access key from the URL
	);

	// Generate access token URL
	$access_token_url = "https://" . $params['shop'] . "/admin/oauth/access_token";

	// Configure curl client and execute request
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $access_token_url);
	curl_setopt($ch, CURLOPT_POST, count($query));
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
	$result = curl_exec($ch);
	curl_close($ch);

	// Store the access token
	$result = json_decode($result, true);
	$access_token = $result['access_token'];
		echo $access_token;
	/* WebHook Installation */
	$shopify = shopify\client($params['shop'], $api_key, $access_token);
	try
	{
		echo "sadasdadasd";
		# Making an API request can throw an exception
		$postarray['webhook']=[];
		$postarray['webhook']['topic']="orders/create";
		$postarray['webhook']['address']="https://findsellfulfill.com/app/shopifywebhook.php"; //replace url with webhook url of your server. 
		$postarray['webhook']['format']="json";
		
		
		$webhooks= $shopify('POST /admin/api/2019-04/webhooks.json', $postarray);
		print_r($webhooks); 
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

	
	
	require_once("connect.php");
	
	$email = $_SESSION["email"];
	$shopurl = $params['shop'];
	
	$query = "INSERT into shops (shopurl , user, acode) VALUES ('$shopurl','$email','$access_token')";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	


    /* Webhook installation End */
	
	header("Location: user/lists/index.php");

} else {
	// Someone is trying to be shady!
	die('This request is NOT from Shopify!');
}