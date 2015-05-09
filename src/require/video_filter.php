<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
?>
<div class="filter"><form action="require/product_table.php" method=post>
<label>Category:</label><input type=text list="categories" name="catSel">
<datalist id="categories">
	<?php
		include_once('categories_lookup.php');
	?>
</datalist>
<input type=submit value="Filter"></form></div class="filter">