<?
class cModStock
{
    function Init()
    {
        tplLoadTemplateFile('stock.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $data, $cpuarr, $mysqli;

		if (!isset($data))
		{
			$list = new cStockList();
			$list->setFilter(array(FILTER_VISIBLE => 1));
			$list = $list->getList();
			foreach ($list as $item)
			tplParseBlock('listing_item', array(
				'NAME' => $item->info['name'],
				'IMG1' => $item->info['img1'],
				'CPU1' => $cpuarr[0],
				'CPU2' => $item->info['cpu'],
				'HOST' => HOST
			));

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
			addblock('block9', array(
				'BLOCK9' => get_set('block9')
			));
			addblock('block5', array(
				'BLOCK5' => get_set('block5'),
				'MAP' => get_set('map')
			));
			addblock('block6', array(
				'BLOCK6' => get_set('block6')
			));

			$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$data['id']."' AND tt='stock' AND visible='1' ORDER BY ordernum DESC");
			$cou = $res->num_rows;
			while ($row = $res->fetch_array())
			tplParseBlock('work_item',array(
				'IMG' => $row["img"],
				'SIMG' => $row["simg"],
				'NAME' => $row["name"]
			));
			if ($cou>0) tplParseBlock('work',array(
				'NAME' => $data['gname']
			));
		
			tplParseBlock('open', array(
				'NAME' => $data['name'],
				'IMG' => $data['img'],
				'TEXT' => str_replace("../",HOST,str_replace("../upload-files/",HOSTM."/upload-files/",$data['text'])),
				'HOST' => HOST
			));

			$GLOBALS['PAGE_TITLE'] = $data['title'];
			$GLOBALS['PAGE_DESCRIPTION'] = $data['description'];
			$GLOBALS['PAGE_KEYWORDS'] = $data['keywords'];
		}
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