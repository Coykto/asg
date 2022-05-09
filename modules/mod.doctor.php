<?
class cModDoctor
{
    function Init()
    {
        tplLoadTemplateFile('doctor.tpl');
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

		$cid = array();
		$res = $mysqli->query("SELECT * FROM ".TABLE_SLIDERS." WHERE visible='1' ORDER BY ordernum");
		while ($row = $res->fetch_array())
		{
			$cat = explode(',',$row['cid']);
			$cats = array();
			foreach ($cat AS $val)
			if ($val!='')
			{
				$cats[] = 'lampcat'.$val;
				if (!in_array($val, $cid)) $cid[] = $val;
			}
			tplParseBlock('lamp',array(
				'IMG' => $row["img"],
				'NAME' => $row["name"],
				'PRICE' => $row["price"],
				'CATS' => implode(' ',$cats),
				'TEXT' => $row["text"]
			));
		}
		
		if (sizeof($cid)>0)
		{
			$res = $mysqli->query("SELECT * FROM slider_cats WHERE id IN (".implode(",",$cid).")");
			while ($row = $res->fetch_array())
			tplParseBlock('lamp_cat',array(
				'ID' => $row["id"],
				'NAME' => $row["name"]
			));
		}
		
		$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$mainname->info['id']."' AND tt='gal1' AND visible='1' ORDER BY ordernum DESC");
		$cou = $res->num_rows;
		while ($row = $res->fetch_array())
		tplParseBlock('work_item',array(
			'IMG' => $row["img"],
			'SIMG' => $row["simg"],
			'NAME' => $row["name"]
		));
		if ($cou>0) tplParseBlock('work',array(
			'NAME' => $mainname->info['gname']
		));

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