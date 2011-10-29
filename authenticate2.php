<?php 
/////////////////////////////////////////////////////////////////////////////
//
// AUTHENTICATE PAGE
//
//   Server-side:
//     1. Get the challenge from the user session
//     2. Get the password for the supplied user (local lookup)
//     3. Compute expected_response = MD5(challenge+password)<a href="login.php">Login</a>
//     4. If expected_response == supplied response:
//        4.1. Mark session as authenticated and forward to secret.php
//        4.2. Otherwise, authentication failed. Go back to login.php
//////////////////////////////////////////////////////////////////////////////////
include_once "extentios/dbconnect.php";
function getPasswordForUser($username) {
	$query="SELECT * FROM Users_db WHERE username=LCASE('$username')"; 
	$result = mysql_query($query);
	$count=mysql_num_rows($result);
	$row=mysql_fetch_array($result);
	return $row;

// get password from a simple associative array
// but this could be easily rewritten to fetch user info from a real DB 
	
} 

function validate($challenge, $response, $password) {
	return md5($challenge . $password) == $response;
}
 
function authenticate() {
		if (isset($_SESSION[challenge]) && isset($_REQUEST[username]) && isset($_REQUEST[response])) {
			$record = getPasswordForUser($_REQUEST[username]);
			$password=$record['password'];
		
					if (validate($_SESSION[challenge], $_REQUEST[response], $password)) {
							$_SESSION['authenticated'] = "yes";
							$_SESSION['username'] = $_REQUEST[username];
							unset($_SESSION['challenge']);
							$_SESSION['Authenticated']=true;
							$_SESSION['UserName']=$record['UserName'];
							$_SESSION['UserID']=$record['user_id'];
							$_SESSION['UserFirstName']=$record['UserFirftName'];
							$_SESSION['UserLastName']=$record['UserLastName'];
							$_SESSION['UserAccessLevel']=$record['UserAccessLevel'];

$query="UPDATE registered_users SET UserLastLogin=NOW() WHERE UserID='$UserID'";
mysql_query($query);
					} else {
							header("Location:login.php?error=".urlencode("Failed authentication"));
							exit;
							}
		} else {
				header("Location:login.php?error=".urlencode("Session expired"));
				exit; }
		}
session_start();
authenticate();
header("Location:secret.php");
exit();
?>
