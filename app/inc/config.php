<?php
	if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
		die('Direct access not allowed');
		exit;
	};

	// Website Configuration
	define('HOST', 	 		getenv('APP_HOST'));
	define('BACKEND',		getenv('APP_BACKEND'));
	define('BACKEND_AUTH',	getenv('APP_BACKEND_AUTH'));
	define('DISCORD_CLIENT_ID',  getenv('DISCORD_CLIENT_ID'));
    define('DISCORD_CLIENT_SECRET', getenv('DISCORD_CLIENT_SECRET'));
	// Debug
	if(getenv('DEBUG')) {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}
?>