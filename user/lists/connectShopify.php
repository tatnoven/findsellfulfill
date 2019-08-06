<?php


$shopname = $_POST["shopname"];
$shopurl = "https://findsellfulfill.com/app/install.php?shop=".$shopname;
header("Location: $shopurl");
die();

?>