<?
class cModAdvantages
{
	function Init()
	{
		tplLoadTemplateFile('advantages.tpl');
	}
	
	function show()
	{
		$cid = getInt('cid');
		$advantage_list = new cAdvantageList();
		$advantage_list->setFilter(array(
			FILTER_ITEM => $cid
		));
		$list = $advantage_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $advantage_id => $advantage)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $advantage_id,
				'CID' => $cid
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $advantage_id,
				'CID' => $cid
			));
			if ($advantage->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $advantage_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $advantage_id
			));				
			tplParseBlock('listing_item', array(
				'ID' => $advantage_id,
				'NAME' => $advantage->info['name']
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

		$advantage_id=getInt('id');
        if ($advantage_id)
        {
			$advantage = new cAdvantage($advantage_id);
			$advantage->loadAll();
	    	tplParseBlock('advantage_edit', array('CID' => $advantage->info['cid']));

			foreach ($tree->nodes as $node_id => $node)
			if ($node->info['name']!=TREE_ROOT_NODE_NAME)
			tplParseBlock('cid_edit', array(
				'ID' => $node_id,
				'NAME' => ( ($node->info['parent_id']>0) ? '&nbsp;&nbsp;&nbsp;&nbsp;' : '' ).$node->info['name'],
				'SEL' => ($node_id == $advantage->info['cid']) ? ' selected' : ''
			));

	    	tplParseBlock('advantage', array(
	    		'ID' => $advantage_id,
				'VISIBLE' => ($advantage->info['visible'] == "1") ? "checked" : "",
	    		'NAME' => _htmlspecialchars($advantage->info['name']),
	    		'TEXT' => _htmlspecialchars($advantage->info['text']),
				'IMG' => ($advantage->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/advantages/'.$advantage->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=delimg&el=img&id='.$advantage_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
			$cid = getInt('cid');
	    	tplParseBlock('advantage_new', array('CID' => $cid));
			
			foreach ($tree->nodes as $node_id => $node)
			if ($node->info['name']!=TREE_ROOT_NODE_NAME)
			tplParseBlock('cid_edit', array(
				'ID' => $node_id,
				'NAME' => ( ($node->info['parent_id']>0) ? '&nbsp;&nbsp;&nbsp;&nbsp;' : '' ).$node->info['name'],
				'SEL' => ($node_id == $cid) ? ' selected' : ''
			));

	    	tplParseBlock('advantage',array(
				'VISIBLE'=> "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;

		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/advantages/");
    	$advantage_id=getInt('id');
        $advantage= new cAdvantage($advantage_id);
		$advantage->info["visible"]=getBool("visible");
		$advantage->info["name"]=getVar("name");
		$advantage->info["text"]=getVar("text");
		$advantage->info["cid"] = getInt("cid");
		if ($img) $advantage->info["img"] = $img;
		if (!$advantage_id) $advantage->buildIncOrdernum();
		$advantage->save();

		if ($advantage_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=edit&id=".$advantage->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=advantages&cid=".getInt("cid"));
    }
	
    function vis()
    {
    	$advantage_id=getInt('id');
        $advantage= new cAdvantage($advantage_id);
		$advantage->info["visible"] = "1";
		$advantage->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$advantage_id=getInt('id');
        $advantage= new cAdvantage($advantage_id);
		$advantage->info["visible"] = "0";
		$advantage->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$advantage_id=getInt('id');
    	$advantage=new cAdvantage($advantage_id);
    	$advantage->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$advantage_id=getInt('id');
        $advantage= new cAdvantage($advantage_id);
		$advantage->info[$_GET["el"]] = '';
		$advantage->save();
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
					down($_GET["id"],TABLE_ADVANTAGES,"cid",$_GET["cid"]);
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "up":
					up($_GET["id"],TABLE_ADVANTAGES,"cid",$_GET["cid"]);
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>