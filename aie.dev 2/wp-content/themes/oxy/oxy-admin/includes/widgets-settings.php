<h3>Widgets</h3>

<div id="tab-widgets" style="display: block">
    <div id="widgets_settings_tabs" class="vtabs">
        <a href="#tab-widgets-facebook">Facebook Box</a>
        <a href="#tab-widgets-twitter">Twitter Box</a>
        <a href="#tab-widgets-video-box">Video Box</a>          
        <a href="#tab-widgets-custom-box">Custom Box</a>                                         
    </div>
    <div id="of_container">
        <div class="of-save-popup" id="of-popup-save">
            <div class="of-save-save">Options Updated</div>
	</div>
        <form enctype="multipart/form-data" action="#" method="post" id="of_form">            
            <input type="hidden" name="tab_page" id="tab_page" value="oxy_widgets_settings" />
            <input type="hidden" name="security" id="security" value="<?php echo wp_create_nonce('of_ajax_nonce')?>" />
            <div id="tab-widgets-facebook" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_widgets_options_setting_fields('facebook')?>
                </div>
            </div>
            <div id="tab-widgets-twitter" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_widgets_options_setting_fields('twitter')?>
                </div>
            </div>
            <div id="tab-widgets-video-box" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_widgets_options_setting_fields('video-box')?>
                </div>
            </div>
            <div id="tab-widgets-custom-box" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_widgets_options_setting_fields('custom-box')?>
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