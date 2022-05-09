<?
class cModDailys
{
	function Init()
	{
		tplLoadTemplateFile('dailys.tpl');
	}
	
	function show()
	{
		$daily_list = new cDailyList();
		$list = $daily_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $daily_id => $daily)
		{
			$i++;
			if ($daily->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $daily_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $daily_id
			));				
			tplParseBlock('listing_item', array(
				'ID' => $daily_id,
				'DATE' => date("d.m.Y",$daily->info['date']),
				'NAME' => $daily->info['name']
			));
		}
	
		tplParseBlock('listing');
	}

    function showForm()
    {
		GLOBAL $mysqli;
		
		$daily_id=getInt('id');
		
        if ($daily_id)
        {
			$daily = new cDaily($daily_id);
			$daily->loadAll();
	    	tplParseBlock('daily_edit');
			
			$i=0;
			$res1 = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$daily_id."' AND tt='daily' ORDER BY ordernum DESC");
			$count = $res1->num_rows;
			while ($row1 = $res1->fetch_array())
			{
				$i++;
				if ($i>1) tplParseBlock('gf_up', array(
					'IID' => $row1["id"],
					'ID' => $daily_id,
				));
				if ($i<$count) tplParseBlock('gf_down', array(
					'IID' => $row1["id"],
					'ID' => $daily_id,
				));
				if ($row1['visible']=='1') tplParseBlock('gf_visible', array(
					'IID' => $row1["id"],
					'ID' => $daily_id,
				));
				else tplParseBlock('gf_nvisible', array(
					'IID' => $row1["id"],
					'ID' => $daily_id,
				));
				tplParseBlock('showfoto',array(
					'IID' => $row1["id"],
					'ID' => $daily_id,
					'SIMG' => $row1["simg"],
					'IMG' => $row1["img"],
					'NAME' => _htmlspecialchars($row1["name"]),
					'IMG' => $row1["img"]
				));
			}

	    	tplParseBlock('daily', array(
	    		'ID' => $daily_id,
				'DATE' => date("d.m.Y",$daily->info['date']),
				'VISIBLE' => ($daily->info['visible'] == "1") ? "checked" : "",
				'MAIN' => ($daily->info['main'] == "1") ? "checked" : "",
	    		'NAME' => _htmlspecialchars($daily->info['name']),
				'NAME1' => _htmlspecialchars($daily->info['name1']),
	    		'TEXT' => _htmlspecialchars($daily->info['text']),
				'TEXT1' => _htmlspecialchars($daily->info['text1']),
				'TEXT2' => _htmlspecialchars($daily->info['text2']),
	    		'TITLE' => _htmlspecialchars($daily->info['title']),
	    		'DESCRIPTION' => _htmlspecialchars($daily->info['description']),
	    		'KEYWORDS' => _htmlspecialchars($daily->info['keywords']),
	    		'CPU' => $daily->info['cpu'],
				'IMG' => ($daily->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/dailys/'.$daily->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=delimg&el=img&id='.$daily_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'BANNER' => ($daily->info['banner']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/dailys/'.$daily->info['banner'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=delimg&el=banner&id='.$daily_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'CID'=>printSelect('cid[]', "SELECT id, name FROM daily_cats ORDER BY name", explode(',',$daily->info['cid']),'',' class="form-control" multiple size="20" '),
				'TID'=>printSelect('tid[]', "SELECT id, name FROM ".TABLE_TREE." WHERE ptid=9 ORDER BY parent_id, ordernum", explode(',',$daily->info['tid']),'',' class="form-control" multiple size="20" '),
				'HOST' => HOST
    		));
        }
        else
        {
	    	tplParseBlock('daily_new');
	    	tplParseBlock('daily',array(
				'VISIBLE'=> "checked",
				'DATE' => date("d.m.Y"),
				'CID'=>printSelect('cid[]', "SELECT id, name FROM daily_cats ORDER BY name", array(),'',' class="form-control" multiple size="20" '),
				'TID'=>printSelect('tid[]', "SELECT id, name FROM ".TABLE_TREE." WHERE ptid=9 ORDER BY parent_id, ordernum", array(),'',' class="form-control" multiple size="20" '),
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/dailys/");
		$banner = uploadi($_FILES["banner"]["tmp_name"],$_FILES["banner"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/dailys/");
		$date = getVar("date");
    	$daily_id=getInt('id');
        $daily= new cDaily($daily_id);
		$daily->info["date"]=mktime(date("H"),date("i"),date("s"),substr($date,3,2),substr($date,0,2),substr($date,6,4));
		$daily->info["visible"]=getBool("visible");
		$daily->info["main"]=getBool("main");
		$daily->info["name"]=getVar("name");
		$daily->info["name1"]=getVar("name1");
		$daily->info["text"]=getVar("text");
		$daily->info["text1"]=getVar("text1");
		$daily->info["text2"]=getVar("text2");
		$daily->info["title"]=getVar("title");
		$daily->info["description"]=getVar("description");
		$daily->info["keywords"]=getVar("keywords");
		$daily->info["tid"]=(is_array($_POST['tid'])) ? implode(',',$_POST['tid']) : '';
		$cid = (is_array($_POST['cid'])) ? $_POST['cid'] : array();
		$cidadd = getVar("cidadd");
		if ($cidadd!='')
		{
			$cidadd = explode("\n",$cidadd);
			$cidaddid = array();

			foreach ($cidadd AS $val)
			{
				$val = trim($val);
				if ($val!='')
				{
					$res = $mysqli->query("SELECT id FROM daily_cats WHERE name='".$val."' ");
					$row = $res->fetch_array();
					if ($row['id']>0) $cidaddid[] = $row['id'];
					else
					{
						$res = $mysqli->query("INSERT INTO daily_cats (name) VALUES ('".$val."') ");
						$cidaddid[] = $mysqli->insert_id;
					}
				}
			}
			$cid = array_merge($cid,$cidaddid);
		}
		$cid = array_unique($cid);
		$daily->info["cid"] = implode(',',$cid);
		if ($img) $daily->info["img"] = $img;
		if ($banner) $daily->info["banner"] = $banner;
		$daily->info["cpu"]=getVar("cpu");
		if (!$daily_id) $daily->buildIncOrdernum();
		if ( ($daily->info["cpu"] == '') || (!preg_match("/^[-_a-zA-Z0-9]+$/", $daily->info["cpu"])) ) $daily->info["cpu"] = makecpu($daily->info["name"]);
		$daily->save();

		$res = $mysqli->query("SELECT * FROM ".TABLE_DAILYS." WHERE cpu='".$daily->info["cpu"]."' AND id<>".$daily->id." ");
		$row = $res->num_rows;
		if ($row>0) $res = $mysqli->query("UPDATE ".TABLE_DAILYS." SET cpu='".$daily->id."' WHERE id=".$daily->id);

		$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$daily->id."' AND tt IN ('daily') ORDER BY ordernum");
		while ($row = $res->fetch_array())
		if ( (isset($_POST['galname'.$row['id']])) && ( (getVar('galname'.$row['id'])!=$row['name']) ) ) 
		$res1 = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET name='".getVar('galname'.$row['id'])."'
		WHERE id='".$row['id']."' ");

		$targetPath = $_SERVER['DOCUMENT_ROOT'].'/templates/images/dailys/';
		$i = 0;
		while (isset($_FILES["files1"]["tmp_name"][$i]))
		{
			$img = uploadi($_FILES["files1"]["tmp_name"][$i],$_FILES["files1"]["name"][$i],$targetPath);
			if ($img)
			{
				list($width, $height) = getimagesize($targetPath.$img);
				if ( ($width/$height) < (680/680) ) resizew($img,$targetPath,680,"s_");
				else resizeh($img,$targetPath,680,"s_");
				crop($targetPath."s_".$img,$targetPath."s_".$img,array(0,0,680,680));
				
				$res = $mysqli->query("INSERT INTO ".TABLE_GFOTOS." (gid,simg,img,visible,tt) VALUES ('".$daily->id."','s_".$img."','".$img."','1','daily') ");
				$idd = $mysqli->insert_id;
				$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET ordernum='".$idd."' WHERE id='".$idd."' ");
			}
			$i++;
		}

		if ($daily_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=edit&id=".$daily->id."#pills-".getVar("pills")."-tab");
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=dailys");
    }
	
    function vis()
    {
    	$daily_id=getInt('id');
        $daily= new cDaily($daily_id);
		$daily->info["visible"] = "1";
		$daily->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$daily_id=getInt('id');
        $daily= new cDaily($daily_id);
		$daily->info["visible"] = "0";
		$daily->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$daily_id=getInt('id');
    	$daily=new cDaily($daily_id);
    	$daily->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$daily_id=getInt('id');
        $daily= new cDaily($daily_id);
		$daily->info[$_GET["el"]] = '';
		$daily->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function Run()
    {
		GLOBAL $mysqlil;
		if (isset($_REQUEST['action']))
		{
        	switch ($_REQUEST['action'])
        	{
	            case "delimg":$this->delimg();break;
	            case "edit":$this->showForm();break;
        	    case "new":$this->showForm();break;
	            case "delete":$this->del();break;
				case "visible":$this->vis();break;
				case "nvisible":$this->nvis();break;
				case "up":
					up($_GET["id"],TABLE_DAILYS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_DAILYS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;

				case "moveupf":
					down($_GET["iid"],TABLE_GFOTOS,"gid",$_GET["id"],"tt","daily");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
				case "movedownf":
					up($_GET["iid"],TABLE_GFOTOS,"gid",$_GET["id"],"tt","daily");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
				case "visiblef":
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET visible='1' WHERE id='".$_GET["iid"]."' ");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
				case "nvisiblef":
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET visible='0' WHERE id='".$_GET["iid"]."' ");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
				case "delf":
					$res = $mysqli->query("DELETE FROM ".TABLE_GFOTOS." WHERE id='".$_GET["iid"]."' ");
					if (file_exists($_SERVER["DOCUMENT_ROOT"].'/templates/images/dailys/'.$_GET["img"])) unlink($_SERVER["DOCUMENT_ROOT"].'/templates/images/dailys/'.$_GET["img"]);
					if (file_exists($_SERVER["DOCUMENT_ROOT"].'/templates/images/dailys/'.$_GET["simg"])) unlink($_SERVER["DOCUMENT_ROOT"].'/templates/images/dailys/'.$_GET["simg"]);
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;				
        	}
		}
		else $this->show();
    }
}
?>