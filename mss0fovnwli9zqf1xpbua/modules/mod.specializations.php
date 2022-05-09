<?
class cModSpecializations
{
	function Init()
	{
		tplLoadTemplateFile('specializations.tpl');
	}

	function show()
	{
		$specialization_list = new cSpecializationList();
		$list = $specialization_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $specialization_id => $specialization)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $specialization_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $specialization_id
			));
			if ($specialization->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $specialization_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $specialization_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $specialization_id,
				'NAME' => $specialization->info['name']
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		$specialization_id=getInt('id');
        if ($specialization_id)
        {
			$specialization = new cSpecialization($specialization_id);
			$specialization->loadAll();
	    	tplParseBlock('specialization_edit');

	    	tplParseBlock('specialization', array(
	    		'ID' => $specialization_id,
	    		'NAME' => _htmlspecialchars($specialization->info['name']),
				'VISIBLE' => ($specialization->info['visible'] == "1") ? "checked" : "",
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('specialization_new');
	    	tplParseBlock('specialization',array(
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
    	$specialization_id=getInt('id');
        $specialization= new cSpecialization($specialization_id);
		$specialization->info["name"]=getVar("name");
		$specialization->info["visible"]=getBool("visible");
		if (!$specialization_id) $specialization->buildIncOrdernum();
		$specialization->save();

		if ($specialization_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=specializations&action=edit&id=".$specialization->id."&itab=".getVar('itab')."#tabs-".getVar('itab'));
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=specializations");
    }
	
    function vis()
    {
    	$specialization_id=getInt('id');
        $specialization= new cSpecialization($specialization_id);
		$specialization->info["visible"] = "1";
		$specialization->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$specialization_id=getInt('id');
        $specialization= new cSpecialization($specialization_id);
		$specialization->info["visible"] = "0";
		$specialization->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$specialization_id=getInt('id');
    	$specialization=new cSpecialization($specialization_id);
    	$specialization->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$specialization_id=getInt('id');
        $specialization= new cSpecialization($specialization_id);
		$specialization->info[$_GET["el"]] = '';
		$specialization->save();
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
					up($_GET["id"],TABLE_SPECIALIZATIONS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_SPECIALIZATIONS,"","");
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