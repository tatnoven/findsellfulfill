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
        
        .col-6{
            min-height:400px;
            border:1px solid #777;
            padding:30px;
        }
        
        .category-container{
            padding:0;
            margin-bottom:5px;
            height:40px;
        }
        .col-6 .category-container:nth-child(odd){
            background-color:#f7f7f7;
            padding:0;
        }
        
        .col-6 .category-container:nth-child(even){
            background-color:#fff;
            padding:0;
        }
        
        .category-name{
            padding:10px 10px;
            height:40px;
            font-size:16px;
            width:calc(100% - 100px);
            background-color:transparent;
            border:1px solid #888;
            display:inline-block;
            color:#000;
            text-decoration:none;
        }
        
        .category-name:hover,.category-name.active{
            cursor:pointer;
            background-color:#F2681B;
            color:#fff;
            transition-duration:0.5s;
            border:1px solid #F2681B;
            text-decoration:none;
        }

        
        .category-delete{
            padding:10px 10px;
            min-width:100px;
            width:100px;
            float:right;
            text-align:center;
        }
        
        .alert-success{
            margin-bottom:10px;
        }
        
        .container section{
            display:flex;
            flex-direction:row;
        }
        
        h2{
            margin-bottom:20px;
        }
        
        input:not([type="submit"]),textarea{
            
            width:400px;
            padding:8px 10px;
            border:2px solid #777;
            margin:0 auto;
            font-size:16px;
            margin-bottom:7px;
            margin-top:50px;
            
        }
        .btn-normal{
            padding:8px 15px;
            font-size:16px;
        }
        </style>
    </head>
    
    <body>
        <?php require_once("../main-header.php"); ?>
        <?php require_once("../header-menu.php"); ?>
        
        <div id="main-content">
            <div class="container">
                <div class="intro">
                    <h1>Categories</h1>
                    
                </div>
                <?php
                        if(isset($_GET["msg"]) || !empty($_GET["msg"])){
                            if($_GET["msg"]==1){
                               echo '<p class="alert-success">Category deleted successfully.</p>';
                            }
                            if($_GET["msg"]==2){
                               echo '<p class="alert-success">Sub-category deleted successfully.</p>';
                            }
                            if($_GET["msg"]==3){
                               echo '<p class="alert-success">Category added successfully.</p>';
                            }
                            if($_GET["msg"]==4){
                               echo '<p class="alert-success">Category added successfully.</p>';
                            }
                        }
                ?>
                <section>
                    <div class="col-6">
                        <h2>Categories</h2>
                        <?php
                            
                            $query = "SELECT * FROM categories";
                            $result =mysqli_query($conn,$query) or die(mysqli_error($conn));			
			                while($row = $result->fetch_assoc()) { 
			                    
			                    $id = $row["id"];
			                    $category = $row["category"];
			                    if($id == $_GET["category"]){
			                        echo "<div class='category-container'><a href='index.php?category=$id' class='category-name active'>$category</a><a href='delete.php?id=$id' class='table-button-negative category-delete'>Remove</a></div>";

			                    }
			                    else{
			                        echo "<div class='category-container'><a href='index.php?category=$id' class='category-name'>$category</a><a href='delete.php?id=$id' class='table-button-negative category-delete'>Remove</a></div>";
			                    }
			                    echo "<div class='cf'></div>";
			                }
                        
                        ?>
                        <div class="add-new">
                            <form method="POST" action="add-category.php">
                                <input type="text" name="category" placeholder="Add new Category"/>
                                <input type="submit" value="Add" class="btn-normal"/>
                            </form>
                        </div>
                    </div>
                    <div class="col-6">
                        <h2>Sub-categories</h2>
                        <?php
                            if(isset($_GET["category"]) && !empty($_GET["category"])){
                                $categoryid = $_GET["category"];
                                $query = "SELECT * FROM subcategories where categoryid='$categoryid'";
                                $result =mysqli_query($conn,$query) or die(mysqli_error($conn));
                                $count=0;
    			                while($row = $result->fetch_assoc()) { 
    			                    
    			                    $id = $row["id"];
    			                    $subcategory = $row["subcategory"];
    			                    
    			                    echo "<div class='category-container'><button class='category-name'>$subcategory</button><a href='deletesubcategory.php?id=$id&category=$categoryid' class='table-button-negative category-delete'>Remove</a></div>";
    			                    echo "<div class='cf'></div>";
    			                    
    			                    $count++;
    			                }
    			                
    			                if($count==0){
    			                    echo "<p>The selected Category has no Sub-category.</p>";
    			                }
                            }
                            else{
                               echo "<p>Click on a Category to reveal Sub-categories.</p>";
                            }
                        
                        if(isset($_GET["category"]) && !empty($_GET["category"])){
                            echo '<div class="add-new">
                                    <form method="POST" action="add-subcategory.php">
                                        <input type="text" name="subcategory" placeholder="Add new Sub-category" />
                                        <input type="text" name="category" style="display:none" value='.$_GET["category"].' />
                                        <input type="submit" value="Add" class="btn-normal"/>
                                    </form>
                                </div>';
                        }
                        ?>
                    </div>
                    <div class="cf"></div>
                </section>
            </div>
        </div>
        
<?php require_once("../footer-menu.php"); ?>
<?php require_once("../footer.php"); ?>
    </body>
</html>