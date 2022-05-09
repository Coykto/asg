<?php
class cUserList extends cList
{
	var $filter = array();

	var $table = TABLE_USERS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cUser';
		$this->setOrder('date','asc');
	}

	function setFilter($filter)
   	{
	    foreach ($filter as $filter_id => $value)
	    {
	        switch ($filter_id)
	        {
 				case FILTER_EMAIL: 
					$this->filter[] = "`email` = '".$value."'";
				break;

 				case FILTER_PASSWORD: 
					$this->filter[] = "`password` = '".$value["password"]."'";
				break;
				
				default:break;
  			}
   		}
	}

	function getUserCount()
	{
		$sql = "SELECT COUNT(`".$this->table."`.`id`) as count FROM `".$this->table."`";

		if ($this->filter) $sql .= " WHERE " . implode(' AND ', $this->filter);

		$res=doSQL($sql,__LINE__,__FILE__);
		$r=mysql_fetch_array($res);
		return $r['count'];
	}
}

class cUser extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'date'),
		array('name' => 'fname'),
		array('name' => 'name'),
		array('name' => 'ireg'),
		array('name' => 'address'),
		array('name' => 'phone'),
		array('name' => 'email'),
		array('name' => 'password'),
		array('name' => 'partner'),
		array('name' => 'p_code'),
		array('name' => 'p_percent'),
		array('name' => 'p_bonus'),
		array('name' => 'p_send'),
		array('name' => 'bonus_money'),
		array('name' => 'p_email_send'),
		array('name' => 'visible')
	);

	var $paramsEx = array(
		);

	var $info = array();

    var $table = TABLE_USERS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>