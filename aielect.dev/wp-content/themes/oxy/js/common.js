
// Languages and Currency Dropdown
jQuery(document).foundation();


jQuery( function($) {
  $('.dropdown_l').hover(function() {
    $(this).find('.options_l').stop(true, true).slideDown('fast');
  },function() {
    $(this).find('.options_l').stop(true, true).slideUp('fast');
  });
  });
jQuery(function($) {

    $('body').on('DOMNodeInserted', '.blockUI.blockOverlay', function(e) {
        var h = $(window).height();                
        $(this).css({height:h+'px',zIndex:9999999,display:'block',position:'fixed'});
    });
}); 

jQuery(document).ready(function($) {
    var loop = 3;
    var modals = ['oxyModal1','oxyModal2','oxyModal3','oxyModal4'];
    for(var m in modals){
        m = parseInt(m);
        var cem = $('#'+modals[m]);
        if(!cem.length) continue;
        
        if(m < loop){                       
            for(var n = m + 1; n <= loop; n++){                
                if($('#'+modals[n]).length){
                    var title = '';
                    $('#footer_p .p_content').each(function(){
                        var elemid = $(this).find('.p_title a').data('reveal-id');
                        if(modals[n] == elemid){
                            return title = $(this).find('.p_title a').html();
                        }
                    });
                    if(title != ''){
                        cem.find('a.close-reveal-modal').before('<p></p><p><a class="button" data-reveal-id="'+modals[n]+'" href="#">'+title+'</a></p>');                        
                    }
                    break;
                }
            }
        }
            
        
    }
    
    $("#buttonForModal").click(function() {
        $("#myModal").reveal();
    });
}); 
jQuery(function($){
    var jckVleft= function(){
        var mwd = $('ul.products li:first-child .image').width();
        var qvw = $('ul.products li:first-child .image .jckqvBtn').outerWidth();
        var lf = (mwd/2) - (qvw/2);
        $('ul.products li .image .jckqvBtn').css('left',lf+'px');        
    };
    
    $(window).on('load resize',function(){
        jckVleft();
    });
    
});
// Increment/Decrement a Quantity
jQuery(function($){
        $(".tiptip").tipTip();
        $('.i-d-quantity').incrementBox({minVal:1,maxVal:999999});     
        function postitionMegaMenu(){
            $('#menu ul > li > a + div, #menu > ul > li > a + ul.sub-menu ').each(function(index, element) {
                    // IE6 & IE7 Fixes
                    if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 6)) {
                            var category = $(element).find('a');
                            var columns = $(element).find('ul').length;

                            $(element).css('width', (columns * 143) + 'px');
                            $(element).find('ul').css('float', 'left');
                    }		

                    var menu = $('#menu').offset();
                    var dropdown = $(this).parent().offset();

                    var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());

                    if (i > 0) {                    
                        $(this).css('margin-left', '-' + (i + 5) + 'px');                       
                    }
                    else{
                        $(this).css('margin-left', '0px');                    
                    }
            });
	}
        
        postitionMegaMenu();
        
        $(window).resize(function(){            
            postitionMegaMenu();
        });
        
    });
(function($){

        $.fn.extend({
            incrementBox: function(options) {

                var defaults = {
                    minVal:null,
                    maxVal:null,
                    incButton:'.inc',
                    decButton:'.dec'
                }

                var getNumVal = function($element){//get numeric value of an object
                                  var value = Number($element.val());
                                  return isNaN(value) ? 0 : value;
                                }
                var correctValue = function(min, max, value){
                  var checkMin = min!=null && !isNaN(0+min);
                  var checkMax = max!=null && !isNaN(0+max);
                  if(value>max && checkMax){
                    return max;
                  }
                  if(value<min && checkMin){
                    return min;
                  }
                  return value;
                }

                var options =  $.extend(defaults, options);

                return this.each(function() {
                    var o = options;
                    var $obj = $(this);
                      $(o.incButton).click(function(){                       
                        $obj.val( correctValue(o.minVal, o.maxVal, (getNumVal($obj) + 1)) );
                      });
                      $(o.decButton).click(function(){                               
                        $obj.val( correctValue(o.minVal, o.maxVal, (getNumVal($obj) - 1)) );
                      });
                      $obj.blur(function(){
                        $obj.val( correctValue(o.minVal, o.maxVal, getNumVal($obj)) );
                      });                   
                });
            }
        });

    })(jQuery);
	


jQuery(document).ready(function($){
        var removeNft = function(){
            if($("#notification") !== undefined)
                $("#notification").remove();
        };
    
        $('#notification img.close').live('click',function(){
            removeNft();      
        });
        
        oxy_yith_ajax_wish_list = function(obj,ajaxurl,opts){
            $.ajax({
                type:"POST",
                url:ajaxurl,
                data:"product_id="+opts.add_to_wishlist+"&"+jQuery.param(opts),
                success : function(resp){
                    var response = resp.split('##');
                    $('body .wrapper div#notification').remove();
                    var ntop = $('#wpadminbar') !== undefined ? $('#wpadminbar').height() : 10;
                    if(response[0] == 'true'){                        
                        if(OXY_ADD_TO_WISHLIST_SUCCESS_TEXT !== undefined)
                        $('<div id="notification" class="row"><div class="success">'+OXY_ADD_TO_WISHLIST_SUCCESS_TEXT+'<img class="close" alt="" src="'+IMAGEURL+'/close.png"></div></div>').prependTo('body .wrapper');
                        $('body .wrapper div#notification').css('top',ntop+'px');
                        $('body .wrapper div#notification > div').fadeIn('show');
                        $('html,body').animate({scrollTop:0},300);
                    }                    
                    else if(response[0] == 'exists'){
                        if(OXY_ADD_TO_WISHLIST_EXISTS_TEXT !== undefined)
                        $('<div id="notification" class="row"><div class="success">'+OXY_ADD_TO_WISHLIST_EXISTS_TEXT+'<img class="close" alt="" src="'+IMAGEURL+'/close.png"></div></div>').prependTo('body .wrapper');
                        $('body .wrapper div#notification').css('top',ntop+'px');
                        $('body .wrapper div#notification > div').fadeIn('show');
                        $('html,body').animate({scrollTop:0},300);
                        
                    }
                    setTimeout(function(){
                        removeNft();                        
                    },10000);
                    
                }
            });
        };
        
        $(document).off("click",".add_to_wishlist");
        $(document).on("click",".add_to_wishlist",function(){
            var b = yith_wcwl_plugin_ajax_web_url;
            var opts={add_to_wishlist:$(this).data("product-id"),product_type:$(this).data("product-type"),action:"add_to_wishlist"};
            oxy_yith_ajax_wish_list($(this),b,opts);            
            return false;
        });
        
        $(document).off( 'click', '.product a.compare');
        $(document).on( 'click', 'a.compare', function(e){
            e.preventDefault();

            var button = $(this),
                data = {
                    _yitnonce_ajax: yith_woocompare.nonceadd,
                    action: yith_woocompare.actionadd,
                    id: button.data('product_id'),
                    context: 'frontend'
                },
                widget_list = $('.yith-woocompare-widget ul.products-list');

            // add ajax loader
            button.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
            widget_list.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});

            $.ajax({
                type: 'post',
                url: yith_woocompare.ajaxurl,
                data: data,
                dataType: 'json',
                success: function(response){
                    //button.unblock().addClass('added').text( yith_woocompare.added_label );
                    button.unblock().html('<i class="fa fa-tasks"></i>');
                    // add the product in the widget
                    widget_list.unblock().html( response.widget_table );

                    if (yith_woocompare.auto_open == 'yes') $('body').trigger( 'yith_woocompare_open_popup', { response: response.table_url, button: button } );
                }
            });
        });
        
    });
    jQuery(function($){
        
        if(OXY_PRODUCT_PAGE){
            
            $('.product-buy .yith-wcwl-add-to-wishlist').addClass('prod-wishlist');            
            
        }
    });
    
    jQuery(function($) {
            "use strict";
            $("ul.product-categories li").each(function() {

                if ($(this).children('ul.children').length > 0) {

                    $(this).addClass('parent-cat');

                    $(this).prepend('<span class="expand plus"></span>');

                    $('ul.children li').removeClass('parent-cat');

                }

            });
            $(document).on('click','ul.product-categories li.parent-cat .expand',function(e) {

                e.preventDefault();
                
                if($(this).hasClass('plus')){
                    $(this).removeClass('plus').addClass('minus');
                    $(this).parent().children('ul.children').slideDown(250);
                }else{
                    $(this).removeClass('minus').addClass('plus');
                    $(this).parent().children('ul.children').slideUp(250);                    
                }

            });

            $('.btn-navbar').toggle(function() {

                $(this).next('.nav-collapse').slideDown(200);

            }, function() {

                $(this).next('.nav-collapse').slideUp(200);

            })

            $(".navbar .nav > li").each(function() {

                if ($(this).find('ul').length > 0) {

                    $(this).prepend('<span class="expand">+</span>');

                }

            });



            $(".navbar .nav > li > span.expand").on('click', function() {

                var elem = $(this).parent().find('ul');

                if (elem.length > 0 && elem.css('display') == 'none') {

                    elem.slideDown(200);

                    $(this).html('-');

                }
                else if (elem.length > 0 && elem.css('display') == 'block') {
                    elem.slideUp(200);
                    $(this).html('+');
                }
            });
            
            $('.mobile-nav .nav li').each(function(){
                if($(this).children('ul.sub-menu').length>0 || $(this).children('.brands-wall').length>0){
                   $(this).children('a').append('<span class="menu-expander dashicons-arrow-down-alt2"><span>'); 
                }
                else if($(this).find('.large-10 .five-nb').length>0){                   
                   $(this).find('.large-10 .five-nb > span > a').append('<span class="menu-expander dashicons-arrow-down-alt2"><span>');
                }
                
            });

            $('.mobile-nav .nav').css({height:'0px',visibility:'hidden'});

            $('a.mobile_menu_trigger').on('click',function(){
                
                var elem = $(this).next('.mobile-nav').children('ul.nav');
                if(elem.css('visibility') === 'hidden')
                    elem.css({visibility:'visible',height:'auto'});
                else
                    elem.css({height:'0px',visibility:'hidden'});
                
                return false;        
            }
        );


            $(document).on('click','.menu-expander',function(){                
                if($(this).hasClass('dashicons-arrow-down-alt2')){                    
                    $(this).removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
                    $(this).parent().next('ul.sub-menu').css({visibility:'visible',opacity:'1'}).slideDown(200);

                    $(this).parents('.five-nb').children('ul').css({visibility:'visible',opacity:'1'}).slideDown(200);
                    $(this).parent().next('.brands-wall').css({visibility:'visible',opacity:'1'}).slideDown(200);                
                }else{
                    $(this).removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');;
                    $(this).parent().next('ul.sub-menu').slideUp(200);

                    $(this).parents('.five-nb').children('ul').slideUp(200);
                    $(this).parent().next('.brands-wall').slideUp(200);
                }
                return false;        
            });
            
        });