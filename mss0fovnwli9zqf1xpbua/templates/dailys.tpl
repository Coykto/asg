<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Проекты</div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=new">Добавить</a> статью</div>

        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
			  <td>{DATE}</td>
			  <td class="table-items-title">{NAME}</td>
			  <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=edit&id={ID}"></a></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN daily -->

<!-- BEGIN daily_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys">Проекты</a> &#8594; Добавление</div>
<!-- END daily_new -->

<!-- BEGIN daily_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys">Проекты</a> &#8594; Редактирование</div>
<!-- END daily_edit -->


        <ul class="page-container-nav nav nav-pills" id="pills-tab">
          <li class="nav-item"><a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" onclick="$('#pills').val('1');">Текст</a></li>
          <li class="nav-item"><a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" onclick="$('#pills').val('2');">Мета</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" onclick="$('#pills').val('3');">Галерея</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4" onclick="$('#pills').val('4');">Технологии</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-5-tab" data-toggle="pill" href="#pills-5" onclick="$('#pills').val('5');">Тэги/фильтры</a></li>
        </ul>
		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
		<input type="hidden" value="{PILLS}" name="pills" id="pills" >
          <div class="tab-content" id="pills-tabContent">
		    <div class="tab-pane fade" id="pills-4">
			  <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Выберите из материалов или потолков:</label>
                  <div class="col-3">
                    {TID}
                  </div>
                </div>
			  </div>
			</div>
		    <div class="tab-pane fade" id="pills-5">
			  <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Выберите тэги:</label>
                  <div class="col-3">
                    {CID}
                  </div>
                  <div class="col-4">
                    <textarea class="form-control" name="cidadd" rows="10" placeholder="Или добавьте новые, по одному в строку"></textarea>
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade" id="pills-3">
				Минимум 680х680px.<br><br>
			  <div class="gallery-block">
<!-- BEGIN showfoto -->
                <div class="gallery-item">
				  <a target="_blank" href="/templates/images/dailys/{IMG}"><img src="/templates/images/dailys/{SIMG}" class="gallery-img" style="width: 100px;"></a>
					<div class="form-group row" style="border: none;padding: 1px;">
						<input class="form-control" type="text" name="galname{IID}" value="{NAME}" placeholder="Название">
					</div>
                  <div class="gallery-btns">
                    <div class="gallery-btn hor-item-to">
                      <!-- BEGIN gf_up --><div class="item-to-top"><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=moveupf&id={ID}&iid={IID}"></a></div><!-- END gf_up -->
                      <!-- BEGIN gf_down --><div class="item-to-bottom"><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=movedownf&id={ID}&iid={IID}"></a></div><!-- END gf_down -->
                    </div>
<!-- BEGIN gf_visible -->
                    <div class="gallery-btn"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=nvisiblef&id={ID}&iid={IID}" onclick="if (!confirm('Выключить?')) return false;"></a></div>
<!-- END gf_visible -->
<!-- BEGIN gf_nvisible -->
                    <div class="gallery-btn"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=visiblef&id={ID}&iid={IID}" onclick="if (!confirm('Включить?')) return false;"></a></div>
<!-- END gf_nvisible -->
                    <div class="gallery-btn"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=dailys&action=delf&id={ID}&iid={IID}&img={IMG}&simg={SIMG}" onclick="if (!confirm ('Уверены?')) return false;"></a></div>
                  </div>
                </div>
<!-- END showfoto -->
			  </div>
			  <div>
                <div class="form-group row">
                  <div class="col-4">
                    <input class="form-control" type="file" name="files1[]" multiple />
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade show active" id="pills-1">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название внутри над фото:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name1" value="{NAME1}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Дата:</label>
                  <div class="col-4">
                    <input class="form-control calendar" type="text" name="date" value="{DATE}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">ЧПУ:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="cpu" value="{CPU}">
                  </div>
                  <div class="col-6 form-text">
                    <p>— Для адресной строки, например "www.site.ru/item/razdel/". Латиница и цифры, без пробелов.</p>
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
                        <div class="form-upload-block-text">В верстке 582x582px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Баннер:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="banner">
                        </label>
                        <div class="form-upload-block-text"></div>
                      </div>
                      <div class="custom-form-upload-text">{BANNER}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">На главной:</label>
                  <div class="col-1">
                    <input class="form-control" type="checkbox" name="main" {MAIN}>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст на баннере:</label>
                  <div class="col-10">
                    <textarea name="text" class="form-control" rows="5">{TEXT}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст слева от фото:</label>
                  <div class="col-10">
                    <textarea name="text1" class="mceEditor">{TEXT1}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст под фото:</label>
                  <div class="col-10">
                    <textarea name="text2" class="mceEditor">{TEXT2}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Включено:</label>
                  <div class="col-1">
                    <input class="form-control" type="checkbox" name="visible" {VISIBLE}>
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade show" id="pills-2">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Title:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="title" value="{TITLE}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Description:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="description" value="{DESCRIPTION}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Keywords:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="keywords" value="{KEYWORDS}">
                  </div>
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

<script type="text/javascript" src="/files/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/files/tiny_mce/options.js"></script>
<!-- END daily -->

<!-- END center -->