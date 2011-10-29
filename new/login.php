<?php 
/////////////////////////////////////////////////////////////////////////////
//
// LOGIN PAGE
//
//   Server-side:
//     1. Start a session
//     2. Clear the session
//     3. Generate a random challenge string
//     4. Save the challenge string in the session
//     5. Expose the challenge string to the page via a hidden input field
//
//  Client-side:
//     1. When the completes the form and clicks on Login button
//     2. Validate the form (i.e. verify that all the fields have been filled out)
//     3. Set the hidden response field to HEX(MD5(server-generated-challenge + user-supplied-password))
//     4. Submit the form
//////////////////////////////////////////////////////////////////////////////////

	include_once "extentios/header.php";
	include_once "extentios/e-login.php";	
	include_once "extentios/bodystart.php";
	echo '<div id="mainContent">';
	if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {					
		echo "Είστε συνδεδεμένος με το σύστημα ".$_SESSION['username'];
    	}   
	else {
		session_start();
		session_unset();
		srand();
		$challenge = "";
		for ($i = 0; $i < 80; $i++) {
			$challenge .= dechex(rand(0, 15));
		}
		$_SESSION[challenge] = $challenge;
				
		echo '<h1>Please Login</h1>
				<form id="loginForm" action="#" method="post" >
					<table>
						';
						 if (isset($_REQUEST[error])) { 
						echo '<tr>
							<td>Error</td>
							<td style="color: red;">'; echo $_REQUEST[error]; 
							echo '</td>
						</tr>';
						 }
				echo  '<tr>
							<td>User Name:</td>
							<td><input type="text" name="username"/></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" name="password"/></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td align="center">
								<input type="hidden" name="challenge" value="'; echo $challenge; 
								echo '"/>
								<input type="button" name="submit" value="Login" onclick="login();"/>
							</td>
						</tr>
					</table>
				</form>
				<form id="submitForm" action="authenticate.php" method="post">
					<div>
						<input type="hidden" name="username"/>
						<input type="hidden" name="response"/>
					</div>
				</form>'; 
			}
 	
	echo '</div>'; 
	include_once "extentios/footer.php";
	?>
    </body>
</html>