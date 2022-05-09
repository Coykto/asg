<?
class cModClinic
{
    function Init()
    {
        tplLoadTemplateFile('clinic.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli;
		
		addblock('block6', array(
			'BLOCK6' => get_set('block6')
		));

		addblock('block5', array(
			'BLOCK5' => get_set('block5'),
			'MAP' => get_set('map')
		));		

		$list = new cVideoList();
		$list->setFilter(array(FILTER_VISIBLE => 1));
		$list = $list->getList();
		foreach ($list as $item)
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$item->info['id']."' AND tt='video' AND visible='1' ORDER BY ordernum DESC");
			while ($row = $res->fetch_array())
			tplParseBlock('designer_gal_item',array(
				'IMG' => $row["img"],
				'SIMG' => $row["simg"]
			));

			if ($item->info['email']!='') tplParseBlock('designer_email', array(
				'EMAIL' => $item->info['email']
			));
			if ($item->info['phone']!='') tplParseBlock('designer_phone', array(
				'PHONE' => $item->info['phone']
			));
			if ($item->info['soc1']!='') tplParseBlock('designer_soc1', array(
				'SOC1' => $item->info['soc1']
			));
			if ($item->info['soc2']!='') tplParseBlock('designer_soc2', array(
				'SOC2' => $item->info['soc2']
			));
			if ($item->info['soc3']!='') tplParseBlock('designer_soc3', array(
				'SOC3' => $item->info['soc3']
			));
			if ($item->info['soc4']!='') tplParseBlock('designer_soc4', array(
				'SOC4' => $item->info['soc4']
			));

			tplParseBlock('designer', array(
				'TEXT' => $item->info['text'],
				'NAME' => $item->info['name'],
				'IMG' => $item->info['img'],
			));
		}

		tplParseBlock('block_center', array(
			'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
			'TEXT' => str_replace("../",HOST,str_replace("../upload-files/",HOSTM."/upload-files/",$mainname->info['text'])),
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