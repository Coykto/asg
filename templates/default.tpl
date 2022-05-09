<!-- BEGIN block_center -->
  <main class="main-page">
<!-- BEGIN hero -->
    <section class="section-hero section-hero--home">
      <div class="section-hero__banner">
        <div class="section-hero__bg uk-visible@s" style="background-image: url(/templates/images/tree/{BANNER})"></div>
		<div class="section-hero__bg uk-hidden@s" style="background-image: url(/templates/images/tree/{BANNER_MOBILE})"></div>
        <div class="uk-section-small uk-container uk-container-xlarge">
          <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-2@m uk-width-2-3">
              <div class="section-hero__content">
				<h1 class="section-hero__title">{H1}</h1>
                <p class="section-hero__subtitle">{BANNER_TEXT}</p>
                {SBANNER_TEXT}
              </div>
            </div>
            <div class="uk-visible@m"></div>
          </div>
        </div>
      </div>
<!-- BEGIN hero_red -->
      <div class="section-hero__numbers">
        <div class="uk-section-small uk-container uk-container-large">
          <div class="uk-grid uk-grid-small uk-child-width-1-3" data-uk-grid>
<!-- BEGIN hero_red_item -->
            <div>
              <div class="number-item">
                <div class="number-item__box"><span>{NAME}</span>{TEXT}</div>
              </div>
            </div>
<!-- END hero_red_item -->
          </div>
        </div>
      </div>
<!-- END hero_red -->
    </section>
<!-- END hero -->
<!-- BEGIN services -->
    <section class="section-services">
      <div class="uk-section-small uk-container uk-container-xlarge">
        <div class="uk-visible@m">
          <ul class="services-nav" data-uk-tab data-uk-switcher="animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
<!-- BEGIN services_tab -->
            <li>
				<a href="#">
					<div class="services-nav-item">
					  <div class="services-nav-item__icon"><img src="/templates/images/tree/{IMG1}" alt="{NAME}"></div>
					  <div class="services-nav-item__desc">
						<div class="services-nav-item__title">{NAME}</div>
						<div class="services-nav-item__subtitle">{TEXTSMALL1}</div>
					  </div>
					</div>
				</a>
			</li>
<!-- END services_tab -->
          </ul>
          <ul class="uk-switcher uk-margin-auto uk-container">
<!-- BEGIN services_item -->
            <li>
              <div class="uk-grid uk-flex-middle" data-uk-grid>
                <div class="uk-width-1-4@m uk-width-1-3@s">
<!-- BEGIN services_item_img2 -->
                  <div class="services-item-img"><img src="/templates/images/tree/{IMG2}" alt="" id="service_img"></div>
<!-- END services_item_img2 -->
                </div>
                <div class="uk-width-3-4@m uk-width-2-3@s">
                  <div class="services-item-list uk-grid uk-grid-small uk-child-width-1-3@m uk-child-width-1-2" data-uk-grid>
<!-- BEGIN services_item_sub -->
                    <div><a href="{LINK}" class="service_img" data-img="{IMG2}">{NAME}</a></div>
<!-- END services_item_sub -->
                  </div>
                </div>
              </div>
            </li>
<!-- END services_item -->
          </ul>
        </div>
        <div class="uk-hidden@m">
          <ul class="accordion-services" data-uk-accordion="">
<!-- BEGIN services_mobile -->
            <li>
			  <a class="uk-accordion-title" href="#">
                <div class="services-nav-item">
                  <div class="services-nav-item__icon"><img src="/templates/images/tree/{IMG1}" alt="{NAME}"></div>
                  <div class="services-nav-item__desc">
                    <div class="services-nav-item__title">{NAME}</div>
                    <div class="services-nav-item__subtitle">{TEXTSMALL1}</div>
                  </div>
                </div>
              </a>
              <div class="uk-accordion-content">
                <div class="services-item-list uk-grid uk-grid-small uk-child-width-1-2" data-uk-grid>
<!-- BEGIN services_mobile_sub -->
                  <div><a href="{LINK}">{NAME}</a></div>
<!-- END services_mobile_sub -->
                </div>
              </div>
            </li>
<!-- END services_mobile -->
          </ul>
        </div>
      </div>
    </section>
<!-- END services -->
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
  </main>
<!-- END block_center -->