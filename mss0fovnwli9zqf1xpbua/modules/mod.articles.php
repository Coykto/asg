<?
class cModArticles
{
	function Init()
	{
		tplLoadTemplateFile('articles.tpl');
	}
	
	function show()
	{
		$article_list = new cArticleList();
		$list = $article_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $article_id => $article)
		{
			$i++;
			if ($article->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $article_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $article_id
			));				
			tplParseBlock('listing_item', array(
				'ID' => $article_id,
				'DATE' => date("d.m.Y",$article->info['date']),
				'NAME' => $article->info['name']
			));
		}
	
		tplParseBlock('listing');
	}

    function showForm()
    {
		GLOBAL $mysqli;

        $tree = new cOrderedTree();
		$tree->load();
		
		$article_id=getInt('id');		
        if ($article_id)
        {
			$article = new cArticle($article_id);
			$article->loadAll();
	    	tplParseBlock('article_edit');
			
			$i=0;
			$res1 = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$article_id."' AND tt='article' ORDER BY ordernum DESC");
			$count = $res1->num_rows;
			while ($row1 = $res1->fetch_array())
			{
				$i++;
				if ($i>1) tplParseBlock('gf_up', array(
					'IID' => $row1["id"],
					'ID' => $article_id,
				));
				if ($i<$count) tplParseBlock('gf_down', array(
					'IID' => $row1["id"],
					'ID' => $article_id,
				));
				if ($row1['visible']=='1') tplParseBlock('gf_visible', array(
					'IID' => $row1["id"],
					'ID' => $article_id,
				));
				else tplParseBlock('gf_nvisible', array(
					'IID' => $row1["id"],
					'ID' => $article_id,
				));
				tplParseBlock('showfoto',array(
					'IID' => $row1["id"],
					'ID' => $article_id,
					'SIMG' => $row1["simg"],
					'IMG' => $row1["img"],
					'NAME' => _htmlspecialchars($row1["name"]),
					'IMG' => $row1["img"]
				));
			}

			if ($article->info['tid']!='') $rm_ids = explode(',',$article->info['tid']);
			else $rm_ids = array();
			foreach ($tree->nodes as $node_id => $node1)
			if ($node1->info['name']!=TREE_ROOT_NODE_NAME)
			{
				tplParseBlock('rm1', array(
					'ID' => $node_id,
					'NAME' => $node1->info['name'],
					'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6)
				));
			}
			
			foreach ($rm_ids AS $val)
			{
				$it = $tree->getNode($val);
				if (isset($it->info['id'])) tplParseBlock('rm', array(
					'ID' => $it->info['id'],
					'NAME' => $it->info['name']
				));
			}

	    	tplParseBlock('article', array(
	    		'ID' => $article_id,
				'DATE' => date("d.m.Y",$article->info['date']),
				'VISIBLE' => ($article->info['visible'] == "1") ? "checked" : "",
	    		'NAME' => _htmlspecialchars($article->info['name']),
				'NAME1' => _htmlspecialchars($article->info['name1']),
	    		'TEXT' => _htmlspecialchars($article->info['text']),
				'TEXTSMALL' => _htmlspecialchars($article->info['textsmall']),
	    		'TITLE' => _htmlspecialchars($article->info['title']),
	    		'DESCRIPTION' => _htmlspecialchars($article->info['description']),
	    		'KEYWORDS' => _htmlspecialchars($article->info['keywords']),
	    		'CPU' => $article->info['cpu'],
				'IMG' => ($article->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/articles/'.$article->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=delimg&el=img&id='.$article_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG1' => ($article->info['img1']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/articles/'.$article->info['img1'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=delimg&el=img1&id='.$article_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG2' => ($article->info['img2']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/articles/'.$article->info['img2'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=delimg&el=img2&id='.$article_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG2_MOBILE' => ($article->info['img2_mobile']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/articles/'.$article->info['img2_mobile'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=delimg&el=img2_mobile&id='.$article_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG3' => ($article->info['img3']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/articles/'.$article->info['img3'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=delimg&el=img3&id='.$article_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'CID'=>printSelect('cid[]', "SELECT id, name FROM article_cats ORDER BY name", explode(',',$article->info['cid']),'',' class="form-control" multiple size="20" '),
				'BLOGSCHEME1'=>($article->info['blogscheme']=='1') ? ' selected' : '',
				'BLOGSCHEME2'=>($article->info['blogscheme']=='2') ? ' selected' : '',
				'BLOGSCHEME3'=>($article->info['blogscheme']=='3') ? ' selected' : '',
				'HOST' => HOST
    		));
        }
        else
        {
	    	tplParseBlock('article_new');
			
			foreach ($tree->nodes as $node_id => $node1)
			if ($node1->info['name']!=TREE_ROOT_NODE_NAME)
			{
				tplParseBlock('rm1', array(
					'ID' => $node_id,
					'NAME' => $node1->info['name'],
					'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6)
				));
			}

	    	tplParseBlock('article',array(
				'VISIBLE'=> "checked",
				'DATE' => date("d.m.Y"),
				'CID'=>printSelect('cid[]', "SELECT id, name FROM article_cats ORDER BY name", array(),'',' class="form-control" multiple size="20" '),
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/articles/");
		$img1 = uploadi($_FILES["img1"]["tmp_name"],$_FILES["img1"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/articles/");
		$img2 = uploadi($_FILES["img2"]["tmp_name"],$_FILES["img2"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/articles/");
		$img3 = uploadi($_FILES["img3"]["tmp_name"],$_FILES["img3"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/articles/");
		$img2_mobile = uploadi($_FILES["img2_mobile"]["tmp_name"],$_FILES["img2_mobile"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/articles/");
		
		$date = getVar("date");
    	$article_id=getInt('id');
        $article= new cArticle($article_id);
		$article->info["date"]=mktime(date("H"),date("i"),date("s"),substr($date,3,2),substr($date,0,2),substr($date,6,4));
		$article->info["visible"]=getBool("visible");
		$article->info["name"]=getVar("name");
		$article->info["name1"]=getVar("name1");
		$article->info["text"]=getVar("text");
		$article->info["textsmall"]=getVar("textsmall");
		$article->info["title"]=getVar("title");
		$article->info["description"]=getVar("description");
		$article->info["keywords"]=getVar("keywords");
		$article->info["blogscheme"]=getInt("blogscheme");
		$cid = ( (isset($_POST['cid'])) && (is_array($_POST['cid'])) ) ? $_POST['cid'] : array();
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
					$res = $mysqli->query("SELECT id FROM article_cats WHERE name='".$val."' ");
					$row = $res->fetch_array();
					if ($row['id']>0) $cidaddid[] = $row['id'];
					else
					{
						$res = $mysqli->query("INSERT INTO article_cats (name) VALUES ('".$val."') ");
						$cidaddid[] = $mysqli->insert_id;
					}
				}
			}
			$cid = array_merge($cid,$cidaddid);
		}
		$cid = array_unique($cid);
		$article->info["cid"] = implode(',',$cid);
		$article->info["tid"] = getVar("rm_ids");
		if ($img) $article->info["img"] = $img;
		if ($img1) $article->info["img1"] = $img1;
		if ($img2) $article->info["img2"] = $img2;
		if ($img2_mobile) $article->info["img2_mobile"] = $img2_mobile;
		if ($img3) $article->info["img3"] = $img3;
		$article->info["cpu"]=getVar("cpu");
		if (!$article_id) $article->buildIncOrdernum();
		if ( ($article->info["cpu"] == '') || (!preg_match("/^[-_a-zA-Z0-9]+$/", $article->info["cpu"])) ) $article->info["cpu"] = makecpu($article->info["name"]);
		$article->save();

		$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE cpu='".$article->info["cpu"]."' AND id<>".$article->id." ");
		$row = $res->num_rows;
		if ($row>0) $res = $mysqli->query("UPDATE ".TABLE_ARTICLES." SET cpu='".$article->id."' WHERE id=".$article->id);

		$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$article->id."' AND tt IN ('article') ORDER BY ordernum");
		while ($row = $res->fetch_array())
		if ( (isset($_POST['galname'.$row['id']])) && ( (getVar('galname'.$row['id'])!=$row['name']) ) ) 
		$res1 = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET name='".getVar('galname'.$row['id'])."'
		WHERE id='".$row['id']."' ");

		$targetPath = $_SERVER['DOCUMENT_ROOT'].'/templates/images/articles/';
		$i = 0;
		while (isset($_FILES["files1"]["tmp_name"][$i]))
		{
			$img = uploadi($_FILES["files1"]["tmp_name"][$i],$_FILES["files1"]["name"][$i],$targetPath);
			if ($img)
			{
				list($width, $height) = getimagesize($targetPath.$img);
				if ( ($width/$height) < (747/734) ) resizew($img,$targetPath,747,"s_");
				else resizeh($img,$targetPath,734,"s_");
//				crop($targetPath."s_".$img,$targetPath."s_".$img,array(0,0,747,734));
				
				$res = $mysqli->query("INSERT INTO ".TABLE_GFOTOS." (gid,simg,img,visible,tt) VALUES ('".$article->id."','s_".$img."','".$img."','1','article') ");
				$idd = $mysqli->insert_id;
				$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET ordernum='".$idd."' WHERE id='".$idd."' ");
			}
			$i++;
		}

		if ($article_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=articles&action=edit&id=".$article->id."#pills-".getVar("pills")."-tab");
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=articles");
    }
	
    function vis()
    {
    	$article_id=getInt('id');
        $article= new cArticle($article_id);
		$article->info["visible"] = "1";
		$article->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$article_id=getInt('id');
        $article= new cArticle($article_id);
		$article->info["visible"] = "0";
		$article->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$article_id=getInt('id');
    	$article=new cArticle($article_id);
    	$article->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$article_id=getInt('id');
        $article= new cArticle($article_id);
		$article->info[$_GET["el"]] = '';
		$article->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function Run()
    {
		GLOBAL $mysqli;
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
					up($_GET["id"],TABLE_ARTICLES,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_ARTICLES,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
				
				case "moveupf":
					down($_GET["iid"],TABLE_GFOTOS,"gid",$_GET["id"],"tt","article");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=articles&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
				case "movedownf":
					up($_GET["iid"],TABLE_GFOTOS,"gid",$_GET["id"],"tt","article");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=articles&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
				case "visiblef":
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET visible='1' WHERE id='".$_GET["iid"]."' ");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=articles&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
				case "nvisiblef":
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET visible='0' WHERE id='".$_GET["iid"]."' ");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=articles&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
				case "delf":
					$res = $mysqli->query("DELETE FROM ".TABLE_GFOTOS." WHERE id='".$_GET["iid"]."' ");
					if (file_exists($_SERVER["DOCUMENT_ROOT"].'/templates/images/articles/'.$_GET["img"])) unlink($_SERVER["DOCUMENT_ROOT"].'/templates/images/articles/'.$_GET["img"]);
					if (file_exists($_SERVER["DOCUMENT_ROOT"].'/templates/images/articles/'.$_GET["simg"])) unlink($_SERVER["DOCUMENT_ROOT"].'/templates/images/articles/'.$_GET["simg"]);
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=articles&action=edit&id=".$_GET["id"]."#pills-3-tab");
				break;
        	}
		}
		else $this->show();
    }
}
?>