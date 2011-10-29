<?php

require_once("../includes/functions.php");
ForceAdministrativePage();

$pid=$_REQUEST['pid'];
$catid=$_REQUEST['catid'];

if (isset($_GET['action'])&&($_GET['action']=="delete"))
{
$query="DELETE FROM products WHERE id='".($pid+0)."'";
}
else
{
if (isset($_POST['available']))
$available='True';
else
$available='False';

$product_title=$POST['product_title'];

$price=str_replace(",",".",trim($_POST['price']));
$price=$price+0;
$description=$_POST['description'];

if ($_POST[pid]=="new"){
$query="INSERT INTO products(title,cat_id, price, description,available) values('$products_title', $catid, '$price','$description','$available')";
}else{
 $query="UPDATE products SET title='$product_title', price='$price', cat_id='$catid', description='description', available='$available' WHERE id='".($pid+0)."'";
 }
}

require_once("../includes/dbconnect.php");
$result=$db->MakeQuery($query);

header("Location: show_products.php?catid=$catid");

?>