<!-- BEGIN block_center -->

<!-- BEGIN listing -->
  <main class="main-page">
    <div class="breadcrumb">
      <div class="uk-container uk-container-xlarge">
        <div class="breadcrumb__inner">
          <ul class="uk-breadcrumb">
            <li><a href="{HOST}">Главная</a></li>
<!-- BEGIN listing_bread -->
            <li><a href="{HOST}{CPU}/">{NAME}</a></li>
<!-- END listing_bread -->
            <li><span>{NAME}</span></li>
          </ul>
          <form class="uk-search uk-search-default" method="post" action="/search/"><span class="uk-search-icon-flip" uk-search-icon=""></span><input class="uk-search-input" type="search" placeholder="Поиск услуг" name="word"></form>
        </div>
      </div>
    </div>
    <div class="blog-list">
      <div class="uk-section-small uk-container uk-container-xlarge">
        <div class="uk-grid uk-grid-small" data-uk-grid>
<!-- BEGIN listing_item -->
          <div class="uk-width-1-{TWOFOUR}@l uk-width-1-2@m uk-width-1-2@s">
            <div class="uk-card">
              <div class="uk-card-media-top uk-cover-container uk-height-medium">
				<a class="uk-display-block" href="{HOST}{CPU1}/{CPU2}/">
					<img src="/templates/images/articles/{IMG}" alt="" data-uk-cover>
				</a>
			  </div>
              <div class="uk-card-body">
                <div class="uk-card-date">{DATE}</div>
                <div class="uk-card-title"><a href="{HOST}{CPU1}/{CPU2}/">{NAME}</a></div>
                <div class="uk-card-text">{TEXTSMALL}</div>
                <div class="uk-text-meta">{TAGS}</div>
              </div>
            </div>
          </div>
<!-- END listing_item -->
        </div>
      </div>
    </div>
  </main>
<!-- END listing -->

<!-- BEGIN open -->
  <main class="main-page">
    <div class="breadcrumb">
      <div class="uk-container uk-container-xlarge">
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
<!-- BEGIN open_img -->
    <section class="section-hero section-hero--service">
      <div class="section-hero__banner">
        <div class="section-hero__bg uk-visible@s" style="background-image: url(/templates/images/articles/{IMG2})"></div>
		<div class="section-hero__bg uk-hidden@s" style="background-image: url(/templates/images/articles/{IMG2_MOBILE})"></div>
        <div class="uk-section-small uk-container uk-container-xlarge">
          <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-2@m uk-width-2-3">
              <div class="section-hero__content">
                <h1 class="section-hero__title">{NAME1}</h1>
              </div>
            </div>
            <div class="uk-visible@m"></div>
          </div>
        </div>
      </div>
    </section>
<!-- END open_img -->
    <article class="uk-margin-medium-top article">
      <div class="article__desc">
        <div class="uk-section uk-container" style="padding-top: 0px;">
          {TEXT}
        </div>
      </div>
<!-- BEGIN open_gal -->
      <div class="article__gallery">
        <div class="gallery-grid-container<!-- BEGIN open_gal_scheme --> gallery-grid-container-{I}<!-- END open_gal_scheme -->" data-uk-lightbox>
<!-- BEGIN open_gal_item -->
          <div class="uk-cover-container gallery-{I}"><a href="/templates/images/articles/{IMG}"><img src="/templates/images/articles/{SIMG}" alt="" data-uk-cover></a></div>
<!-- END open_gal_item -->
        </div>
      </div>
<!-- END open_gal -->
<!-- BEGIN open_sub -->
      <div class="article__services bg-grey">
        <div class="uk-section-small uk-container">
          <div class="section-title section-title--center">
            <h3>Услуги, о которых идет речь в этом проекте</h3>
          </div>
          <div class="section-content">
            <div tabindex="-1" uk-slider="">
              <div class="uk-position-relative">
                <ul class="uk-slider-items uk-child-width-1-1 uk-grid uk-grid-small uk-child-width-1-2@s uk-child-width-1-2@m uk-child-width-1-3@l">
<!-- BEGIN open_sub_item -->
                  <li>
                    <div class="article-services-item">
						<a class="article-services-item__link" href="{HOST}{CPU}/">
							<img class="article-services-item__img" src="/templates/images/tree/{IMG4}" alt="">
							<span class="article-services-item__title">{NAME}</span>
							<span class="article-services-item__text">{TEXTSMALL}</span>
						</a>
					</div>
                  </li>
<!-- END open_sub_item -->
                </ul>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- END open_sub -->
    </article>
  </main>
<!-- END open -->

<!-- END block_center -->