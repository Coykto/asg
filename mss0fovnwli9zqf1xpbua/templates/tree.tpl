<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree">Структура сайта</a><!-- BEGIN listing_bread -->  &#8594; <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&parent_id={PARENT_ID}">{NAME}</a><!-- END listing_bread --></div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=new&parent_id={PARENT_ID}">Добавить</a> раздел</div>

<form action="" method="post">
	<div class="form-group row">
		<div class="col-3">
			<input type="text" name="sea" value="{SEA}" class="form-control" placeholder="Поиск">
		</div>
		<div class="col-1">
			<input type="submit" value=">>>" class="form-control">
		</div>
	</div>
</form>
<!-- BEGIN res -->
<table class="table-items">
<tbody>
<!-- BEGIN res_item -->
<tr>
<td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=edit&id={ID}"></a></td>
<td class="table-items-title">{NAME}</td>
<!-- BEGIN res_item_visible -->
<td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END res_item_visible -->
<!-- BEGIN res_item_nvisible -->
<td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END res_item_nvisible -->
<td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
</tr>
<!-- END res_item -->
</tbody>
</table>
<!-- END res -->

        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
              <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=edit&id={ID}"></a></td>
			  <td class="table-items-title"><!-- BEGIN listing_item_a1 --><a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&parent_id={ID}"><!-- END listing_item_a1 -->{NAME}<!-- BEGIN listing_item_a2 --></a><!-- END listing_item_a2 --></td>
              <td class="text-center">
                <div class="item-to-top"><!-- BEGIN listing_item_up --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=up&id={ID}&parent_id={PARENT_ID}"></a><!-- END listing_item_up --></div>
                <div class="item-to-bottom"><!-- BEGIN listing_item_down --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=down&id={ID}&parent_id={PARENT_ID}"></a><!-- END listing_item_down --></div>
              </td>
              <td class="text-center"><!-- BEGIN listing_item_p --><a class="item-add" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=new&parent_id={PARENT_ID}"></a><!-- END listing_item_p --></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			  <td class="text-center"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=releases&cid={ID}">Товары</a></td>
			  <td class="text-center"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&cid={ID}">Преимущества</a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN tree -->

<!-- BEGIN tree_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree">Структура сайта</a> <!-- BEGIN tree_new_bread --> &#8594; <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&parent_id={PARENT_ID}">{NAME}</a> <!-- END tree_new_bread -->&#8594; Добавление</div>
<!-- END tree_new -->

<!-- BEGIN tree_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree">Структура сайта</a> <!-- BEGIN tree_edit_bread --> &#8594; <a href="/mss0fovnwli9zqf1xpbua/index.php?page=tree&parent_id={PARENT_ID}">{NAME}</a> <!-- END tree_edit_bread -->&#8594; Редактирование</div>
<!-- END tree_edit -->

        <ul class="page-container-nav nav nav-pills" id="pills-tab">
          <li class="nav-item"><a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" onclick="$('#pills').val('1');">Основная информация</a></li>
          <li class="nav-item"><a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" onclick="$('#pills').val('2');">Мета</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" onclick="$('#pills').val('3');">Галерея</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4" onclick="$('#pills').val('4');">Красная полоска</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-5-tab" data-toggle="pill" href="#pills-5" onclick="$('#pills').val('5');">FAQ</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-6-tab" data-toggle="pill" href="#pills-6" onclick="$('#pills').val('6');">Блог</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-7-tab" data-toggle="pill" href="#pills-7" onclick="$('#pills').val('7');">Другие</a></li>
		  <li class="nav-item"><a class="nav-link" id="pills-8-tab" data-toggle="pill" href="#pills-8" onclick="$('#pills').val('8');">Подразделы</a></li>
		  <li class="nav-item"><a class="nav-link" target="_blank" href="/mss0fovnwli9zqf1xpbua/index.php?page=advantages&cid={ID}">Преимущества</a></li>
        </ul>

		<form action="/mss0fovnwli9zqf1xpbua/index.php?page=tree&action=submit&id={ID}" method="POST" enctype="multipart/form-data" onsubmit="selectall()">
		<input type="hidden" value="{PILLS}" name="pills" id="pills" >
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show" id="pills-8">
              <div>
                <div class="form-group row">
                  <div class="col-5">
                    <input class="form-control" type="text" id="ch_ssearch" placeholder="Поиск">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-5">
					<select multiple size="40" id="ch_outside" class="form-control">
					<!-- BEGIN ch_rm1 -->
					<option value="{ID}">{MARGIN}{NAME}</option>
					<!-- END ch_rm1 -->
					</select>
                  </div>
                  <div class="col-1">
						<input type="button" value=">>>" onclick="ch_goin();" class="form-control"><br>
						<input type="button" value="<<<" onclick="ch_goout();" class="form-control">
                  </div>
                  <div class="col-5">
					<select multiple size="20" id="ch_inside" class="form-control">
					<!-- BEGIN ch_rm -->
					<option value="{ID}">{NAME}</option>
					<!-- END ch_rm -->
					</select>
					<input type="hidden" id="ch_rms" name="ch_ids">
                  </div>
                  <div class="col-1">
						<input type="button" value="&uarr;" onclick="ch_goup();" class="form-control"><br>
						<input type="button" value="&darr;" onclick="ch_godown();" class="form-control">
                  </div>
                </div>
<script>
function ch_goup()
{
    $("#ch_inside option:selected" ).each(function() {
		var $select = $('#ch_inside');
		var ind = $(this).index();
		if (ind>0) $select.find('option').eq(ind-1).before($select.find('option:eq('+ind+')')); 
    });
}
function ch_godown()
{
    $("#ch_inside option:selected" ).each(function() {
		var $select = $('#ch_inside');
		var ind = $(this).index();
		$select.find('option').eq(ind+1).after($select.find('option:eq('+ind+')')); 
    });
}
function ch_goin()
{
    $("#ch_outside option:selected" ).each(function() {
		if ($("#ch_inside [value='"+$(this).val()+"']").length<1) 
		{
			var x = $('#ch_inside option:selected');
			if (x.val()>0) 
			{
				x.prop("selected", false);
				x.after('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
				x.next().prop("selected", "selected");
			}
			else $('#ch_inside').append('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
		}
    });
}
function ch_goout()
{
    $("#ch_inside option:selected" ).each(function() {
      $(this).remove();
    });
}

	jQuery.expr[":"].Contains = jQuery.expr.createPseudo(function(arg) {
		return function( elem ) {
			return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
		};
	});

$(document).ready(function(){

	$('#ch_ssearch').keyup(function(){
		var temp = $(this).val();
		if (temp != '')
		{
			$('#ch_outside option').hide();
			$('#ch_outside option:Contains("'+temp+'")').show();
		}
		else $('#ch_outside option').show();
	});
	
});

</script>
			  </div>
			</div>
            <div class="tab-pane fade show" id="pills-7">
              <div>
                <div class="form-group row">
                  <div class="col-5">
                    <input class="form-control" type="text" id="price_ssearch" placeholder="Поиск">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-5">
					<select multiple size="40" id="price_outside" class="form-control">
					<!-- BEGIN price_rm1 -->
					<option value="{ID}">{MARGIN}{NAME}</option>
					<!-- END price_rm1 -->
					</select>
                  </div>
                  <div class="col-1">
						<input type="button" value=">>>" onclick="price_goin();" class="form-control"><br>
						<input type="button" value="<<<" onclick="price_goout();" class="form-control">
                  </div>
                  <div class="col-5">
					<select multiple size="20" id="price_inside" class="form-control">
					<!-- BEGIN price_rm -->
					<option value="{ID}">{NAME}</option>
					<!-- END price_rm -->
					</select>
					<input type="hidden" id="price_rms" name="price_ids">
                  </div>
                  <div class="col-1">
						<input type="button" value="&uarr;" onclick="price_goup();" class="form-control"><br>
						<input type="button" value="&darr;" onclick="price_godown();" class="form-control">
                  </div>
                </div>
<script>
function price_goup()
{
    $("#price_inside option:selected" ).each(function() {
		var $select = $('#price_inside');
		var ind = $(this).index();
		if (ind>0) $select.find('option').eq(ind-1).before($select.find('option:eq('+ind+')')); 
    });
}
function price_godown()
{
    $("#price_inside option:selected" ).each(function() {
		var $select = $('#price_inside');
		var ind = $(this).index();
		$select.find('option').eq(ind+1).after($select.find('option:eq('+ind+')')); 
    });
}
function price_goin()
{
    $("#price_outside option:selected" ).each(function() {
		if ($("#price_inside [value='"+$(this).val()+"']").length<1) 
		{
			var x = $('#price_inside option:selected');
			if (x.val()>0) 
			{
				x.prop("selected", false);
				x.after('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
				x.next().prop("selected", "selected");
			}
			else $('#price_inside').append('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
		}
    });
}
function price_goout()
{
    $("#price_inside option:selected" ).each(function() {
      $(this).remove();
    });
}

	jQuery.expr[":"].Contains = jQuery.expr.createPseudo(function(arg) {
		return function( elem ) {
			return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
		};
	});

$(document).ready(function(){

	$('#price_ssearch').keyup(function(){
		var temp = $(this).val();
		if (temp != '')
		{
			$('#price_outside option').hide();
			$('#price_outside option:Contains("'+temp+'")').show();
		}
		else $('#price_outside option').show();
	});
	
});

</script>
			  </div>
			</div>
            <div class="tab-pane fade show" id="pills-6">
              <div>
                <div class="form-group row">
                  <div class="col-5">
                    <input class="form-control" type="text" name="blogname" value="{BLOGNAME}" placeholder="Название блока">
                  </div>
                </div>
				<div class="form-group row">
                  <div class="col-5">
					<select class="form-control" name="blogscheme">
						<option value="0">Схема из дизайна на 5 блоков</option>
						<option value="1"{BLOGSCHEME1}>Схема Первая из доработки на 6 блоков</option>
						<option value="2"{BLOGSCHEME2}>Схема Вторая из доработки на 7 блоков</option>
						<option value="3"{BLOGSCHEME3}>Схема Третья из доработки на 5 блоков</option>
					</select>
                  </div>
				</div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото слева от статьи:</label>
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
	
	var ids = [];
    $("#price_inside option").each(function(i, selected) {
		ids[i] = $(selected).val();
    });
	$("#price_rms").val(ids);
	
	var ids = [];
    $("#ch_inside option").each(function(i, selected) {
		ids[i] = $(selected).val();
    });
	$("#ch_rms").val(ids);
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
                  <label class="col-2 col-form-label">FAQ:</label>
                  <div class="col-10">
                    <textarea name="faq" class="form-control" cols="100" rows="30">{FAQ}</textarea>
					Вопрос и ответ разделять --- . Блоки вопрос/ответ разделять ----- .
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade" id="pills-4">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название1:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="redlinename1" value="{REDLINENAME1}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Иконка1:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="redlineimg1">
                        </label>
                        <div class="form-upload-block-text"></div>
                      </div>
                      <div class="custom-form-upload-text">{REDLINEIMG1}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст1:</label>
                  <div class="col-10">
                    <textarea name="redlinetext1" class="form-control" cols="100" rows="3">{REDLINETEXT1}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название2:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="redlinename2" value="{REDLINENAME2}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Иконка2:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="redlineimg2">
                        </label>
                        <div class="form-upload-block-text"></div>
                      </div>
                      <div class="custom-form-upload-text">{REDLINEIMG2}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст2:</label>
                  <div class="col-10">
                    <textarea name="redlinetext2" class="form-control" cols="100" rows="3">{REDLINETEXT2}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название3:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="redlinename3" value="{REDLINENAME3}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Иконка3:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="redlineimg3">
                        </label>
                        <div class="form-upload-block-text"></div>
                      </div>
                      <div class="custom-form-upload-text">{REDLINEIMG3}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст3:</label>
                  <div class="col-10">
                    <textarea name="redlinetext3" class="form-control" cols="100" rows="3">{REDLINETEXT3}</textarea>
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade" id="pills-3">
			  <div class="gallery-block">
<!-- BEGIN showfoto -->
                <div class="gallery-item" style="width:200px;">
				  <a target="_blank" href="/templates/images/tree/{IMG}"><img src="/templates/images/tree/{SIMG}" class="gallery-img" style="width: 200px;"></a>
					<div class="form-group row" style="border: none;padding: 1px;">
						<input class="form-control" type="text" name="galord{IID}" value="{ORDERNUM}" placeholder="Порядковый номер">
					</div>
                </div>
<!-- END showfoto -->
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
                  <label class="col-2 col-form-label">Заголовок на странице:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="h1" value="{H1}">
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
                  <label class="col-2 col-form-label">ЧПУ:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="cpu" value="{CPU}">
                  </div>
                  <div class="col-6 form-text">
                    <p>— Для адресной строки, например "www.site.ru/item/razdel/". Латиница и цифры, без пробелов.</p>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Тип страницы:</label>
                  <div class="col-4">
                    {PTID}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Ссылка:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="link" value="{LINK}">
                  </div>
                  <div class="col-6 form-text">
                    <p>— Приоритетней ЧПУ</p>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото в список:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img">
                        </label>
                        <div class="form-upload-block-text">Квадрат</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото в список дополнительных услуг:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img4">
                        </label>
                        <div class="form-upload-block-text">Прямоугольное</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG4}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Новинка:</label>
                  <div class="col-1">
                    <input type="checkbox" name="newitem" {NEWITEM}>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Иконка1 на главной:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img1">
                        </label>
                        <div class="form-upload-block-text">В верстке 82х82px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG1}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Иконка2 на главной:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="img2">
                        </label>
                        <div class="form-upload-block-text">В верстке 307х307px</div>
                      </div>
                      <div class="custom-form-upload-text">{IMG2}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст возле иконки:</label>
                  <div class="col-10">
                    <textarea name="textsmall1" class="form-control" rows="2">{TEXTSMALL1}</textarea>
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
                  <label class="col-2 col-form-label">Баннер мобильный:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="banner_mobile">
                        </label>
                        <div class="form-upload-block-text"></div>
                      </div>
                      <div class="custom-form-upload-text">{BANNER_MOBILE}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Фото слева от статьи:</label>
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
                  <label class="col-2 col-form-label">Текст на баннере:</label>
                  <div class="col-10">
                    <textarea name="banner_text" class="form-control" cols="100" rows="5">{BANNER_TEXT}</textarea>
                  </div>
                </div>
				
                <div class="form-group row">
                  <label class="col-2 col-form-label">Получить консультацию иконка:</label>
                  <div class="col-10">
                    <div class="custom-form-upload">
                      <div class="form-upload-block">
                        <label class="form-upload-label btn btn-primary btn-sm">Выберите файл
                          <input class="form-upload-hidden" type="file" name="cons_img">
                        </label>
                        <div class="form-upload-block-text">В верстке 100х100px</div>
                      </div>
                      <div class="custom-form-upload-text">{CONS_IMG}</div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Получить консультацию текст:</label>
                  <div class="col-10">
                    <textarea name="cons_text" class="form-control" rows="2">{CONS_TEXT}</textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст в список:</label>
                  <div class="col-10">
                    <textarea name="textsmall" class="form-control" rows="6">{TEXTSMALL}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Текст:</label>
                  <div class="col-10">
                    <textarea name="text" class="mceEditor">{TEXT}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Еще текст:</label>
                  <div class="col-10">
                    <textarea name="text1" class="mceEditor">{TEXT1}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Еще текст:</label>
                  <div class="col-10">
                    <textarea name="text2" class="mceEditor">{TEXT2}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Еще текст:</label>
                  <div class="col-10">
                    <textarea name="text3" class="mceEditor">{TEXT3}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Включено:</label>
                  <div class="col-1">
                    <input type="checkbox" name="visible" {VISIBLE}>
                  </div>
                </div>
			  </div>
			</div>
            <div class="tab-pane fade" id="pills-2">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Title:</label>
                  <div class="col-10">
					<textarea name="title" class="form-control" cols="100" rows="3">{TITLE}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Description:</label>
                  <div class="col-10">
					<textarea name="description" class="form-control" cols="100" rows="3">{DESCRIPTION}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Keywords:</label>
                  <div class="col-10">
					<textarea name="keywords" class="form-control" cols="100" rows="3">{KEYWORDS}</textarea>
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
<!-- END tree -->

<!-- END center -->