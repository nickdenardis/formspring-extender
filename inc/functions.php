<?php
/**
 * Log the Users Action
 *
 * Wrapper function for the Log Action Class
 *
 * @param $action string
 * @param $type int (1=Normal, 2=Issue, 3=Security)
 * @return BOOL
 */
function LogAction($action,$type,$area = 0){
	global $myUser;
	
	// If logging is enabled
	if (LOGGING == true){
		// Create the Action Log Class
		$myLog = new ActionLog();
		
		// Set all the Available Information
		if (is_object($myUser))
			$myLog->SetValue('user_id', $myUser->GetPrimary());
		$myLog->SetValue('ip', $_SERVER['REMOTE_ADDR']);
		$myLog->SetValue('user_agent', $_SERVER['HTTP_USER_AGENT']);
		$myLog->SetValue('type', (int)$type);
		$myLog->SetValue('is_viewed', 0);
		$myLog->SetValue('action', stripslashes($action));
		
		// Save the log
		return ($myLog->Save());
	}
	
	return false;
}
?>