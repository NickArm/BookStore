<?php
include_once "../extentios/header.php";
include_once "../extentios/dbconnect.php";
include_once "../extentios/bodystart.php";

$user_id= $_GET['user_id']+0;     /* pernei to user_id apo to users_preview */
if ($_SESSION['accesslvl'] != 'Administrator'){$user_id=$_SESSION['user_id'] + 0;}
if($_SERVER['REQUEST_METHOD']=='POST') {
			
				$pass=$_POST['pass'];
				$passconfirm=$_POST['passconfirm'];
				$firstname=$_POST['firstname'];
				$lastname=$_POST['lastname'];
				$mail=$_POST['mail'];
				$address=$_POST['address'];
				$age=$_POST['age'];
				$contact_phone=$_POST['contact_phone'];
				$edu=$_POST['edu'];
				$sex=$_POST['sex'];
				$accesslvl=$_POST['accesslvl'];
			
			if($pass==$passconfirm){
												
				$query="UPDATE Users_db SET password=MD5($pass),firstname='$firstname',lastname='$lastname', mail='$mail',address='$address',age='$age',contact_phone='$contact_phone', edu='$edu', sex='$sex', accesslvl='$accesslvl' WHERE user_id='$user_id' ";
				mysql_query("set names 'utf8'");
				mysql_query($query); 
				echo '<meta http-equiv="refresh" content="1;http://weblab.teipir.gr/~www33175/users/users_preview.php?msg=ok"/>';
				}
				   else { echo '<meta http-equiv="refresh" content="1;http://weblab.teipir.gr/~www33175/users/users_preview.php?msg=wrongpass"/>';
				}
		}
		
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes" ) {
				
			include_once "../extentios/sidebar1.php";
			
			echo '<div id="mainContent">';			
						
			mysql_query("set names 'utf8'");
			$query = "SELECT * FROM Users_db WHERE user_id = '$user_id'";
			$result = mysql_query($query);
			$current =mysql_fetch_row($result);

			$user= $current[1];
			$pass=$current [2];
			$passconfirm=$current [2];
			$firstname=$current [3];
			$lastname=$current [4];
			$mail=$current [7];
			$address=$current [8];
			$age=$current [12];
			$contact_phone=$current [9];
			$edu=$current [14];
			$sex=$current [13];
			$accesslvl=$current[10];
			$registered=$current[11];
			
			if ( $registered == "true"){
?>
<script type="text/javascript" language="javascript">
function validateForm(){
if (document.getElementById('firstname').value==''){
alert('Το όνομα του χρήστη δεν μπορεί να είναι κενό.');
return false;
}
if (document.getElementById('lastname').value==''){
alert('Το επώνυμο του χρήστη δεν μπορεί να είναι κενό.');
return false;
}
if (document.getElementById('user').value==''){
alert('Το επυθυμητό όνομα χρήστη δεν μπορεί να είναι κενό.');
return false;
}
if (document.getElementById('mail').value==''){
alert('Το e-mail δεν μπορεί να είναι κενό.');
return false;
}

if (document.getElementById('pass').value=='' || (document.getElementById('pass').length <'5' ){
alert('Ο κωδικός πρέπει να περιέχει 6 ψηφία  το λιγότερο.');
return false;
}

if (document.getElementById('pass').value != document.getElementById('passconfirm').value){
alert('Οι εισαχθέντες κωδικοί δεν ταιρίαζουν.');
return false;
}
return true;
}
</script>

<form  id="usereditForm" method="post" action="<?=$_SERVER['REQUEST_URI']?>" enctype="application/x-www-form-urlencoded" onSubmit="return validateForm();">
  <table style="width:450px"; margin-left:5px; border="1px solid #C0C0C0;">
  	<tr>
      <td><label for "user">Όνομα Χρήστη:</label></td>
      <td><input type="text" name="user" id="user" value="<?=$user?>" size="16" maxlength="16"  readonly="readonly"/></td>
    </tr>
    <tr>
      <td><label for "pass"><span class="mast">*</span>Κωδικός Χρήστη:</label></td>
      <td><input type="password" name="pass" id="pass" value="<?=$pass?>" size="16" maxlength="16" /></td>
    </tr>
    <tr>
      <td><label for "passconfirm"><span class="mast">*</span>Κωδικός Χρήστη (Επιβεβαίωση):</label></td>
      <td><input type="password" name="passconfirm" id="passconfirm" value="<?=$passconfirm?>" size="16" maxlength="16" /></td>
    </tr>
    <tr>
      <td><label for "firstname"><span class="mast">*</span>Όνομα:</label></td>
      <td><input type="text" name="firstname" id="firstname" value="<?=$firstname?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "lastname"><span class="mast">*</span>Επώνυμο:</label></td>
      <td><input type="text" name="lastname" id="lastname" value="<?=$lastname?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "mail"><span class="mast">*</span>Email:</label></td>
      <td><input type="text" name="mail" id="mail" value="<?=$mail?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "address"><span class="mast">*</span>Διευθυνση:</label></td>
      <td><input type="text" name="address" id="address" value="<?=$address?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "contact_phone">Τηλέφωνο:</label></td>
      <td><input type="text" name="contact_phone" id="contact_phone" value="<?=$contact_phone?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "age">Ηλικία:</label></td>
      <td><input type="text" name="age" id="age" value="<?=$age?>" size="4" maxlength="4" /></td>
    </tr>
    <tr>
      <td><label for "edu">Εκπαίδευση:</label></td>
      <td><select name="edu">
        <option value='1o level'<?php if ($accesslvl == "1o level") {echo 'selected == "selected"';}?>>1ο βάθμια</option>
        <option value='2o level'<?php if ($accesslvl == "2o level") {echo 'selected == "selected"';}?>>2ο βάθμια</option>
        <option value='university'<?php if ($accesslvl == "university") {echo 'selected == "selected"';}?>>Ακαδημαϊκή</option>
        <option value='Master'<?php if ($accesslvl == "Master") {echo 'selected == "selected"';}?>>Μεταπτυχικό</option>
        </select></td>
    </tr>
    <tr>
      <td><label for "sex">Φύλο:</label></td>
      <td><select name="sex">
    	<option value='male'<?php if ($accesslvl == "male") {echo 'selected == "selected"';}?>> Άρρεν </option>
    	<option value='female'<?php if ($accesslvl == "female") {echo 'selected == "selected"';}?>> Θύλην </option></select></td>
     </tr>
     <?php if ($_SESSION['accesslvl'] == 'Administrator') {?>
	<tr>
      <td><label for "sex">Δικαιώματα:</label></td>
      <td>
      <select name="accesslvl"> 
    	<option value='User' <?php if ($accesslvl == "User") {echo 'selected == "selected"';}?>> User </option>
    	<option value='Author'<?php if ($accesslvl == "Author") {echo 'selected == "selected"';}?>> Author </option>
        <option value='Administrator'<?php if ($accesslvl == "Administrator") {echo 'selected == "selected"';}?>> Administrator </option></select></td
     ></tr><?php } ?>
   	
    <tr>
     	<td colspan="2" style="text-align:center"><input type="submit" name="update" id="Update" value="Update" />
        </td>
    </tr>    
  </table>
</form>
<form name="deleteForm" action="user_delete.php" method="post">
  <p align="center">Με την επιλογή διαγραφή ο χρήστης με ID <?php echo $user_id;?> δεν διαγράφεται απο την βάση δεδομένων </p>
  <p align="center">αλλα παραμένει ανενεργός και μονο </p>
  <p align="center">ο Διαχειριστης μπορεί να τον ξανα-ενεργοποιήσει  </p>
  <div align="center">
  	<input type="hidden" name="userDelete" id="userDelete" value="<?=$user_id?>" />
    <input type="submit" name="delete_user" id="delete_user" value="Διαγραφή Χρήστη"/>
    <input type="hidden" name="userRegistered" id="userRegistered" value="<?=$registered?>" />
  </div>
</form>

<?php 
			}else{
				?>
                <form name="deleteForm" action="user_delete.php" method="post">
  <p align="center">Επαναφορά χρήστη με ID <?php echo $user_id;?> απο την βάση δεδομένων ;</p>
 <div align="center">
 	<input type="hidden" name="userDelete" id="userDelete" value="<?=$user_id?>" />
    <input type="submit" name="delete_user" id="delete_user" value="Επαναφορά Χρήστη"/>
    <input type="hidden" name="userRegistered" id="userRegistered" value="<?=$registered?>" />
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