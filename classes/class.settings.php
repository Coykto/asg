<?php
class cSettingList extends cList
{
	var $filter = array();

	var $table = TABLE_SETTINGS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cSetting';
	}

	function setFilter($filter)
   	{
	    foreach ($filter as $filter_id => $value)
	    {
	        switch ($filter_id)
	        {
 				case FILTER_GROUP:
					$this->filter[] = "`group_id`='$value'";
					break;
  			}
   		}
	}
}

class cSetting extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'set'),
		array('name' => 'value'),
		array('name' => 'group_id'),
		array('name' => 'type'),
		array('name' => 'values'),
		);

	var $paramsEx = array(
		);

	var $info = array();

    var $table = TABLE_SETTINGS;

	function __construct($id=0)
	{
		$this->id=$id;
	}

	function load($name='')
	{
		foreach ($this->params as $param)
			$sel[]='`'.$this->table.'`.`'.$param['name'].'`';
		$sel = implode(',', $sel);
		$sql = "SELECT $sel FROM `".$this->table."` WHERE `set`='$name'";
		$res = doSQL($sql,__LINE__,__FILE__);
		if (mysql_num_rows($res)>0)
		{
			$r = mysql_fetch_array($res);
			foreach ($this->params as $param)
				$this->info[$param['name']] = $r[$param['name']];
			$this->id=$r['id'];
			return true;
		}
		return false;
	}
}
?>
