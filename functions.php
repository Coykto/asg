<?php

	function doSQL($sql,$line,$file)
	{
		GLOBAL $mysqli;
		if (SQL_TEST)
		{
			$res = $mysqli->query($sql) or die ("<br>Error! Line <i>$line</i>, file <i>$file</i>.<br><b>".$mysqli->error."<b><br>$sql<br>");
		}
		else
		{
			$res = $mysqli->query($sql) or die ("<br>Error! Try later...");
		}
		return $res;
	}

	function tplLoadTemplateFile($fName, $parentBlock = '')
	{
		$GLOBALS['tpl']->loadTemplateFile($fName, $parentBlock);
	}

	function tplParseBlock($blockName, $vars = array())
	{
		$GLOBALS['tpl']->parseBlock($blockName, $vars);
	}
	
	function addblock($name, $arr = array())
	{
		GLOBAL $tree, $mysqli;
		tplLoadTemplateFile($name.'.tpl');
		
		switch ($name)
		{
			case "block4":
				$res = $mysqli->query("SELECT * FROM ".TABLE_SPECIALIZATIONS." WHERE visible='1' ORDER BY ordernum");
				while ($row = $res->fetch_array())
				tplParseBlock('block4_item', array(
					'NAME' => $row['name'],
					'IMG' => $row['img'],
					'TEXT' => $row['text'],
				));
			break;

			case "block9":
				$node = gf("1",TABLE_TREE,"id","menu1");
				$nodes = $tree->getNode($node);
				foreach ($nodes->children AS $node)
				{
					if ($node->info['price']!='') tplParseBlock('block9_item_price', array(
						'PRICE' => $node->info['price']
					));
					tplParseBlock('block9_item', array(
						'NAME' => $node->info['name'],
						'IMG' => $node->info['img'],
						'LINK' => HOST.$tree->getCpu($node).'/'
					));
				}
			break;
			
			case "block11":
				$res = $mysqli->query("SELECT * FROM ".TABLE_REVIEWS." WHERE visible='1' ORDER BY id");
				while ($row = $res->fetch_array())
				{
					if ($row['img']!='') tplParseBlock('block11_item_img', array(
						'IMG' => $row['img']
					));
					else if ($row['social']!='') tplParseBlock('block11_item_video', array(
						'VIDEO' => $row['social']
					));
					tplParseBlock('block11_item', array(
						'NAME' => $row['name'],
						'TEXT' => $row['text'],
					));
				}
			break;

			case "block12":
				$node = gf(6,TABLE_TREE,"id","ptid");
				$node = $tree->getNode($node);
				$cpu1 = $tree->getCpu($node);
				$res = $mysqli->query("SELECT * FROM ".TABLE_STOCKS." WHERE visible='1' ORDER BY date DESC");
				while ($row = $res->fetch_array())
				tplParseBlock('block12_item', array(
					'NAME' => $row['name'],
					'IMG' => $row['img1'],
					'CPU1' => $cpu1,
					'CPU2' => $row['cpu'],
					'HOST' => HOST
				));
			break;

			case "block13":
				$res = $mysqli->query("SELECT * FROM ".TABLE_MAINTEXTS." WHERE visible='1' ORDER BY ordernum");
				while ($row = $res->fetch_array())
				{
					if ($row['img']!='') tplParseBlock('block13_item_img', array(
						'IMG' => $row['img']
					));
					if ($row['img1']!='') tplParseBlock('block13_item_img1', array(
						'NAME' => $row['name'],
						'IMG1' => $row['img1']
					));
					else tplParseBlock('block13_item_img11');
					tplParseBlock('block13_item', array(
						'NAME' => $row['name'],
						'IMG' => $row['img'],
						'IMG1' => $row['img1'],
						'LINK' => $row['link'],
						'PRICE' => $row['price']
					));
				}
			break;

			case "block16":
				$res = $mysqli->query("SELECT * FROM ".TABLE_SLIDERS." WHERE visible='1' AND main='1' ORDER BY ordernum");
				$cou = $res->num_rows;
				while ($row = $res->fetch_array())
				tplParseBlock('block16_item',array(
					'IMG' => $row["img"],
					'NAME' => $row["name"],
					'PRICE' => $row["price"],
					'TEXT' => $row["text"]
				));
				if ($cou>0) tplParseBlock('block16',array(
					'CPU' => LAMPCPU,
					'BLOCK16' => get_set('block16'),
					'HOST' => HOST
				));
			break;
			
			case "block17":
				$cname = array();
				$res = $mysqli->query("SELECT * FROM daily_cats ORDER BY id");
				while ($row = $res->fetch_array())
				$cname[$row['id']] = $row['name'];

				$res = $mysqli->query("SELECT * FROM ".TABLE_DAILYS." WHERE visible='1' AND main='1' ORDER BY date DESC");
				$cou = $res->num_rows;
				while ($row = $res->fetch_array())
				{
					$cat = explode(',',$row['cid']);
					$tags = array();
					foreach ($cat AS $val)
					if ($val!='') $tags[] = '#'.$cname[$val];

					tplParseBlock('block17_item',array(
						'IMG' => $row["img"],
						'NAME' => $row["name"],
						'CPU1' => PROJECTCPU,
						'CPU2' => $row["cpu"],
						'TAGS' => implode(' ',$tags),
						'VIEWS' => $row["views"],
						'LIKES' => $row["likes"],
						'ID' => $row["id"],
						'HOST' => HOST
					));
				}

				if ($cou>0) tplParseBlock('block17',array(
					'CPU' => PROJECTCPU,
					'BLOCK17' => get_set('block17'),
					'HOST' => HOST
				));
			break;

			case "block18":
				$res = $mysqli->query("SELECT * FROM ".TABLE_VIDEOS." WHERE visible='1' AND main='1' ORDER BY ordernum");
				$cou = $res->num_rows;
				while ($row = $res->fetch_array())
				{
					$i = 0;
					$res1 = $mysqli->query("SELECT * FROM ".TABLE_GFOTOS." WHERE gid='".$row['id']."' AND tt='video' AND visible='1' ORDER BY ordernum DESC LIMIT 0,3");
					while ($row1 = $res1->fetch_array())
					{
						$i++;
						if ($i>1) tplParseBlock('block18_item_gal_item_s');
						tplParseBlock('block18_item_gal_item',array(
							'IMG' => $row1["img"],
							'SIMG' => $row1["simg"]
						));
					}

					if ($row['email']!='') tplParseBlock('block18_item_email', array(
						'EMAIL' => $row['email']
					));
					if ($row['phone']!='') tplParseBlock('block18_item_phone', array(
						'PHONE' => $row['phone']
					));
					if ($row['soc1']!='') tplParseBlock('block18_item_soc1', array(
						'SOC1' => $row['soc1']
					));
					if ($row['soc2']!='') tplParseBlock('block18_item_soc2', array(
						'SOC2' => $row['soc2']
					));
					if ($row['soc3']!='') tplParseBlock('block18_item_soc3', array(
						'SOC3' => $row['soc3']
					));
					if ($row['soc4']!='') tplParseBlock('block18_item_soc4', array(
						'SOC4' => $row['soc4']
					));

					tplParseBlock('block18_item', array(
						'TEXT' => $row['text'],
						'NAME' => $row['name'],
						'IMG' => $row['img'],
					));
				}

				if ($cou>0) tplParseBlock('block18',array(
					'CPU' => DESIGNCPU,
					'BLOCK18' => get_set('block18'),
					'HOST' => HOST
				));
			break;

			case "block19":
				$cname = array();
				$res = $mysqli->query("SELECT * FROM article_cats ORDER BY id");
				while ($row = $res->fetch_array())
				$cname[$row['id']] = $row['name'];

				$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE visible='1' AND main='1' ORDER BY date DESC");
				$cou = $res->num_rows;
				while ($row = $res->fetch_array())
				{
					$cat = explode(',',$row['cid']);
					$tags = array();
					foreach ($cat AS $val)
					if ($val!='') $tags[] = '#'.$cname[$val];

					tplParseBlock('block19_item',array(
						'IMG' => $row["img"],
						'NAME' => $row["name"],
						'CPU1' => ARTICLECPU,
						'CPU2' => $row["cpu"],
						'TAGS' => implode(' ',$tags),
						'VIEWS' => $row["views"],
						'LIKES' => $row["likes"],
						'ID' => $row["id"],
						'HOST' => HOST
					));
				}

				if ($cou>0) tplParseBlock('block19',array(
					'CPU' => ARTICLECPU,
					'BLOCK19' => get_set('block19'),
					'HOST' => HOST
				));
			break;
		}
		
		if (!in_array($name,array('block16','block17','block18','block19'))) tplParseBlock($name,$arr);
	}

	function getVar($name, $default='')
    {
	   	if (!isset($_REQUEST[$name])) return $default;
	    if (get_magic_quotes_gpc())
           	return $_REQUEST[$name];
        return addslashes($_REQUEST[$name]);
	}

	function getInt($var,$default=0)
	{
		if (isset($_REQUEST[$var])) return intval($_REQUEST[$var]);   
		else return $default;
	}

	function getBool($var,$default=0)
	{
		if (!isset($_REQUEST[$var])) return $default;
		return 1;
	}

	// определение width и height картинки с учётом dimension
	function getWHarray($imgname,$dimension)
	{
		$imgsize=getimagesize($imgname);

		$original_w=$imgsize[0];
		$original_h=$imgsize[1];

		$scale_w=$original_w/$dimension;
		$scale_h=$original_h/$dimension;
		$scale=($scale_w>$scale_h?$scale_w:$scale_h);

		$new_w = $scale>1?($original_w/$scale):$original_w;
		$new_h = $scale>1?($original_h/$scale):$original_h;
		return array($new_w,$new_h);
	}

	// Склонение слов
	function declension($val, $word_1, $word_2, $word_3)
	{
		if ($val > 20 AND $val <= 100) $div_val = $val % 10;
		elseif ($val > 100 AND $val <= 1000) 
			{ $div_val = $val % 100; $div_val = $div_val % 10; }
		elseif ($val > 1000 AND $val <= 10000000) 
			{ $div_val = $val % 1000; $div_val = $div_val % 100; $div_val = $div_val % 10; }
		else $div_val = $val;

		if ($div_val == 1) return ' '.$word_1;
		elseif ($div_val > 1 AND $div_val <= 4) return ' '.$word_2;
		elseif (($div_val > 4 AND $div_val <= 20) OR $div_val == 0) return ' '.$word_3;
	}

	// Определение текущей группы юзера
	function getCurrentUserGroup()
	{
		if ($_SESSION['auth']) return $_SESSION['group'];
		return 'guest';
	}

	// Определение ip-адреса
	function getip()
	{
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
			$ip = getenv("HTTP_CLIENT_IP");
		elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			$ip = getenv("REMOTE_ADDR");
		elseif (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
			$ip = $_SERVER['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return($ip);
	}

	function getmicrotime()
	{ 
		list($usec, $sec) = explode(" ",microtime()); 
		return ((float)$usec + (float)$sec); 
	}

	$size_postfix_names = array('байт','Кб','Мб','Гб','Тб');
	function getSize($size=0, $postfix_id=0)
	{
		if ($size < 1024)
			return $size.' '.$GLOBALS['size_postfix_names'][$postfix_id];
		$postfix_id++;
		return getSize(round($size/1024), $postfix_id);
	}

	function redir($url='')
	{
		if (empty($url))
			$url = $_SERVER['HTTP_REFERER'];
		header('Location: '.$url);
		print "<script>location.href='".$url."'</script>";
		exit;
	}

	function load_sets()
	{
		$set_list = new cSettingList();
		$list = $set_list->getList();
		foreach ($list as $set_id=>$set)
		$GLOBALS['settings'][$set->info['set']] = $set->info['value'];
	}

	function get_set($name)
	{
		return $GLOBALS['settings'][$name];
	}

	//экранирование данных объектов
	function screening(&$obj)
	{
		if (isset($obj->info) and is_array($obj->info))
		{
			foreach ($obj->info as $name=>$val)
			$obj->info[$name]=addslashes($val);
		}
	}

	function printSelect( $name, $SqlQuery, $selected_id, $print="", $printin="" ) {
		GLOBAL $mysqli;
		$Recordset = $mysqli->query($SqlQuery) or die("MySQL ERROR: Query [$SqlQuery] failed");
		$print = "<select name='$name' ".$printin.">".$print;
		if (!is_array($selected_id)) $selected_id = array($selected_id);
		while ($row = $Recordset->fetch_array())
		if (in_array($row[0],$selected_id)) $print .= "<option value=".$row[0]." selected>".$row[1]."</option>";
		else $print .= "<option value=".$row[0].">".$row[1]."</option>";
		$print .= "</select>";
		return $print;
	}
	
	function printCheckbox( $name, $SqlQuery, $selected_id, $print="" ) {
		GLOBAL $mysqli;
		$Recordset = $mysqli->query($SqlQuery) or die("MySQL ERROR: Query [$SqlQuery] failed");
		while ($row = $Recordset->fetch_array())
		$print .= "<input type=\"checkbox\" name=\"".$name."[".$row[0]."]\" ".( (in_array($row[0],$selected_id)) ? "checked" : "" ).">".$row[1]."<br>";
		return $print;
	}
	
	function gf($id, $tbl, $field, $id_name) 
	{
		GLOBAL $mysqli;
		$retValue = "";
		$SqlWhere = ( (strlen(trim($id)) == 0) ? "" : " WHERE `".$id_name."`='$id' " );
		$SqlQuery = "SELECT `$field` FROM $tbl $SqlWhere LIMIT 1";
		$Recordset = $mysqli->query($SqlQuery);
		while ($row = $Recordset->fetch_array())
		$retValue = $row[$field];
		return $retValue;
	}

function resizew($filename, $upload_dir, $maxsize,$pre) 
{ 
    $file_ext1 = substr($filename,0,strrpos($filename,"."));
    $file_ext = strtolower(substr($filename,strrpos($filename,".")+1,strlen($filename)-strrpos($filename,".")-1));
    $source=$upload_dir.$filename; 

    list($width, $height) = getimagesize($source);
    $hi = $width;

    if ($width>$maxsize)
    {
	    $percent1 = $maxsize/$hi;
	    $d_w=$width*$percent1; 
	    $d_h=$height*$percent1;
    }
    else 
    {
	    $d_w=$width; 
	    $d_h=$height;
    }

    $ratio = $d_w/$d_h; 
    $dest_img = imagecreatetruecolor($d_w, $d_h);      
    imagefill($dest_img, 0, 0, 0xFFFFFF);    
    $size_img = getimagesize($upload_dir.$filename); 
    $src_ratio=$size_img[0]/$size_img[1]; 

    if ($src_ratio>$ratio) 
    { 
        $old_h=$size_img[1]; 
        $size_img[1]=floor($size_img[0]/$ratio); 
        $old_h=floor($old_h*$d_h/$size_img[1]); 
    } 
    else 
    { 
        $old_w=$size_img[0]; 
        $size_img[0]=floor($size_img[1]*$ratio);      
        $old_w=floor($old_w*$d_w/$size_img[0]); 
    } 
      
    switch ($size_img['mime']) 
    { 
        case 'image/jpeg': 
            $src_img = imagecreatefromjpeg($upload_dir.$filename);              
            $ext="jpg";              
            $ext1="jpeg";              
            break;          
        case 'image/gif':      
            $src_img = imagecreatefromgif($upload_dir.$filename);              
            $ext="gif";              
            break;          
        case 'image/png':
            $src_img = imagecreatefrompng($upload_dir.$filename);              
            $ext="png";              
            break;          
    } 
    imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $d_w, $d_h, $size_img[0], $size_img[1]);          
      
    switch ($size_img['mime']) 
    { 
        case 'image/jpeg': 
            if ($file_ext=="jpg") imagejpeg($dest_img, $upload_dir.$pre.$file_ext1.".".$ext,80);
            if ($file_ext=="jpeg") imagejpeg($dest_img, $upload_dir.$pre.$file_ext1.".".$ext1,80);              
        break; 

        case 'image/gif':      
       	    imagegif($dest_img, $upload_dir.$pre.$file_ext1.".".$ext);
        break;          

        case 'image/png':      
       	    imagepng($dest_img, $upload_dir.$pre.$file_ext1.".".$ext);
        break;          
    }          
    
    imagedestroy($dest_img); 
    imagedestroy($src_img);          
}

function resizeh($filename, $upload_dir, $maxsize,$pre) 
{ 
    $file_ext1 = substr($filename,0,strrpos($filename,"."));
    $file_ext = strtolower(substr($filename,strrpos($filename,".")+1,strlen($filename)-strrpos($filename,".")-1));
    $source=$upload_dir.$filename; 

    list($width, $height) = getimagesize($source);
    $hi = $height;

    if ($height>$maxsize)
    {
	    $percent1 = $maxsize/$hi;
	    $d_w=$width*$percent1; 
	    $d_h=$height*$percent1;
    }
    else 
    {
	    $d_w=$width; 
	    $d_h=$height;
    }

    $ratio = $d_w/$d_h; 
    $dest_img = imagecreatetruecolor($d_w, $d_h);      
    imagefill($dest_img, 0, 0, 0xFFFFFF);    
    $size_img = getimagesize($upload_dir.$filename); 
    $src_ratio=$size_img[0]/$size_img[1]; 

    if ($src_ratio>$ratio) 
    { 
        $old_h=$size_img[1]; 
        $size_img[1]=floor($size_img[0]/$ratio); 
        $old_h=floor($old_h*$d_h/$size_img[1]); 
    } 
    else 
    { 
        $old_w=$size_img[0]; 
        $size_img[0]=floor($size_img[1]*$ratio);      
        $old_w=floor($old_w*$d_w/$size_img[0]); 
    } 
      
    switch ($size_img['mime']) 
    { 
        case 'image/jpeg': 
            $src_img = imagecreatefromjpeg($upload_dir.$filename);              
            $ext="jpg";              
            $ext1="jpeg";              
            break;          
        case 'image/gif':      
            $src_img = imagecreatefromgif($upload_dir.$filename);              
            $ext="gif";              
            break;          
        case 'image/png':
            $src_img = imagecreatefrompng($upload_dir.$filename);              
            $ext="png";              
            break;          
    } 
    imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $d_w, $d_h, $size_img[0], $size_img[1]);          
      
    switch ($size_img['mime']) 
    { 
        case 'image/jpeg': 
            if ($file_ext=="jpg") imagejpeg($dest_img, $upload_dir.$pre.$file_ext1.".".$ext,80);
            if ($file_ext=="jpeg") imagejpeg($dest_img, $upload_dir.$pre.$file_ext1.".".$ext1,80);              
        break; 

        case 'image/gif':      
       	    imagegif($dest_img, $upload_dir.$pre.$file_ext1.".".$ext);
        break;          

        case 'image/png':      
       	    imagepng($dest_img, $upload_dir.$pre.$file_ext1.".".$ext);
        break;          
    }          
    
    imagedestroy($dest_img); 
    imagedestroy($src_img);          
}

function crop($file_input, $file_output, $crop = 'square',$percent = false) 
{
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo 'Невозможно получить длину и ширину изображения';
		return;
        }
        $types = array('','gif','jpeg','png');
        $ext = $types[$type];
        if ($ext) {
    	        $func = 'imagecreatefrom'.$ext;
    	        $img = $func($file_input);
        } else {
    	        echo 'Некорректный формат файла';
		return;
        }
	if ($crop == 'square') {
		$min = $w_i;
		if ($w_i > $h_i) $min = $h_i;
		$w_o = $h_o = $min;
	} else {
		list($x_o, $y_o, $w_o, $h_o) = $crop;
		if ($percent) {
			$w_o *= $w_i / 100;
			$h_o *= $h_i / 100;
			$x_o *= $w_i / 100;
			$y_o *= $h_i / 100;
		}
        if ($w_o < 0) $w_o += $w_i;
//	        $w_o -= $x_o;
	   	if ($h_o < 0) $h_o += $h_i;
//		$h_o -= $y_o;
	}
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagesavealpha($img_o, true);
	imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
//	print $x_o.'<br>';
//	print $y_o.'<br>';
//	print $w_o.'<br>';
//	print $h_o.'<br>';
//	die();
	imagecopy($img_o, $img, 0, 0, $x_o+( ($w_i>$h_i) ? round(($w_i-$h_i)/2) : 0 ), $y_o+( ($h_i>$w_i) ? round(($h_i-$w_i)/2) : 0 ), $w_o, $h_o);
	if ($type == 2) {
		return imagejpeg($img_o,$file_output,80);
	} else {
		$func = 'image'.$ext;
		return $func($img_o,$file_output);
	}
}

function upload($temp_name,$file_name,$upload_dir) 
{
	$filename = strtolower(md5($file_name.rand(10000,1000000000))."_".strtotime("now").".".substr($file_name,strrpos($file_name,".")+1,strlen($file_name)-strrpos($file_name,".")-1));
	$file_path = $upload_dir.$filename;
	$result  =  move_uploaded_file($temp_name, $file_path);
	if ($result) return $filename; else return "";
}

function uploadi($temp_name,$file_name,$upload_dir,$arr = array("gif","jpg","jpeg","png","doc","docx","xls","xlsx","pdf","txt","zip","rar"))
{
	if (in_array(strtolower(substr($file_name,strrpos($file_name,".")+1)),$arr))
	{
		$filename = strtolower(md5($file_name.rand(10000,1000000000))."_".strtotime("now").".".substr($file_name,strrpos($file_name,".")+1,strlen($file_name)-strrpos($file_name,".")-1));
		$file_path = $upload_dir.$filename;
		$result  =  move_uploaded_file($temp_name, $file_path);
		if ($result) return $filename; else return "";
	}
	else return "";
}

function is_email($email) {
 $email = trim($email);
 $r = ereg(
    '^([a-zA-Z0-9_]|\\-|\\.)+'.
    '@'.
    '(([a-zA-Z0-9_]|\\-)+\\.)+'.
    '[a-zA-Z]{2,4}$', $email);
 return $r;
}

function up($id, $table, $field_name, $field, $field_name1="", $field1="", $field_name2="", $field2="")
{
	GLOBAL $mysqli;
	$ordernum = gf($id,$table,"ordernum","id");
	$res = $mysqli->query("SELECT * FROM ".$table." WHERE ordernum<".$ordernum." ".( ($field_name!="") ? " AND ".$field_name."='".$field."' " : "" )." ".( ($field_name1!="") ? " AND ".$field_name1."='".$field1."' " : "" )." ".( ($field_name2!="") ? " AND ".$field_name2."='".$field2."' " : "" )." ORDER BY ordernum DESC LIMIT 0,1");
	$row = $res->fetch_array();
	$new_ord = $row["ordernum"];
	$res = $mysqli->query("UPDATE ".$table." SET ordernum=".$ordernum." WHERE id=".$row["id"]);
	$res = $mysqli->query("UPDATE ".$table." SET ordernum=".$new_ord." WHERE id=".$id);
}

function down($id, $table, $field_name, $field, $field_name1="", $field1="", $field_name2="", $field2="")
{
	GLOBAL $mysqli;
	$ordernum = gf($id,$table,"ordernum","id");
	$res = $mysqli->query("SELECT * FROM ".$table." WHERE ordernum>".$ordernum." ".( ($field_name!="") ? " AND ".$field_name."='".$field."' " : "" )." ".( ($field_name1!="") ? " AND ".$field_name1."='".$field1."' " : "" )." ".( ($field_name2!="") ? " AND ".$field_name2."='".$field2."' " : "" )." ORDER BY ordernum ASC LIMIT 0,1");
	$row = $res->fetch_array();
	$new_ord = $row["ordernum"];
	$res = $mysqli->query("UPDATE ".$table." SET ordernum=".$ordernum." WHERE id=".$row["id"]);
	$res = $mysqli->query("UPDATE ".$table." SET ordernum=".$new_ord." WHERE id=".$id);
}
	
function gennum($cnt = 8)
{
	$letters = '0 1 2 3 4 5 6 7 8 9';
	$letters = explode(' ', $letters);
	$letters_count = count($letters);
	$ret = "";

	for($i = 0; $i < $cnt; $i++)
	{
		$t = rand(0, $letters_count-1);
		$up = rand(0, 1);
		if($up === 1) $ret .= strtoupper($letters[$t]);
		else $ret .= strtolower($letters[$t]);
	}
	return $ret;
}

function dehtml($html) {
 if (is_array($html)) {
  foreach($html as $key => $value) {
   $value = trim($value);
   $value = StripSlashes($value);
   $value = ereg_replace("&quot;", "\"", $value);
   $value = ereg_replace("&amp;", "&", $value);
   $value = ereg_replace("&#039;", "'", $value);
   $value = ereg_replace("&lt;", "<", $value);
   $value = ereg_replace("&gt;", ">", $value);
   $r[$key] = htmlspecialchars($value, ENT_QUOTES);
  }
 } else {
  $html = StripSlashes($html);
  $html = ereg_replace("&quot;", "\"", $html);
  $html = ereg_replace("&amp;", "&", $html);
  $html = ereg_replace("&#039;", "'", $html);
  $html = ereg_replace("&lt;", "<", $html);
  $html = ereg_replace("&gt;", ">", $html);
  $r = htmlspecialchars($html, ENT_QUOTES);
 }
 return $r; 
}

function file_download($filename, $mimetype='application/octet-stream') {
  if (file_exists($filename)) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 200 OK');
    header('Content-Type: ' . $mimetype);
    header('Last-Modified: ' . gmdate('r', filemtime($filename)));
    header('ETag: ' . sprintf('%x-%x-%x', fileinode($filename), filesize($filename), filemtime($filename)));
    header('Content-Length: ' . (filesize($filename)));
    header('Connection: close');
	$fn = basename($filename);
	$fn = md5(substr($fn,0,strrpos($fn,"."))).substr($fn,strrpos($fn,"."));
    header('Content-Disposition: attachment; filename="' .$fn. '";');
    echo file_get_contents($filename);
  } else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    header('Status: 404 Not Found');
  }
  exit;
}

	function XMail( $from, $to, $subj, $text, $filename='1') 
	{
		$un        = strtoupper(uniqid(time())); 
		$head      = "From: $from\n"; 
		$head     .= "To: $to\n"; 
		$head     .= "Subject: $subj\n"; 
		$head     .= "X-Mailer: PHPMail Tool\n"; 
		$head     .= "Reply-To: $from\n"; 
		$head     .= "Mime-Version: 1.0\n"; 
		$head     .= "Content-Type:multipart/mixed;"; 
		$head     .= "boundary=\"----------".$un."\"\n\n"; 
		$zag       = "------------".$un."\nContent-Type:text/html; charset=utf-8;\n"; 
		$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n"; 
	
		if (!is_array($filename)) $filename = array($filename);
		
		for ($i=0;$i<sizeof($filename);$i++)
		if (is_file($_SERVER["DOCUMENT_ROOT"]."/templates/texts/".$filename[$i]))
		{
			$f         = fopen($_SERVER["DOCUMENT_ROOT"]."/templates/texts/".$filename[$i],"rb"); 
			$zag      .= "------------".$un."\n"; 
			$zag      .= "Content-Type: application/octet-stream;"; 
			$zag      .= "name=\"".$filename[$i]."\"\n"; 
			$zag      .= "Content-Transfer-Encoding:base64\n"; 
			$zag      .= "Content-Disposition:attachment;"; 
			$zag      .= "filename=\"".$filename[$i]."\"\n\n"; 
			$zag      .= chunk_split(base64_encode(fread($f,filesize($_SERVER["DOCUMENT_ROOT"]."/templates/texts/".$filename[$i]))))."\n"; 
		}
		mail("$to", "$subj", $zag, $head);
	}

	function makePages($query,$sop,$top=false)
	{
		GLOBAL $cpuarr;
		GLOBAL $mysqli;

        tplLoadTemplateFile('pages.tpl');

		$res = $mysqli->query($query);
		$count = $res->num_rows;

		$key = array_keys($cpuarr,'pages');
		if ($key)
		{
			$key = $key[sizeof($key)-1];
			$pages = $cpuarr[$key+1];
			$array = $cpuarr;
			unset($array[$key]);
			unset($array[$key+1]);
		}
		else
		{
			$pages = 1;
			$array = $cpuarr;
		}
		$array1 = array();
		for ($k=0;$k<sizeof($array);$k++)
		$array1[$k] = urlencode($array[$k]);
		$cpu = implode("/",$array1);

		$p = ($pages-1)*$sop;
		$ppp = ceil($count/$sop);

		if ($ppp>1)
		{
			$min = 1;
			$max = $ppp;

			for ($i=$min;$i<=$max;$i++)
			{
				if ($pages == $i) 
				{
					tplParseBlock('pages_bottom_item_a');
				}
				tplParseBlock('pages_bottom_item', array(
					'I' => $i,
					'ACPU' => $cpu.'/pages/'.$i.'/',
					'HOST' => HOST
				));
			}
		}

		return array($p,$array,$count);
	}
	
	function makeComments($type,$id)
	{
		GLOBAL $cpuarr;
		GLOBAL $mysqli;
		
		$add = getVar("addc");
		$text = strip_tags(getVar("text"));
		if ( ($add == 1) && ($text!='') && (isset($_SESSION["user"]["id"])) && ($_SESSION["user"]["id"]>0) )	
		{
			$res = $mysqli->query("INSERT INTO ".TABLE_COMMENTS." (uid,cid,ctype,text,date,visible) VALUES ('".$_SESSION["user"]["id"]."','".$id."','".$type."','".$text."','".time()."','1') ");			
			$res = $mysqli->query("UPDATE ".$type." SET comments=comments+1 WHERE id='".$id."' ");
			header("Location: ".$_SERVER["REQUEST_URI"]);
		}
		
        tplLoadTemplateFile('comments.tpl');
		$res = $mysqli->query("SELECT c.*,u.name AS uname,u.login AS ulogin, u.img AS uimg, u.regtime AS uregtime, r.name AS rname, u.lastonline AS ulastonline FROM ".TABLE_COMMENTS." c LEFT JOIN ".TABLE_USERS." u ON '1' LEFT JOIN ".TABLE_REGIONS." r ON r.id=u.city WHERE c.ctype='".$type."' AND c.cid='".$id."' AND c.visible='1' AND u.id=c.uid AND u.visible='1' AND u.visible='1' ORDER BY c.date DESC");
		while ($row = $res->fetch_array())
		{
			if ($row["uimg"]!='') tplParseBlock('comments_item_img2', array(
				'IMG' => $row["uimg"]
			));
			else tplParseBlock('comments_item_img1');
			tplParseBlock('comments_item', array(
				'ID' => $row["uid"],
				'NAME' => ($row["uname"]!='') ? $row["uname"] : $row["ulogin"],
				'CITY' => ($row["rname"]!='') ? ', '.$row["rname"].', ' : '',
				'LIFE' => mylife($row["uregtime"]),
				'TEXT' => str_replace("\n","<br>",$row["text"]),
				'DATE' => date("d.m.Y H:i",$row["date"]),
				'ONLINE1' => ((time()-$row["ulastonline"])>600) ? '2' : '',
				'HOST' => HOST
			));
		}
		
		if ( (isset($_SESSION["user"]["id"])) && ($_SESSION["user"]["id"]>0) ) tplParseBlock('comments_add');
		else tplParseBlock('comments_add1');
	}	
	
	function makecpu($name)
	{
		$array1 = array("qwerty","q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m","Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Z","X","C","V","B","N","M","1","2","3","4","5","6","7","8","9","0","-","й","ц","у","к","е","н","г","ш","щ","з","х","ъ","ё","ф","ы","в","а","п","р","о","л","д","ж","э","я","ч","с","м","и","т","ь","б","ю","Й","Ц","У","К","Е","Н","Г","Ш","Щ","З","Х","Ъ","Ё","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","Ч","С","М","И","Т","Ь","Б","Ю"," ");
		$array2 = array("qwerty","q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m","q","w","e","r","t","y","u","i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m","1","2","3","4","5","6","7","8","9","0","-","y","c","u","k","e","n","g","sh","sh","z","h","","e","f","i","v","a","p","r","o","l","d","zh","e","ya","ch","s","m","i","t","","b","yu","y","c","u","k","e","n","g","sh","sh","z","h","","e","f","i","v","a","p","r","o","l","d","zh","e","ya","ch","s","m","i","t","","b","yu","-");
		
		$name = trim(strip_tags($name));
		$res = '';
		for ($i=0;$i<mb_strlen($name, 'UTF-8');$i++)
		{
			$key = array_search(mb_substr($name,$i,1, 'UTF-8'), $array1);
			if ($key>0) $res .= $array2[$key];
		}
		return $res;
	}

	function defender_xss($arr){	
		$filter = array("<",">",";",'"',"'"); 
		foreach($arr as $num=>$xss)
		$arr[$num]=str_replace ($filter, "", $xss);
		return $arr;
	}	
	
	function _htmlspecialchars($text)
	{
		return htmlspecialchars($text,ENT_QUOTES,'utf-8');
	}
?>