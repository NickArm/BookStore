<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" href="basicstyle.css" rel="stylesheet" />
<title>Untitled Document</title>
</head>
<body>
<div id="container">
	<div id="header"></div>
    <div id="maincontainer">
    	<div id="sidebar"></div>
        <div id="screen">
        	<?php
			include_once "../extentions/dbconnect.php";
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
					echo '<a href="'.$_SERVER['REQUEST_URI'].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="imageA.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
				}
				if($row[7]=="true"){echo '<img src="saleOrange.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';}
				if($row[8]=="true"){echo '<img src="bestseller1.gif" title="Bestseller" alt="Bestseller">';}
				if(isset($_SESSION['accesslvl'])&& $_SESSION['accesslvl']=="Administrator" && $_SESSION['authenticated'] == "yes"){
					echo '<a href="../products/product_edit.php?product_id='.$row[0].'" title="Επεξεργασία προϊόντος"><img src="edititem.gif" alt="Επεξεργασία προϊόντος"></a>';
				}
				echo '</div>
			<div class="descrition">
				<h6 class="productlabel">Περιγραφή</h6><p class="productlabelvalue">'. stripslashes(nl2br($row[3])).'</p><br clear="all">
			</div>
			<div class="icons">';
				if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
					
					
					if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {

								/*if($_SERVER['REQUEST_METHOD']=='POST') {
												$query="INSERT INTO tempcart_db (user_id, product_id) VALUES ('$user_id', '$product_id')";
												mysql_query($query);
									}*/
						
						$query="SELECT * FROM tempcart_db WHERE user_id = '$user_id' AND product_id='$product_id'";
						$result=mysql_query($query);
						$count=mysql_num_rows($result);
						if ($count == 1){
							echo '<a href="'.$_SERVER['REQUEST_URI'].'" title="Αφαίρεση απο το Καλάθι Αγορών"><img src="imageA.gif" alt="Αφαίρεση απο το Καλάθι Αγορών"></a>';
						}else{
							echo '<a href="'.$_SERVER['REQUEST_URI'].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="imageA.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
						}	
					}					
				}
				echo '</div>
			</div>';				
    }
?>

<?php
$user_id = $_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD']=='POST') {
$query="INSERT INTO tempcart_db (user_id, product_id) VALUES ('$user_id', '$product_id')";
mysql_query($query);
}	
			?>
        </div> 
     </div>
</div>           
</body>
</html>