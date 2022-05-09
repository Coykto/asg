<?
class cModDepartments
{
	function Init()
	{
		tplLoadTemplateFile('departments.tpl');
	}

	function show()
	{
		$department_list = new cDepartmentList();
		$list = $department_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $department_id => $department)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $department_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $department_id
			));
			if ($department->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $department_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $department_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $department_id,
				'NAME' => $department->info['name']
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		$department_id=getInt('id');
        if ($department_id)
        {
			$department = new cDepartment($department_id);
			$department->loadAll();
	    	tplParseBlock('department_edit');

	    	tplParseBlock('department', array(
	    		'ID' => $department_id,
	    		'NAME' => _htmlspecialchars($department->info['name']),
				'NAME_EN' => _htmlspecialchars($department->info['name_en']),
				'NAME_UA' => _htmlspecialchars($department->info['name_ua']),
				'PHONE' => _htmlspecialchars($department->info['phone']),
				'EMAIL' => _htmlspecialchars($department->info['email']),
				'VISIBLE' => ($department->info['visible'] == "1") ? "checked" : "",
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('department_new');
	    	tplParseBlock('department',array(
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
    	$department_id=getInt('id');
        $department= new cDepartment($department_id);
		$department->info["name"]=getVar("name");
		$department->info["name_en"]=getVar("name_en");
		$department->info["name_ua"]=getVar("name_ua");
		$department->info["email"]=getVar("email");
		$department->info["phone"]=getVar("phone");
		$department->info["visible"]=getBool("visible");
		if (!$department_id) $department->buildIncOrdernum();
		$department->save();

		if ($department_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=departments&action=edit&id=".$department->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=departments");
    }
	
    function vis()
    {
    	$department_id=getInt('id');
        $department= new cDepartment($department_id);
		$department->info["visible"] = "1";
		$department->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$department_id=getInt('id');
        $department= new cDepartment($department_id);
		$department->info["visible"] = "0";
		$department->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$department_id=getInt('id');
    	$department=new cDepartment($department_id);
    	$department->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$department_id=getInt('id');
        $department= new cDepartment($department_id);
		$department->info[$_GET["el"]] = '';
		$department->save();
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
					up($_GET["id"],TABLE_DEPARTMENTS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_DEPARTMENTS,"","");
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