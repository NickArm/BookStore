<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
 
<body>
<h1> Καταλαγοσ Προιντων</h1>
<p>Παρακαλουμε επιλεξτε μια απο τις παρακατω κατηγοριες για να δειτε τα σχετιζομενα προιντα.</p>
<ol>
<?php
require_once("includes/dbconnect.php");

$query="select * from categories order by title DESC";
$result=$db->MakeQuery($query);
$categories=$db->GetResultAsArray($result);

foreach ($categories as $category){
$query="select count(*) AS ProductCount from products where cat_id=".$category['id'];
$result=$db->MakeQuery($query);
$record=$db->GetRecord($result);

echo '<li><a
href="view_products.php?cat_id='.$category['id'].'">'.$category['title'].'</a>('.$record['ProductCount'].')</li>';
}
?>
</ol>
</body>
</html>
