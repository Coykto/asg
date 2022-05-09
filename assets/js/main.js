jQuery(document).ready(function ($) {
  $('.number input').on('input change paste', function () {
    $(this).val(this.value.replace(/[^0-9\-]/, '')); // запрещаем ввод любых символов, кроме цифр и знака минуса
  });
  $('.number .number_controls > div').on('click', function () {
    var input = $(this).closest('.number').find('input'); // инпут

    var value = parseInt(input.val()) || 0; // получаем value инпута или 0

    if ($(this).hasClass('nc-minus')) {
      if (value > 0) {
        value = value - 1; // вычитаем из value 1
      }
    }

    if ($(this).hasClass('nc-plus')) {
      value = value + 1; // прибавляем к value 1
    }

    input.val(value).change(); // выводим полученное value в инпут; триггер .change() - на случай, если на изменение этого инпута у вас уже объявлен еще какой-то обработчик
  });
  $('.filter-btn').on('click', function () {
    $(this).toggleClass('is-active');
  });
  // $('.menu-drop-list').mouseenter(function () {
  // 	$('.menu-drop-list > li:first-child > a').removeClass('uk-open');
  // 	$('.menu-drop-list > li:first-child > .uk-drop').removeClass('uk-open');
  // });

//  $('.menu-drop-list').mouseleave(function () {
//    $('.menu-drop-list > li:first-child > a').addClass('uk-open');
//    $('.menu-drop-list > li:first-child > .uk-drop').addClass('uk-open');
//  });
  

  $('.menu-drop-list').mouseleave(function () {
    $('.menu-drop-list > .last-active > a').addClass('uk-open');
    $('.menu-drop-list > .last-active > .uk-drop').addClass('uk-open');
  });  

  $('.menu-drop-list > li > a').mouseenter(function () {
	$(this).parent().parent().find('li').removeClass('last-active');
	$(this).parent().parent().find('li > a').removeClass('uk-open');
	$(this).parent().parent().find('li > .uk-drop').removeClass('uk-open');
  	$(this).parent().addClass('last-active');
  });  
  
  $('.service_img').hover(function () {
	var img = $(this).attr('data-img');
	if (img!='') $(this).parent().parent().parent().prev().find('.services-item-img img').attr('src',img);
  });

	$('.callback').click(function(){
		$('.callback-name').html($(this).html());
	});
	
	$('#callback-form').submit(function(){
		var idata = {};
		idata['phone'] = $('#callback-form input[name="phone"]').val();
		idata['name'] = $('#callback-form input[name="name"]').val();
		idata['email'] = $('#callback-form input[name="email"]').val();
			$.ajax({
				type: "POST",
				url: "/callback.php",
				data: idata,
				success: function(data){
					if (data == 'ok') 
					{
						$('#callback-form')[0].reset();
						$('#callback-form input[name="phone"]').removeClass('border_red');
						UIkit.modal('#callback-ok').show();
					}
					else
					{
						$('#callback-form input[name="phone"]').addClass('border_red');
					}
				}
			});
	});

});