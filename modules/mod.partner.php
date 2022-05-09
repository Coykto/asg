<?
class cModPartner
{
    function Init()
    {
        tplLoadTemplateFile('partner.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli, $cpuarr;

		if (isset($cpuarr[1])) $tag = (int)$cpuarr[1];
		else $tag = 0;

		$cou = 0;
		$mtag = '';
		$res = $mysqli->query("SELECT * FROM tags ORDER BY name");
		while ($row = $res->fetch_array())
		{
			if ($tag==$row['id'])
			{
				$mtag = $row['name'];
			}
			tplParseBlock('tag1', array(
				'CPU' => $cpuarr[0].'/'.$row['id'],
				'COU' => $row['cou'],
				'NAME' => $row['name'],
				'HOST' => HOST
			));
			$cou += $row['cou'];
		}

		$res = $mysqli->query("SELECT * FROM tags ORDER BY cou DESC LIMIT 0,25");
		while ($row = $res->fetch_array())
		{
			if ($tag==$row['id'])
			{
				tplParseBlock('tag_a');
				$mtag = $row['name'];
			}
			tplParseBlock('tag', array(
				'CPU' => $cpuarr[0].'/'.$row['id'],
				'COU' => $row['cou'],
				'NAME' => $row['name'],
				'HOST' => HOST
			));
		}
		
		if ($tag<1)
		{
			tplParseBlock('tagall_a');
		}
		tplParseBlock('tagall', array(
			'CPU' => $cpuarr[0],
			'COU' => $cou,
			'HOST' => HOST
		));
		tplParseBlock('tagall1', array(
			'CPU' => $cpuarr[0],
			'COU' => $cou,
			'HOST' => HOST
		));

		$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE tt='gal1' ".( ($mtag!='') ? " AND LOCATE(',".$mtag.",',CONCAT(',',REPLACE(name,', ',','),','))>0 " : "" )." ORDER BY ordernum DESC");
		$i = 0;
		while ($row = $res->fetch_array())
		{
			$i++;
			tplParseBlock('item', array(
				'IMG' => $row['img'],
				'SIMG' => $row['simg'],
				'NAME' => $row['har'],
				'I' => ($i%16==0) ? 16 : $i%16
			));
			if ($i==16)
			{
				tplParseBlock('items');
				$i = 0;
			}
		}
		if ($i!=16) tplParseBlock('items');

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