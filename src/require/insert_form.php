<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
?>
<div class="invObjects">
<form action="create.php" method=post>
<label>Name:</label><input type=text name="name" required><br>
<label>Category:</label><input type=text name="category" placeholder=""><br>
<label>Length:</label><input type=number name="length" min=0 max=1000 step=1 placeholder=0><br>
<input type=submit value="Add Video">
</form></div class="invObjects">