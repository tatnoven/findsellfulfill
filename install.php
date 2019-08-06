<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "a5c0b7602ded409fe288bcbc7f7e0d09";
$scopes = "read_products,write_products,read_themes,write_themes,read_script_tags,read_orders,write_orders,write_content,write_shipping";
$redirect_uri = "https://findsellfulfill.com/app/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();