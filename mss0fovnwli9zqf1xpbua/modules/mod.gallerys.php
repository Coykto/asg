<?
class cModGallerys
{
	function Init()
	{
		tplLoadTemplateFile('gallerys.tpl');
	}
	
	function show()
	{
		GLOBAL $mysqli;
		
		$i=0;
		$res1 = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE tt='gal1' ORDER BY ordernum DESC");
		$count = $res1->num_rows;
		while ($row1 = $res1->fetch_array())
		{
			$i++;
			if ($i>1) tplParseBlock('gf_up', array(
				'ID' => $row1["id"]
			));
			if ($i<$count) tplParseBlock('gf_down', array(
				'ID' => $row1["id"]
			));
			if ($row1['visible']=='1') tplParseBlock('gf_visible', array(
				'ID' => $row1["id"]
			));
			else tplParseBlock('gf_nvisible', array(
				'ID' => $row1["id"]
			));
			tplParseBlock('showfoto',array(
				'ID' => $row1["id"],
				'SIMG' => $row1["simg"],
				'IMG' => $row1["img"],
				'NAME' => _htmlspecialchars($row1["name"]),
				'HAR' => _htmlspecialchars($row1["har"]),
				'IMG' => $row1["img"]
			));
		}
	}

    function showForm()
    {
		GLOBAL $mysqli;

		$gallery_id=getInt('id');
        if ($gallery_id)
        {
	    	tplParseBlock('gallery_edit');

			$res = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE id='".$gallery_id."' ");
			$row = $res->fetch_array();
	    	if ($row['id']>0) tplParseBlock('gallery', array(
	    		'ID' => $gallery_id,
				'NAME' => $row['name'],
				'HAR' => $row['har'],
				'SIMG' => $row["simg"],
				'HOST' => HOST
    		));
        }
    }
	
	function update()
	{
		GLOBAL $mysqli;

		$tags = array();
		$res = $mysqli->query("SELECT name FROM `gfotos` WHERE name<>'' AND tt='gal1'");
		while ($row = $res->fetch_array())
		$tags[] = $row['name'];
	
		$tags = implode(',',$tags);
		$tags = explode(",",str_replace(', ',',',$tags));
		$tags = array_count_values($tags);

		$res = $mysqli->query("DELETE FROM tags");
		foreach ($tags AS $key => $val)
		$res = $mysqli->query("INSERT INTO tags (name, cou) VALUES ('".$key."','".$val."') ");
	}

    function submit()
    {
		GLOBAL $mysqli;

		$gallery_id = getInt("id");
		if ($gallery_id<1)
		{
			$targetPath = $_SERVER['DOCUMENT_ROOT'].'/templates/images/tree/';		
			$i = 0;
			while (isset($_FILES["files1"]["tmp_name"][$i]))
			{
				$img = uploadi($_FILES["files1"]["tmp_name"][$i],$_FILES["files1"]["name"][$i],$targetPath);
				if ($img)
				{
					list($width, $height) = getimagesize($targetPath.$img);
					if ( ($width/$height) < (682/682) ) resizew($img,$targetPath,682,"s_");
					else resizeh($img,$targetPath,682,"s_");
					crop($targetPath."s_".$img,$targetPath."s_".$img,array(0,0,682,682));
					
					$res = $mysqli->query("INSERT INTO ".TABLE_GFOTOS." (gid,simg,img,visible,tt) VALUES (0,'s_".$img."','".$img."','1','gal1') ");
					$idd = $mysqli->insert_id;
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET ordernum='".$idd."' WHERE id='".$idd."' ");
				}
				$i++;
			}
		}
		else
		{
			$simg = uploadi($_FILES["simg"]["tmp_name"],$_FILES["simg"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/tree/");
			$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET name='".getVar('name')."', har='".getVar('har')."'".( ($simg!='') ? ",simg='".$simg."'" : "" )." WHERE id='".$gallery_id."' ");
			$this->update();
		}

		if ($gallery_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=edit&id=".$gallery_id);
		else header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=gallerys");
    }

    function Run()
    {
		GLOBAL $mysqli;
		if (isset($_REQUEST['action']))
		{
        	switch ($_REQUEST['action'])
        	{
	            case "edit":$this->showForm();break;
        	    case "new":$this->showForm();break;
	            case "delete":$this->del();break;
				case "visible":$this->vis();break;
				case "nvisible":$this->nvis();break;
        	    case "submit":$this->submit();break;
				
				case "moveupf":
					down($_GET["id"],TABLE_GFOTOS,"tt","gal1");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=gallerys");
				break;
				case "movedownf":
					up($_GET["id"],TABLE_GFOTOS,"tt","gal1");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=gallerys");
				break;
				case "visiblef":
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET visible='1' WHERE id='".$_GET["id"]."' ");
					$this->update();
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=gallerys");
				break;
				case "nvisiblef":
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET visible='0' WHERE id='".$_GET["id"]."' ");
					$this->update();
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=gallerys");
				break;
				case "delf":
					$res = $mysqli->query("DELETE FROM ".TABLE_GFOTOS." WHERE id='".$_GET["id"]."' ");
					if (file_exists($_SERVER["DOCUMENT_ROOT"].'/templates/images/tree/'.$_GET["img"])) unlink($_SERVER["DOCUMENT_ROOT"].'/templates/images/tree/'.$_GET["img"]);
					if (file_exists($_SERVER["DOCUMENT_ROOT"].'/templates/images/tree/'.$_GET["simg"])) unlink($_SERVER["DOCUMENT_ROOT"].'/templates/images/tree/'.$_GET["simg"]);
					$this->update();
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=gallerys");
				break;
        	}
		}
		else $this->show();
    }
}
?>