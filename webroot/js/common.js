;(function($, window, undefined) {

	$.fn.getVideo = function(url){
		$.ajax({
			type : "POST",
			url : url,
			dataType : "html",
			success : function(data) {
				//cargamos el nuevo contenido
				$('#videoContainer').empty();
				$('#videoContainer').append(data);
			}
		});

	}

})(jQuery, window)

$(function() {
	$('#artText').children().eq(0).addClass('CapitalLetter');
});