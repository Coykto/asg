<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="zagolovok" style="padding-bottom: 15px;">Комментарии</div>
{CID}
<br><br>
<table>
<tr>
<td><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_27.png"></td>
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=comments&action=new&cid={ID}">Добавить</a> комментарий</td>
</tr>
</table>
<br>
<table>
<!-- BEGIN listing_item -->
<tr>
<td class="td_17" style="vertical-align:middle;">{DATE}</td>
<td class="td_12" style="vertical-align:middle;">{NAME}</td>
<td class="td_12" style="vertical-align:middle;">{TEXT}</td>
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=comments&action=edit&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_15.png" border="0"></td>
<!-- BEGIN listing_item_visible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=comments&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_33.png" border="0"></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=comments&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_32.png" border="0"></td>
<!-- END listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=comments&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_08.png" border="0"></td>
</tr>
<!-- END listing_item -->
</table>

<!-- END listing -->

<!-- BEGIN comment -->

<!-- BEGIN comment_new -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=comments">Комментарии</a> &#8594; Добавление</div>
<!-- END comment_new -->

<!-- BEGIN comment_edit -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=comments">Комментарии</a> &#8594; Редактирование</div>
<!-- END comment_edit -->

<form action="/mss0fovnwli9zqf1xpbua/index.php?page=comments&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
<table>
<tr>
<td class="td_10" height="35"><nobr>Статья:</nobr></td>
<td class="td_16">{CID}</td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Имя:</nobr></td>
<td class="td_16"><input type="text" name="name" size="20" class="field" value="{NAME}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Email:</nobr></td>
<td class="td_16"><input type="text" name="email" size="20" class="field" value="{EMAIL}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Телефон:</nobr></td>
<td class="td_16"><input type="text" name="phone" size="20" class="field" value="{PHONE}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Дата:</nobr></td>
<td class="td_16"><input type="text" name="date" size="20" class="field calendar" value="{DATE}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Текст:</nobr></td>
<td colspan="2" class="td_16"><textarea name="text" class="mceEditor">{TEXT}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Показывать ответ</nobr></td>
<td class="td_16"><input type="checkbox" name="answer_show" {ANSWER_SHOW}></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Дата:</nobr></td>
<td class="td_16"><input type="text" name="answer_date" size="20" class="field calendar" value="{ANSWER_DATE}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Ответ:</nobr></td>
<td colspan="2" class="td_16"><textarea name="answer" class="mceEditor">{ANSWER}</textarea></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Включено</nobr></td>
<td class="td_16"><input type="checkbox" name="visible" {VISIBLE}></td>
<td class="td_11">— Если галочка стоит, то отображется на сайте</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>IP:</nobr></td>
<td class="td_16">{IP}</td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_4" height="35" width="70">&nbsp;</td>
<td><input type="image" src="/mss0fovnwli9zqf1xpbua/templates/files/button_4.png" onclick="submit();"></td>
<td>&nbsp;</td>
</tr>
</table>
</form>

<script type="text/javascript" src="/files/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/files/tiny_mce/options.js"></script>
<!-- END comment -->

<!-- END center -->