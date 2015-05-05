	<?php
		$TSQL = 'SELECT DISTINCT category FROM videos ORDER BY category';
		
		$stmnt = $mysqli->prepare($TSQL);
		if ($mysqli->connect_errno) {
			echo 'MySQL Object Error on Prepare Category Lookup: '.$mysqli->connect_errno.' '.
			$mysqli->connect_error;
		}
		$stmnt->execute();
		$stmnt->bind_result($category);

		if (!$stmnt) {
		echo 'MySQL Statement failed on SELECT Categories: '.$stmnt->mysql_errno().' '.
		$stmnt->error();
		} else {
			while($stmnt->fetch()){
			echo '<option value="'.$category.'" >';
			}
			$stmnt->close();
		}
	?>