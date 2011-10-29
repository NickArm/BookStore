<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="stylesheets/form.css">
<script type="text/javascript" src="scripts/md5.js"></script>
<script type="application/javascript">
function allowreg(){
	if (document.getElementById('turms').checked== false)
		document.getElementById('Register').disabled=true;
        else
        document.getElementById('Register').disabled=false;
}
</script>
</head>
<body>
<?php
include_once "extentios/dbconnect.php";


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
				$query="INSERT INTO Users_db (username,password,firstname,lastname,createdate,mail,address,contact_phone,age,sex,edu) VALUES(LCASE('$user'),MD5('$pass'),'$firstname','$lastname',NOW(),'$mail','$address','$contact_phone','$age','$sex','$edu')";
				mysql_query($query); 
					
?>

                    <table>
                    	<tr>
                    		<td><p class="info_text"><strong>Ο Χρήστης με όνομα "<?=$user?>" προστέθηκε.<br/>
                    			Μπορείτε να χρησιμοποιήσετε τα στοιχεια για να συνδεθείτε.</strong></p></td>
                    	</tr>
                    </table>
<?php 
}else{
?>
    <table>
        <tr>
        <td class="vmiddle"><p class="error_text"><strong>ΠΡΟΣΟΧΗ! <br /> Ο χρήστης με όνομα <strong><?=$user?></strong>υπαρχει ήδη.</strong></p></td>
        </tr>
    </table>
<?php
}
}
}

?>
<script type="application/javascript">
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
<form method="post" action="<?=$_SERVER['REQUEST_URI']?>" enctype="application/x-www-form-urlencoded" onSubmit="return validateForm();">
  <table style="width:450px"; margin-left:5px; border="1px solid #C0C0C0;">
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
        <option value='1ο βάθμια'>1ο βάθμια</option>
        <option value='2ο βάθμια'>2ο βάθμια</option>
        <option value='Ακαδημαϊκή'>Ακαδημαϊκή</option>
        <option value='Μεταπτυχικό'>Μεταπτυχικό</option>
        </select></td>
    </tr>
    <tr>
      <td><label for "sex">Φύλο:</label></td>
      <td><select name="sex">
    	<option value='Άρρεν'> Άρρεν </option>
    	<option value='Θύλην'> Θύλην </option></select></td>
     </tr>
   	<tr>
		<td><span class="mast">*</span><a href="lows/terms.html">Όροι χρήσης</a></td>
		<td class="checkbox" > <input type="checkbox" id="turms" onchange="allowreg()"/> Αποδέχομαι </td>
   	</tr>
    <tr>
     	<td colspan="2" style="text-align:center"><input type="submit" name="Register" id="Register" value="Εγγραφή" disabled="disabled" />
        <input type="reset" name="ResetForm" id="ResetForm" value="Καθαρισμός" /></td>
    </tr>    
  </table>
</form>

</body>
</html>
