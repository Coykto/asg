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
    <div class="uk-section-small uk-container uk-container-xlarge">
      <div class="section-title">
        <h1>{H1}</h1>
      </div>
      <div class="section-content">
<!-- BEGIN item -->
        <div class="stock-item">
          <div class="stock-item__media"><img src="/templates/images/stocks/{IMG}" alt=""></div>
          <div class="stock-item__info">
<!-- BEGIN item_name -->
            <div class="stock-item__desc">
              <div class="stock-item__text">{NAME}</div>
            </div>
<!-- END item_name -->
<!-- BEGIN item_button -->
            <div class="stock-item__btn"><a class="uk-button uk-button-danger callback" href="#callback" data-uk-toggle>Заказать по акции</a></div>
<!-- END item_button -->
          </div>
        </div>
<!-- END item -->
      </div>
    </div>
  </main>
<!-- END block_center -->