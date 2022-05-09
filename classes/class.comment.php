<?php
class cCommentList extends cList
{
	var $filter = array();

	var $table = TABLE_COMMENTS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cComment';
		$this->setOrder('date','desc');
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
					$this->filter[] = "`".$this->table."`.`cid`='".$value."'";
				break;
				
				default:break;
  			}
   		}
	}

	function getCommentCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";

		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);

		$res=doSQL($sql,__LINE__,__FILE__);
		$r=mysql_fetch_array($res);
		return $r['count'];
	}
}

class cComment extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'name'),
		array('name' => 'text'),
		array('name' => 'visible'),
		array('name' => 'cid'),
		array('name' => 'answer_show'),
		array('name' => 'answer_date'),
		array('name' => 'answer'),
		array('name' => 'tt'),
		array('name' => 'ip'),
		array('name' => 'phone'),
		array('name' => 'email'),
		array('name' => 'date')
	);

	var $paramsEx = array(
		);

	var $info = array();

    var $table = TABLE_COMMENTS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>