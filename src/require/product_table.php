<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	$TSQL = "SELECT id, category, name, length, rented FROM videos ORDER BY category, name";
	$stmnt = $mysqli->prepare($TSQL);

	if ($mysqli->connect_errno) {
		echo 'MySQL Object Error on Prepare Category Lookup: '.$mysqli->connect_errno.' '.
		$mysqli->connect_error;
	}

	$stmnt->execute();
	$stmnt->bind_result($id, $category, $name, $length, $rented);

	if (!$stmnt) {
		echo 'MySQL Statement failed on SELECT Categories: '.$stmnt->mysql_errno().' '.
		$stmnt->error();
	} else {
		
		echo '<div class="products"><table><thead><th>Category</th><th>Name</th><th>Length</th><th>Rental Status</th>
		<th class="identity" /></thead>';
		echo '<body>';

		while($stmnt->fetch()){

		echo '<tr><td>'.$category.'</td><td>'.$name.'</td><td>'.$length.'</td>';
		echo '<td><input class="rental" type=button id='.$id.' value="Check In/Out" OnClick="CheckOut(id)">
		<input class="free" type=button id='.$id.' value="Delete" OnClick="DeleteItem(id)"></td></tr>';
		}
		echo '</body></table></div>';

		$stmnt->close();
	}
?>
