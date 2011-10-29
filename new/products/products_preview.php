<?php
include_once "../extentios/header.php";
include_once "../extentios/bodystart.php";
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "../extentios/sidebar1.php";
			}
include_once "../extentios/dbconnect.php";
echo '<div id="mainContent">';
if ($_SESSION['accesslvl'] == 'Administrator'){
     
	echo '<table style="width:500px"; margin: 20px 40px; border="1px solid #777777;">';
	echo '<thead><tr><th>ID</th><th>Name</th><th>Author</th><th>Product serial</th><th>Public</th></tr></thead>';
	$query  = "SELECT product_id, product_name, author, product_serial,availability FROM product_db";           
	mysql_query("set names 'utf8'");
	$result = mysql_query($query);
	while($row=mysql_fetch_row($result)){
	  echo '<tr align="center" valign="top">';
			if ($row[4] == 'true'){ $row[4]='Ναι';}else{$row[4]='Όχι';}
			echo '<td><a href="product_edit.php?product_id='.$row[0].'">'.$row[0].'</a></td>'; 
			echo '<td><a href="product_edit.php?product_name='.$row[1].'">'.$row[1].'</a></td>';
			echo '<td>'.$row[2].'</td>';
			echo '<td><a href="product_edit.php?product_serial='.$row[3].'">'.$row[3].'</a></td>';
			echo '<td>'.$row[4].'</td>';

		echo "</tr>"; 
		
		} 	
    echo "</table>";
	}
	else {
		echo 'Unauthorised User';
		}
	echo '</div>';	
	include_once "../extentios/footer.php";
?>
</body></html>