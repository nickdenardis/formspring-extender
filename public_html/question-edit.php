<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	// Create the answer class
	$myAnswer = new Answer;
	
	try {
		// If they are saving the Information
		if (isset($_POST['submit']) && $_POST['submit'] == 'Save'){
			// Get all the Form Data
			$myAnswer->SetValues($_POST);
			$myAnswer->SetValue('user_id', $myUser->GetPrimary());

			// Save the Make
			if ($myAnswer->Save() && $myAnswer->Respond()){
				SetAlert('Answer Successfully Saved.','success');
				LogAction('Saved Answer: ' . stripslashes($myAnswer->GetValue('question')), 1);
				header('location:' . PATH . 'answers');
				die();
			}
		}
	
		// If Deleting 
		if (isset($_POST['submit']) && $_POST['submit'] == 'Delete'){
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
		if (isset($_GET['id']) && $_GET['id'] != '' && $myAnswer->GetPrimary() == ''){
			$myAnswer->SetPrimary((int)$_GET['id']);
			
			// Try to get the info
			if (!$myAnswer->GetInfo())
				throw new SimplException('Invalid answer, please try another.', 3, 'Access to invalid answer - ' . $myAnswer->GetPrimary(), PATH . 'answers');
		
			// If there is already an answer throw the user to the answer edit
			if ($myAnswer->GetValue('answer') != ''){
				header('location:' . PATH . 'answer/edit/' . $myAnswer->GetPrimary());
				die();
			}
		}
	} catch (SimplException $e) {}
	
	
	//Pre($myAnswer->Category()->Count());
	//Pre($myAnswer->Category()->Items(array('category', 'status')));
	
	// Set the object
	$smarty->assign('myObject', $myAnswer);
	$smarty->assign('display', array('question', 'answer', 'date_entered'));
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	// Actions
	$actions = array();
	$actions[] = array('class' => 'back', 'link' => '/inbox', 'title' => 'Inbox');
	$actions[] = array('class' => 'back', 'link' => '/answers', 'title' => 'Answer List');
	$smarty->assign('actions', $actions);
	
	
	// Display the Edit Page
	$smarty->display('edit.tpl');
?>