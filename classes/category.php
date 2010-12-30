<?php
class Category extends ActiveRecord {
	function __construct(){
		// Call the parent constructor
		parent::__construct('categories', DB_DEFAULT);
		
		// Set the relationships
		$this->HasMany('Answer', 'AnswerCategory');
		
		// Set the Required
		$this->SetRequired(array('user_id', 'status', 'category'));
	}
}
?>