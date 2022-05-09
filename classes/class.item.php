<?
class cItem
{
	var $usedClass = array();
	var $usedTables = array();
	var $chooseParams = array();

	var $paramsCustom=array();

	var $id_field = 'id';

	function load()
	{
		$this->_load();
	}

	function loadEx()
	{
		$this->_load('ex');
	}

	function loadAll()
	{
		$this->_load('all');
	}
	function loadCustom($params=array())
	{
		$this->paramsCustom=array();
		foreach ($params as $param)
		$this->paramsCustom[]=array('name' => $param);
		$this->_load('custom');
	}

	function _load($ext=false)
	{
		if ( !($this->{$this->id_field}) ) return;

		$sel=$this->buildSel($ext);
		$filter=$this->buildFilter();

		foreach ($this->usedTables as $table)
		$tables[] = '`'.$table.'`';
		$tables = implode(',', $tables);

		$sql = "SELECT $sel FROM $tables WHERE $filter";
        $res = doSQL($sql,__LINE__,__FILE__);
		$r = $res->fetch_array();

		foreach ($this->chooseParams as $paramName)
		{
			foreach ($this->$paramName as $param)
			$this->info[$param['name']]=$r['base_'.$param['name']];

			foreach ($this->usedClass as $itemName=>$className)
			{
				$$itemName = new $className($r[$itemName.'_'.$this->id_field]);
				foreach ($$itemName->$paramName as $param)
				$$itemName->info[$param['name']]=$r[$itemName.'_'.$param['name']];
				$this->$itemName=$$itemName;
			}
		}
	}

	function buildFilter()
	{
		$filter[] = "`".$this->table."`.`".$this->id_field."`='".$this->{$this->id_field}."'"; // выбирать текущую запись

		foreach ($this->usedClass as $itemName=>$className)
		{
			$classItem = new $className();
			foreach ($this->params as $param)
			if ($param['filter']==$itemName) 
			$filter[] = '`'.$this->table.'`.`'.$param['name']."`=`".$classItem->table.'`.`'.$this->id_field.'`';
		}
		return $filter=implode(' AND ', $filter);
	}

	function buildSel($ext=false)
	{
		$this->chooseParams=array();
		switch ($ext)
		{
			case 'ex':      $this->chooseParams[]='paramsEx'; break;
			case 'all':     $this->chooseParams[]='paramsEx'; $this->chooseParams[]='params'; break;
			case 'custom':  $this->chooseParams[]='paramsCustom'; break;
			default:        $this->chooseParams[]='params'; break;
		}

		foreach ($this->chooseParams as $paramName)
		{
			foreach ($this->$paramName as $param)
			$sel[]='`'.$this->table.'`.`'.$param['name'].'` as base_'.$param['name'];
			$this->usedTables[$this->table]=$this->table;

			foreach ($this->usedClass as $itemName=>$className)
			{
				$$itemName = new $className();
				foreach ($$itemName->$paramName as $param)
				$sel[]='`'.$$itemName->table.'`.`'.$param['name'].'` as '.$itemName.'_'.$param['name'];
				$this->usedTables[$$itemName->table]=$$itemName->table;
			}
		}
		return $sel=implode(',', $sel);
	}

	function buildIncOrdernum()
	{
		$sql = "SELECT MAX(ordernum) as ordernum FROM `".$this->table."`";
		$res = doSQL($sql,__LINE__,__FILE__);
		$r = $res->fetch_array();
		$this->info['ordernum'] = $r['ordernum']+1;
	}


	function save()
	{
		GLOBAL $mysqli;
		if (empty($this->info)) return;

		$params=array_merge($this->params,$this->paramsEx);

		if ($this->{$this->id_field})
		{
			foreach ($params as $param)	
			if (isset($this->info[$param['name']])) 
			$sel[]='`'.$param['name']."`='".$this->info[$param['name']]."'";
			$sel = implode(',', $sel);

			$sql = "UPDATE `".$this->table."` SET $sel WHERE `".$this->id_field."`='".$this->{$this->id_field}."'";
	        doSQL($sql,__LINE__,__FILE__);
		}
		else 
		{
			foreach ($params as $param)
			{
				if ($param['name']==$this->id_field) continue;
				if (isset($this->info[$param['name']]))
				{
					$sel[]='`'.$param['name'].'`';
					$val[]="'".$this->info[$param['name']]."'";
				}
			}
			$sel = implode(',', $sel);
			$val = implode(',', $val);

			$sql = "INSERT INTO `".$this->table."` ($sel) VALUES ($val)";
	        doSQL($sql,__LINE__,__FILE__);

			$this->id = $mysqli->insert_id;
		}
	}

	function del()
	{
		if ( !($this->{$this->id_field}) ) return;

		$sql = "DELETE FROM `".$this->table."` WHERE `".$this->id_field."`='".$this->{$this->id_field}."'";
        doSQL($sql,__LINE__,__FILE__);

		$this->id = null;
		$this->info = array();
	}

	function isSavedItem()
	{
		if ( !($this->{$this->id_field}) ) return;
		$sql = "SELECT `id` FROM `".$this->table."` WHERE `".$this->id_field."`='".$this->{$this->id_field}."'";
		$res = doSQL($sql,__LINE__,__FILE__);
		return $res->num_rows>0 ? 1:0;
	}
}
?>