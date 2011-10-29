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
include_once "extentions/dbconnect.php";
function getPasswordForUser($username) {
	$query="SELECT * FROM Users_db WHERE username=LCASE('$username')"; 
	$result = mysql_query($query);
	$count=mysql_num_rows($result);
	$row=mysql_fetch_array($result);
	return $row;
	
} 

function validate($challenge, $response, $password) {
	return md5($challenge . $password) == $response;
}

function registered($response) {
	return 'true' == $response;
} 
 
function authenticate() {
		if (isset($_SESSION[challenge]) && isset($_REQUEST[username]) && isset($_REQUEST[response])) {
			$record = getPasswordForUser($_REQUEST[username]);
			$password=$record['password'];
					if (validate($_SESSION['challenge'], $_REQUEST['response'], $password) && registered($record['registered'])) {
							$_SESSION['authenticated'] = "yes";
							$_SESSION['username'] = $_REQUEST[username];
							unset($_SESSION['challenge']);
							$_SESSION['user_id'] = $record['user_id'];
							$_SESSION['firstname'] = $record['firstname'];
							$_SESSION['lastname'] = $record['lastname'];
							$_SESSION['lastlogin'] = $record['lastlogin'];
							$_SESSION['mail'] = $record['mail'];
							$_SESSION['address'] = $record['address'];
							$_SESSION['contact_phone'] = $record['contact_phone'];
							$_SESSION['accesslvl'] = $record['accesslvl'];
							$_SESSION['registered'] = $record['registered'];
							$_SESSION['age'] = $record['age'];
							$_SESSION['sex'] = $record['sex'];
							$_SESSION['edu'] = $record['edu'];
							$query="Update Users_db SET lastlogin=NOW() where user_id='".$record['user_id']."'"; 
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
header("Location:index.php");
exit();
?>
