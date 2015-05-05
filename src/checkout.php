<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>
<?php	
if (isset($_POST)) {
	require_once 'conn/MySQLOSUDB.php';

	$TSQL = 'UPDATE inventory SET rented = !rented WHERE id = ?';
	
	$stmnt = $mysqli->prepare($TSQL);
	if ($mysqli->connect_errno) {
		echo 'MySQL Object Error on Prepare Create: '.$mysqli->connect_errno.' '.
		$mysqli->connect_error;
	}

	if ($_POST['movieID']) {
		$stmnt->bind_param("d", $_POST['movieID']);

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