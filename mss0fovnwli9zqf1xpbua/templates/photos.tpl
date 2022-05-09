<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="zagolovok">Иконки на главной</div>
<table>
<tr>
<td><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_27.png"></td>
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=new">Добавить</a> иконку</td>
</tr>
</table>
<br>
<table>
<!-- BEGIN listing_item -->
<tr>
<td class="td_12">{NAME}</td>
<td class="td_13"><!-- BEGIN listing_item_up --><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=up&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_03.png" border="0" title="Вверх"><!-- END listing_item_up --></td>
<td class="td_13"><!-- BEGIN listing_item_down --><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=down&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_04.png" border="0" title="Вниз"></td><!-- END listing_item_down -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=edit&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_15.png" border="0"></a></td>
<!-- BEGIN listing_item_visible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_33.png" border="0" title="Выключить"></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_32.png" border="0" title="Включить"></td>
<!-- END listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_08.png" border="0" title="Удалить"></td>
</tr>
<!-- END listing_item -->
</table>

<!-- END listing -->

<!-- BEGIN photo -->

<!-- BEGIN photo_new -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos">Иконки на главной</a> &#8594; Добавление</div>
<!-- END photo_new -->

<!-- BEGIN photo_edit -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=photos">Иконки на главной</a> &#8594; Редактирование</div>
<!-- END photo_edit -->

<form action="/mss0fovnwli9zqf1xpbua/index.php?page=photos&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
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
<td class="td_10" height="35"><nobr>Ссылка:</nobr></td>
<td class="td_16"><input type="text" name="link" size="20" class="field" value="{LINK}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Иконка:</nobr></td>
<td class="td_16"><input type="file" name="img" class="field">{IMG}</td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Включено</nobr></td>
<td class="td_16"><input type="checkbox" name="visible" {VISIBLE}></td>
<td class="td_11"></td>
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
<td class="td_10" height="35"><nobr>Ссылка:</nobr></td>
<td class="td_16"><input type="text" name="link_ua" size="20" class="field" value="{LINK_UA}"></td>
<td class="td_11"></td>
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
<td class="td_10" height="35"><nobr>Ссылка:</nobr></td>
<td class="td_16"><input type="text" name="link_en" size="20" class="field" value="{LINK_EN}"></td>
<td class="td_11"></td>
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
<!-- END photo -->

<!-- END center -->