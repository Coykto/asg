<?
class cModError404
{
    function Init()
    {
        tplLoadTemplateFile('error404.tpl');
    }

	function show()
    {
		tplParseBlock('block_center', array(
			'HOST' => HOST
		));
		
		$GLOBALS['PAGE_TITLE'] = 'Ошибка 404';
    }

    function Run()
    {
		if (isset($_REQUEST['action']))
        {
			switch ($_REQUEST['action'])
        	{
        		case "": break;
        	}
        }
        $this->show();
    }
}
?>