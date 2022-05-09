<?php
class cDailyList extends cList
{
	var $filter = array();

	var $table = TABLE_DAILYS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cDaily';
		$this->setOrder('date','desc');
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
					$this->filter[] = "`".$this->table."`.`visible`='".$value."' AND `".$this->table."`.`date`<'".time()."' ";
				break;
				
				default:break;
  			}
   		}
	}

	function getDailyCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";
		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);
		$res = doSQL($sql,__LINE__,__FILE__);
		$r = $res->fetch_array();
		return $r['count'];
	}
}

class cDaily extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'ordernum'),
		array('name' => 'name'),
		array('name' => 'text'),
		array('name' => 'text1'),
		array('name' => 'text2'),
		array('name' => 'title'),
		array('name' => 'description'),
		array('name' => 'keywords'),
		array('name' => 'name1'),
		array('name' => 'visible'),
		array('name' => 'date'),
		array('name' => 'cid'),
		array('name' => 'tid'),
		array('name' => 'views'),
		array('name' => 'likes'),
		array('name' => 'banner'),
		array('name' => 'main'),
		array('name' => 'img'),
		array('name' => 'cpu')
	);

	var $paramsEx = array();

	var $info = array();

    var $table = TABLE_DAILYS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>