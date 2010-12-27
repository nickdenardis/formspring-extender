<?php
class ActionLog extends DbTemplate {
	function __construct(){
		// Call the parent constructor
		parent::__construct('action_log', DB_DEFAULT);
		
		// Set the Required
		$this->SetRequired(array('ip','user_agent','action','type'));
		
		// Set the options
		$this->SetOption('type', array('1' => 'Normal', '2' => 'Abnormal', '3' => 'Security'));
		$this->SetOption('viewed', array('0' => 'New', '1' => 'Viewed'));
	}
}

class FormspringException extends Exception {
	/**
     * @var string
     */
    private $field;

	// Redefine the exception so message isn't optional
    public function __construct($code, $field = '', $message = '') {
    	global $error_codes;
    	
    	// Find the message
    	if (trim($message) == '' && array_key_exists($code, $error_codes))
    		$message = $error_codes[$code];
    	
    	// Set the field
    	$this->field = (is_array($field))?current($field):$field;
    		
    	// make sure everything is assigned properly
        parent::__construct($message, $code);
        
        echo $this->__toString();
        die();
    }
    
    // Custom string representation of object
    public function __toString() {
    	// Create error array
    	$array['error'] = array('code' => $this->code, 'message' => $this->message, 'field' => $this->field);
    	return Output($array);
    }
}

class FormTemplates extends Smarty { 
	function __construct() {
        $this->template_dir = DIR_ABS . 'templates';
        $this->compile_dir = DIR_ABS . '../templates_c';
        $this->config_dir = DIR_ABS . '../config';
        $this->cache_dir = DIR_ABS . '../cache';
        
        //$this->load_filter('output','trimwhitespace');
        //$this->register->modifier('sslash', 'stripslashes');
        
        $this->caching = false;
        $this->debugging = false;
    }
}
?>