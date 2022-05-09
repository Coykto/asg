<!-- BEGIN center -->

<!-- BEGIN listing -->
<div class="zagolovok">Клиенты</div>
<table>
<tr>
<td><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_27.png"></td>
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users&action=new">Добавить</a> клиента</td>
</tr>
</table>
<br>
<table>
<!-- BEGIN listing_item -->
<tr<!-- BEGIN listing_item_p --> style="background-color: #dff7df;"<!-- END listing_item_p -->>
<td class="td_12">{NAME}</td>
<td class="td_12">{FNAME}</td>
<td class="td_12">{EMAIL}</td>
<td class="td_12">{PHONE}</td>
<td class="td_12">{ADDRESS}</td>
<td class="td_13"><!-- BEGIN listing_item_up --><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users&action=up&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_03.png" border="0" title="Вверх"><!-- END listing_item_up --></td>
<td class="td_13"><!-- BEGIN listing_item_down --><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users&action=down&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_04.png" border="0" title="Вниз"></td><!-- END listing_item_down -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users&action=edit&id={ID}"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_15.png" border="0"></a></td>
<!-- BEGIN listing_item_visible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users&action=nvisible&id={ID}" onclick="if (!confirm('Выключить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_33.png" border="0" title="Выключить"></td>
<!-- END listing_item_visible -->
<!-- BEGIN listing_item_nvisible -->
<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users&action=visible&id={ID}" onclick="if (!confirm('Включить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_32.png" border="0" title="Включить"></td>
<!-- END listing_item_nvisible -->
<!--<td class="td_13"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users&action=delete&id={ID}" onclick="if (!confirm('Удалить?')) return false;"><img src="/mss0fovnwli9zqf1xpbua/templates/files/icon_08.png" border="0" title="Удалить"></td>-->
</tr>
<!-- END listing_item -->
</table>

<!-- END listing -->

<!-- BEGIN user -->

<!-- BEGIN user_new -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users">Клиенты</a> &#8594; Добавление</div>
<!-- END user_new -->

<!-- BEGIN user_edit -->
<div class="zagolovok"><a href="/mss0fovnwli9zqf1xpbua/index.php?page=users">Клиенты</a> &#8594; Редактирование</div>
<!-- END user_edit -->

<form action="/mss0fovnwli9zqf1xpbua/index.php?page=users&action=submit&id={ID}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="itab" id="itab" value="{ITAB}">
<div id="tabs">
    <ul>
        <li><a class="" href="#tabs-1" onclick="$('#itab').val('1');">Общее</a></li>
        <li><a class="" href="#tabs-2" onclick="$('#itab').val('2');">История бонусов</a></li>
    </ul>

    <div id="tabs-2">
<table>
<!-- BEGIN his -->
<tr>
<td class="td_12">{DATE}</td>
<td class="td_12">{PRICE}</td>
<td class="td_12"><!-- BEGIN his_o --><a href="/mss0fovnwli9zqf1xpbua/index.php?page=order&action=edit&id={ID}">№{ID}</a><!-- END his_o --></td>
<td class="td_12">{COMM}</td>
</tr>
<!-- END his -->
</table>
	</div>
	
    <div id="tabs-1">
<table>
<tr>
<td class="td_10" height="35"><nobr>Имя:</nobr></td>
<td class="td_16"><input type="text" name="name" size="20" class="field" value="{NAME}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Фамилия:</nobr></td>
<td class="td_16"><input type="text" name="fname" size="20" class="field" value="{FNAME}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>E-mail:</nobr></td>
<td class="td_16"><input type="text" name="email" size="20" class="field" value="{EMAIL}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Пароль:</nobr></td>
<td class="td_16"><input type="text" name="password" size="20" class="field" value="" placeholder="Заполнять, если хотите сменить"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Телефон:</nobr></td>
<td class="td_16"><input type="text" name="phone" size="20" class="field" value="{PHONE}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Адрес:</nobr></td>
<td class="td_16"><input type="text" name="address" size="20" class="field" value="{ADDRESS}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Партнер</nobr></td>
<td class="td_16"><input type="checkbox" name="partner" {PARTNER}></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Код:</nobr></td>
<td class="td_16"><input type="text" name="p_code" size="20" class="field" value="{P_CODE}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Скидка покупателю в %:</nobr></td>
<td class="td_16"><input type="text" name="p_percent" size="20" class="field" value="{P_PERCENT}"></td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Бонус партнеру в %:</nobr></td>
<td class="td_16"><input type="text" name="p_bonus" size="20" class="field" value="{P_BONUS}"></td>
<td class="td_11">&mdash; от оплаченной покупателем суммы</td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Сумма для выплаты:</nobr></td>
<td class="td_16">{BONUS_MONEY}</td>
<td class="td_11"></td>
</tr>
<tr>
<td class="td_10" height="35"><nobr>Включено</nobr></td>
<td class="td_16"><input type="checkbox" name="visible" {VISIBLE}></td>
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

<!-- END user -->

<!-- END center -->