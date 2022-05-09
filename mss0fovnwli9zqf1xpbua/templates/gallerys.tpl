<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Галерея</div>
	<form action="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=submit" method="POST" enctype="multipart/form-data">
			  <div>
                <div class="form-group row">
                  <div class="col-4">
                    <input class="form-control" type="file" name="files1[]" multiple />
                  </div>
                </div>
				<div class="row page-button-block" style="padding-top:10px;padding-bottom:10px;">
					<div class="col-4">
					<button class="btn btn-primary">Сохранить</button>
					</div>
				</div>
			  </div>
		</form>
			  <div class="gallery-block">
<!-- BEGIN showfoto -->
                <div class="gallery-item" style="width:200px;">
				  <a target="_blank" href="/templates/images/tree/{IMG}"><img src="/templates/images/tree/{SIMG}" class="gallery-img" style="width: 200px;"></a>
                  <div class="gallery-btns">
                    <div class="gallery-btn hor-item-to">
                      <!-- BEGIN gf_up --><div class="item-to-top"><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=moveupf&id={ID}"></a></div><!-- END gf_up -->
                      <!-- BEGIN gf_down --><div class="item-to-bottom"><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=movedownf&id={ID}"></a></div><!-- END gf_down -->
					  <a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=edit&id={ID}" target="_blank"></a>
                    </div>
<!-- BEGIN gf_visible -->
                    <div class="gallery-btn"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=nvisiblef&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></div>
<!-- END gf_visible -->
<!-- BEGIN gf_nvisible -->
                    <div class="gallery-btn"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=visiblef&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></div>
<!-- END gf_nvisible -->
                    <div class="gallery-btn"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=delf&id={ID}&img={IMG}&simg={SIMG}" onclick="if (!confirm ('Уверены?')) return false;"></a></div>
                  </div>
                </div>
<!-- END showfoto -->
			  </div>
<!-- END listing -->

<!-- BEGIN gallery -->

<!-- BEGIN gallery_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys">Галерея</a> &#8594; Редактирование</div>
<!-- END gallery_edit -->

		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=gallerys&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
			<div class="tab-content" id="pills-tabContent">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название:</label>
                  <div class="col-10">
                    <input class="form-control" type="text" name="har" value="{HAR}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Тэги:</label>
                  <div class="col-10">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Превью фото:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="simg">
                        </label>
                        <div class="form-upload-block-text"></div>
                      </div>
                      <div class="custom-form-upload-text"><img src="/templates/images/tree/{SIMG}"></div>
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
<!-- END gallery -->

<!-- END center -->