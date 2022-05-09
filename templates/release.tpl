<!-- BEGIN block_center -->
  <main class="main-page">
<!-- BEGIN hero -->
    <section class="section-hero section-hero--home">
      <div class="section-hero__banner section-hero__banner_h">
        <div class="uk-section-small uk-container uk-container-large" style="padding-top: 20px;">
          <div class="uk-grid uk-flex-middle" data-uk-grid>
            <div class="uk-width-1-2@m uk-width-2-3@s">
              <div class="section-hero__content">
				<img class="section-hero__img_h" src="/templates/images/tree/{BANNER}" alt="">
				<h1 class="section-hero__title">{H1}</h1>
                <p class="section-hero__subtitle">{BANNER_TEXT}</p>
                {SBANNER_TEXT}
              </div>
            </div>
            <div class="uk-width-1-2@m uk-width-1-3@s uk-text-right"><img class="section-hero__img" src="/templates/images/tree/{BANNER}" alt=""></div>
          </div>
        </div>
      </div>
<!-- BEGIN redline -->
      <div class="section-hero__numbers">
        <div class="uk-section-small uk-container uk-container-large">
          <div class="uk-grid uk-grid-small uk-flex-middle" data-uk-grid uk-height-match="target: > div>.hero-service-item">
<!-- BEGIN redline1 -->
            <div class="uk-width-1-3@m">
              <div class="hero-service-title">{NAME}</div>
            </div>
<!-- END redline1 -->
<!-- BEGIN redline2 -->
            <div class="uk-width-1-3@m uk-width-1-2@s">
              <div class="hero-service-item">
                <div class="hero-service-item__icon"><img src="/templates/images/tree/{IMG}" alt=""></div>
                <div class="hero-service-item__info">
                  <div class="hero-service-item__title">{NAME}</div>
                  <div class="hero-service-item__desc">{TEXT}</div>
                </div>
              </div>
            </div>
<!-- END redline2 -->
          </div>
        </div>
      </div>
<!-- END redline -->
    </section>
<!-- END hero -->
    <div class="breadcrumb">
      <div class="uk-container uk-container-large">
        <div class="breadcrumb__inner">
          <ul class="uk-breadcrumb">
            <li><a href="{HOST}">Главная</a></li>
            <li><span>{NAME}</span></li>
          </ul>
		  <form class="uk-search uk-search-default" method="post" action="/search/"><span class="uk-search-icon-flip" uk-search-icon=""></span><input class="uk-search-input" type="search" placeholder="Поиск услуг" name="word"></form>
        </div>
      </div>
	</div>
<!-- BEGIN items -->
    <section class="section-services-grid">
      <div class="uk-section-small uk-container uk-container-large">
        <div class="section-content">
          <div class="uk-grid uk-grid-small uk-child-width-1-6@l uk-child-width-1-4@m uk-child-width-1-3@s uk-child-width-1-2" data-uk-grid>
<!-- BEGIN item -->
            <div>
              <div class="services-grid-item">
				<a class="services-grid-item__link" href="{HOST}{CPU}/">
					<span class="services-grid-item__media">
						<img src="/templates/images/tree/{IMG}" alt="">
					</span>
					<span class="services-grid-item__title">{NAME}</span>
				</a>
			  </div>
            </div>
<!-- END item -->
          </div>
        </div>
      </div>
    </section>
<!-- END items -->
<!-- BEGIN text -->
    <section class="service-desc">
      <div class="uk-margin-top uk-container uk-container-large">
        {TEXT}
      </div>
    </section>
<!-- END text -->
<!-- BEGIN advantages -->
    <section class="service-plus">
      <div class="uk-section-small uk-container uk-container-large">
        <div class="uk-grid uk-child-width-1-3@m uk-child-width-1-2@s" data-uk-grid>
<!-- BEGIN advantages_item -->
          <div>
            <div class="service-plus-item">
              <div class="service-plus-item__icon"><img src="/templates/images/advantages/{IMG}" alt="{NAME}"></div>
              <div class="service-plus-item__info">
                <div class="service-plus-item__title">{NAME}</div>
                <div class="service-plus-item__desc">{TEXT}</div>
              </div>
            </div>
          </div>
<!-- END advantages_item -->
        </div>
      </div>
    </section>
<!-- END advantages -->
<!-- BEGIN text1 -->
    <section class="service-desc">
      <div class="uk-margin-top uk-container uk-container-large">
        {TEXT1}
      </div>
    </section>
<!-- END text1 -->
<!-- BEGIN blog -->
    <section class="section-blog">
      <div class="uk-section-small" style="padding-top:0px;">
        <div class="grid-blog<!-- BEGIN blog_scheme --> grid-blog-{I}<!-- END blog_scheme -->">
<!-- BEGIN blog_item -->
          <div class="blog-item blog-item-{I} uk-cover-container uk-inline-clip uk-transition-toggle">
			<img src="/templates/images/articles/{IMG}" alt="" class="uk-visible@s" data-uk-cover>
			<img src="/templates/images/articles/{IMGM}" alt="" class="uk-hidden@s" data-uk-cover>
			<a class="uk-transition-fade uk-overlay-primary uk-position-cover" href="{HOST}{CPU1}/{CPU2}/"></a>
			<a href="{HOST}{CPU1}/{CPU2}/">
				<div class="uk-transition-fade uk-overlay uk-position-center">
				<h4>{NAME}</h4>
				<p>{TEXTSMALL} (<span>подробнее в этом материале</span>)</p>
				</div>
			</a>
          </div>
<!-- END blog_item -->
        </div>
      </div>
    </section>
<!-- END blog -->
<!-- BEGIN text2 -->
    <section class="service-desc">
      <div class="uk-margin-top uk-container uk-container-large">
        {TEXT2}
      </div>
    </section>
<!-- END text2 -->
<!-- BEGIN people -->
    <section class="section-command">
      <div class="uk-section uk-container uk-container-xlarge">
        <div class="section-title section-title--center">
          <h3>Наши сотрудники</h3>
        </div>
        <div class="section-content">
          <div class="uk-visible@s">
            <div class="section-command-slider uk-slider-out-nav" tabindex="-1" uk-slider="">
              <div class="uk-position-relative">
                <ul class="uk-slider-items uk-child-width-1-2 uk-grid uk-grid-medium uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l">
<!-- BEGIN people_item1 -->
                  <li>
                    <div class="command-item">
                      <div class="command-item__media"><img src="/templates/images/videos/{IMG}" alt="{NAME}"></div>
                      <div class="command-item__name">{NAME}</div>
                      <div class="command-item__position">{TEXT}</div>
                    </div>
                  </li>
<!-- END people_item1 -->
                </ul>
              </div><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a>
            </div>
          </div>
          <div class="uk-hidden@s">
            <div class="section-command-slider uk-slider-out-nav" tabindex="-1" uk-slider="">
              <div class="uk-position-relative">
                <ul class="uk-slider-items uk-child-width-1-2 uk-grid uk-grid-small uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-5@l">
<!-- BEGIN people_item2 -->
<!-- BEGIN people_item21 -->
                  <li>
<!-- END people_item21 -->
                    <div class="command-item">
                      <div class="command-item__media"><img src="/templates/images/videos/{IMG}" alt="{NAME}"></div>
                      <div class="command-item__name">{NAME}</div>
                      <div class="command-item__position">{TEXT}</div>
                    </div>
<!-- BEGIN people_item22 -->
                  </li>
<!-- END people_item22 -->
<!-- END people_item2 -->
<!-- BEGIN people_item222 -->
                  </li>
<!-- END people_item222 -->
                </ul>
              </div><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- END people -->
<!-- BEGIN partner -->
    <section class="section-partners">
      <div class="uk-section uk-container uk-container-xlarge">
        <div class="section-title section-title--center">
          <h3 hidden>Наши партнеры</h3>
        </div>
        <div class="section-content">
          <div class="uk-visible@s">
            <div class="section-partners-slider uk-slider-out-nav" tabindex="-1" uk-slider="">
              <div class="uk-position-relative">
                <ul class="uk-slider-items uk-child-width-1-2 uk-grid uk-grid-small uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-6@l">
<!-- BEGIN partner_item1 -->
                  <li><a class="partner-link" <!-- BEGIN partner_item1_na -->href="javascript:void(0)" <!-- END partner_item1_na --><!-- BEGIN partner_item1_a -->href="{LINK}" target="_blank"<!-- END partner_item1_a -->><img src="/templates/images/partners/{IMG}" alt=""></a></li>
<!-- END partner_item1 -->
                </ul>
              </div><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a>
            </div>
          </div>
          <div class="uk-hidden@s">
            <div class="section-partners-slider uk-slider-out-nav" tabindex="-1" uk-slider="">
              <div class="uk-position-relative">
                <ul class="uk-slider-items uk-child-width-1-2 uk-grid uk-grid-small uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-6@l">
<!-- BEGIN partner_item2 -->
<!-- BEGIN partner_item21 -->
                  <li>
<!-- END partner_item21 -->
					<a class="partner-link" <!-- BEGIN partner_item2_na -->href="javascript:void(0)" <!-- END partner_item2_na --><!-- BEGIN partner_item2_a -->href="{LINK}" target="_blank"<!-- END partner_item2_a -->><img src="/templates/images/partners/{IMG}" alt=""></a>
<!-- BEGIN partner_item22 -->
                  </li>
<!-- END partner_item22 -->
<!-- END partner_item2 -->
<!-- BEGIN partner_item222 -->
                  </li>
<!-- END partner_item222 -->
                </ul>
              </div><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- END partner -->
<!-- BEGIN slider -->
    <section class="section-sertificats">
      <div class="uk-section uk-container uk-container-xlarge">
        <div class="section-title section-title--center">
          <h3 hidden>Наши дипломы</h3>
        </div>
        <div class="section-content">
          <div class="section-sertificats-slider uk-slider-out-nav" tabindex="-1" uk-slider="">
            <div class="uk-position-relative">
              <ul class="uk-slider-items uk-child-width-1-2 uk-grid uk-grid-small uk-child-width-1-2@s uk-child-width-1-4@m uk-child-width-1-5@l" data-uk-lightbox>
<!-- BEGIN slider_item -->
                <li><a class="sertificats-item-link" href="/templates/images/sliders/{IMG}"><img src="/templates/images/sliders/s_{IMG}" alt=""></a></li>
<!-- END slider_item -->
              </ul>
            </div><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a>
          </div>
        </div>
      </div>
    </section>
<!-- END slider -->
<!-- BEGIN faq -->
    <section class="section-faq">
      <div class="uk-section uk-container uk-container-small">
        <div class="section-title section-title--center">
          <h3>Часто задаваемые вопросы</h3>
        </div>
        <div class="section-content">
          <ul data-uk-accordion="">
<!-- BEGIN faq_item -->
            <li<!-- BEGIN faq_item_open --> class="uk-open"<!-- END faq_item_open -->>
				<a class="uk-accordion-title" href="#">{NAME}</a>
				<div class="uk-accordion-content">
					{TEXT}
				</div>
            </li>
<!-- END faq_item -->
          </ul>
        </div>
      </div>
    </section>
<!-- END faq -->
  </main>
<!-- END block_center -->