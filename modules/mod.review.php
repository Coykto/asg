<?
class cModReview
{
    function Init()
    {
        tplLoadTemplateFile('review.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $mysqli;

				$res = $mysqli->query("SELECT * FROM ".TABLE_REVIEWS." WHERE visible='1' ORDER BY id");
				while ($row = $res->fetch_array())
				{
					if ($row['img']!='') tplParseBlock('review_item_img', array(
						'IMG' => $row['img']
					));
					else if ($row['social']!='') tplParseBlock('review_item_video', array(
						'VIDEO' => $row['social']
					));
					tplParseBlock('review_item', array(
						'NAME' => $row['name'],
						'TEXT' => $row['text'],
					));
				}

		tplParseBlock('block_center', array(
				'NAME' => $mainname->info['name'],
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