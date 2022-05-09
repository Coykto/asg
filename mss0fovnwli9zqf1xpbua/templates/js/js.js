$(document).ready(function(){

	$('.plus').click(function(){
		var id = $(this).attr('data-id');
		var h = $(this).html();
		if (h=='+')
		{
			$('.tt'+id).show();
			$(this).removeClass('minus');
			$(this).addClass('plus');
			$(this).html('-');
		}
		else if (h=='-')
		{
			$('.dd'+id).hide();
			$(this).parent().parent().show();
			$(this).removeClass('plus');
			$(this).addClass('minus');
			$(this).html('+');
			$('.dd'+id+' .plus').html('+');
		}
	});

	if (location.hash!='')
	{
		var hhash=location.hash.split('#');
		if (hhash[1].substring(0,5)=='pills')
		{
			setTimeout(
				function() 
				{
//					alert('#'+hhash[1]);
					$('#'+hhash[1]).trigger("click");
//					$("html, body").animate({ scrollTop: el.offset().top }, 1000);
				}, 100
			);	
		}
	}
	
});


function addOption (oListbox, text, value, isDefaultSelected, isSelected)
{
  var oOption = document.createElement("option");
  oOption.appendChild(document.createTextNode(text));
  oOption.setAttribute("value", value);

  if (isDefaultSelected) oOption.defaultSelected = true;
  else if (isSelected) oOption.selected = true;

  oListbox.appendChild(oOption);
}

function makeRequest(tt,url,objsel) {
var http_request = false;
if (window.XMLHttpRequest) { // Mozilla, Safari, ...
http_request = new XMLHttpRequest();
if (http_request.overrideMimeType) {
http_request.overrideMimeType('application/xml');
}
} else if (window.ActiveXObject) { // IE
try {
http_request = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
http_request = new ActiveXObject("Microsoft.XMLHTTP");
} catch (e) {}
}
}
if (!http_request) {
alert('Не вышло :( Невозможно создать экземпляр класса XMLHTTP ');
return false;
}
http_request.onreadystatechange = function() { alertContents(http_request,tt,objsel); };
http_request.open('GET', url, true);
http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http_request.send(null);
}

function alertContents(http_request,tt,objsel) {
if (http_request.readyState == 4) {
if (http_request.status == 200) {
var string = http_request.responseText;
if (string!='')
{
	if (tt == 'auth')
	{
		if (string=='error')
		{
			document.getElementById('logintd').style.color = 'red';
			document.getElementById('passtd').style.color = 'red';
		}		
		else location.href='/mss0fovnwli9zqf1xpbua/index.php?page=main';
	}
	else if (tt == 'marka')
	{
		$('#model').children().remove();
		$('#model').append(string);
	}
	else if (tt == 'marka1')
	{
		$('#search-input-2').children().remove();
		$('#search-input-2').append(string);
	}
}
} else {
alert('Request status: '+http_request.status);
}
}
}