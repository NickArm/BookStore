</head>

<body>
<div id="container">
	<div id="header">
    <?php include_once "e-search.php";?>
    	<div id="menubar">
			<ul>
    			<li><a href="<?php echo $_SERVER['PATH_INFO']?>index.php" onMouseOver="mopen('m1')" onMouseOut="mclosetime()">Αρχική σελίδα</a>
    				 <?php if (!(isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes")) {
								echo '<div id="m1" onMouseOver="mcancelclosetime()" onMouseOut="mclosetime()">
											<a href="'.$_SERVER['PATH_INFO'].'login.php">Είσοδος</a>
											<a href="'. $_SERVER['PATH_INFO'].'registration.php">Εγγραφή</a>
									</div>';
							}
					?>
				</li>
                <li><a href="<?php echo $_SERVER['PATH_INFO']?>products/products.php?product_type=book" onMouseOver="mopen('m2')" onMouseOut="mclosetime()">Βιβλία</a>
                    <div id="m2" onMouseOver="mcancelclosetime()" onMouseOut="mclosetime()">
                        <a href="<?php echo $_SERVER['PATH_INFO']?>products/products.php?product_type=book">Βιβλία</a>
                        <a href="<?php echo $_SERVER['PATH_INFO']?>products/products.php?product_type=book&onSales=true">Προσφορές</a>
                        <a href="<?php echo $_SERVER['PATH_INFO']?>products/products.php?product_type=book&bestSeller=true">Best Salers</a>
                    </div>
  				</li>
                <li><a href="<?php echo $_SERVER['PATH_INFO']?>products/products.php?product_type=cd" onMouseOver="mopen('m3')" onMouseOut="mclosetime()">CDs</a>
                    <div id="m3" onMouseOver="mcancelclosetime()" onMouseOut="mclosetime()">
                        <a href="<?php echo $_SERVER['PATH_INFO']?>products/products.php?product_type=cd">All CDs</a>
                        <a href="<?php echo $_SERVER['PATH_INFO']?>products/products.php?product_type=cd&onSales=true">Sales</a>
                        <a href="<?php echo $_SERVER['PATH_INFO']?>products/products.php?product_type=cd&bestSeller=true">Best Salers</a>
                    </div>
                </li>
                <li><a href="<?php echo $_SERVER['PATH_INFO']?>cart.php" onMouseOver="mopen('m4')" onMouseOut="mclosetime()">Το καλάθι</a>						 				</li>
                <li><a href="<?php echo $_SERVER['PATH_INFO']?>contact.php" onMouseOver="mopen('m5')" onMouseOut="mclosetime()">Επικοινωνία</a></li>
			</ul>
          </div>
 	</div>