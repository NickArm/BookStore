<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php 
$_SERVER['DOCUMENT_ROOT']="john/be/me";
?>
</head>

<body>
<?php
echo 'Server name: '.$_SERVER['SERVER_NAME'].
'<br/>Server Port: '.$_SERVER['SERVER_PORT'].
'<br/>Server URI: '.$_SERVER['REQUEST_URI'].
'<br/>Document Root: '.$_SERVER['DOCUMENT_ROOT'].
'<br/>HTTP Host: '.$_SERVER['HTTP_HOST'].
'<br/>PATH_INFO: '.$_SERVER['PATH_INFO'].
'<br/>ORIG_PATH_INFO: '.$_SERVER['ORIG_PATH_INFO'].
'<br/>PATH_TRANSLATED: '.$_SERVER['PATH_TRANSLATED'];
?>
</body>
</html>
