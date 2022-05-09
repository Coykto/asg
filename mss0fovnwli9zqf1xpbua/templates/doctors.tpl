<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Врачи</div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=new">Добавить</a> врача</div>

        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
			  <td class="table-items-title">{NAME}<!-- BEGIN listing_item_a2 --></a><!-- END listing_item_a2 --></td>
              <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=edit&id={ID}"></a></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN doctor -->
<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.v2.1.4.min.js"></script>

<!-- BEGIN doctor_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=doctors">Врачи</a> &#8594; Добавление</div>
<!-- END doctor_new -->

<!-- BEGIN doctor_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=doctors">Врачи</a> &#8594; Редактирование</div>
<!-- END doctor_edit -->

        <ul class="page-container-nav nav nav-pills" id="pills-tab">
          <li class="nav-item"><a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1">RU</a></li>
          <li class="nav-item"><a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2">UA</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3">EN</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4">Сертификаты</a></li>
        </ul>

		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=doctors&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-1">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">ФИО:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Стаж:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="years" value="{YEARS}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Категория:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="cat" value="{CAT}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Специализация:</label>
                  <div class="col-4">
                    {SPECS}
                  </div>
                </div>
<!--
                <div class="form-group row">
                  <label class="col-2 col-form-label">Клиники:</label>
                  <div class="col-4">
                    {UNITS}
                  </div>
                </div>
-->
                <div class="form-group row">
                  <label class="col-2 col-form-label">Стоимость приема:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="price" value="{PRICE}">
                  </div>
                </div>
<!--
                <div class="form-group row">
                  <label class="col-2 col-form-label">Видео:</label>
                  <div class="col-4">
                    {VIDEOS}
                  </div>
                </div>
-->
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img">
                        </label>
                        <div class="form-upload-block-text">&mdash; 286x373px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG}</div>
                    </div>
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
                  <label class="col-2 col-form-label">Включено:</label>
                  <div class="col-1">
                    <input class="form-control" type="checkbox" name="visible" {VISIBLE}>
                  </div>
                </div>
<!--
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст в список:</label>
                  <div class="col-10">
                    <textarea name="textsmall" class="mceEditor">{TEXTSMALL}</textarea>
                  </div>
                </div>
-->
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст:</label>
                  <div class="col-10">
                    <textarea name="text" class="mceEditor">{TEXT}</textarea>
                  </div>
                </div>
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
            <div class="tab-pane fade show" id="pills-2">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">ФИО:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name_ua" value="{NAME_UA}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Стаж:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="years_ua" value="{YEARS_UA}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Категория:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="cat_ua" value="{CAT_UA}">
                  </div>
                </div>
<!--
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст в список:</label>
                  <div class="col-10">
                    <textarea name="textsmall_ua" class="mceEditor">{TEXTSMALL_UA}</textarea>
                  </div>
                </div>
-->
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст:</label>
                  <div class="col-10">
                    <textarea name="text_ua" class="mceEditor">{TEXT_UA}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Title:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="title_ua" value="{TITLE_UA}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Description:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="description_ua" value="{DESCRIPTION_UA}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Keywords:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="keywords_ua" value="{KEYWORDS_UA}">
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade show" id="pills-3">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">ФИО:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name_en" value="{NAME_EN}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Стаж:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="years_en" value="{YEARS_EN}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Категория:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="cat_en" value="{CAT_EN}">
                  </div>
                </div>
<!--
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст в список:</label>
                  <div class="col-10">
                    <textarea name="textsmall_en" class="mceEditor">{TEXTSMALL_EN}</textarea>
                  </div>
                </div>
-->
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст:</label>
                  <div class="col-10">
                    <textarea name="text_en" class="mceEditor">{TEXT_EN}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Title:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="title_en" value="{TITLE_EN}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Description:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="description_en" value="{DESCRIPTION_EN}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Keywords:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="keywords_en" value="{KEYWORDS_EN}">
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade show" id="pills-4">
              <div>
			  <div class="gallery-block">
<!-- BEGIN showfoto -->
                <div class="gallery-item">
				  <a target="_blank" href="/templates/images/doctors/{IMG}"><img src="/templates/images/doctors/{SIMG}" class="gallery-img" style="height: 100px;"></a>
                  <div class="gallery-btns">
                    <div class="gallery-btn hor-item-to">
                      <!-- BEGIN gf_up --><div class="item-to-top"><a class="item-to-link" href="/f7g0hqofbaxy5fdljzmdk/index.php?page=doctors&action=moveupf&id={ID}&iid={IID}"></a></div><!-- END gf_up -->
                      <!-- BEGIN gf_down --><div class="item-to-bottom"><a class="item-to-link" href="/f7g0hqofbaxy5fdljzmdk/index.php?page=doctors&action=movedownf&id={ID}&iid={IID}"></a></div><!-- END gf_down -->
                    </div>
<!-- BEGIN gf_visible -->
                    <div class="gallery-btn"><a class="item-active active" href="/f7g0hqofbaxy5fdljzmdk/index.php?page=doctors&action=nvisiblef&id={ID}&iid={IID}" onclick="if (!confirm('Выключить?')) return false;"></a></div>
<!-- END gf_visible -->
<!-- BEGIN gf_nvisible -->
                    <div class="gallery-btn"><a class="item-active" href="/f7g0hqofbaxy5fdljzmdk/index.php?page=doctors&action=visiblef&id={ID}&iid={IID}" onclick="if (!confirm('Включить?')) return false;"></a></div>
<!-- END gf_nvisible -->
                    <div class="gallery-btn"><a class="item-delete" href="/f7g0hqofbaxy5fdljzmdk/index.php?page=doctors&action=delf&id={ID}&iid={IID}&img={IMG}&simg={SIMG}" onclick="if (!confirm ('Уверены?')) return false;"></a></div>
                  </div>
                </div>
<!-- END showfoto -->
			  </div>
			  <br><br>Добавление новых фото (нужно разрешить в браузере Flash, если не видны кнопки выбора фото)<br><br>

<script type="text/javascript">
      $(function() {
      $('#file_upload').uploadify({
  'uploader'      : '/uploadify/uploadify.swf',
  'script'        : '/uploadify/uploadify.php',
  'cancelImg'     : '/uploadify/cancel.png',
  'folder'        : '/templates/images/doctors',
  'multi'		  : true,
  'auto'     	  : true,
  'onComplete' : function(event,data,fileObj,response) {
		console.log(response);
		var xyz = $('#fimg').val();
		if (xyz=='') $('#fimg').val(response);
		else $('#fimg').val(xyz+','+response);
    }
});      });
      </script>
        <input type="file" id="file_upload" name="file_upload" />
		Большие <input type="hidden" name="fimg" id="fimg">
		<br><br>
<script type="text/javascript">
      $(function() {
      $('#file_upload1').uploadify({
  'uploader'      : '/uploadify/uploadify.swf',
  'script'        : '/uploadify/uploadify.php',
  'cancelImg'     : '/uploadify/cancel.png',
  'folder'        : '/templates/images/doctors',
  'multi'		  : true,
  'auto'     	  : true,
  'onComplete' : function(event,data,fileObj,response) {
		console.log(response);
		var xyz = $('#fimg1').val();
		if (xyz=='') $('#fimg1').val(response);
		else $('#fimg1').val(xyz+','+response);
    }
});      });
      </script>
        <input type="file" id="file_upload1" name="file_upload1" />
		Мелкие (287х193) <input type="hidden" name="fimg1" id="fimg1">
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
<!-- END doctor -->

<!-- END center -->