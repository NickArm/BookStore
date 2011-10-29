<?php

include_once "../extentios/header.php";
include_once "../extentios/bodystart.php";
include_once "../extentios/dbconnect.php";
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "../extentios/sidebar1.php";
			}
$product_id= $_GET['product_id']+0;
$user_id = $_SESSION['user_id'];     
		mysql_query("set names 'utf8'");
		$query="SELECT * FROM product_db WHERE product_id = '$product_id'"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		
		while($row=mysql_fetch_row($result)){
			
				echo '<h2 class="'.$row[0].'title"><a href="http://weblab.teipir.gr/~www33175/products/product_view.php?product_id='.$row[0].'">'.$row[1].'</a></h2>';
				echo '<div class="author">Κατηγορία: '. stripslashes(nl2br($row[9])).'</div>';
				echo '<div class="author">Συγγραφέας/Καλλιτέχνης: '. stripslashes(nl2br($row[2])).'</div>';
				echo '<div class="price">Τιμή: '.stripslashes(nl2br($row[6])).'&euro</div>';
				echo '<div class="price">Serial: '.stripslashes(nl2br($row[4])).'</div>';
				echo '<div class="description"><u>Περιγραφή:</u> <p>'.stripslashes(nl2br($row[3])).'</p></div>';
				
    }
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {

			if($_SERVER['REQUEST_METHOD']=='POST') {
							$query="INSERT INTO tempcart_db (user_id, product_id) VALUES ('$user_id', '$product_id')";
							mysql_query($query);
				}
	
	$query="SELECT * FROM tempcart_db WHERE user_id = '$user_id' AND product_id='$product_id'";
	$result=mysql_query($query);
	$count=mysql_num_rows($result);
	if ($count == 1){
?>	
<form name="form1" method="post" action="<?='http://weblab.teipir.gr/~www33175/DeleteFromCart.php?product_id='.$product_id.'&user_id='.$_SESSION['user_id']?>">
  <label>
  <input type="submit" name="cart" id="cart" value="Αφαίρεση από το καλάθι"onSubmit="sales" />
  </label>
</form>
<?php 
	}else{
?>
		
<form name="form1" method="post" action="<?=$_SERVER['REQUEST_URI']?>">
  <label>
  <input type="submit" name="cart" id="cart" value="Προσθήκη Στο Καλάθι"onSubmit="sales" />
  </label>
</form>


<?php
	}	
}
?>