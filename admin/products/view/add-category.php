<?php

    require_once("../../session-check.php");
    require_once("../../../connect.php");

$category = $_POST["category"];
$id = $_POST["id"];

$query = "SELECT * from pcategories where pid='$id' and category='$category'";
$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

if(mysqli_num_rows($result) == 0){
    $query = "INSERT into pcategories (category , pid) VALUES ('$category','$id')";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
}



header("Location: index.php?msg=2&id=$id");
die();




?>