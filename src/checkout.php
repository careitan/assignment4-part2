<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<?php	
if (isset($_POST)) {
	require_once 'conn/MySQLOSUDB.php';

/* http://stackoverflow.com/questions/4912946/query-to-toggle-boolean-value-in-mysql */
	$TSQL = 'UPDATE videos SET rented = !rented WHERE id = ?';

/* CS290 Lecture example on Prepared Statments - refactored for parameter*/	
	$stmnt = $mysqli->prepare($TSQL);
	if ($mysqli->connect_errno) {
		echo 'MySQL Object Error on Prepare Create: '.$mysqli->connect_errno.' '.
		$mysqli->connect_error;
	}

	if ($_POST['id']) {
		$stmnt->bind_param("d", $_POST['id']);
		$stmnt->execute();

		if (!$stmnt) {
			echo 'MySQL Statement failed on UPDATE: '.$stmnt->mysql_errno().' '.
			$stmnt->error();
			sleep(10);
		} else {
			$stmnt->close();
		}
		include_once 'require/home_redirect.php';
	}
}
?>