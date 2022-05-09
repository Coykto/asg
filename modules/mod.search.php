<?
class cModSearch
{
    function Init()
    {
		tplLoadTemplateFile('search.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli;

		$word = getVar('word');

		if (mb_strlen($word)>1)
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE visible='1' AND (name LIKE '%".$word."%' OR h1 LIKE '%".$word."%') ");
			while ($row = $res->fetch_array())
			tplParseBlock('item',array(
				'CPU' => $tree->getCpu($tree->getNode($row['id'])),
				'NAME' => $row["name"],
				'HOST' => HOST
			));
			
			$blog = gf(4,TABLE_TREE,'id','ptid');
			if ($blog>0)
			{
				$blog = $tree->getCpu($tree->getNode($blog));
				$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE visible='1' AND name LIKE '%".$word."%' ");
				while ($row = $res->fetch_array())
				tplParseBlock('item',array(
					'CPU' => $blog.'/'.$row['cpu'],
					'NAME' => $row["name"],
					'HOST' => HOST
				));
			}
		}
		else tplParseBlock('error');

		tplParseBlock('block_center', array(
			'WORD' => $word,
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