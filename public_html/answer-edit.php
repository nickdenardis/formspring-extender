<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	// Create the answer class
	$myAnswer = new Answer;
	
	try {
		// If they are saving the Information
		if ($_POST['submit'] == 'save'){
			// Get all the Form Data
			$myAnswer->SetValues($_POST);
			$myAnswer->SetValue('user_id', $myUser->GetPrimary());
						
			// Save the Make
			if ($myAnswer->Save()){
				SetAlert('Answer Successfully Saved.','success');
				LogAction('Saved Answer: ' . stripslashes($myAnswer->GetValue('question')), 1);
				header('location:' . PATH . 'answers');
				die();
			}
		}
	
		// If Deleting 
		if ($_POST['submit'] == 'delete'){
			$myAnswer->SetValues($_POST);
			$name = stripslashes($myAnswer->GetValue('question'));
			
			// Remove from the DB
			if (!$myAnswer->Delete())
				throw new SimplException('Error deleting from the database, please try again.');
						
			// Everything went fine
			SetAlert('Answer Deleted Successfully','success');
			LogAction('Deleted Answer: ' . $name, 1);
			header('location:' . PATH . 'answers');
			die();
		}
	
		// Set the requested primary key and get its info
		if ($_GET['id'] != '' && $myAnswer->GetPrimary() == ''){
			$myAnswer->SetPrimary((int)$_GET['id']);
			
			// Try to get the info
			if (!$myAnswer->GetInfo())
				throw new SimplException('Invalid answer, please try another.', 3, 'Access to invalid answer - ' . $myAnswer->GetPrimary(), PATH . 'answers');
		}
	} catch (SimplException $e) {}
	
	// Set the object
	$smarty->assign('myObject', $myAnswer);
	$smarty->assign('display', array('question', 'answer', 'date_entered'));
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	// Actions
	$actions = array();
	$actions[] = array('class' => 'back', 'link' => '/answers', 'title' => 'Answer List');
	$smarty->assign('actions', $actions);
	
	
	// Display the Edit Page
	$smarty->display('answers/edit.tpl');
?>