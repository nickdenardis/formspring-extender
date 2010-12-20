<pre>
<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');

	print_r($_GET);
	print_r($_POST);
	print_r($_SESSION);
	
	$connection = new FormspringOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['temporary_credentials']['oauth_token'], $_SESSION['temporary_credentials']['oauth_token_secret']);
	
	$token_credentials = $connection->getAccessToken($_GET['oauth_verifier']);
	
	
	print_r($token_credentials);
?>
</pre>