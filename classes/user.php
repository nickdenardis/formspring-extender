<?php
class User extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('users', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('username', 'oauth_token', 'oauth_token_secret'));
	}
}
?>