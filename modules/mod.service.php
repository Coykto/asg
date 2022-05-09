<?
class cModService
{
    function Init()
    {
        tplLoadTemplateFile('service.tpl');
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
				'BANNER_MOBILE' => ($mainname->info['banner_mobile']!='') ? $mainname->info['banner_mobile'] : $mainname->info['banner'],
				'BANNER_TEXT' => $mainname->info['banner_text'],
				'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
				'NAME1' => ($mainname->info['parent_id']>0) ? $mainname->parent_node->info['name'] : '',
				'SBANNER_TEXT' => get_set('banner')
			));
		}

		if ($mainname->info['parent_id']>0) tplParseBlock('bread', array(
			'CPU' => $mainname->parent_node->info['cpu'],
			'NAME' => $mainname->parent_node->info['name'],
			'HOST' => HOST
		));

		$res = $mysqli->query("SELECT * FROM ".TABLE_ADVANTAGES." WHERE cid='".$mainname->info['id']."' AND visible='1' ORDER BY ordernum");
		while ($row = $res->fetch_array())
		tplParseBlock('advantages_item',array(
			'TEXT' => $row["text"],
			'NAME' => $row["name"],
			'IMG' => $row["img"]
		));

		$res = $mysqli->query("SELECT * FROM ".TABLE_RELEASES." WHERE cid='".$mainname->info['id']."' AND visible='1' ORDER BY ordernum");
		while ($row = $res->fetch_array())
		{
			if ($row['price']!='') tplParseBlock('item_price',array(
				'PRICE' => $row["price"]
			));
			if ($row['text']!='')
			{
				$har = explode("\n",$row['text']);
				$val = explode("\n",$row['text1']);
				foreach ($har AS $key => $ar)
				if ($ar!='') tplParseBlock('item_har',array(
					'NAME' => $ar,
					'TEXT' => $val[$key]
				));
			}
			tplParseBlock('item',array(
				'NAME' => $row["name"],
				'IMG' => $row["img"]
			));
		}
		
		if ($mainname->info['text2']!='') tplParseBlock('text2', array(
			'TEXT2' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text2']))
		));
		if ($mainname->info['text3']!='') tplParseBlock('text3', array(
			'TEXT3' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text3']))
		));

		$class = array('small-small-4','small-small-1','small-small-2','big','medium','small-small-3');
		$gn = strtolower(strip_tags($mainname->info['name']));
		$gal = array();
		$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE tt='gal1' AND LOCATE(',".$gn.",',CONCAT(',',REPLACE(name,', ',','),','))>0 ORDER BY ordernum DESC");
		while ($row = $res->fetch_array())
		$gal[$row['id']] = $row;
		$cou = sizeof($gal);

		$i = 0;
		$res = $mysqli->query("SELECT * FROM gallid WHERE cid='".$mainname->info['id']."' ORDER BY ordernum");
		while ($row = $res->fetch_array())
		if (isset($gal[$row['pid']]))
		{
			$i++;
			$x = $i%6;
			tplParseBlock('gal_item',array(
				'SIMG' => $gal[$row['pid']]["simg"],
				'IMG' => $gal[$row['pid']]["img"],
				'HAR' => $gal[$row['pid']]["har"],
				'CLASS' => $class[$x]
			));
			unset($gal[$row['pid']]);
			if ($x==0)
			{
				if ( ($i==6) && ($cou>6) ) tplParseBlock('gal_more');
				if ($i>6) tplParseBlock('gal_h');
				tplParseBlock('gal');
			}
		}
		foreach ($gal AS $key => $val)
		{
			$i++;
			$x = $i%6;
			tplParseBlock('gal_item',array(
				'SIMG' => $val["simg"],
				'IMG' => $val["img"],
				'HAR' => $val["har"],
				'CLASS' => $class[$x]
			));
			if ($x==0)
			{
				if ( ($i==6) && ($cou>6) ) tplParseBlock('gal_more');
				if ($i>6) tplParseBlock('gal_h');
				tplParseBlock('gal');
			}
		}
		if ( (isset($x)) && ($x>0) )
		{
			if ($i>6) tplParseBlock('gal_h');
			tplParseBlock('gal');
		}

		$blogcpu = gf(4,TABLE_TREE,"cpu","ptid");
		if ( ($blogcpu!='') && ($mainname->info['bid']!='') )
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE id IN (".$mainname->info['bid'].") AND visible='1' ORDER BY find_in_set(id, '".$mainname->info['bid']."') LIMIT 0,2 ");
			$cou = $res->num_rows;
			while ($row = $res->fetch_array())
			tplParseBlock('blog'.$cou.'_item', array(
				'NAME' => $row['name'],
				'TEXTSMALL' => $row['textsmall'],
				'IMG' => $row['img'],
				'IMG1' => $row['img1'],
				'CPU1' => $blogcpu,
				'CPU2' => $row['cpu'],
				'IMG3' => $row['img3'],
				'HOST' => HOST
			));
			if ($cou>0) tplParseBlock('blog'.$cou, array(
				'BLOGNAME' => $mainname->info['blogname']
			));
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

		if ($mainname->info['oid']!='')
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE id IN (".$mainname->info['oid'].") AND visible='1' ORDER BY find_in_set(id, '".$mainname->info['oid']."') LIMIT 0,3 ");
			while ($row = $res->fetch_array())
			{
				$node = $tree->getNode($row['id']);
				tplParseBlock('sub_item',array(
					'NAME' => $row['name'],
					'IMG4' => $row['img4'],
					'TEXTSMALL' => $row['textsmall'],
					'CPU' => $tree->getCpu($node),
					'HOST' => HOST
				));
			}
		}
		
		if ($mainname->info['cons_text']!='') tplParseBlock('block1',array(
			'CONS_TEXT' => $mainname->info['cons_text'],
			'CONS_IMG' => $mainname->info['cons_img']
		));
		
		if ($mainname->info['text']!='') tplParseBlock('text',array(
			'TEXT' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text']))
		));
		
		if ($mainname->info['text1']!='') tplParseBlock('text1',array(
			'TEXT1' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text1']))
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