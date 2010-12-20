<?php
	session_start();
	
	include_once($_SERVER['DOCUMENT_ROOT'] . '/../classes/formspringoauth.php');
	
	define('CONSUMER_KEY', '923d7f9ed7b5b1974b85fc48a6ebd53604d0eb445');
	define('CONSUMER_SECRET', 'db1ed9c781cc5d14486b75fa9c2076fc04d0eb445');
	define('OAUTH_CALLBACK', 'http://formspring:8888/callback.php');
?>