<!-- BEGIN block_center -->
  <main class="main-page">
<!-- BEGIN hero -->
    <section class="section-hero section-hero--service">
      <div class="section-hero__banner">
        <div class="section-hero__bg uk-visible@s" style="background-image: url(/templates/images/tree/{BANNER})"></div>
		<div class="section-hero__bg uk-hidden@s" style="background-image: url(/templates/images/tree/{BANNER_MOBILE})"></div>
        <div class="uk-section-small uk-container uk-container-xlarge">
          <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-2@m uk-width-2-3">
              <div class="section-hero__content">
                <!--<p class="section-hero__suptitle">{NAME1}</p>-->
                <h1 class="section-hero__title">{H1}</h1>
                <p class="section-hero__subtitle">{BANNER_TEXT}</p>
                {SBANNER_TEXT}
              </div>
            </div>
            <div class="uk-visible@m"></div>
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
<!-- BEGIN bread -->
            <li><a href="{HOST}{CPU}/">{NAME}</a></li>
<!-- END bread -->
            <li><span>{NAME}</span></li>
          </ul>
          <form class="uk-search uk-search-default" method="post" action="/search/"><span class="uk-search-icon-flip" uk-search-icon=""></span><input class="uk-search-input" type="search" placeholder="Поиск услуг" name="word"></form>
        </div>
      </div>
    </div>
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
      <div class="uk-section-small uk-container uk-container-large">
        {TEXT1}
      </div>
    </section>
<!-- END text1 -->
<!-- BEGIN items -->
    <section class="service-products">
      <div class="uk-section-small uk-container uk-container-large">
        <div class="uk-grid uk-grid-small uk-child-width-1-4@l uk-child-width-1-3@m uk-child-width-1-2@s" data-uk-grid>
<!-- BEGIN item -->
          <div>
            <div class="service-products-item">
              <div class="service-products-item__media"><img src="/templates/images/releases/{IMG}" alt=""></div>
              <div class="service-products-item__info">
                <div class="service-products-item__title">{NAME}</div>
<!-- BEGIN item_hars -->
                <div class="service-products-item__info-list">
                  <ul>
<!-- BEGIN item_har -->
                    <li><span>{NAME}</span><span>{TEXT}</span></li>
<!-- END item_har -->
                  </ul>
                </div>
<!-- END item_hars -->
                <div class="service-products-item__buttons">
<!-- BEGIN item_price -->
                  <div class="service-products-item__col">
                    <div class="number number--between">
                      <div class="number_controls">
                        <div class="nc-minus" data-uk-icon="minus"></div>
                      </div>
					  <input class="uk-input" type="text" value="1">
                      <div class="number_controls">
                        <div class="nc-plus" data-uk-icon="plus"></div>
                      </div>
                    </div>
                  </div>
                  <div class="service-products-item__price"><span>{PRICE}</span></div>
<!-- END item_price -->
                  <div class="service-products-item__btn"><a class="uk-button uk-button-danger callback" href="#callback" data-uk-toggle="">Заказать</a></div>
                </div>
              </div>
            </div>
          </div>
<!-- END item -->
        </div>
      </div>
    </section>
<!-- END items -->
<!-- BEGIN text2 -->
    <section class="service-table">
      <div class="uk-section-small uk-container uk-container-large">
        <div class="section-content">
          <div class="uk-overflow-auto">
			{TEXT2}
          </div>
        </div>
      </div>
    </section>
<!-- END text2 -->
<!-- BEGIN block1 -->
	<section class="service-cta">
      <div class="uk-section-small uk-container">
        <div class="service-cta-item">
          <div class="service-cta-item__icon"><img src="/templates/images/tree/{CONS_IMG}" alt=""></div>
          <div class="service-cta-item__desc">
            <div class="service-cta-item__text">{CONS_TEXT}</div>
            <div class="service-cta-item__btn"><a class="uk-button uk-button-default callback" href="#callback" data-uk-toggle="">Получить консультацию</a></div>
          </div>
        </div>
      </div>
    </section>
<!-- END block1 -->
<!-- BEGIN gal -->
      <section class="section-services-gallery"<!-- BEGIN gal_h --> style="display:none;"<!-- END gal_h -->>
		<div class="uk-section-small" style="padding-top: 5px;padding-bottom: 0px;">
			<div class="gallery-grid-container" data-uk-lightbox>
<!-- BEGIN gal_item -->
				<div class="uk-cover-container gallery-{CLASS}"><a href="/templates/images/tree/{IMG}" data-caption="{HAR}"><img src="/templates/images/tree/{SIMG}" alt="" data-uk-cover></a></div>
<!-- END gal_item -->
			</div>
<!-- BEGIN gal_more -->
			<div class="uk-margin-small-top uk-text-center moreb" style="margin-bottom:20px;"><a class="uk-button uk-button-danger" href="javascript:$('.section-services-gallery').show();$('.moreb').hide();">Еще фото</a></div>
<!-- END gal_more -->
		</div>
      </section>
<!-- END gal -->
<!-- BEGIN text3 -->
    <section class="service-video">
      <div class="bg-grey">
        <div class="uk-section-small uk-container">
          <div class="section-content">
			{TEXT3}
          </div>
        </div>
      </div>
    </section>
<!-- END text3 -->
<!-- BEGIN blog1 -->
    <section class="service-article">
      <div class="uk-section uk-container uk-container-large">
		<div class="section-title section-title--center">
          <h3>{BLOGNAME}</h3>
        </div>
        <div class="section-content">
<!-- BEGIN blog1_item -->
          <div class="service-article-item">
            <div class="uk-grid uk-child-width-1-2@m" data-uk-grid>
              <div><img class="uk-width-1-1" src="/templates/images/articles/{IMG3}" alt=""></div>
              <div><a href="{HOST}{CPU1}/{CPU2}/"><img class="uk-width-1-1" src="/templates/images/articles/{IMG1}" alt=""></a>
                <h4><a href="{HOST}{CPU1}/{CPU2}/">{NAME}</a></h4>
                <a href="{HOST}{CPU1}/{CPU2}/"><p>{TEXTSMALL}</p></a><a href="{HOST}{CPU1}/{CPU2}/">Читать далее...</a>
              </div>
            </div>
          </div>
<!-- END blog1_item -->
        </div>
      </div>
    </section>
<!-- END blog1 -->
<!-- BEGIN blog2 -->
    <section class="service-article">
      <div class="uk-section uk-container uk-container-xlarge">
		<div class="section-title section-title--center">
          <h3>{BLOGNAME}</h3>
        </div>
        <div class="section-content">
          <div class="uk-grid uk-child-width-1-2@m" data-uk-grid>
<!-- BEGIN blog2_item -->
            <div>
              <div class="service-article-item">
				<a href="{HOST}{CPU1}/{CPU2}/"><img class="uk-width-1-1" src="/templates/images/articles/{IMG1}" alt=""></a>
                <h4><a href="{HOST}{CPU1}/{CPU2}/">{NAME}</a></h4>
                <a href="{HOST}{CPU1}/{CPU2}/"><p>{TEXTSMALL}</p></a><a href="{HOST}{CPU1}/{CPU2}/">Читать далее...</a>
              </div>
            </div>
<!-- END blog2_item -->
          </div>
        </div>
      </div>
    </section>
<!-- END blog2 -->
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
<!-- BEGIN sub -->
    <section class="service-others-services">
      <div class="bg-grey">
        <div class="uk-section-small uk-container">
          <div class="section-title section-title--center">
            <h3>Другие услуги</h3>
          </div>
          <div class="section-content">
            <div tabindex="-1" uk-slider="">
              <div class="uk-position-relative">
                <ul class="uk-slider-items uk-child-width-1-1 uk-grid uk-grid-small uk-child-width-1-2@s uk-child-width-1-2@m uk-child-width-1-3@l">
<!-- BEGIN sub_item -->
                  <li>
                    <div class="article-services-item">
						<a class="article-services-item__link" href="{HOST}{CPU}/">
							<img class="article-services-item__img" src="/templates/images/tree/{IMG4}" alt="">
							<span class="article-services-item__title">{NAME}</span>
							<span class="article-services-item__text">{TEXTSMALL}</span>
							</a>
						</div>
                  </li>
<!-- END sub_item -->
                </ul>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- END sub -->
  </main>
<!-- END block_center -->