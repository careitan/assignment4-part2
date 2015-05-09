<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');

	echo'<title>CS 290 Assignment 4 - Part 2</title>';
	echo'<link rel="stylesheet" href="styles.css" type="text/css">';
	echo'<script src="scripts/functions.js"></script>';
	echo'<body >';

	require_once('conn/MySQLOSUDB.php');
	echo '<h2>CS 290 Assignment 4 - Part 2</h2><br>';
	require_once('require/insert_form.php');
	require_once('require/product_table.php');
	require_once('require/delete_all_form.php');
	
echo'</body>';
?>