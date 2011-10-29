<?php
	require_once "extentions/sitesettings.php";
	include_once "extentions/header.php";
	include_once "extentions/bodystart.php";
	if (session_id() == ''){session_start();};
	
?>
 	<div id="mainContent">
    	<?php if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
							include_once "extentions/sidebar.php";
							echo '<p>&nbsp;</p><p>Η αγορά ολοκληρώθηκε με <strong>επιτυχία</strong></p><p> Ευχαριστούμε πολύ που μας προτιμήσατε. Σύντομα θα μιλήσετε  με τον υπεύθυνο των παραγγελιών<p>';
				}
    	echo '<div id="screen">';
		?>
        </div>
     </div>
    <?php
    include_once "extentions/footer.php";
	?>
</body>
</html>
