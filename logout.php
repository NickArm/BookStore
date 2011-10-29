<?php
session_unset();
session_destroy();
if (isset($_GET['del'])) { 
						
						header("Location:index.php?msg=$_GET[del]");
			}else{
			header("Location:index.php");
}

?>