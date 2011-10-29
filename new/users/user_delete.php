<?php
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes" ) {
		include_once "../extentios/dbconnect.php";

		$user_id= $_POST['userDelete'] + 0;
		$user_status=$_POST['userRegistered'];
		if($_SERVER['REQUEST_METHOD']=='POST') {
				if ($user_status == "true" && $user_id == $_SESSION['user_id']){
						$query="UPDATE Users_db SET registered='false' WHERE user_id='$user_id' ";
						mysql_query("set names 'utf8'");
						mysql_query($query); 
						header("Location:http://weblab.teipir.gr/~www33175/logout.php?del=ok");
					//echo "Done Succesfully. Deleted user with id ".$user_id;
				}elseif($user_status == "false"){
						$query="UPDATE Users_db SET registered='true' WHERE user_id='$user_id' ";
						mysql_query("set names 'utf8'");
						mysql_query($query); 
						header("Location: $_SERVER[HTTP_REFERER]");
						//header("Location:http://weblab.teipir.gr/~www33175/users/users_edit.php?user_id=".$user_id);
				}elseif($user_status == "true"){
						$query="UPDATE Users_db SET registered='false' WHERE user_id='$user_id' ";
						mysql_query("set names 'utf8'");
						mysql_query($query); 
						header("Location:http://weblab.teipir.gr/~www33175/users/users_preview.php?msg=ok");
					}
	}
}
?>