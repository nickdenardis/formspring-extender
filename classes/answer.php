<?php
class Answer extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('answers', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('user_id', 'question_id', 'question', 'answer', 'date_asked'));
	}
}
?>