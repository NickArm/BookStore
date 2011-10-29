<?
include_once("mydbclass.php");

$db=new myDB('www.pc2shop.gr','orestis_demo1','19861986');
$db->SelectDB('orestis_demo1');

$query="SELECT * FROM jos_vm_product;";
$db->PrintQueryResults($query);

$query="SELECT * FROM jos_vm_product WHERE id=1;";
$result=$db->MakeQuery($query);

$record=$db->GetResultAsArray($result);
$record=$db->GetRecord($result);
echo $recorf['product_sku'];

$query="SELECT * FROM jos_vm_product;";
$result=$db->MakeQuery($query);
$records=$db->GetResultAsArray($result);

print_r($records);
echo $records[2]['product_sku'];
$db->Close();
?>
