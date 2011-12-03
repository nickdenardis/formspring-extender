<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../inc/application_top.php');
	
	// Pull all the categories for this user
	$myCategory = new Category;
	$myCategory->SetValue('user_id', $myUser->GetPrimary());
	$myCategory->GetList(NULL, 'category', 'ASC');
	
	include_once(DIR_ABS .  '../inc/application_bottom.php');
	
	// Assign everything to the templates
	$smarty->assign('myObject', $myCategory);
	$smarty->assign('display', array('category', 'status', 'date_entered'));
	$smarty->assign('locations', array('category' => '<a href="/category/edit/{$item_id}">{$data}</a>'));
	$smarty->assign('options', array());
	
	// Actions
	$actions = array();
	$actions[] = array('class' => 'add', 'link' => '/category/edit', 'title' => 'Add Category');
	$smarty->assign('actions', $actions);
	
	
	// Display the Index Page
	$smarty->display('list.tpl');
?>