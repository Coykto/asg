<?
class cTree extends cList
{
	var $nodes = array();
	var $filter = array();

	function __construct()
	{
		$this->className=get_class($this);
		$this->baseClass='cNode';
		$this->baseRootClass='cRootNode';
		$this->setOrder('ordernum', 'asc');
	}

	function load()
	{
		$this->nodes[TREE_ROOT_NODE_ID] = new $this->baseRootClass();
		$nodes = $this->getList();
		if (!empty($nodes)) $this->makeTree($this->nodes[TREE_ROOT_NODE_ID], $nodes);
	}

	function setFilter($filter=array())
   	{
	    foreach ($filter as $filter_id => $value)
	    {
	        switch ($filter_id)
	        {
 				case FILTER_VISIBLE: 
					$this->filter[] = "`visible`='".$value."'";
				break;

 				case FILTER_ITEM:
					$this->filter[] = " `parent_id`=".$value." ";
				break;
				
 				case FILTER_SEARCH:
					$this->filter[] = $value;
				break;
  			}
   		}
	}

	function makeTree(&$parent_node, $nodes)
	{
		foreach ($nodes as $node_id=>$node)
		{
			if ( (isset($node->info['parent_id'])) && ($node->info['parent_id'] == $parent_node->id) )
			{
				$this->nodes[$node_id] = $node;
				$this->nodes[$node_id]->parent_node = &$parent_node;
				$parent_node->children[$node_id] = &$this->nodes[$node_id];
				unset($nodes[$node_id]);
				$this->makeTree($this->nodes[$node_id], $nodes);
			}
		}
	}

	function getNode($id)
	{
		if (isset($this->nodes[$id])) return $this->nodes[$id];
	}

    function getRootNode()
    {
        return $this->nodes[TREE_ROOT_NODE_ID];
    }
	
	function getCpu($node)
	{
		if ($node->info['parent_id']==0) return $node->info['cpu'];
		return $this->getCpu($node->parent_node).'/'.$node->info['cpu'];
	}

	function getPathName($node)
	{
		if ($node->info['parent_id']==0) return $node->info['name'];
		return $this->getPathName($node->parent_node).' - '.$node->info['name'];
	}	
}

class cOrderedTree extends cTree
{
	var $ordernum_field="ordernum";
	function move($node_id,$direction)
	{
		$curr_node = $this->getNode($node_id);
        if ($curr_node->getBrothersCount()<2) return false;
    	if ($direction!="up" and $direction!="down") return false;
        if ($curr_node->isRoot()) return false;
		if ($this->isNodeLast($node_id) and $direction=="down") return false;
		if ($this->isNodeFirst($node_id) and $direction=="up") return false;
        $nodes = $curr_node->parent_node->children;
        $next_node = new $this->baseClass();
		$next_node->info['ordernum'] = 999999999999;
        $prev_node = new $this->baseClass();
		$prev_node->info['ordernum'] = 0;

        foreach ($nodes as $node)
        {
			if ($node->id!=$node_id)
			{
				if ($node->info[$this->ordernum_field] > $curr_node->info[$this->ordernum_field] and
					$node->info[$this->ordernum_field] < $next_node->info[$this->ordernum_field])
					$next_node = $node;
				if ($node->info[$this->ordernum_field] < $curr_node->info[$this->ordernum_field] and
					$node->info[$this->ordernum_field] > $prev_node->info[$this->ordernum_field])
					$prev_node = $node;
			}
		}

		$order=$curr_node->info[$this->ordernum_field];
        if ($direction=='up')
        {
            $curr_node->info[$this->ordernum_field]=$prev_node->info[$this->ordernum_field];
            $prev_node->info[$this->ordernum_field]=$order;
            $prev_node->save();
        }
        else
        {
            $curr_node->info[$this->ordernum_field]=$next_node->info[$this->ordernum_field];
            $next_node->info[$this->ordernum_field]=$order;
            $next_node->save();
        }
		$curr_node->save();
		return true;
	}

	function isNodeFirst($node_id)
    {
		$node = $this->getNode($node_id);
        if (!$node->isRoot())
        {
            foreach ($node->parent_node->children as $child)
			{
				if ($child->info['ordernum']<$node->info['ordernum'])
					return false;
			}
		}
        return true;
    }

    function isNodeLast($node_id)
    {
		$node = $this->getNode($node_id);
        if (!$node->isRoot())
        {
            foreach ($node->parent_node->children as $child)
                if ($child->info['ordernum']>$node->info['ordernum'])
                    return false;
        }
        return true;
    }

	function getMaxOrderNum($node_id)
	{
		$node = $this->getNode($node_id);
		$max=0;
		foreach ($node->children as $child_id=>$child)
		{
			if ($child->info[$this->ordernum_field] > $max)
				$max = $child->info[$this->ordernum_field];
		}
		return $max;
	}
}

class cRootNode extends cItem
{
	var $id = TREE_ROOT_NODE_ID;
	var $table = TABLE_TREE;
	var $items = array();
    var $params = array(
		array('name' => 'id'),
		array('name' => 'h1'),
		array('name' => 'ordernum'),
		array('name' => 'text'),
		array('name' => 'ptid'),
		array('name' => 'title'),
		array('name' => 'description'),
		array('name' => 'keywords'),
		array('name' => 'cpu'),
		array('name' => 'img'),
		array('name' => 'link'),
		array('name' => 'text1'),
		array('name' => 'text2'),
		array('name' => 'text3'),
		array('name' => 'parent_id'),
		array('name' => 'name'),
		array('name' => 'banner'),
		array('name' => 'banner_mobile'),
		array('name' => 'banner_text'),
		array('name' => 'textsmall'),
		array('name' => 'redlineimg1'),
		array('name' => 'redlinename1'),
		array('name' => 'redlinetext1'),
		array('name' => 'redlineimg2'),
		array('name' => 'redlinename2'),
		array('name' => 'redlinetext2'),
		array('name' => 'redlineimg3'),
		array('name' => 'redlinename3'),
		array('name' => 'redlinetext3'),
		array('name' => 'img1'),
		array('name' => 'img2'),
		array('name' => 'img3'),
		array('name' => 'img4'),
		array('name' => 'textsmall1'),
		array('name' => 'faq'),
		array('name' => 'newitem'),
		array('name' => 'cons_img'),
		array('name' => 'cons_text'),
		array('name' => 'bid'),
		array('name' => 'oid'),
		array('name' => 'blogname'),
		array('name' => 'blogscheme'),
		array('name' => 'ch_ids'),
		array('name' => 'visible')
	);
	var $paramsEx = array();

	var $info = array(
		'id' => TREE_ROOT_NODE_ID,
		'name' => TREE_ROOT_NODE_NAME,
		'ordernum' => 0,
	);

	var $children = array();
	var $attributes = array();

	function __construct()
	{
	}

	function getLevel()
	{
		return TREE_ROOT_NODE_LEVEL;
	}

	function getChildrenCount()
	{
		return count($this->children);
	}

	function isRoot()
	{
		return true;
	}
	
	function _isVisible($node)
	{
		if ($node->isRoot()) return true;
		return $node->info['visible'] ? $this->_isVisible($node->parent_node) : false;
	}	

	function isVisible()
	{
		return $this->_isVisible($this);
	}
}

class cNode extends cRootNode
{
	var $parent_node;

	function __construct($id=null)
	{
		$this->id = $id;
	}

	function getLevel()
	{
		$level = $this->parent_node->getLevel();
		return $level + 1;
	}

	function getBrothersCount()
	{
		return $this->parent_node->getChildrenCount();
	}

	function isRoot()
	{
		return false;
	}
}
?>