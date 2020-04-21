<?php
require 'environment.php';

global $config;
$config = array();

if (ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/");
	$config['dbname'] = 'name_of_db';
	$config['host'] = '127.0.0.1';
	$config['charset'] = 'utf8';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "http://mySite.com/");
	$config['dbname'] = 'name_of_db';
	$config['host'] = '127.0.0.1';
	$config['charset'] = 'utf8';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}