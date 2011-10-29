<?php
$user_id=$_GET['user_id'];
$product_id=$_GET['product_id'];
include_once "extentios/dbconnect.php";
$delete= "DELETE  FROM tempcart_db WHERE user_id = '$user_id' AND product_id='$product_id'";
mysql_query($delete);
header("Location: $_SERVER[HTTP_REFERER]");
?>