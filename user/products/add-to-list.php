<?php
    require_once("../session-check.php");
    require_once("../../connect.php");
    
    $id = $_GET["id"];
    $email = $_SESSION["email"];
    
    $query = "SELECT * from products where id = '$id'";

	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
	while($row = $result->fetch_assoc()) {
	    $pname = $row["pname"];
	    $pdescription = $row["pdescription"];
	    $sprice = $row["sprice"];
	    $sku = $row["sku"];
	    $pimage = $row["pimage"];
	    
	}
    
    $query = "INSERT into mylist (pid , email, pname, pdescription, sprice, sku, pimage) VALUES ('$id','$email', '$pname', '$pdescription', '$sprice','$sku','$pimage')";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

	header("Location: index.php?msg=1");
	die();

?>