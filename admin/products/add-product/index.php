<?php
    require_once("../../session-check.php");

?>
<html>
    <head>
        <?php require_once("../../header-includes.php"); ?>
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
        
        h2{
            margin-top:20px;
            margin-bottom:30px;
            font-weight:300;
            text-align:center;
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
        
        textarea{
            min-height:300px;
        }
        
        </style>
    </head>
    
    <body>
        <?php require_once("../../main-header.php"); ?>
        <?php require_once("../../header-menu.php"); ?>
        
        <div id="main-content">
            <div class="container">
                <div class="intro">
                    <h1>Add a product</h1>
                    <p>Complete the form below to add a new product.</p>
                    <?php
                        if(isset($_GET["msg"]) || !empty($_GET["msg"])){
                            if($_GET["msg"]==1){
                               echo '<p class="alert-success">Product added successfully.</p>';
                            }
                            
                        }
                    ?>
                </div>
                <div class="cf"></div>
                <secrtion>
                    <form action="process.php" method="POST" enctype="multipart/form-data">
                        <div class="col-6" style="text-align:center">
                            <h2>Main Details</h2>
                            <input type="text" name="pname" placeholder="Product Name" required />
                            <textarea name="pdescription" placeholder="Product Description" required ></textarea>
                            <input type="number" step="1" min="1" max="9999999" name="sqty" placeholder="Stock Quantity"/>
                            <input type="text" name="sku" placeholder="SKU" required />
                            <input type="number" step="1" min="1" max="9999999" name="daystl" placeholder="Days till listed"/>
                        </div>
                        <div class="col-6" style="text-align:center">
                            <h2>Product Image</h2>
                            <p>Select main product image:</p>
                            <input type="file" name="pimage" multiple="multiple">
                            <h2>Pricing</h2>
                            <input type="number" step="0.01" min="1" max="9999999" name="sprice" placeholder="Sales Price" required />
                            <input type="number" step="0.01" min="1" max="9999999" name="cprice" placeholder="Compare Price" required />
                            <input type="number" step="0.01" min="1" max="9999999" name="bprice" placeholder="Buying Price" required />
                            <input type="number" step="0.01" min="1" max="9999999" name="vprice" placeholder="Vendor Price" required />
                            <input type="submit" value="Save Product Details" class="btn-normal" />
                        </div>
                        <div class="cf"></div>
                        
                    </form>
                </secrtion>
                
            </div>
        </div>
        
<?php require_once("../../footer-menu.php"); ?>
<?php require_once("../../footer.php"); ?>
    </body>
</html>