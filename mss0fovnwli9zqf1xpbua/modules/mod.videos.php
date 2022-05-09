<?
class cModVideos
{
	function Init()
	{
		tplLoadTemplateFile('videos.tpl');
	}
	
	function show()
	{
		$video_list = new cVideoList();
		$list = $video_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $video_id => $video)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $video_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $video_id
			));
			if ($video->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $video_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $video_id
			));				
			tplParseBlock('listing_item', array(
				'ID' => $video_id,
				'NAME' => $video->info['name']
			));
		}
	
		tplParseBlock('listing');
	}

    function showForm()
    {
		GLOBAL $mysqli;
		
		$video_id=getInt('id');
		
        if ($video_id)
        {
			$video = new cVideo($video_id);
			$video->loadAll();
	    	tplParseBlock('video_edit');
			
	    	tplParseBlock('video', array(
	    		'ID' => $video_id,
				'VISIBLE' => ($video->info['visible'] == "1") ? "checked" : "",
	    		'NAME' => _htmlspecialchars($video->info['name']),
	    		'TEXT' => _htmlspecialchars($video->info['text']),
				'IMG' => ($video->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/videos/'.$video->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=delimg&el=img&id='.$video_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
	    	tplParseBlock('video_new');
	    	tplParseBlock('video',array(
				'VISIBLE'=> "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;

		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/videos/");

    	$video_id=getInt('id');
        $video= new cVideo($video_id);
		$video->info["visible"]=getBool("visible");
		$video->info["name"]=getVar("name");
		$video->info["text"]=getVar("text");
		if ($img) $video->info["img"] = $img;
		if (!$video_id) $video->buildIncOrdernum();
		$video->save();

		if ($video_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=videos&action=edit&id=".$video->id."#pills-".getVar("pills")."-tab");
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=videos");
    }
	
    function vis()
    {
    	$video_id=getInt('id');
        $video= new cVideo($video_id);
		$video->info["visible"] = "1";
		$video->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$video_id=getInt('id');
        $video= new cVideo($video_id);
		$video->info["visible"] = "0";
		$video->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$video_id=getInt('id');
    	$video=new cVideo($video_id);
    	$video->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$video_id=getInt('id');
        $video= new cVideo($video_id);
		$video->info[$_GET["el"]] = '';
		$video->save();
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
					up($_GET["id"],TABLE_VIDEOS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_VIDEOS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>