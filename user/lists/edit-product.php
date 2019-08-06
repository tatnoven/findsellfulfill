<?php

require_once("../session-check.php");
require_once("../../connect.php");

$email = $_SESSION["email"];

$pid = $_POST["pid"];
$pname = $_POST["pname"];
$pdescription = $_POST["pdescription"];
$sprice = $_POST["sprice"];

$query = "UPDATE mylist SET pname= '$pname' where pid = '$pid' and email='$email'";
$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

$query = "UPDATE mylist SET pdescription= '$pdescription' where pid = '$pid' and email='$email'";
$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

$query = "UPDATE mylist SET sprice= '$sprice' where pid = '$pid' and email='$email'";
$result =mysqli_query($conn,$query) or die(mysqli_error($conn));


header("Location:index.php?msg=3");
die();


?>