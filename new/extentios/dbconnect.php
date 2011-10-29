<?php
$dbusername = "www33175";
$dbpassword = "w90963a9a0";
$host = "localhost";
$db = "www33175"; 

mysql_connect($host,$dbusername,$dbpassword) or die("Error connecting to Database!" . mysql_error());
mysql_select_db($db) or die("Cannot select database!" . mysql_error());
?>