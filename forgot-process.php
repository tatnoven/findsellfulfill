<?php

	require_once('connect.php');
	$email = $_POST['email'];

		
		$sql = "SELECT * FROM users WHERE email='$email'";
		$res = mysqli_query($conn,$sql) or die(mysql_error());

		if( mysqli_num_rows($res) > 0) {
		    
			
            $password = "";
            $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            
            for($i = 0; $i < 8; $i++)
             {
                 $random_int = mt_rand();
                 $password .= $charset[$random_int % strlen($charset)];
               }
			$sql = "Update users set token='$password' where email='$email'";
			
			
		}
			else{
		  header("Location: forgot-password.php?error=4");
			$conn->close();
			die();
		}
			if ($conn->query($sql) === TRUE) {
			$conn->close();
			
			
			$string = "https://findsellfulfill.com/app/password-reset.php?email=$email&token=$password";
				
				$msg = " Please click this link to reset your password: $string";
	
				// use wordwrap() if lines are longer than 70 characters
				$msg = wordwrap($msg,70);

				// send email
				mail($email,"Reset Your Password",$msg,'From: findsellfulfill');

				header("Location: forgot-password.php?error=3");


		}

		 else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
			$conn->close();
		}
	
		
?>