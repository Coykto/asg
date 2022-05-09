<?
class cModClinics
{
	function Init()
	{
		tplLoadTemplateFile('clinics.tpl');
	}

	function show()
	{
		$clinic_list = new cClinicList();
		$list = $clinic_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $clinic_id => $clinic)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $clinic_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $clinic_id
			));
			if ($clinic->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $clinic_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $clinic_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $clinic_id,
				'NAME' => $clinic->info['name']
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		$clinic_id=getInt('id');
        if ($clinic_id)
        {
			$clinic = new cClinic($clinic_id);
			$clinic->loadAll();
	    	tplParseBlock('clinic_edit');

	    	tplParseBlock('clinic', array(
	    		'ID' => $clinic_id,
	    		'NAME' => _htmlspecialchars($clinic->info['name']),
				'NAME_EN' => _htmlspecialchars($clinic->info['name_en']),
				'NAME_UA' => _htmlspecialchars($clinic->info['name_ua']),
				'ADDRESS' => _htmlspecialchars($clinic->info['address']),
				'ADDRESS_EN' => _htmlspecialchars($clinic->info['address_en']),
				'ADDRESS_UA' => _htmlspecialchars($clinic->info['address_ua']),
				'WTIME' => _htmlspecialchars($clinic->info['wtime']),
				'WTIME_EN' => _htmlspecialchars($clinic->info['wtime_en']),
				'WTIME_UA' => _htmlspecialchars($clinic->info['wtime_ua']),
				'VISIBLE' => ($clinic->info['visible'] == "1") ? "checked" : "",
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('clinic_new');
	    	tplParseBlock('clinic',array(
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		
    	$clinic_id=getInt('id');
        $clinic= new cClinic($clinic_id);
		$clinic->info["name"]=getVar("name");
		$clinic->info["name_en"]=getVar("name_en");
		$clinic->info["name_ua"]=getVar("name_ua");
		$clinic->info["address"]=getVar("address");
		$clinic->info["address_en"]=getVar("address_en");
		$clinic->info["address_ua"]=getVar("address_ua");
		$clinic->info["wtime"]=getVar("wtime");
		$clinic->info["wtime_en"]=getVar("wtime_en");
		$clinic->info["wtime_ua"]=getVar("wtime_ua");
		$clinic->info["visible"]=getBool("visible");
		if (!$clinic_id) $clinic->buildIncOrdernum();
		$clinic->save();
		
		if ($clinic_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=edit&id=".$clinic->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=clinics");
    }
	
    function vis()
    {
    	$clinic_id=getInt('id');
        $clinic= new cClinic($clinic_id);
		$clinic->info["visible"] = "1";
		$clinic->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$clinic_id=getInt('id');
        $clinic= new cClinic($clinic_id);
		$clinic->info["visible"] = "0";
		$clinic->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$clinic_id=getInt('id');
    	$clinic=new cClinic($clinic_id);
    	$clinic->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$clinic_id=getInt('id');
        $clinic= new cClinic($clinic_id);
		$clinic->info[$_GET["el"]] = '';
		$clinic->save();
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
					up($_GET["id"],TABLE_CLINICS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_CLINICS,"","");
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