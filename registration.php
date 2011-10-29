<?php
	include_once "extentions/header.php";
	include_once "extentions/e-registration.php";
	if($_SERVER['REQUEST_METHOD']=='POST' && ($pass==$passconfirm)) {echo '<meta http-equiv="refresh" content="3;index.php"/>';}	
	include_once "extentions/bodystart.php";
	include_once "extentions/dbconnect.php";
?>
<div id="mainContent">
<?php
if (session_id() == ''){session_start();};
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {	
			include_once "extentions/sidebar.php";
			echo '<div id="screen">';											
			echo "Είστε συνδεδεμένος με το σύστημα ".$_SESSION['username'];
    	}   
	else {
		echo '<div id="screen">';	
$user='';
$pass='';
$passconfirm='';
$firstname='';
$lastname='';
$mail='';
$address='';
$age='';
$contact_phone='';
$edu='';
$sex='';

$user=$_POST['user'];
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



$PageTitle='Εγγραφη Νέου Χρήστη';
if($_SERVER['REQUEST_METHOD']=='POST') {
	if($pass==$passconfirm){
		$query="SELECT * FROM Users_db WHERE username=LCASE('$user')";
		$existing_user=mysql_query($query);
		$count=mysql_num_rows($existing_user);
				if($count==0) { 
				mysql_query("set names 'utf8'");
				$query="INSERT INTO Users_db (username,password,firstname,lastname,createdate,mail,address,contact_phone,age,sex,edu) VALUES(LCASE('$user'),MD5('$pass'),'$firstname','$lastname',NOW(),'$mail','$address','$contact_phone','$age','$sex','$edu')";
				mysql_query($query); 
				$result=mysql_query("SELECT user_id , username , NOW() AS lastlogin FROM Users_db WHERE username=LCASE('$user') AND firstname='$firstname'");
				$record=mysql_fetch_array($result);
							$_SESSION['authenticated'] = "yes";
							$_SESSION['username'] = $record['username'];
							$_SESSION['user_id'] = $record['user_id'];
							$_SESSION['firstname'] = $firstname;
							$_SESSION['lastname'] = $lastname;
							$_SESSION['lastlogin'] = $record['lastlogin'];
							$_SESSION['mail'] = $mail;
							$_SESSION['address'] = $address;
							$_SESSION['contact_phone'] = $contact_phone;
							$_SESSION['accesslvl'] = 'User';
							$_SESSION['registered'] = 'true';
							$_SESSION['age'] = $age;
							$_SESSION['sex'] = $sex;
							$_SESSION['edu'] = $edu;
				$query="Update Users_db SET lastlogin=NOW() where user_id='".$record['user_id']."'"; 
				mysql_query($query);
					
?>
                    <table align="center">
                    	<tr>
                    		<td><p class="info_text"><strong>Ο Χρήστης με όνομα "<?=$user?>" προστέθηκε.<br/>
                    			Μπορείτε να χρησιμοποιήσετε τα στοιχεια για να συνδεθείτε.</strong></p></td>
                    	</tr>
                    </table>

<?php 
}else{
?>
    <table align="center">
        <tr>
        <td class="vmiddle"><p class="error_text"><strong>ΠΡΟΣΟΧΗ! <br /> Ο χρήστης με όνομα <strong><?=$user?></strong> υπαρχει ήδη.</strong></p></td>
        </tr>
    </table>
<?php
		}
	}
}

?>
<script  type="text/javascript" language="javascript">
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
<h4> Παρακαλώ εισάγετε τα απαραίτητα στοιχεία</h4><br clear="all"/>
<form  id="regForm" method="post" action="<?=$_SERVER['REQUEST_URI']?>" enctype="application/x-www-form-urlencoded" onSubmit="return validateForm();">
  <table style="width:450px"; margin-left:5px;   border="1px solid #C0C0C0;">
  	<tr>
      <td><label for "user"><span class="mast">*</span>Όνομα Χρήστη:</label></td>
      <td><input type="text" name="user" id="user" value="<?=$user?>" size="16" maxlength="16" /></td>
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
        <option value='1o level'>1ο βάθμια</option>
        <option value='2o level'>2ο βάθμια</option>
        <option value='university'>Ακαδημαϊκή</option>
        <option value='Master'>Μεταπτυχικό</option>
        </select></td>
    </tr>
    <tr>
      <td><label for "sex">Φύλο:</label></td>
      <td><select name="sex">
    	<option value='male'> Άρρεν </option>
    	<option value='female'> Θύλην </option></select></td>
     </tr>
   	<tr>
		<td><span class="mast">*</span><a href="lows/terms.php">Όροι χρήσης</a></td>
		<td class="checkbox" > <input type="checkbox" id="turms" onchange="allowreg()"/> Αποδέχομαι </td>
   	</tr>
    <tr>
     	<td colspan="2" style="text-align:center"><input type="submit" name="Register" id="Register" value="Εγγραφή" disabled="disabled" />
        <input type="reset" name="ResetForm" id="ResetForm" value="Καθαρισμός" /></td>
    </tr>    
  </table>
</form>
<? }?>
</div></div>
<?php
    include_once "extentions/footer.php";
?>
</body>
</html>
