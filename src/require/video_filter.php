<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
?>
<form action="apply_filter.php" method=post>
<label>Category:</label><input type=text list="categories" name="catSel">
<datalist id="categories">
	<?php
		include_once('categories_lookup.php');
	?>
</datalist>
<input type=submit value="Filter"></form>