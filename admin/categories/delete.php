<?php
    require_once("../../connect.php");
    require_once("../session-check.php");
    
    if(!isset($_GET["id"]) || empty($_GET["id"])){
        header("Location: https://findsellfulfill.com/app/admin/products/");
        die();
    }
    else{
        $id = $_GET["id"];
        
        $query = "DELETE from categories where id = '$id'";

	    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	    
	    $query = "DELETE from subcategories where categoryid = '$id'";

	    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	    

	    header("Location: https://findsellfulfill.com/app/admin/categories/?msg=1");
	    die();
    }





?>