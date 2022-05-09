<?
class cModPrice
{
    function Init()
    {
        tplLoadTemplateFile('price.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli;

		$spec = new cSpecializationList();
		$spec = $spec->getList();

		$chars_count = 0;
		$chars_all = array();
		foreach ($mainname->children as $node_id => $node)
		{
			$chars = array();
			foreach ($node->children as $node_id1 => $node1)
			{
				$sid = ($node1->info['sid']!='') ? explode(',',$node1->info['sid']) : array();
				foreach ($sid AS $val)
				{
					if (!isset($chars[$val])) $chars[$val] = 0;
					if (!isset($chars_all[$val][$node_id])) $chars_all[$val][$node_id] = 0;
					$chars[$val]++;
				}
				$chars_count++;
			}
			$class = array();
			foreach ($chars AS $key => $val)
			if (isset($spec[$key]->info['id'])) 
			{
				tplParseBlock('item_tag',array(
					'NAME' => $spec[$key]->info['name'],
					'ID' => $key,
					'COUNT' => $val,
					'IMG' => $node->info['img'],
					'CPU' => $tree->getCpu($node),
					'HOST' => HOST
				));
				$class[] = 'char'.$key;
			}

			tplParseBlock('item',array(
				'NAME' => $node->info['name'],
				'IMG' => $node->info['img'],
				'CPU' => $tree->getCpu($node),
				'CLASS' => implode(' ',$class),
				'HOST' => HOST
			));
		}

		foreach ($chars_all AS $key => $val)
		if (isset($spec[$key]->info['id'])) 
		{
			tplParseBlock('char',array(
				'NAME' => $spec[$key]->info['name'],
				'ID' => $key,
				'COUNT' => sizeof($val)
			));
		}
		tplParseBlock('chars',array(
			'COUNT' => $chars_count
		));

		if ($mainname->info['price_ids']!='')
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE id IN (".$mainname->info['price_ids'].")");
			while ($row = $res->fetch_array())
			{
				$node = $tree->getNode($row['id']);
				if ($node->info['parent_id']>0)
				{
					$parent = $tree->getNode($row['parent_id']);
					tplParseBlock('price_item_cat',array(
						'NAME' => $parent->info['name'],
						'CPU' => $tree->getCpu($parent),
						'HOST' => HOST
					));
				}
				tplParseBlock('price_item',array(
					'NAME' => $row['name'],
					'IMG' => $row['img'],
					'CPU' => $tree->getCpu($node),
					'HOST' => HOST
				));
			}
			tplParseBlock('price',array(
				'NAME' => $mainname->info['price_name']
			));
		}

		tplParseBlock('block_center', array(
			'TEXT' => str_replace("../",HOST,str_replace("../upload-files/",HOSTM."/upload-files/",$mainname->info['text'])),
			'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
			'NAME' => $mainname->info['name'],
			'BLOCK7' => get_set('block7'),
			'BLOCK4' => get_set('block4'),
			'BLOCK6' => get_set('block6'),
			'BLOCK3' => get_set('block3'),
			'MAP' => get_set('map'),
			'NAME1' => $mainname->parent_node->info['name'],
			'CPU1' => $tree->getCpu($mainname->parent_node),
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