<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Отзывы</div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=new">Добавить</a> отзыв</div>


        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
			  <td class="table-items-title">{NAME}</td>
              <td class="text-center">
                <div class="item-to-top"><!-- BEGIN listing_item_up --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=up&id={ID}"></a><!-- END listing_item_up --></div>
                <div class="item-to-bottom"><!-- BEGIN listing_item_down --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=down&id={ID}"></a><!-- END listing_item_down --></div>
              </td>
              <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=edit&id={ID}"></a></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN review -->

<!-- BEGIN review_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews">Отзывы</a> &#8594; Добавление</div>
<!-- END review_new -->

<!-- BEGIN review_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=reviews">Отзывы</a> &#8594; Редактирование</div>
<!-- END review_edit -->
		
	<form action="/mss0fovnwli9zqf1xpbua/index.php?page=reviews&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Имя:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Отзыв:</label>
                  <div class="col-10">
                    <textarea name="text" class="form-control">{TEXT}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img">
                        </label>
                        <div class="form-upload-block-text">&mdash; В верстке 520х348px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Youtube:</label>
                  <div class="col-10">
                    <textarea name="social" class="form-control">{SOCIAL}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Включено:</label>
                  <div class="col-1">
                    <input class="form-control" type="checkbox" name="visible" {VISIBLE}>
                  </div>
                </div>
			  </div>

            <div class="row page-button-block">
				<div class="col-4">
					<button class="btn btn-primary">Сохранить</button>
				</div>
			</div>
		</div>
	</form>
<!-- END review -->

<!-- END center -->