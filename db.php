<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
mb_http_input("utf-8");
mb_http_output("utf-8");
include_once "extentios/dbconnect.php";
$query="Drop table product_db";
mysql_query($query);
$query="CREATE TABLE `product_db` ( product_id int(11) NOT NULL auto_increment, product_name varchar(80) NOT NULL, author varchar(60) NOT NULL, product_desc text, product_serial varchar(20) NOT NULL, product_category varchar(40) NOT NULL, product_price float(7,2) NOT NULL, onSales enum('false','true') NOT NULL default 'false', bestSaler enum('false','true') NOT NULL default 'false', product_type enum('cd','book') NOT NULL default 'book', sold int(10) NOT NULL default '0', availability enum('false','true') NOT NULL default 'true', createdate date NOT NULL, PRIMARY KEY  (product_id,product_serial)) ENGINE=MyISAM DEFAULT CHARSET=utf8";

$user=mysql_query($query);
echo "Done";
?>
</body>
</html>
