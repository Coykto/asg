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
    <div class="contacts-title">
      <div class="uk-section-small uk-container uk-container-xlarge">
        <div class="section-title">
          <h1>{H1}</h1>
        </div>
      </div>
    </div>
    <div class="contacts-map">
		{MAP}
    </div>
    <div class="contacts-info">
      <div class="uk-section-small uk-container uk-container-xlarge">
        <div class="uk-grid" data-uk-grid>
          <div class="uk-width-3-4@l">
            <div class="uk-margin-medium-top uk-grid uk-flex-center" data-uk-grid>
              {TEXT}
              <div class="uk-width-1-3@m uk-width-1-2@s">
                <div class="contacts-info-item">
                  {TEXT1}
                </div>
              </div>
            </div>
          </div>
          <div class="uk-width-1-4@l">
            <div class="contacts-info__box">
              {TEXT2}
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<!-- END block_center -->