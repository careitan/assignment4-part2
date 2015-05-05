<?php
	flush();
	$filepath = explode('/',$_SERVER['PHP_SELF'],-1);
	$filepath = implode('/', $filepath);
	$redirect = "http://".$_SERVER['HTTP_HOST'].$filepath;
	header("Location: {$redirect}/default.php");
	exit();
	?>