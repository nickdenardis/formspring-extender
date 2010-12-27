<?php
	// Determine what environment we are on
	$mode = 'dev';
	
	// If running local pick up that config
	if (is_file($_SERVER['DOCUMENT_ROOT'] . '/../inc/define-local.php'))
		$mode = 'local';

	/**
	 * SetDefine
	 *
	 * Wrapper function for defining variables
	 *
	 * @param $key string
	 * @param $value string
	 * @return BOOL
	 */
	function SetDefine($key, $value){
		if (!defined($key)) define($key, $value);
		return true;
	}

	// Setup the environment
	switch ($mode){
		case 'production':
			SetDefine('DEBUG', false);
			SetDefine('DEBUG_QUERY', false);
			SetDefine('USE_CACHE', true);
			SetDefine('USE_ENUM', true);
			SetDefine('QUERY_CACHE', false);
			SetDefine('DB_SESSIONS', false);
			SetDefine('DEBUG_LOG', false);
			break;
		case 'local':
			include($_SERVER['DOCUMENT_ROOT'] . '/../inc/define-local.php');
			break;
		case 'dev':
		default:
			SetDefine('DEBUG', false);
			SetDefine('DEBUG_QUERY', false);
			SetDefine('USE_CACHE', true);
			SetDefine('USE_ENUM', true);
			SetDefine('QUERY_CACHE', false);
			SetDefine('DB_SESSIONS', false);
			SetDefine('DEBUG_LOG', true);
			break;
	}
	
	// Database
	SetDefine('DB_USER', '');
	SetDefine('DB_HOST', '');
	SetDefine('DB_PASS', '');
	SetDefine('DB_DEFAULT', '');
	
	// Basic Information
	SetDefine('DIR_ROOT', '/');
	SetDefine('PATH', DIR_ROOT);
	SetDefine('IS_SECURE', ($_SERVER['SERVER_PORT'] == '443'));
	SetDefine('ADDRESS', 'http' . (IS_SECURE?'s':'') . '://' . $_SERVER['HTTP_HOST'] . PATH);
	SetDefine('TITLE', 'Formspring Extender');
	SetDefine('EMAIL', 'nick.denardis@gmail.com');
	SetDefine('LOGGING', true);
	SetDefine('API_VERSION', '1.0');
	
	// Directories
	SetDefine('DIR_ABS', $_SERVER['DOCUMENT_ROOT'] . PATH);
	SetDefine('FS_SIMPL', DIR_ABS . '../simpl/');
	SetDefine('FS_CACHE', DIR_ABS . '../cache/');
	SetDefine('DIR_CLASSES', DIR_ABS . '../classes/');
	
	// Include Smarty
	SetDefine('DIR_SMARTY', DIR_ABS . '../smarty/');
	
	// Include SIMPL
	include_once(FS_SIMPL . 'simpl.php');
	include_once(DIR_ABS .  '../inc/functions.php');
	include_once(DIR_SMARTY . 'Smarty.class.php');
	include_once(DIR_CLASSES .  'utilities.php');
	
	// Connect to database
	$db = new Db();
	$db->Connect();
	
	// Create the template object
	$smarty = new FormTemplates;
	
	// Assign the mode to the templates
	$smarty->assign('mode', $mode);
		
	SetDefine('CONSUMER_KEY', '923d7f9ed7b5b1974b85fc48a6ebd53604d0eb445');
	SetDefine('CONSUMER_SECRET', 'db1ed9c781cc5d14486b75fa9c2076fc04d0eb445');
	SetDefine('OAUTH_CALLBACK', 'http://formspring:8888/callback');
?>