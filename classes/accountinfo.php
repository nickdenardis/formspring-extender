<?php
class AccountInfo extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('account_info', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('user_id', 'name'));
	}
}
?>