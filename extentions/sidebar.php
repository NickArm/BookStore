<div id="sidebar">
		
    <h3>Καλώς ήρθες <?php echo $_SESSION['username'];?></h3>
    <h5>Προηγούμενη σύνδεση <?php echo $_SESSION['lastlogin'];?></h5>

<?php 
//---------------------- admin -------------------------//
if ($_SESSION['accesslvl'] == 'Administrator'){
 		echo '<div align="left">
                <h3>Διαχείρηση</h3>
                <ul>
                    <li><a href="'.$_SERVER['PATH_INFO'].'users/users_preview.php">Προβολή χρηστών</a></li>
					<li><a href="'.$_SERVER['PATH_INFO'].'products/product_insert.php">Καταχώρηση Νέου Προιόντος</a></li>
					<li><a href="'.$_SERVER['PATH_INFO'].'products/products_preview.php">Προβολή Προιόντων</a></li>
                </ul>
            </div>';

       
}

//---------------------- User -------------------------//
if ($_SESSION['accesslvl'] == 'User'){
 		echo '<div align="left">
				<h3>Διαχείρηση</h3>
                <ul>
                    <li><a href="'.$_SERVER['PATH_INFO'].'users/users_edit.php">Αλλαγή Προσωπικών στοιχείων</a></li>
					<li><a href="'.$_SERVER['PATH_INFO'].'cart.php">Προβολή καλαθιού</a></li>
                </ul>
            </div>';
}
//---------------------- Author -------------------------//
if ($_SESSION['accesslvl'] == 'Author'){
echo '<div align="left">
				<h3>Διαχείρηση</h3>
                <ul>
                    <li><a href="'.$_SERVER['PATH_INFO'].'users/users_edit.php">Αλλαγή Προσωπικών στοιχείων</a></li>
					<li><a href="'.$_SERVER['PATH_INFO'].'stats.php">Στατιστηκά</a></li>
                </ul>
            </div>';
}
?>
   
    <p><a href="<?php echo $_SERVER['PATH_INFO'];?>logout.php">Έξοδος</a></p>
</div>