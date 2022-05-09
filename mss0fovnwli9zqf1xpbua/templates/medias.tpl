<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="zagolovok">СМИ о нас</div>
<table>
<tr>
<td><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_27.png"></td>
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=medias&action=new">Добавить</a> статью</td>
</tr>
</table>
<br>
<table>
<!-- BEGIN listing_item -->
<tr>
<td class="td_17">{DATE}</td>
<td class="td_12">{NAME}</td>
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=medias&action=edit&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_15.png" border="0"></td>
<!-- BEGIN listing_item_visible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=medias&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_33.png" border="0"></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=medias&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_32.png" border="0"></td>
<!-- END listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=medias&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_08.png" border="0"></td>
</tr>
<!-- END listing_item -->
</table>
<!-- END listing -->

<!-- BEGIN media -->

<!-- BEGIN media_new -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=medias">СМИ о нас</a> &#8594; Добавление</div>
<!-- END media_new -->

<!-- BEGIN media_edit -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=medias">СМИ о нас</a> &#8594; Редактирование</div>
<!-- END media_edit -->

<form action="/mss0fovnwli9zqf1xpbua/index.php?page=medias&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="itab" id="itab" value="{ITAB}">
<div id="tabs">
    <ul>
        <li><a href="#tabs-1" onclick="document.getElementById('itab').value='1';return false;">RU</a></li>
		<li><a href="#tabs-2" onclick="document.getElementById('itab').value='2';return false;">UA</a></li>
		<li><a href="#tabs-3" onclick="document.getElementById('itab').value='3';return false;">EN</a></li>
    </ul>
    
    <div id="tabs-1">
<table>
<tr>
<td class="td_10" height="35"><nobr>Название:</nobr></td>
<td class="td_16"><input type="text" name="name" size="20" class="field" value="{NAME}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Дата:</nobr></td>
<td class="td_16"><input type="text" name="date" size="20" class="field calendar" value="{DATE}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>ЧПУ:</nobr></td>
<td class="td_16"><input type="text" name="cpu" size="20" class="field" value="{CPU}"></td>
<td class="td_11">— Для адресной строки, например "www.site.ru/<b>razdel</b>/". Латиница и цифры, без пробелов.</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Включено</nobr></td>
<td class="td_16"><input type="checkbox" name="visible" {VISIBLE}></td>
<td class="td_11">— Если галочка стоит, то отображется на сайте</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Превью текст:</nobr></td>
<td colspan="2" class="td_16"><textarea name="textsmall" class="mceEditor">{TEXTSMALL}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Текст:</nobr></td>
<td colspan="2" class="td_16"><textarea name="text" class="mceEditor">{TEXT}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Title:</nobr></td>
<td class="td_16"><input type="text" name="title" size="20" class="field" value="{TITLE}"></td>
<td class="td_11">— Заголовок страницы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Description:</nobr></td>
<td class="td_16"><input type="text" name="description" size="20" class="field" value="{DESCRIPTION}"></td>
<td class="td_11">— Описание страницы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Keywords:</nobr></td>
<td class="td_16"><input type="text" name="keywords" size="20" class="field" value="{KEYWORDS}"></td>
<td class="td_11">— Ключевые слова страницы</td>
</tr>
</table>
	</div>

    <div id="tabs-2">
<table>
<tr>
<td class="td_10" height="35"><nobr>Название:</nobr></td>
<td class="td_16"><input type="text" name="name_ua" size="20" class="field" value="{NAME_UA}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Превью текст:</nobr></td>
<td colspan="2" class="td_16"><textarea name="textsmall_ua" class="mceEditor">{TEXTSMALL_UA}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Текст:</nobr></td>
<td colspan="2" class="td_16"><textarea name="text_ua" class="mceEditor">{TEXT_UA}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Title:</nobr></td>
<td class="td_16"><input type="text" name="title_ua" size="20" class="field" value="{TITLE_UA}"></td>
<td class="td_11">— Заголовок страницы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Description:</nobr></td>
<td class="td_16"><input type="text" name="description_ua" size="20" class="field" value="{DESCRIPTION_UA}"></td>
<td class="td_11">— Описание страницы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Keywords:</nobr></td>
<td class="td_16"><input type="text" name="keywords_ua" size="20" class="field" value="{KEYWORDS_UA}"></td>
<td class="td_11">— Ключевые слова страницы</td>
</tr>
</table>
	</div>

    <div id="tabs-3">
<table>
<tr>
<td class="td_10" height="35"><nobr>Название:</nobr></td>
<td class="td_16"><input type="text" name="name_en" size="20" class="field" value="{NAME_EN}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Превью текст:</nobr></td>
<td colspan="2" class="td_16"><textarea name="textsmall_en" class="mceEditor">{TEXTSMALL_EN}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Текст:</nobr></td>
<td colspan="2" class="td_16"><textarea name="text_en" class="mceEditor">{TEXT_EN}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Title:</nobr></td>
<td class="td_16"><input type="text" name="title_en" size="20" class="field" value="{TITLE_EN}"></td>
<td class="td_11">— Заголовок страницы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Description:</nobr></td>
<td class="td_16"><input type="text" name="description_en" size="20" class="field" value="{DESCRIPTION_EN}"></td>
<td class="td_11">— Описание страницы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Keywords:</nobr></td>
<td class="td_16"><input type="text" name="keywords_en" size="20" class="field" value="{KEYWORDS_EN}"></td>
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
<!-- END media -->

<!-- END center -->