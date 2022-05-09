<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>Панель управления сайтом.</title>
    <meta charset="utf-8">
    <link href="/mss0fovnwli9zqf1xpbua/templates/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&amp;amp;subset=cyrillic" rel="stylesheet">

    <script src="/mss0fovnwli9zqf1xpbua/templates/js/jquery-3.3.1.min.js"></script>
    <script src="/mss0fovnwli9zqf1xpbua/templates/js/bootstrap.bundle.min.js"></script>
    <script src="/mss0fovnwli9zqf1xpbua/templates/js/main.js"></script>
	<script src="/mss0fovnwli9zqf1xpbua/templates/js/js.js"></script>
	
	<script src="/js/jquery-ui-1.8.16.custom.min.js"></script>
	<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	<link rel="stylesheet" href="/css/pickmeup.css?x=1551557167" type="text/css" />
	<script type="text/javascript" src="/js/jquery.pickmeup.js?x=465214430"></script>
	<script type="text/javascript">
		$(function(){
			$('#tabs').tabs();			
			$('.calendar').pickmeup({
				position: 'right',
				hide_on_select	: true
			});
		});
	</script>
	
  </head>
  <body>
    <div class="page">
      <div class="page-sidebar">
<!-- BEGIN menu --><!-- END menu -->
      </div>
      <div class="page-container">
        <div class="page-container-title d-flex justify-content-between align-items-center"><a class="website-link" href="{HOST}" target="_blank">{HOST}</a><a class="logout-btn" href="/mss0fovnwli9zqf1xpbua/logout.php">Выйти</a></div>
<!-- BEGIN center --><!-- END center -->
      </div>
    </div>
  </body>
</html>