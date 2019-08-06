<?php

require_once("../session-check.php");
require_once("../../connect.php");

$pid = $_GET["id"];
$email = $_SESSION["email"];

$query = "DELETE from mylist where pid = '$pid' AND email = '$email'";

$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

header("Location: index.php?msg=2");
die();




?>