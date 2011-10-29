<div id="sidebar1">
		
    <h3>Καλώς ήρθες <?php echo $_SESSION['username'];?></h3>
    <h5>Προηγούμενη σύνδεση <?php echo $_SESSION['lastlogin'];?></h5>

<?php 
//---------------------- admin -------------------------//
if ($_SESSION['accesslvl'] == 'Administrator'){
 		echo '<div align="left">
                <h4>Διαχείρηση</h4>
                <ul>
                    <li><a href="http://weblab.teipir.gr/~www33175/users/users_preview.php">Προβολή χρηστών</a></li>
					<li><a href="http://weblab.teipir.gr/~www33175/products/product_insert.php">Καταχώρηση Νέου Προιόντος</a></li>
					<li><a href="http://weblab.teipir.gr/~www33175/products/products_preview.php">Προβολή Προιόντων</a></li>
                </ul>
            </div>';

       
}

//---------------------- User -------------------------//
if ($_SESSION['accesslvl'] == 'User'){
 		echo '<div align="left">
                <ul>
                    <li><a href="http://weblab.teipir.gr/~www33175/users/users_edit.php">Αλλαγή Προσωπικών στοιχείων</a></li>
					<li><a href="http://weblab.teipir.gr/~www33175/cart.php">Προβολή καλαθιού</a></li>
                </ul>
            </div>';
}
//---------------------- Author -------------------------//
if ($_SESSION['accesslvl'] == 'Author'){
echo '<div align="left">
                <ul>
                    <li><a href="http://weblab.teipir.gr/~www33175/users/users_edit.php">Αλλαγή Προσωπικών στοιχείων</a></li>
					<li><a href="http://weblab.teipir.gr/~www33175/product_statistics.php">Στατιστηκά</a></li>
                </ul>
            </div>';
}
?>
   
    <p><a href="http://weblab.teipir.gr/~www33175/logout.php">Logout?</a></p>
</div>