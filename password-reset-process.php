<?php

require_once("connect.php");
	$pass = $_POST['pass'];
		$pass1 = $_POST['pass1'];
		$email = $_POST['email'];
		$token = $_POST['token'];
if($pass==$pass1){
    
    parse_str($_SERVER['QUERY_STRING']);
	
	$sql = "SELECT * FROM users WHERE email='$email' AND token ='$token'";
	
		$res = mysqli_query($conn,$sql) or die(mysql_error());

		if( mysqli_num_rows($res) == 1) {
			
			$sql1 = "update users set pass='$pass' WHERE email='$email'";
			if(mysqli_query($conn,$sql1)){
    			header("Location: index.php?error=2&email=$email&token=$token");
    			die();
			}
			else
			{
				header("Location: password-reset.php?error=1&email=$email&token=$token");	
			}
		}
		else
		{
				header("Location: password-reset.php?error=4&email=$email&token=$token");	
			$conn->close();
		}
}

else{
   	header("Location: password-reset.php?error=3&email=$email&token=$token");	
}



?>