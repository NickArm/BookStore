<?php
include_once "../extentios/header.php";
include_once "../extentios/dbconnect.php";
include_once "../extentios/bodystart.php";

if($_SERVER['REQUEST_METHOD']=='POST' && $_SESSION['accesslvl'] == 'Administrator') {
			
				
				$product_id=$_POST['product_id'];
				$product_name=$_POST['product_name'];
				$author=$_POST['author'];
				$product_desc=$_POST['product_desc'];
				$product_serial=$_POST['product_serial'];
				$product_category=$_POST['product_category'];
				$product_price=$_POST['product_price'];
				$onSales=$_POST['onSales'];
				$bestSeller=$_POST['bestSeller'];
				$product_type=$_POST['product_type'];
				$sold=$_POST['sold'];
				$availability=$_POST['availability'];
				if (!isset($onSales)){ $onSales="false";}
				if (!isset($bestSeller)){ $bestSeller="false";}
				if (!isset($availability)){ $availability="false";}
				$query="UPDATE product_db SET product_name='$product_name',author='$author',product_desc='$product_desc', product_serial='$product_serial',product_category='$product_category',product_price='$product_price',onSales='$onSales', bestSeller='$bestSeller', product_type='$product_type', sold='$sold' , availability='$availability' WHERE product_id='$product_id' ";
				mysql_query("set names 'utf8'");
				mysql_query($query); 
				echo '<meta http-equiv="refresh" content="1;http://weblab.teipir.gr/~www33175/products/products_preview.php"';
				   }
			   

if (isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes" && $_SESSION['accesslvl'] == 'Administrator') {
include_once "../extentios/sidebar1.php";
echo '<div id="mainContent">';
									
			$product_id= $_GET['product_id']+0;
			$product_serial= $_GET['product_serial'];
			$product_name= $_GET['product_name'];						
			mysql_query("set names 'utf8'");
			$query = "SELECT * FROM product_db WHERE product_id = '$product_id' OR product_serial = '$product_serial' OR product_name = '$product_name'";
			$result = mysql_query($query);
			$current =mysql_fetch_row($result);
			
			$product_id= $current[0];
			$product_name= $current[1];
			$author=$current[2];
			$product_desc=$current[3];
			$product_serial=$current[4];
			$product_category=$current[5];
			$product_price=$current[6];
			$onSales=$current[7];
			$bestSeller=$current[8];
			$product_type=$current[9];
			$sold=$current[10];
			$availability=$current[11];

			if ( $availability == "true"){
?>
<script type="text/javascript" language="javascript1.5">
function validateForm(){
if (document.getElementById('product_name').value==''){
alert('Ο τίτλος δεν μπορεί να είναι κενός.');
return false;
}
if (document.getElementById('author').value==''){
alert('Ο Συγγραφέας/Καλλιτέχνις δεν μπορεί να είναι κενός.');
return false;
}
if (document.getElementById('product_serial').value==''){
alert('Ο μοναδικός αριθμός δεν μπορεί να είναι κενός.');
return false;
}
if (document.getElementById('product_category').value==''){
alert('Η κατηγορία δεν μπορεί να είναι κενή.');
return false;
}
return true;
}
</script>
<form name="product_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" onsubmit="return ValidateProduct();">
    <table align="center" border="0" cellpadding="1">
        <thead><tr><th>Μοναδικός αριθμός προϊόντος   <?php echo $product_id?></th>
        <input type="hidden" name="product_id" id="product_id" value="<?=$product_id?>"/></tr></thead>
        <tbody><tr><td> Τίτλος </td><td>
                    <input type="text" name="product_name" id="product_name" size="30" value="<?=$product_name?>"/>
                </td></tr><tr><td id="productForm"> Συγγραφέας </td><td>
                    <input type="text" name="author" id="author" size="30" value="<?=$author?>"/>
                </td></tr><tr><td id="productForm"> Κατηγορία </td><td>
                    <input type="text" name="product_category" id="product_category" size="30" value="<?=$product_category?>"/>
                </td></tr><tr><td  valign="top" id="productForm"> Περιγραφή </td><td>
                    <textarea name="product_desc" id="product_desc" rows="10" cols="27"><?=$product_desc?></textarea>
                </td></tr><tr><td id="productForm">Σειριακός αριθμός / ISBN </td><td>
                    <input type="text" name="product_serial" id="product_serial" size="15"  value="<?=$product_serial?>"/>
                </td></tr><tr><td>Τιμή</td><td>
                    <input type="text" name="product_price" id="product_price" size="10" value="<?=$product_price?>"/> &euro
                </td></tr><tr><td id="productForm">Αριθμός πωληθέντων προϊόντων </td><td>
                    <input type="text" name="sold" id="sold" size="10"  value="<?=$sold?>"/>
                </td></tr><tr><td id="productForm">Είδος </td>
              <td>
                    <select name="product_type" id="product_type">
                        <option value="cd" <?php if ($product_type=="cd"){ echo 'selected="selected"'; }?>>CD</option>
                        <option value="book"<?php if ($product_type=="book"){ echo 'selected="selected"'; }?>>Book</option>
                    </select>
                </td></tr><tr><td id="productForm">Σε προσφορά</td><td>
                    <input type="checkbox" name="onSales" value="true" id="onSales"
                    <?php if ($onSales == "true"){echo 'checked="checked"';} ?>
                    />
                </td></tr><tr><td id="productForm">Best Seller</td><td>
                    <input type="checkbox" name="bestSeller" value="true" id="bestSeller"
                    <?php
                    if ($bestSeller == "true"){echo 'checked="checked"';}
                    ?>
                    />
                </td></tr><tr><td id="productForm">Διαθέσιμο</td><td>
                <input type="checkbox" name="availability" value="true" id="availability"
                    <?php
                    if ($availability == "true"){echo 'checked="checked"';}
                    ?>
                    />
                </td></tr>
        			<tr><td colspan="2" style="text-align:center"><input type="reset"  value="Καθαρισμός" />
                    <input type="submit" value="Ενημέρωση" name="update" /></td>
            </tr>
        </tbody>
    </table>
</form>
<form name="deleteForm" action="product_delete.php" method="post">
  <p align="center">Διαγραφή προϊόντος με ID <?php echo $product_id;?> δεν διαγράφεται απο την βάση δεδομένων </p>
  <p align="center">αλλα παραμένει ανενεργό </p>
  <div align="center">
  	<input type="hidden" name="productDelete" id="productDelete" value="<?=$product_id?>" />
    <input type="submit" name="delete_product" id="delete_product" value="Διαγραφή"/>
    <input type="hidden" name="availability" id="availability" value="<?=$availability?>" />
  </div>
</form>

<?php 
			}else{
				?>
                <form name="deleteForm" action="product_delete.php" method="post">
  <p align="center">Επαναφορά προϊόντος με ID <?php echo $product_id;?> απο την βάση δεδομένων ;</p>
 <div align="center">
 	<input type="hidden" name="productDelete" id="productDelete" value="<?=$product_id?>" />
    <input type="submit" name="delete_product" id="delete_product" value="Επαναφορά "/>
    <input type="hidden" name="availability" id="availability" value="<?=$availability?>" />
  </div>
</form>
<?php
		} 		
}else{
		echo "<p><strong>Permission Denied</strong></p><p>Χρειάζεται διαπίστευση για να δείτε αυτή την Σελίδα</p>";
		}
	echo "</div>";	
    include_once "../extentios/footer.php";
?>
</body>
</html>