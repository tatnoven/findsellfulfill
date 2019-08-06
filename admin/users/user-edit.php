<?php
    require_once("../../connect.php");
    require_once("../session-check.php");
    
    $id = $_POST["id"];
    $email = $_POST["email"];

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $role = $_POST["role"];
    $plan = $_POST["plan"];
    $pswd = $_POST["pswd"];
    
    if($pswd != '00000'){
        $pswd = md5($pswd);
        $query = "UPDATE users SET pass = '$pswd' where id = '$id'";
        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    }
    
    $query = "UPDATE users SET fname = '$fname' where id = '$id'";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    $query = "UPDATE users SET lname = '$lname' where id = '$id'";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    $query = "UPDATE users SET role = '$role' where id = '$id'";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));

    $query = "SELECT * from subscription where email = '$email'";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    if(mysqli_num_rows($result) == 0){
        $query = "INSERT into subscription (planid, email, status) values ('$plan','$email', '1')";
        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    }
    
    else{
        $query = "UPDATE subscription SET planid = '$plan' where email = '$email'";
        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
        
        $query = "UPDATE subscription SET status = '1' where email = '$email'";
        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
    }
    
    header("Location: user-view.php?id=$id&msg=1");
    die();


?>