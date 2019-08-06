<?php
    require_once("../../../connect.php");
    require_once("../../session-check.php");
    $sp=$_POST["sp"];
    $cp=$_POST["cp"];
    $bp=$_POST["bp"];
    $vp=$_POST["vp"];
    $pid=$_POST["pid"];
    
$sql = "UPDATE products set sprice='$sp' where id='$pid' ";
if ($conn->query($sql) === TRUE) {

} else {
    echo "Error updating record: " . $conn->error;
    die();
    
}
$sql = "UPDATE products set cprice='$cp' where id='$pid' ";
if ($conn->query($sql) === TRUE) {

} else {
    echo "Error updating record: " . $conn->error;
    die();
    
}
$sql = "UPDATE products set bprice='$bp' where id='$pid' ";
if ($conn->query($sql) === TRUE) {

} else {
    echo "Error updating record: " . $conn->error;
    die();
    
}
$sql = "UPDATE products set vprice='$vp' where id='$pid' ";
if ($conn->query($sql) === TRUE) {

} else {
    echo "Error updating record: " . $conn->error;
    die();
    
}


header("Location: index.php?msg=4&id=$pid");
die();


?>