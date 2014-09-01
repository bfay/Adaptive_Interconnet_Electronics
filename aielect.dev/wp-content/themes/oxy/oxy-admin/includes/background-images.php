<div id="tab-background-images">      
    <div id="background_images_settings_tabs" class="vtabs">
        <a href="#tab-background-images-body">Body</a>
        <a href="#tab-background-images-main-column">Main Column</a>  
        <a href="#tab-background-images-top-area">Header</a>             
        <a href="#tab-background-images-main-menu">Main Menu</a>
        <a href="#tab-background-images-footer">Footer</a>                                   
    </div>
    <div id="of_container">
        <div class="of-save-popup" id="of-popup-save">
            <div class="of-save-save">Options Updated</div>
	</div>
        <form enctype="multipart/form-data" action="#" method="post" id="of_form">
            <input type="hidden" name="tab_page" id="tab_page" value="oxy_background_images" />
            <input type="hidden" name="security" id="security" value="<?php echo wp_create_nonce('of_ajax_nonce')?>" />
            <div id="tab-background-images-body" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_bg_options_setting_fields('body')?>
                </div>
            </div>
            <div id="tab-background-images-main-column" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_bg_options_setting_fields('main-column')?>
                </div>
            </div>
            <div id="tab-background-images-top-area" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_bg_options_setting_fields('top-area')?>
                </div>
            </div>
            <div id="tab-background-images-main-menu" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_bg_options_setting_fields('main-menu')?>
                </div>
            </div>
            <div id="tab-background-images-footer" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_bg_options_setting_fields('footer')?>
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

