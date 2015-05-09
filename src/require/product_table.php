<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$TSQL = "";

if (isset($_POST)) {
	$TSQL = "SELECT id, category, name, length, rented FROM videos WHERE category LIKE ? ORDER BY category, name";
} else {
	$TSQL = "SELECT id, category, name, length, rented FROM videos ORDER BY category, name";
}

$stmnt = $mysqli->prepare($TSQL);

if ($mysqli->connect_errno) {
	echo 'MySQL Object Error on Prepare Category Lookup: '.$mysqli->connect_errno.' '.
	$mysqli->connect_error;
} else if (isset($_POST)) {
	if (!isset($_POST['catSel'])) {
		$stmnt->bind_param("s", "'%'");
	}	else if ($_POST['catSel'] == "All Movies") {
		$stmnt->bind_param("s", "'%'");
	} else {
		$stmnt->bind_param("s", $_POST['catSel']);
	}
	$stmnt->execute();
} else {
	$stmnt->execute();
}

if (!$stmnt) {
	echo 'MySQL Statement failed on SELECT Categories: '.$stmnt->mysql_errno().' '.
	$stmnt->error();
} else {
	$stmnt->bind_result($id, $category, $name, $length, $rented);

	echo '<div class="products"><table><thead><th>Category</th><th>Name</th><th>Length</th><th>Rental Status</th>
	<th>Actions</th></thead>';
	echo '<body>';

	while($stmnt->fetch()){

		echo '<tr><td>'.$category.'</td><td>'.$name.'</td><td>'.$length.'</td>';
		if ($rented==0) {
			echo '<td>Available</td>';
		} else {
			echo '<td>Checked Out</td>';
		}
		echo '<td><input class="rental" type=button rental-id='.$id.' value="Check In/Out" OnClick="CheckOut(rental-id)">
		<input class="free" type=button free-id='.$id.' value="Delete" OnClick="DeleteItem(free-id)"></td></tr>';
	}
	echo '</body></table></div>';

	$stmnt->close();
}
?>
