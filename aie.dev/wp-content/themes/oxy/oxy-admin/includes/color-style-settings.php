<div id="tab-colors-styles" style="display: block;">
      
    <div class="vtabs" id="colors_styles_settings_tabs">
        <a href="#tab-colors-styles-general" class="selected">General</a>        
        <a href="#tab-colors-styles-buttons">Buttons</a> 
        <a href="#tab-colors-styles-top-area-header">Header</a>
        <a href="#tab-colors-styles-top-area-main-menu">Main Menu</a>
        <a href="#tab-colors-styles-midsection">Midsection</a>
        <a href="#tab-colors-styles-footer">Footer</a>    
        <a href="#tab-colors-styles-colorie">Import / Export</a>    
    </div>     
    <div id="of_container">
        <div class="of-save-popup" id="of-popup-save">
            <div class="of-save-save">Options Updated</div>
	</div>
        <form enctype="multipart/form-data" action="#" method="post" id="of_form">
            <input type="hidden" name="tab_page" id="tab_page" value="oxy_color_style_settings" />
            <input type="hidden" name="security" id="security" value="<?php echo wp_create_nonce('of_ajax_nonce')?>" />
            <div id="tab-colors-styles-general" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_styles_options_setting_fields('general')?>
                </div>
            </div>            
            <div id="tab-colors-styles-buttons" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_styles_options_setting_fields('buttons')?>
                </div>
            </div>
            <div id="tab-colors-styles-top-area-header" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_styles_options_setting_fields('top-area-header')?>
                </div>
            </div>
            <div id="tab-colors-styles-top-area-main-menu" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_styles_options_setting_fields('top-area-main-menu')?>
                </div>
            </div>
            <div id="tab-colors-styles-midsection" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_styles_options_setting_fields('midsection')?>
                </div>
            </div>
            <div id="tab-colors-styles-footer" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_styles_options_setting_fields('footer')?>
                </div>
            </div>
            <div id="tab-colors-styles-colorie" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_styles_options_setting_fields('colorie')?>
                </div>
            </div>
            
            <div class="save_bar"> 
                <img alt="Working..." class="ajax-loading-img ajax-loading-img-bottom" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" style="display: none;">
                <button class="button-primary" type="button" id="of_save">Save All Changes</button>			
                <button class="button submit-button reset-button" type="button" id="of_reset">Options Reset</button>
                <img alt="Working..." class="ajax-reset-loading-img ajax-loading-img-bottom" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" style="display:none">
            </div>
            
        </form>
    </div>
    
</div>