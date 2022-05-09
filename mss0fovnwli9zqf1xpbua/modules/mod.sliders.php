<?
class cModSliders
{
	function Init()
	{
		tplLoadTemplateFile('sliders.tpl');
	}

	function show()
	{
		$slider_list = new cSliderList();
		$list = $slider_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $slider_id => $slider)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $slider_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $slider_id
			));
			if ($slider->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $slider_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $slider_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $slider_id,
				'NAME' => strip_tags($slider->info['name'])
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		$slider_id=getInt('id');
        if ($slider_id)
        {
			$slider = new cSlider($slider_id);
			$slider->loadAll();
	    	tplParseBlock('slider_edit');

	    	tplParseBlock('slider', array(
	    		'ID' => $slider_id,
	    		'NAME' => _htmlspecialchars($slider->info['name']),
				'VISIBLE' => ($slider->info['visible'] == "1") ? "checked" : "",
				'IMG' => ($slider->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/sliders/'.$slider->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=sliders&action=delimg&el=img&id='.$slider_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('slider_new');
	    	tplParseBlock('slider',array(
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/sliders/");
		
    	$slider_id=getInt('id');
        $slider= new cSlider($slider_id);
		$slider->info["name"]=getVar("name");
		$slider->info["visible"]=getBool("visible");
		if ($img) 
		{
			resizeh($img,$_SERVER["DOCUMENT_ROOT"]."/templates/images/sliders/",235,"s_");
			$slider->info["img"]=$img;
		}
		
		if (!$slider_id) $slider->buildIncOrdernum();
		$slider->save();

		if ($slider_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=sliders&action=edit&id=".$slider->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=sliders");
    }
	
    function vis()
    {
    	$slider_id=getInt('id');
        $slider= new cSlider($slider_id);
		$slider->info["visible"] = "1";
		$slider->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$slider_id=getInt('id');
        $slider= new cSlider($slider_id);
		$slider->info["visible"] = "0";
		$slider->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$slider_id=getInt('id');
    	$slider=new cSlider($slider_id);
    	$slider->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$slider_id=getInt('id');
        $slider= new cSlider($slider_id);
		$slider->info[$_GET["el"]] = '';
		$slider->save();
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
					up($_GET["id"],TABLE_SLIDERS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_SLIDERS,"","");
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