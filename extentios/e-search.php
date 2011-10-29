<div>
<script  type="text/javascript" language="javascript">
function validate(){
if (document.getElementById('input_search').value==''){
alert('Η αναζήτηση δεν μπορεί να είναι κενή.');
return false;
	}
return true;
}
</script>
<form  id="searchForm" method="get" action="http://weblab.teipir.gr/~www33175/search.php" enctype="application/x-www-form-urlencoded"  onsubmit="validate()">
<table id="searchTable" border="0">
<tr><td><input type="text" name="input_search" id="input_search"  value=""  size="14" maxlength="80"/></td><td><input type="submit" name="searchButton" id="searchButton" value="Αναζήτηση"/></tr></table></form>
</div>