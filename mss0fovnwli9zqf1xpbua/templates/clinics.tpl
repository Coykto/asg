<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Контакты</div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=new">Добавить</a> адрес</div>

        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
			  <td class="table-items-title">{NAME}</td>
              <td class="text-center">
                <div class="item-to-top"><!-- BEGIN listing_item_up --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=up&id={ID}"></a><!-- END listing_item_up --></div>
                <div class="item-to-bottom"><!-- BEGIN listing_item_down --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=down&id={ID}"></a><!-- END listing_item_down --></div>
              </td>
			  <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=edit&id={ID}"></a></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN clinic -->

<!-- BEGIN clinic_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics">Контакты</a> &#8594; Добавление</div>
<!-- END clinic_new -->

<!-- BEGIN clinic_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=clinics">Контакты</a> &#8594; Редактирование</div>
<!-- END clinic_edit -->

        <ul class="page-container-nav nav nav-pills" id="pills-tab">
          <li class="nav-item"><a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1">RU</a></li>
          <li class="nav-item"><a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2">UA</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3">EN</a></li>
        </ul>
<form action="/mss0fovnwli9zqf1xpbua/index.php?page=clinics&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-1">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Адрес:</label>
                  <div class="col-10">
                    <textarea name="address" class="form-control" cols="100" rows="3">{ADDRESS}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">График работы:</label>
                  <div class="col-10">
                    <textarea name="wtime" class="form-control" cols="100" rows="3">{WTIME}</textarea>
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
                  <label class="col-2 col-form-label">Название:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name_ua" value="{NAME_UA}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Адрес:</label>
                  <div class="col-10">
                    <textarea name="address_ua" class="form-control" cols="100" rows="3">{ADDRESS_UA}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">График работы:</label>
                  <div class="col-10">
                    <textarea name="wtime_ua" class="form-control" cols="100" rows="3">{WTIME_UA}</textarea>
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade show" id="pills-3">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name_en" value="{NAME_EN}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Адрес:</label>
                  <div class="col-10">
                    <textarea name="address_en" class="form-control" cols="100" rows="3">{ADDRESS_EN}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">График работы:</label>
                  <div class="col-10">
                    <textarea name="wtime_en" class="form-control" cols="100" rows="3">{WTIME_EN}</textarea>
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
<!-- END clinic -->

<!-- END center -->