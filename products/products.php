<?php
require_once "../extentions/sitesettings.php";
include_once "../extentions/header.php";
include_once "../extentions/bodystart.php";
include_once "../extentions/dbconnect.php";

echo '<div id="mainContent">';	
$product_type= $_GET['product_type'];
if ($product_type=='book'){$product_echo='Βιβλία';}else{$product_echo='CD';}
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "../extentions/sidebar.php";
							}
echo '<div id="screen">';							
	
mysql_query("set names 'utf8'");
if ($_GET[onSales]=='true'){
$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND onSales = 'true' AND availability = 'true'"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		if($_GET['page'] == ''){$i=0;}else{ $i= ($_GET['page']-1) * 4;}
		$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND onSales = 'true' AND availability = 'true' limit $i,4"; 
		$result = mysql_query($query);
		           
            $pages = ($count / 4);
            
            if($pages>1){
			echo '<div id="page">
			Σελίδες: ';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&onSales=true&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
            }
			echo '</div>';
			}
	
	$i=0;
			echo '<h2>'.$product_echo.' σε προσφορά</h2>';
			while($row=mysql_fetch_row($result)){
			$i++;	
			echo '<div class="product">
			<div class="proddescr">
				<h6 class="productlabel">Τίτλος</h6><h3 class="productlabelvalue"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">'.$row[1].'</a></h3><br clear="all">
				<h6 class="productlabel">'; if ($product_type=='book'){echo 'Συγγραφέας';}else{echo 'Ερμηνευτής';} echo '</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[2])).'</h3><br clear="all">
				<h6 class="productlabel">Κατηγορία</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[5])).'</h3><br clear="all">
				<h6 class="productlabel">Τιμή</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[6])).'&euro;</h3><br>
				<h6 class="moreinfo"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">Περισσότερα</a></h6>
			</div>
			<div class="icons">';
				if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
					echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&onSales=true&add='.$row[0].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="../images/shop.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
					}
				if($row[7]=="true"){echo '<img src="../images/onsales.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';}
				if($row[8]=="true"){echo '<img src="../images/bestseller1.gif" title="Bestseller" alt="Bestseller">';}
				echo '</div>
			</div>';
				if(!($i%2)){
					echo '<hr />';
				}
    		}	
			
		

			 if($pages>1){
			echo '<div id="page">
			Σελίδες: ';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&onSales=true&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
            }	
			echo '</div></div>';
			}
    }
	
	
	elseif ($_GET[bestSeller]=='true'){
$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND bestSeller = 'true' AND availability = 'true'"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		if($_GET['page'] == ''){$i=0;}else{ $i= ($_GET['page']-1) * 4;}
		
		$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND bestSeller = 'true' AND availability = 'true' limit $i,4"; 
		$result = mysql_query($query);
		
            
            $pages = ($count / 4);
            
			 if($pages>1){
			echo '<div id="page">
			Σελίδες: ';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&bestSeller=true&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
            }
			echo '</div>';
			}	
		
		echo '<h2>'.$product_echo.' Best Seller</h2>';
			while($row=mysql_fetch_row($result)){
			$i++;	
			echo '<div class="product">
			<div class="proddescr">
				<h6 class="productlabel">Τίτλος</h6><h3 class="productlabelvalue"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">'.$row[1].'</a></h3><br clear="all">
				<h6 class="productlabel">'; if ($product_type=='book'){echo 'Συγγραφέας';}else{echo 'Ερμηνευτής';} echo '</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[2])).'</h3><br clear="all">
				<h6 class="productlabel">Κατηγορία</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[5])).'</h3><br clear="all">
				<h6 class="productlabel">Τιμή</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[6])).'&euro;</h3><br>
				<h6 class="moreinfo"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">Περισσότερα</a></h6>
			</div>
			<div class="icons">';
				if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
					echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&bestSeller=true&add='.$row[0].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="../images/shop.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
					}
				if($row[7]=="true"){echo '<img src="../images/onsales.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';}
				if($row[8]=="true"){echo '<img src="../images/bestseller1.gif" title="Bestseller" alt="Bestseller">';}
				echo '</div>
			</div>';
				if(!($i%2)){
					echo '<hr />';
				}
    		}	
			 if($pages>1){
			echo '<div id="page">
			Σελίδες: ';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&bestSeller=true&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
            }
			echo '</div>';
			}	
				
    }
	

else
{
		$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND availability = 'true'"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		if($_GET['page'] == ''){$i=0;}else{ $i= ($_GET['page']-1) * 4;}
		
		$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND availability = 'true' limit $i,4"; 
		$result = mysql_query($query);
		            
            $pages = ($count / 4);
            
			 if($pages>1){
				echo '<div id="page">
					Σελίδες: ';
					$tmp=0;
	            for ($j=0;$j<$pages;$j++){
      		          $tmp = $j + 1;
            		  echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
           		}
				echo '</div>';
			}
			
			echo '<h2>'.$product_echo.'</h2>';
			while($row=mysql_fetch_row($result)){
					$i++;	
					echo '<div class="product">
					<div class="proddescr">
				<h6 class="productlabel">Τίτλος</h6><h3 class="productlabelvalue"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">'.$row[1].'</a></h3><br clear="all">
				<h6 class="productlabel">'; if ($product_type=='book'){echo 'Συγγραφέας';}else{echo 'Ερμηνευτής';} echo '</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[2])).'</h3><br clear="all">
				<h6 class="productlabel">Κατηγορία</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[5])).'</h3><br clear="all">
				<h6 class="productlabel">Τιμή</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[6])).'&euro;</h3><br>
				<h6 class="moreinfo"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">Περισσότερα</a></h6>
			</div>
			<div class="icons">';
					if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
							echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&add='.$row[0].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="../images/shop.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
					}
					
					if($row[7]=="true"){echo '<img src="../images/onsales.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';}
					if($row[8]=="true"){echo '<img src="../images/bestseller1.gif" title="Bestseller" alt="Bestseller">';}
					echo '</div></div>';
					if(!($i%2)){echo '<hr />';}
    		}	
		  	if($pages>1){
			echo '<div id="page">
			Σελίδες: ';
			$tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
            }
			echo '</div>';
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
include_once "../extentions/footer.php";
?>
</body>
</html>