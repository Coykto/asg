<?	

	session_start();

	require("modules.php");
	require("../config.php");
	
	ini_set('display_errors', 1);
	error_reporting(E_ALL);	

	require("../settings.php");
	require("../functions.php");

	require("../classes/class.template.php");
	require("../classes/class.item.php");
	require("../classes/class.list.php");
	require("../classes/class.pages.php");
	require("../classes/class.settings_groups.php");
	require("../classes/class.settings.php");
	require("../classes/class.tree.php");
	require("../classes/class.daily.php");
	require("../classes/class.event.php");
	require("../classes/class.maintext.php");
	require("../classes/class.partner.php");
	require("../classes/class.service.php");
	require("../classes/class.stock.php");
	require("../classes/class.video.php");
	require("../classes/class.photo.php");
	require("../classes/class.review.php");
	require("../classes/class.comment.php");
	require("../classes/class.slider.php");
	require("../classes/class.user.php");
	require("../classes/class.article.php");
	require("../classes/class.release.php");
	require("../classes/class.media.php");
	require("../classes/class.offer.php");
	require("../classes/class.department.php");
	require("../classes/class.clinic.php");
	require("../classes/class.specialization.php");
	require("../classes/class.doctor.php");
	require("../classes/class.advantage.php");

	load_sets(); 

	if (!isset($_SESSION["access"])) $page = "default";
	else if ($_SESSION['access']!='full_access') $page = "default";
	else $page = getVar('page','default');
	
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

	$tpl->parseBlock('_INIT', array(
		'PAGE_TITLE' => $PAGE_TITLE,
		'PAGE_DESCRIPTION' => $PAGE_DESCRIPTION,
		'PAGE_KEYWORDS' => $PAGE_KEYWORDS,
		'HOST' => HOST
	));
	$tpl->show();
?>