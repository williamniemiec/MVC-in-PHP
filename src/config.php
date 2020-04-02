<?php
require 'environment.php';

$config = array();
global $db;


if (ENVIRONMENT == 'production') {
	define("BASE_URL", "http://www.name_of_site.com/");
	$config['dbname'] = 'name_of_online_db';
	$config['host'] = '127.0.0.1';
	$config['charset'] = 'utf8';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "http://localhost/");
	$config['dbname'] = 'name_of_local_db';
	$config['host'] = '127.0.0.1';
	$config['charset'] = 'utf8';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

try {
	$db = new PDO(
		"mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=".$config['charset'], 
		$config['dbuser'], 
		$config['dbpass']
	);
} catch(PDOException $e){
	echo "DATABASE CONNECTION ERROR: ".$e->getMessage();
}
