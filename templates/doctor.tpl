<!-- BEGIN block_center -->
    <section class="lamps">
        <div class="uk-container uk-section">
            <h1 class="section-title">{H1}</h1>
            <div class="filter uk-margin-medium-top" uk-filter="target: .js-filter">
<!-- BEGIN lamp_cats -->
                <ul class="uk-subnav uk-subnav-pill">
                    <li class="uk-active" uk-filter-control=""><a href="#">Все</a></li>
<!-- BEGIN lamp_cat -->
                    <li uk-filter-control=".lampcat{ID}"><a href="#">{NAME}</a></li>
<!-- END lamp_cat -->
                </ul>
<!-- END lamp_cats -->
                <ul class="js-filter uk-child-width-1-2 uk-grid-medium uk-child-width-1-4@m" uk-grid="">
<!-- BEGIN lamp -->
                    <li class="{CATS}">
                        <div class="product-item">
                            <div class="product-item__box">
                                <div class="product-item__media"><img src="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/sliders/{IMG}" alt="{NAME}" /></div>
                                <div class="product-item__price">{PRICE}</div>
                                <div class="product-item__title">
                                    <h4>{NAME}</h4>
                                </div>
                                <div class="product-item__description">
                                    <p>{TEXT}</p>
                                </div>
                            </div>
                        </div>
                    </li>
<!-- END lamp -->
                </ul>
            </div>
        </div>
    </section>
<!-- BEGIN work -->
    <section class="work-examples">
        <div class="uk-container uk-section">
            <h3 class="section-title">{NAME}</h3>
            <div class="slide-out-nav" uk-slider="">
                <div class="uk-position-relative">
                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-2@m uk-child-width-1-3@l" data-uk-lightbox>
<!-- BEGIN work_item -->
                            <li>
                                <div class="slider-item">
                                    <a class="slider-item__link" href="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/tree/{IMG}" title="{NAME}">
                                        <div class="slider-item__box"><img src="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/tree/{SIMG}" alt="{NAME}"></div>
                                    </a>
                                </div>
                            </li>
<!-- END work_item -->
                        </ul>
                    </div>
                    <div class="uk-visible@m"><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a></div>
                </div>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"></ul>
            </div>
        </div>
    </section>
<!-- END work -->
<!-- BEGIN block6 --><!-- END block6 -->
<!-- BEGIN block5 --><!-- END block5 -->
<!-- END block_center -->