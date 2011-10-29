<?php
require_once "../extentions/sitesettings.php";
include_once "../extentions/header.php";
include_once "../extentions/bodystart.php";
echo '<div id="mainContent">';
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
			include_once "../extentions/sidebar.php";
			}
	include_once "../extentions/dbconnect.php";
	echo '<div id="screen">';
	if ($_SESSION['accesslvl'] == 'Administrator'){
		 
		echo '<table id="productsTable">';
		echo '<thead><tr><th>ID</th><th>Name</th><th>Author</th><th>Product serial</th><th>Public</th></tr></thead>';
		$query  = "SELECT product_id, product_name, author, product_serial,availability FROM product_db";           
		mysql_query("set names 'utf8'");
		$result = mysql_query($query);
		$i=0;
		while($row=mysql_fetch_row($result)){
			
			if(++$i%2==1){
		 		echo '<tr align="center" valign="top" class="oddline">';
			}
			else{
				echo '<tr align="center" valign="top" class="evenline">';
			}
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
echo '</div>';
	include_once "../extentions/footer.php";
?>
</body></html>