<?php
    require_once("../../connect.php");
    require_once("../session-check.php");

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
                    <h1>Products</h1>
                    <p>Welcome, <?php echo $_SESSION["fname"]; ?>! <a class="btn-normal" href="add-product" style="margin-left:25px;font-weight:normal;">Add Product</a></p>
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
                            <th>IMG</th><th>Title</th><th>Buying Price</th><th>Selling Price</th><th>View Details</th><th>Remove</th>
                        </tr>
                        <?php
                            $query = "SELECT * from products";

			                $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
			                $count = 0;
			                while($row = $result->fetch_assoc()) {
			                    $count++;
			                    $productname = $row["pname"];
			                    $productid = $row["id"];
			                    $pimage = $row["pimage"];
			                    $bprice = $row["bprice"];
			                    $sprice = $row["sprice"];
			                    
			                    echo "<tr>";
			                    echo "<td><img class='thumbnail-image' src='https://findsellfulfill.com/app/uploads/products/$productid/$pimage' /></td>";
			                    echo "<td>$productname</td>";
			                    echo "<td>$$bprice</td>";
			                    echo "<td>$$sprice</td>";
			                    echo "<td><a href='view/?id=$productid' class='table-button-positive'>View</a></td>";
			                    echo "<td><a href='delete.php?id=$productid' class='table-button-negative'>Delete</a></td>";
			                    echo "</tr>";
			                    
			                }
                          if($count == 0){
                              echo "<p class='alert-danger'>No Products Found</p>";
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