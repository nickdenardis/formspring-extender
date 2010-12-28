<?php
class AccountAccess extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('account_access', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('user_id', 'delegate_id', 'type'));
	}
	
	public function GetDelegates($user_id){
		// Setup a user
		$myUser = new User;
		$myAccountInfo = new AccountInfo;

		// Get a list of all people with delegate access
		$this->ResetValues();
		$this->SetValue('user_id', $user_id);
		$display[] = array('user_id', 'delegate_id', 'type');
		
		// Join the tables
		$this->Join($myUser, 'user_id', 'LEFT');
		$display[] = array('username');
		
		// Join the tables
		$this->Join($myAccountInfo, 'user_id', 'LEFT');
		$display[] = array('name', 'website', 'location', 'photo_url');
		
		// Get the list
		$this->GetList($display);
		
		// Return the list	
		return $this->Results();
	}
}
?>