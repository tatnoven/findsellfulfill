<?php
    require_once("../../connect.php");
    require_once("../session-check.php");
    
    if(!isset($_GET["id"]) || empty($_GET["id"])){
        header("Location: https://findsellfulfill.com/app/admin/products/");
        die();
    }
    else{
        $id = $_GET["id"];
        
        $query = "DELETE from products where id = '$id'";

	    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	    
	    array_map('unlink', glob("../../uploads/products/$id/*.*"));
	    rmdir("../../uploads/products/$id");

	    header("Location: https://findsellfulfill.com/app/admin/products/?msg=1");
	    die();
    }





?>