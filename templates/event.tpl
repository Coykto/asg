<!-- BEGIN block_center -->

<!-- BEGIN listing -->
    <section class="price">
        <div class="uk-container uk-section">
            <h1 class="section-title">{H1}</h1>
            {TEXT}
            <div class="filter uk-margin-medium-top" uk-filter="target: .js-filter">
                <ul class="uk-subnav uk-subnav-pill">
                    <li class="uk-active" uk-filter-control=""><a href="#">Все</a></li>
<!-- BEGIN listing_cat -->
                    <li uk-filter-control=".designcat{ID}"><a href="#">{NAME}</a></li>
<!-- END listing_cat -->
                </ul>
                <ul class="js-filter uk-child-width-1-2 uk-grid-medium uk-child-width-1-4@m" uk-grid="">
<!-- BEGIN listing_item -->
                    <li class="{CATS}">
                        <div class="article-item">
                            <div class="article-item__box">
                                <div class="article-item__media"><a href="{HOST}{CPU1}/{CPU2}/"><img src="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/dailys/{IMG}" alt=""/></a></div>
                                <div class="article-item__title"><a href="{HOST}{CPU1}/{CPU2}/">{NAME}</a></div>
                                <div class="article-item__tags">{TAGS}</div>
                                <div class="article-item__info">
                                    <div class="article-item__views">{VIEWS}</div>
                                    <div class="article-item__like projectlike projectlike{ID}" data-like="{ID}">{LIKES}</div>
                                </div>
                            </div>
                        </div>
                    </li>
<!-- END listing_item -->
                </ul>
            </div>
        </div>
    </section>
<!-- BEGIN block6 --><!-- END block6 -->
<!-- END listing -->

<!-- BEGIN open -->
<!-- BEGIN hero -->
    <section class="hero">
        <div class="hero__bg" style="background-image: url(https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/dailys/{BANNER})">
            <div class="uk-container uk-section-large uk-height-1-1">
                <div class="hero__content">
					{TEXT}
                </div>
            </div>
        </div>
    </section>
<!-- END hero -->
    <section class="block-info">
        <div class="uk-container uk-section-small">
            <div class="uk-grid uk-child-width-1-2@m" data-uk-grid>
                <div class="uk-flex-last@m">
                <h3>{NAME1}</h3>
				<img src="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/dailys/{IMG}" alt=""></div>
                <div class="uk-flex-first@m">
                    <div class="uk-margin-medium-top">
                        {TEXT1}
                    </div>
                </div>
            </div>
            <div class="uk-margin-medium-top">
                {TEXT2}
            </div>
        </div>
    </section>
<!-- BEGIN open_gallery -->
    <section class="section-gallery">
        <div class="uk-section uk-container">
            <h3 class="section-title">Фотогалерея проекта</h3>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-2@m uk-child-width-1-4@l" data-uk-grid data-uk-lightbox>
<!-- BEGIN open_gallery_item -->
                <div><a href="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/dailys/{SIMG}"><img src="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/dailys/{IMG}" alt=""></a></div>
<!-- END open_gallery_item -->
            </div>
        </div>
    </section>
<!-- END open_gallery -->
<!-- BEGIN open_tech -->
    <section class="product-type">
        <div class="uk-container uk-section">
            <h3 class="section-title">Подробнее о технологиях, <br> использованных в проекте</h3>
            <div class="slide-out-nav" uk-slider="">
                <div class="uk-position-relative">
                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-2@m uk-child-width-1-3@l">
<!-- BEGIN open_tech_item -->
                            <li>
                                <div class="slider-item">
                                    <a class="slider-item__link" href="{HOST}{CPU}/">
                                        <div class="slider-item__box"><img src="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/tree/{IMG}" alt="">
                                            <div class="slider-item__content">
                                                <div class="slider-item__title">{NAME}</div>
<!-- BEGIN open_tech_item_price -->
                                                <div class="slider-item__price">{PRICE}</div>
<!-- END open_tech_item_price -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </li>
<!-- END open_tech_item -->
                        </ul>
                    </div>
                    <div class="uk-visible@m"><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a></div>
                </div>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"></ul>
            </div>
        </div>
    </section>
<!-- END open_tech -->
<!-- BEGIN open_pro -->
    <section class="section-projects">
        <div class="uk-section uk-container">
            <h3 class="section-title">Реализованные проекты потолков, <br> которыми мы особенно гордимся</h3>
            <div class="slide-out-nav" uk-slider="">
                <div class="uk-position-relative">
                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-2@m uk-child-width-1-3@l">
<!-- BEGIN open_pro_item -->
                            <li>
                                <div class="article-item">
                                    <div class="article-item__box">
                                        <div class="article-item__media"><a href="{HOST}{CPU1}/{CPU2}/"><img src="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/dailys/{IMG}" alt=""/></a></div>
                                        <div class="article-item__title"><a href="{HOST}{CPU1}/{CPU2}/">{NAME}</a></div>
                                        <div class="article-item__tags">{TAGS}</div>
                                        <div class="article-item__info">
                                            <div class="article-item__views">{VIEWS}</div>
                                            <div class="article-item__like projectlike projectlike{ID}" data-like="{ID}">{LIKES}</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
<!-- END open_pro_item -->
                        </ul>
                    </div>
                    <div class="uk-visible@m"><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a></div>
                </div>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"></ul>
            </div>
            <div class="uk-margin-medium-top uk-text-center"><a class="uk-button uk-button-primary" href="{HOST}{CPU1}/">Смотерть больше проектов!</a></div>
        </div>
    </section>
<!-- END open_pro -->
<!-- BEGIN block2 --><!-- END block2 -->
<!-- END open -->

<!-- BEGIN block5 --><!-- END block5 -->

<!-- END block_center -->