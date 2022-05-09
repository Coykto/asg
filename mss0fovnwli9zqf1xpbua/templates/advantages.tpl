<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Преимущества</div>
                <div class="form-group row">
                  <div class="col-2">
					<select class="form-control" onchange="location.href='/mss0fovnwli9zqf1xpbua/index.php?page=advantages&cid='+this.value;" style="width:300px;">
					<option value="0">Выберите раздел</option>
					<!-- BEGIN cid -->
					<option value="{ID}"{SEL}>{NAME}</option>
					<!-- END cid -->
					</select>
                  </div>
                </div>
<br>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=new&cid={ID}">Добавить</a> блок</div>
        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
			  <td class="table-items-title">{NAME}</td>
              <td class="text-center">
                <div class="item-to-top"><!-- BEGIN listing_item_up --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=up&id={ID}&cid={CID}"></a><!-- END listing_item_up --></div>
                <div class="item-to-bottom"><!-- BEGIN listing_item_down --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=down&id={ID}&cid={CID}"></a><!-- END listing_item_down --></div>
              </td>
			  <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=edit&id={ID}"></a></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN advantage -->

<!-- BEGIN advantage_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&cid={CID}">Преимущества</a> &#8594; Добавление</div>
<!-- END advantage_new -->

<!-- BEGIN advantage_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&cid={CID}">Преимущества</a> &#8594; Редактирование</div>
<!-- END advantage_edit -->
		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
          <div class="tab-content" id="pills-tabContent">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Иконка:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img">
                        </label>
                        <div class="form-upload-block-text">&mdash; В верстке 90x90 px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Раздел:</label>
                  <div class="col-4">
					<select class="form-control" name="cid">
					<option value="0">Выберите раздел</option>
					<!-- BEGIN cid_edit -->
					<option value="{ID}"{SEL}>{NAME}</option>
					<!-- END cid_edit -->
					</select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст:</label>
                  <div class="col-10">
                    <textarea name="text" class="form-control">{TEXT}</textarea>
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
<!-- END advantage -->

<!-- END center -->