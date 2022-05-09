<?
class cModUsers
{
	function Init()
	{
		tplLoadTemplateFile('users.tpl');
	}

	function show()
	{
		$user_list = new cUserList();
		$list = $user_list->getList();
		foreach ($list as $user_id => $user)
		{
			if ($user->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $user_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $user_id
			));
			if ($user->info['partner']=='1') tplParseBlock('listing_item_p');
			tplParseBlock('listing_item', array(
				'ID' => $user_id,
				'NAME' => $user->info['name'],
				'FNAME' => $user->info['fname'],
				'PHONE' => $user->info['phone'],
				'EMAIL' => $user->info['email'],
				'ADDRESS' => $user->info['address'],
				'DATE' => date("d.m.Y H:i",$user->info['date'])
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		GLOBAL $mysqli;

		$user_id=getInt('id');
        if ($user_id)
        {
			$user = new cUser($user_id);
			$user->loadAll();
	    	tplParseBlock('user_edit');

			$res = $mysqli->query("SELECT * FROM bonus_history WHERE user_id='".$user_id."' ORDER BY id DESC ");
			while ($row = $res->fetch_array())
			{
				if ($row['order_id']>0) tplParseBlock('his_o', array(
					'ID' => $row['order_id'],
				));
				
				tplParseBlock('his', array(
					'DATE' => date('d.m.Y H:i',$row['date']),
					'PRICE' => $row['price'],
					'COMM' => $row['comm']
				));
			}
			
	    	tplParseBlock('user', array(
	    		'ID' => $user_id,
	    		'NAME' => _htmlspecialchars($user->info['name']),
				'FNAME' => _htmlspecialchars($user->info['fname']),
				'ADDRESS' => _htmlspecialchars($user->info['address']),
				'PHONE' => _htmlspecialchars($user->info['phone']),
				'EMAIL' => _htmlspecialchars($user->info['email']),
				'BONUS_MONEY' => $user->info['bonus_money'],
				'P_CODE' => $user->info['p_code'],
				'P_PERCENT' => $user->info['p_percent'],
				'P_BONUS' => $user->info['p_bonus'],
				'PARTNER' => ($user->info['partner'] == "1") ? "checked" : "",
				'VISIBLE' => ($user->info['visible'] == "1") ? "checked" : "",
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('user_new');
	    	tplParseBlock('user',array(
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		
		$code = getVar("p_code");
    	$user_id=getInt('id');
        $user= new cUser($user_id);
		if ($user_id>0) 
		{
			$user->loadAll();
			$partner_old = $user->info["partner"];
		}
		$user->info["name"]=getVar("name");
		$user->info["fname"]=getVar("fname");
		$user->info["email"]=getVar("email");
		$user->info["address"]=getVar("address");
		$user->info["phone"]=getVar("phone");
		if (getVar("password")!='') $user->info["password"]=crypt(getVar("password"));
		$user->info["visible"]=getBool("visible");
		$user->info["partner"]=getBool("partner");
		$user->info["p_percent"]=getInt("p_percent");
		$user->info["p_bonus"]=getInt("p_bonus");
		if ($code!='')
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_USERS." WHERE p_code='".$code."' ".( ($user_id>0) ? " AND id<>'".$user_id."' " : "" )." ");
			$row = $res->fetch_array();
			if ($row["id"]<1) 
			{
				$res = $mysqli->query("SELECT * FROM ".TABLE_ACTIONS." WHERE code='".$code."' ");
				$row = $res->fetch_array();
				if ($row["id"]<1) $user->info["p_code"]=$code;
				else $user->info["p_code"] = create_code();
			}
			else $user->info["p_code"] = create_code();
		}
		else 
		{
			$user->info["p_code"] = create_code();
		}
		if ( (isset($partner_old)) && ($partner_old=='0') && ($user->info["partner"]=='1') && ($user->info["p_email_send"]=='0') )
		{
			$user->info["p_email_send"] = '1';
			XMail("bl@testwork.net",$user->info["email"],"Поздравляем, Вы стали партнером Bandsclub",iconv("utf-8","windows-1251",
			str_replace('|name|',$user->info["name"],str_replace('|code|',$user->info["p_code"],str_replace('|discount|',$user->info["p_percent"],str_replace('|bonus|',$user->info["p_bonus"],str_replace('../',HOST,get_set('partner_mail'))))))
			));
		}
		
		if ($user_id<1) $user->info["date"]=time();
		$user->save();

		if ($user_id>0) header ("Location: ".$_SERVER['HTTP_REFERER']);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=users");
    }
	
    function vis()
    {
    	$user_id=getInt('id');
        $user= new cUser($user_id);
		$user->info["visible"] = "1";
		$user->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$user_id=getInt('id');
        $user= new cUser($user_id);
		$user->info["visible"] = "0";
		$user->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$user_id=getInt('id');
    	$user=new cUser($user_id);
    	$user->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$user_id=getInt('id');
        $user= new cUser($user_id);
		$user->info[$_GET["el"]] = '';
		$user->save();
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
					up($_GET["id"],TABLE_USERS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_USERS,"","");
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