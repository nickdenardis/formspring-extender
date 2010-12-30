<?php
class AnswerCategory extends ActiveRecord {
	function __construct(){
		// Call the parent constructor
		parent::__construct('answer_category', DB_DEFAULT);
		
		// Set the relationships
		$this->HasMany('Answer');
		$this->HasMany('Category');
		
		// Set the Required
		$this->SetRequired(array('answer_id', 'category_id'));
	}
}
?>