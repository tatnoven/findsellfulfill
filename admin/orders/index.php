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
        <script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><style><!--table br {mso-data-placement:same-cell;} tr {vertical-align:top;} --></style><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
    </head>
    
    <body>
        <?php require_once("../main-header.php"); ?>
        <?php require_once("../header-menu.php"); ?>
        
        <div id="main-content">
            <div class="container">
                <div class="intro">
                    <h1>Orders</h1>
                    <p>Welcome, <?php echo $_SESSION["fname"]; ?>! <input type="button" onclick="tableToExcel('testTable2', 'Table')" value="Export Table" class='btn-normal'></p>
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
                    
                    
                    <table class="striped-table" id="testTable2">
                        <tr>
                            <th>Status</th><th>Shopname</th><th>Order Number</th><th>Tracking Code</th><th>Product ID</th><th>SKU</th><th>Selling Price</th><th>Quantity</th>
                            <th>Product Name</th><th>Customer Name</th><th>Address 1</th><th>Address 2</th><th>City</th><th>Province</th>
                            <th>Country</th><th>ZIP</th><th>Phone</th>
                        </tr>
                       <?php
                        $query = "SELECT * from orders";

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
			                $paid=$row["paid"];
			                $tcode=$row["tcode"];
			                
			                $pnumber = $row["pnumber"];
			                
                            echo"<tr>";
                            
                            if($paid == 1){
                                echo '<td style="background-color:green;color:#fff;text-align:center;vertical-align:middle;"> Paid </td>';
                            }
                            
                            else{
                                echo '<td style="background-color:red;color:#fff;text-align:center;vertical-align:middle;"> Unpaid </td>';
                            }
                            echo "<td>$shopname </td>
			                <td>$onumber </td>";
			                
			                if($tcode == "NONE"){
			                    echo "<td><form action='https://findsellfulfill.com/app/user/lists/shopify-plugin/fullfillment.php' method='POST'>
			                    <input type='text' name='tcode' style='border:1px solid #333;font-size:16px;'/>
			                    <input type='text' name='onumber' value='$onumber' style='display:none' />
			                    <input type='text' name='shopname' value='$shopname' style='display:none' />
			                    <input type='submit' class='btn-normal' value='Add Tracking Code' />
			                    
			                    </form></td>
			                    ";
			                }
			                
			                else{
			                    echo "<td>$tcode</td>";
			                }
			                
			                
			                echo "<td>$pid </td>
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