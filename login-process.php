<?php
	require_once("connect.php");

	$email = $_POST["email"];
	$pass = $_POST["pass"];
    $pass = md5($pass);
    
	$query = "SELECT * FROM users where email = '$email' AND BINARY pass = '$pass'";

	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));			
	while($row = $result->fetch_assoc()) { 
		$role= $row["role"];
		$fname = $row["fname"];
		$lname = $row["lname"];
	}
	
	if(mysqli_num_rows($result)){
		
		session_start();

        $_SESSION["lname"] = $lname;
        $_SESSION["fname"] = $fname;
		$_SESSION["email"] = $email;
		$_SESSION["role"] = $role;
		
		if($role == 1){
		    header("Location: admin/products/");
		}
		else if($role == 2){
		    
		    $query = "SELECT * FROM subscription where email = '$email' AND status = '1'";

        	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));			
        	if(mysqli_num_rows($result)==1){
        	    $_SESSION["status"] = '1';
        	    header("Location: user/products/");
        	    die();
        	}
		        
        	else{
        	    $_SESSION["status"] = '0';
        	    header("Location: user/subscribe/");
        	    die();
        	}
        	
        	
		    
		    
		}

        else{
            header("Location: vendor");
        }
		
		die();
	}

	else{
		header("Location: https://findsellfulfill.com/app/?error=1");
		die();

	}






?>