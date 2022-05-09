<?
	session_start();
	
	header( 'Expires: Mon, 26 Jul 1970 05:00:00 GMT' );
	header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header( 'Cache-Control: post-check=0, pre-check=0', false );
	header( 'Pragma: no-cache' );
	header( 'Content-Type: application/xml; charset=windows-1251');

	require("modules.php");
	require("../config.php");
	require("../functions.php");
	require("../settings.php");	
	require("../classes/class.item.php");
	require("../classes/class.list.php");
	require("../classes/class.settings_groups.php");
	require("../classes/class.settings.php");

	switch ($_GET["type"])
	{
		case "auth":
			$login = getVar("login");
			$password = getVar("password");
			load_sets();
			require("users.php");			
			foreach ($users as $user)
			{
				if ( ($login == $user['login']) && (password_verify($password,$user['passwd'])) )
				{				
					$_SESSION['access'] = $user['access'];
					print "ok";
					exit;
				}
			}
			print "error";
		break;
	}
?>
