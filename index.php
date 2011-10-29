<?php
	require_once "extentions/sitesettings.php";
	include_once "extentions/header.php";
	include_once "extentions/bodystart.php";
	if (session_id() == ''){session_start();};
	
	
	
?>
 	<div id="mainContent">
    	<?php if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "extentions/sidebar.php";
			}
    	echo '<div id="screen">';
			if (isset($_REQUEST[msg])) { 
						echo '<table width="300px" border="0"><tr>
							<td>Αποτέλεσμα :</td>
							<td style="color: red;">'; if($_GET[msg] == 'ok' ){echo "Επιτυχείς διαγραφή";}else{echo "Λάθος !!";}
							echo '</td>
						</tr></table>';
						 }
			?>
        <?php if ($_SESSION[authenticated] != "yes"){ echo '<h1> Καλώς ήρθατε </h1><br clear="all"/>';}
		include_once "extentions/dbconnect.php";
		mysql_query("set names 'utf8'");
			$query="SELECT * FROM product_db WHERE product_type='book' ORDER BY createdate DESC LIMIT 2"; 
			$result = mysql_query($query);
			$count=mysql_num_rows($result);
			$i=0;
			echo '<h2>Νέες αφίξεις Βιβλίων</h2>';
			while($row=mysql_fetch_row($result)){
			$i++;	
			echo '<div class="product">
			<div class="proddescr">
				<h6 class="productlabel">Τίτλος</h6><h3 class="productlabelvalue"><a href="products/product_view.php?product_id='.$row[0].'" title="'.$row[1].'">'.$row[1].'</a></h3><br clear="all">
				<h6 class="productlabel">Συγγραφέας</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[2])).'</h3><br clear="all">
				<h6 class="productlabel">Κατηγορία</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[5])).'</h3><br clear="all">
				<h6 class="productlabel">Τιμή</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[6])).'&euro;</h3><br>
				<h6 class="moreinfo"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">Περισσότερα</a></h6>
			</div>
			<div class="icons">';
				if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
					echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type=book&add='.$row[0].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="images/shop.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
				}
				if($row[7]=="true"){echo '<img src="images/onsales.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';}
				if($row[8]=="true"){echo '<img src="images/bestseller1.gif" title="Bestseller" alt="Bestseller">';}
				echo '</div>
			</div>';
				if(!($i%2)){
					echo '<hr />';
				}
    		}
			echo '<h2>Νέες αφίξεις CD</h2>';
			$query="SELECT * FROM product_db WHERE product_type='cd' ORDER BY createdate DESC LIMIT 2"; 
			$result = mysql_query($query);
			$count=mysql_num_rows($result);
			$i=0;
			while($row=mysql_fetch_row($result)){
			$i++;	
			echo '<div class="product">
			<div class="proddescr">
				<h6 class="productlabel">Τίτλος</h6><h3 class="productlabelvalue"><a href="products/product_view.php?product_id='.$row[0].'" title="'.$row[1].'">'.$row[1].'</a></h3><br clear="all">
				<h6 class="productlabel">Συγγραφέας</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[2])).'</h3><br clear="all">
				<h6 class="productlabel">Κατηγορία</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[5])).'</h3><br clear="all">
				<h6 class="productlabel">Τιμή</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[6])).'&euro;</h3><br>
				<h6 class="moreinfo"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">Περισσότερα</a></h6>
			</div>
			<div class="icons">';
				if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
					echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type=cd&add='.$row[0].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="images/shop.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
				}
				if($row[7]=="true"){echo '<img src="images/onsales.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';}
				if($row[8]=="true"){echo '<img src="images/bestseller1.gif" title="Bestseller" alt="Bestseller">';}
				echo '</div>
			</div>';
				if(!($i%2)){
					echo '<hr />';
				}
    		}
		echo '</div>';
		?>
        </div>
<?php
    include_once "extentions/footer.php";
?>
	</body>
</html>
