<?
class cModPhotos
{
	function Init()
	{
		tplLoadTemplateFile('photos.tpl');
	}

	function show()
	{
		$photo_list = new cPhotoList();
		$list = $photo_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $photo_id => $photo)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $photo_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $photo_id
			));
			if ($photo->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $photo_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $photo_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $photo_id,
				'NAME' => $photo->info['name']
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		$photo_id=getInt('id');
        if ($photo_id)
        {
			$photo = new cPhoto($photo_id);
			$photo->loadAll();
	    	tplParseBlock('photo_edit');

	    	tplParseBlock('photo', array(
	    		'ID' => $photo_id,
				'ITAB'=>(isset($_GET["itab"])) ? $_GET["itab"] : '1',
	    		'NAME' => _htmlspecialchars($photo->info['name']),
				'NAME_EN' => _htmlspecialchars($photo->info['name_en']),
				'NAME_UA' => _htmlspecialchars($photo->info['name_ua']),
				'LINK' => _htmlspecialchars($photo->info['link']),
				'LINK_EN' => _htmlspecialchars($photo->info['link_en']),
				'LINK_UA' => _htmlspecialchars($photo->info['link_ua']),
				'VISIBLE' => ($photo->info['visible'] == "1") ? "checked" : "",
				'IMG' => ($photo->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/photos/'.$photo->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=delimg&el=img&id='.$photo_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('photo_new');
	    	tplParseBlock('photo',array(
				'ITAB'=> '1',
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/photos/");
		
    	$photo_id=getInt('id');
        $photo= new cPhoto($photo_id);
		$photo->info["name"]=getVar("name");
		$photo->info["name_en"]=getVar("name_en");
		$photo->info["name_ua"]=getVar("name_ua");
		$photo->info["link"]=getVar("link");
		$photo->info["link_en"]=getVar("link_en");
		$photo->info["link_ua"]=getVar("link_ua");
		$photo->info["visible"]=getBool("visible");
		if ($img) $photo->info["img"]=$img;
		if (!$photo_id) $photo->buildIncOrdernum();
		$photo->save();

		if ($photo_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=photos&action=edit&id=".$photo->id."&itab=".getVar('itab')."#tabs-".getVar('itab'));
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=photos");
    }
	
    function vis()
    {
    	$photo_id=getInt('id');
        $photo= new cPhoto($photo_id);
		$photo->info["visible"] = "1";
		$photo->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$photo_id=getInt('id');
        $photo= new cPhoto($photo_id);
		$photo->info["visible"] = "0";
		$photo->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$photo_id=getInt('id');
    	$photo=new cPhoto($photo_id);
    	$photo->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$photo_id=getInt('id');
        $photo= new cPhoto($photo_id);
		$photo->info[$_GET["el"]] = '';
		$photo->save();
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
					up($_GET["id"],TABLE_PHOTOS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_PHOTOS,"","");
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