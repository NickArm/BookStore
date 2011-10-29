<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table style="margin:auto">
<tr>
<td style="border-bottom:#990000 2px solid;" align="center">a/a</td>
<td style="border-bottom:#990000 2px solid;"> Ονομασια-Περιγραφφη</td>
<td style="border-bottom:#990000 2px solid;" align="right">Τιμη</td>
</tr>
<?php

require_once("includes/dbconnect.php");
$catid=$_GET['vendor_id']+0;
$query="SELECT * FROM jos_vm_product WHERE vendor_id='$catid' order by title DESC";
$result=$db->MakeQuery($query);

if ($db->GetRecordCount($result)){
$products=$db->GetResultAsArray($result);


$i=1;
foreach ($products as $product){
echo '<tr style="margin:4px;">';
echo '<tr align="center" valign="top" style="font-size:110%; font=weight:bold;">'.$i.'.</td>';
echo '<td valign="top">';
echo '<p><strong>'.$product['product_sku'].'</strong></p>';
echo '<p class="small_text"><i>'.$product['product_s_desc'].'</i></p>';

echo '</td>';
echo '<td align="right" valign="top" style="color:#000099;"><strong>';
			if ($product['product_publish']=='Y'){
				echo sprintf("%01.2f", $product['product_weight']);
			}
			else  {
				echo '--';
				}
			echo ' &euro;</strong></td>';
			echo '</tr>';
			$i++;
	}		
} 
else {
echo '<tr><td colspan="4" align="center">Δεν βρεθηκαν προιοντα για την κατηγορια αυτη</td></tr>';
}
?>
</table>
</body>
</html>
