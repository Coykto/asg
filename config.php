<?
	ini_set('display_errors', 0);
	error_reporting(0);	
	date_default_timezone_set('europe/berlin');
	
	$db_host = "localhost";
	$db_username = "freshdecor_eston";
	$db_password = "92p*R39DUQCJCXNP";
	$db_dbname = "freshdecor_eston";

	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_dbname);
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	$mysqli->query("SET NAMES utf8");

	GLOBAL $mysqli;
?>