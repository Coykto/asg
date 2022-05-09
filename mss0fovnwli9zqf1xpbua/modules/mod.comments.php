<?
class cModComments
{
	function Init()
	{
		tplLoadTemplateFile('comments.tpl');
	}
	
	function show()
	{
		$comment_list = new cCommentList();
		$comment_list->setFilter(array(
			FILTER_ITEM => getInt('id')
		));
		$list = $comment_list->getList();
		foreach ($list as $comment_id => $comment)
		{
			if ($comment->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $comment_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $comment_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $comment_id,
				'DATE' => date("d.m.Y",$comment->info['date']),
				'ANSWER_DATE' => date("d.m.Y",$comment->info['answer_date']),
				'NAME' => $comment->info['name'],
				'ANSWER' => $comment->info['answer'],
				'TEXT' => $comment->info['text']
			));
		}
	
		tplParseBlock('listing', array(
			'ID' => getInt('id'),
			'CID' => printSelect('cid', "SELECT id, name FROM ".TABLE_ARTICLES." ORDER BY date DESC", getInt('id'),'<option value="0">Выберите статью</option>',' onchange="location.href=\'/mss0fovnwli9zqf1xpbua/index.php?page=comments&id=\'+this.value"')
		));
	}

    function showForm()
    {
		$comment_id = getInt('id');
		$cid = getInt('cid');

        if ($comment_id)
        {
			$comment = new cComment($comment_id);
			$comment->loadAll();
	    	tplParseBlock('comment_edit');
			
	    	tplParseBlock('comment', array(
	    		'ID' => $comment_id,
	    		'NAME' => _htmlspecialchars($comment->info['name'],ENT_QUOTES),
	    		'TEXT' => _htmlspecialchars($comment->info['text'],ENT_QUOTES),
				'PHONE' => _htmlspecialchars($comment->info['phone'],ENT_QUOTES),
				'EMAIL' => _htmlspecialchars($comment->info['email'],ENT_QUOTES),
				'IP' => $comment->info['ip'],
				'ANSWER' => _htmlspecialchars($comment->info['answer'],ENT_QUOTES),
				'ANSWER_SHOW' => ($comment->info['answer_show'] == "1") ? "checked" : "",
				'VISIBLE' => ($comment->info['visible'] == "1") ? "checked" : "",
				'DATE' => date("d.m.Y",$comment->info['date']),
				'ANSWER_DATE' => ($comment->info['answer_date']>0) ? date("d.m.Y",$comment->info['answer_date']) : '',
				'CID' => printSelect('cid', "SELECT id, name FROM ".TABLE_ARTICLES." ORDER BY name", $comment->info['cid'],'<option value="0">Выберите статью</option>',''),
				'HOST' => HOST
    		));
        }
        else
        {
	    	tplParseBlock('comment_new');
	    	tplParseBlock('comment',array(
				'DATE' => date("d.m.Y"),
				'VISIBLE'=> "checked",
				'cid' => printSelect('doctor', "SELECT id, name FROM ".TABLE_ARTICLES." ORDER BY name", $cid,'<option value="0">Выберите статью</option>',''),
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		
		$date=getVar("date");
		$answer_date=getVar("answer_date");
    	$comment_id=getInt('id');
        $comment= new cComment($comment_id);
		if ($comment_id>0) $comment->loadAll();
		$comment->info["name"]=getVar("name");
		$comment->info["text"]=getVar("text");
		$comment->info["phone"]=getVar("phone");
		$comment->info["email"]=getVar("email");
		$comment->info["answer"]=getVar("answer");
		$comment->info["visible"]=getBool("visible");
		$comment->info["answer_show"]=getBool("answer_show");
		$comment->info["date"]=mktime(date("H"),date("i"),date("s"),substr($date,3,2),substr($date,0,2),substr($date,6,4));
		$comment->info["answer_date"]= ($answer_date!='') ? mktime(date("H"),date("i"),date("s"),substr($answer_date,3,2),substr($answer_date,0,2),substr($answer_date,6,4)) : 0;
		$comment->info["cid"]=getInt("cid");
		$comment->save();
		
		if ($comment_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=comments&action=edit&id=".$comment->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=comments");
    }
	
    function vis()
    {
    	$comment_id=getInt('id');
        $comment= new cComment($comment_id);
		$comment->info["visible"] = "1";
		$comment->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }	
	
    function nvis()
    {
    	$comment_id=getInt('id');
        $comment= new cComment($comment_id);
		$comment->info["visible"] = "0";
		$comment->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
    	$comment_id=getInt('id');
    	$comment=new cComment($comment_id);
    	$comment->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }

    function delimg()
    {
    	$comment_id=getInt('id');
        $comment= new cComment($comment_id);
		$comment->info[$_GET["el"]] = '';
		$comment->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function Run()
    {
		if (isset($_REQUEST['action']))
		{
        	switch ($_REQUEST['action'])
        	{
	            case "delimg":$this->delimg();break;
	            case "edit":$this->showForm();break;
        	    case "new":$this->showForm();break;
	            case "delete":$this->del();break;
				case "visible":$this->vis();break;
				case "nvisible":$this->nvis();break;
				case "up":
					up($_GET["id"],TABLE_COMMENTS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_COMMENTS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>