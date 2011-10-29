<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="stylesheets/form.css">
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
$createdate='';

$PageTitle='Εγγραφη Νέου Χρήστη';
if($_SERVER['REQUEST_METHOD']=='POST') {

if($pass==$passconfirm){
$query="SELECT * FROM users_db WHERE LCASE(user)=LCASE('$user')";
$existing_user=$db->ExecuteQuery($query);


if($existing_user->RecordCount()==0) {
$query="INSERT INTO Users_db (user,pass,firstname,lastname,mail,address,age,contact_phone,edu,sex,createdate) VALUES('$user', '$pass','$firstname','$lastname','$address','$age','$contact_phone','$edu','$sex',NOW())";
$db->makeQuery($query);
?>

<table>
<tr>
<td><p class="info_text"><strong>Ο Χρήστης με όνομα "<?=$Usename?>" προστέθηκε.<br/>
Μπορείτε να χρησιμοποιήσετε τα στοιχεια για να συνδεθείτε.</strong></p></td>
</tr>
</table>
<?php 
}else{
?>
<table>
<tr>
<td class="vmiddle"><p class="error_text"><strong>ΠΡΟΣΟΧΗ! <br /> Ο χρήστης με όνομα <strong><?=$username?></strong>υπαρχει ήδη.</strong></p></td>
</tr>
</table>
<?php
}
}
}
?>
<form method="post" action="<?=$_SERVER['REQUEST_URI']?>" enctype="application/x-www-form-urlencoded" onSubmit="return validateForm();">
  <table style="width:450px"; margin-left:5px; border="1px solid #C0C0C0;">
  	<tr>
      <td><label for "username"><span class="mast">*</span>Όνομα Χρήστη:</label></td>
      <td><input type="text" name="user" id="user" value="<?=$user?>" size="16" maxlength="16" /></td>
    </tr>
    <tr>
      <td><label for "userpassword"><span class="mast">*</span>Κωδικός Χρήστη:</label></td>
      <td><input type="password" name="pass" id="pass" value="<?=$pass?>" size="16" maxlength="16" /></td>
    </tr>
    <tr>
      <td><label for "passconfirm"><span class="mast">*</span>Κωδικός Χρήστη (Επιβεβαίωση):</label></td>
      <td><input type="password" name="passconfirm" id="passconfirm" value="<?=$passconfirm?>" size="16" maxlength="16" /></td>
    </tr>
    <tr>
      <td><label for "userfirstname"><span class="mast">*</span>Όνομα:</label></td>
      <td><input type="text" name="firstname" id="firstname" value="<?=$firstname?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "userlastname"><span class="mast">*</span>Επώνυμο:</label></td>
      <td><input type="text" name="lastname" id="lastname" value="<?=$lastname?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "useremail"><span class="mast">*</span>Email:</label></td>
      <td><input type="text" name="mail" id="mail" value="<?=$mail?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "useraddress"><span class="mast">*</span>Διευθυνση:</label></td>
      <td><input type="text" name="address" id="address" value="<?=$address?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "userphone">Τηλέφωνο:</label></td>
      <td><input type="text" name="contact_phone" id="contact_phone" value="<?=$contact_phone?>" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label for "userage">Ηλικία:</label></td>
      <td><input type="text" name="age" id="age" value="<?=$age?>" size="4" maxlength="4" /></td>
    </tr>
    <tr>
      <td><label for "useredu">Εκπαίδευση:</label></td>
      <td><select name="edu">
        <option value='1ο βάθμια'>1ο βάθμια</option>
        <option value='2ο βάθμια'>2ο βάθμια</option>
        <option value='Ακαδημαϊκή'>Ακαδημαϊκή</option>
        <option value='Μεταπτυχικό'>Μεταπτυχικό</option>
        </select></td>
    </tr>
    <tr>
      <td><label for "usersex">Φύλο:</label></td>
      <td><select name="sex">
    	<option value='male'> Άρρεν </option>
    	<option value='female'> Θύλην </option></select></td>
     </tr>
   <tr>
	<td><span class="mast">*</span><a href="lows/terms.html">Όροι χρήσης</a></td>
	<td class="checkbox" > <input type="checkbox"/> Αποδέχομαι </td>
   </tr>
    <tr>
      <td colspan="2" style="text-align:center"><input type="submit" name="Register" id="Register" value="Εγγραφή" />
        <input type="reset" name="ResetForm" id="RestForm" value="Καθαρισμός" /></td>
    </tr>    
  </table>
</form>

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

if (document.getElementById('pass').value=='' && (document.getElementById('pass').length <'7' ){
alert('Ο κωδικός πρέπει να περιέχει 8 ψηφία  το λιγότερο.');
return false;
}

if (document.getElementById('pass').value != document.getElementById('passconfirm').value){
alert('Οι εισαχθέντες κωδικοί δεν ταιρίαζουν.');
return false;
}
return true;
}
</script>

</body>
</html>
