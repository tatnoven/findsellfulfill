<?php
    require_once("connect.php");
    session_start();
    if(isset($_SESSION["email"]) && !empty($_SESSION["email"])){
        $email = $_SESSION["email"];
        $query = "SELECT role from users WHERE email='$email'";
        

        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
        $row = $result->fetch_assoc();
        $role= $row["role"];

        if($role==1){
            header("Location: admin/");
            die();
        }
        
        else if($role==2){
            header("Location: user/");
            die();
        }
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
                <div class="col-4">
                    <a class="btn-normal" href="register.php" id="register" style="float:right;">Register</a>
                </div>
            </div>
        </div>
        
        <div id="main-content">
            <div class="container">
                <h1>Login</h1>
                
                    <?php
                        if(isset($_GET["error"]) && !empty($_GET["error"])){
                            if($_GET["error"]==1){
                                echo '<p class="alert-danger">Wrong Email/Password combination used.</p>';
                            }
                            if($_GET["error"]==2){
                                echo '<p class="alert-success">Password has been reset!</p>';
                            }
                        }
                        
                    
                    ?>
                <form action="login-process.php" method="POST" style="margin-top:20px;">
                    <input type="email" name="email" placeholder="Your Email"/>
                    <input type="password" name="pass" placeholder="Your Password"/>
                    <input type="submit" class="btn-normal" value="Login Now"/>
                     
                </form>
                <div style="text-align:center;">
                    <button class="btn-normal" OnClick="window.location='forgot-password.php'">Forgot password</button>
                </div>
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