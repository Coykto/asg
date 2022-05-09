<?
class cModTree
{
	function Init()
	{
		tplLoadTemplateFile('tree.tpl');
        $this->tree=new cOrderedTree();
		$this->tree->load();
	}
	
	function show()
	{
		GLOBAL $mysqli;
		
		$parent_id = getInt("parent_id");
		
		if ($parent_id>0)
		{
			$parent = $this->tree->getNode($parent_id);
			if ($parent->info['parent_id']>0)
			{
				$sparent = $this->tree->getNode($parent->info['parent_id']);
				if ($sparent->info['parent_id']>0)
				{
					$ssparent = $this->tree->getNode($sparent->info['parent_id']);
					tplParseBlock('listing_bread', array(
						'PARENT_ID' => $ssparent->info['id'],
						'NAME' => $ssparent->info['name']
					));
				}
				tplParseBlock('listing_bread', array(
					'PARENT_ID' => $sparent->info['id'],
					'NAME' => $sparent->info['name']
				));
			}
			tplParseBlock('listing_bread', array(
				'PARENT_ID' => $parent->info['id'],
				'NAME' => $parent->info['name']
			));
		}

		if ( (isset($_POST['sea'])) && (getVar("sea")!='') )
		{
			$res = $mysqli->query("SELECT id FROM ".TABLE_TREE." WHERE name LIKE '%".getVar("sea")."%' ");
			while ($row = $res->fetch_array())
			{
				$it = $this->tree->getNode($row['id']);
				if ($it->info['visible']=='1') tplParseBlock('res_item_visible', array(
					'ID' => $it->info['id']
				));
				else tplParseBlock('res_item_nvisible', array(
					'ID' => $it->info['id']
				));
				tplParseBlock('res_item', array(
					'ID' => $it->info['id'],
					'NAME' => $this->tree->getPathName($it)
				));
			}
		}
		foreach ($this->tree->nodes as $node_id => $node)
		{
			if ( ($node->info['name']!=TREE_ROOT_NODE_NAME) && ($node->info['parent_id']==$parent_id) )
			{
				if (!$this->tree->isNodeFirst($node_id)) tplParseBlock('listing_item_up', array(
					'ID' => $node_id,
					'PARENT_ID' => $node->info['parent_id']
				));
				if (!$this->tree->isNodeLast($node_id)) tplParseBlock('listing_item_down', array(
					'ID' => $node_id,
					'PARENT_ID' => $node->info['parent_id']
				));
				if ($node->info['visible']=='1') tplParseBlock('listing_item_visible', array(
					'ID' => $node_id
				));
				else tplParseBlock('listing_item_nvisible', array(
					'ID' => $node_id
				));
				if (sizeof($node->children)>0)
				{
					tplParseBlock('listing_item_a1', array(
						'ID' => $node_id
					));
					tplParseBlock('listing_item_a2');
				}
				if ($node->getLevel()<2) tplParseBlock('listing_item_p', array(
					'PARENT_ID' => $node_id
				));

				tplParseBlock('listing_item', array(
					'ID' => $node_id,
					'NAME' => $node->info['name']
				));
			}
		}
		tplParseBlock('listing', array(
			'SEA' => getVar("sea"),
			'PARENT_ID' => $parent_id
		));
	}

    function showForm()
    {
		GLOBAL $mysqli;
		
		$tree_id=getInt('id');
		$parent_id=getInt('parent_id');
		
        if ($tree_id)
        {
			$node = $this->tree->getNode($tree_id);
			foreach ($this->tree->nodes as $node_id => $node1)
			if ($node1->info['name']!=TREE_ROOT_NODE_NAME)
			{

				if ( ($node1->getLevel()<2) && ($node_id!=$tree_id) ) tplParseBlock('parent', array(
					'ID' => $node_id,
					'NAME' => $node1->info['name'],
					'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6),
					'SELECTED' => ($node_id==$node->info['parent_id']) ? ' selected="selected" ' : '',
				));
				tplParseBlock('price_rm1', array(
					'ID' => $node_id,
					'NAME' => $node1->info['name'],
					'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6)
				));
				tplParseBlock('ch_rm1', array(
					'ID' => $node_id,
					'NAME' => $node1->info['name'],
					'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6)
				));
			}

			if ($node->info['parent_id']>0)
			{
				$parent = $this->tree->getNode($node->info['parent_id']);
				if ($parent->info['parent_id']>0)
				{
					$sparent = $this->tree->getNode($parent->info['parent_id']);
					if ($sparent->info['parent_id']>0)
					{
						$ssparent = $this->tree->getNode($sparent->info['parent_id']);
						tplParseBlock('tree_edit_bread', array(
							'PARENT_ID' => $ssparent->info['id'],
							'NAME' => $ssparent->info['name']
						));
					}
					tplParseBlock('tree_edit_bread', array(
						'PARENT_ID' => $sparent->info['id'],
						'NAME' => $sparent->info['name']
					));
				}				
				tplParseBlock('tree_edit_bread', array(
					'PARENT_ID' => $parent->info['id'],
					'NAME' => $parent->info['name']
				));
			}

			tplParseBlock('tree_edit');

			$gn = strtolower(strip_tags($node->info['name']));
			$gal = array();
			$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE tt='gal1' AND LOCATE(',".$gn.",',CONCAT(',',REPLACE(name,', ',','),','))>0 ORDER BY ordernum DESC");
			while ($row = $res->fetch_array())
			$gal[$row['id']] = $row;
		
			$res = $mysqli->query("SELECT * FROM gallid WHERE cid='".$tree_id."' ORDER BY ordernum");
			while ($row = $res->fetch_array())
			if (isset($gal[$row['pid']]))
			{
				tplParseBlock('showfoto',array(
					'IID' => $gal[$row['pid']]["id"],
					'SIMG' => $gal[$row['pid']]["simg"],
					'IMG' => $gal[$row['pid']]["img"],
					'ORDERNUM' => $row["ordernum"]
				));
				unset($gal[$row['pid']]);
			}

			foreach ($gal AS $key => $val)
			{
				tplParseBlock('showfoto',array(
					'IID' => $val["id"],
					'SIMG' => $val["simg"],
					'IMG' => $val["img"],
					'ORDERNUM' => 0
				));			
			}

			if ($node->info['bid']!='') $rm_ids = explode(',',$node->info['bid']);
			else $rm_ids = array();
			if ($node->info['oid']!='') $price_ids = explode(',',$node->info['oid']);
			else $price_ids = array();
			if ($node->info['ch_ids']!='') $ch_ids = explode(',',$node->info['ch_ids']);
			else $ch_ids = array();

			$article_list = new cArticleList();
			$list = $article_list->getList();
			foreach ($list as $article_id => $article)
			{
				tplParseBlock('rm1', array(
					'ID' => $article_id,
					'NAME' => $article->info['name']
				));
			}
			foreach ($rm_ids AS $val)
			{
				$article = new cArticle($val);
				$article->loadAll();
				if (isset($article->info['id'])) tplParseBlock('rm', array(
					'ID' => $article->info['id'],
					'NAME' => $article->info['name']
				));
			}

			foreach ($price_ids AS $val)
			{
				$it = $this->tree->getNode($val);
				if (isset($it->info['id'])) tplParseBlock('price_rm', array(
					'ID' => $it->info['id'],
					'NAME' => $it->info['name']
				));
			}

			foreach ($ch_ids AS $val)
			{
				$it = $this->tree->getNode($val);
				if (isset($it->info['id'])) tplParseBlock('ch_rm', array(
					'ID' => $it->info['id'],
					'NAME' => $it->info['name']
				));
			}

	    	tplParseBlock('tree', array(
	    		'ID'=>$tree_id,
	    		'NAME'=>_htmlspecialchars($node->info['name']),
				'BLOGNAME'=>_htmlspecialchars($node->info['blogname']),
				'H1'=>_htmlspecialchars($node->info['h1']),
				'TITLE'=>_htmlspecialchars($node->info['title']),
				'DESCRIPTION'=>_htmlspecialchars($node->info['description']),
				'KEYWORDS'=>_htmlspecialchars($node->info['keywords']),
				'TEXT'=>_htmlspecialchars($node->info['text']),
				'TEXT1'=>_htmlspecialchars($node->info['text1']),
				'TEXT2'=>_htmlspecialchars($node->info['text2']),
				'TEXT3'=>_htmlspecialchars($node->info['text3']),
				'BANNER_TEXT'=>_htmlspecialchars($node->info['banner_text']),
				'CPU'=>_htmlspecialchars($node->info['cpu']),
				'LINK'=>_htmlspecialchars($node->info['link']),
				'TEXTSMALL'=>_htmlspecialchars($node->info['textsmall']),
				'TEXTSMALL1'=>_htmlspecialchars($node->info['textsmall1']),
				'FAQ'=>_htmlspecialchars($node->info['faq']),
				'VISIBLE'=> ($node->info['visible'] == "1") ? "checked" : "",
				'NEWITEM'=> ($node->info['newitem'] == "1") ? "checked" : "",
				'PTID'=>printSelect('ptid', "SELECT id, name FROM pagetype ORDER BY ordernum", $node->info['ptid'],'',' class="form-control"'),
				'IMG' => ($node->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=img&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG1' => ($node->info['img1']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['img1'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=img1&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG2' => ($node->info['img2']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['img2'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=img2&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG3' => ($node->info['img3']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['img3'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=img3&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG4' => ($node->info['img4']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['img4'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=img4&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'BANNER' => ($node->info['banner']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['banner'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=banner&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'BANNER_MOBILE' => ($node->info['banner_mobile']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['banner_mobile'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=banner_mobile&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'REDLINEIMG1' => ($node->info['redlineimg1']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['redlineimg1'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=redlineimg1&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'REDLINEIMG2' => ($node->info['redlineimg2']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['redlineimg2'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=redlineimg2&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'REDLINEIMG3' => ($node->info['redlineimg3']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['redlineimg3'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=redlineimg3&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'REDLINENAME1'=>_htmlspecialchars($node->info['redlinename1']),
				'REDLINENAME2'=>_htmlspecialchars($node->info['redlinename2']),
				'REDLINENAME3'=>_htmlspecialchars($node->info['redlinename3']),
				'REDLINETEXT1'=>_htmlspecialchars($node->info['redlinetext1']),
				'REDLINETEXT2'=>_htmlspecialchars($node->info['redlinetext2']),
				'REDLINETEXT3'=>_htmlspecialchars($node->info['redlinetext3']),
				'CONS_TEXT'=>_htmlspecialchars($node->info['cons_text']),
				'BLOGSCHEME1'=>($node->info['blogscheme']=='1') ? ' selected' : '',
				'BLOGSCHEME2'=>($node->info['blogscheme']=='2') ? ' selected' : '',
				'BLOGSCHEME3'=>($node->info['blogscheme']=='3') ? ' selected' : '',
				'CONS_IMG' => ($node->info['cons_img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/tree/'.$node->info['cons_img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delimg&el=cons_img&id='.$tree_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
			foreach ($this->tree->nodes as $node_id => $node1)
			if ($node1->info['name']!=TREE_ROOT_NODE_NAME)
			{
				if ($node1->getLevel()<2) tplParseBlock('parent', array(
					'ID' => $node_id,
					'NAME' => $node1->info['name'],
					'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6),
					'SELECTED' => ($parent_id==$node_id) ? ' selected="selected" ' : ''
				));
				
				tplParseBlock('price_rm1', array(
					'ID' => $node_id,
					'NAME' => $node1->info['name'],
					'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6)
				));
				tplParseBlock('ch_rm1', array(
					'ID' => $node_id,
					'NAME' => $node1->info['name'],
					'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6)
				));
			}

			if ($parent_id>0)
			{
				$parent = $this->tree->getNode($parent_id);
				if ($parent->info['parent_id']>0)
				{
					$sparent = $this->tree->getNode($parent->info['parent_id']);
					if ($sparent->info['parent_id']>0)
					{
						$ssparent = $this->tree->getNode($sparent->info['parent_id']);
						tplParseBlock('tree_new_bread', array(
							'PARENT_ID' => $ssparent->info['id'],
							'NAME' => $ssparent->info['name']
						));
					}
					tplParseBlock('tree_new_bread', array(
						'PARENT_ID' => $sparent->info['id'],
						'NAME' => $sparent->info['name']
					));
				}
				tplParseBlock('tree_new_bread', array(
					'PARENT_ID' => $parent->info['id'],
					'NAME' => $parent->info['name']
				));
			}

			$article_list = new cArticleList();
			$list = $article_list->getList();
			foreach ($list as $article_id => $article)
			{
				tplParseBlock('rm1', array(
					'ID' => $article_id,
					'NAME' => $article->info['name']
				));
			}

			tplParseBlock('tree_new');
	    	tplParseBlock('tree',array(
				'VISIBLE'=> "checked",
				'PTID'=>printSelect('ptid', "SELECT id, name FROM pagetype ORDER BY ordernum", 0,'',' class="form-control"'),
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;

		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$img1 = uploadi($_FILES["img1"]["tmp_name"],$_FILES["img1"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$img2 = uploadi($_FILES["img2"]["tmp_name"],$_FILES["img2"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$img3 = uploadi($_FILES["img3"]["tmp_name"],$_FILES["img3"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$img4 = uploadi($_FILES["img4"]["tmp_name"],$_FILES["img4"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$banner = uploadi($_FILES["banner"]["tmp_name"],$_FILES["banner"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$banner_mobile = uploadi($_FILES["banner_mobile"]["tmp_name"],$_FILES["banner_mobile"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$redlineimg1 = uploadi($_FILES["redlineimg1"]["tmp_name"],$_FILES["redlineimg1"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$redlineimg2 = uploadi($_FILES["redlineimg2"]["tmp_name"],$_FILES["redlineimg2"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$redlineimg3 = uploadi($_FILES["redlineimg3"]["tmp_name"],$_FILES["redlineimg3"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		$cons_img = uploadi($_FILES["cons_img"]["tmp_name"],$_FILES["cons_img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
		
		$name = getVar("name");
		if ($name=='') die();
    	$tree_id=getInt('id');
		if ($tree_id<1) $node=new cNode();
		else $node = $this->tree->getNode($tree_id);
		$node->info["name"]=$name;
		$node->info["bid"] = getVar("rm_ids");
		$node->info["oid"] = getVar("price_ids");
		$node->info["ch_ids"] = getVar("ch_ids");
		$node->info["h1"]=getVar("h1");
		$node->info["text"]=getVar("text");
		$node->info["text1"]=getVar("text1");
		$node->info["text2"]=getVar("text2");
		$node->info["text3"]=getVar("text3");
		$node->info["blogname"]=getVar("blogname");
		$node->info["redlinename1"]=getVar("redlinename1");
		$node->info["redlinename2"]=getVar("redlinename2");
		$node->info["redlinename3"]=getVar("redlinename3");
		$node->info["redlinetext1"]=getVar("redlinetext1");
		$node->info["redlinetext2"]=getVar("redlinetext2");
		$node->info["redlinetext3"]=getVar("redlinetext3");
		$node->info["textsmall"]=getVar("textsmall");
		$node->info["textsmall1"]=getVar("textsmall1");
		$node->info["cons_text"]=getVar("cons_text");
		$node->info["faq"]=getVar("faq");
		$node->info["banner_text"]=getVar("banner_text");
		$node->info["link"]=getVar("link");
		$node->info["title"]=getVar("title");
		$node->info["description"]=getVar("description");
		$node->info["keywords"]=getVar("keywords");
		$node->info["cpu"]=getVar("cpu");
		$node->info["visible"]=getBool("visible");
		$node->info["newitem"]=getBool("newitem");
		$node->info["ptid"]=getInt("ptid");
		$node->info["parent_id"]=getInt("parent_id");
		$node->info["blogscheme"]=getInt("blogscheme");
		if ($redlineimg1) $node->info["redlineimg1"] = $redlineimg1;
		if ($redlineimg2) $node->info["redlineimg2"] = $redlineimg2;
		if ($redlineimg3) $node->info["redlineimg3"] = $redlineimg3;
		if ($cons_img) $node->info["cons_img"] = $cons_img;
		if ($img) $node->info["img"] = $img;
		if ($img1) $node->info["img1"] = $img1;
		if ($img2) $node->info["img2"] = $img2;
		if ($img3) $node->info["img3"] = $img3;
		if ($img4) $node->info["img4"] = $img4;
		if ($banner) $node->info["banner"] = $banner;
		if ($banner_mobile) $node->info["banner_mobile"] = $banner_mobile;
		if (!$tree_id) $node->buildIncOrdernum();
		if ( ($node->info["cpu"] == '') || (!preg_match("/^[-_a-zA-Z0-9]+$/", $node->info["cpu"])) ) $node->info["cpu"] = makecpu($node->info["name"]);
		$node->save();
		
		$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE cpu='".$node->info["cpu"]."' AND id<>".$node->id." AND parent_id='".$node->info["parent_id"]."' ");
		$row = $res->num_rows;
		if ($row>0) $res = $mysqli->query("UPDATE ".TABLE_TREE." SET cpu='".$node->id."' WHERE id=".$node->id);

		if ($tree_id>0)
		{
			$gn = strtolower(strip_tags($node->info['name']));
			$res = $mysqli->query("DELETE FROM gallid WHERE cid='".$tree_id."' ");
			$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE tt='gal1' AND LOCATE(',".$gn.",',CONCAT(',',REPLACE(name,', ',','),','))>0 ORDER BY ordernum DESC");
			while ($row = $res->fetch_array())
			$res1 = $mysqli->query("INSERT INTO gallid (pid,cid,ordernum) VALUES (".$row['id'].",".$tree_id.",".getInt('galord'.$row['id']).") ");
		}

		if ($tree_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=tree&action=edit&id=".$node->id."#pills-".getVar("pills")."-tab");
		else header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=tree&parent_id=".getInt('parent_id'));
    }
	
    function vis()
    {
		GLOBAL $mysqli;
    	$tree_id=getInt('id');
		$res = $mysqli->query("UPDATE ".TABLE_TREE." SET visible='1' WHERE id=".$tree_id);
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
		GLOBAL $mysqli;
    	$tree_id=getInt('id');
		$res = $mysqli->query("UPDATE ".TABLE_TREE." SET visible='0' WHERE id=".$tree_id);
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$tree_id=getInt('id');
		$node = $this->tree->getNode($tree_id);
    	$node->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }
	
    function delimg()
    {		
    	$tree_id=getInt('id');
		$node = $this->tree->getNode($tree_id);
		$node->info[$_GET["el"]] = '';
		$node->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function Run()
    {
		GLOBAL $mysqli;
		if (isset($_REQUEST['action']))
		{
        	switch ($_REQUEST['action'])
        	{
	            case "edit":$this->showForm();break;
        	    case "new":$this->showForm();break;
	            case "delete":$this->del();break;
				case "delimg":$this->delimg();break;
				case "visible":$this->vis();break;
				case "nvisible":$this->nvis();break;
				case "up":
					up($_GET["id"],TABLE_TREE,"parent_id",$_GET["parent_id"]);
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_TREE,"parent_id",$_GET["parent_id"]);
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>