<?
class cModReviews
{
	function Init()
	{
		tplLoadTemplateFile('reviews.tpl');
	}
	
	function show()
	{
		$review_list = new cReviewList();
		$list = $review_list->getList();
		$i = 0;
		$count = sizeof($list);
		foreach ($list as $review_id => $review)
		{
			$i++;
			if ($i>1) tplParseBlock('listing_item_up', array(
				'ID' => $review_id
			));
			if ($i<$count) tplParseBlock('listing_item_down', array(
				'ID' => $review_id
			));
			if ($review->info['visible']=='1') tplParseBlock('listing_item_visible', array(
				'ID' => $review_id
			));
			else tplParseBlock('listing_item_nvisible', array(
				'ID' => $review_id
			));
			tplParseBlock('listing_item', array(
				'ID' => $review_id,
				'NAME' => $review->info['name']
			));
		}
	
		tplParseBlock('listing');
	}

    function showForm()
    {
		$review_id = getInt('id');

        if ($review_id)
        {
			$review = new cReview($review_id);
			$review->loadAll();
	    	tplParseBlock('review_edit');

	    	tplParseBlock('review', array(
	    		'ID' => $review_id,
	    		'NAME' => _htmlspecialchars($review->info['name'],ENT_QUOTES),
	    		'TEXT' => _htmlspecialchars($review->info['text'],ENT_QUOTES),
				'SOCIAL' => _htmlspecialchars($review->info['social'],ENT_QUOTES),
				'VISIBLE' => ($review->info['visible'] == "1") ? "checked" : "",
				'IMG' => ($review->info['img']!='') ? '<div class="small">Уже есть. Можно <a target="_blank" href="/templates/images/reviews/'.$review->info['img'].'" class="small_link">посмотреть</a> или <a href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=delimg&el=img&id='.$review_id.'" class="small_link" onclick="if (!confirm(\'Удалить?\')) return false;">удалить</a>.</div>' : '',
				'HOST' => HOST
    		));
        }
        else
        {
	    	tplParseBlock('review_new');
	    	tplParseBlock('review',array(
				'VISIBLE'=> "checked",
				'HOST' => HOST
			));
		}
    }

    function submit()
    {
		GLOBAL $mysqli;
		
		$img = uploadi($_FILES["img"]["tmp_name"],$_FILES["img"]["name"],$_SERVER["DOCUMENT_ROOT"]."/templates/images/reviews/");
    	$review_id = getInt('id');
        $review = new cReview($review_id);
		$review->info["name"]=getVar("name");
		$review->info["text"]=getVar("text");
		$review->info["social"]=getVar("social");
		$review->info["visible"]=getBool("visible");
		if ($img) $review->info["img"] = $img;
		if (!$review_id) $review->buildIncOrdernum();
		$review->save();

		if ($review_id>0) header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=edit&id=".$review->id);
		else header ("Location: /mss0fovnwli9zqf1xpbua/index.php?page=reviews");
    }
	
    function vis()
    {
		GLOBAL $mysqli;
		
    	$review_id=getInt('id');
        $review=new cReview($review_id);
		$review->loadAll();
		$review->info["visible"] = "1";
		$review->save();		
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }
	
    function nvis()
    {
		GLOBAL $mysqli;
		
    	$review_id=getInt('id');
        $review= new cReview($review_id);
		$review->loadAll();
		$review->info["visible"] = "0";
		$review->save();
		header ("Location: ".$_SERVER['HTTP_REFERER']);
    }		

    function del()
    {
		GLOBAL $mysqli;
		
    	$review_id=getInt('id');
    	$review=new cReview($review_id);
		$review->loadAll();
    	$review->del();
    	header ("Location: ".$_SERVER['HTTP_REFERER']);
    }
	
    function delimg()
    {
    	$review_id=getInt('id');
        $review= new cReview($review_id);
		$review->info[$_GET["el"]] = '';
		$review->save();
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
					up($_GET["id"],TABLE_REVIEWS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
				case "down":
					down($_GET["id"],TABLE_REVIEWS,"","");
					header("Location: ".$_SERVER['HTTP_REFERER']);
				break;
        	    case "submit":$this->submit();break;
        	}
		}
		else $this->show();
    }
}
?>