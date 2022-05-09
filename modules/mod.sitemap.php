<?
class cModSitemap
{
    function Init()
    {
        tplLoadTemplateFile('sitemap.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli;

		foreach ($tree->nodes as $node_id => $node)
		if ( ($node->info['name']!=TREE_ROOT_NODE_NAME) && ($node->info['ptid']!=2) && ($node->info['ptid']!=20) )
		{
			$cpu = $tree->getCpu($node);
			tplParseBlock('item', array(
				'CPU' => $cpu,
				'NAME' => $node->info['name'],
				'MARGIN' => str_repeat("&nbsp;",($node->getLevel()-1)*5),
				'HOST' => HOST
			));
			if ($node->info['ptid']==4)
			{
				$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE visible='1' ORDER BY ordernum DESC");
				while ($row = $res->fetch_array())
				tplParseBlock('item', array(
					'CPU' => $cpu.'/'.$row['cpu'],
					'NAME' => $row['name'],
					'MARGIN' => str_repeat("&nbsp;",($node->getLevel())*5),
					'HOST' => HOST
				));
			}
		}

		tplParseBlock('block_center', array(
			'NAME' => $mainname->info['name']
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