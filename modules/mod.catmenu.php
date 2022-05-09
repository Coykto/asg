<?
class cModCatmenu
{
    function Init()
    {
        tplLoadTemplateFile('catmenu.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $mysqli, $tree, $firstnode;

		foreach ($firstnode->children AS $node)
		{
			if ($node->info['mainmenu']=='1')
			{
				$i = 0;
				foreach ($node->children AS $node1)
				{
					if ($node1->info['mainmenu']=='1')
					{
						$i++;
						$j = 0;
						foreach ($node1->children AS $node2)
						if ($node2->info['mainmenu']=='1') 
						{
							$j++;
							tplParseBlock('left_item_sub_item_sub_item',array(
								'CPU' => $tree->getCpu($node2),
								'NAME' => $node2->info["name"],
								'HOST' => HOST
							));
						}
						if ($j>0)
						{
							tplParseBlock('left_item_sub_item_na');
							tplParseBlock('left_item_sub_item_na1');
							tplParseBlock('left_item_sub_item_na2');
						}
						else
						{						
							tplParseBlock('left_item_sub_item_a1',array(
								'CPU' => $tree->getCpu($node1),
								'HOST' => HOST
							));
							tplParseBlock('left_item_sub_item_a2');
						}
						tplParseBlock('left_item_sub_item',array(
							'NAME' => $node1->info["name"]
						));
					}
				}
				if ($i>0)
				{
					tplParseBlock('left_item_open');
				}
				else 
				{
					tplParseBlock('left_item_a1',array(
						'CPU' => $tree->getCpu($node),
						'HOST' => HOST
					));
					tplParseBlock('left_item_a2');
				}
				tplParseBlock('left_item',array(
					'NAME' => $node->info["name"]
				));
			}
		}
		
		$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE parent_id=".$mainname->info['id']." AND visible='1' ORDER BY ordernum");
		while ($row = $res->fetch_array())
		tplParseBlock('listing_item',array(
			'NAME' => $row["name"],
			'IMG' => $row["img"],
			'HAR' => $row["har"],
			'CPU' => $tree->getCpu($tree->getNode($row['id'])),
			'HOST' => HOST
		));

		tplParseBlock('block_center', array(
			'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
			'TEXT' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text'])),
			'CPU1' => $tree->getCpu($tree->getNode($mainname->info['parent_id'])),
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