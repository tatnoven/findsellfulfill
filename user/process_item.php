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
$id = $_GET["item_number"];
$email = $_SESSION["email"];

if($st == "Completed"){
    $query = "UPDATE orders set paid = 1 where id = '$id'";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	$query = "UPDATE orders set tid='$tid' where id = '$id'";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	header("Location: orders/index.php");
}


?>