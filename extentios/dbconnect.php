<?php
$dbusername = "tsekuras_book";
$dbpassword = "261186";
$host = "localhost";
$db = "tsekuras_book"; 

mysql_connect($host,$dbusername,$dbpassword) or die("Error connecting to Database!" . mysql_error());
mysql_select_db($db) or die("Cannot select database!" . mysql_error());
?>