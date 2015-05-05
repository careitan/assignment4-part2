﻿<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	if (isset($_POST)) {
		require_once('conn/MySQLOSUDB.php');

		$create = 'DELETE FROM inventory';

/* CS290 Lecture example on Prepared Statments - refactored for parameter*/
		$stmnt = $mysqli->prepare($create);
		if ($mysqli->connect_errno) {
			echo 'MySQL Object Error on Prepare Create: '.$mysqli->connect_errno.' '.
			$mysqli->connect_error;
		} else {

			$stmnt->execute();

			if (!$stmnt) {
				echo 'MySQL Statement failed on DELETE ALL ITEMS: '.$stmnt->mysql_errno().' '.
				$stmnt->error();
				sleep(10);
			} else {
				$stmnt->close();
			}
		}
		//include_once('require/home_redirect.php');
	}
?>