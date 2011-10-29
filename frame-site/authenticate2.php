<?php 
/////////////////////////////////////////////////////////////////////////////
//
// AUTHENTICATE PAGE
//
//   Server-side:
//     1. Get the challenge from the user session
//     2. Get the password for the supplied user (local lookup)
//     3. Compute expected_response = MD5(challenge+password)
//     4. If expected_response == supplied response:
//        4.1. Mark session as authenticated and forward to secret.php
//        4.2. Otherwise, authentication failed. Go back to login.php
//////////////////////////////////////////////////////////////////////////////////
//$userDB = array("john" => "abc123",
//"bob"  => "secret",
//"anna" => "passwd"); 
function getPasswordForUser($username) {
// get password from a simple associative array
// but this could be easily rewritten to fetch user info from a real DB
include_once "../extentios/dbconnect.php";

$query="SELECT * FROM Users_db WHERE user='$username'"; 
//AND pass=MD5('UserPassword')";

$user=$db->ExecuteQuery($query);

		global $userDB;     
		return $userDB[$username];
} 

function validate($challenge, $response, $password) {
		return md5($challenge . $password) == $response;
}
 
function authenticate() {
		if (isset($_SESSION[challenge]) && isset($_REQUEST[username]) && isset($_REQUEST[response])) {
			$password = getPasswordForUser($_REQUEST[username]);
		
					if (validate($_SESSION[challenge], $_REQUEST[response], $password)) {
							$_SESSION[authenticated] = "yes";
							$_SESSION[username] = $_REQUEST[username];;
							unset($_SESSION[challenge]);
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