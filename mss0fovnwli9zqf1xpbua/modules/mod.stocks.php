<?
class cModStocks
{
	function Init()
	{
		tplLoadTemplateFile('stocks.tpl');
	}
	
	function show()
	{
		$stock_list = new cStockList();
		$list = $stock_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $stock_id => $stock)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $stock_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $stock_id
			));
			if ($stock->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $stock_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $stock_id
			));				
			tplParseBlock('listing_item', array(
				'ID' => $stock_id,
				'NAME' => $stock->info['name']
			));
		}
	
		tplParseBlock('listing');
	}

    function showForm()
    {
		GLOBAL $mysqli;
		
		$stock_id=getInt('id');
		
        if ($stock_id)
        {
			$stock = new cStock($stock_id);
			$stock->loadAll();
	    	tplParseBlock('stock_edit');
			
	    	tplParseBlock('stock', array(
	    		'ID' => $stock_id,
				'VISIBLE' => ($stock->info['visible'] == "1") ? "checked" : "",
				'SHOWNAME' => ($stock->info['showname'] == "1") ? "checked" : "",
				'SHOWBUTTON' => ($stock->info['showbutton'] == "1") ? "checked" : "",
	    		'NAME' => _htmlspecialchars($stock->info['name']),
				'IMG' => ($stock->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/stocks/'.$stock->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=stocks&action=delimg&el=img&id='.$stock_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
	    	tplParseBlock('stock_new');
	    	tplParseBlock('stock',array(
				'VISIBLE'=> "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;

		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/stocks/");

    	$stock_id=getInt('id');
        $stock= new cStock($stock_id);
		$stock->info["visible"]=getBool("visible");
		$stock->info["showname"]=getBool("showname");
		$stock->info["showbutton"]=getBool("showbutton");
		$stock->info["name"]=getVar("name");
		if ($img) $stock->info["img"] = $img;
		if (!$stock_id) $stock->buildIncOrdernum();
		$stock->save();

		if ($stock_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=stocks&action=edit&id=".$stock->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=stocks");
    }
	
    function vis()
    {
    	$stock_id=getInt('id');
        $stock= new cStock($stock_id);
		$stock->info["visible"] = "1";
		$stock->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$stock_id=getInt('id');
        $stock= new cStock($stock_id);
		$stock->info["visible"] = "0";
		$stock->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$stock_id=getInt('id');
    	$stock=new cStock($stock_id);
    	$stock->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$stock_id=getInt('id');
        $stock= new cStock($stock_id);
		$stock->info[$_GET["el"]] = '';
		$stock->save();
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
					up($_GET["id"],TABLE_STOCKS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_STOCKS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>