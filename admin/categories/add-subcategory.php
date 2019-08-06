<?php
    require_once("../../connect.php");
    $category = $_POST["category"];
    $subcategory = $_POST["subcategory"];
    
    /* Finding the missing ID in the table */
    $query = "SELECT * FROM subcategories order by id ASC";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    $count = 1;
    while($row = $result->fetch_assoc()) { 
        if($row["id"] != $count){
            break;
        }
        $count++;
    }
    $id = $count;
    $query = "SELECT * FROM categories where id='$category'";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    while($row = $result->fetch_assoc()) {
        $categoryname=$row["category"];
    }
    $query = "INSERT into subcategories (categoryid,id,subcategory,categoryname) VALUES ('$category','$count','$subcategory','$categoryname')";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

    header("Location: index.php?msg=4&category=$category");


?>