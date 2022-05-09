<?php
class cEventList extends cList
{
	var $filter = array();

	var $table = TABLE_EVENTS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cEvent';
		$this->setOrder('ordernum','asc');
	}

	function setFilter($filter)
   	{
	    foreach ($filter as $filter_id => $value)
	    {
	        switch ($filter_id)
	        {
 				case FILTER_ITEM: 
					$this->filter[] = "`id` = '".$value["id"]."'";
				break;

 				case FILTER_VISIBLE: 
					$this->filter[] = "`".$this->table."`.`visible`='".$value."'";
				break;
				
				default:break;
  			}
   		}
	}

	function getEventCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";
		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);
		$res = doSQL($sql,__LINE__,__FILE__);
		$r = $res->fetch_array();
		return $r['count'];
	}
}

class cEvent extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'ordernum'),
		array('name' => 'name'),
		array('name' => 'text'),
		array('name' => 'textsmall'),
		array('name' => 'level'),
		array('name' => 'title'),
		array('name' => 'description'),
		array('name' => 'keywords'),
		array('name' => 'visible'),
		array('name' => 'wtime'),
		array('name' => 'img'),
		array('name' => 'img1'),
		array('name' => 'video'),
		array('name' => 'forreg'),
		array('name' => 'cpu')
	);

	var $paramsEx = array();

	var $info = array();

    var $table = TABLE_EVENTS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>