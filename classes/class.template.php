<?
class cTemplate
{
	var $_block = array();
	var $_children = array(array());
	var $_parsed = array();

	var $_blocknameRegExp = '[0-9A-Za-z_-]+';
	var $_blockRegExp, $_varRegExp;
	var $_root;

	function __construct($root)
	{
		$this->_blockRegExp = '@<!--\s+BEGIN\s+('. $this->_blocknameRegExp. ')\s+-->(.*)<!--\s+END\s+\1\s+-->@sm';
		$this->_varRegExp = '@{(' . $this->_blocknameRegExp . ')}@sm';
		$this->_root = $root;
	}

	function _getFile($filename)
	{
		$fh = fopen($filename, 'r');
		$content = fread($fh, filesize($filename));
		fclose($fh);
		return $content;
	}

	function _addBlock($name, $content)
	{
		// �������� �������� ������
		$this->_deleteChild($name);

		// ���������� ����� � ��� ���������� � ���������� ������ ������
		$this->_blocks[$name] = $content;
	}

	function _deleteBlock($name)
	{
		unset($this->_children[$name]);
		unset($this->_blocks[$name]);
	}

	function _addChild($parent, $child)
	{
		$this->_children[$parent][$child] = true;
	}

	function _clearBlockContent($block, $child)
	{
		$this->_blocks[$block] = preg_replace('@<!--\s+BEGIN\s+'. $child. '\s+-->(.*)<!--\s+END\s+' . $child . '\s+-->@sm',
			'<!-- BEGIN ' . $child . ' --> <!-- END ' . $child . ' -->', $this->_blocks[$block]);
	}

	function _deleteChild($parent)
   {
   	if (!empty($this->_children[$parent]))
   	{
   		foreach($this->_children[$parent] AS $child => $val)
   		{
   			$this->_deleteChild($child);
   			unset($this->_children[$parent][$child]);
   		}
   	}
   	unset($this->_block[$parent]);
   }

   // ���������� ������ ������
	function _buildBlock($crntBlockName)
	{
		// ���������� �������� �����
		$crntBlockContent = $this->_blocks[$crntBlockName];

		// ����� � ���������� �������� ����� ����� ������
		if (preg_match_all($this->_blockRegExp, $crntBlockContent, $regs, PREG_SET_ORDER))
		{
			foreach ($regs as $k => $match)
			{
				// �������� ���������� �����
				$fndBlockName = $match[1];

				// ���������� ���������� �����
				$fndBlockContent = $match[2];

				// ���������� ����� � ���������� ������ ������
				$this->_addBlock($fndBlockName, $fndBlockContent);

				// ���������� ������� - ���������� ����� � �������� �����
				$this->_addChild($crntBlockName, $fndBlockName);

				// ����� ������ � ����� �������
				$this->_buildBlock($fndBlockName);

				// ������� ���������� ����� �������� � ������� �����
				$this->_clearBlockContent($crntBlockName, $fndBlockName);
			}
		}
	}

	function _parseBlock($crntBlockName)
	{
		if (!empty($this->_children[$crntBlockName]))
		{

			// ������� �������� �����
			$children = $this->_children[$crntBlockName];

			// �������� �������� �������� �����
			reset($children);
			foreach($children AS $childName => $val)
				// ������� ����� ������� � ������ ������� � ��� ��������
				if (!empty($this->_children[$childName]))
					$this->_parseBlock($childName);

			// ���������� ��������� �� ���� �������������
			if (!empty($this->_parsed[$crntBlockName])) $parsed = true;
			else
			{
				// ���������� ��������� �� ���� �� ���� �������
				$parsed = false;
				reset($children);
				foreach($children AS $childName => $val)
					if (!empty($this->_parsed[$childName]))
					{
						$parsed = true;
						break;
					}
			}

			// ���� ��������� ���� �� ���� ������� ��� ������� ��� ������ �������������, �� ������ ������ ����
			if ($parsed)
			{
				if (empty($this->_parsed[$crntBlockName]))
					$this->_parsed[$crntBlockName] = $this->_blocks[$crntBlockName];

				reset($children);
				foreach($children AS $childName => $val)
				{
					if (empty($this->_parsed[$childName])) $parseContent = "";
					else
						$parseContent = $this->_parsed[$childName];

					// �������� �������� ���� ������������
					$this->_parsed[$crntBlockName] = preg_replace('@<!--\s+BEGIN\s+'. $childName. '\s+-->(.*)<!--\s+END\s+' . $childName . '\s+-->@sm',
						$parseContent, $this->_parsed[$crntBlockName]);

					// ������� �������� ������������ ����
					unset($this->_parsed[$childName]);
				}
			}
		}
	}

	function parseBlock($block, $variables = array())
	{
		if (empty($this->_parsed[$block]))
			$this->_parsed[$block] = $this->_blocks[$block];
		else
			$this->_parsed[$block] .= $this->_blocks[$block];

		$this->_parseBlock($block);

		// ������� ����������
		if (!empty($variables))
		{
			foreach($variables AS $var => $value)
				$this->_parsed[$block] = preg_replace('@{' . $var . '}@sm', $value, $this->_parsed[$block]);
		}

		// �������� �������������� ����������
		if (preg_match_all($this->_varRegExp, $this->_parsed[$block], $regs, PREG_SET_ORDER))
		{
			foreach ($regs as $k => $match)
				$this->_parsed[$block] = preg_replace('@{' . $match[1] . '}@sm', '', $this->_parsed[$block]);
		}
	}

	function loadTemplateFile($filename, $parentBlockName = '')
	{
		// ������ ����� �������
		$content = $this->_getFile($this->_root . "/" . $filename);

		if (empty($this->_blocks))
		{
			// �������� ����������� ����� _INIT
			$this->_addBlock('_INIT', $content);

			// ���������� ��������� ������
			$this->_buildBlock('_INIT');
		}
		elseif (empty($parentBlockName))
		{
			// �������� ���������� ����� _TEMP
			$this->_addBlock('_TEMP', $content);

			// ���������� ��������� ������
			$this->_buildBlock('_TEMP');

			// �������� ���������� �����
			$this->_deleteBlock('_TEMP');
		}
		else
		{
			// ���������� ��������� ������
			$this->_buildBlock($parentBlockName);
		}
	}

	function show()
	{
		$this->_parseBlock('_INIT');
		echo str_replace('=XYZ=','{name}',$this->_parsed['_INIT']);
	}

	// ****** BEGIN DEBUG FUNCTION !!! NOT FOR RELEASE !!! ***************************
	function showBlocks()
	{
		foreach($this->_blocks AS $block => $content)
		{
			echo "<b>Block name: </b>" . $block . "<br>";
			echo "<b>Children: </b>";
			if (!empty($this->_children[$block]))
			{
				foreach ($this->_children[$block] AS $name => $val)
					echo $name . "; ";
			}
			else
			{
				echo "none";
			}
			echo "<br>";
			echo "<b>Content: </b>\n" . $this->_blocks[$block];
			echo "\n<p>";
		}
	}
	// ****** END DEBUG FUNCTION !!! NOT FOR RELEASE !!! ****************************
}

?>