<?
class cModRelease
{
    function Init()
    {
        tplLoadTemplateFile('release.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli;
		
		if ($mainname->info['banner']!='') tplParseBlock('hero', array(
			'BANNER' => $mainname->info['banner'],
			'BANNER_TEXT' => $mainname->info['banner_text'],
			'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
			'SBANNER_TEXT' => get_set('banner')
		));
		
		foreach ($mainname->children AS $node)
		tplParseBlock('item', array(
			'NAME' => $node->info['name'],
			'IMG' => $node->info['img'],
			'CPU' => $tree->getCpu($node),
			'HOST' => HOST
		));

		$blogcpu = gf(4,TABLE_TREE,"cpu","ptid");
		if ( ($blogcpu!='') && ($mainname->info['bid']!='') )
		{
			$i = 0;
			$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE id IN (".$mainname->info['bid'].") AND visible='1' ORDER BY find_in_set(id, '".$mainname->info['bid']."') ");
			while ($row = $res->fetch_array())
			{
				$i++;
				tplParseBlock('blog_item', array(
					'NAME' => $row['name'],
					'TEXTSMALL' => $row['textsmall'],
					'IMG' => $row['img'],
					'CPU1' => $blogcpu,
					'CPU2' => $row['cpu'],
					'I' => $i,
					'HOST' => HOST
				));
			}
		}

		if ($mainname->info['faq']!='')
		{
			$faq = explode('-----',$mainname->info['faq']);
			foreach ($faq AS $key => $val)
			{
				$aq = explode('---',$val);
				if ($key<1) tplParseBlock('faq_item_open');
				tplParseBlock('faq_item', array(
					'NAME' => $aq[0],
					'TEXT' => str_replace("\n","<br>",$aq[1])
				));
			}
		}
		
		tplParseBlock('block_center', array(
			'TEXT' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text'])),
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