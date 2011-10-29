<?
include_once("mydbclass.php");

$db=new myDB('weblab.teipir.gr','web_mon25','w90be86644');
$db->SelectDB('web_mon25');

$query="SELECT * FROM products;";
$db->PrintQueryResults($query);

$query="SELECT * FROM products WHERE id=1;";
$result=$db->MakeQuery($query);

$record=$db->GetResultAsArray($result);
$record=$db->GetRecord($result);
echo $recorf['product_name'];

$query="SELECT * FROM products;";
$result=$db->MakeQuery($query);
$records=$db->GetResultAsArray($result);

print_r($records);
echo $records[2]['product_name'];
$db->Close();
?>
