<?
class cModMaintexts
{
	function Init()
	{
		tplLoadTemplateFile('maintexts.tpl');
	}

	function show()
	{
		$maintext_list = new cMaintextList();
		$list = $maintext_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $maintext_id => $maintext)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $maintext_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $maintext_id
			));
			if ($maintext->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $maintext_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $maintext_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $maintext_id,
				'NAME' => strip_tags($maintext->info['name'])
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		$maintext_id=getInt('id');
        if ($maintext_id)
        {
			$maintext = new cMaintext($maintext_id);
			$maintext->loadAll();
	    	tplParseBlock('maintext_edit');

	    	tplParseBlock('maintext', array(
	    		'ID' => $maintext_id,
	    		'NAME' => _htmlspecialchars($maintext->info['name']),
				'LINK' => _htmlspecialchars($maintext->info['link']),
				'PRICE' => _htmlspecialchars($maintext->info['price']),
				'VISIBLE' => ($maintext->info['visible'] == "1") ? "checked" : "",
				'IMG' => ($maintext->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/maintexts/'.$maintext->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=maintexts&action=delimg&el=img&id='.$maintext_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG1' => ($maintext->info['img1']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/maintexts/'.$maintext->info['img1'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=maintexts&action=delimg&el=img1&id='.$maintext_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('maintext_new');
	    	tplParseBlock('maintext',array(
				'ITAB'=> '1',
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/maintexts/");
		$img1 = uploadi($_FILES["img1"]["tmp_name"],$_FILES["img1"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/maintexts/");

    	$maintext_id=getInt('id');
        $maintext= new cMaintext($maintext_id);
		$maintext->info["name"]=getVar("name");
		$maintext->info["price"]=getVar("price");
		$maintext->info["link"]=getVar("link");
		$maintext->info["visible"]=getBool("visible");
		if ($img) $maintext->info["img"] = $img;
		if ($img1) $maintext->info["img1"] = $img1;
		if (!$maintext_id) $maintext->buildIncOrdernum();
		$maintext->save();

		if ($maintext_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=maintexts&action=edit&id=".$maintext->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=maintexts");
    }
	
    function vis()
    {
    	$maintext_id=getInt('id');
        $maintext= new cMaintext($maintext_id);
		$maintext->info["visible"] = "1";
		$maintext->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$maintext_id=getInt('id');
        $maintext= new cMaintext($maintext_id);
		$maintext->info["visible"] = "0";
		$maintext->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$maintext_id=getInt('id');
    	$maintext=new cMaintext($maintext_id);
    	$maintext->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$maintext_id=getInt('id');
        $maintext= new cMaintext($maintext_id);
		$maintext->info[$_GET["el"]] = '';
		$maintext->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }
	
    function Run()
    {
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
					up($_GET["id"],TABLE_MAINTEXTS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_MAINTEXTS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":
					if ( (isset($_POST["name"])) && ($_POST["name"]!='') ) $this->submit();
				break;
        	}
		}
		else $this->show();
    }
}
?>