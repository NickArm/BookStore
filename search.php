<?php
require_once "extentions/sitesettings.php";
include_once "extentions/header.php";
include_once "extentions/bodystart.php";
echo '<div id="mainContent">';
if (isset($_SESSION[authenticated]) && $_SESSION[authenticated] == "yes") {
    include_once "extentions/sidebar.php";
}
echo '<div id="screen">';
$search_term = mysql_real_escape_string(trim($_GET['input_search']));

if (isset($search_term)) {
    include_once "extentions/dbconnect.php";
    mysql_query("set names 'utf8'");
    $query  = "SELECT * FROM product_db WHERE product_name LIKE '%$search_term%' OR author LIKE '%$search_term%' OR product_desc LIKE '%$search_term%' OR product_type LIKE '%$search_term%' OR product_category LIKE '%$search_term%'  AND availability='true'";
    //$query = "SELECT * FROM product_db WHERE (MATCH(product_name,author,product_category,product_desc,product_serial) AGAINST ('%$search_term%' IN BOOLEAN MODE)) AND availability='true' ORDER BY product_price DESC";
    $result = mysql_query($query);
    $count  = mysql_num_rows($result);
    if ($_GET['page'] == '') {
        $i = 0;
    } else {
        $i = ($_GET['page'] - 1) * 6;
    }
    $query  = "SELECT * FROM product_db WHERE product_name LIKE '%$search_term%' OR author LIKE '%$search_term%' OR product_desc LIKE '%$search_term%' OR product_type LIKE '%$search_term%' OR product_category LIKE '%$search_term%'  AND availability='true' ORDER BY product_price DESC limit $i,6";
    $result = mysql_query($query);
    
    $pages = ($count / 4);
    echo '<font size=+1><p align="center">Η αναζήτηση επέστρεψε ' . $count . ' αποτελέσματα.</p></font>';
    
    if ($pages > 1) {
        echo '<div id="page">
                    Σελίδες: ';
        $tmp = 0;
        for ($j = 0; $j < $pages; $j++) {
            $tmp = $j + 1;
            echo '<a href="http://weblab.teipir.gr/~www33175/search.php?input_search=' . $search_term . '&page=' . $tmp . '" title="Επόμενη Σελίδα">' . $tmp . '</a>';
        }
        echo '</div>';
    }
    
    $i = 0;
    while ($row = mysql_fetch_row($result)) {
        $i++;
        echo '<div class="product">
            <div class="proddescr">
                <h6 class="productlabel">Τίτλος</h6><h3 class="productlabelvalue"><a href="products/product_view.php?product_id=' . $row[0] . '" title="' . $row[1] . '">' . $row[1] . '</a></h3><br clear="all">
                <h6 class="productlabel">Συγγραφέας</h6><h3 class="productlabelvalue">' . stripslashes(nl2br($row[2])) . '</h3><br clear="all">
                <h6 class="productlabel">Κατηγορία</h6><h3 class="productlabelvalue">' . stripslashes(nl2br($row[5])) . '</h3><br clear="all">
                <h6 class="productlabel">Τιμή</h6><h3 class="productlabelvalue">' . stripslashes(nl2br($row[6])) . '&euro;</h3><br>
                <h6 class="moreinfo"><a href="products/product_view.php?product_id=' . $row[0] . '" title="' . $row[1] . '">Περισσότερα</a></h6>
            </div>
            <div class="icons">';
        if (isset($_SESSION['accesslvl']) && $_SESSION['authenticated'] == "yes") {
            echo '<a href="' . $_SERVER['REQUEST_URI'] . '" title="Προσθήκη στο Καλάθι Αγορών"><img src="images/shop.gif" alt="Προσθήκη στο Καλάθι Αγορών"></a>';
        }
        if ($row[7] == "true") {
            echo '<img src="images/onsales.gif" title="Σε Προσφορά" alt="Σε Προσφορά">';
        }
        if ($row[8] == "true") {
            echo '<img src="images/bestseller1.gif" title="Bestseller" alt="Bestseller">';
        }
        echo '</div></div>';
        if (!($i % 2)) {
            echo '<hr />';
        }
    }
    if ($pages > 1) {
        echo '<div id="page">
                    Σελίδες: ';
        $tmp = 0;
        for ($j = 0; $j < $pages; $j++) {
            $tmp = $j + 1;
            echo '<a href="http://weblab.teipir.gr/~www33175/search.php?input_search=' . $search_term . '&page=' . $tmp . '" title="Επόμενη Σελίδα">' . $tmp . '</a>';
        }
        echo '</div>';
    }
} else {
    echo "Βάλτε στοιχεία αναζήτησης";
}

echo '</div></div>';
include_once "extentions/footer.php";
?>
</body>
</html>
