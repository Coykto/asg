<?
class cModDefault
{
	function Init()
	{
		tplLoadTemplateFile('default.tpl');
	}

	function Run()
	{
		tplParseBlock('center');
	}
}
?>
