<?
class cModServices
{
	function Init()
	{
		tplLoadTemplateFile('services.tpl');
	}

	function show()
	{
		$service_list = new cServiceList();
		$list = $service_list->getList();
		foreach ($list as $service_id => $service)
		{
			if ($service->info['parent_id']==0)
			{
				tplParseBlock('listing_item_up', array(
					'ID' => $service_id,
					'PARENT_ID' => $service->info['parent_id']
				));
				tplParseBlock('listing_item_down', array(
					'ID' => $service_id,
					'PARENT_ID' => $service->info['parent_id']
				));
				if ($service->info['visible']=='1') tplParseBlock('listing_item_visible', array(
					'ID' => $service_id,
					'PARENT_ID' => $service->info['parent_id']
				));
				else tplParseBlock('listing_item_nvisible', array(
					'ID' => $service_id,
					'PARENT_ID' => $service->info['parent_id']
				));
				tplParseBlock('listing_item_p', array(
					'PARENT_ID' => $service_id
				));
				tplParseBlock('listing_item', array(
					'ID' => $service_id,
					'NAME' => $service->info['name'],
					'PARENT_ID' => $service->info['parent_id']
				));

				foreach ($list as $service_id1 => $service1)
				{
					if ($service1->info['parent_id']==$service_id)
					{
						tplParseBlock('listing_item_up', array(
							'ID' => $service_id1,
							'PARENT_ID' => $service1->info['parent_id']
						));
						tplParseBlock('listing_item_down', array(
							'ID' => $service_id1,
							'PARENT_ID' => $service1->info['parent_id'],
						));
						if ($service1->info['visible']=='1') tplParseBlock('listing_item_visible', array(
							'ID' => $service_id1,
							'PARENT_ID' => $service1->info['parent_id'],
						));
						else tplParseBlock('listing_item_nvisible', array(
							'ID' => $service_id1,
							'PARENT_ID' => $service1->info['parent_id'],
						));
						tplParseBlock('listing_item_p', array(
							'PARENT_ID' => $service_id1
						));
						tplParseBlock('listing_item', array(
							'ID' => $service_id1,
							'NAME' => $service1->info['name'],
							'PARENT_ID' => $service1->info['parent_id'],
							'MARGIN' => '&nbsp;&nbsp;&nbsp;&nbsp;',
						));
						
						foreach ($list as $service_id2 => $service2)
						{
							if ($service2->info['parent_id']==$service_id1)
							{
								tplParseBlock('listing_item_up', array(
									'ID' => $service_id2,
									'PARENT_ID' => $service2->info['parent_id']
								));
								tplParseBlock('listing_item_down', array(
									'ID' => $service_id2,
									'PARENT_ID' => $service2->info['parent_id'],
								));
								if ($service2->info['visible']=='1') tplParseBlock('listing_item_visible', array(
									'ID' => $service_id2,
									'PARENT_ID' => $service2->info['parent_id'],
								));
								else tplParseBlock('listing_item_nvisible', array(
									'ID' => $service_id2,
									'PARENT_ID' => $service2->info['parent_id'],
								));
								tplParseBlock('listing_item', array(
									'ID' => $service_id2,
									'NAME' => $service2->info['name'],
									'PARENT_ID' => $service2->info['parent_id'],
									'MARGIN' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
								));
							}
						}
					}
				}
			}
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		$service_id=getInt('id');
        if ($service_id)
        {
			$service = new cService($service_id);
			$service->loadAll();
			tplParseBlock('service_edit');

			$service_list = new cServiceList();
			$list = $service_list->getList();
			foreach ($list as $service_id1 => $service1)
			{
				if ( ($service1->info['parent_id']==0) && ($service->info['id']<>$service_id1) )
				{
					tplParseBlock('parent', array(
						'ID' => $service_id1,
						'NAME' => $service1->info['name'],
						'SELECTED' => ($service->info['parent_id'] == $service_id1) ? 'selected' : '',
						'MARGIN' => '',
					));
						
					foreach ($list as $service_id2 => $service2)
					if ( ($service2->info['parent_id']==$service_id1) && ($service->info['id']<>$service_id2) )
					{
						tplParseBlock('parent', array(
							'ID' => $service_id2,
							'NAME' => $service2->info['name'],
							'SELECTED' => ($service->info['parent_id'] == $service_id2) ? 'selected' : '',
							'MARGIN' => '&nbsp;&nbsp;&nbsp;&nbsp;',
						));
					}
				}
			}
			
			$tree=new cOrderedTree();
			$tree->load();
			foreach ($tree->nodes as $node_id => $node)
			if ($node->info['name']!=TREE_ROOT_NODE_NAME)
			{
				tplParseBlock('pid', array(
					'ID' => $node_id,
					'NAME' => $node->info['name'],
					'SELECTED' => ($service->info['pid'] == $node_id) ? 'selected' : '',
					'MARGIN' => ($node->getLevel()==2) ? '&nbsp;&nbsp;&nbsp;&nbsp;' : ''
				));
			}
		
	    	tplParseBlock('service', array(
	    		'ID' => $service_id,
	    		'NAME' => _htmlspecialchars($service->info['name']),
				'VISIBLE' => ($service->info['visible'] == "1") ? "checked" : "",
				'MTYPE1' => ($service->info['mtype'] == 1) ? "selected" : "",
				'MTYPE2' => ($service->info['mtype'] == 2) ? "selected" : "",
				'MTYPE3' => ($service->info['mtype'] == 3) ? "selected" : "",
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('service_new');
			$parent_id = getInt('parent_id');
			
			$service_list = new cServiceList();
			$list = $service_list->getList();
			foreach ($list as $service_id1 => $service1)
			{
				if ($service1->info['parent_id']==0)
				{
					tplParseBlock('parent', array(
						'ID' => $service_id1,
						'NAME' => $service1->info['name'],
						'MARGIN' => '',
						'SELECTED' => ($parent_id == $service_id1) ? 'selected' : '',
					));
						
					foreach ($list as $service_id2 => $service2)
					if ($service2->info['parent_id']==$service_id1)
					{
						tplParseBlock('parent', array(
							'ID' => $service_id2,
							'NAME' => $service2->info['name'],
							'MARGIN' => '&nbsp;&nbsp;&nbsp;&nbsp;',
							'SELECTED' => ($parent_id == $service_id2) ? 'selected' : '',
						));
					}
				}
			}
			
			$tree=new cOrderedTree();
			$tree->load();
			foreach ($tree->nodes as $node_id => $node)
			if ($node->info['name']!=TREE_ROOT_NODE_NAME)
			{
				tplParseBlock('pid', array(
					'ID' => $node_id,
					'NAME' => $node->info['name'],
					'MARGIN' => ($node->getLevel()==2) ? '&nbsp;&nbsp;&nbsp;&nbsp;' : ''
				));
			}

	    	tplParseBlock('service',array(
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
    	$service_id=getInt('id');
        $service= new cService($service_id);
		$service->info["name"]=getVar("name");
		$service->info["visible"]=getBool("visible");
		$service->info["parent_id"]=getInt("parent_id");
		$service->info["pid"]=getInt("pid");
		$service->info["mtype"]=getInt("mtype");
		if (!$service_id) $service->buildIncOrdernum();
		$service->save();
		
		if ($service_id>0) header ("Location: ".$_SERVER['HTTP_REFERER']);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=services");
    }
	
    function vis()
    {
    	$service_id=getInt('id');
        $service= new cService($service_id);
		$service->info["visible"] = "1";
		$service->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$service_id=getInt('id');
        $service= new cService($service_id);
		$service->info["visible"] = "0";
		$service->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$service_id=getInt('id');
    	$service=new cService($service_id);
    	$service->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$service_id=getInt('id');
        $service= new cService($service_id);
		$service->info[$_GET["el"]] = '';
		$service->save();
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
					up($_GET["id"],TABLE_SERVICES,"parent_id",$_GET['parent_id']);
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_SERVICES,"parent_id",$_GET['parent_id']);
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