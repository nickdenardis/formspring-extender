<?php
class FormspringAnswer extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('formspring_answers', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('oauth_user_id', 'question_id', 'question', 'answer', 'date_asked'));
	}
}
?>