<?php
class cStockList extends cList
{
	var $filter = array();

	var $table = TABLE_STOCKS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cStock';
		$this->setOrder('ordernum','asc');
	}

	function setFilter($filter)
   	{
	    foreach ($filter as $filter_id => $value)
	    {
	        switch ($filter_id)
	        {
 				case FILTER_ITEM: 
					$this->filter[] = " id = '".$value["id"]."'";
				break;

 				case FILTER_VISIBLE: 
					$this->filter[] = "`".$this->table."`.`visible`='".$value."'";
				break;
				
				default:break;
  			}
   		}
	}

	function getStockCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";

		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);

		$res=doSQL($sql,__LINE__,__FILE__);
		$r=mysql_fetch_array($res);
		return $r['count'];
	}
}

class cStock extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'ordernum'),
		array('name' => 'name'),
		array('name' => 'visible'),
		array('name' => 'img'),
		array('name' => 'showname'),
		array('name' => 'showbutton')
	);

	var $paramsEx = array();

	var $info = array();

    var $table = TABLE_STOCKS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>