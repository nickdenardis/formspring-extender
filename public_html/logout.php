<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	// Remove the session
	unset($_SESSION);
	
	// Remove the cookie
	setcookie('session', '', time()-(3600*24*7));
	
	// Redirect home
	header('Location: ' . PATH , true, 302);
	die();
?>