<?
class cModGalfilter
{
    function Init()
    {
        tplLoadTemplateFile('galfilter.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $mysqli, $tree;

		$radio = array();
		$res = $mysqli->query("SELECT har FROM ".TABLE_GFOTOS." WHERE gid='".$mainname->info['id']."' AND tt='gal1' AND visible='1' GROUP BY har ORDER BY har");
		while ($row = $res->fetch_array())
		if ($row[0]!='') $radio[] = $row[0];
		foreach ($radio AS $key => $val)
		tplParseBlock('radio',array(
			'NAME' => $val,
			'I' => $key+1
		));

		$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$mainname->info['id']."' AND tt='gal1' AND visible='1' ORDER BY ordernum DESC");
		while ($row = $res->fetch_array())
		{
			$key = array_search($row['har'],$radio);
			if ($key===false) $key = 0;
			else $key++;
			tplParseBlock('listing_item',array(
				'NAME' => $row["name"],
				'HAR' => $row["har"],
				'IMG' => $row["img"],
				'I' => $key
			));
		}

		tplParseBlock('block_center', array(
			'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
			'TEXT' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$mainname->info['text'])),
			'CPU1' => $tree->getCpu($tree->getNode($mainname->info['parent_id'])),
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