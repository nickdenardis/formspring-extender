<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');

	$connection = new FormspringOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$temporary_credentials = $connection->getRequestToken(OAUTH_CALLBACK);
	$_SESSION['temporary_credentials'] = $temporary_credentials;
	//print_r($temporary_credentials);
	
	$redirect_url = $connection->getAuthorizeURL($temporary_credentials);
	header('Location: ' . $redirect_url);
	die();
?>