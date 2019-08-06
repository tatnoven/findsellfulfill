<?php
    require_once("../session-check.php");
    require_once("../../connect.php");
    
    $id = $_GET["id"];
    $email = $_SESSION["email"];
    
    $query = "DELETE from mylist where pid='$id' and email = '$email'";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

	header("Location: index.php?msg=2");
	die();

?>