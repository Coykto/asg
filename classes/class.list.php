<?

class cList
{
	var $limit = null;
	var $order = null;
	var $group = null;

	var $className;
	var $baseClass;
	var $usedClass = array();

	var $usedTables = array();

	var $id_field = 'id';

	var $pre_sel = array();

  	function setLimit($from,$count=0)
   	{
		$this->limit = "$from";
		if ($count)	$this->limit .= ", $count";
   	}

  	function setOrder($field,$sort='asc')
   	{
   		$this->order = $field.' '.strtoupper($sort);
   	}

	function setGroup($field)
	{
		$this->group = $field;
	}

	function setPreSel($sel)
	{
		$this->pre_sel[] = $sel;
	}

	function addTable($table)
	{
		$this->usedTables[] = $table;
	}

	function buildSel()
	{
		$classItem = new $this->baseClass();
		foreach ($classItem->params as $param)
		$sel[]='`'.$classItem->table.'`.`'.$param['name'].'` as base_'.$param['name'];
		$this->usedTables[$classItem->table] = $classItem->table;

		foreach ($this->usedClass as $itemName=>$className)
		{
			$$itemName = new $className();
			foreach ($$itemName->params as $param)
			$sel[]='`'.$$itemName->table.'`.`'.$param['name'].'` as '.$itemName.'_'.$param['name'];
			$this->usedTables[$$itemName->table] = $$itemName->table;
		}
		$sel=array_merge($sel,$this->pre_sel);
		return implode(',',$sel);
	}

	function clearFilter()
	{
		$this->filter=array();
	}

	function clearLimit()
	{
		$this->limit=null;
	}

	function clearGroup()
	{
		$this->group=null;
	}

	function clearOrder()
	{
		$this->order=null;
	}

	function clearPreSel()
	{
		$this->pre_sel=array();
	}

	function buildFilter()
	{
		$filter = array();
		$baseItem = new $this->baseClass();
		foreach ($this->usedClass as $itemName=>$className)
		{
			$classItem = new $className();
			foreach ($baseItem->params as $param)
			if ($param['filter']==$itemName) $filter[] = '`'.$baseItem->table.'`.`'.$param['name']."`=`".$classItem->table.'`.`'.$this->id_field.'`';
		}
		return $filter;
	}

	function getList()
	{
		$sel = $this->buildSel();

		foreach ($this->usedTables as $table)
		$tables[]='`'.$table.'`';
		$tables=implode(',',$tables);

		$sql = "SELECT $sel FROM $tables";

		$filter=$this->buildFilter();
		$filter=array_merge($this->filter,$filter);

      	if ($filter) $sql .= " WHERE " . implode(' OR ', $filter);
      	if (!empty($this->group)) $sql .= " GROUP BY " . $this->group;
      	if (!empty($this->order)) $sql .= " ORDER BY " . $this->order;
      	if (!empty($this->limit)) $sql .= " LIMIT ".$this->limit;

		$res = doSQL($sql,__LINE__,__FILE__);
		$items = array();
		while($r = $res->fetch_array())
		{
			$newItem=new $this->baseClass($r['base_'.$this->id_field]);
			foreach ($newItem->params as $param)
			$newItem->info[$param['name']]=$r['base_'.$param['name']];

			foreach ($this->usedClass as $itemName=>$className)
			{
				$$itemName=new $className($r[$itemName.'_'.$this->id_field]);
				foreach ($$itemName->params as $param)
				$$itemName->info[$param['name']]=$r[$itemName.'_'.$param['name']];
				$newItem->$itemName=$$itemName;
			}
			$items[$r['base_'.$this->id_field]]=$newItem;
		}
		return $items;
	}

	function getCount()
	{
		$sql = "SELECT COUNT(`id`) as count FROM `".$this->table."`";
		if ($this->filter)
		{
			if (isset($_SESSION["sql_where"]) && ($_SESSION["sql_where"]!="") ) $sql .= $_SESSION["sql_where"];
			else  $sql .= " WHERE " . implode(' AND ', $this->filter);
		}

		$res=doSQL($sql,__LINE__,__FILE__);
		$r = $res->fetch_array();
		return $r['count'];
	}
}
?>