<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Сотрудники</div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=new">Добавить</a> сотрудника</div>

        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
			  <td class="table-items-title">{NAME}</td>
              <td class="text-center">
                <div class="item-to-top"><!-- BEGIN listing_item_up --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=up&id={ID}"></a><!-- END listing_item_up --></div>
                <div class="item-to-bottom"><!-- BEGIN listing_item_down --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=down&id={ID}"></a><!-- END listing_item_down --></div>
              </td>
			  <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=edit&id={ID}"></a></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN video -->

<!-- BEGIN video_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=videos">Сотрудники</a> &#8594; Добавление</div>
<!-- END video_new -->

<!-- BEGIN video_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=videos">Сотрудники</a> &#8594; Редактирование</div>
<!-- END video_edit -->

		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=videos&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Имя:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Дожность:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="text" value="{TEXT}">
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
                        <div class="form-upload-block-text">В верстке 240x240px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG}</div>
                    </div>
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
		</form>

<script type="text/javascript" src="/files/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/files/tiny_mce/options.js"></script>
<!-- END video -->

<!-- END center -->