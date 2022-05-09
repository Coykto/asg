<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Меню</div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=new">Добавить</a> пункт</div>

        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
              <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=edit&id={ID}"></a></td>
			  <td class="table-items-title">{MARGIN}{NAME}</td>
              <td class="text-center">
                <div class="item-to-top"><!-- BEGIN listing_item_up --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=up&id={ID}&parent_id={PARENT_ID}"></a><!-- END listing_item_up --></div>
                <div class="item-to-bottom"><!-- BEGIN listing_item_down --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=down&id={ID}&parent_id={PARENT_ID}"></a><!-- END listing_item_down --></div>
              </td>
              <td class="text-center"><!-- BEGIN listing_item_p --><a class="item-add" href="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=new&parent_id={PARENT_ID}"></a><!-- END listing_item_p --></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN service -->

<!-- BEGIN service_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=services">Меню</a> &#8594; Добавление</div>
<!-- END service_new -->

<!-- BEGIN service_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=services">Меню</a> &#8594; Редактирование</div>
<!-- END service_edit -->

		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=services&action=submit&id={ID}" method="POST" enctype="multipart/form-data" onsubmit="selectall()">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Родительский раздел:</label>
                  <div class="col-4">
					<select name="parent_id" class="form-control">
						<option value="0"></option>
						<!-- BEGIN parent -->
						<option value="{ID}"{SELECTED}>{MARGIN}{NAME}</option>
						<!-- END parent -->
					</select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Страница из структуры:</label>
                  <div class="col-4">
					<select name="pid" class="form-control">
						<option value="0"></option>
						<!-- BEGIN pid -->
						<option value="{ID}"{SELECTED}>{MARGIN}{NAME}</option>
						<!-- END pid -->
					</select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Тип меню:</label>
                  <div class="col-4">
					<select name="mtype" class="form-control">
						<option value="0">2 уровня подразделов</option>
						<option value="1"{MTYPE1}>1 уровень подразделов</option>
						<option value="2"{MTYPE2}>1 уровень подразделов с фото</option>
						<option value="3"{MTYPE3}>без подразделов</option>
					</select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Включено:</label>
                  <div class="col-1">
                    <input type="checkbox" name="visible" {VISIBLE}>
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
<!-- END service -->

<!-- END center -->