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
			$product_id= $_GET['product_id']+0;     
		mysql_query("set names 'utf8'");
		$query="SELECT * FROM product_db WHERE product_id = '$product_id'"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		
		while($row=mysql_fetch_row($result)){
			
			echo '<div class="productview">
			<div class="proddescr">
				<h6 class="productlabel">Τίτλος</h6><h3 class="productlabelvalue"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">'.$row[1].'</a></h3><br clear="all">
				<h6 class="productlabel">Συγγραφέας</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[2])).'</h3><br clear="all">
				<h6 class="productlabel">Κατηγορία</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[5])).'</h3><br clear="all">
				<h6 class="productlabel">Είδος</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[9])).'</h3><br clear="all">
				<h6 class="productlabel">Serial</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[4])).'</h3><br clear="all">
				<h6 class="productlabel">Τιμή</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[6])).'&euro;</h3><br>
			</div>
			<div class="icons">';
				if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
					echo '<a href="http://weblab.teipir.gr/~www33175/products/product_view.php?product_id='.$row[0].'&add='.$row[0].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="../images/shop.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
				}
				if($row[7]=="true"){echo '<img src="../images/onsales.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';}
				if($row[8]=="true"){echo '<img src="../images/bestseller1.gif" title="Bestseller" alt="Bestseller">';}
				if(isset($_SESSION['accesslvl'])&& $_SESSION['accesslvl']=="Administrator" && $_SESSION['authenticated'] == "yes"){
					echo '<a href="../products/product_edit.php?product_id='.$row[0].'" title="Επεξεργασία προϊόντος"><img src="../images/edititem.gif" alt="Επεξεργασία προϊόντος"></a>';
				}
				echo '</div>
			<div class="descrition">
				<h6 class="productlabel">Περιγραφή</h6><p class="productlabelvalue">'. stripslashes(nl2br($row[3])).'</p><br clear="all">
			</div>
			<div class="icons">';
				if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
					
					
					if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							echo '<a href="http://weblab.teipir.gr/~www33175/products/product_view.php?product_id='.$row[0].'&add='.$row[0].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="../images/shop.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
						}					
				}
				
		$product_id= $_GET['add']+0;
		$user_id = $_SESSION['user_id'];   
		if(isset($_GET['add']) && ($product_id > 0) && isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							$query="SELECT * FROM tempcart_db WHERE user_id = '$user_id' AND product_id='$product_id'";
							$result=mysql_query($query);
							$count=mysql_num_rows($result);
							if ($count == 0){
									$query="INSERT INTO tempcart_db (user_id, product_id) VALUES ('$user_id', '$product_id')";
									mysql_query($query);
							}
				}
echo '</div></div>';				
    }
	?>
	</div>
    </div>
<?php
    include_once "../extentions/footer.php";
?>
	</body>
</html>