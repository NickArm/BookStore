<?php

require_once("../includes/functions.php");

ForceAdministrativePage();

require_once("../includes/dbconnect.php");

if(isset($_GET['pid']))
{
$page_title="Επεξεργασία Υπάρχοντος Προϊόντος";
$query='SELECT * FROM products where id="'.$_GET['pid'].'"';
$result=$db->MakeQuery($query);
$products=$db->GetResultAsArray($result);
$product=$products[0];

$product_title=$product['title'];
$product_description=$product['description'];
$pid=$product['id'];
$catid=$product['cat_id'];
$price=$product['price'];
$availability=$product['available'];
if ($availability=="True")
$available_checked='checked="checked"';
else
$available_checked='';
$tbgcolor="#CCFF99";
}
else
{
$page_title="Εισαγωγή Νέου Προϊόντος";
$product_title='';
$product_description='';
$pid='new';
$catid=0;
$price='';
$available_checked='';
$tbgcolor="#FFFFFF";
}

?><<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page_title?></title>
<link href="/~web_mon25/stylesheets/fastfood.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" language="javascript">

function ValidateForm(){
if ((document.getElementById('product_title').value=="")||(document.getElementById('price).value==)){ 
	alert("ΠΡΟΣΟΧΗ!\n\nΔεν έχετε συμπληρώσει τα απαραίτητα πεδία.");
	return false;
		}
		else
			return true;
}
</script>

<style type="text/css">
<!--
tr { padding:2px; }

td {
margin: 2px;
padding: 2px;
border: 1px solid #000000;
}
-->
</style>

</head>

<body>
<h1 align="center"><?=page_title?></h1>
<p align="center" class="small_text">( <a href="index.php" target="mainFrame">Κεντρική Σελίδα Διαχείρισης</a> )</p>
<p>&nbsp;</script>p>
<form action="product_db_action.php" method="post" name="LoginBox" id="LoginBox" onsubmit="return ValidateForm()">
<input type="hidden" name="pid" value="<?=$pid?>"/>
<table align="center" style="border:thin solid#000000; background-color:<?=$tbgcolor?>">

<tr bgcolor="#FFCC00"><td colspan="2"><p align="center"><strong>Στοιχεία Προϊόντος</strong></p></td></tr>

<tr>
<td align="right"><p>Όνομα:</p></td>
<td><input type="text" name="product_title" id="product_title" value="<?=$product_title?>" maxlength="20"/></td>
</tr>

<tr>
<td align="right"><p>Κατηγορία:</p></td>
<td align="left"><select name="catid">
<?php

$query='SELECT * FROM categories';
$result=$db->MakeQuery($query);
$categories=$db->GetResultAsArray($result);

foreach ($categories as $category)
{
if ($category ['id']==$catid)
    $category_selected='selected="selected"';
	else
	$category_selected='';
	echo '<option value="'.$category["id"].'" '.$category_selected.'>'.$category["title"].'</option>';
	}

?>
</selected></td>
</tr>

<tr>
<td align="right"><p>Τιμή:</p></script>td>
 <td><input type="text" name="price" id="price" value="<?=$price?>" maxlenght="4" size="4"/></td>
 </tr>
 
 <tr>
 <td align="right"><p>Περιγραφή:</p></td>
 <td><textarea rows="5"cols="15" name="description" id="description"><?=$product_description?></textarea></td>
 </tr>
 
 <tr>
 <td align="right"><p>  </p></td>
 <td align="left"><input type="checkbox" name="available" id="available"<?=$available_checked?>/>Διαθέσιμος</td>
 </tr>
 
 <tr>
 <td colspan="2" align="center">
 <p><input type="submit" name="LoginSubmit" value="Ενημέρωση" />
 <input type="reset" name="rbutton" value="Καθαρισμός"/>
 </p></td>
 </tr>
 
 </table>
 </form>
</body>
</html>


