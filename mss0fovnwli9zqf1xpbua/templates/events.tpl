<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="zagolovok">Тренировки</div>
<table>
<tr>
<td><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_27.png"></td>
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=new">Добавить</a> тренировку</td>
</tr>
</table>
<br>
<table>
<!-- BEGIN listing_item -->
<tr>
<td class="td_12">{NAME}</td>
<td class="td_13"><!-- BEGIN listing_item_up --><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=up&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_03.png" border="0"></a><!-- END listing_item_up --></td>
<td class="td_13"><!-- BEGIN listing_item_down --><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=down&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_04.png" border="0"></a></td><!-- END listing_item_down -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=edit&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_15.png" border="0"></td>
<!-- BEGIN listing_item_visible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_33.png" border="0"></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_32.png" border="0"></td>
<!-- END listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_08.png" border="0"></td>
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=rooms&pid={ID}">Упражнения</a></td>
</tr>
<!-- END listing_item -->
</table>

<!-- END listing -->

<!-- BEGIN event -->
<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.v2.1.4.min.js"></script>

<!-- BEGIN event_new -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events">Тренировки</a> &#8594; Добавление</div>
<!-- END event_new -->

<!-- BEGIN event_edit -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=events">Тренировки</a> &#8594; Редактирование</div>
<!-- END event_edit -->

<form action="/mss0fovnwli9zqf1xpbua/index.php?page=events&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="itab" id="itab" value="{ITAB}">
<div id="tabs">
    <ul>
        <li><a class="" href="#tabs-1" onclick="document.getElementById('itab').value='1';">Общая информация</a></li>
        <li><a class="" href="#tabs-2" onclick="document.getElementById('itab').value='2';">Мета</a></li>
    </ul>
    
    <div id="tabs-1">
<table>
<tr>
<td class="td_10" height="35"><nobr>Название:</nobr></td>
<td class="td_16"><input type="text" name="name" size="20" class="field" value="{NAME}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Сложность:</nobr></td>
<td class="td_16"><input type="text" name="level" size="20" class="field" value="{LEVEL}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Время:</nobr></td>
<td class="td_16"><input type="text" name="wtime" size="20" class="field" value="{WTIME}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>ЧПУ:</nobr></td>
<td class="td_16"><input type="text" name="cpu" size="20" class="field" value="{CPU}"></td>
<td class="td_11">— Для адресной строки, например "www.site.ru/<b>razdel</b>/". Латиница и цифры, без пробелов.</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Фото в список:</nobr></td>
<td class="td_16"><input type="file" name="img" size="20">{IMG}</td>
<td class="td_11">— В верстке 699х397</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Фото на старнице:</nobr></td>
<td class="td_16"><input type="file" name="img1" size="20">{IMG1}</td>
<td class="td_11">— В верстке 940х350</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Для зарегистрированных</nobr></td>
<td class="td_16"><input type="checkbox" name="forreg" {FORREG}></td>
<td class="td_11">— Если галочка стоит, то отображется только для зерегистрированных</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Включено</nobr></td>
<td class="td_16"><input type="checkbox" name="visible" {VISIBLE}></td>
<td class="td_11">— Если галочка стоит, то отображется на сайте</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Превью:</nobr></td>
<td colspan="2" class="td_16"><textarea name="textsmall" class="mceEditor">{TEXTSMALL}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Текст:</nobr></td>
<td colspan="2" class="td_16"><textarea name="text" class="mceEditor">{TEXT}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Видео:</nobr></td>
<td colspan="2" class="td_16"><textarea name="video" cols="100" rows="10">{VIDEO}</textarea></td>
</tr>
</table>
	</div>
	
    <div id="tabs-2">
<table>
<tr>
<td class="td_10" height="35"><nobr>Title:</nobr></td>
<td class="td_16"><textarea cols="70" rows="3" name="title">{TITLE}</textarea></td>
<td class="td_11">— Заголовок страницы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Description:</nobr></td>
<td class="td_16"><textarea cols="70" rows="3" name="description">{DESCRIPTION}</textarea></td>
<td class="td_11">— Описание страницы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Keywords:</nobr></td>
<td class="td_16"><textarea cols="70" rows="3" name="keywords">{KEYWORDS}</textarea></td>
<td class="td_11">— Ключевые слова страницы</td>
</tr>
</table>
	</div>
	
<table>
<tr>
<td class="td_4" height="35" width="70">&nbsp;</td>
<td><input type="image" src="/mss0fovnwli9zqf1xpbua/templates/files/button_4.png" onclick="submit();"></td>
<td>&nbsp;</td>
</tr>
</table>
</div>
</form>

<script type="text/javascript" src="/files/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/files/tiny_mce/options.js"></script>
<!-- END event -->

<!-- END center -->