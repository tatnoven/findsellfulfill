<?php
    require_once("session-check.php");

?>
<html>
    <head>
        <?php require_once("header-includes.php"); ?>
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
        }
            
        </style>
    </head>
    
    <body>
        <?php require_once("main-header.php"); ?>
        <?php require_once("header-menu.php"); ?>
        
        <div id="main-content">
            <div class="container">
                <div class="intro">
                    <h1>Admin Dashboard</h1>
                    <p>Welcome, <?php echo $_SESSION["fname"]; ?>!</p>
                </div>
                
                
            </div>
        </div>
        
<?php require_once("footer-menu.php"); ?>
<?php require_once("footer.php"); ?>
    </body>
</html>