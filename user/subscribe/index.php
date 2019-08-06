<?php
    require_once("../../connect.php");
    session_start();
    if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){
        session_unset();
        session_destroy();
        header("Location: https://findsellfulfill.com/app/");
        die();
    }
    
?>
<html>
    <head>
        <?php require_once("../header-includes.php"); ?>
        <style>
        .intro{
            min-height:50px;
        }
        .intro h1{
            font-weight:300;
            float:left;
        }
        
        .intro p{
            float:right;
            font-weight:bold;
        }
        
        
        
        .gallery-column h3{
            font-size:16px;
            margin-top:5px;
            font-weight:400;
        }
        .product-category-list .active{
            background-color:#bf4e0f;
        }
            
             .col-4.gallery-column p{
                font-size:14px;
                margin-top:5px;
                
            }
        </style>
    </head>
    
    <body>
        <?php require_once("../main-header.php"); ?>
        <?php require_once("../header-menu.php"); ?>
        
        <div id="main-content">
            <div class="container">
                <div class="intro">
                    <h1>Subscribe Now</h1>
                    <p>Welcome, <?php echo $_SESSION["fname"]; ?>!</p>
                </div>
                <?php
                        if(isset($_GET["msg"]) || !empty($_GET["msg"])){
                            if($_GET["msg"]==1){
                               echo '<p class="alert-success">Product added to your list!</p>';
                            }
                            if($_GET["msg"]==2){
                               echo '<p class="alert-success">Product removed from your list!</p>';
                            }
                            
                        }
                ?>
                <section style="margin-top:20px;">
                    <div class='col-6'>
                        
                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="package_form"  method="post" >
                        	<input type="hidden" name="business" value="lisa-facilitator@iwillimport.com">
                        	<input type="hidden" name="cmd" value="_xclick">
                        	<input type="hidden" name="item_name" value="FindSellFulfill Basic Plan">
                        	<input type="hidden" id="amount" name="amount" value="29.00">  
                        	<input type="hidden" name="first_name" value="<?php echo $_SESSION["fname"];  ?>"> 
                        	<input type="hidden" name="rm" value="2">
                        	<input type="hidden" name="item_number" value="1">
                        	<input type="hidden" name="last_name" value="">  
                        	<input type="hidden" name="address1" value="">  
                        	<input type="hidden" name="address2" value=""> 
                        	<input type="hidden" name="custom" value="https://findsellfulfill.com/app/user/process_plan.php"> 
                        	<input type="hidden" name="city" value=""> 
                        	<input type="hidden" name="state" value="">   
                        	<input type="hidden" name="return" value="https://findsellfulfill.com/app/user/process_plan.php">
                        	<input type="hidden" name="notify_url" value="https://findsellfulfill.com/app/user/process_plan.php">
                        	<input type="hidden" name="cancel_return" value="https://findsellfulfill.com/app/">
                        	<input type="hidden" name="cbt" value="https://findsellfulfill.com/app/">
                        	<input type="hidden" name="currency_code" value="USD">
                        				
                        	<input type="submit" value="Buy Basic Plan ($29)">
                        </form>	
                    </div>
                    
                    <div class='col-6'>
                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="package_form"  method="post" >
                        	<input type="hidden" name="business" value="lisa-facilitator@iwillimport.com">
                        	<input type="hidden" name="cmd" value="_xclick">
                        	<input type="hidden" name="item_name" value="FindSellFulfill Basic Plan">
                        	<input type="hidden" id="amount" name="amount" value="99.00">  
                        	<input type="hidden" name="first_name" value="<?php echo $_SESSION["fname"];  ?>"> 
                        	<input type="hidden" name="rm" value="2">
                        	<input type="hidden" name="item_number" value="2">
                        	<input type="hidden" name="last_name" value="">  
                        	<input type="hidden" name="address1" value="">  
                        	<input type="hidden" name="address2" value=""> 
                        	<input type="hidden" name="custom" value="https://findsellfulfill.com/app/user/process_plan.php"> 
                        	<input type="hidden" name="city" value=""> 
                        	<input type="hidden" name="state" value="">   
                        	<input type="hidden" name="return" value="https://findsellfulfill.com/app/user/process_plan.php">
                        	<input type="hidden" name="notify_url" value="https://findsellfulfill.com/app/user/process_plan.php">
                        	<input type="hidden" name="cancel_return" value="https://findsellfulfill.com/app/">
                        	<input type="hidden" name="cbt" value="https://findsellfulfill.com/app/">
                        	<input type="hidden" name="currency_code" value="USD">
                        				
                        	<input type="submit" value="Buy Premium Plan ($99)">
                        </form>
                    </div>
                    
                    <div class="cf"></div>
                </section>
            </div>
        </div>
        
<?php require_once("../footer-menu.php"); ?>
<?php require_once("../footer.php"); ?>
    </body>
</html>