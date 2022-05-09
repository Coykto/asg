<?
class cModMedias
{
	function Init()
	{
		tplLoadTemplateFile('medias.tpl');
	}
	
	function show()
	{
		$media_list = new cMediaList();
		$list = $media_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $media_id => $media)
		{
			$i++;
			if ($media->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $media_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $media_id
			));				
			tplParseBlock('listing_item', array(
				'ID' => $media_id,
				'DATE' => date("d.m.Y",$media->info['date']),
				'NAME' => $media->info['name']
			));
		}
	
		tplParseBlock('listing');
	}

    function showForm()
    {
		$media_id=getInt('id');
		
        if ($media_id)
        {
			$media = new cMedia($media_id);
			$media->loadAll();
	    	tplParseBlock('media_edit');
	    	tplParseBlock('media', array(
				'ITAB'=>(isset($_GET["itab"])) ? $_GET["itab"] : '1',
	    		'ID' => $media_id,
				'DATE' => date("d.m.Y",$media->info['date']),
				'VISIBLE' => ($media->info['visible'] == "1") ? "checked" : "",
	    		'NAME' => _htmlspecialchars($media->info['name']),
	    		'TEXT' => _htmlspecialchars($media->info['text']),
				'TEXTSMALL' => _htmlspecialchars($media->info['textsmall']),
	    		'TITLE' => _htmlspecialchars($media->info['title']),
	    		'DESCRIPTION' => _htmlspecialchars($media->info['description']),
	    		'KEYWORDS' => _htmlspecialchars($media->info['keywords']),
	    		'NAME_EN' => _htmlspecialchars($media->info['name_en']),
	    		'TEXT_EN' => _htmlspecialchars($media->info['text_en']),
				'TEXTSMALL_EN' => _htmlspecialchars($media->info['textsmall_en']),
	    		'TITLE_EN' => _htmlspecialchars($media->info['title_en']),
	    		'DESCRIPTION_EN' => _htmlspecialchars($media->info['description_en']),
	    		'KEYWORDS_EN' => _htmlspecialchars($media->info['keywords_en']),
	    		'NAME_UA' => _htmlspecialchars($media->info['name_ua']),
	    		'TEXT_UA' => _htmlspecialchars($media->info['text_ua']),
				'TEXTSMALL_UA' => _htmlspecialchars($media->info['textsmall_ua']),
	    		'TITLE_UA' => _htmlspecialchars($media->info['title_ua']),
	    		'DESCRIPTION_UA' => _htmlspecialchars($media->info['description_ua']),
	    		'KEYWORDS_UA' => _htmlspecialchars($media->info['keywords_ua']),

	    		'CPU' => $media->info['cpu'],
				'HOST' => HOST
    		));
        }
        else
        {
	    	tplParseBlock('media_new');
	    	tplParseBlock('media',array(
				'ITAB'=> '1',
				'VISIBLE'=> "checked",
				'DATE' => date("d.m.Y"),
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		
		$date = getVar("date");
    	$media_id=getInt('id');
        $media= new cMedia($media_id);
		$media->info["date"]=mktime(date("H"),date("i"),date("s"),substr($date,3,2),substr($date,0,2),substr($date,6,4));
		$media->info["visible"]=getBool("visible");
		$media->info["name"]=getVar("name");
		$media->info["text"]=getVar("text");
		$media->info["textsmall"]=getVar("textsmall");
		$media->info["title"]=getVar("title");
		$media->info["description"]=getVar("description");
		$media->info["keywords"]=getVar("keywords");
		$media->info["name_en"]=getVar("name_en");
		$media->info["text_en"]=getVar("text_en");
		$media->info["textsmall_en"]=getVar("textsmall_en");
		$media->info["title_en"]=getVar("title_en");
		$media->info["description_en"]=getVar("description_en");
		$media->info["keywords_en"]=getVar("keywords_en");
		$media->info["name_ua"]=getVar("name_ua");
		$media->info["text_ua"]=getVar("text_ua");
		$media->info["textsmall_ua"]=getVar("textsmall_ua");
		$media->info["title_ua"]=getVar("title_ua");
		$media->info["description_ua"]=getVar("description_ua");
		$media->info["keywords_ua"]=getVar("keywords_ua");
		$media->info["cpu"]=getVar("cpu");
		if (!$media_id) $media->buildIncOrdernum();
		if ( ($media->info["cpu"] == '') || (!preg_match("/^[-_a-zA-Z0-9]+$/", $media->info["cpu"])) ) $media->info["cpu"] = makecpu($media->info["name"]);
		$media->save();

		$res = $mysqli->query("SELECT * FROM ".TABLE_MEDIAS." WHERE cpu='".$media->info["cpu"]."' AND id<>".$media->id." ");
		$row = $res->num_rows;
		if ($row>0) $res = $mysqli->query("UPDATE ".TABLE_MEDIAS." SET cpu='".$media->id."' WHERE id=".$media->id);

		if ($media_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=medias&action=edit&id=".$media->id."&itab=".getVar('itab')."#tabs-".getVar('itab'));
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=medias&id=");
    }
	
    function vis()
    {
    	$media_id=getInt('id');
        $media= new cMedia($media_id);
		$media->info["visible"] = "1";
		$media->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$media_id=getInt('id');
        $media= new cMedia($media_id);
		$media->info["visible"] = "0";
		$media->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$media_id=getInt('id');
    	$media=new cMedia($media_id);
    	$media->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$media_id=getInt('id');
        $media= new cMedia($media_id);
		$media->info[$_GET["el"]] = '';
		$media->save();
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
					up($_GET["id"],TABLE_MEDIAS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_MEDIAS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>