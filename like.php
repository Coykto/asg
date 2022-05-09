<?
	require "req.php";

	$_GET = defender_xss($_GET);
	$_POST = defender_xss($_POST);
	$_REQUEST = defender_xss($_REQUEST);
	
	$like = getInt('like');
	$lt = getVar('lt');
	
	if ($lt == 'pro') $t = 'dailys';
	else if ($lt == 'art') $t = 'articles';
	
	if ( ($like>0) && (in_array($t,array('dailys','articles'))) && (!isset($_COOKIE['pind_'.$lt.'_'.$like])) )
	{
		setcookie('pind_'.$lt.'_'.$like, 1, time() + (86400 * 1000), "/", ".industry-company.ru");
		
		$res = $mysqli->query("SELECT * FROM ".$t." WHERE visible='1' AND id='".$like."' ");
		$row = $res->fetch_array();
		if ($row['id']>0)
		{
			$res = $mysqli->query("UPDATE ".$t." SET likes=likes+1 WHERE id='".$row['id']."' ");
			$yes = $row['id'].'='.($row['likes']+1);
		}
	}
	
	if (!$yes) print $error; else print $yes;
?>