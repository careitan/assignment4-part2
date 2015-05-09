<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	if (isset($_POST)) {
		require_once('conn/MySQLOSUDB.php');

		if ($_POST['catSel']=="All Movies") {
			$TSQL = 'UPDATE videos SET filter = 1;';
		} else {
			$TSQL = 'UPDATE videos SET filter = CASE category WHEN "'.$_POST['catSel'].'" THEN 1 ELSE 0 END;';
		}

	/* CS290 Lecture example on Prepared Statments - refactored for parameter*/		
		$stmnt = $mysqli->prepare($TSQL);
		if ($mysqli->connect_errno) {
			echo 'MySQL Object Error on Prepare Create: '.$mysqli->connect_errno.' '.
			$mysqli->connect_error;
		} else {
			echo $TSQL;
			$stmnt->execute();

			if (!$stmnt) {
				echo 'MySQL Statement failed on UPDATE: '.$stmnt->mysql_errno().' '.
				$stmnt->error();
				sleep(10);
			} else {
				$stmnt->close();
			}
		}
		include_once('require/home_redirect.php');
}
?>