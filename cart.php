<?php
include_once "extentions/header.php";
include_once "extentions/bodystart.php";

echo '<div id="mainContent">';
$user_id = $_SESSION['user_id'];
$user_id += 0;

if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes"){
			include_once "extentions/sidebar.php";
			include_once "extentions/dbconnect.php";
			mysql_query("set names 'utf8'");
			$query = "SELECT * FROM Users_db WHERE user_id = '$user_id'";
			$result = mysql_query($query);
			$current =mysql_fetch_row($result);
			echo ' <div id="screen">';
			
			$user= $current[1];
			$firstname=$current [3];
			$lastname=$current [4];
			$mail=$current [7];
			$address=$current [8];
			$age=$current [12];
			$contact_phone=$current [9];
			$accesslvl=$current[10];
			$registered=$current[11];
			
			$query2 = "Select product_db.product_name, product_db.product_id, product_price FROM product_db join tempcart_db on product_db.product_id=tempcart_db.product_id where tempcart_db.user_id = '$user_id'";
			mysql_query("set names 'utf8'");
			$result2 = mysql_query($query2);
			$count=mysql_num_rows($result2);
			if($count < 1){
				echo "Το καλάθι σας είναι άδειο";
			}
			else{
			?>
             
<h4>Προιοντα προς παραγγελεία</h4>
<form  id="cartform" method="post" action="<?=$_SERVER['REQUEST_URI']?>" enctype="application/x-www-form-urlencoded" onSubmit="return validateForm();">
<p>

  <?php
  
			
echo '<script type="text/javascript">
function updatePrice(x)
{
var z=0;
for(i=0;i<'.$count.';i++)
{
var y=document.getElementById("posotita"+i).value;
var x=document.getElementById("timi"+i).value;
var z = z + x * y;
}
document.getElementById("finall_price").value=z;
}
</script>';
			?>
          
<table id="orderedItems"> 
<thead><tr><th>Τίτλος</th><th>Ποσότητα</th><th>Τιμή σε &euro;</th><th>Αφαίρεση</th></tr></thead>
<?php		
			$posotita=1;
  			$i=0;
			
			while($row2=mysql_fetch_row($result2))	{
			if($_SERVER['REQUEST_METHOD']=='POST') {$posotita=$_POST['posotita'.$i];}
				if(i%2==1){
					echo '<tr id="oddline">';
				}
				else{
					echo '<tr id="evenline">';
				}
				echo '<td><a href="'.$_SERVER['PATH_INFO'].'products/product_view.php?product_id='.$row2[1].'">'.$row2[0].'</td>';
				echo '<td><input name="posotita'.$i.'" id="posotita'.$i.'" type="text" value="'.$posotita.'" size="2" maxlength="10" onkeyup="updatePrice()" /></td>';
				echo '<td>'.$row2[2].'<input type="hidden" name="timi'.$i.'" id="timi'.$i.'" value="'.$row2[2].'" readonly="readonly"/></td>';
				echo '<td><a href="DeleteFromCart.php?product_id='.$row2[1].'&user_id='.$user_id.'">'.Ναι.'</td>';
				echo "</tr>";
				$finalprice = $finalprice + $row2[2] * $posotita; 
				$i++;	
			}
			echo '<tr align="center" valign="top">';
			echo '<td>Τελική Τιμή σε &euro;:</td><td><input type="text" name="finall_price" id="finall_price"  value="'.$finalprice.'" readonly="readonly" />';
		echo "</table>";
		

?>
  
  
  

</p>
<p>Στοιχεία Παραγγελίας</p>

<table id="orderData">
  <tr>
    <td><label for "firstname">Όνομα:</label></td>
    <td><input type="text" name="firstname" id="firstname" value="<?=$firstname?>" size="30" maxlength="30"  /></td>
  </tr>
  <tr>
    <td><label for "lastname">Επώνυμο:</label></td>
    <td><input type="text" name="lastname" id="lastname" value="<?=$lastname?>" size="30" maxlength="30" /></td>
  </tr>
  <tr>
    <td><label for "mail">Email:</label></td>
    <td><input type="text" name="mail" id="mail" value="<?=$mail?>" size="30" maxlength="30" /></td>
  </tr>
  <tr>
    <td><label for "address">Διευθυνση:</label></td>
    <td><input type="text" name="address" id="address" value="<?=$address?>" size="30" maxlength="30" /></td>
  </tr>
  <tr>
    <td><label for "contact_phone">Τηλέφωνο:</label></td>
    <td><input type="text" name="contact_phone" id="contact_phone" value="<?=$contact_phone?>" size="30" maxlength="30" /></td>
  </tr>
  <tr>
    <td><label for="for" "case">Συσκευασία:</label></td>
    <td><select name="case">
      <option value='aplo'>Απλή</option>
      <option value='doro'>Δώρο</option>
    </select></td>
  </tr>
  <tr>
    <td><label for="for" "send">Τρόπος Αποστολής:</label></td>
    <td><select name="send">
      <option value='public_mail'> Tαχυδρομίο </option>
      <option value='person_public_mail'> Συστημένο </option>
      <option value='express'> Express </option>
    </select></td>
  </tr>
<tr>
      <td><label for "user">Ημερομηνία Αποστολής:</label></td>
      <td><input class="plain" name="dc" id="dc" value="" size="19"><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.cartform.dc);return false;" ><img class="PopcalTrigger" name="popcal" align="absmiddle" src="scripts/DateTime/calbtn.gif" width="34" height="22" border="0" alt=""></a>
	</td>
    </tr>
  <tr>
    <td colspan="2" style="text-align:center"><input type="submit" name="buy" id="buy" value="Αποστολή παραγγελίας" />
    </td>
  </tr>
</table></form>


<?php 

if($_SERVER['REQUEST_METHOD']=='POST') {
			$case=$_POST['case'];
			$send=$_POST['send'];
			
			$delivery_date="'".$_POST['dc']."'";
			if ($_POST['dc'] ==''){$delivery_date="NOW()";}

			mysql_query("set names 'utf8'");
			$query3 = "SELECT * FROM tempcart_db WHERE user_id= '$user_id'";
			$result3 = mysql_query($query3);
			$i=0;
			while($row3=mysql_fetch_row($result3))	{
			$timi=$_POST['timi'.$i] + 0;
			$quantity=$_POST['posotita'.$i] + 0;
			if($quantity > 0){
				$finalprice=$quantity * $timi;
				mysql_query("set names 'utf8'");
				$agora = "INSERT INTO sales_db ( user_id, product_id, address, tel_num,  delivery_date, finall_price, package, delivery_orders , quantity) VALUES ('$user_id', '$row3[2]', '$address', '$contact_phone', $delivery_date, '$finalprice', '$case','$send', $quantity)";
				mysql_query($agora);
				$update="UPDATE product_db SET  sold = sold + $quantity WHERE product_id = $row3[2]";
				mysql_query($update);
				//echo $agora;
			}
			$i++;
	}

$delete= "DELETE  FROM tempcart_db WHERE user_id = '$user_id'";
mysql_query($delete);
echo '<meta http-equiv="refresh" content="0;http://weblab.teipir.gr/~www33175/order.php"';
}
}
?>
</div>
<?php
}else{
echo "<div id=\"mainContent\"><div id=\"screen\">Σελίδα που χρειάζεται διαπίστευση - Permission Denied</div></div>";
}
echo '</div>';	
include_once "extentions/footer.php";			
?>
<iframe width=188 height=166 name="gToday:datetime:agenda.js:gfPop:plugins_time.js" id="gToday:datetime:agenda.js:gfPop:plugins_time.js" src="scripts/DateTime/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>

</body>
</html>