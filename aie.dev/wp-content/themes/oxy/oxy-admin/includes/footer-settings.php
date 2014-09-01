<div id="tab-footer">
    <div id="footer_settings_tabs" class="vtabs">
        <a href="#tab-footer-feature-box">Feature Block</a>        
        <a href="#tab-footer-powered">Powered by</a>                                                                    
        <a href="#tab-footer-payment-images">Payment Images</a>           
        <a href="#tab-footer-custom-block">Bottom Custom Block</a>                                                   
    </div>
    <div id="of_container">
        <div class="of-save-popup" id="of-popup-save">
            <div class="of-save-save">Options Updated</div>
	</div>
        <form enctype="multipart/form-data" action="#" method="post" id="of_form">
            
            <input type="hidden" name="tab_page" id="tab_page" value="oxy_footer_settings" />
            <input type="hidden" name="security" id="security" value="<?php echo wp_create_nonce('of_ajax_nonce')?>" />
            <div id="tab-footer-feature-box" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_footer_options_setting_fields('feature-box')?>
                </div>
            </div>            
            <div id="tab-footer-powered" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_footer_options_setting_fields('powered')?>
                </div>
            </div>
            <div id="tab-footer-payment-images" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_footer_options_setting_fields('payment-images')?>
                </div>
            </div>
            <div id="tab-footer-custom-block" class="vtabs-content content">
                <div class="htabs_group">
                <?php echo get_footer_options_setting_fields('custom-block')?>
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