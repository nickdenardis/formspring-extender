<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	
	$connection = new FormspringOAuth(CONSUMER_KEY, CONSUMER_SECRET, '', '');

	
	if (trim($_GET['query']) != ''){
		$list = $connection->get("search/profiles", array('query' => trim($_GET['query'])));
	}
		
	Pre($myUser->Nice());
	Pre($myAccountInfo->Nice());
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	/*
	$inbox = $connection->get("inbox/list");
	echo '<pre>';
	print_r($inbox);
	echo '</pre>';
	
	$details = $connection->get("profile/details/waynestate");
	echo '<pre>';
	print_r($details);
	echo '</pre>';
	
	echo '<pre>';
	print_r($connection);
	echo '</pre>';
	*/
	
	
	// Display the Index Page
	$smarty->display('home.tpl');
?>