<?php
class cArticleList extends cList
{
	var $filter = array();

	var $table = TABLE_ARTICLES;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cArticle';
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
				
 				case FILTER_SEARCH: 
					$this->filter[] = " LOCATE(',".$value.",',CONCAT(',',".$this->table.".cid,','))>0 ";
				break;
				
				default:break;
  			}
   		}
	}

	function getArticleCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";
		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);
		$res = doSQL($sql,__LINE__,__FILE__);
		$r = $res->fetch_array();
		return $r['count'];
	}
}

class cArticle extends cItem
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
		array('name' => 'visible'),
		array('name' => 'date'),
		array('name' => 'img'),
		array('name' => 'img1'),
		array('name' => 'img2'),
		array('name' => 'img2_mobile'),
		array('name' => 'img3'),
		array('name' => 'name1'),
		array('name' => 'cid'),
		array('name' => 'tid'),
		array('name' => 'blogscheme'),
		array('name' => 'cpu')
	);

	var $paramsEx = array();

	var $info = array();

    var $table = TABLE_ARTICLES;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>