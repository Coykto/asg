<?
class cModDoctors
{
	function Init()
	{
		tplLoadTemplateFile('doctors.tpl');
	}

	function show()
	{
		$doctor_list = new cDoctorList();
		$list = $doctor_list->getList();
		foreach ($list as $doctor_id => $doctor)
		{
			if ($doctor->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $doctor_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $doctor_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $doctor_id,
				'NAME' => $doctor->info['name']
			));
		}
		tplParseBlock('listing');
	}

    function showForm()
    {
		GLOBAL $mysqli;

		$doctor_id=getInt('id');
        if ($doctor_id)
        {
			$doctor = new cDoctor($doctor_id);
			$doctor->loadAll();
	    	tplParseBlock('doctor_edit');

			$i=0;
			$res1 = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$doctor_id."' AND tt='doctors' ORDER BY ordernum");
			$count = $res1->num_rows;
			while ($row1 = $res1->fetch_array())
			{
				$i++;
				if ($i>1) tplParseBlock('gf_up', array(
					'IID' => $row1["id"],
					'ID' => $doctor_id,
				));
				if ($i<$count) tplParseBlock('gf_down', array(
					'IID' => $row1["id"],
					'ID' => $doctor_id,
				));
				if ($row1['visible']=='1') tplParseBlock('gf_visible', array(
					'IID' => $row1["id"],
					'ID' => $doctor_id,
				));
				else tplParseBlock('gf_nvisible', array(
					'IID' => $row1["id"],
					'ID' => $doctor_id,
				));
				tplParseBlock('showfoto',array(
					'IID' => $row1["id"],
					'ID' => $doctor_id,
					'SIMG' => $row1["simg"],
					'IMG' => $row1["img"]
				));
			}

	    	tplParseBlock('doctor', array(
	    		'ID' => $doctor_id,
	    		'NAME' => _htmlspecialchars($doctor->info['name']),
				'NAME_EN' => _htmlspecialchars($doctor->info['name_en']),
				'NAME_UA' => _htmlspecialchars($doctor->info['name_ua']),
				'TEXT' => _htmlspecialchars($doctor->info['text']),
				'TEXT_EN' => _htmlspecialchars($doctor->info['text_en']),
				'TEXT_UA' => _htmlspecialchars($doctor->info['text_ua']),
				'TEXTSMALL' => _htmlspecialchars($doctor->info['textsmall']),
				'TEXTSMALL_EN' => _htmlspecialchars($doctor->info['textsmall_en']),
				'TEXTSMALL_UA' => _htmlspecialchars($doctor->info['textsmall_ua']),
				'VISIBLE' => ($doctor->info['visible'] == "1") ? "checked" : "",
				'CPU' => $doctor->info['cpu'],
	    		'TITLE' => _htmlspecialchars($doctor->info['title']),
	    		'DESCRIPTION' => _htmlspecialchars($doctor->info['description']),
	    		'KEYWORDS' => _htmlspecialchars($doctor->info['keywords']),
	    		'TITLE_EN' => _htmlspecialchars($doctor->info['title_en']),
	    		'DESCRIPTION_EN' => _htmlspecialchars($doctor->info['description_en']),
	    		'KEYWORDS_EN' => _htmlspecialchars($doctor->info['keywords_en']),
	    		'TITLE_UA' => _htmlspecialchars($doctor->info['title_ua']),
	    		'DESCRIPTION_UA' => _htmlspecialchars($doctor->info['description_ua']),
	    		'KEYWORDS_UA' => _htmlspecialchars($doctor->info['keywords_ua']),
				'YEARS' => _htmlspecialchars($doctor->info['years']),
				'YEARS_EN' => _htmlspecialchars($doctor->info['years_en']),
				'YEARS_UA' => _htmlspecialchars($doctor->info['years_ua']),
				'CAT' => _htmlspecialchars($doctor->info['cat']),
				'CAT_EN' => _htmlspecialchars($doctor->info['cat_en']),
				'CAT_UA' => _htmlspecialchars($doctor->info['cat_ua']),
				'PRICE' => _htmlspecialchars($doctor->info['price']),
				'UNITS'=>printSelect('units[]', "SELECT id, name FROM ".TABLE_CLINICS." ORDER BY ordernum", ($doctor->info['units']!='') ? explode(',',$doctor->info['units']) : array(),'',' size="5" multiple class="form-control"'),
				'SPECS'=>printSelect('specs[]', "SELECT id, name FROM ".TABLE_SPECIALIZATIONS." ORDER BY name", ($doctor->info['specs']!='') ? explode(',',$doctor->info['specs']) : array(),'',' size="5" multiple class="form-control"'),
				'VIDEOS'=>printSelect('videos[]', "SELECT id, name FROM ".TABLE_VIDEOS." ORDER BY ordernum", ($doctor->info['videos']!='') ? explode(',',$doctor->info['videos']) : array(),'',' size="5" multiple class="form-control"'),
				'IMG' => ($doctor->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/doctors/'.$doctor->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=delimg&el=img&id='.$doctor_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
			tplParseBlock('doctor_new');
	    	tplParseBlock('doctor',array(
				'ITAB'=> '1',
				'VISIBLE' => "checked",
				'UNITS'=>printSelect('units[]', "SELECT id, name FROM ".TABLE_CLINICS." ORDER BY ordernum", array(),'',' size="5" multiple class="form-control"'),
				'SPECS'=>printSelect('specs[]', "SELECT id, name FROM ".TABLE_SPECIALIZATIONS." ORDER BY name", array(),'',' size="5" multiple class="form-control"'),
				'VIDEOS'=>printSelect('videos[]', "SELECT id, name FROM ".TABLE_VIDEOS." ORDER BY ordernum", array(),'',' size="5" multiple class="form-control"'),
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/doctors/");
		
    	$doctor_id=getInt('id');
        $doctor= new cDoctor($doctor_id);
		$doctor->info["name"]=getVar("name");
		$doctor->info["name_en"]=getVar("name_en");
		$doctor->info["name_ua"]=getVar("name_ua");
		$doctor->info["text"]=getVar("text");
		$doctor->info["text_en"]=getVar("text_en");
		$doctor->info["text_ua"]=getVar("text_ua");
		$doctor->info["textsmall"]=getVar("textsmall");
		$doctor->info["textsmall_en"]=getVar("textsmall_en");
		$doctor->info["textsmall_ua"]=getVar("textsmall_ua");
		$doctor->info["visible"]=getBool("visible");
		$doctor->info["title"]=getVar("title");
		$doctor->info["description"]=getVar("description");
		$doctor->info["keywords"]=getVar("keywords");
		$doctor->info["title_en"]=getVar("title_en");
		$doctor->info["description_en"]=getVar("description_en");
		$doctor->info["keywords_en"]=getVar("keywords_en");
		$doctor->info["title_ua"]=getVar("title_ua");
		$doctor->info["description_ua"]=getVar("description_ua");
		$doctor->info["keywords_ua"]=getVar("keywords_ua");
		$doctor->info["price"]=getVar("price");
		$doctor->info["cat_ua"]=getVar("cat_ua");
		$doctor->info["cat_en"]=getVar("cat_en");
		$doctor->info["cat"]=getVar("cat");
		$doctor->info["years_ua"]=getVar("years_ua");
		$doctor->info["years_en"]=getVar("years_en");
		$doctor->info["years"]=getVar("years");
		$doctor->info["education_ua"]=getVar("education_ua");
		$doctor->info["education_en"]=getVar("education_en");
		$doctor->info["education"]=getVar("education");
		$doctor->info["specs"] = ( (isset($_POST['specs'])) && (is_array($_POST['specs'])) ) ? implode(',',$_POST['specs']) : '';
		$doctor->info["units"] = ( (isset($_POST['units'])) && (is_array($_POST['units'])) ) ? implode(',',$_POST['units']) : '';
		$doctor->info["videos"] = ( (isset($_POST['videos'])) && (is_array($_POST['videos'])) ) ? implode(',',$_POST['videos']) : '';
		$doctor->info["cpu"]=getVar("cpu");
		if ($img) $doctor->info["img"]=$img;
		if (!$doctor_id) $doctor->buildIncOrdernum();
		if ( ($doctor->info["cpu"] == '') || (!preg_match("/^[-_a-zA-Z0-9]+$/", $doctor->info["cpu"])) ) $doctor->info["cpu"] = makecpu($doctor->info["name"]);
		$doctor->save();

		$res = $mysqli->query("SELECT * FROM ".TABLE_DOCTORS." WHERE cpu='".$doctor->info["cpu"]."' AND id<>".$doctor->id." ");
		$row = $res->num_rows;
		if ($row>0) $res = $mysqli->query("UPDATE ".TABLE_DOCTORS." SET cpu='".$doctor->id."' WHERE id=".$doctor->id);

		$fimg = getVar('fimg');
		$fimg1 = getVar('fimg1');
		if ($fimg!='')
		{
			$fimg = explode(",",$fimg);
			$fimg1 = explode(",",$fimg1);
			for ($i=0;$i<sizeof($fimg);$i++)
			{
				$res = $mysqli->query("INSERT INTO ".TABLE_GFOTOS." (tt,gid,img,simg,visible) VALUES ('doctors','".$doctor->id."','".$fimg[$i]."','".( (isset($fimg1[$i])) ? $fimg1[$i] : '' )."','1') ");
				$idd = $mysqli->insert_id;
				$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET ordernum='".$idd."' WHERE id='".$idd."' ");
			}
		}

		if ($doctor_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=edit&id=".$doctor->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=doctors");
    }
	
    function vis()
    {
    	$doctor_id=getInt('id');
        $doctor= new cDoctor($doctor_id);
		$doctor->info["visible"] = "1";
		$doctor->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$doctor_id=getInt('id');
        $doctor= new cDoctor($doctor_id);
		$doctor->info["visible"] = "0";
		$doctor->save();

		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$doctor_id=getInt('id');
    	$doctor=new cDoctor($doctor_id);
    	$doctor->del();

    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$doctor_id=getInt('id');
        $doctor= new cDoctor($doctor_id);
		$doctor->info[$_GET["el"]] = '';
		$doctor->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }
	
    function Run()
    {
		GLOBAL $mysqli;
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
					up($_GET["id"],TABLE_DOCTORS,"","");
					print $_SERVER['HTTP_REFERER'];exit;
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_DOCTORS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":
					if ( (isset($_POST["name"])) && ($_POST["name"]!='') ) $this->submit();
				break;
				
				case "moveupf":
					up($_GET["iid"],TABLE_GFOTOS,"gid",$_GET["id"],"tt","doctors");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=edit&id=".$_GET["id"]);
				break;
				case "movedownf":
					down($_GET["iid"],TABLE_GFOTOS,"gid",$_GET["id"],"tt","doctors");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=edit&id=".$_GET["id"]);
				break;
				case "visiblef":
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET visible='1' WHERE id='".$_GET["iid"]."' ");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=edit&id=".$_GET["id"]);
				break;
				case "nvisiblef":
					$res = $mysqli->query("UPDATE ".TABLE_GFOTOS." SET visible='0' WHERE id='".$_GET["iid"]."' ");
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=edit&id=".$_GET["id"]);
				break;
				case "delf":
					$res = $mysqli->query("DELETE FROM ".TABLE_GFOTOS." WHERE id='".$_GET["iid"]."' ");
					if (file_exists($_SERVER["DOCUMENT_ROOT"].'/templates/images/doctors/'.$_GET["img"])) unlink($_SERVER["DOCUMENT_ROOT"].'/templates/images/doctors/'.$_GET["img"]);
					if (file_exists($_SERVER["DOCUMENT_ROOT"].'/templates/images/doctors/'.$_GET["simg"])) unlink($_SERVER["DOCUMENT_ROOT"].'/templates/images/doctors/'.$_GET["simg"]);					
					header("Location: /mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=edit&id=".$_GET["id"]);
				break;
        	}
		}
		else $this->show();
    }
}
?>