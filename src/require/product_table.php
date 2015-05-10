<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$TSQL = "SELECT id, category, name, length, rented FROM videos WHERE filter = 1 ORDER BY category, name";
$stmnt = $mysqli->prepare($TSQL);

if ($mysqli->connect_errno) {
	echo 'MySQL Object Error on Prepare Category Lookup: '.$mysqli->connect_errno.' '.
	$mysqli->connect_error;
} else {
	$stmnt->execute();
}

if (!$stmnt) {
	echo 'MySQL Statement failed on SELECT Categories: '.$stmnt->mysql_errno().' '.
	$stmnt->error();
} else {
	$stmnt->bind_result($id, $category, $name, $length, $rented);

	echo '<div class="products"><table><thead><th class="limit">Category</th><th class="limit">Name</th><th class="limit">Length</th><th>Rental Status</th>
	<th class="actions">Actions</th></thead>';
	echo '<body>';

	while($stmnt->fetch()){

		echo '<tr><td>'.$category.'</td><td>'.$name.'</td><td>'.$length.'</td>';
		if ($rented==0) {
			echo '<td>Available</td>';
		} else {
			echo '<td>Checked Out</td>';
		}
		echo '<td><input class="rental" type=button id='.$id.' value="Check In/Out" OnClick="CheckoutMovie(id)">
		<input class="free" type=button id='.$id.' value="Delete" OnClick="DeleteItem(id)"></td></tr>';
	}
	echo '</body></table></div>';

	$stmnt->close();
}
?>
