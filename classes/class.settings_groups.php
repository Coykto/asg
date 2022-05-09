<?php
class cSettingsGroupList extends cList
{
	var $filter = array();

	var $table = TABLE_SETTINGS_GROUPS;

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cSettingsGroup';
		$this->setOrder('ordernum','ASC');
	}

	function setFilter($filter)
   	{
	}
}

class cSettingsGroup extends cItem
{
	var $id = null;

	var $params = array(
		array('name' => 'id'),
		array('name' => 'name'),
		);

	var $paramsEx = array(
		);

	var $info = array();

    var $table = TABLE_SETTINGS_GROUPS;

	function __construct($id=0)
	{
		$this->id=$id;
	}
}
?>
