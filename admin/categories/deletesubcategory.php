<?php
    require_once("../../connect.php");
    require_once("../session-check.php");
    
    if(!isset($_GET["id"]) || empty($_GET["id"])){
        header("Location: https://findsellfulfill.com/app/admin/products/");
        die();
    }
    else{
        $id = $_GET["id"];
        $categoryid = $_GET["category"];
        $query = "DELETE from subcategories where id = '$id'";

	    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	    

	    header("Location: https://findsellfulfill.com/app/admin/categories/?msg=2&category=$categoryid");
	    die();
    }





?>