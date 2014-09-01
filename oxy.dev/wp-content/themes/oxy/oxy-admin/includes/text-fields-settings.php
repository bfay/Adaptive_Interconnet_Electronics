<div id="tab-widgets" style="display: block">
    <div id="widgets_settings_tabs" class="vtabs">
        <a href="#tab-widget-custom-box">General</a>
                                               
    </div>
    <div id="of_container">
        <div class="of-save-popup" id="of-popup-save">
            <div class="of-save-save">Options Updated</div>
	</div>
        <form enctype="multipart/form-data" action="#" method="post" id="of_form_theme_texts">            
            <input type="hidden" name="tab_page" id="tab_page" value="oxy_text_fields_settings" />
            <input type="hidden" name="security" id="security" value="<?php echo wp_create_nonce('of_ajax_nonce')?>" />
            <div id="tab-widget-custom-box" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_texts_options_setting_fields('widget-custom-box')?>
                </div>
            </div>
            
            <div class="save_bar"> 
                <img alt="Working..." class="ajax-loading-img ajax-loading-img-bottom" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" style="display: none;">
                <button class="button-primary" type="submit">Save All Changes</button>			
                <button class="button submit-button reset-button" type="button" id="of_reset">Options Reset</button>
                <img alt="Working..." class="ajax-reset-loading-img ajax-loading-img-bottom" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" style="display:none">
            </div>
        </form>
    </div>
    
</div> 