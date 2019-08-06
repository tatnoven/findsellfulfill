<?php
	require_once("connect.php");

    $fname = $_POST["fname"];
    $lname = $POST["lname"];
	$email = $_POST["email"];
	$pass = $_POST["pass"];
	$rpass = $_POST["rpass"];
	$contact = $_POST["contact"];
	$role = 2;
	if($pass != $rpass){
	    header("Location:register.php?error=1");
	    die();
	}
    $pass = md5($pass);
    
	$query = "SELECT * FROM users where email = '$email'";

	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));			

	if(!mysqli_num_rows($result)){
		
		

        $query = "INSERT into users (fname , lname, email, pass, contact, role) VALUES ('$fname','$lname','$email','$pass','$contact','$role')";
	    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	
	    session_start();
        $_SESSION["lname"] = $lname;
        $_SESSION["fname"] = $fname;
		$_SESSION["email"] = $email;
		$_SESSION["role"] = $role;
		
		if($role == 1){
		    header("Location: admin/products/");
		}
		else if($role == 2){
		    header("Location: user/products/");
		}

        else{
            header("Location: vendor");
        }
		
		die();
	}

	else{
		header("Location: register.php?error=2");
		die();

	}


?>