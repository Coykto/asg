<!-- BEGIN block_center -->
  <main class="main-page">
    <div class="breadcrumb">
      <div class="uk-container uk-container-xlarge">
        <div class="breadcrumb__inner">
          <ul class="uk-breadcrumb">
            <li><a href="{HOST}">Главная</a></li>
            <li><span>{NAME}</span></li>
          </ul>
          <form class="uk-search uk-search-default" method="post" action="/search/"><span class="uk-search-icon-flip" uk-search-icon=""></span><input class="uk-search-input" type="search" placeholder="Поиск услуг" name="word"></form>
        </div>
      </div>
    </div>
    <div class="projects">
      <div class="projects__filter">
        <div class="filter-items uk-container uk-container-small projects-filter-tags">
          <ul class="projects-filter-list">
<!-- BEGIN tagall -->
            <li<!-- BEGIN tagall_a --> class="uk-active"<!-- END tagall_a -->><a class="projects-filter-list__item" href="{HOST}{CPU}/"><span class="projects-filter-list__icon">#</span><span class="projects-filter-list__title">все</span><span class="projects-filter-list__numb">{COU}</span></a></li>
<!-- END tagall -->
<!-- BEGIN tag -->
            <li<!-- BEGIN tag_a --> class="uk-active"<!-- END tag_a -->><a class="projects-filter-list__item" href="{HOST}{CPU}/"><span class="projects-filter-list__icon">#</span><span class="projects-filter-list__title">{NAME}</span><span class="projects-filter-list__numb">{COU}</span></a></li>
<!-- END tag -->
          </ul>
        </div><button class="uk-button uk-button-danger filter-btn" type="button" data-uk-toggle="target: .filter-items; animation: uk-animation-scale-up">Все тэги<span data-uk-icon="chevron-down"></span></button>
        <div class="filter-items uk-container uk-container-xlarge projects-filter-columns" hidden>
          <div class="projects-filter-list-links">
<!-- BEGIN tagall1 -->
			<a href="{HOST}{CPU}/"><span class="projects-filter-list-link__content"><span>Все</span><span class="projects-filter-list-link__numb">{COU}</span></span></a>
<!-- END tagall1 -->
<!-- BEGIN tag1 -->
			<a href="{HOST}{CPU}/"><span class="projects-filter-list-link__content"><span>{NAME}</span><span class="projects-filter-list-link__numb">{COU}</span></span></a>
<!-- END tag1 -->
		  </div>
        </div>
      </div>
      <div class="projects__content">
<!-- BEGIN items -->
        <div class="projects-filter-gallery" data-uk-lightbox>
<!-- BEGIN item -->
          <div class="uk-cover-container filter-item-{I}"><a data-caption="{NAME}" href="/templates/images/tree/{IMG}"><img src="/templates/images/tree/{SIMG}" alt="" data-uk-cover></a></div>
<!-- END item -->
        </div>
<!-- END items -->
      </div>
    </div>
  </main>
<!-- END block_center -->