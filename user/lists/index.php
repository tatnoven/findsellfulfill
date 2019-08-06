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
        
        .gallery-column h3{
            font-size:16px;
            margin-top:5px;
            font-weight:400;
        }
        
        input:not([type="submit"]),textarea{
            width:500px;
            padding:8px 10px;
            border:2px solid #777;
            display:block;
            margin:0 auto;
            font-size:16px;
            margin-bottom:7px;
            
        }
        
        .product-edit-div{
            width:90%;
            max-width:600px;
            margin:0 auto;
            height:90vh;
            position:fixed;
            background-color:#fff;
            border:1px solid #000;
            top:5vh;
            left:10vh;
            overflow-y:scroll;
            overflow-x:hidden;
        }
            
        </style>
        <script>
            $(document).ready(function(){
                $(".openmodal").click(function(){
                    var id = $(this).attr('id');
                    var divid = "#div" + id;
                    $(".product-edit-div").each(function(){
                        $(this).hide();
                    });
                    $(divid).show();
                })
                
                $(".closemodal").click(function(){
                    $(".product-edit-div").each(function(){
                        $(this).hide();
                    });
                })
            });
            
        </script>
        
    </head>
    
    <body>
        <?php require_once("../main-header.php"); ?>
        <?php require_once("../header-menu.php"); ?>
        
        <div id="main-content">
            <div class="container">
                <div class="intro">
                    <h1>My List</h1>
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
                            
                            if($_GET["msg"]==3){
                               echo '<p class="alert-success">Product updated!</p>';
                            }
                            
                        }
                ?>
                <section style="margin-top:20px;position:relative;">
                    
                        
                        <?php
                            $email = $_SESSION["email"]; 
                            $query = "SELECT * from shops where user = '$email'";
                            $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
                            $count = 0;
                            while($row = $result->fetch_assoc()) { 
                                $shopurl = $row["shopurl"];
                                $acode = $row["acode"];
                                $count++;
                                break;
                            }
                        
                            
                            if($count){
                                echo "<h2>$shopurl</h2>";
                                
                                echo "<h3>Products in My List:</h3>";
                            
                                $email = $_SESSION["email"];
                                $query="SELECT * FROM mylist where email='$email'";
                                $count =0;
                                $result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
			                    while($row = $result->fetch_assoc()) {
			                        $productid = $row["pid"];
		                            $pname = $row["pname"];
		                            $pdescription = $row["pdescription"];
		                            
		                            $sprice = $row["sprice"];
		                            $sku = $row["sku"];
			                        
		                            $count++;
		                            if($count == 1){
		                                echo '<table class="striped-table">
                                                    <tr>
                                                        <th>IMG</th><th>Product Name</th><th>Push to Store?</th><th>View/Edit</th><th>Delete</th>
                                                    </tr>';

		                            }
		                            $pimage = $row["pimage"];
		                            
		                            
		                            echo "<tr><td><img src='https://findsellfulfill.com/app/uploads/products/$productid/$pimage' class='thumbnail-image'/></td><td>$pname</td><td><a class='table-button-positive' href='shopify-plugin/pushtoshopify.php?pid=$productid&acode=$acode&shopurl=$shopurl'>Push</a></td>
		                            <td><a href='#' id='$productid' class='openmodal table-button-positive'>View/Edit</a></td><td><a href='delete-product.php?id=$productid' class='table-button-negative'>Delete</a></td>
		                            </tr>";
		                            echo "<div id='div$productid' class='product-edit-div' style='display:none;text-align:center;padding:20px;'>
		                            <h1 style='margin-bottom:30px;'>Editing the Product: $pname</h1>
		                            <form action='edit-product.php' method='POST'>
		                            <label>Product Name</label>
		                            <input name='pname' type='text' value='$pname' required />
		                            <br>
		                            <label>Product Description</label>
		                            <textarea style='width:100%;height:300px;' name='pdescription'>$pdescription</textarea>
		                            <br>
		                            <label>Selling Price</label>
		                            <input name='sprice' type='text' value='$sprice' required />
		                            <br>
		                            <input name='pid' type='text' value='$productid' style='display:none;' required />
		                            <input type='submit' value='Save and Exit' class='btn-normal' />
		                            
		                            
		                            </form>
		                            <button class='btn-normal closemodal'>Exit without Saving</button>
		                            </div>";
			                        
			                    }
			                
    			                if(mysqli_num_rows($result) == 0){
    			                    echo "<p>No products in your list! </p>";
    			                }
    			                else{
    			                    echo "</table>";
    			                }
                            }
                            else {
                            
                                echo '
                                    <h2 style="text-align:center;margin-bottom:30px;">Connect My Shopify Store</h2>
                                    
                    
                                    <form action="connectShopify.php" method="POST">
                                        <input type="text" placeholder="xyz.myshopify.com" name="shopname"/>
                                        <input type="submit" value="Connect Now!" class="btn-normal" />
                                    </form>';
                                
                            }
                        ?>
                    
                    
                </section>
            </div>
        </div>
        
<?php require_once("../footer-menu.php"); ?>
<?php require_once("../footer.php"); ?>
    </body>
</html>