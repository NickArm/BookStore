<?php

include_once "../extentios/header.php";
include_once "../extentios/bodystart.php";
include_once "../extentios/dbconnect.php";

$product_type= $_GET['product_type'];

if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "../extentios/sidebar1.php";
							}
							
echo '<div id="mainContent">';				
mysql_query("set names 'utf8'");

if ($_GET[onSales]=='true'){
$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND onSales = 'true'"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		if($_GET['page'] == ''){$i=0;}else{ $i= ($_GET['page']-1) * 4;}
		$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND onSales = 'true' limit $i,4"; 
		$result = mysql_query($query);
		           
            $pages = ($count / 4);
            
            echo '<div id="page">';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&onSales=true&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
            }
			
			
				
		while($row=mysql_fetch_row($result)){
			
				echo '<h2 class="'.$row[0].'title"><a href="product_view.php?product_id='.$row[0].'">'.$row[1].'</a></h2>';
				echo '<div class="category">Κατηγορία: '. stripslashes(nl2br($row[9])).'</div>';
				echo '<div class="author">Συγγραφέας/Καλλιτέχνης: '. stripslashes(nl2br($row[2])).'</div>';
				echo '<div class="price">Τιμή: '.stripslashes(nl2br($row[6])).'&euro</div>';
				echo '<div class="serial">Serial: '.stripslashes(nl2br($row[4])).'</div>';
				}
			 echo '<div id="page">';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&onSales=true&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
            }	
				
    }
	
	
	elseif ($_GET[bestSeller]=='true'){
$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND bestSeller = 'true'"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		if($_GET['page'] == ''){$i=0;}else{ $i= ($_GET['page']-1) * 4;}
		
		$query="SELECT * FROM product_db WHERE product_type = '$product_type' AND bestSeller = 'true' limit $i,4"; 
		$result = mysql_query($query);
		
            
            $pages = ($count / 4);
            
			echo '<div id="page">';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&bestSeller=true&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
           			echo '&nbsp;';
				
            }
			echo '</div>';	
		
		while($row=mysql_fetch_row($result)){
			
				echo '<h2 class="'.$row[0].'title"><a href="product_view.php?product_id='.$row[0].'">'.$row[1].'</a></h2>';
				echo '<div class="category">Κατηγορία: '. stripslashes(nl2br($row[9])).'</div>';
				echo '<div class="author">Συγγραφέας/Καλλιτέχνης: '. stripslashes(nl2br($row[2])).'</div>';
				echo '<div class="price">Τιμή: '.stripslashes(nl2br($row[6])).'&euro</div>';
				echo '<div class="serial">Serial: '.stripslashes(nl2br($row[4])).'</div>';
				
				}
			echo '<div id="page">';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&bestSeller=true&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
            	echo '&nbsp;';
				
            }
			echo '</div>';		
				
    }
	

else
{
		$query="SELECT * FROM product_db WHERE product_type = '$product_type'"; 
		$result = mysql_query($query);
		$count=mysql_num_rows($result);
		if($_GET['page'] == ''){$i=0;}else{ $i= ($_GET['page']-1) * 4;}
		
		$query="SELECT * FROM product_db WHERE product_type = '$product_type' limit $i,4"; 
		$result = mysql_query($query);
		            
            $pages = ($count / 4);
            
			 echo '<div id="page">';
			 $tmp=0;
            for ($j=0;$j<$pages;$j++){
                $tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
				echo '&nbsp;';
				
            }
			echo '</div>';
			
		while($row=mysql_fetch_row($result)){
			
				echo '<h2 class="'.$row[0].'title"><a href="product_view.php?product_id='.$row[0].'">'.$row[1].'</a></h2>';
				echo '<div class="category">Κατηγορία: '. stripslashes(nl2br($row[9])).'</div>';
				echo '<div class="author">Συγγραφέας/Καλλιτέχνης: '. stripslashes(nl2br($row[2])).'</div>';
				echo '<div class="price">Τιμή: '.stripslashes(nl2br($row[6])).'&euro</div>';
				echo '<div class="serial">Serial: '.stripslashes(nl2br($row[4])).'</div>';
						
   		 }
		 echo '<div id="page">';
		 $tmp=0;
	 for ($j=0;$j<$pages;$j++){
	 			$tmp = $j + 1;
                echo '<a href="http://weblab.teipir.gr/~www33175/products/products.php?product_type='.$product_type.'&page='.$tmp.'" title="Επόμενη Σελίδα">'.$tmp.'</a>';
				echo '&nbsp;';
				
            }
			echo '</div>';	
}			
echo '</div>';
include_once "../extentios/footer.php";
?>
</body>
</html>