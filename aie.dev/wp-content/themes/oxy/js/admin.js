(function($) {
	"use strict";
	
	$(function() {
	 
		
		// Add the proper enctype to the form so the MP3 files can be uploaded
		$('.product_layout').click(function(event){
		event.preventDefault();
		var layout_id = $(this).data('value');
		 
		 $("#product_layout_value").val(layout_id);
		
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
		
		});
		
	});
	
}(jQuery));