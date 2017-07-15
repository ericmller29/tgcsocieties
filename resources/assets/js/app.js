require('./bootstrap');

$(function(){
	if($('.message').length){
		setTimeout(() => {
			$('.message').fadeOut('fast', () => {
				$('.message').remove();
			});
		}, 3000);
	}
});
