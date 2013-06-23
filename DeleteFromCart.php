<?php
$user_id=intval($_GET['user_id']);
$product_id=intval($_GET['product_id']);
include_once "extentions/dbconnect.php";
$delete= "DELETE  FROM tempcart_db WHERE user_id = '$user_id' AND product_id='$product_id'";
mysql_query($delete);
header("Location: $_SERVER[HTTP_REFERER]");
?>
