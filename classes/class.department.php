<?php
class cDepartmentList extends cList
{
	var $filter = array();

	var $table = TABLE_DEPARTMENTS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cDepartment';
		$this->setOrder('ordernum','asc');
	}

	function setFilter($filter)
   	{
	    foreach ($filter as $filter_id => $value)
	    {
	        switch ($filter_id)
	        {
 				case FILTER_VISIBLE: 
					$this->filter[] = "`".$this->table."`.`visible`='".$value."'";
				break;
				
 				case FILTER_ITEM: 
					$this->filter[] = "`".$this->table."`.`leftcolumn`='".$value."' AND phone<>''";
				break;
				
				default:break;
  			}
   		}
	}

	function getDepartmentCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";
		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);
		$res = doSQL($sql,__LINE__,__FILE__);
		$r = $res->fetch_array();
		return $r['count'];
	}
}

class cDepartment extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'ordernum'),
		array('name' => 'name'),
		array('name' => 'name_en'),
		array('name' => 'name_ua'),
		array('name' => 'phone'),
		array('name' => 'email'),
		array('name' => 'visible')
	);

	var $paramsEx = array();

	var $info = array();

    var $table = TABLE_DEPARTMENTS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>