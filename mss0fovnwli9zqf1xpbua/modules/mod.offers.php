<?
class cModOffers
{
	function Init()
	{
		tplLoadTemplateFile('offers.tpl');
	}

	function show()
	{
		$offer_list = new cOfferList();
		$list = $offer_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $offer_id => $offer)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $offer_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $offer_id
			));
			if ($offer->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $offer_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $offer_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $offer_id,
				'NAME' => $offer->info['name']
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
        $tree = new cOrderedTree();
		$tree->load();
		
		$offer_id=getInt('id');
        if ($offer_id)
        {
			$offer = new cOffer($offer_id);
			$offer->loadAll();
	    	tplParseBlock('offer_edit');
			
			if ($offer->info['subs']!='') $subs = explode(',',$offer->info['subs']);
			else $subs = array();
			foreach ($tree->nodes as $node_id => $node1)
			if ($node1->info['name']!=TREE_ROOT_NODE_NAME)	tplParseBlock('rm1', array(
				'ID' => $node_id,
				'NAME' => $node1->info['name'],
				'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6)
			));

			foreach ($subs AS $val)
			{
				$it = $tree->getNode($val);
				if (isset($it->info['id'])) tplParseBlock('rm', array(
					'ID' => $it->info['id'],
					'NAME' => $it->info['name']
				));
			}

	    	tplParseBlock('offer', array(
	    		'ID' => $offer_id,
	    		'NAME' => _htmlspecialchars($offer->info['name']),
				'NAME_EN' => _htmlspecialchars($offer->info['name_en']),
				'NAME_UA' => _htmlspecialchars($offer->info['name_ua']),
				'VISIBLE' => ($offer->info['visible'] == "1") ? "checked" : "",
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('offer_new');
			
			foreach ($tree->nodes as $node_id => $node1)
			if ($node1->info['name']!=TREE_ROOT_NODE_NAME)
			tplParseBlock('rm1', array(
				'ID' => $node_id,
				'NAME' => $node1->info['name'],
				'MARGIN'=>str_repeat("&nbsp;",($node1->getLevel()-1)*6)
			));

	    	tplParseBlock('offer',array(
				'ITAB'=> '1',
				'VISIBLE' => "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
    	$offer_id=getInt('id');
        $offer= new cOffer($offer_id);
		$offer->info["name"]=getVar("name");
		$offer->info["name_en"]=getVar("name_en");
		$offer->info["name_ua"]=getVar("name_ua");
		$offer->info["subs"]=getVar("subs");
		$offer->info["visible"]=getBool("visible");
		if (!$offer_id) $offer->buildIncOrdernum();
		$offer->save();

		if ($offer_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=offers&action=edit&id=".$offer->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=offers");
    }
	
    function vis()
    {
    	$offer_id=getInt('id');
        $offer= new cOffer($offer_id);
		$offer->info["visible"] = "1";
		$offer->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$offer_id=getInt('id');
        $offer= new cOffer($offer_id);
		$offer->info["visible"] = "0";
		$offer->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$offer_id=getInt('id');
    	$offer=new cOffer($offer_id);
    	$offer->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$offer_id=getInt('id');
        $offer= new cOffer($offer_id);
		$offer->info[$_GET["el"]] = '';
		$offer->save();
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
					up($_GET["id"],TABLE_OFFERS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_OFFERS,"","");
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