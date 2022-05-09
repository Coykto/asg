<?php

class cSysMessStack
{
    var $mess=array(); // 12 => 1, 21 => 1, 45 => 2,..
	var $can_write=1;

	function __construct()
	{
	}

	function push($messnum=0)
	{
		if ($this->can_write)
			$this->mess[]=$messnum;
	}

	function clear()
	{
		$this->mess=array();
	}

	function convert($messages_string)
	{
		$this->mess=explode(',', $messages_string);
	}

	function messExists($messnum)
	{
    	return in_array($messnum,$this->mess);
	}

	function show()
	{
		tplLoadTemplateFile('_system_messages.tpl');
		foreach ($this->mess as $messnum)
			tplParseBlock('mess_'.$messnum);
		$this->clear();
	}

	function getMessCount()
	{
		return count($this->mess);
	}
}

?>