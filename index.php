<?

	require("config.php");
	require("modules.php");
	require("functions.php");
	require("settings.php");	
	require("classes/class.template.php");
	require("classes/class.list.php");
	require("classes/class.item.php");
	require("classes/class.pages.php");
	require("classes/class.sysmess.php");
	require("classes/class.settings_groups.php");
	require("classes/class.settings.php");
	require("classes/class.tree.php");
	require("classes/class.maintext.php");
	require("classes/class.article.php");
	require("classes/class.partner.php");
	require("classes/class.slider.php");
	require("classes/class.release.php");
	require("classes/class.review.php");
	require("classes/class.stock.php");
	require("classes/class.video.php");
	require("classes/class.specialization.php");
	require("classes/class.advantage.php");
	require("classes/class.service.php");

	session_start();

	$_GET = defender_xss($_GET);
	$_POST = defender_xss($_POST);
	$_REQUEST = defender_xss($_REQUEST);
	
	$GLOBALS['systemMess'] = new cSysMessStack();
	include "controller.php";

	if ($page == 'error404') header("HTTP/1.0 404 Not Found");
	else
	{
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Cache-Control: post-check=0,pre-check=0");
		header("Cache-Control: max-age=0");
		header("Pragma: no-cache");
	}

	load_sets();

	require("pages/page.".$PAGES[$page].'.php');

	$tpl = new cTemplate('templates');
	$tpl->loadTemplateFile($PAGE_TEMPLATE);

	foreach ($PAGE_MODULES as $module)
	{
		require_once("modules/mod.".$MODULES[$module][0].".php");
		$OBJECTS_MOD[$module] = new $MODULES[$module][1]();
		$OBJECTS_MOD[$module]->Init();
	}

	foreach ($PAGE_MODULES as $module)
	$OBJECTS_MOD[$module]->Run();
	
	if ($GLOBALS['PAGE_TITLE'] == '') $GLOBALS['PAGE_TITLE'] = get_set('title');
	if ($GLOBALS['PAGE_DESCRIPTION'] == '') $GLOBALS['PAGE_DESCRIPTION'] = get_set('description');
	if ($GLOBALS['PAGE_KEYWORDS'] == '') $GLOBALS['PAGE_KEYWORDS'] = get_set('keywords');
	$tpl->parseBlock('_INIT', array(
		'PAGE_TITLE' => strip_tags($PAGE_TITLE),
		'PAGE_DESCRIPTION' => strip_tags($PAGE_DESCRIPTION),
		'PAGE_KEYWORDS' => strip_tags($PAGE_KEYWORDS),
		'FOOTER' => get_set('footer'),
		'HEADER' => get_set('header'),
		'MOBILE_CONTACT' => get_set('mobile_contact'),
		'HOST' => HOST
	));
	$tpl->show();
?>