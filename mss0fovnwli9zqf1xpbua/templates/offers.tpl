<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="page-title">Услуги</div>
<div class="page-subtitle"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=offers&action=new">Добавить</a> блок</div>

        <table class="table-items">
          <tbody>
<!-- BEGIN listing_item -->
			<tr>
			  <td class="table-items-title">{NAME}</td>
              <td class="text-center">
                <div class="item-to-top"><!-- BEGIN listing_item_up --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=offers&action=up&id={ID}"></a><!-- END listing_item_up --></div>
                <div class="item-to-bottom"><!-- BEGIN listing_item_down --><a class="item-to-link" href="/mss0fovnwli9zqf1xpbua/index.php?page=offers&action=down&id={ID}"></a><!-- END listing_item_down --></div>
              </td>
              <td class="text-center"><a class="item-edit" href="/mss0fovnwli9zqf1xpbua/index.php?page=offers&action=edit&id={ID}"></a></td>
<!-- BEGIN listing_item_visible -->
              <td class="text-center"><a class="item-active active" href="/mss0fovnwli9zqf1xpbua/index.php?page=offers&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"></a></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
              <td class="text-center"><a class="item-active" href="/mss0fovnwli9zqf1xpbua/index.php?page=offers&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"></a></td>
<!-- END listing_item_nvisible -->
              <td class="text-center"><a class="item-delete" href="/mss0fovnwli9zqf1xpbua/index.php?page=offers&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"></a></td>
			</tr>
<!-- END listing_item -->
		  </tbody>
		</table>
<!-- END listing -->

<!-- BEGIN offer -->

<!-- BEGIN offer_new -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=offers">Услуги</a> &#8594; Добавление</div>
<!-- END offer_new -->

<!-- BEGIN offer_edit -->
<div class="page-title"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=offers">Услуги</a> &#8594; Редактирование</div>
<!-- END offer_edit -->

			<form action="/mss0fovnwli9zqf1xpbua/index.php?page=offers&action=submit&id={ID}" method="POST" enctype="multipart/form-data" onsubmit="selectall();">
              <div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название_RU:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name" value="{NAME}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название_UA:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name_ua" value="{NAME_UA}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Название_EN:</label>
                  <div class="col-4">
                    <input class="form-control" type="text" name="name_en" value="{NAME_EN}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-2 col-form-label">Включено:</label>
                  <div class="col-1">
                    <input class="form-control" type="checkbox" name="visible" {VISIBLE}>
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
					<select multiple size="40" id="inside" class="form-control">
					<!-- BEGIN rm -->
					<option value="{ID}">{NAME}</option>
					<!-- END rm -->
					</select>
					<input type="hidden" id="rms" name="subs">
                  </div>
                  <div class="col-1">
					<input type="button" value="&uarr;" onclick="goup();" class="form-control"><br>
					<input type="button" value="&darr;" onclick="godown();" class="form-control">
                  </div>
                </div>
			  </div>
              <div class="row page-button-block">
				<div class="col-4">
				<button class="btn btn-primary">Сохранить</button>
			  </div>
			</form>
			
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
				x.after('<option value="'+$(this).val()+'">'+$(this).text()+'</option>');
				x.attr("selected", false);
				x.next().attr("selected", "selected");
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
<!-- END offer -->

<!-- END center -->