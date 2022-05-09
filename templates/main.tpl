<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
	<title>{PAGE_TITLE}</title>
	<meta name="keywords" content="{PAGE_KEYWORDS}">
	<meta name="description" content="{PAGE_DESCRIPTION}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="HandheldFriendly" content="true">
  <meta name="format-detection" content="telephone=no">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/libs.min.css">
  <link rel="stylesheet" href="/assets/css/main.css?x=22122232">
</head>
<body class="page-home">
  <header class="header-page">
    <div class="header-page__scroll" data-uk-sticky>
      <div class="uk-container uk-container-xlarge">
        <div class="header-page__inner">
          <div class="header-page__left">
            <div class="header-page__logo logo"><a class="logo__link" href="{HOST}"><img class="logo__img" src="/assets/images/logo.png" alt="рекламное производство"><span class="logo__text">рекламное производство</span></a></div>
			<div class="header-page__nav">
<!-- BEGIN menu1 --><!-- END menu1 -->
			</div>
          </div>
          <div class="header-page__right">
            {HEADER}
          </div>
        </div>
      </div>
      <div class="header-page__menu">
        <div class="uk-container uk-container-xlarge">
          <div class="header-page__btn-menu"><a href="#offcanvas" data-uk-toggle><span class="title">Меню</span><span data-uk-icon="menu"></span></a></div>
        </div>
      </div>
    </div>
  </header>
<!-- BEGIN block_center --><!-- END block_center -->
  <footer class="footer-page">
	{FOOTER}
    <div id="offcanvas" uk-offcanvas="overlay: true">
      <div class="uk-offcanvas-bar"><button class="uk-offcanvas-close" type="button" uk-close=""></button>
        <div class="uk-margin">
          <div class="logo"><a class="logo__link" href="/"><img class="logo__img" src="/assets/images/logo.png" alt="рекламное производство"><span class="logo__text">рекламное производство</span></a></div>
        </div>
        <hr>
<!-- BEGIN menu2 --><!-- END menu2 -->
        <hr>
		{MOBILE_CONTACT}
      </div>
    </div>
    <div class="uk-flex-top" id="callback" uk-modal="">
      <div class="uk-modal-dialog uk-margin-auto-vertical"><button class="uk-modal-close-default" type="button" uk-close=""></button>
        <form action="" onsubmit="return false;" id="callback-form">
          <div class="uk-modal-header">
            <h3 class="uk-modal-title callback-name" style="text-transform:uppercase;text-align: center;">Обратный звонок</h3>
          </div>
          <div class="uk-modal-body">
            <div class="uk-margin"><input class="uk-input" type="text" name="name" placeholder="Ваше имя"></div>
            <div class="uk-margin"><input class="uk-input" type="text" name="phone" placeholder="Ваш номер телефона*"></div>
            <div class="uk-margin"><input class="uk-input" type="text" name="email" placeholder="Ваш email"></div>
          </div>
          <div class="uk-modal-footer uk-text-right"><input class="uk-button uk-button-danger" type="submit" value="Отправить"></div>
        </form>
      </div>
    </div>
    <div class="uk-flex-top" id="callback-ok" uk-modal="">
      <div class="uk-modal-dialog uk-margin-auto-vertical"><button class="uk-modal-close-default" type="button" uk-close=""></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title" style="text-transform:uppercase;text-align: center;">Спасибо за обращение</h3>
          </div>
          <div class="uk-modal-body">
            <p style="text-align: center;">Мы свяжемся с Вами в ближайшее время.</p>
          </div>

      </div>
    </div>
  </footer>
  <script src="/assets/js/libs.js"></script>
  <script src="/assets/js/main.js?x=1"></script>
  <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(71579263, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/71579263" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn-ru.bitrix24.ru/b16028672/crm/site_button/loader_5_f30dhh.js');
</script>

</body>

</html>