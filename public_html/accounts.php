<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');

	if ($myUser->GetPrimary() != ''){
		Pre($myUser->Nice());
	}else{
		echo 'No User Accounts.';
	}
?>