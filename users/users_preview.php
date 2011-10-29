<?php
require_once "../extentions/sitesettings.php";
include_once "../extentions/header.php";
include_once "../extentions/bodystart.php";
include_once "../extentions/dbconnect.php";
echo '<div id="mainContent">';
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "../extentions/sidebar.php";
			}
echo '<div id="screen">';
if ($_SESSION['accesslvl'] == 'Administrator'){
     
	echo '<table id="usersTable">';
	 if (isset($_REQUEST[msg])) { 
						echo '<tr>
							<td colspan="2">Αποτέλεσμα :</td>
							<td colspan="3" style="color: red;">'; 
							if($_GET[msg] == 'ok' ){echo "Επιτυχείς αλλαγή στοιχείων";}else{echo "Λάθος κωδικός";} 
							echo '</td>
						</tr>';
			}
	echo '<thead><tr><th>ID</th><th>Όνομα διαπίστευσης</th><th>Όνομα</th><th>Επώνυμο</th><th>Εγγεγραμένος</th></tr></thead>';
	$query  = "SELECT user_id, username, firstname, lastname,registered FROM Users_db ORDER BY user_id";           
	$result = mysql_query($query);
	while($row=mysql_fetch_row($result)){
	  if(++$i%2==1){
		 		echo '<tr align="center" valign="top" class="oddline">';
			}
			else{
				echo '<tr align="center" valign="top" class="evenline">';
			}
			if ($row[4] == 'true'){ $row[4]='Ναι';}else{$row[4]='Όχι';}
			echo '<td><a href="users_edit.php?user_id='.$row[0].'">'.$row[0].'</a></td>'; 
			echo '<td><a href="users_edit.php?user_id='.$row[0].'">'.$row[1].'</td>';
			echo '<td>'.$row[2].'</td>';
			echo '<td>'.$row[3].'</td>';
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
<td colspan="2">
</body></html>
 