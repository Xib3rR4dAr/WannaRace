<?php

$debug = $_COOKIE['debug'] ?? 0;

if( isset($_COOKIE['challenge']) ){
	if( 'B' == $_COOKIE['challenge'] ){
		$level = 'B';
	}	
} else {
	$level = 'A';
}

if($debug){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
} else {
	ini_set('display_errors','off');
	error_reporting(0);
}

if( !defined('DB_SERVER') ){
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'raceuser');
	define('DB_PASSWORD', 'Rac3R_we3');
	define('DB_NAME', 'db_race');
}

?>