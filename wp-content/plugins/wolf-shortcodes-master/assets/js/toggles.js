jQuery(function($){

	
	$('.wolf-toggle-title').click(function(e){
		e.preventDefault();
		var container = $(this).parent(),
			toggle = $(this).next('.wolf-toggle-content'),
			sign = $(this).find('.wolf-toggle-sign');
		if( !container.hasClass('open') ){
			container.addClass('open');
			toggle.slideDown('fast');
			sign.removeClass('plus');
			sign.addClass('minus');
		}else{
			container.removeClass('open');
			toggle.slideUp('fast');
			sign.removeClass('minus');
			sign.addClass('plus');
		}
		
	});
});

jQuery(window).load(function(){

	var $ = jQuery;

	$('.wolf-toggle').each(function(){
		var toggle = $(this).find('.wolf-toggle-content'),
			sign = $(this).find('.wolf-toggle-sign');
		if( $(this).hasClass('open') ){
			toggle.show();
			sign.removeClass('plus');
			sign.addClass('minus');
		}
	});

});