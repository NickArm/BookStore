<?php 
	include_once "../extentios/header.php";
	include_once "../extentios/bodystart.php";
	include_once "../extentios/dbconnect.php";
	
	if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "../extentios/sidebar1.php";
			}
	echo '<div id="mainContent">';
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == "yes" && $_SESSION['accesslvl'] == 'Administrator') {					
								
				$title='';
				$author='';
				$description='';
				$product_serial='';
				$product_category='';
				$price='';
				$product_type='';
				$onSales='';
				$bestSeller='';
				$availability='';
				
				
				$title=$_POST['title'];
				$author=$_POST['author'];
				$description=$_POST['description'];
				$product_serial=$_POST['product_serial'];
				$product_category=$_POST['product_category'];
				$price=$_POST['price'];
				$product_type=$_POST['product_type'];
				$onSales=$_POST['onSales'];
				if (!isset($onSales)){ $onSales="false";}
				$bestSeller=$_POST['bestSeller'];
				if (!isset($bestSeller)){ $bestSeller="false";}
				$availability=$_POST['availability'];
				if (!isset($availability)){ $availability="false";}
				
				$PageTitle='Εισαγωγή νέου προϊόντος';
				if($_SERVER['REQUEST_METHOD']=='POST') {
						mysql_query("set names 'utf8'");
						$query="SELECT * FROM product_db where product_name='".$title."' AND author='".$author."'";
						$existing_product=mysql_query($query);
						$count=mysql_num_rows($existing_product);
						if($count==0) { 
							$query="INSERT INTO product_db ( product_name , author , product_desc , product_serial , product_category , product_price , onSales , bestSeller , product_type , availability , createdate) VALUES( '$title' , '$author' , '$description' ,  '$product_serial' , '$product_category' , '$price' , '$onSales' , '$bestSeller' , '$product_type' , '$availability' , NOW())";
							mysql_query($query);
	
?>
                                <table align="center">
                                    <tr><td><p class="info_text"><strong>Το βιβλίο με τίτλο "<?=$title?>" προστέθηκε.<br/>
                                            Μπορείτε να συνεχίσετε.</strong></p></td>
                                    </tr>
                                </table>

				<?php /*header('Refresh: 10; URL=http://weblab.teipir.gr/~www33175/products/product_insert.php');*/
						}else{ ?>
                            <table align="center">
                                <tr>
                                <td class="vmiddle"><p class="error_text"><strong>ΠΡΟΣΟΧΗ! <br /> Το βιβλίο  με τίτλο <strong><?=$title?></strong>υπαρχει ήδη.</strong></p></td>
                                </tr>
                            </table>
<?php
						}
			}
			

?>
<form name="product_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" onsubmit="return ValidateProduct();">
    <table align="center" border="0" cellpadding="1">
        <thead><tr><th colspan="2" align="left">Μοναδικός αριθμός προϊόντος  <?php echo $ID?></th></tr></thead>
        <tbody><tr><td> Τίτλος </td><td>
                    <input type="text" name="title" id="title" size="30" value="<?=$title?>"/>
                </td></tr><tr><td id="productForm"> Συγγραφέας </td><td>
                    <input type="text" name="author" id="author" size="30" value="<?=$author?>"/>
                </td></tr><tr><td id="productForm"> Κατηγορία </td><td>
                    <input type="text" name="product_category" id="product_category" size="30" value="<?=$product_category?>"/>
                </td></tr><tr><td  valign="top" id="productForm"> Περιγραφή </td><td>
                    <textarea name="description" id="description" rows="5" cols="26"><?=$description?></textarea>
                </td></tr><tr><td id="productForm">Σειριακός αριθμός / ISBN </td><td>
                    <input type="text" name="product_serial" id="product_serial" size="30"  value="<?=$product_serial?>"/>
                </td></tr><tr><td>Τιμή</td><td>
                    <input type="text" name="price" id="price" size="30" value="<?=$price?>"/> &euro
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
                    <input type="submit" value="Καταχώρηση" name="add" /></td>
            </tr>
            
        </tbody>
    </table>
</form>
<script type="text/javascript" language="javascript">
        function ValidateProduct(){
            if((document.getElementById('title').value=="") || (document.getElementById('author').value=="")){
                alert("Παρακαλώ εισάγετε όλα τα απαιτούμενα στοιχεία");
                return false;
            }else
                return true;
        }
</script>
<?php
}
else {
		echo "Access Denied";
		}
		echo "</div>";
		include_once "../extentios/footer.php";
		?>
</body>
</html>