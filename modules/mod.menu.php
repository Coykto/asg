<?
class cModMenu
{
	var $rightmenu = array();
	
    function Init()
    {
		tplloadTemplateFile('menu.tpl');
    }

    function show()
    {
		GLOBAL $tree, $mainname, $page, $cpuarr, $data;

		$service_list = new cServiceList();
		$service_list->setFilter(array(
			FILTER_VISIBLE => '1'
		));
		$list = $service_list->getList();
		foreach ($list as $service_id => $service)
		if ($service->info['parent_id']==0)
		{
			if ($service->info['mtype']==0)
			{
				$x = 0;
				foreach ($list as $service_id1 => $service1)
				if ( ($service1->info['parent_id']==$service_id) && (in_array($service1->info['mtype'],array(1,2))) )
				{
					$x++;
					$s = 0;
					foreach ($list as $service_id2 => $service2)
					if ($service2->info['parent_id']==$service_id1)
					{
						$s++;
						$node = $tree->getNode($service2->info['pid']);
						if ( ($service1->info['mtype']==1) && ($node->info['newitem']==1) ) tplParseBlock('menu10_item_sub_item1_sub_item_new');
						if ($node->info['newitem']==1) tplParseBlock('menu2_item_sub_item_sub_item_new');
						tplParseBlock('menu10_item_sub_item'.$service1->info['mtype'].'_sub_item', array(
							'NAME' => $service2->info['name'],
							'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
							'TEXTSMALL' => $node->info['textsmall'],
							'IMG' => $node->info['img']
						));
						tplParseBlock('menu2_item_sub_item_sub_item', array(
							'NAME' => $service2->info['name'],
							'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' )
						));
					}
					$node = $tree->getNode($service1->info['pid']);
					if ($x==1) 
					{
						tplParseBlock('menu10_item_sub_item'.$service1->info['mtype'].'_a1');
						tplParseBlock('menu10_item_sub_item'.$service1->info['mtype'].'_a2');
					}
					if ($s>0) tplParseBlock('menu10_item_sub_item'.$service1->info['mtype'].'_c');
					tplParseBlock('menu10_item_sub_item'.$service1->info['mtype'], array(
						'NAME' => $service1->info['name'],
						'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
					));
					tplParseBlock('menu2_item_sub_item', array(
						'NAME' => $service1->info['name'],
						'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
					));
				}
				tplParseBlock('menu10_item', array(
					'NAME' => $service->info['name']
				));
				if ($x>0) tplParseBlock('menu2_item_p');
				tplParseBlock('menu2_item', array(
					'NAME' => $service->info['name']
				));
			}
			else if ($service->info['mtype']==1)
			{
				$x = 0;
				foreach ($list as $service_id1 => $service1)
				if ($service1->info['parent_id']==$service_id)
//				if ( ($service1->info['parent_id']==$service_id) && (in_array($service1->info['mtype'],array(1,2))) )
				{
					$x++;
					$i = ($x%3==0) ? 3 : $x%3;
					$node = $tree->getNode($service1->info['pid']);
					if ($node->info['newitem']==1) tplParseBlock('menu11_item_sub_item'.$i.'_new');
					tplParseBlock('menu11_item_sub_item'.$i, array(
						'NAME' => $service1->info['name'],
						'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
					));
					tplParseBlock('menu2_item_sub_item', array(
						'NAME' => $service1->info['name'],
						'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
					));
				}
				tplParseBlock('menu11_item', array(
					'NAME' => $service->info['name']
				));
				if ($x>0) tplParseBlock('menu2_item_p');
				tplParseBlock('menu2_item', array(
					'NAME' => $service->info['name']
				));
			}
			else if ($service->info['mtype']==2)
			{
				$x = 0;
				foreach ($list as $service_id1 => $service1)
				if ($service1->info['parent_id']==$service_id)
				{
					$x++;
					$node = $tree->getNode($service1->info['pid']);
					tplParseBlock('menu12_item_sub_item', array(
						'NAME' => $service1->info['name'],
						'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
						'TEXTSMALL' => $node->info['textsmall'],
						'IMG' => $node->info['img']
					));
					tplParseBlock('menu2_item_sub_item', array(
						'NAME' => $service1->info['name'],
						'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
					));
				}
				tplParseBlock('menu12_item', array(
					'NAME' => $service->info['name']
				));
				if ($x>0) tplParseBlock('menu2_item_p');
				tplParseBlock('menu2_item', array(
					'NAME' => $service->info['name']
				));
			}
			else if ($service->info['mtype']==3)
			{
				$node = $tree->getNode($service->info['pid']);
				tplParseBlock('menu13_item', array(
					'NAME' => $service->info['name'],
					'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
				));
				tplParseBlock('menu2_item', array(
					'NAME' => $service->info['name'],
					'LINK' => ($node->info['link']!='') ? $node->info['link'] : ( ($node->info['ptid'] == 2) ? HOST : HOST.$tree->getCpu($node).'/' ),
				));				
			}
			tplParseBlock('menu1_item');
		}
    }
	
    function Run()
    {
        $this->show();
    }
}
?>