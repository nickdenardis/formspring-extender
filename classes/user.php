<?php
class User extends ActiveRecord {
	function __construct(){
		// Call the parent constructor
		parent::__construct('users', DB_DEFAULT);
		
		// Set the relationships
		$this->HasOne('AccountInfo');
		$this->HasMany('Category');
		
		// Set the Required
		$this->SetRequired(array('username', 'oauth_token', 'oauth_token_secret'));
	}
}
?>