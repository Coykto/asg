<?

    $http_schema = getenv("DB_DOCKER_SCHEMA") ?: "https";
	define ("HOST", $http_schema.'://'.$_SERVER["HTTP_HOST"].'/');
	define ("HOSTM",'https://industry-company.ru');

	define ("TREE_ROOT_NODE_ID",0);
	define ("TREE_ROOT_NODE_NAME","");
	define ("TREE_ROOT_NODE_LEVEL",0);

	define('TABLE_TREE','tree');
	define('TABLE_SETTINGS_GROUPS','settings_groups');
	define('TABLE_SETTINGS','settings');
	define('TABLE_DAILYS','dailys');
	define('TABLE_EVENTS','events');
	define('TABLE_MAINTEXTS','maintexts');
	define('TABLE_PARTNERS','partners');
	define('TABLE_SERVICES','services');
	define('TABLE_STOCKS','stocks');
	define('TABLE_VIDEOS','videos');
	define('TABLE_PHOTOS','photos');
	define('TABLE_GFOTOS','gfotos');
	define('TABLE_REVIEWS','reviews');
	define('TABLE_SLIDERS','sliders');
	define('TABLE_USERS','users');
	define('TABLE_MEDIAS','medias');
	define('TABLE_RELEASES','releases');
	define('TABLE_ARTICLES','articles');
	define('TABLE_OFFERS','offers');
	define('TABLE_DEPARTMENTS','departments');
	define('TABLE_CLINICS','clinics');
	define('TABLE_SPECIALIZATIONS','specializations');
	define('TABLE_DOCTORS','doctors');
	define('TABLE_COMMENTS','comments');
	define('TABLE_ADVANTAGES','advantages');

	define('FILTER_NODES', 1);
	define('FILTER_VISIBLE', 2);
	define('FILTER_PARENT_NODES', 3);
	define('FILTER_GROUP',4);
	define('FILTER_PARENTID',5);
	define('FILTER_SEARCH',6);
	define('FILTER_ITEM',7);

	define('SQL_TEST',true);
?>