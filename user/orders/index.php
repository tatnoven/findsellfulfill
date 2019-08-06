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
                    <h1>Orders</h1>
                    <p>Welcome, <?php echo $_SESSION["fname"]; ?>! </p>
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
                <section style="overflow-x:scroll;">
                    <table class="striped-table" >
                        <tr>
                            <th>Status</th><th>Shopname</th><th>Order Number</th><th>Tracking Code</th><th>Product ID</th><th>SKU</th><th>Selling Price</th><th>Quantity</th>
                            <th>Product Name</th><th>Customer Name</th><th>Address 1</th><th>Address 2</th><th>City</th><th>Province</th>
                            <th>Country</th><th>ZIP</th><th>Phone</th>
                        </tr>
                       <?php
                       $useremail = $_SESSION["email"];
                        $query = "SELECT * from orders where email='$useremail'";

		                $result =mysqli_query($conn,$query) or die(mysqli_error($conn));

			            while($row = $result->fetch_assoc()) { 

			                $shopname = $row["shopname"];
			                $onumber = $row["onumber"];
			                $pid = $row["pid"];
			                $sku = $row["sku"];
			                $sprice = $row["sprice"];
			                $qty = $row["qty"];
			                $pname = $row["pname"];
			                $cname = $row["cname"];
			                $a1 = $row["a1"];
			                $a2 = $row["a2"];
			                $city = $row["city"];
			                $province = $row["province"];
			                $country = $row["country"];
			                $zip = $row["zip"];
			                $paid = $row["paid"];
			                $id=$row["id"];
			                $tcode=$row["tcode"];
			                
			                $pnumber = $row["pnumber"];
			                
			                
			                $query1 = "SELECT * from products where sku='$sku'";

		                    $result1 =mysqli_query($conn,$query1) or die(mysqli_error($conn));
                            $count = 0;
			                while($row1 = $result1->fetch_assoc()) { 
			                    $count++;
			                    $bprice = $row1["bprice"];
			                    $pid = $row1["id"];
			                    
			                    $bprice = $bprice * $qty;
			                }
			                
			                if($count==0){
			                    continue;
			                }
                            echo"<tr>";
                            
                            if($paid == 1){
                                echo '<td style="background-color:green;color:#fff;text-align:center;vertical-align:middle;"> Paid </td>';
                            }
                            
                            else{
                                echo '<td style="background-color:red;color:#fff;text-align:center;vertical-align:middle;"> Unpaid <br>
                                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="package_form"  method="post" >
                        	<input type="hidden" name="business" value="lisa-facilitator@iwillimport.com">
                        	<input type="hidden" name="cmd" value="_xclick">
                        	<input type="hidden" name="item_name" value="'.$pname.'">
                        	<input type="hidden" id="amount" name="amount" value="'.$bprice.'">  
                        	<input type="hidden" name="rm" value="2">
                        	<input type="hidden" name="item_number" value="'.$id.'">
                        	<input type="hidden" name="last_name" value="">  
                        	<input type="hidden" name="address1" value="">  
                        	<input type="hidden" name="address2" value=""> 
                        	<input type="hidden" name="custom" value="https://findsellfulfill.com/app/user/process_item.php"> 
                        	<input type="hidden" name="city" value=""> 
                        	<input type="hidden" name="state" value="">   
                        	<input type="hidden" name="return" value="https://findsellfulfill.com/app/user/process_item.php">
                        	<input type="hidden" name="notify_url" value="https://findsellfulfill.com/app/user/process_item.php">
                        	<input type="hidden" name="cancel_return" value="https://findsellfulfill.com/app/user/orders">
                        	<input type="hidden" name="cbt" value="https://findsellfulfill.com/app/user/orders">
                        	<input type="hidden" name="currency_code" value="USD">
                        				
                        	<input type="submit" value="Pay '.$bprice.'" style="background-color:yellow;padding:5px;color:#000;">
                        </form>	
                                
                                
                                
                                </td>';
                            }
                            
                            
                            echo "
			                <td>$shopname </td>
			                <td>$onumber </td>
			                <td>$tcode</td>
			                <td>$pid </td>
			                <td>$sku </td>
			                <td>$sprice </td>
			                <td>$qty </td>
			                <td>$pname </td>
			                <td>$cname </td>
			                <td>$a1 </td>
			                <td>$a2 </td>
			                <td>$city </td>
			                <td>$province </td>
			                <td>$country </td>
			                <td>$zip </td>
			                <td>$pnumber </td>
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