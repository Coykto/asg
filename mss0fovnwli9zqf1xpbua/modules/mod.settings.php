<?
class cModSettings
{
	function Init()
	{
		tplLoadTemplateFile('settings.tpl');
	}

	function show()
	{
	}

    function showForm()
    {
		$setting_id=getInt('group_id');
		$setting = new cSettingsGroup($setting_id);
		$setting->loadAll();

		$vars = array();
		$vars["ID"] = $setting_id;
		
		$set_list = new cSettingList();
		$set_list->setFilter(array(
			FILTER_GROUP => $setting_id));
		$list = $set_list->getList();
		foreach ($list as $set_id=>$set)
		{
			$vars[strtoupper($set->info['set'])] = htmlspecialchars($set->info['value'], ENT_QUOTES);
			if ($set->info['values'])
			{				
				$values = explode(',', $set->info['values']);
				foreach ($values as $val)
				{
					switch($set->info['type'])
					{
						case 'select': $value = $set->info['value'] == $val ? 'selected':''; break;
						case 'check': $value = $set->info['value'] == $val ? 'checked':''; break;
						default: $value='';
					}
					$vars[strtoupper($set->info['set']).'_'.strtoupper($val)] = $value;
				}
			}
		}
		
		tplParseBlock('settings_group_'.$setting_id.'_n');
		
	    tplParseBlock('settings_group_'.$setting_id, $vars);
	
		tplParseBlock('settings', array(
    		'ID'=>$setting_id,
			'HOST' => HOST
		));
    }

    function submit()
    {
    	$setting_id=getInt('group_id');
		$set_list = new cSettingList();
		$set_list->setFilter(array(
			FILTER_GROUP => $setting_id));
		$list = $set_list->getList();
		foreach ($list as $set_id=>$set)
		{
			if ($set->info['set']=='password') 
			{
				$set->info['value'] = password_hash(getVar($set->info['set']),PASSWORD_DEFAULT);
			}
			else $set->info['value'] = getVar($set->info['set']);
			$set->save();
		}
		header ("Location: ".$_SERVER['HTTP_REFERER']);
	}

	function del()
	{
		GLOBAL $mysqli;
		$res = $mysqli->query("UPDATE ".TABLE_SETTINGS." SET value='' WHERE set='".$_GET["el"]."' ");
		header ("Location: ".$_SERVER['HTTP_REFERER']);
	}
	
    function Run()
    {
   		if (isset($_REQUEST['action']))
   		{
        	switch ($_REQUEST['action'])
        	{
            	case "submit":$this->submit();break;
				case "del":$this->del();break;
            	default:break;
        	}
   		}
		else $this->showForm();
    }
}
?>