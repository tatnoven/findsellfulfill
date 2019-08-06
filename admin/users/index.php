<?php
    require_once("../../connect.php");
    require_once("../session-check.php");
    
    $query = "SELECT * from users order by role desc";
    $result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
	

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
        
        .striped-table tr td:nth-child(1){
            width:10%;
        }
        .striped-table tr td:nth-child(2){
            width:30%;
        }
        .striped-table tr td:nth-child(3){
            width:15%;
        }
        .striped-table tr td:nth-child(4){
            width:15%;
        }
        .striped-table tr td:nth-child(5){
            width:15%;
        }
        .striped-table tr td:nth-child(6){
            width:15%;
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
                               echo '<p class="alert-success">Product deleted successfully.</p>';
                            }
                            if($_GET["msg"]==2){
                               echo '<p class="alert-danger">Product ID not correct.</p>';
                            }
                            
                        }
                ?>
                <section>
                    <table class="striped-table">
                        <tr>
                            <th>Email</th><th>First Name</th><th>Last Name</th><th>Role</th><th>View/Edit</th>
                        </tr>
                        
                        <?php
                            while($row = $result->fetch_assoc()) {
                                $useremail = $row["email"];
                                $fname = $row["fname"];
                                $lname = $row["lname"];
                                $id = $row["id"];
                                $role = $row["role"];
                            
                            
                            echo "
                            <tr>
                                <td>$useremail</td>
                                <td>$fname</td>
                                <td>$lname</td>
                                ";
                            
                            if($role == 1){
                                echo "<td>Admin</td>";
                            }
                            
                            if($role ==2){
                                echo "<td>User</td>";
                            }
                                
                            echo "
                                <td><a href='user-view.php?id=$id' class='table-button-positive'>View/Edit</a></td>
                            </tr>
                            
                            
                            
                            ";
                            
                            }
                        ?>
                    </table>
                    
                    
                </section>
            </div>
        </div>
        
<?php require_once("../footer-menu.php"); ?>
<?php require_once("../footer.php"); ?>
    </body>
</html>