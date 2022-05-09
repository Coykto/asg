<!-- BEGIN block_center -->
  <main class="main-page">
    <div class="breadcrumb">
      <div class="uk-container uk-container-xlarge">
        <div class="breadcrumb__inner">
          <ul class="uk-breadcrumb">
            <li><a href="{HOST}">Главная</a></li>
            <li><span>{NAME}</span></li>
          </ul>
          <form class="uk-search uk-search-default" method="post" action="/search/"><span class="uk-search-icon-flip" uk-search-icon=""></span><input class="uk-search-input" type="search" placeholder="Поиск услуг" name="word" value="{WORD}"></form>
        </div>
      </div>
    </div>
    <article class="uk-margin-medium-top article">
      <div class="article__desc">
        <div class="uk-section uk-container" style="padding-top: 0px;">
			<h1>{H1}</h1>
					<p>Результаты поиска <b>"{WORD}"</b></p>
					<br>
<!-- BEGIN error -->
<p>Введите минимум два символа.</p>
<!-- END error -->
<!-- BEGIN item -->
<a href="{HOST}{CPU}/">{NAME}</a><br>
<!-- END item -->
        </div>
      </div>
    </article>
  </main>
<!-- END block_center -->