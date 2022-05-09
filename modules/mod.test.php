<?
class cModTest
{
    function Init()
    {
		tplLoadTemplateFile('test.tpl');
    }

	function show()
    {
		GLOBAL $mainname, $tree, $data, $second, $cont;

		$pos = 1;
		$cpu = $cont['cpu'];
		if (isset($data)) 
		{
			$pos += 1;
			$cpu = $mainname->info['cpu'].'/'.$cont['cpu'];
			tplParseBlock('bread', array(
				'NAME' => $mainname->info['name'],
				'CPU' => $mainname->info['cpu'],
				'POS' => $pos,
				'HOST' => HOST
			));
			if ($second['id']!=$data['id'])	
			{
				$pos += 1;
				$cpu = $mainname->info['cpu'].'/'.$second['cpu'].'/'.$cont['cpu'];
				tplParseBlock('bread', array(
					'NAME' => $second['name'],
					'CPU' => $mainname->info['cpu'].'/'.$second['cpu'],
					'POS' => $pos,
					'HOST' => HOST
				));
			}
		}
		
		if ($cont['img']!='') tplParseBlock('img', array(
			'IMG' => $cont['img'],
			'TEXT' => str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$cont['imgtext']))
		));

		$text = str_replace("../",HOST,str_replace("../upload-files/","/upload-files/",$cont['text']));

		$unit = new cClinicList();
		$unit->setFilter(array(FILTER_VISIBLE => 1));
		$unit = $unit->getList();
		
		$spec = new cSpecializationList();
		$spec->setFilter(array(FILTER_VISIBLE => 1));
		$spec = $spec->getList();

		if ($cont['units']!='')
		{
			$uni = explode(",",$cont['units']);
			foreach ($uni AS $val)
			if (isset($unit[$val]))	tplParseBlock('unit', array(
				'NAME1' => $unit[$val]->info['name1'],
				'ADDRESS' => $unit[$val]->info['address'],
				'CPU1' => CLINICCPU,
				'CPU2' => $unit[$val]->info['cpu'],
				'HOST' => HOST
			));
			$uarr = array(24 => 'Хирургический центр',23 => 'Хирургический центр в Киеве',259 => 'Хирургический центр',26 => 'Хирургический центр',25 => 'Хирургический центр',258 => 'Записаться на прием к детскому кардиологу',247 => 'Записаться на прием к детскому гастроэнтерологу',246 => 'Записаться на прием к детскому ЛОРу',244 => 'Записаться на прием к детскому хирургу',243 => 'Записаться на прием к детскому ортопеду-травматологу',128 => 'ПОДРАЗДЕЛЕНИЯ, ГДЕ ПРОВОДИТСЯ ПРОЦЕДУРА',256 => 'Сделать операцию холецистэктомия в Киеве',255 => 'Приобрести подарочный сертификат Вы можете',22 => 'Хирургический центр в Киеве',184 => 'Сделать прививку от гриппа Вы можете',179 => 'Сделать узи в киеве Вы можете',212 => 'Записаться к дерматологу Вы можете',181 => 'Сделать гастроскопию (ФГДС) в Киеве',253 => 'Сделать ЭКГ в Киеве',235 => 'Сделать гистероскопию в киеве можно на подразделениях',9 => '5 многопрофильных медицинских центров в Киеве',190 => 'Адрес оздоровительного центра',261 => 'Адрес оздоровительного центра',191 => 'Адрес оздоровительного центра',65 => 'Адрес оздоровительного центра');
			tplParseBlock('units',array(
				'NAME' => (isset($uarr[$cont['id']])) ? $uarr[$cont['id']] : 'Подразделения, где проводится процедура'
			));
			$text = str_replace("|units|",$GLOBALS['tpl']->_parsed['units'],$text);
		}

		$dep_pos = strpos(' '.$text,'|dep');
		if ($dep_pos>0)
		{
			$temp = substr($text,$dep_pos+4);
			$temp = explode("|",$temp);
			$temp = $rep = $temp[0];
			$temp = explode(",",$temp);
			$temp = array_map("intval",$temp);
			
			if (sizeof($temp)>0)
			{
				$res = mysql_query("SELECT * FROM ".TABLE_DEPARTMENTS." WHERE visible='1' AND id IN (".implode(",",$temp).") ORDER BY name ");
				while ($row = mysql_fetch_array($res))
				{
					$phone = explode("\n",$row["phone"]);
					$phones = array();
					foreach ($phone AS $val)
					$phones[] = '<a href="tel:+'.str_replace('-','',str_replace(' ','',str_replace('(','',str_replace(')','',str_replace('+','',$val))))).'">'.$val.'</a>';

					tplParseBlock('dep_item', array(
						'ID' => $row['id'],
						'NAME' => $row['name'],
						'PHONE' => implode('',$phones)
					));
				}
				tplParseBlock('dep');
				$text = str_replace("|dep-".$rep."|",$GLOBALS['tpl']->_parsed['dep'],$text);
			}
		}
		
		if (strpos(' '.$text,'|questionh|')>0)
		{
			addblock('questionh');
			$text = str_replace("|questionh|",$GLOBALS['tpl']->_parsed['questionh'],$text);
		}
		
		if (strpos(' '.$text,'|ambulance|')>0)
		{
			addblock('ambulance');
			$text = str_replace("|ambulance|",$GLOBALS['tpl']->_parsed['ambulance'],$text);
		}
		
		if (strpos(' '.$text,'|question|')>0)
		{
			addblock('question');
			$text = str_replace("|question|",$GLOBALS['tpl']->_parsed['question'],$text);
		}
		
		if (strpos(' '.$text,'|clock|')>0)
		{
			addblock('clock');
			$text = str_replace("|clock|",$GLOBALS['tpl']->_parsed['clock'],$text);
		}

		if (strpos(' '.$text,'|price|')>0)
		{
			getprice($cont["id"]);
			$text = str_replace("|price|",$GLOBALS['tpl']->_parsed['pricelist'],$text);
		}

		$text = str_replace('&raquo;','»',str_replace('&laquo;','«',$text));
		$price_pos = strpos(' '.$text,'|price=');
		while ($price_pos>0)
		{
			$temp = substr($text,$price_pos+6);
			$temp = explode("|",$temp);
			$temp = $rep = $temp[0];
			$res = mysql_query("SELECT price FROM prices WHERE name='".mysql_real_escape_string($temp)."' ");
			$pr = mysql_fetch_array($res);
			$text = str_replace("|price=".$rep."|",$pr[0],$text);
			$price_pos = strpos(' '.$text,'|price=');
		}
		
		$docreviews = array();

		$doc_pos = strpos(' '.$text,'|doctors');
		if ($doc_pos>0)
		{
			$temp = substr($text,$doc_pos+8);
			$temp = explode("|",$temp);
			$temp = $rep = $temp[0];
			$temp = explode(",",$temp);
			$temp = array_map("intval",$temp);
			$where = array();
			foreach ($temp AS $val)
			if ($val>0) $where[] = " LOCATE(',".$val.",',CONCAT(',',specs,','))>0 ";
			
			if (sizeof($where)>0)
			{
				$res = mysql_query("SELECT * FROM ".TABLE_DOCTORS." WHERE visible='1' AND (".implode(" OR ",$where).") ORDER BY name ");
				while ($row = mysql_fetch_array($res))
				{
					$docreviews[] = $row['id'];
					$specs = array();
					if ($row['specs']!='')
					{
						$spe = explode(",",$row['specs']);
						foreach ($spe AS $val)
						if (isset($spec[$val])) $specs[] = $spec[$val]->info['name'];
					}
					tplParseBlock('doc_item', array(
						'NAME' => $row['name'],
						'CPU1' => DOCTORCPU,
						'CPU2' => $row['cpu'],
						'IMG' => $row['img'],
						'SPECS' => (sizeof($specs)>0) ? implode(', ',$specs) : '',
						'HOST' => HOST
					));
				}
				tplParseBlock('docs');
				$text = str_replace("|doctors-".$rep."|",$GLOBALS['tpl']->_parsed['docs'],$text);
			}
		}
		$doc_pos = strpos(' '.$text,'|doctoritems');
		if ($doc_pos>0)
		{
			$temp = substr($text,$doc_pos+12);
			$temp = explode("|",$temp);
			$temp = $rep = $temp[0];
			$temp = explode(",",$temp);
			$temp = array_map("intval",$temp);
			
			if (sizeof($temp)>0)
			{
				$res = mysql_query("SELECT * FROM ".TABLE_DOCTORS." WHERE visible='1' AND id IN (".implode(",",$temp).") ORDER BY name ");
				while ($row = mysql_fetch_array($res))
				{
					$docreviews[] = $row['id'];
					$specs = array();
					if ($row['specs']!='')
					{
						$spe = explode(",",$row['specs']);
						foreach ($spe AS $val)
						if (isset($spec[$val])) $specs[] = $spec[$val]->info['name'];
					}
					tplParseBlock('doc_item', array(
						'NAME' => $row['name'],
						'CPU1' => DOCTORCPU,
						'CPU2' => $row['cpu'],
						'IMG' => $row['img'],
						'SPECS' => (sizeof($specs)>0) ? implode(', ',$specs) : '',
						'HOST' => HOST
					));
				}
				tplParseBlock('docs');
				$text = str_replace("|doctoritems-".$rep."|",$GLOBALS['tpl']->_parsed['docs'],$text);
			}
		}
		
		$doc_pos = strpos(' '.$text,'|doctornitems');
		if ($doc_pos>0)
		{
			$temp = substr($text,$doc_pos+13);
			$temp = explode("|",$temp);
			$temp = $rep = $temp[0];
			$temp = explode(",",$temp);
			$temp = array_map("intval",$temp);
			
			if (sizeof($temp)>0)
			{
				$list = new cDoctorList();
				$list->setFilter(array(FILTER_VISIBLE => 1, FILTER_ITEM => implode(',',$temp)));
				$list = $list->getList();
				foreach ($list as $item)
				{
					$docreviews[] = $item->info['id'];

					$specs = array();
					if ($item->info['specs']!='')
					{
						$spe = explode(",",$item->info['specs']);
						foreach ($spe AS $val)
						if (isset($spec[$val])) $specs[] = $spec[$val]->info['name'];
					}
					if ($item->info['units']!='')
					{
						$uni = explode(",",$item->info['units']);
						foreach ($uni AS $val)
						if (isset($unit[$val]))	tplParseBlock('doctor_address', array(
							'NAME' => $unit[$val]->info['name1'].'<br>'.$unit[$val]->info['address'],
							'CPU1' => CLINICCPU,
							'CPU2' => $unit[$val]->info['cpu'],
							'HOST' => HOST
						));
					}
					if ($item->info['rating']>0) tplParseBlock('doctor_rating', array(
						'RATING' => $item->info['rating'],
						'RATINGROUND' => str_replace(",",".",(round($item->info['rating']/0.5)*0.5))
					));
					tplParseBlock('doctor', array(
						'NAME' => $item->info['name'],
						'CPU1' => DOCTORCPU,
						'CPU2' => $item->info['cpu'],
						'IMG' => $item->info['img'],
						'RATING' => $item->info['rating'],
						'RATINGROUND' => str_replace(",",".",(round($item->info['rating']/0.5)*0.5)),
						'PRICE' => $item->info['price'],
						'SPECS' => (sizeof($specs)>0) ? implode(', ',$specs) : '',
						'HOST' => HOST
					));
				}
				tplParseBlock('doctors');
				$text = str_replace("|doctornitems-".$rep."|",$GLOBALS['tpl']->_parsed['doctors'],$text);
			}
		}

		$doc_pos = strpos(' '.$text,'|doctorreviews');
		if ( ($doc_pos>0) && (sizeof($docreviews)>0) )
		{
			$query = "SELECT r.*, d.name AS dname,d.specs,d.img,d.cpu FROM ".TABLE_REVIEWS." r JOIN (SELECT doctor, max(date) AS maxdate FROM ".TABLE_REVIEWS." WHERE visible='1' AND publ='1' AND doctor IN (".implode(",",$docreviews).") GROUP BY doctor) AS r1 ON r.doctor=r1.doctor AND r.date=r1.maxdate JOIN ".TABLE_DOCTORS." d ON d.id=r.doctor ORDER BY r.date DESC";
			$res = mysql_query($query);
			while ($row = mysql_fetch_array($res))
			{
				if ($row['rating']>0) tplParseBlock('rev_rating', array(
					'RATING' => $row['rating'],
					'RATINGROUND' => str_replace(",",".",(round($row['rating']/0.5)*0.5))
				));
				$specs = array();
				if ($row['specs']!='')
				{
					$spe = explode(",",$row['specs']);
					foreach ($spe AS $val)
					if (isset($spec[$val])) $specs[] = $spec[$val]->info['name'];
				}
				tplParseBlock('rev_doctor', array(
					'SPECS' => (sizeof($specs)>0) ? implode(', ',$specs) : '',
					'NAME' => $row['dname'],
					'CPU1' => DOCTORCPU,
					'CPU2' => $row['cpu'],
					'HOST' => HOST,
					'IMG' => $row['img']
				));
				tplParseBlock('rev', array(
					'NAME' => $row['name'],
					'DATE' => date("d.m.Y",$row['date']),
					'TEXT' => $row['text']
				));
			}
			
			tplParseBlock('doctorreviews');
			$text = str_replace("|doctorreviews|",$GLOBALS['tpl']->_parsed['doctorreviews'],$text);
		}
		
		$pos += 1;
		tplParseBlock('block_center', array(
			'NAME' => $cont['name'],
			'H1' => ($cont['h1']!='') ? $cont['h1'] : $cont['name'],
			'TEXT' => $text,
			'CPU' => $cpu,
			'POS' => $pos,
			'HOST' => HOST
		));
		
		$GLOBALS['PAGE_TITLE'] = $cont['title'];
		$GLOBALS['PAGE_DESCRIPTION'] = $cont['description'];
		$GLOBALS['PAGE_KEYWORDS'] = $cont['keywords'];
    }

    function Run()
    {
		if (isset($_REQUEST['action']))
        {
			switch ($_REQUEST['action'])
        	{
        		case "": break;
        	}
        }
        $this->show();
    }
}
?>