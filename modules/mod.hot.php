<?
class cModHot
{
    function Init()
    {
        tplLoadTemplateFile('hot.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli;

		$list = new cStockList();
		$list->setFilter(array(FILTER_VISIBLE => 1));
		$list = $list->getList();
		foreach ($list as $item)
		{
			if ($item->info['showname']) tplParseBlock('item_name', array(
				'NAME' => $item->info['name']
			));
			if ($item->info['showbutton']) tplParseBlock('item_button');
			tplParseBlock('item', array(
				'IMG' => $item->info['img']
			));
		}

		tplParseBlock('block_center', array(
			'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
			'NAME' => $mainname->info['name'],
			'HOST' => HOST
		));
		
		$GLOBALS['PAGE_TITLE'] = $mainname->info['title'];
		$GLOBALS['PAGE_DESCRIPTION'] = $mainname->info['description'];
		$GLOBALS['PAGE_KEYWORDS'] = $mainname->info['keywords'];
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