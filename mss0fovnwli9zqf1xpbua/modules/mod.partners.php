<?
class cModPartners
{
	function Init()
	{
		tplLoadTemplateFile('partners.tpl');
	}

	function show()
	{
		$partner_list = new cPartnerList();
		$list = $partner_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $partner_id => $partner)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $partner_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $partner_id
			));
			if ($partner->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $partner_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $partner_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $partner_id,
				'NAME' => $partner->info['name']
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		$partner_id=getInt('id');
        if ($partner_id)
        {
			$partner = new cPartner($partner_id);
			$partner->loadAll();
	    	tplParseBlock('partner_edit');

	    	tplParseBlock('partner', array(
	    		'ID' => $partner_id,
	    		'NAME' => _htmlspecialchars($partner->info['name']),
				'LINK' => _htmlspecialchars($partner->info['link']),
				'VISIBLE' => ($partner->info['visible'] == "1") ? "checked" : "",
				'IMG' => ($partner->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/partners/'.$partner->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=partners&action=delimg&el=img&id='.$partner_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('partner_new');
	    	tplParseBlock('partner',array(
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/partners/");
		
    	$partner_id=getInt('id');
        $partner= new cPartner($partner_id);
		$partner->info["name"]=getVar("name");
		$partner->info["link"]=getVar("link");
		$partner->info["visible"]=getBool("visible");
		if ($img) $partner->info["img"]=$img;
		if (!$partner_id) $partner->buildIncOrdernum();
		$partner->save();

		if ($partner_id>0) header ("Location: ".$_SERVER['HTTP_REFERER']);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=partners");
    }
	
    function vis()
    {
    	$partner_id=getInt('id');
        $partner= new cPartner($partner_id);
		$partner->info["visible"] = "1";
		$partner->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$partner_id=getInt('id');
        $partner= new cPartner($partner_id);
		$partner->info["visible"] = "0";
		$partner->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$partner_id=getInt('id');
    	$partner=new cPartner($partner_id);
    	$partner->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$partner_id=getInt('id');
        $partner= new cPartner($partner_id);
		$partner->info[$_GET["el"]] = '';
		$partner->save();
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
					up($_GET["id"],TABLE_PARTNERS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_PARTNERS,"","");
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