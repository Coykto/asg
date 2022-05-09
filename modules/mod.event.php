<?
class cModEvent
{
    function Init()
    {
        tplLoadTemplateFile('event.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $data, $cpuarr, $mysqli;

		$cname = array();
		$res = $mysqli->query("SELECT * FROM daily_cats ORDER BY id");
		while ($row = $res->fetch_array())
		$cname[$row['id']] = $row['name'];
		
		if (!isset($data))
		{
			addblock('block6', array(
				'BLOCK6' => get_set('block6')
			));

			$cid = array();
			$res = $mysqli->query("SELECT * FROM ".TABLE_DAILYS." WHERE visible='1' ORDER BY date DESC");
			while ($row = $res->fetch_array())
			{
				$cat = explode(',',$row['cid']);
				$cats = array();
				$tags = array();
				foreach ($cat AS $val)
				if ($val!='')
				{
					$tags[] = '#'.$cname[$val];
					$cats[] = 'designcat'.$val;
					if (!in_array($val, $cid)) $cid[] = $val;
				}
				tplParseBlock('listing_item',array(
					'IMG' => $row["img"],
					'NAME' => $row["name"],
					'CPU1' => $mainname->info['cpu'],
					'CPU2' => $row["cpu"],
					'CATS' => implode(' ',$cats),
					'TAGS' => implode(' ',$tags),
					'VIEWS' => $row["views"],
					'LIKES' => $row["likes"],
					'ID' => $row["id"],
					'HOST' => HOST
				));
			}
			
			if (sizeof($cid)>0)
			{
				$res = $mysqli->query("SELECT * FROM daily_cats WHERE id IN (".implode(",",$cid).")");
				while ($row = $res->fetch_array())
				tplParseBlock('listing_cat',array(
					'ID' => $row["id"],
					'NAME' => $row["name"]
				));
			}

			tplParseBlock('listing', array(
				'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
				'TEXT' => str_replace("../",HOST,str_replace("../upload-files/",HOSTM."/upload-files/",$mainname->info['text'])),
				'HOST' => HOST
			));
			
			$GLOBALS['PAGE_TITLE'] = $mainname->info['title'];
			$GLOBALS['PAGE_DESCRIPTION'] = $mainname->info['description'];
			$GLOBALS['PAGE_KEYWORDS'] = $mainname->info['keywords'];
		}
		else
		{
			$res = $mysqli->query("UPDATE ".TABLE_DAILYS." SET views=views+1 WHERE id='".$data['id']."' ");
			
			addblock('block2', array(
				'BLOCK2' => get_set('block2')
			));

			if ($data['banner']!='') tplParseBlock('hero', array(
				'TEXT' => $data['text'],
				'BANNER' => $data['banner']
			));
		
			$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$data['id']."' AND tt='daily' AND visible='1' ORDER BY ordernum DESC");
			$cou = $res->num_rows;
			while ($row = $res->fetch_array())
			tplParseBlock('open_gallery_item',array(
				'IMG' => $row["img"],
				'SIMG' => $row["simg"],
				'NAME' => $row["name"]
			));
			if ($data['tid']!='')
			{
				$tid = explode(',',$data['tid']);
				foreach ($tid AS $val)
				{
					$node = $tree->getNode($val);
					if ($node->info["price"]!='') tplParseBlock('open_tech_item_price',array(
						'PRICE' => $node->info["price"]
					));
					tplParseBlock('open_tech_item',array(
						'IMG' => $node->info["img"],
						'NAME' => $node->info["name"],
						'CPU' => $tree->getCpu($node),
						'HOST' => HOST
					));
				}
				tplParseBlock('open_tech');
			}

			$res = $mysqli->query("SELECT * FROM ".TABLE_DAILYS." WHERE visible='1' AND main='1' ORDER BY date DESC");
			$cou = $res->num_rows;
			while ($row = $res->fetch_array())
			{
				$cat = explode(',',$row['cid']);
				$tags = array();
				foreach ($cat AS $val)
				$tags[] = '#'.$cname[$val];
				tplParseBlock('open_pro_item',array(
					'IMG' => $row["img"],
					'NAME' => $row["name"],
					'CPU1' => $mainname->info['cpu'],
					'CPU2' => $row["cpu"],
					'CATS' => implode(' ',$cats),
					'TAGS' => implode(' ',$tags),
					'VIEWS' => $row["views"],
					'LIKES' => $row["likes"],
					'ID' => $row["id"],
					'HOST' => HOST
				));
			}
			if ($cou>0) tplParseBlock('open_pro',array(
				'CPU1' => $mainname->info['cpu'],
				'HOST' => HOST
			));

			tplParseBlock('open', array(
				'NAME' => $data['name'],
				'NAME1' => $data['name1'],
				'IMG' => $data['img'],
				'TEXT1' => str_replace("../",HOST,str_replace("../upload-files/",HOSTM."/upload-files/",$data['text1'])),
				'TEXT2' => str_replace("../",HOST,str_replace("../upload-files/",HOSTM."/upload-files/",$data['text2'])),
				'HOST' => HOST
			));

			$GLOBALS['PAGE_TITLE'] = $data['title'];
			$GLOBALS['PAGE_DESCRIPTION'] = $data['description'];
			$GLOBALS['PAGE_KEYWORDS'] = $data['keywords'];
		}
		
		addblock('block5', array(
			'BLOCK5' => get_set('block5'),
			'MAP' => get_set('map')
		));
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