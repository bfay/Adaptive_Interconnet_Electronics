<?php
global $shortname;
?>
<div id="tab-store-features">   

    <div id="store_features_tabs" class="vtabs">
        <a href="#tab-store-features-layout">Layout</a>        
        <a href="#tab-store-features-header">Header</a>
        <a href="#tab-store-features-main-menu">Main Menu</a>
<!--        <a href="#tab-store-features-homepage">Home Page</a>-->
        <!--<a href="#tab-store-features-innerpage">Inner Page</a>-->
        <a href="#tab-store-features-category">Category Page</a> 
        <a href="#tab-store-features-product">Product Page</a>
        <a href="#tab-store-features-blog">Blog Page</a>
        <a href="#tab-store-features-contact">Contact Page</a>  
         
        <a href="#tab-store-features-others">Others</a>                                         
    </div> 
    <div id="of_container">
        <div class="of-save-popup" id="of-popup-save">
		<div class="of-save-save">Options Updated</div>
	</div>
  <form enctype="multipart/form-data" action="#" method="post" id="of_form">
      <input type="hidden" name="tab_page" id="tab_page" value="oxy_general_settings" />
      <input type="hidden" name="security" id="security" value="<?php echo wp_create_nonce('of_ajax_nonce')?>" />
      
      
        <div id="tab-store-features-layout" class="vtabs-content content">  
            <div class="htabs_group">
            <?php           
            //$general_options = generate_fields($gn_sett_of_options) ;         
            echo get_general_options_setting_fields('layout') ;            
            ?>
            </div>
        </div>
        
        <div id="tab-store-features-header" class="vtabs-content content">
            <div class="htabs_group">
            <?php echo get_general_options_setting_fields('header')?>
            </div>
        </div>
        <div id="tab-store-features-main-menu" class="vtabs-content content">
            <div class="htabs_group">
            <?php echo get_general_options_setting_fields('main-menu')?>
            </div>
        </div>
        <div id="tab-store-features-homepage" class="vtabs-content content">
            <div class="htabs_group">
            <?php //echo get_general_options_setting_fields('homepage')?>
            </div>
        </div>

        <div id="tab-store-features-category" class="vtabs-content content">
            <div class="htabs_group">
            <?php echo get_general_options_setting_fields('category')?>
            </div>
        </div>
        <div id="tab-store-features-blog" class="vtabs-content content">
            <div class="htabs_group">
            <?php echo get_general_options_setting_fields('blog')?>
            </div>
        </div>
        <div id="tab-store-features-product" class="vtabs-content content">
            <div class="htabs_group">
            <?php echo get_general_options_setting_fields('product')?>
            </div>
        </div>
        <div id="tab-store-features-contact" class="vtabs-content content">
            <div class="htabs_group">
            <?php echo get_general_options_setting_fields('contact')?>
            </div>
        </div>        
        <div id="tab-store-features-others" class="vtabs-content content">
            <div class="htabs_group">
            <?php echo get_general_options_setting_fields('others')?>
            </div>
        </div>
 
        <div class="save_bar"> 

            <img alt="Working..." class="ajax-loading-img ajax-loading-img-bottom" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" style="display: none;">
            <button class="button-primary" type="button" id="of_save">Save All Changes</button>			
            <button class="button submit-button reset-button" type="button" id="of_reset">Options Reset</button>
            <img alt="Working..." class="ajax-reset-loading-img ajax-loading-img-bottom" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" style="display:none">

         </div>
        </form>
        </div><!-- #of_container-->
    </div>                       

<script type="text/javascript">
    jQuery(function($){
//      $('.delete_megamenu').live('click',function(){
//          var p = $(this).parents('li');
//          p.remove();
//          return false;
//      });
        
           var unbindmegasort = function(){                
                $('#oxy_mega_menu').unbind('sortable');           
           };
      
      $(".mega_menu_add_button").live('click', function(){	
                
                unbindmegasort();
                
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
	
		var maxNum = slidesContainer.find('li').length;
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
                
                
		var newSlide = '<li class="temphide">'
                        +'<div class="slide_header">'
                        +'<strong>Item ' + newNum + '</strong>'
                        +'<input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '">'
                        +'<a class="slide_edit_button" href="#">Edit</a></div>'
                        +'<div class="slide_body" style="display: none; ">'
                        +'<label>Menu Item</label>'
                        +'<div class="select_wrapper"><select class="slide select of-input" name="' + sliderId + '[' + newNum + '][menu_id]" id="' + sliderId + '_' + newNum + '_slide_menu_id">'
                        +'<?php echo Options_Machine::primary_menu_items_option('')?>'
                        +'</select></div>'
                        +'<label>Base Category</label><div class="slide select_wrapper"><select class="select of-input" name="' + sliderId + '[' + newNum + '][category_id]" id="' + sliderId + '_' + newNum + '_slide_category_id">'                        
                        +'<?php echo Options_Machine::product_cat_items_option('')?>'
                        +'</select></div>'
                        +'<label>Display Style</label><div class="slide select_wrapper"><select class="select of-input" name="' + sliderId + '[' + newNum + '][display_style]" id="' + sliderId + '_' + newNum + '_slide_display_style">'                        
                        +'<option value="1">Horizontal</option>'
                        +'<option value="2">Vertical</option>'
                        +'</select></div>'
                        +'<label>Show Icon(Horizontal only)</label><div class="slide select_wrapper"><select class="select of-input" name="' + sliderId + '[' + newNum + '][show_icon]" id="' + sliderId + '_' + newNum + '_slide_show_icon">'                        
                        +'<option value="1">No</option>'
                        +'<option value="2">Yes</option>'
                        +'</select></div>'
                        +'<label>Order By</label><div class="slide select_wrapper"><select class="select of-input" name="' + sliderId + '[' + newNum + '][orderby]" id="' + sliderId + '_' + newNum + '_slide_orderby">'                        
                        +'<option value="name">name</option>'
                        +'<option value="id">id</option>'
                        +'<option value="count">count</option>'
                        +'<option value="slug">slug</option>'
                        +'</select></div>'
                        +'<label>Order</label><div class="slide select_wrapper"><select class="select of-input" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_' + newNum + '_slide_order">'                        
                        +'<option value="ASC">ASC</option>'
                        +'<option value="DESC">DESC</option>'                        
                        +'</select></div>'
                        +'<label>Child Category Limit(Horizontal only)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][limit]" id="' + sliderId + '_' + newNum + '_slide_limit" value="">'
                        +'<label>Top Content</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][menu_top]" id="' + sliderId + '_' + newNum + '_slide_menu_top" cols="8" rows="8"></textarea>'
                        //+'<label>Right Content</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][menu_right]" id="' + sliderId + '_' + newNum + '_slide_menu_right" cols="8" rows="8"></textarea>'
                        +'<label>Bottom Content</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][menu_bottom]" id="' + sliderId + '_' + newNum + '_slide_menu_bottom" cols="8" rows="8"></textarea>'
                        +'<a class="slide_delete_button" href="#">Delete</a><div class="clear"></div>'
                        +'</div></li>';
		
		slidesContainer.append(newSlide);
                //styleSelect.init();
                slidesContainer.find('li:last-child .select_wrapper').each(function(){
                    $(this).prepend('<span>'+$(this).find('.select option:selected').text()+'</span>');
                });
                
		var nSlide = slidesContainer.find('.temphide');
		nSlide.fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});
				
		//optionsframework_file_bindings(); // re-initialise upload image..
		
		return false; //prevent jumps, as always..
	});	  
        
    });
</script>




