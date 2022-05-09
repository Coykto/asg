<?
class cModEvents
{
	function Init()
	{
		tplLoadTemplateFile('events.tpl');
	}
	
	function show()
	{
		$event_list = new cEventList();
		$list = $event_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $event_id => $event)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $event_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $event_id
			));
			if ($event->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $event_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $event_id
			));				
			tplParseBlock('listing_item', array(
				'ID' => $event_id,
				'NAME' => $event->info['name']
			));
		}
	
		tplParseBlock('listing');
	}

    function showForm()
    {
		$event_id=getInt('id');

        if ($event_id)
        {
			$event = new cEvent($event_id);
			$event->loadAll();
	    	tplParseBlock('event_edit');

	    	tplParseBlock('event', array(
	    		'ID' => $event_id,
	    		'NAME' => _htmlspecialchars($event->info['name']),
	    		'TEXT' => _htmlspecialchars($event->info['text']),
				'TEXTSMALL' => _htmlspecialchars($event->info['textsmall']),
				'VIDEO' => _htmlspecialchars($event->info['video']),
				'LEVEL' => _htmlspecialchars($event->info['level']),
				'WTIME' => _htmlspecialchars($event->info['wtime']),
				'VISIBLE' => ($event->info['visible'] == "1") ? "checked" : "",
				'FORREG' => ($event->info['forreg'] == "1") ? "checked" : "",
	    		'TITLE' => _htmlspecialchars($event->info['title']),
	    		'DESCRIPTION' => _htmlspecialchars($event->info['description']),
	    		'KEYWORDS' => _htmlspecialchars($event->info['keywords']),
	    		'CPU' => $event->info['cpu'],
				'IMG' => ($event->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/events/'.$event->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=delimg&el=img&id='.$event_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'IMG1' => ($event->info['img1']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/events/'.$event->info['img1'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=delimg&el=img1&id='.$event_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
	    	tplParseBlock('event_new');
	    	tplParseBlock('event',array(
				'VISIBLE'=> "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/events/");
		$img1 = uploadi($_FILES["img1"]["tmp_name"],$_FILES["img1"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/events/");
		
    	$event_id=getInt('id');
        $event= new cEvent($event_id);
		$event->info["name"]=getVar("name");
		$event->info["text"]=getVar("text");
		$event->info["textsmall"]=getVar("textsmall");
		$event->info["level"]=getVar("level");
		$event->info["video"]=getVar("video");
		$event->info["forreg"]=getBool("forreg");
		$event->info["wtime"]=getVar("wtime");
		$event->info["visible"]=getBool("visible");
		$event->info["title"]=getVar("title");
		$event->info["description"]=getVar("description");
		$event->info["keywords"]=getVar("keywords");
		$event->info["cpu"]=getVar("cpu");
		if ($img) $event->info["img"]=$img;
		if ($img1) $event->info["img1"]=$img1;
		if (!$event_id) $event->buildIncOrdernum();
		if ( ($event->info["cpu"] == '') || (!preg_match("/^[-_a-zA-Z0-9]+$/", $event->info["cpu"])) ) $event->info["cpu"] = makecpu($event->info["name"]);
		$event->save();

		$res = $mysql->query("SELECT * FROM ".TABLE_EVENTS." WHERE cpu='".$event->info["cpu"]."' AND id<>".$event->id." ");
		$row = $res->num_rows;
		if ($row>0) $res = $mysqli->query("UPDATE ".TABLE_EVENTS." SET cpu='".$event->id."' WHERE id=".$event->id);

		if ($event_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=events&action=edit&id=".$event->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=events&id=");
    }
	
    function vis()
    {
    	$event_id=getInt('id');
        $event= new cEvent($event_id);
		$event->info["visible"] = "1";
		$event->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$event_id=getInt('id');
        $event= new cEvent($event_id);
		$event->info["visible"] = "0";
		$event->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$event_id=getInt('id');
    	$event=new cEvent($event_id);
    	$event->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$event_id=getInt('id');
        $event= new cEvent($event_id);
		$event->info[$_GET["el"]] = '';
		$event->save();
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
					up($_GET["id"],TABLE_EVENTS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_EVENTS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>