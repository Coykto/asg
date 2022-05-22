<?
	ini_set('display_errors', 0);
	error_reporting(0);	
	date_default_timezone_set('europe/berlin');
	
    $db_host = getenv("DB_DOCKER_HOST") ?: "localhost";
    $db_username = "freshdecor_eston";
    $db_password = "CRAk!7YE6ZJEYS2W";
    $db_dbname = "freshdecor_eston";

	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_dbname);
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	$mysqli->query("SET NAMES utf8");

	GLOBAL $mysqli;
?>