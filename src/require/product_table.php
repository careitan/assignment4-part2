<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	$TSQL = "SELECT id, category, name, length, rented FROM videos WHERE category LIKE ? ORDER BY category, name";
	$stmnt = $mysqli->prepare($TSQL);

	if ($mysqli->connect_errno) {
		echo 'MySQL Object Error on Prepare Category Lookup: '.$mysqli->connect_errno.' '.
		$mysqli->connect_error;
	} else if (!isset($_POST)){
		$stmnt->bind_param("s", '%');
		$stmnt->execute();
	} else {
		$stmnt->bind_param("s", $_POST['categorySel']);
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

		echo '<tr><td>'.$category.'</td><td>'.$name.'</td><td>'.$length.'</td><td>'.$rented.'</td>';
		echo '<td><input class="rental" type=button rental-id='.$id.' value="Check In/Out" OnClick="CheckOut(rental-id)">
		<input class="free" type=button free-id='.$id.' value="Delete" OnClick="DeleteItem(free-id)"></td></tr>';
		}
		echo '</body></table></div>';

		$stmnt->close();
	}
?>
