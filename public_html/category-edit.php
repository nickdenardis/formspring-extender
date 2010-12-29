<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	// Create the category class
	$myCategory = new Category;
	
	try {
		// If they are saving the Information
		if ($_POST['submit'] == 'save'){
			// Get all the Form Data
			$myCategory->SetValues($_POST);
			$myCategory->SetValue('user_id', $myUser->GetPrimary());
						
			// Save the Make
			if ($myCategory->Save()){
				SetAlert('Category Successfully Saved.','success');
				LogAction('Saved Category: ' . stripslashes($myCategory->GetValue('category')), 1);
				header('location:' . PATH . 'categories');
				die();
			}
		}
	
		// If Deleting 
		if ($_POST['submit'] == 'delete'){
			$myCategory->SetValues($_POST);
			$name = stripslashes($myCategory->GetValue('category'));
			
			// Remove from the DB
			if (!$myCategory->Delete())
				throw new SimplException('Error deleting from the database, please try again.');
						
			// Everything went fine
			SetAlert('Category Deleted Successfully','success');
			LogAction('Deleted Category: ' . $name, 1);
			header('location:' . PATH . 'categories');
			die();
		}
	
		// Set the requested primary key and get its info
		if ($_GET['id'] != '' && $myCategory->GetPrimary() == ''){
			$myCategory->SetPrimary((int)$_GET['id']);
			
			// Try to get the info
			if (!$myCategory->GetInfo())
				throw new SimplException('Invalid category, please try another.', 3, 'Access to invalid category - ' . $myCategory->GetPrimary(), PATH . 'categories');
		}
	} catch (SimplException $e) {}
	
	// Set the object
	$smarty->assign('myObject', $myCategory);
	$smarty->assign('display', array('category', 'status'));
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	// Actions
	$actions = array();
	$actions[] = array('class' => 'back', 'link' => '/categories', 'title' => 'Category List');
	$smarty->assign('actions', $actions);
	
	
	// Display the Edit Page
	$smarty->display('edit.tpl');
?>