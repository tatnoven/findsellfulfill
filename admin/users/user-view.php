<?php
    require_once("../../connect.php");
    require_once("../session-check.php");
    
    $id = $_GET["id"];
    
    $query = "SELECT * from users where id='$id'";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));	
    while($row = $result->fetch_assoc()) {
        $useremail = $row["email"];
        $fname = $row["fname"];
        $lname = $row["lname"];
        $id = $row["id"];
        $role = $row["role"];        
                            
    }
	
	$query1 = "SELECT * from subscription where email = '$useremail' and status='1'";
    $result1 =mysqli_query($conn,$query1) or die(mysqli_error($conn));
    if(mysqli_num_rows($result1) == 0){
        $plan = "None";
    }
    else{
        while($row1 = $result1->fetch_assoc()) {
            $planid = $row1["planid"];
            if($planid == 1){
                $plan = "Basic";
            }
            if($planid == 2){
                $plan = "Premium";
            }
            
        
        }
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
        
        .thumbnail-image{
            width:60px;
        }
        
        input:not([type="submit"]),textarea,option,select{
            width:500px;
            padding:8px 10px;
            border:2px solid #777;
            display:block;
            margin:0 auto;
            font-size:16px;
            margin-bottom:7px;
            
        }
            
        </style>
    </head>
    
    <body>
        <?php require_once("../main-header.php"); ?>
        <?php require_once("../header-menu.php"); ?>
        
        <div id="main-content">
            <div class="container">
                <div class="intro">
                    <h1>Users</h1>
                    <p>Total number of Users: <?php echo mysqli_num_rows($result); ?></p>
                </div>
                <?php
                        if(isset($_GET["msg"]) || !empty($_GET["msg"])){
                            if($_GET["msg"]==1){
                               echo '<p class="alert-success">User Edited!</p>';
                            }
                            if($_GET["msg"]==2){
                               echo '<p class="alert-danger">Product ID not correct.</p>';
                            }
                            
                        }
                ?>
                <section>
                    <form action='user-edit.php' method='post'>
                        First Name: <input type="text" name='fname' value="<?php echo $fname ; ?>" /><br> 
                        Last Name: <input type="text" name='lname' value="<?php echo $lname ; ?>" /><br> 
                        Role: <select name='role'>
                                    <option value='1'  <?php if($role == 1) echo ' selected' ?>>Admin</option>
                                    <option value='2' <?php if($role == 2) echo ' selected' ?>>User</option>
                              </select><br>
                        Plan: <select name='plan'>
                                    <option value='0' <?php if($plan == "None") echo ' selected' ?>>None</option>
                                    <option value='1' <?php if($plan == "Basic") echo ' selected' ?>>Basic</option>
                                    <option value='2' <?php if($plan == "Premium") echo ' selected' ?>>Premium</option>
                              </select><br>
                        Change Password(Leave blank if you do not want to change.): <input type="password" name='pswd' value='00000'/>
                    <input type="text" name='id' value="<?php echo $id ; ?>" style="display:none;" />
                    <input type="text" name='email' value="<?php echo $useremail ; ?>" style="display:none;" />
                    <input type="submit" class="btn-normal" />
                    </form>
                    
                    
                </section>
            </div>
        </div>
        
<?php require_once("../footer-menu.php"); ?>
<?php require_once("../footer.php"); ?>
    </body>
</html>