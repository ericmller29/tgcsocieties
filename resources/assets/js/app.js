require('./bootstrap');

$(function(){
	if($('.message').length && !$('.message').hasClass('error')){
		setTimeout(() => {
			$('.message').fadeOut('fast', () => {
				$('.message').remove();
			});
		}, 3000);
	}

	if($('[data-scrollto]').length){
		var trId = $('.message').data('scrollto'),
			scrollTo = $('#' + trId).offset().top;

		$('html, body').animate({
			scrollTop: scrollTo
		}, 500, function(){
			$('#' + trId).addClass('found');

			setTimeout(() => {
				$('#' + trId).removeClass('found');
			}, 2000);
		});
	}
});
