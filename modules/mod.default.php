<?
class cModDefault
{
    function Init()
    {
		tplLoadTemplateFile('default.tpl');
    }

    function get_middle_menu_id($list)
    {
        foreach ($list as $service_id => $service)
            if ($service->info['name']=="MiddleMenu") return $service_id;
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli;

		if ($mainname->info['banner']!='') 
		{
			if ($mainname->info['redlinename1']!='') tplParseBlock('hero_red_item', array(
				'NAME' => $mainname->info['redlinename1'],
				'TEXT' => $mainname->info['redlinetext1']
			));
			if ($mainname->info['redlinename2']!='') tplParseBlock('hero_red_item', array(
				'NAME' => $mainname->info['redlinename2'],
				'TEXT' => $mainname->info['redlinetext2']
			));
			if ($mainname->info['redlinename3']!='') tplParseBlock('hero_red_item', array(
				'NAME' => $mainname->info['redlinename3'],
				'TEXT' => $mainname->info['redlinetext3']
			));
			tplParseBlock('hero', array(
				'BANNER' => $mainname->info['banner'],
				'BANNER_TEXT' => $mainname->info['banner_text'],
				'BANNER_MOBILE' => ($mainname->info['banner_mobile']!='') ? $mainname->info['banner_mobile'] : $mainname->info['banner'],
				'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
				'SBANNER_TEXT' => get_set('banner')
			));
		}
		
		$x = 0;
		$service_list = new cServiceList();
		$service_list->setFilter(array(
			FILTER_VISIBLE => '1',
            FILTER_ITEM => '62'
		));
		$list = $service_list->getList();
        $service_id = $this->get_middle_menu_id($list);

        foreach ($list as $service_id1 => $service1)
        if ($service1->info['parent_id']==$service_id)
        {
            $img2 = '';
            foreach ($list as $service_id2 => $service2)
            if ($service2->info['parent_id']==$service_id1)
            {
                $node = $tree->getNode($service2->info['pid']);
                if ($img2=='') $img2 = $node->info['img2'];
                tplParseBlock('services_item_sub', array(
                    'NAME' => $service2->info['name'],
                    'IMG2' => ($node->info['img2']!='') ? '/templates/images/tree/'.$node->info['img2'] : '',
                    'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
                ));
                tplParseBlock('services_mobile_sub', array(
                    'NAME' => $service2->info['name'],
                    'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
                ));
            }

            $node = $tree->getNode($service1->info['pid']);
            tplParseBlock('services_tab', array(
                'NAME' => $service1->info['name'],
                'IMG1' => $node->info['img1'],
                'TEXTSMALL1' => $node->info['textsmall1'],
            ));

            if ($img2!='') tplParseBlock('services_item_img2', array(
                'IMG2' => $img2
            ));
            tplParseBlock('services_item', array(
                'NAME' => $service1->info['name']
            ));
            tplParseBlock('services_mobile', array(
                'NAME' => $service1->info['name'],
                'IMG1' => $node->info['img1'],
                'TEXTSMALL1' => $node->info['textsmall1']
            ));
        }
//		}

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