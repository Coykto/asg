<!-- BEGIN block_center -->
    <section class="reviews">
        <div class="uk-container uk-section">
			{TEXT}
            <h3 class="section-title">{H1}</h3>
            <div uk-slider="">
                <div class="uk-position-relative">
                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-child-width-1-1">
<!-- BEGIN review_item -->
                            <li>
                                <div class="reviews-item">
                                    <div class="uk-grid uk-child-width-1-2@m" data-uk-grid>
                                        <div>
                                            <div class="reviews-item__media">
<!-- BEGIN review_item_img -->
												<img src="https://xn----otbbferaebb2agi0a.xn--p1ai/templates/images/reviews/{IMG}" alt="">
<!-- END review_item_img -->
<!-- BEGIN review_item_video -->
												<iframe width="560" height="315" src="https://www.youtube.com/embed/{VIDEO}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<!-- END review_item_video -->
											</div>
                                        </div>
                                        <div>
                                            <div class="reviews-item__info">
                                                <div class="reviews-item__title">{NAME}</div>
                                                <div class="reviews-item__desc">{TEXT}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
<!-- END review_item -->
                        </ul>
                    </div>
                    <div class="uk-visible@m"><a class="uk-position-center-left-out" href="#" uk-slidenav-previous="" uk-slider-item="previous"></a><a class="uk-position-center-right-out" href="#" uk-slidenav-next="" uk-slider-item="next"></a></div>
                </div>
                <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"></ul>
            </div>
            <div class="uk-margin-medium-top uk-text-center"><a class="uk-button uk-button-primary" href="#">Оставить отзыв</a></div>
        </div>
    </section>
<!-- END block_center -->