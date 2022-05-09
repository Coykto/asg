<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Блог</div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=new">Добавить</a> статью</div>

        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
			  <td>{DATE}</td>
			  <td class="table-items-title">{NAME}</td>
			  <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=edit&id={ID}"></a></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN article -->

<!-- BEGIN article_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=articles">Блог</a> &#8594; Добавление</div>
<!-- END article_new -->

<!-- BEGIN article_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=articles">Блог</a> &#8594; Редактирование</div>
<!-- END article_edit -->


        <ul class="page-container-nav nav nav-pills" id="pills-tab">
          <li class="nav-item"><a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" onclick="$('#pills').val('1');">Текст</a></li>
          <li class="nav-item"><a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" onclick="$('#pills').val('2');">Мета</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" onclick="$('#pills').val('3');">Галерея</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4" onclick="$('#pills').val('4');">Разделы каталога</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-5-tab" data-toggle="pill" href="#pills-5" onclick="$('#pills').val('5');">Тэги</a></li>
        </ul>
		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=submit&id={ID}" method="POST" enctype="multipart/form-data" onsubmit="selectall()">
		<input type="hidden" value="{PILLS}" name="pills" id="pills" >
          <div class="tab-content" id="pills-tabContent">
		  
            <div class="tab-pane fade show" id="pills-4">
              <div>
                <div class="form-group row">
                  <div class="col-5">
                    <input class="form-control" type="text" id="ssearch" placeholder="Поиск">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-5">
					<select multiple size="40" id="outside" class="form-control">
					<!-- BEGIN rm1 -->
					<option value="{ID}">{MARGIN}{NAME}</option>
					<!-- END rm1 -->
					</select>
                  </div>
                  <div class="col-1">
						<input type="button" value=">>>" onclick="goin();" class="form-control"><br>
						<input type="button" value="<<<" onclick="goout();" class="form-control">
                  </div>
                  <div class="col-5">
					<select multiple size="20" id="inside" class="form-control">
					<!-- BEGIN rm -->
					<option value="{ID}">{NAME}</option>
					<!-- END rm -->
					</select>
					<input type="hidden" id="rms" name="rm_ids">
                  </div>
                  <div class="col-1">
						<input type="button" value="&uarr;" onclick="goup();" class="form-control"><br>
						<input type="button" value="&darr;" onclick="godown();" class="form-control">
                  </div>
                </div>
<script>
function goup()
{
    $("#inside option:selected" ).each(function() {
		var $select = $('#inside');
		var ind = $(this).index();
		if (ind>0) $select.find('option').eq(ind-1).before($select.find('option:eq('+ind+')')); 
    });
}
function godown()
{
    $("#inside option:selected" ).each(function() {
		var $select = $('#inside');
		var ind = $(this).index();
		$select.find('option').eq(ind+1).after($select.find('option:eq('+ind+')')); 
    });
}
function goin()
{
    $("#outside option:selected" ).each(function() {
		if ($("#inside [value='"+$(this).val()+"']").length<1) 
		{
			var x = $('#inside option:selected');
			if (x.val()>0) 
			{
				x.prop("selected", false);
				x.after('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
				x.next().prop("selected", "selected");
			}
			else $('#inside').append('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
		}
    });
}
function goout()
{
    $("#inside option:selected" ).each(function() {
      $(this).remove();
    });
}
function selectall()
{
	var ids = [];
    $("#inside option").each(function(i, selected) {
		ids[i] = $(selected).val();
    });
	$("#rms").val(ids);
}

	jQuery.expr[":"].Contains = jQuery.expr.createPseudo(function(arg) {
		return function( elem ) {
			return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
		};
	});

$(document).ready(function(){

	$('#ssearch').keyup(function(){
		var temp = $(this).val();
		if (temp != '')
		{
			$('#outside option').hide();
			$('#outside option:Contains("'+temp+'")').show();
		}
		else $('#outside option').show();
	});
	
});

</script>
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
				<div class="form-group row">
                  <div class="col-5">
					<select class="form-control" name="blogscheme">
						<option value="0">Схема из дизайна на 6 блоков</option>
						<!--<option value="1"{BLOGSCHEME1}>Схема Первая из доработки на 6 блоков</option>-->
						<option value="2"{BLOGSCHEME2}>Схема Вторая из доработки на 7 блоков</option>
						<option value="3"{BLOGSCHEME3}>Схема Третья из доработки на 5 блоков</option>
					</select>
                  </div>
				</div>
				Желательно не менее 747х734px.<br><br>
			  <div class="gallery-block">
<!-- BEGIN showfoto -->
                <div class="gallery-item">
				  <a target="_blank" href="/templates/images/articles/{IMG}"><img src="/templates/images/articles/{SIMG}" class="gallery-img" style="width: 100px;"></a>
					<!--<div class="form-group row" style="border: none;padding: 1px;">
						<input class="form-control" type="text" name="galname{IID}" value="{NAME}" placeholder="Название">
					</div>-->
                  <div class="gallery-btns">
                    <div class="gallery-btn hor-item-to">
                      <!-- BEGIN gf_up --><div class="item-to-top"><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=moveupf&id={ID}&iid={IID}"></a></div><!-- END gf_up -->
                      <!-- BEGIN gf_down --><div class="item-to-bottom"><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=movedownf&id={ID}&iid={IID}"></a></div><!-- END gf_down -->
                    </div>
<!-- BEGIN gf_visible -->
                    <div class="gallery-btn"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=nvisiblef&id={ID}&iid={IID}" onclick="if (!confirm('Выключить?')) return false;"></a></div>
<!-- END gf_visible -->
<!-- BEGIN gf_nvisible -->
                    <div class="gallery-btn"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=visiblef&id={ID}&iid={IID}" onclick="if (!confirm('Включить?')) return false;"></a></div>
<!-- END gf_nvisible -->
                    <div class="gallery-btn"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=articles&action=delf&id={ID}&iid={IID}&img={IMG}&simg={SIMG}" onclick="if (!confirm ('Уверены?')) return false;"></a></div>
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
                  <div class="col-8">
                    <textarea name="name1" class="form-control" rows="3">{NAME1}</textarea>
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
                  <label class="col-2 col-form-label">Фото в список квадрат:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img">
                        </label>
                        <div class="form-upload-block-text">Желательно 800x800px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото в список прямоугольник (если нету, используется квадрат):</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img1">
                        </label>
                        <div class="form-upload-block-text">Желательно 798x382px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG1}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото внутрь:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img2">
                        </label>
                        <div class="form-upload-block-text">В верстке 1920x617px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG2}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото внутрь мобильный:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img2_mobile">
                        </label>
                        <div class="form-upload-block-text"></div>
                      </div>
                      <div class="custom-form-upload-text">{IMG2_MOBILE}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото слева от статьи внутри услуги:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img3">
                        </label>
                        <div class="form-upload-block-text">В верстке 615х615px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG3}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Короткий текст:</label>
                  <div class="col-10">
                    <textarea name="textsmall" class="form-control" rows="3">{TEXTSMALL}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст:</label>
                  <div class="col-10">
                    <textarea name="text" class="mceEditor">{TEXT}</textarea>
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
<!-- END article -->

<!-- END center -->