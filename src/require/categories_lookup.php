	<?php
		$TSQL = 'SELECT "All Movies" AS category UNION SELECT category FROM videos ORDER BY category';
		
		$stmnt = $mysqli->prepare($TSQL);
		if ($mysqli->connect_errno) {
			echo 'MySQL Object Error on Prepare Category Lookup: '.$mysqli->connect_errno.' '.
			$mysqli->connect_error;
		}
		$stmnt->execute();

		if (!$stmnt) {
		echo 'MySQL Statement failed on SELECT Categories: '.$stmnt->mysql_errno().' '.
		$stmnt->error();
		} else {
			$stmnt->bind_result($category);
			while($stmnt->fetch()){
			echo '<option value="'.$category.'" >';
			}
			$stmnt->close();
		}
	?>