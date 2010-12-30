<?php
class AccountInfo extends ActiveRecord {
	function __construct(){
		// Call the parent constructor
		parent::__construct('account_info', DB_DEFAULT);
		
		// Set the relationships
		$this->HasOne('User');
		
		// Set the Required
		$this->SetRequired(array('user_id', 'name'));
	}
}
?>