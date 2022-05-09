<?
class cPages
{
	var $total_items_count;
	var $per_page;
	var $url_pattern;
	var $template_file;

	//for search
	var $in_user;
	var $in_comm;
	var $in_ann;

	var $vars = array();

	function __construct($tpl='pages')
	{
		//$this->template_file = $tpl;
		tplloadTemplateFile($tpl . '.tpl');

		$this->vars['NODE_ID'] = getVar('node_id'); 
		$this->vars['GENRE_ID'] = getVar('genre_id'); 
	}

	function buildUrl($page)
	{
		$href = $this->url_pattern;
		foreach ($this->vars AS $key=>$value)
			$href = str_replace('%'. $key .'%', $value, $href);
		$href = str_replace('%PAGE%', $page, $href);
		return $href;
	}

	function isShowPages($curr_page,$page,$amount_pages)
	{
		if ($amount_pages > 1 AND $amount_pages < 100) 
		{
			if ($page > $curr_page-4 AND $page < $curr_page+4) return true;
			if (($page < 2 AND $curr_page > 2) OR ($page > $amount_pages-1 AND $curr_page < $amount_pages-1))  return true;
		}
		else return true;
	}

	function parse($block, $form='standart')
	{
		$amount_pages = ceil($this->total_items_count/$this->per_page);
		$page = getInt('pg',1);

		if ($amount_pages > 1)
		{
			$prev_showed=false;
			for ($i=1; $i<=$amount_pages; $i++)
			{
				if ($this->isShowPages($page,$i,$amount_pages))
				{
					if ($i != $page)
					{
						if ($form=='standart')
						{
							tplParseBlock($block.'_unselected', array(
								'HREF' => $this->buildUrl($i),
								'PAGE' => $i,
								));
						}
						elseif ($form=='search')
						{
							tplParseBlock($block.'_unselected', array(
								'STR' => getVar('query'),
								'PAGE' => $i,
								'IN_USER' => $this->in_user,
								'IN_COMMENT' => $this->in_comm,
								'IN_ANNOUNCE' => $this->in_ann,
							));
						}
					}
					else tplParseBlock($block.'_selected', array('PAGE' => $i));
					$prev_showed=true;
				}
				else 
				{
					if ($prev_showed)
						tplParseBlock($block.'_separator');
					$prev_showed=false;
				}

				tplParseBlock($block.'_page');
			}

			if ($page>1)
			{
				if ($form=='standart')
				{
					tplParseBlock($block.'_prev', array(
						'HREF' => $this->buildUrl($page-1),
						'PAGE' => $page-1,
						));
				}
				elseif ($form=='search')
				{
					tplParseBlock($block.'_prev', array(
						'STR' => getVar('query'),
						'PAGE' => $page-1,
						'IN_USER' => $this->in_user,
						'IN_COMMENT' => $this->in_comm,
						'IN_ANNOUNCE' => $this->in_ann,
						));
				}
			}
			else tplParseBlock($block.'_unactiv_prev');

			if ($page<$amount_pages)
			{
				if ($form=='standart')
				{
					tplParseBlock($block.'_next', array(
						'HREF' => $this->buildUrl($page+1),
						'PAGE' => $page+1,
						));
				}
				elseif ($form=='search')
				{
					tplParseBlock($block.'_next', array(
						'STR' => getVar('query'),
						'PAGE' => $page+1,
						'IN_USER' => $this->in_user,
						'IN_COMMENT' => $this->in_comm,
						'IN_ANNOUNCE' => $this->in_ann,
						));
				}
			}
			else tplParseBlock($block.'_unactiv_next');

			tplParseBlock($block, array(
				'VIEWS_ITEMS' => ($this->per_page*($page-1)+1) .'-'. ($this->per_page*$page),
				'ALL_ITEMS' => $this->total_items_count));
		}
	}
}
?>