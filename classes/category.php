<?php
class Category extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('categories', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('user_id', 'status', 'category'));
	}
}
?>