<!-- BEGIN center -->

<!-- BEGIN settings -->

<!-- BEGIN settings_group_1_n -->
<div class="page-title">Настройки</div>
<!-- END settings_group_1_n -->

<!-- BEGIN settings_group_3_n -->
<div class="page-title">Доступ</div>
<!-- END settings_group_3_n -->

<!-- BEGIN settings_group_3 -->
<form action="/mss0fovnwli9zqf1xpbua/index.php?page=settings&action=submit&group_id={ID}" method="POST" enctype="multipart/form-data">
	<div class="form-group row">
		<label class="col-2 col-form-label">Название:</label>
		<div class="col-4">
			<input class="form-control" type="text" name="login" value="{LOGIN}">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-2 col-form-label">Пароль:</label>
		<div class="col-4">
			<input class="form-control" type="text" name="password">
		</div>
	</div>
	<div class="row page-button-block">
		<div class="col-4">
			<button class="btn btn-primary">Сохранить</button>
		</div>
	</div>
</form>
<!-- END settings_group_3 -->
<!-- BEGIN settings_group_1 -->
		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=settings&action=submit&group_id={ID}" method="POST" enctype="multipart/form-data">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">E-mail администратора:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="email" value="{EMAIL}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Шапка:</label>
                  <div class="col-10">
                    <textarea name="header" cols="100" rows="15" class="form-control">{HEADER}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Контакты в мобильном меню:</label>
                  <div class="col-10">
                    <textarea name="mobile_contact" cols="100" rows="10" class="form-control">{MOBILE_CONTACT}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Подвал:</label>
                  <div class="col-10">
                    <textarea name="footer" cols="100" rows="15" class="form-control">{FOOTER}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Карта:</label>
                  <div class="col-10">
                    <textarea name="map" cols="100" rows="15" class="form-control">{MAP}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст под текстом баннера:</label>
                  <div class="col-10">
                    <textarea name="banner" cols="100" rows="5" class="form-control">{BANNER}</textarea>
                  </div>
                </div>				
                <div class="form-group row">
                  <label class="col-2 col-form-label">Получить консультацию:</label>
                  <div class="col-10">
                    <textarea name="block1" cols="100" rows="10" class="form-control">{BLOCK1}</textarea>
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

			<div class="row page-button-block">
				<div class="col-4">
					<button class="btn btn-primary">Сохранить</button>
				</div>
			</div>
		</form>
<!-- END settings_group_1 -->

<script type="text/javascript" src="/files/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/files/tiny_mce/options.js"></script>
<!-- END settings -->

<!-- END center -->