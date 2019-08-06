<?php
    require_once("connect.php");
     
     $email=$_GET["email"];
     $token=$_GET["token"];
     

	$sql = "SELECT * FROM users WHERE email='$email' AND token ='$token'";
	
		$res = mysqli_query($conn,$sql) or die(mysql_error());
		if(mysqli_num_rows($res)>0){
		    //All good baby
		}
		
		else{
		    echo $sql;
		    die();
		}
?>
		    <html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap" rel="stylesheet">
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="main.css" type="text/css" rel="stylesheet">
        <style>
        #main-content .container{
            max-width:800px;
        }
        h1{
            margin-bottom:20px;
            text-align:center;
            font-weight:300;
        }
        .alert-danger{
            width:100%;
            max-width:500px;
            display:block;
            margin:10px auto 10px auto;
            box-sizing:border-box;
        }
            form{
                width:100%;
                max-width:600px;
                margin:0 auto;
                text-align:center;
                
            }
            input:not([type="submit"]){
                width:500px;
                padding:8px 10px;
                border:2px solid #777;
                display:block;
                margin:0 auto;
                font-size:16px;
                margin-bottom:7px;
                
            }
            
            input[type="submit"]{
                
            }
        </style>
    </head>
    
    <body>
        <div id="main-header">
            <div class="container">
                <div class="col-4">
                    <a href="#"><img class="social-icons" src="https://findsellfulfill.com/app/res/fb-icon.png" /></a>
                    <a href="#"><img class="social-icons" src="https://findsellfulfill.com/app/res/insta-icon.png" /></a>
                </div>
                <div class="col-4" style="text-align:center;">
                    <a href="https://findsellfulfill.com/app"><img id="logo" src="https://findsellfulfill.com/app/res/logo.png"></a>
                </div>
               
            </div>
        </div>
        
        <div id="main-content">
            <div class="container">
                <h1>Reset Your password</h1>
                
                    <?php
                        if(isset($_GET["error"]) && !empty($_GET["error"])){
                            if($_GET["error"]==1){
                                echo '<p class="alert-danger">Unable to changed!</p>';
                            }
                             if($_GET["error"]==4){
                                echo '<p class="alert-danger">Incorrect!</p>';
                            }
                             if($_GET["error"]==3){
                                echo '<p class="alert-danger">Password not matched!</p>';
                            }
                        }
                    
                    ?>
                <form action="password-reset-process.php" method="POST">
                    <input type="password" name="pass" placeholder="Enter Your New password"/>
                    <input type="password" name="pass1" placeholder="Enter Your New Password Again"/>
                    <input type="email" name="email"   value="<?php echo $email;?>" style="display:none;" />
                    <input type="text" name="token" value="<?php echo $token;?>" style="display:none;" />
                    <input type="submit" class="btn-normal" value="Reset Password"/>
                     
                </form>
               
            </div>
        </div>
        
        <div id="main-footer">
            <div class="container">
                
<p>This site is not a part of the Google website or Alphabet, Inc. Additionally this website is NOT endorsed by Facebook in any way. Google is a trademark of ALPHABET, INC and Facebook is a trademark of FACEBOOK, inc.
FindSellFulfillTM is no way affiliated with Shopify or any if its subsidiaries.</p>

            </div>
            
        </div>
        <div id="footer-bottom">
            <div class="container">
                <p>Copyright Findsellfulfill 2019 AllRights Reserved</p>
            </div>
        </div>
    </body>
</html>
