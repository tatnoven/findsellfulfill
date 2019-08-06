<?php
    require_once("../../connect.php");
    $category = $_POST["category"];
    
    /* Finding the missing ID in the table */
    $query = "SELECT * FROM categories order by id ASC";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    $count = 1;
    while($row = $result->fetch_assoc()) { 
        if($row["id"] != $count){
            break;
        }
        $count++;
    }
    $id = $count;
    
    $query = "INSERT into categories (category,id) VALUES ('$category','$count')";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

    header("Location: index.php?msg=3");


?>