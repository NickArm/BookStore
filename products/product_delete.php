<?php
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes" && $_SESSION['accesslvl'] == 'Administrator') {
		include_once "../extentions/dbconnect.php";

		$product_id= $_POST['productDelete'] + 0;
		$availability=$_POST['availability'];
		if($_SERVER['REQUEST_METHOD']=='POST') {
				if ($availability == "true"){
						$query="UPDATE product_db SET availability='false' WHERE product_id='$product_id' ";
						mysql_query($query); 
						header("Location:http://weblab.teipir.gr/~www33175/products/products_preview.php");
						//echo "Done Succesfully. Deleted user with id ".$user_id;
				}elseif($availability == "false"){
						$query="UPDATE product_db SET availability='true' WHERE product_id='$product_id' ";
						mysql_query($query); 
						header("Location: $_SERVER[HTTP_REFERER]");
						//header("Location:http://weblab.teipir.gr/~www33175/products/product_edit.php?product_id=".$product_id);
				}
	}
}

?>