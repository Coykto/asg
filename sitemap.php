<?
header("Content-Type: text/xml");
header("Expires: Thu, 19 Feb 1998 13:24:18 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0");
header("Cache-Control: max-age=0");
header("Pragma: no-cache");

	error_reporting(E_ALL);	
	date_default_timezone_set('Greenwich');

	require "req.php";

	$tree=new cOrderedTree();
	$tree->setFilter(array(
		FILTER_VISIBLE => 1
	));
	$tree->load();

	$text = "";

	foreach ($tree->nodes as $node_id => $node)
	if ( ($node->info['name']!=TREE_ROOT_NODE_NAME) && ($node->info['ptid']!=2) && ($node->info['ptid']!=9) && ($node->info['ptid']!=20)  )
	{
		$cpu = $tree->getCpu($node);
		$text .= "
<url><loc>".HOST.$cpu."/</loc><lastmod>".date("Y-m-d")."T".date("H:i:sP")."</lastmod><changefreq>monthly</changefreq><priority>0.85</priority></url>";
		
		if ($node->info['ptid']==4)
		{
			$res = $mysqli->query("SELECT * FROM ".TABLE_ARTICLES." WHERE visible='1' ORDER BY ordernum DESC");
			while ($row = $res->fetch_array())
			{
				$text .= "
<url><loc>".HOST.$cpu."/".$row["cpu"]."/</loc><lastmod>".date("Y-m-d")."T".date("H:i:sP")."</lastmod><changefreq>monthly</changefreq><priority>0.85</priority></url>";
			}
		}
	}

print '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url><loc>'.HOST.'</loc><lastmod>'.date("Y-m-d").'T'.date("H:i:sP").'</lastmod><changefreq>daily</changefreq><priority>1</priority></url>
'.$text.'
</urlset>';
?>