<?php
    require_once("../../../connect.php");
    require_once("../../session-check.php");
    
    if(!isset($_GET["id"]) || empty($_GET["id"])){
        header("Location: ../index.php?msg=2");
    }

    $id = $_GET["id"];
    $query = "SELECT * from products where id='$id'";

	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
    while($row = $result->fetch_assoc()) {
        $pname=$row["pname"];
        $pdescription = $row["pdescription"];
        $sprice = $row["sprice"];
        $bprice = $row["bprice"];
        $cprice = $row["cprice"];
        $vprice = $row["vprice"];
        $sqty = $row["sqty"];
        $sku = $row["sku"];
        $daystl= $row["daystl"];
        $pimage = $row["pimage"];
        $pcreatedon = $row["pcreatedon"];
    }
    
?>
<html>
    <head>
        <?php require_once("../../header-includes.php"); ?>
        <style>
        .container section{
            margin-top:20px;
        }
        .col-8{
            padding-left:30px;
            
        }
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
        
        h2{
            font-weight:400;
            margin-bottom:15px;
            padding-bottom:10px;
            border-bottom:1px solid #777;
        }
        
        .main-img-container{
            padding:5px;
            margin-bottom:20px;
            border:1px solid #777;
        }
        .main-img-container img{
            width:100%;
            height:auto;
            position:relative;
        }
        .thumbnail-container{
            width:25%;
            padding:5px;
            border:1px solid #777;
            5px;
            display:inline-block;
            vertical-align:top;
        }
        
        .thumbnail-container img{
            width:100%;
            height:50px;
            cursor:pointer;
        }
        .image-upload{
            font-size:16px;
            color:#fff;
            background-color:rgba(0,0,0,0.7);
            position:absolute;
            bottom:0;
            left:0;
            right:0;
            width:100%;
            z-index:2;
            display:inline-block;
        }
        .price-details{
            margin-top:30px;
            
        }
        .product-details{
            white-space:pre;
            font-size:16px;
            background-color:#f7f7f7;
            padding:20px;
            margin-bottom:30px;
        }
        .product-categories{
            margin-bottom:30px;
        }
        h3{
            text-align:center;
            font-weight:300;
        }
        input:not([type="submit"]),textarea,select{
            min-width:250px;
            padding:8px 10px;
            border:2px solid #777;
            display:block;
            margin:0;
            font-size:16px;
            
        }
        .price-details input:active,.price-details input:focus{
            outline:none;
        }
       
         .edit-text:active,.edit-text:focus{
            outline:none ;
          
        }
        </style>
    </head>
    
    <body>
        <?php require_once("../../main-header.php"); ?>
        <?php require_once("../../header-menu.php"); ?>
        
        <div id="main-content">
            <div class="container">
                <div class="intro">
                    <h1>Product Details</h1>
                    <p><a class="btn-danger" href="../delete.php?id=<?php echo $_GET['id'] ?>" style="margin-left:25px;font-weight:normal;">Delete this product</a></p>
                     
                </div>
                <?php
                        if(isset($_GET["msg"]) || !empty($_GET["msg"])){
                            if($_GET["msg"]==1){
                               echo '<p class="alert-success">Product Image added successfully.</p>';
                            }
                            if($_GET["msg"]==2){
                               echo '<p class="alert-success">Category added successfully.</p>';
                            }
                            if($_GET["msg"]==3){
                               echo '<p class="alert-success">Sub-category added successfully.</p>';
                            }
                            if($_GET["msg"]==4){
                               echo '<p class="alert-success">Pricing updated successfully!</p>';
                            }
                             if($_GET["msg"]==5){
                               echo '<p class="alert-success">Product name and description updated successfully!</p>';
                            }
                            
                        }
                ?>
                <section>
                    <div class="col-4">
                        <div class="main-img-container" id="main-img-container">
                            
                            <img class='gallery-item' src="https://findsellfulfill.com/app/uploads/products/<?php echo "$id/$pimage"?>" />
                        </div>
                        
                        <?php 
                            foreach(glob("../../../uploads/products/$id/".'*') as $filename){
                                echo "<div class='thumbnail-container'><img class='gallery-item' src='../../../uploads/products/".$id.'/'.basename($filename)."' /></div>";
                            }
                        ?>
                        <form id="add-image" style="margin-top:20px;" method="POST" action="add-image.php" enctype="multipart/form-data">
                            <p>Add a product image:</p>
                            <input type="file" name="pimage" multiple="multiple">
                            <input type="text" name="id" value="<?php echo $id ?>" style="display:none" />
                            <input type="submit" value="Add Image" class="btn-normal" />
                        </form>
                        <div class="price-details">
                            <form method="post" action="update-price.php">
                            <table class="striped-table">
                                <tr><td>Sales Price</td><td><input type="number" name="sp" stpe="0.01" min="1"  value="<?php echo $sprice;?>" style="text-align:center;border:0;display:inline-block;" /></td></tr>
                                <tr><td>Compare Price</td><td><input type="number" name="cp" stpe="0.01" min="1" value="<?php echo $cprice;?>" style="text-align:center;border:0;display:inline-block;" /></td></tr>
                                <tr><td>Buying Price</td><td><input type="number" name="bp" stpe="0.01" min="1" value="<?php echo $bprice;?>" style="text-align:center;border:0;display:inline-block;" /></td></tr>
                                <tr><td>Vendor Price</td><td><input type="number" name="vp" stpe="0.01" min="1" value="<?php echo $vprice;?>" style="text-align:center;border:0;display:inline-block;" /></td></tr>
                                
                            </table>
                                <input type="text" name="pid" value="<?php echo $id ?>" style="display:none" />
                                <button class="btn-normal" style="margin-top:0;" >Update Pricing</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-8">
                        <form method="post" action="update-title-desc.php">
                        <h2><input type="text" name="ptitle" value="<?php echo $pname;?>" class="edit-text" style="border:0;font-size:28px;font-weight:400;"/></h2>
                        <p class="product-categories">
                            Categories: 
                            <?php
                                $query = "SELECT * from pcategories where pid='$id' order by category ASC";

                    			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));	
                    			$total = mysqli_num_rows($result);
                    			$total_counter = 1;
                    			$token = "abc";
                    			$count = 0;
                    			while($row = $result->fetch_assoc()) {
                                    $category = $row["category"];
                                    if($category != $token){
                                        if($count){
                                            echo ") ";
                                        }
                                        echo "$category ";
                                        $token = $category;
                                        $count = 0;
                                    }
                                    
                                    if(!empty($row["subcategory"])){
                                        $subcategory = $row["subcategory"];
                                        if($count == 0){
                                            echo "($subcategory";
                                            $count++;
                                            if($total == $total_counter){
                                                echo ")";
                                            }
                                        }
                                        else{
                                            echo ", $subcategory";
                                            if($total == $total_counter){
                                                echo ")";
                                            }
                                        }
                                    }
                                    
                                    $total_counter++;
                    			}
                            ?>
                        </p>
        
                        <p class="product-details"><textarea name="pdesc" style="border:0;width:100%;height:300px;"><?php echo $pdescription ?></textarea></p>
                            <input type="text" name="p-id" value="<?php echo $id ?>" style="display:none" />
                            <button class="btn-normal" style="margin-top:0;margin-bottom:45px" >Update title & description</button>
                        </form>
                        <div class="col-6">
                            <h3>Add Category</h3>
                            <form action="add-category.php" method="POST" style="margin-top:10px;">
                                <select name="category" id="category-droplist">
                                    <?php
                                        $query = "SELECT * from categories";
                                        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
		                            	while($row = $result->fetch_assoc()) {
                                            $category = $row["category"];
                                            echo "<option value='$category' id='$category'>$category</option>";
		                            	}
                                    ?>
                                    <input type="text" name="id" value="<?php echo $id ?>" style="display:none"/>
                                    <input type="submit" value="Add Category" class="btn-normal" />
                                </select>
                            </form>
                        </div>
                        <div class="col-6">
                            <h3>Add Sub-category</h3>
                            <form action="add-subcategory.php" method="POST" style="margin-top:10px;">
                                <select name="subcategory" id="subcategory-droplist">
                                    <option class='subcategory-options'>Select a Category</option>
                                    <?php
                                        $query = "SELECT * from subcategories order by categoryid asc";
                                        $result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
		                            	while($row = $result->fetch_assoc()) {
                                            $categoryname = $row["categoryname"];
                                            $subcategory = $row["subcategory"];
                                            echo "<option class='subcategory-options' value='$subcategory' dataid='$categoryname'>$subcategory</option>";
		                            	}
                                    ?>
                                    <input type="text" name="category" value="" style="display:none;" />
                                    <input type="text" name="id" value="<?php echo $id ?>" style="display:none"/>
                                    <input type="submit" value="Add Category" class="btn-normal" />
                                </select>
                            </form>
                        </div>
                        <div class="cf"></div>
                    </div>
                    <div class="cf"></div>
                </section>
            </div>
        </div>
        
<?php require_once("../../footer-menu.php"); ?>
<?php require_once("../../footer.php"); ?>
<script>
    $(document).ready(function () {
        $('.thumbnail-container img').click(function () {
            var link = $(this).attr('src');
            $('#main-img-container img').attr('src',link);
        });
    });  
</script>
        
    </body>
</html>