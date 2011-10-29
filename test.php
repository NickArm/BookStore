<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
include_once "extentios/dbconnect.php";
		$query="select * from Users_db";
		$user=mysql_query($query);
		while($row=mysql_fetch_row($user)){
		print_r($row);
		echo "<br />"; }
echo "<br />";
echo "<br />";

    $query="SELECT * FROM Users_db WHERE username='kostas';"; 
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
	print_r($row);
		$count=mysql_num_rows($result);
echo "<br />";

		echo $count;
		/*public function __construct($username,$firstname,$lastname,$user_id,$lastlogin,$accesslvl)
			$this->user=$username;
			$this->user=$firstname;
			$this->user=$lastname;
			$this->user=$user_id;
			$this->user=$lastlogin;
			$this->user=$accesslvl;
			*/
        ?>
</body>
</html>
