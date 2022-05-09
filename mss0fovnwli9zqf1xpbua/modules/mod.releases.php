<?
class cModReleases
{
	function Init()
	{
		tplLoadTemplateFile('releases.tpl');
	}
	
	function show()
	{
		$cid = getInt('cid');
		$release_list = new cReleaseList();
		$release_list->setFilter(array(
			FILTER_ITEM => $cid
		));
		$list = $release_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $release_id => $release)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $release_id,
				'CID' => $cid
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $release_id,
				'CID' => $cid
			));
			if ($release->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $release_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $release_id
			));				
			tplParseBlock('listing_item', array(
				'ID' => $release_id,
				'NAME' => $release->info['name']
			));
		}
		
        $tree=new cOrderedTree();
		$tree->load();
		foreach ($tree->nodes as $node_id => $node)
		if ($node->info['name']!=TREE_ROOT_NODE_NAME)
		tplParseBlock('cid', array(
			'ID' => $node_id,
			'NAME' => ( ($node->info['parent_id']>0) ? '&nbsp;&nbsp;&nbsp;&nbsp;' : '' ).$node->info['name'],
			'SEL' => ($node_id == $cid) ? ' selected' : ''
		));
		
		tplParseBlock('listing', array(
			'ID' => $cid
		));
	}

    function showForm()
    {
		GLOBAL $mysqli;

        $tree=new cOrderedTree();
		$tree->load();

		$release_id=getInt('id');		
        if ($release_id)
        {
			$release = new cRelease($release_id);
			$release->loadAll();
	    	tplParseBlock('release_edit', array('CID' => $release->info['cid']));

			foreach ($tree->nodes as $node_id => $node)
			if ($node->info['name']!=TREE_ROOT_NODE_NAME)
			tplParseBlock('cid_edit', array(
				'ID' => $node_id,
				'NAME' => ( ($node->info['parent_id']>0) ? '&nbsp;&nbsp;&nbsp;&nbsp;' : '' ).$node->info['name'],
				'SEL' => ($node_id == $release->info['cid']) ? ' selected' : ''
			));

	    	tplParseBlock('release', array(
	    		'ID' => $release_id,
				'VISIBLE' => ($release->info['visible'] == "1") ? "checked" : "",
	    		'NAME' => _htmlspecialchars($release->info['name']),
	    		'TEXT' => _htmlspecialchars($release->info['text']),
				'TEXT1' => _htmlspecialchars($release->info['text1']),
				'TEXT2' => _htmlspecialchars($release->info['text2']),
				'PRICE' => _htmlspecialchars($release->info['price']),
				'IMG' => ($release->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/releases/'.$release->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=releases&action=delimg&el=img&id='.$release_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
			$cid = getInt('cid');
	    	tplParseBlock('release_new', array('CID' => $cid));
			
			foreach ($tree->nodes as $node_id => $node)
			if ($node->info['name']!=TREE_ROOT_NODE_NAME)
			tplParseBlock('cid_edit', array(
				'ID' => $node_id,
				'NAME' => ( ($node->info['parent_id']>0) ? '&nbsp;&nbsp;&nbsp;&nbsp;' : '' ).$node->info['name'],
				'SEL' => ($node_id == $cid) ? ' selected' : ''
			));

	    	tplParseBlock('release',array(
				'VISIBLE'=> "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;

		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/releases/");
    	$release_id=getInt('id');
        $release= new cRelease($release_id);
		$release->info["visible"]=getBool("visible");
		$release->info["name"]=getVar("name");
		$release->info["text"]=getVar("text");
		$release->info["text1"]=getVar("text1");
		$release->info["text2"]=getVar("text2");
		$release->info["price"]=getVar("price");
		$release->info["cid"] = getInt("cid");
		if ($img) $release->info["img"] = $img;
		if (!$release_id) $release->buildIncOrdernum();
		$release->save();

		if ($release_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=releases&action=edit&id=".$release->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=releases&cid=".getInt("cid"));
    }
	
    function vis()
    {
    	$release_id=getInt('id');
        $release= new cRelease($release_id);
		$release->info["visible"] = "1";
		$release->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$release_id=getInt('id');
        $release= new cRelease($release_id);
		$release->info["visible"] = "0";
		$release->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$release_id=getInt('id');
    	$release=new cRelease($release_id);
    	$release->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$release_id=getInt('id');
        $release= new cRelease($release_id);
		$release->info[$_GET["el"]] = '';
		$release->save();
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
				case "down":
					down($_GET["id"],TABLE_RELEASES,"cid",$_GET["cid"]);
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "up":
					up($_GET["id"],TABLE_RELEASES,"cid",$_GET["cid"]);
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>