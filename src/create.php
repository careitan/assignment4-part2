<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	if (isset($_POST)) {
		require_once('conn/MySQLOSUDB.php');

		$create = 'INSERT INTO inventory (name, category, length) VALUES (?, ?, ?)';
		
		$stmnt = $mysqli->prepare($create);
		if ($mysqli->connect_errno) {
			echo 'MySQL Object Error on Prepare Create: '.$mysqli->connect_errno.' '.
			$mysqli->connect_error;
		}
		// Input Validation
		if (!$_POST['name']) {
			echo 'Form POST ERROR Name of Product not populated.';
			sleep(10);
		} else if (!$_POST['length'] || ($_POST['length'] < 0) || ($_POST['length'] > 1000)) {
			echo 'Form POST ERROR length is not populated correctly.';
			sleep(10);
		} else {
			$stmnt->bind_param("ssd", $_POST['name'], $_POST['category'],
			 $_POST['length']);

			$stmnt->execute();

			if (!$stmnt) {
				echo 'MySQL Statement failed on INSERT: '.$stmnt->mysql_errno().' '.
				$stmnt->error();
				sleep(10);
			} else {
				$stmnt->close();
			}
		}
		include_once('require/home_redirect.php');
	}
	?>