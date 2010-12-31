<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	// Create the answer class
	$myAnswer = new Answer;
	
	try {
		// Set the requested primary key and get its info
		if ($_GET['id'] != '' && $myAnswer->GetPrimary() == ''){
			$myAnswer->SetPrimary((int)$_GET['id']);
			
			// Try to get the info
			if (!$myAnswer->GetInfo())
				throw new SimplException('Invalid answer, please try another.', 3, 'Access to invalid answer - ' . $myAnswer->GetPrimary(), PATH . 'answers');
		
			// Get a list of all the categories it is in.
			$in_categories = $myAnswer->Category()->Items(array('category', 'status'));
		}
	} catch (SimplException $e) {}
	
	// Get a list of all the categories
	$all_categories = $myUser->Category()->Items(NULL, 'category', 'ASC');
	
	// Set the object
	$smarty->assign('myObject', $myAnswer);
	$smarty->assign('in_categories', $in_categories);
	$smarty->assign('all_categories', $all_categories);
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	// Actions
	$actions = array();
	$actions[] = array('class' => 'back', 'link' => '/answers', 'title' => 'Answer List');
	$smarty->assign('actions', $actions);
	
	
	// Display the Edit Page
	$smarty->display('answers/view.tpl');
?>