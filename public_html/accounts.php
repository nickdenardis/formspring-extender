<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	// Display the Index Page
	$smarty->display('accounts.tpl');
?>