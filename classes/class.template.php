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
		// удаление дочерних блоков
		$this->_deleteChild($name);

		// добавление блока и его содержания в глобальный список блоков
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

   // построение списка блоков
	function _buildBlock($crntBlockName)
	{
		// содержание текущего блока
		$crntBlockContent = $this->_blocks[$crntBlockName];

		// поиск в содержании текущего блока новых блоков
		if (preg_match_all($this->_blockRegExp, $crntBlockContent, $regs, PREG_SET_ORDER))
		{
			foreach ($regs as $k => $match)
			{
				// название найденного блока
				$fndBlockName = $match[1];

				// содержание найденного блока
				$fndBlockContent = $match[2];

				// добавление блока в глобальный список блоков
				$this->_addBlock($fndBlockName, $fndBlockContent);

				// добавление потомка - найденного блока к текущему блоку
				$this->_addChild($crntBlockName, $fndBlockName);

				// поиск блоков в блоке потомке
				$this->_buildBlock($fndBlockName);

				// очистка содержания блока потомков в текущем блоке
				$this->_clearBlockContent($crntBlockName, $fndBlockName);
			}
		}
	}

	function _parseBlock($crntBlockName)
	{
		if (!empty($this->_children[$crntBlockName]))
		{

			// потомки текущего блока
			$children = $this->_children[$crntBlockName];

			// просмотр потомков текущего блока
			reset($children);
			foreach($children AS $childName => $val)
				// парсинг блока потомка в случае наличия в нем потомков
				if (!empty($this->_children[$childName]))
					$this->_parseBlock($childName);

			// определяем пропарсен ли блок принудительно
			if (!empty($this->_parsed[$crntBlockName])) $parsed = true;
			else
			{
				// определяем пропарсен ли хотя бы один потомок
				$parsed = false;
				reset($children);
				foreach($children AS $childName => $val)
					if (!empty($this->_parsed[$childName]))
					{
						$parsed = true;
						break;
					}
			}

			// если пропарсен хотя бы один потомок или парсинг был вызван принудительно, то парсим данный блок
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

					// заменяем дочерний блок пропарсенным
					$this->_parsed[$crntBlockName] = preg_replace('@<!--\s+BEGIN\s+'. $childName. '\s+-->(.*)<!--\s+END\s+' . $childName . '\s+-->@sm',
						$parseContent, $this->_parsed[$crntBlockName]);

					// очищаем дочерний пропарсенный блок
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

		// парсинг переменных
		if (!empty($variables))
		{
			foreach($variables AS $var => $value)
				$this->_parsed[$block] = preg_replace('@{' . $var . '}@sm', $value, $this->_parsed[$block]);
		}

		// удаление неиспользуемых переменных
		if (preg_match_all($this->_varRegExp, $this->_parsed[$block], $regs, PREG_SET_ORDER))
		{
			foreach ($regs as $k => $match)
				$this->_parsed[$block] = preg_replace('@{' . $match[1] . '}@sm', '', $this->_parsed[$block]);
		}
	}

	function loadTemplateFile($filename, $parentBlockName = '')
	{
		// чтение файла шаблона
		$content = $this->_getFile($this->_root . "/" . $filename);

		if (empty($this->_blocks))
		{
			// создание глобального блока _INIT
			$this->_addBlock('_INIT', $content);

			// построение структуры блоков
			$this->_buildBlock('_INIT');
		}
		elseif (empty($parentBlockName))
		{
			// создание временного блока _TEMP
			$this->_addBlock('_TEMP', $content);

			// построение структуры блоков
			$this->_buildBlock('_TEMP');

			// удаление временного блока
			$this->_deleteBlock('_TEMP');
		}
		else
		{
			// построение структуры блоков
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