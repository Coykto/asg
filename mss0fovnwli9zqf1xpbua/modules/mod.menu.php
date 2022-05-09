<?
class cModMenu
{
	function Init()
	{
   		tplLoadTemplateFile('menu.tpl');
	}

	function show()
	{
		$main_menu = array(
			array('page' => 'tree', 'name' => 'Структура сайта', 'in' => '31', 'sub' => '' ),
			array('page' => 'services', 'name' => 'Меню', 'in' => '31', 'sub' => '' ),
			array('page' => 'gallerys', 'name' => 'Галерея', 'in' => '31', 'sub' => '' ),
			array('page' => 'stocks', 'name' => 'Акции', 'in' => '31', 'sub' => '' ),
//			array('page' => 'releases', 'name' => 'Блоки под баннером', 'in' => '31', 'sub' => '' ),
			array('page' => 'articles', 'name' => 'Блог', 'in' => '31', 'sub' => '' ),
//			array('page' => 'dailys', 'name' => 'Проекты', 'in' => '31', 'sub' => '' ),
			array('page' => 'videos', 'name' => 'Сотрудники', 'in' => '31', 'sub' => '' ),
//			array('page' => 'reviews', 'name' => 'Отзывы', 'in' => '31', 'sub' => '' ),
//			array('page' => 'maintexts', 'name' => 'Стоимость потолков', 'in' => '31', 'sub' => '' ),
			array('page' => 'partners', 'name' => 'Партнеры', 'in' => '31', 'sub' => '' ),
			array('page' => 'sliders', 'name' => 'Дипломы', 'in' => '31', 'sub' => '' ),
//			array('page' => 'specializations', 'name' => 'Характеристики товаров', 'in' => '31', 'sub' => '' ),
			array('page' => 'settings', 'name' => 'Настройки', 'in' => '26', 'sub' => '&group_id=1' ),
			array('page' => 'settings', 'name' => 'Доступ', 'in' => '02', 'sub' => '&group_id=3' )	
		);
		
		foreach ($main_menu as $menu)
		{
			if ( ($menu['page'] == $_GET["page"]) && ( (!isset($_GET["group_id"])) || ( (isset($_GET["group_id"])) && ($menu['sub']=='&group_id='.$_GET['group_id']) ) ) )
			tplParseBlock('menu_item_a');
			
           	tplParseBlock('menu_item', array(
				'NAME' => $menu['name'],
				'PAGE' => $menu['page'].$menu['sub'],
				'IN' => $menu['in']
            ));
		}
		tplParseBlock('menu');
	}

   	function Run()
   	{
		$this->show();
   	}
}
?>
