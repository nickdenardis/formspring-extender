<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	// Create the class
	$myAnswers = new Answer;
	
	// Refresh is nessisary
	if (isset($_GET['refresh'])){
		$total_imported = $myAnswers->GetRecentAnswers($myUser->GetPrimary());
		
		SetAlert('Successfully imported ' . $total_imported . ' new answers.', 'success');
		
		// Redirect out of the ?refresh
		header('Location: ' . PATH . 'answers/');
		die();
	}
	
	// Pull all the answers for this user
	$myAnswers->SetValue('user_id', $myUser->GetPrimary());
	$myAnswers->GetList(NULL, 'date_asked', 'ASC');
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	// Assign everything to the templates
	$smarty->assign('myObject', $myAnswers);
	$smarty->assign('display', array('question', 'date_entered'));
	$smarty->assign('locations', array('question' => '<a href="/answer/view/{$item_id}">{$data}</a>'));
	
	// Actions
	$actions = array();
	$actions[] = array('class' => 'reload', 'link' => '/answers?refresh', 'title' => 'Refresh Answers');
	$smarty->assign('actions', $actions);
	
	
	// Display the Index Page
	$smarty->display('list.tpl');
?>