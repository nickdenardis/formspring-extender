<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	$myUser = new User;
	$myAccountInfo = new AccountInfo;
	$myAccountAccess = new AccountAccess;
	
	// Make the temp conenction
	$connection = new FormspringOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['temporary_credentials']['oauth_token'], $_SESSION['temporary_credentials']['oauth_token_secret']);

	// Get the long lasting token credentials
	$token_credentials = $connection->getAccessToken($_GET['oauth_verifier']);
	
	// Grab the details of this user
	$details = $connection->get("profile/details");
	
	// Save it to the database
	$myUser->ResetValues();
	
	// Check to see if this user is already in the DB
	$myUser->SetValue('username', $details->response->username);
	$myUser->GetInfo(NULL, array('username'));

	// Add the new token credentials
	$myUser->SetValue('oauth_token', $token_credentials['oauth_token']);
	$myUser->SetValue('oauth_token_secret', $token_credentials['oauth_token_secret']);
	
	// Create a unique ID for the session
	$myUser->SetValue('sessionid', uniqid());
	
	// Update the user information if found or insert if new
	if (!$myUser->Save())
		throw new SimplException('Error Saving Formspring Client Token', 2, 'Error: Error Saving Formspring Client Token :' . $details->response->username);
	
	// Set the session cookie
	if ($_GET['delegate'] == '')
		setcookie('session', $myUser->GetValue('sessionid'), time()+(3600*24*7));
	else{
		// Setup the relationship
		$myAccountAccess->SetValues('user_id', $_GET['delegate']);
		$myAccountAccess->SetValues('delegate_id', $myUser->GetPrimary());
		$myAccountAccess->SetValues('type', 'full');
		$myAccountAccess->Save();
	}
	
	// See if this user already exists in the DB
	$myAccountInfo->ResetValues();
	$myAccountInfo->SetValue('user_id', $myUser->GetPrimary());
	$myAccountInfo->GetInfo(NULL, array('user_id'));
	
	// Add their new values
	foreach((array)$details->response as $field=>$value)
		$myAccountInfo->SetValue($field, $value);
	$myAccountInfo->SetValue('user_id', $myUser->GetPrimary());
	
	// Update the user information if found or insert if new
	if (!$myAccountInfo->Save())
		throw new SimplException('Error Saving Formspring Client Bio', 2, 'Error: Error Saving Formspring Client Bio :' . $details->response->username);
	
	// Redirect to the list page
	header('Location: ' . PATH , true, 302);
	die();
?>