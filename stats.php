<?php
require_once "extentions/sitesettings.php";
include_once "extentions/header.php";
include_once "extentions/bodystart.php";

echo '<div id="mainContent">';
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes" && $_SESSION['accesslvl']=='Author') {
	include_once "extentions/sidebar.php";
			
	echo '<div id="screen">';
	include_once "extentions/dbconnect.php";
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
	
	
	echo "<h2>Τα 5 καλυτερα σε πωλήσεις προιοντα:</h2>";
	echo "<br>";
	$query="SELECT product_name, sold FROM product_db order by sold DESC LIMIT 5";
	mysql_query("set names 'utf8'");
	$result = mysql_query($query);
	echo '<table>
			<tr>
				<td>Τίτλος</td>
				<td>Ποσότητα</td>
			</tr>';
	while($row=mysql_fetch_row($result)){
	echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
	}
	echo "</table><br/>";
	
	echo "<h2>Τα 3 καλυτερα σε πωλήσεις προιοντών σε προσφορά:</h2>";
	echo '<table>
			<tr>
				<td>Τίτλος</td>
				<td>Ποσότητα</td>
			</tr>';
	$query="SELECT product_name, sold FROM product_db WHERE onSales='true' order by sold DESC LIMIT 3";
	mysql_query("set names 'utf8'");
	$result = mysql_query($query);
	while($row=mysql_fetch_row($result)){
	echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
	}
	echo "</table><br/>";
	
	
	
	echo "<h2>Παραγελείες:</h2>";
	echo '<table>
			<tr>
				<td>Κωδικός Πελάτη</td>
				<td>Όνομα Πελάτη</td>
			</tr>';
	$query="select Users_db.*  from Users_db,sales_db  where Users_db.user_id=sales_db.user_id  AND  sales_db.delivery_date > 1/1/2010";
	mysql_query("set names 'utf8'");
	$result = mysql_query($query);
	while($row=mysql_fetch_row($result)){
	echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';
	}
	echo "</table><br/>";
	?>
    </div>
</div>
<?php
}
    include_once "extentions/footer.php";
?>
</body>
</html>