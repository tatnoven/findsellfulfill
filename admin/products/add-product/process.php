<?php
    require_once("../../session-check.php");
    require_once("../../../connect.php");



$pname = $_POST["pname"];
$pname = mysqli_real_escape_string($conn,$pname);
$pdescription = $_POST["pdescription"];
$pdescription = mysqli_real_escape_string($conn,$pdescription);
$bprice = $_POST["bprice"];
$cprice = $_POST["cprice"];
$vprice = $_POST["vprice"];
$sprice = $_POST["sprice"];
$sqty = $_POST["sqty"];
$sku = $_POST["sku"];
$sku = mysqli_real_escape_string($conn,$sku);
$daystl = $_POST["daystl"];

/* Finding the missing ID in the table */
$query = "SELECT * FROM products order by id ASC";
$result =mysqli_query($conn,$query) or die(mysqli_error($conn));
$count = 1;
while($row = $result->fetch_assoc()) { 
    if($row["id"] != $count){
        break;
    }
    $count++;
}
$id = $count;


mkdir("../../../uploads/products/".$count);
/* Inserting Image */
$target_dir = "../../../uploads/products/".$count."/";
$temp = explode(".", $_FILES["pimage"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . $newfilename;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["pimage"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}


if (move_uploaded_file($_FILES["pimage"]["tmp_name"], $target_file)) {
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

$pimage = basename( $_FILES["pimage"]["name"]);

$query = "INSERT into products (id, pname, pdescription, bprice, cprice, vprice, sprice, sqty, sku, daystl, pimage) VALUES ('$count','$pname','$pdescription','$bprice','$cprice','$vprice','$sprice','$sqty','$sku', '$daystl', '$newfilename')";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));
	
$query = "INSERT into pcategories (category,pid) VALUES ('All Products', '$count')";
	$result =mysqli_query($conn,$query) or die(mysqli_error($conn));

header("Location: ../index.php");
die();


?>