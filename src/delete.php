<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	if (isset($_POST)) {
		require_once('conn/MySQLOSUDB.php');

		$create = 'DELETE FROM inventory WHERE id = ?';

/* CS290 Lecture example on Prepared Statments - refactored for parameter*/
		$stmnt = $mysqli->prepare($create);
		if ($mysqli->connect_errno) {
			echo 'MySQL Object Error on Prepare Create: '.$mysqli->connect_errno.' '.
			$mysqli->connect_error;
		} else if ($_POST['id']) {
			$stmnt->bind_param("i", $_POST['id']);
			$stmnt->execute();

			if (!$stmnt) {
				echo 'MySQL Statement failed on DELETE SINGLE ITEMS: '.$stmnt->mysql_errno().' '.
				$stmnt->error();
			} else {
				$stmnt->close();
			}
		} else {
			echo 'POST Error value for ID: '.$_POST['id'];
			sleep(10);
		}
		//include_once('require/home_redirect.php');
	}
?>
	