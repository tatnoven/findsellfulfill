<?php

session_start();
if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){
    session_unset();
    session_destroy();
    header("Location: https://findsellfulfill.com/app/");
    die();
}
    
require_once("../connect.php");

$st = $_GET["st"];
$tid = $_GET["tx"];
$planid = $_GET["item_number"];
$email = $_SESSION["email"];

if($st == "Completed"){
    $query = "INSERT into subscription (planid, email, status, tid) VALUES ('$planid','$email','1','$tid')";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    $_SESSION["status"] = '1';
	header("Location: products/index.php");
}


?>