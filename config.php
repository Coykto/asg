<?
	ini_set('display_errors', 0);
	error_reporting(0);	
	date_default_timezone_set('europe/berlin');
	
	$db_host = "localhost";
	$db_username = "freshdecor_icnew";
	$db_password = "n3l0b7yzOE";
	$db_dbname = "freshdecor_icnew";

	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_dbname);
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	$mysqli->query("SET NAMES utf8");

	GLOBAL $mysqli;
?>