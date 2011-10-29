<?php
include_once "extentios/header.php";
include_once "extentios/dbconnect.php";
include_once "extentios/bodystart.php";

if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes" && $_SESSION['accesslvl']='author') {
							include_once "extentios/sidebar1.php";
			
echo '<div id="mainContent">';

$query  = "SELECT * FROM product_db";
$result = mysql_query($query);
$numrows=mysql_num_rows($result);
echo "Συνολο προιοντων:".$numrows;
echo "<br>";

$query="SELECT * FROM product_db WHERE product_type = 'book'";
$result = mysql_query($query);
$numbooks=mysql_num_rows($result);
echo "Συνολο βιβλίων:".$numbooks;
echo "<br>";

$query="SELECT * FROM product_db WHERE product_type = 'cd'";
$result = mysql_query($query);
$numcds=mysql_num_rows($result);
echo "Συνολο CD:".$numcds;
echo "<br>";

$query="SELECT * FROM sales_db";
$result = mysql_query($query);
$numsales=mysql_num_rows($result);
echo "Συνολο Αγορών:".$numsales;
echo "<br>";
echo "<br>";


echo "Τα 5 καλυτερα σε πωλήσεις προιοντα:";
echo "<br>";
$query="SELECT product_name, sold FROM product_db order by sold DESC LIMIT 5";
mysql_query("set names 'utf8'");
$result = mysql_query($query);
while($row=mysql_fetch_row($result)){
echo $row[0].$row[1];
echo "<br>";
}
echo "<br>";

echo "Τα 3 καλυτερα σε πωλήσεις προιοντών σε προσφορά:";
echo "<br>";
$query="SELECT product_name, sold FROM product_db WHERE onSales='true' order by sold DESC LIMIT 3";
mysql_query("set names 'utf8'");
$result = mysql_query($query);
while($row=mysql_fetch_row($result)){
echo $row[0].$row[1];
echo "<br>";
}



echo "Παραγελείες:";
echo "<br>";
$query="select Users_db.*  from Users_db,sales_db  where Users_db.user_id=sales_db.user_id  AND  sales_db.delivery_date > 1/1/2010";
mysql_query("set names 'utf8'");
$result = mysql_query($query);
while($row=mysql_fetch_row($result)){
echo $row[0].$row[1];
echo "<br>";
}
?>
</div>
<?php
}
    include_once "extentios/footer.php";
?>
</body>
</html>