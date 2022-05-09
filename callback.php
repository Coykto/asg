<?
	require "req.php";

	$_GET = defender_xss($_GET);
	$_POST = defender_xss($_POST);
	$_REQUEST = defender_xss($_REQUEST);
	
	$phone = getVar('phone');
	$name = getVar('name');
	$email = getVar('email');
	
	$error1 = 0;
	
	if ($phone == '') $error1 = 1;
	
	if (!$error1)
	{
		$res = $mysqli->query("INSERT INTO department_messages (ip,date,name,phone,email,text,url) VALUES ('".$_SERVER["REMOTE_ADDR"]."','".time()."','','".$phone."','','','".$_SERVER["HTTP_REFERER"]."') ");
		$subject = "Industriya. SITE FORM";
		$text = '
		Страница: '.$_SERVER['HTTP_REFERER'].'<br>
		Телефон: '.$phone.'<br>
		Имя: '.$name.'<br>
		Email: '.$email.'<br>
		';
		
		$emails = explode(",",get_set("email"));
		foreach ($emails AS $val)
		XMail("info@industry-company.ru",$val,$subject, $text);

		print 'ok';
	}
	else print $error1;
?>