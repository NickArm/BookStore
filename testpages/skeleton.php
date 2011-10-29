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
			include_once "../extentios/dbconnect.php";
			mysql_query("set names 'utf8'");
			$query="SELECT * FROM product_db ORDER BY createdate DESC LIMIT 10"; 
			$result = mysql_query($query);
			$count=mysql_num_rows($result);
			$i=0;
			while($row=mysql_fetch_row($result)){
			$i++;	
			echo '<div class="product">
			<div class="proddescr">
				<h6 class="productlabel">Τίτλος</h6><h3 class="productlabelvalue"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">'.$row[1].'</a></h3><br clear="all">
				<h6 class="productlabel">Συγγραφέας</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[2])).'</h3><br clear="all">
				<h6 class="productlabel">Κατηγορία</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[5])).'</h3><br clear="all">
				<h6 class="productlabel">Τιμή</h6><h3 class="productlabelvalue">'. stripslashes(nl2br($row[6])).'&euro;</h3><br>
				<h6 class="moreinfo"><a href="product_view.php?product_id='.$row[0].'" title="'.$row[1].'">Περισσότερα</a></h6>
			</div>
			<div class="icons">';
				if(isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes"){
					echo '<a href="'.$_SERVER['REQUEST_URI'].'" title="Προσθήκη στο Καλάθι Αγορών"><img src="imageA.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
				}
				if($row[7]=="true"){echo '<img src="saleOrange.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';}
				if($row[8]=="true"){echo '<img src="bestseller1.gif" title="Bestseller" alt="Bestseller">';}
				echo '</div>
			</div>';
				if(!($i%2)){
					echo '<hr />';
				}
				
			/*	<div clas="product">';
				echo '<h2 class="'.$row[0].'title"><a href="product_view.php?product_id='.$row[0].'">'.$row[1].'</a></h2>';
				echo '<div class="author">Συγγραφέας/Καλλιτέχνης: '. stripslashes(nl2br($row[2])).'</div>';
				echo '<div class="description"><u>Περιγραφή:</u> <p>'.stripslashes(nl2br($row[3])).'</p></div>';
				echo '<div class="price">Τιμή: '.stripslashes(nl2br($row[6])).'&euro</div>';*/
    		}			
			?>
        </div> 
     </div>
</div>           
</body>
</html>
