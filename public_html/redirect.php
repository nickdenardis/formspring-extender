<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');

	// Make the temp conenction
	$connection = new FormspringOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	
	// Get the temp credentials
	$temporary_credentials = $connection->getRequestToken(OAUTH_CALLBACK . ((isset($_GET['delegate']) && $_GET['delegate'] != '')?'?delegate=' . $_GET['delegate']:''));
		
	// Save the temp credentials to the session
	$_SESSION['temporary_credentials'] = $temporary_credentials;
	
	// Determine the redirect URL.
	$redirect_url = $connection->getAuthorizeURL($temporary_credentials);

	// Move the user along
	header('Location: ' . $redirect_url, true, 302);
	die();
?>