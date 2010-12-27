<?php
class AccountAccess extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('account_access', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('user_id', 'delegate_id', 'type'));
	}
}
?>