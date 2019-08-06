<?php
require_once("../../session-check.php");
$pid = $_GET["pid"];     //product ID
$email = $_SESSION["email"];   //User Email
$acode = $_GET["acode"];   // Shopify User Authentication Code
$shopurl = $_GET["shopurl"];


require_once("../../../connect.php");
//require_once("shopify-plugin/get_shop.php");
//require_once("shopify-plugin/vendor/autoload.php");
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
require __DIR__.'/conf.php';


$images = [];
$count = 0;
foreach(glob("../../../uploads/products/$pid/".'*') as $filename){
    $images[$count]['src'] = 'https://findsellfulfill.com/app' . "/uploads/products/$pid/".basename($filename);

    
    echo $images[$count]['src'];
    $count++;
    echo "<br>";
}



$query = "SELECT * from mylist where pid='$pid' and email='$email'";
$result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
while($row = $result->fetch_assoc()) {
    $sku = $row["sku"];    //Product SKU
    $pname = $row["pname"];  //Product Name
    $pdescription = $row["pdescription"];  //Product Description
    $sprice = $row["sprice"];
}
 

	$shopify = shopify\client($shopurl, SHOPIFY_APP_API_KEY, $acode);
		
	try
	{
		$shop = $shopify('GET /admin/shop.json');
	}
	catch (shopify\ApiException $e)
	{
		if($e->getCode()=='401')
		{
			
			wp_safe_redirect($_GET['redirect'].'?error_shopify=re_auth');
				exit();
		}
			
	}
	catch (shopify\CurlException $e)
	{
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
	

	$shopify_variant_exists = 1;
	
	/*
	try
	{

		$shop = $shopify('GET /admin/variants/'.$varient_id.'.json');

	}
	catch (shopify\ApiException $e)
	{
	 	if($e->getCode()=='404')
		{
			//wp_safe_redirect($_GET['redirect'].'?error_shopify=re_auth');
			$shopify_variant_exists = 0;
				
		} 
			
	}
	catch (shopify\CurlException $e)
	{
		# cURL error
		echo $e;
		print_r($e->getRequest());
		print_r($e->getResponse());
	}
    
    if (!empty($sku) && $shopify_variant_exists ==1 ){
			try
			{
				# Making an API request can throw an exception
				$product = $shopify('PUT /admin/variants/'.$varient_id.'.json', array(), array
				(
						  'variant'=> array
							(
							"id" => $varient_id,
							"option1" => $content_post ->post_title,
							"sku"  => $post_id,
							"price"  => $product_woo['selling_price'][0]
						  )
				));
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
	}
	
	*/
		//else create the product
			try
			{

			//	$images_product = [];
			//	foreach($product_woo["wpcf-product-gallery"] as $p_image)
			//	{
			//		$images_product[]['src']=$p_image;
			//	}
				$product = $shopify('POST /admin/products.json', array(), array
				(
					'product' => array
					(
						"title" =>  $pname,
						"body_html" => $pdescription,
						"vendor" => "FSF",
						"product_type" => "FSF",
						"variants" => array
						(
							array
							(
								
								"option1" => $pname,
								"price" =>  $sprice,
								"sku" => $sku,
							)
						),
						"images" => $images,
						
					)
					));
					/* echo $product_woo['selling_price'];
				print_r($product); 
				$variants=[];
				$user_id = get_current_user_id();
				$table_name = $wpdb->prefix . 'shopify_product_data';
				$wpdb->query( "DELETE FROM $table_name WHERE post_id='".$post_id."' AND client_id='".$user_id."'");
				foreach($product['variants'] as $key  => $value){
					
					  $variants[$key ]['id']=$value["id"];
					  $variants[$key ]['product_id']=$value["product_id"];
					  $variants[$key ]['sku']=$value["sku"];
					 $wpdb->query("INSERT INTO $table_name (`client_id`,`shopify_store`, `product_id`,`varient_id`,`post_id`) values('".$user_id."','".$result->shopify_store."','".$variants[$key ]['product_id']."','".$variants[$key ]['id']."','".$variants[$key ]['sku']."')");
				 }*/
				 
					
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
			
?>