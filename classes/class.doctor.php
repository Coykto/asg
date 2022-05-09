<?php
class cDoctorList extends cList
{
	var $filter = array();

	var $table = TABLE_DOCTORS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cDoctor';
		$this->setOrder('name','asc');
	}

	function setFilter($filter)
   	{
	    foreach ($filter as $filter_id => $value)
	    {
	        switch ($filter_id)
	        {
 				case FILTER_ITEM: 
					$this->filter[] = "`id` IN (".$value.")";
				break;

 				case FILTER_VISIBLE: 
					$this->filter[] = "`".$this->table."`.`visible`='".$value."'";
				break;
				
				default:break;
  			}
   		}
	}

	function getDoctorCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";
		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);
		$res = doSQL($sql,__LINE__,__FILE__);
		$r = mysql_fetch_array($res);
		return $r['count'];
	}
}

class cDoctor extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'ordernum'),
		array('name' => 'name'),
		array('name' => 'name_en'),
		array('name' => 'name_ua'),
		array('name' => 'text'),
		array('name' => 'text_en'),
		array('name' => 'text_ua'),
		array('name' => 'cpu'),
		array('name' => 'title'),
		array('name' => 'title_en'),
		array('name' => 'title_ua'),
		array('name' => 'description'),
		array('name' => 'description_en'),
		array('name' => 'description_ua'),
		array('name' => 'keywords'),
		array('name' => 'keywords_en'),
		array('name' => 'keywords_ua'),
		array('name' => 'specs'),
		array('name' => 'units'),
		array('name' => 'years'),
		array('name' => 'years_en'),
		array('name' => 'years_ua'),
		array('name' => 'cat'),
		array('name' => 'cat_en'),
		array('name' => 'cat_ua'),
		array('name' => 'price'),
		array('name' => 'videos'),
		array('name' => 'img'),
		array('name' => 'textsmall'),
		array('name' => 'textsmall_en'),
		array('name' => 'textsmall_ua'),
		array('name' => 'rating'),
		array('name' => 'rating_count'),
		array('name' => 'reviews_count'),
		array('name' => 'visible')
	);

	var $paramsEx = array();

	var $info = array();

    var $table = TABLE_DOCTORS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>