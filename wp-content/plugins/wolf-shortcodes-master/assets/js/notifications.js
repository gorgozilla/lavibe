jQuery(function($){
	$('.wolf-notif .wolf-notif-close').click(function() {
		$(this).parent().parent().slideUp();
		return false;
	});
});