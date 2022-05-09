<?php
class cMediaList extends cList
{
	var $filter = array();

	var $table = TABLE_MEDIAS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cMedia';
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
					$this->filter[] = "`".$this->table."`.`visible`='".$value."'";
				break;
				
				default:break;
  			}
   		}
	}

	function getMediaCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";

		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);

		$res=doSQL($sql,__LINE__,__FILE__);
		$r=mysql_fetch_array($res);
		return $r['count'];
	}
}

class cMedia extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'ordernum'),
		array('name' => 'name'),
		array('name' => 'text'),
		array('name' => 'textsmall'),
		array('name' => 'title'),
		array('name' => 'description'),
		array('name' => 'keywords'),
		array('name' => 'name_en'),
		array('name' => 'text_en'),
		array('name' => 'textsmall_en'),
		array('name' => 'title_en'),
		array('name' => 'description_en'),
		array('name' => 'keywords_en'),
		array('name' => 'name_ua'),
		array('name' => 'text_ua'),
		array('name' => 'textsmall_ua'),
		array('name' => 'title_ua'),
		array('name' => 'description_ua'),
		array('name' => 'keywords_ua'),
		array('name' => 'visible'),
		array('name' => 'date'),
		array('name' => 'cpu')
	);

	var $paramsEx = array(
		);

	var $info = array();

    var $table = TABLE_MEDIAS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>