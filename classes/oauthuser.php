<?php
class oAuthUser extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('oauth_users', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('username', 'oauth_token', 'oauth_token_secret'));
	}
}
?>