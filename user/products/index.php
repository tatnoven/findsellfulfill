<?php
    require_once("../../connect.php");
    require_once("../session-check.php");
    
    if(empty($_GET["category"]) || !isset($_GET["category"])){
        $categoryname="All Products";
    }
    else{
        $categoryname = $_GET["category"];
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
                    <h1>All Products</h1>
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
                    <div class="col-3">
                        <ul class="product-category-list">
                        <?php
                        $query = "SELECT * from categories order by id ASC";
                        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
		                while($row = $result->fetch_assoc()) {
		                    $category = $row["category"];
		                    if ($category == $categoryname)
		                    	echo "<li><a class='active' href='index.php?category=$category'>$category<a></li>";
                            else
		                        echo "<li><a href='index.php?category=$category'>$category<a></li>";
		                }
                        
                        ?>
                        </ul>
                    </div>
                    <div class="col-9">
                        <div class="galley-container">
                    <?php
                        $query = "SELECT DISTINCT pid from pcategories where category='$categoryname'";

		                $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
		                $count = 0;
		                  $rcount=0;
		                while($row = $result->fetch_assoc()) {
		                    $productid = $row["pid"];
                            
                            $query1 = "SELECT * from products where id='$productid'";
                            $result1 =mysqli_query($conn,$query1) or die(mysqli_error($conn));
                            
                            while($row1 = $result1->fetch_assoc()) {

		                        $productname = $row1["pname"];
		                        $productid=$row1["id"];
		                        $pimage = $row1["pimage"];
		                        $bprice = $row1["bprice"];
		                        $sprice = $row1["sprice"];
		                         $rcount++;
		                       
		                        echo "<div class='col-4 gallery-column'>";
		                        echo "<img class='gallery-image' src='https://findsellfulfill.com/app/uploads/products/$productid/$pimage' />";
		                        echo "<h3>$productname</h3>";
		                        echo "<p><i>Retail price </i><b>: $sprice</b></p>";
		                        echo "<p><i>Wholesale price </i><b>: $bprice</b></p>";
		                        $count++;
		                        $email = $_SESSION["email"];
		                        
		                        $query2 = "SELECT * from mylist where pid='$productid' and email='$email'";
		                        $result2 =mysqli_query($conn,$query2) or die(mysqli_error($conn));
		                        
		                        if(mysqli_num_rows($result2)>0){
		                            echo "<p class='alert-success'>Product is in your list</p>";
		                            echo "<a href='remove-from-list.php?id=$productid'><button class='btn-danger'>Remove from My List</button></a>";
		                        }
		                        else{
		                            echo "<a href='add-to-list.php?id=$productid'><button class='btn-normal'>Add to My List</button></a>";
		                        }
		                        
		                        echo "</div>";
		                        if($rcount%3==0)
		                       {
		                           echo"<div class='cf'></div>";
		                       }
                            }
		                }
		                
		      
		                    

                      if($count == 0){
                          echo "<p class='alert-danger'>No Products Found</p>";
                      }
                    ?>
                    </div>
                    </div>
                    
                    <div class="cf"></div>
                </section>
            </div>
        </div>
        
<?php require_once("../footer-menu.php"); ?>
<?php require_once("../footer.php"); ?>
    </body>
</html>