<?php
session_start();

/*configuracion de la base de datos*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'sisvaa');
define("BASE_URL", "/sisvaa");
define("VERSION", "version 1.0");

function getDB() {
	$dbhost = DB_SERVER;
	$dbuser = DB_USERNAME;
	$dbpass = DB_PASSWORD;
	$dbname = DB_DATABASE;

	try {
		$dbconnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser,$dbpass);
		$dbconnection -> exec("set name utf8");
		$dbconnection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbconnection;
	}

	catch(PDOException $e) {
		echo 'Falla en la conexión: '. $e->getMessage();
	}
}

?>