<!-- BEGIN block_center -->
  <main class="main-page">
    <div class="breadcrumb">
      <div class="uk-container">
        <div class="breadcrumb__inner">
          <ul class="uk-breadcrumb">
            <li><a href="{HOST}">Главная</a></li>
            <li><a href="{HOST}{CPU1}/">{NAME1}</a></li>
            <li><span>{NAME}</span></li>
          </ul>
          <form class="uk-search uk-search-default" method="post" action="/search/"><span class="uk-search-icon-flip" uk-search-icon=""></span><input class="uk-search-input" type="search" placeholder="Поиск услуг" name="word"></form>
        </div>
      </div>
    </div>
    <section class="category-items">
      <div class="uk-section-small uk-container">
        <div class="section-title section-title--center">
          <h1>{H1}</h1>
        </div>
        <div class="section-content">
<!-- BEGIN chars -->
          <ul class="projects-filter-list">
            <li class="uk-active"><a class="projects-filter-list__item" href="javascript:void(0)"><span class="projects-filter-list__icon">#</span><span class="projects-filter-list__title">все</span><span class="projects-filter-list__numb">{COUNT}</span></a></li>
<!-- BEGIN char -->
            <li><a class="projects-filter-list__item" href="javascript:void(0)" data-id="{ID}"><span class="projects-filter-list__icon">#</span><span class="projects-filter-list__title">{NAME}</span><span class="projects-filter-list__numb">{COUNT}</span></a></li>
<!-- END char -->
          </ul>
<!-- END chars -->
          <div class="uk-margin-medium-top uk-grid uk-child-width-1-3@m uk-child-width-1-2@s" data-uk-grid>
<!-- BEGIN item -->
            <div class="char {CLASS}">
              <div class="category-item category-item--custome">
                <div class="category-item__media"><a class="category-item__link" href="{HOST}{CPU}/"><img class="category-item__img" src="/templates/images/tree/{IMG}" alt="" /></a></div>
                <div class="category-item__title">{NAME}</div>
                <div class="category-item__tags"><!-- BEGIN item_tag --><a href="{HOST}{CPU}/#char-{ID}"># {NAME} ({COUNT})</a> <!-- END item_tag --></div>
              </div>
            </div>
<!-- END item -->
          </div>
        </div>
      </div>
    </section>
	{BLOCK3}
    <section class="content-block">
      <div class="uk-section-small uk-container">
		{TEXT}
      </div>
    </section>
<!-- BEGIN price -->
    <section class="instrument">
      <div class="uk-section uk-container">
        <div class="section-title section-title--center">
          <h3>{NAME}</h3>
        </div>
        <div class="section-content">
          <div data-uk-slider="">
            <div class="uk-position-relative">
              <div class="uk-slider-container">
                <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m">
<!-- BEGIN price_item -->
                  <li>
                    <div class="slider-item">
                      <div class="slider-item__media"><a class="slider-item__link" href="{HOST}{CPU}/"><img class="slider-item__img" src="/templates/images/tree/{IMG}" alt="" /></a></div>
                      <div class="slider-item__title">{NAME}</div>
<!-- BEGIN price_item_cat -->
                      <div class="slider-item__category"><span>Все товары категории</span><br/><a href="{HOST}{CPU}/">{NAME}</a></div>
<!-- END price_item_cat -->
                    </div>
                  </li>
<!-- END price_item -->
                </ul>
              </div>
              <div class="uk-visible@l"><a class="uk-position-center-left-out uk-position-small" href="#" data-uk-slidenav-previous="" data-uk-slider-item="previous"></a><a class="uk-position-center-right-out uk-position-small" href="#" data-uk-slidenav-next="" data-uk-slider-item="next"></a></div>
            </div>
            <div class="uk-hidden@l">
              <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"></ul>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- END price -->
	{BLOCK6}
	{BLOCK7}
	{BLOCK4}
	{MAP}
  </main>
<!-- END block_center -->