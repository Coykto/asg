<!-- BEGIN block_center -->
    <section class="categories">
        <div class="container">
            <div class="title page-title">{H1}</div>
            <div class="row">
                <div class="sidebar">
                    <div class="filter">
                        <label class="checkbox main-checkbox">
                            <input type="checkbox" checked="checked" id="radio0" name="radio0" class="radiowork" value="0">
                            <span class="checkmark"></span>
                            Все товары
                        </label>
<!-- BEGIN radio -->
                        <label class="checkbox">
                            <input type="checkbox" id="radio{I}" name="radio{I}" value="{I}" class="radiowork">
                            <span class="checkmark"></span>
                            {NAME}
                        </label>
<!-- END radio -->
                    </div>
                </div>
                <div class="content">
                    <div class="cards cards-gallery">
<!-- BEGIN listing_item -->
                        <div class="card work{I} work">
                            <a href="javascript:void(0)">
                                <div class="card__img ramka">
                                    <img class="b-lazy" src="/placeholder.gif" data-src="/templates/images/tree/{IMG}" data-caption="<span>{NAME}</span>{HAR}">
                                </div>
                                <div class="card__title">{NAME}</div>
                                <div class="card__sub-title">{HAR}</div>
                            </a>
                        </div>
<!-- END listing_item -->
                    </div>
                    <a href="{HOST}{CPU1}/" class="link link_left">Вернуться к каталогу мебели</a>
                </div>
            </div>
        </div>
    </section>
<!-- END block_center -->