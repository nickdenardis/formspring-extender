<?php
class FormspringBio extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('formspring_bio', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('oauth_user_id', 'name'));
	}
}
?>