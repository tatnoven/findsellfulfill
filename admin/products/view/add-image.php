<?php
    require_once("../../session-check.php");
    require_once("../../../connect.php");



$count = $_POST["id"];
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


header("Location: index.php?id=$count&msg=1");
die();


?>