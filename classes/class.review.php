<?php
class cReviewList extends cList
{
	var $filter = array();

	var $table = TABLE_REVIEWS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cReview';
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
					$this->filter[] = "`".$this->table."`.`doctor`='".$value."'";
				break;
				
				default:break;
  			}
   		}
	}

	function getReviewCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";

		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);

		$res=doSQL($sql,__LINE__,__FILE__);
		$r=mysql_fetch_array($res);
		return $r['count'];
	}
}

class cReview extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'name'),
		array('name' => 'text'),
		array('name' => 'visible'),
		array('name' => 'img'),
		array('name' => 'social'),
		array('name' => 'ordernum')
	);

	var $paramsEx = array(
		);

	var $info = array();

    var $table = TABLE_REVIEWS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>