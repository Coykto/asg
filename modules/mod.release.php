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
		
		if ($mainname->info['banner']!='') 
		{
			if ($mainname->info['redlineimg1']!='') tplParseBlock('redline2', array(
				'NAME' => $mainname->info['redlinename1'],
				'IMG' => $mainname->info['redlineimg1'],
				'TEXT' => $mainname->info['redlinetext1']
			));
			else if ($mainname->info['redlinename1']!='') tplParseBlock('redline1', array(
				'NAME' => $mainname->info['redlinename1']
			));
			if ($mainname->info['redlineimg2']!='') tplParseBlock('redline2', array(
				'NAME' => $mainname->info['redlinename2'],
				'IMG' => $mainname->info['redlineimg2'],
				'TEXT' => $mainname->info['redlinetext2']
			));
			if ($mainname->info['redlineimg3']!='') tplParseBlock('redline2', array(
				'NAME' => $mainname->info['redlinename3'],
				'IMG' => $mainname->info['redlineimg3'],
				'TEXT' => $mainname->info['redlinetext3']
			));

			tplParseBlock('hero', array(
				'BANNER' => $mainname->info['banner'],
				'BANNER_TEXT' => $mainname->info['banner_text'],
				'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
				'SBANNER_TEXT' => get_set('banner')
			));
		}

		$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE id IN (".$mainname->info['ch_ids'].") AND visible='1' ORDER BY find_in_set(id, '".$mainname->info['ch_ids']."') ");
		while ($row = $res->fetch_array())
		{
			$node = $tree->getNode($row['id']);
			tplParseBlock('item', array(
				'NAME' => $node->info['h1'],
				'IMG' => $node->info['img'],
				'CPU' => $tree->getCpu($node),
				'HOST' => HOST
			));
		}
/*
		foreach ($mainname->children AS $node)
		tplParseBlock('item', array(
			'NAME' => $node->info['name'],
			'IMG' => $node->info['img'],
			'CPU' => $tree->getCpu($node),
			'HOST' => HOST
		));
*/

		$blogcpu = gf(4,TABLE_TREE,"cpu","ptid");
		if ( ($blogcpu!='') && ($mainname->info['bid']!='') )
		{
			if ( ($mainname->info['blogscheme']==0) || ($mainname->info['blogscheme']==3) ) $icount = 5;
			else if ($mainname->info['blogscheme']==1) $icount = 6;
			else if ($mainname->info['blogscheme']==2) $icount = 7;

			$i = 0;
			$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE id IN (".$mainname->info['bid'].") AND visible='1' ORDER BY find_in_set(id, '".$mainname->info['bid']."') ");
			while ($row = $res->fetch_array())
			{
				$i++;
				if ($mainname->info['blogscheme']==0)
				{
					if ( ($i%$icount==3) && ($row['img1']!='') ) $img = $row['img1'];
					else $img = $row['img'];
				}
				else if ($mainname->info['blogscheme']==1)
				{
					if ( ($i%$icount==4) && ($row['img1']!='') ) $img = $row['img1'];
					else $img = $row['img'];
				}
				else if ($mainname->info['blogscheme']==2)
				{
					if ( ( ($i%$icount==3) || ($i%$icount==6) ) && ($row['img1']!='') ) $img = $row['img1'];
					else $img = $row['img'];
				}
				else if ($mainname->info['blogscheme']==3)
				{
					if ( ( ($i%$icount==2) || ($i%$icount==3) ) && ($row['img1']!='') ) $img = $row['img1'];
					else $img = $row['img'];
				}
				tplParseBlock('blog_item', array(
					'NAME' => $row['name'],
					'TEXTSMALL' => $row['textsmall'],
					'IMG' => $img,
					'IMGM' => $row['img'],
					'CPU1' => $blogcpu,
					'CPU2' => $row['cpu'],
					'I' => $i,
					'HOST' => HOST
				));
				if ($i==$icount)
				{
					if ($mainname->info['blogscheme']!=0) tplParseBlock('blog_scheme', array(
						'I' => $mainname->info['blogscheme']+1
					));
					tplParseBlock('blog');
					$i = 0;
				}
			}

			if ($i%$icount!=0)
			{
				if ($mainname->info['blogscheme']!=0) tplParseBlock('blog_scheme', array(
					'I' => $mainname->info['blogscheme']+1
				));
				tplParseBlock('blog');
				$i = 0;
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

		$res = $mysqli->query("SELECT * FROM ".TABLE_ADVANTAGES." WHERE cid='".$mainname->info['id']."' AND visible='1' ORDER BY ordernum");
		while ($row = $res->fetch_array())
		tplParseBlock('advantages_item',array(
			'TEXT' => $row["text"],
			'NAME' => $row["name"],
			'IMG' => $row["img"]
		));
		
		if ($mainname->info['text']!='') tplParseBlock('text',array(
			'TEXT' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text']))
		));
		
		if ($mainname->info['text1']!='') tplParseBlock('text1',array(
			'TEXT1' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text1']))
		));
		
		if ($mainname->info['text2']!='') tplParseBlock('text2',array(
			'TEXT2' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text2']))
		));

		$i = 0;
		$list = new cVideoList();
		$list->setFilter(array(FILTER_VISIBLE => 1));
		$list = $list->getList();
		foreach ($list as $item)
		{
			$i++;
			tplParseBlock('people_item1', array(
				'NAME' => $item->info['name'],
				'TEXT' => $item->info['text'],
				'IMG' => $item->info['img']
			));
			if ($i%2==1) tplParseBlock('people_item21');
			else tplParseBlock('people_item22');
			tplParseBlock('people_item2', array(
				'NAME' => $item->info['name'],
				'TEXT' => $item->info['text'],
				'IMG' => $item->info['img']
			));
		}
		if ($i%2==1) tplParseBlock('people_item222');

		$i = 0;
		$list = new cPartnerList();
		$list->setFilter(array(FILTER_VISIBLE => 1));
		$list = $list->getList();
		foreach ($list as $item)
		{
			$i++;
			if ($item->info['link']!='') 
			{
				tplParseBlock('partner_item1_a', array(
					'LINK' => $item->info['link']
				));
				tplParseBlock('partner_item2_a', array(
					'LINK' => $item->info['link']
				));
			}
			else 
			{
				tplParseBlock('partner_item1_na');
				tplParseBlock('partner_item2_na');
			}
			tplParseBlock('partner_item1', array(
				'NAME' => $item->info['name'],
				'IMG' => $item->info['img']
			));
			if ($i%2==1) tplParseBlock('partner_item21');
			else tplParseBlock('partner_item22');
			tplParseBlock('partner_item2', array(
				'NAME' => $item->info['name'],
				'IMG' => $item->info['img']
			));
		}
		if ($i%2==1) tplParseBlock('partner_item222');

		$list = new cSliderList();
		$list->setFilter(array(FILTER_VISIBLE => 1));
		$list = $list->getList();
		foreach ($list as $item)
		tplParseBlock('slider_item', array(
			'IMG' => $item->info['img']
		));

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