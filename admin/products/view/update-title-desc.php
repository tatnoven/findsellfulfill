<?php
    require_once("../../../connect.php");
    require_once("../../session-check.php");
    $ptitle=$_POST["ptitle"];
   $ptitle = mysqli_real_escape_string($conn,$ptitle);

    $pdesc=$_POST["pdesc"];
   $pdesc = mysqli_real_escape_string($conn,$pdesc);
    $pid=$_POST["p-id"];
    
$sql = "UPDATE products set pname='$ptitle' where id='$pid' ";
if ($conn->query($sql) === TRUE) {

} else {
    echo "Error updating record: " . $conn->error;
    die();
    
}
$sql = "UPDATE products set pdescription='$pdesc' where id='$pid' ";
if ($conn->query($sql) === TRUE) {

} else {
    echo "Error updating record: " . $conn->error;
    die();
    
}



header("Location: index.php?msg=5&id=$pid");
die();


?>