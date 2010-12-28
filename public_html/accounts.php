<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	$myAccess = new AccountAccess;
	$delegates = $myAccess->GetDelegates($myUser->GetPrimary());
	$smarty->assign('delegates', $delegates);
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	// Display the Index Page
	$smarty->display('accounts.tpl');
?>