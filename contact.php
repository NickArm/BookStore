<?php
	include_once "extentions/header.php";
	include_once "extentions/bodystart.php";
	
	$sender_name='Το όνομα';
	$sender_email='Το e-mail';
	$messageBoby='Το κείμενο σας';?>
	<div id="mainContent">
<?php	
if (isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes") {
		include_once "extentions/sidebar.php";
		}
	echo '<div id="screen">';
	if($_SERVER['REQUEST_METHOD']=='POST') {
	
	$sender_name=$_POST['sender_name'];
	if (isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes") {$sender_name=$_SESSION['firstname']." ".$_SESSION['lastname'];}
	$sender_email=$_POST['sender_email'];
	if (isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes") {$sender_email=$_SESSION['mail'];}
	$messageBoby=$_POST['messageBoby'];
	echo $sender_name.','.$sender_email.','.$messageBoby.' '; 
	
		if (eregi('http:', $messageBoby)) {
			die ("Το μύνημα περιέχει κάποιο URL.<br/>Αυτό δεν επιτρέπεται.<br/>Προσπαθήστε ξανά χωρίς το URL");
			}
		if(!$sender_email == "" && (!strstr($sender_email,"@") || !strstr($sender_email,"."))){
			echo "<h2>Δώστε έγκυρο e-mail!</h2>\n";
			echo "<h2>Το e-mail δεν στάλθηκε</h2>\n";
			die ("Προσπαθήστε ξανά");
			}
	
			if(empty($sender_name) || empty($sender_email) || empty($messageBoby)) {
				echo "<h2>Συμπληρώστε όλα τα απαιτούμενα πεδία</h2>\n";
				die ("Προσπαθήστε ξανά");
			}
	
		$todayis = date("l, F j, Y, g:i a") ;
		$messageBoby = stripcslashes($messageBoby);
		$message =$todayis." [EST] \n Μύνημα: ".$messageBoby." \n Από: ".$sender_name."(".$sender_email.")\n";
		$from = "Αποστολέας: ".$sender_email."\r\n";
		$myemail="kostas.tsimaris@gmail.com";
		mail($myemail, $from, $message);
	
		echo '<p align="center"><br/>Ευχαριστούμε :'.$sender_name.'('.$sender_email.')<br/></p>';
	}
		
	?>
	
		<h1>Επικοινωνία</h1>
		<div id="send_form">
		<form  id="send_Form" method="post" action="<?=$_SERVER['REQUEST_URI']?>" enctype="application/x-www-form-urlencoded" >
			<table align="center" border="0" cellpadding="2">
            <tr>
   <?php        if (!isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] != "yes") { 
          ?>  <td><label>Όνομα:</label></td>
			<td><input id="sender_name" type="text" value="<?=$sender_name?>" name="sender_name"/></td></tr>
			<tr><td><label>Email:</label></td>
			<td><input id="sender_email" type="text" value="<?=$sender_email?>" name="sender_email"/></td></tr>
			<tr><td><label>Μήνυμα:</label></td>
            <?php  } ?>
			<td><textarea id="messageBoby"  name="messageBoby" rows="5" cols="20"><?=$messageBoby?></textarea></td></tr>
			<tr><td colspan="2"><input type="submit" name="Register" id="Register" value="Αποστολή"/></td></tr></table>
		</form>
		</div>
       </div> 
	</div>
	<?php
		include_once "extentions/footer.php";
	?>
	</body>
</html>