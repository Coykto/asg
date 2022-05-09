<?
	$tree=new cOrderedTree();
	$tree->setFilter(array(
		FILTER_VISIBLE => 1
	));
	$tree->load();
	
	if (isset($_GET["page"])) 
	{
		$page = $_GET["page"];
		if ($page == "default")
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE ptid=2");
			$row = $res->fetch_array();
		}
	}
	else if (isset($_GET["cpu"]))
	{
		$cpuarr = explode("/",$_GET["cpu"]);
		if ($cpuarr[sizeof($cpuarr)-1]=="") unset($cpuarr[sizeof($cpuarr)-1]);	

		$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE cpu='".$cpuarr[0]."' AND visible='1' AND parent_id=0 ");
		$row = $res->fetch_array();
	}
	else
	{
		$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE ptid=2");
		$row = $res->fetch_array();
	}

	if ( (isset($row)) && ($row["id"]>0) )
	{
		$mainname = $tree->getNode($row["id"]);
		if (isset($cpuarr[1]))
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_TREE." WHERE cpu='".$cpuarr[1]."' AND visible='1' AND parent_id='".$mainname->info["id"]."' ");
			$row = $res->fetch_array();
			if ($row["id"]>0) $mainname = $tree->getNode($row["id"]);
		}

		switch ($mainname->info["ptid"])
		{
			case 1:
				$page = "section";
				if ($mainname->getLevel()!=sizeof($cpuarr)) $page = "error404";
			break;

			case 2:
				$page = "default";
			break;

			case 3:
				$page = "department";
				if ($mainname->getLevel()!=sizeof($cpuarr)) $page = "error404";
			break;
			
			case 4:
				$page = "article";
				if ( (isset($cpuarr[2])) && ($cpuarr[1]!='tag') ) $page = "error404";
				else if ( (isset($cpuarr[1])) && ($cpuarr[1]!='tag') )
				{
					$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE cpu='".$cpuarr[1]."' AND visible='1' ");
					$data = $res->fetch_array();
					if ($data["id"]<1) $page = "error404";
				}
			break;

			case 5:
				$page = "release";
				if ($mainname->getLevel()!=sizeof($cpuarr)) $page = "error404";
			break;

			case 6:
				$page = "service";
				if ($mainname->getLevel()!=sizeof($cpuarr)) $page = "error404";
			break;
			
			case 7:
				$page = "partner";
				if (isset($cpuarr[2])) $page = "error404";
			break;

			case 8:
				$page = "hot";
				if ($mainname->getLevel()!=sizeof($cpuarr)) $page = "error404";
			break;

			case 9:
				$page = "search";
				if ($mainname->getLevel()!=sizeof($cpuarr)) $page = "error404";
			break;

			case 20:
				$page = "sitemap";
				if ($mainname->getLevel()!=sizeof($cpuarr)) $page = "error404";
			break;
		}
	}
	
	if (!isset($page)) $page = "error404";
?>