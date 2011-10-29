<?php
$dbusername = "a6360719_3291900";
$dbpassword = "n@261186";
$host = "mysql14.000webhost.com";
$db = "a6360719_3291900"; 

mysql_connect($host,$dbusername,$dbpassword) or die("Error connecting to Database!" . mysql_error());
mysql_select_db($db) or die("Cannot select database!" . mysql_error());
?>