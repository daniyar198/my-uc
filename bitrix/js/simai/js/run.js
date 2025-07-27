$('document').ready(function(){
	if ($('.color-picker')[0]) {
		$('.color-picker').each(function(){
			var colorOutput = $(this).closest('.cp-container').find('.cp-value');
			$(this).farbtastic(colorOutput);
		});
	}
})