<?
class cModArticle
{
    function Init()
    {
        tplLoadTemplateFile('article.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $data, $cpuarr, $mysqli;

		if (!isset($data))
		{
			$cat = (int)$cpuarr[2];
			
			$cats = array();
			$res = $mysqli->query("SELECT * FROM article_cats");
			while ($row = $res->fetch_array())
			$cats[$row['id']] = $row['name'];

			$list = new cArticleList();
			if ($cat>0) 
			{
				$list->setFilter(array(
					FILTER_VISIBLE => 1,
					FILTER_SEARCH => $cat
				));
				tplParseBlock('listing_bread', array(
					'NAME' => $mainname->info['name'],
					'CPU' => $cpuarr[0],
					'HOST' => HOST
				));
			}
			else $list->setFilter(array(FILTER_VISIBLE => 1));
			$list = $list->getList();
			$i = 0;
			$twofour = array(3,9,11,0);
			foreach ($list as $item)
			{
				$i++;
				if ($item->info['cid']!='') $cid = explode(',',$item->info['cid']); else $cid = array();
				$tags = array();
				foreach ($cid AS $val)
				if (isset($cats[$val])) $tags[] = '<a href="'.HOST.$cpuarr[0].'/tag/'.$val.'/">#'.$cats[$val].'</a>';
				
				tplParseBlock('listing_item', array(
					'TEXTSMALL' => $item->info['textsmall'],
					'NAME' => $item->info['name'],
					'IMG' => ( (in_array($i%12, $twofour)) && ($item->info['img1']!='') )  ? $item->info['img1'] : $item->info['img'],
					'CPU1' => $cpuarr[0],
					'CPU2' => $item->info['cpu'],
					'DATE' => date('d.m.Y',$item->info['date']),
					'TWOFOUR' => (in_array($i%12, $twofour)) ? 2 : 4,
					'TAGS' => (sizeof($tags)>0) ? implode(' ',$tags) : '',
					'HOST' => HOST
				));
			}

			tplParseBlock('listing', array(
				'NAME' => ($cat>0) ? $cats[$cat] : $mainname->info['name'],
				'H1' => ($mainname->info['h1']!='') ? $mainname->info['h1'] : $mainname->info['name'],
				'HOST' => HOST
			));
			
			$GLOBALS['PAGE_TITLE'] = $mainname->info['title'];
			$GLOBALS['PAGE_DESCRIPTION'] = $mainname->info['description'];
			$GLOBALS['PAGE_KEYWORDS'] = $mainname->info['keywords'];
		}
		else
		{
			tplParseBlock('open_img', array(
				'NAME1' => $data['name1'],
				'IMG2' => $data['img2'],
				'IMG2_MOBILE' => ($data['img2_mobile']!='') ? $data['img2_mobile'] : $data['img2']
			));

			$class = array('small-small-4','small-small-1','small-small-2','big','medium','small-small-3');
			if ( ($data['blogscheme']==0) || ($data['blogscheme']==1) ) $icount = 6;
			else if ($data['blogscheme']==2) $icount = 7;
			else if ($data['blogscheme']==3) $icount = 5;
			$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$data['id']."' AND tt='article' ORDER BY ordernum DESC");
			$i = 0;
			while ($row = $res->fetch_array())
			{
				$i++;
				$x = $i%6;
				tplParseBlock('open_gal_item', array(
					'IMG' => $row['img'],
					'SIMG' => $row['simg'],
					'I' => ($data['blogscheme'] != 0) ? 'item-'.$i : $class[$x]
//					'CLASS' => $class[$x]
				));
				if ($i==$icount)
				{
					if ($data['blogscheme']!=0) tplParseBlock('open_gal_scheme', array(
						'I' => $data['blogscheme']+1
					));
					tplParseBlock('open_gal');
					$i = 0;
				}
			}
			if ($i%$icount!=0)
			{
				if ($data['blogscheme']!=0) tplParseBlock('open_gal_scheme', array(
					'I' => $data['blogscheme']+1
				));
				tplParseBlock('open_gal');
				$i = 0;
			}
			
			if ($data['tid']!='')
			{
				$tid = explode(',',$data['tid']);
				$i = 0;
				foreach ($tid AS $val)
				if ($i<3)
				{
					$i++;
					$node = $tree->getNode($val);
					tplParseBlock('open_sub_item', array(
						'IMG4' => $node->info['img4'],
						'NAME' => $node->info['name'],
						'TEXTSMALL' => $node->info['textsmall'],
						'CPU' => $tree->getCpu($node),
						'HOST' => HOST
					));
				}
			}

			tplParseBlock('open', array(
				'NAME' => $data['name'],
				'NAME1' => $mainname->info['name'],
				'CPU1' => $cpuarr[0],
				'H1' => $data['name'],
				'TEXT' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$data['text'])),
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