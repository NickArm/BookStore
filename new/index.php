<?php
	require_once "extentions/sitesettings.php";
	include_once "extentions/header.php";
	include_once "extentions/bodystart.php";
	if (session_id() == ''){session_start();};
	if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "extentios/sidebar1.php";
			}
	
	
?>
 	<div id="mainContent">
    	<?php 
			if (isset($_REQUEST[msg])) { 
						echo '<table width="300px" border="0"><tr>
							<td>Αποτέλεσμα :</td>
							<td style="color: red;">'; if($_GET[msg] == 'ok' ){echo "Επιτυχείς διαγραφή";}else{echo "Λάθος !!";}
							echo '</td>
						</tr></table>';
						 }
			?>
        <?php if ($_SESSION[authenticated] != "yes"){ echo '<h3 align="left"> Καλώς ήρθατε </h3>';}
		include_once "extentios/dbconnect.php";
		mysql_query("set names 'utf8'");
		$query="SELECT * FROM product_db ORDER BY createdate DESC LIMIT 3"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		while($row=mysql_fetch_row($result)){
			
				echo '<h2><a href="products/product_view.php?product_id='.$row[0].'">'.$row[1].'</a></h2>';
				echo '<div >Συγγραφέας/Καλλιτέχνης: '. stripslashes(nl2br($row[2])).'</div>';
				echo '<div >Τιμή: '.stripslashes(nl2br($row[6])).'&euro</div>';
    }
		
		
		?>
        </div>
<?php
    include_once "extentios/footer.php";
?>
	</body>
</html>
