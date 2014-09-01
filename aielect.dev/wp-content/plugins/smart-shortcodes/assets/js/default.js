/**
 *	@package Default.js
 *	@desc shortcodes jquery lib
 *	Developed by Smart Data soft team
 *
 */
 
(function($){
	
	$.fn.smart_js = function(opts){
		
		var options = $.extend({
			
			accordionElem : $('.accordion'),
			
			tabsElem : $('.smart_tabs'),
			
			toggleElem : $('.toggle-box h2.trigger'),
			
		}, opts );
		
                
		options.accordionElem.accordion({collapsible:true,active:false,heightStyle:"content"});
		
		options.tabsElem.tabs();
		
		options.toggleElem.on('click',function(){			
                    var h2 = $(this);
                    if(!h2.hasClass('active')){
                        h2.addClass('active');
                        h2.next('.toggle_container').slideDown(300);
                    }else{
                        h2.removeClass('active');			
                        h2.next('.toggle_container').slideUp(300);
                    }			
		});
		
		
	};
	
	
}(jQuery));
 

jQuery.fn.smart_js();