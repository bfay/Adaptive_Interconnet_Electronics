<?php

class Sdsshippinginfo_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
                'sds_shipping_info_widget', // Base ID  
                __('Oxy Shipping Info','oxy'), // Name  
                array(
                    'description' => __('This widget will show popup for shipping info.', 'oxy')
                )
        );
    }

    function form($instance) {

        $defaults = array(
            'title1' => __('Free Ground Shipping', 'oxy'),
            'subtitle1' => 'on all orders over $50',
            'image1' => get_template_directory_uri().'/image/icons_feature_box/fbs_icon_1.png',
            'content1' => '',
            'title2' => __('30-Day Money-Back', 'oxy'),
            'subtitle2' => 'Guarantee for each product',
            'image2' => get_template_directory_uri().'/image/icons_feature_box/fbs_icon_1.png',
            'content2' => '',
            'title3' => __('Free Bonus Gifts', 'oxy'),
            'subtitle3' => 'with every order',
            'image3' => get_template_directory_uri().'/image/icons_feature_box/fbs_icon_1.png',
            'content3' => '',
            'title4' => '',
            'subtitle4' => '',
            'image4' => get_template_directory_uri().'/image/icons_feature_box/fbs_icon_1.png',
            'content4' => '',
            'title5' => '',
            'subtitle5' => '',
            'image5' => get_template_directory_uri().'/image/icons_feature_box/fbs_icon_1.png',
            'content5' => '',
            
        );



        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

<script type="text/javascript"><!--
jQuery(function($){
    var file_frame;
    $(document.body).off('click', 'input.sds_widget_image');
    $(document.body).on( 'click', 'input.sds_widget_image', function( event ){
				
            //event.preventDefault();

            var field = $(this);

            // If the media frame already exists, reopen it.
            if ( file_frame ) {
                    file_frame.open();
                    return;
            }

            file_frame = wp.media({
                    title: '<?php _e( 'Choose an image', 'oxy' ); ?>',
                    button: {
                            text: '<?php _e( 'Use image', 'oxy' ); ?>',
                    },
                    multiple: false
            });

            // When an image is selected, run a callback.
            file_frame.on( 'select', function() {
                    attachment = file_frame.state().get('selection').first().toJSON();                    
                    field.val(attachment.url);
                    
            });
            
            // Finally, open the modal.
            file_frame.open();
            
            return false;  


    });
    $(document.body).on('click','.sds_clear_image',function(){
        $(this).prev().val('<?php echo get_template_directory_uri().'/image/icons_feature_box/fbs_icon_1.png'?>');
        return false;
    });
    
});
//--></script>
<style type="text/css">
    .sds_clear_image:before{
        font-family: dashicons;
    }
    textarea{
        min-height: 165px;        
    }
    
</style>
        <p>

            <label for="<?php echo $this->get_field_id('title1'); ?>">

                <strong><?php _e('Title 1', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" value="<?php echo $instance['title1']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('subtitle1'); ?>">

                <strong><?php _e('Subtitle 1', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('subtitle1'); ?>" name="<?php echo $this->get_field_name('subtitle1'); ?>" value="<?php echo $instance['subtitle1']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('image1'); ?>">

                <strong><?php _e('Image 1', 'oxy') ?>:</strong><br /><input class="widefat sds_widget_image" type="text" id="<?php echo $this->get_field_id('image1'); ?>" name="<?php echo $this->get_field_name('image1'); ?>" value="<?php echo $instance['image1']; ?>" />
                <a class="dashicons-no sds_clear_image" title="Clear image field" href="#"></a>
            </label>

        </p> 

        

        <p>

            <label for="<?php echo $this->get_field_id('content1'); ?>"><strong><?php _e('Content 1', 'oxy') ?></strong></label>

            <textarea class="widefat" id="<?php echo $this->get_field_id('content1'); ?>" name="<?php echo $this->get_field_name('content1'); ?>"><?php echo $instance['content1']; ?></textarea>

        </p>             
        <!-- end -->
        <p>

            <label for="<?php echo $this->get_field_id('title2'); ?>">

                <strong><?php _e('Title 2', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" value="<?php echo $instance['title2']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('subtitle2'); ?>">

                <strong><?php _e('Subtitle 2', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('subtitle2'); ?>" name="<?php echo $this->get_field_name('subtitle2'); ?>" value="<?php echo $instance['subtitle2']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('image2'); ?>">

                <strong><?php _e('Image 2', 'oxy') ?>:</strong><br /><input class="widefat sds_widget_image" type="text" id="<?php echo $this->get_field_id('image2'); ?>" name="<?php echo $this->get_field_name('image2'); ?>" value="<?php echo $instance['image2']; ?>" />
                <a class="dashicons-no sds_clear_image" title="Clear image field" href="#"></a>
            </label>

        </p> 

        

        <p>

            <label for="<?php echo $this->get_field_id('content2'); ?>"><strong><?php _e('Content 2', 'oxy') ?></strong></label>

            <textarea class="widefat" id="<?php echo $this->get_field_id('content2'); ?>" name="<?php echo $this->get_field_name('content2'); ?>"><?php echo $instance['content2']; ?></textarea>

        </p>             
        <!-- end -->
        <p>

            <label for="<?php echo $this->get_field_id('title3'); ?>">

                <strong><?php _e('Title 3', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" value="<?php echo $instance['title3']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('subtitle3'); ?>">

                <strong><?php _e('Subtitle 3', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('subtitle3'); ?>" name="<?php echo $this->get_field_name('subtitle3'); ?>" value="<?php echo $instance['subtitle3']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('image3'); ?>">

                <strong><?php _e('Image 3', 'oxy') ?>:</strong><br /><input class="widefat sds_widget_image" type="text" id="<?php echo $this->get_field_id('image3'); ?>" name="<?php echo $this->get_field_name('image3'); ?>" value="<?php echo $instance['image3']; ?>" />
                <a class="dashicons-no sds_clear_image" title="Clear image field" href="#"></a>
            </label>

        </p> 

        

        <p>

            <label for="<?php echo $this->get_field_id('content3'); ?>"><strong><?php _e('Content 3', 'oxy') ?></strong></label>

            <textarea class="widefat" id="<?php echo $this->get_field_id('content3'); ?>" name="<?php echo $this->get_field_name('content3'); ?>"><?php echo $instance['content3']; ?></textarea>

        </p>             
        <!-- end -->
        <p>

            <label for="<?php echo $this->get_field_id('title4'); ?>">

                <strong><?php _e('Title 4', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" value="<?php echo $instance['title4']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('subtitle4'); ?>">

                <strong><?php _e('Subtitle 4', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('subtitle4'); ?>" name="<?php echo $this->get_field_name('subtitle4'); ?>" value="<?php echo $instance['subtitle4']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('image4'); ?>">

                <strong><?php _e('Image 4', 'oxy') ?>:</strong><br /><input class="widefat sds_widget_image" type="text" id="<?php echo $this->get_field_id('image4'); ?>" name="<?php echo $this->get_field_name('image4'); ?>" value="<?php echo $instance['image4']; ?>" />
                <a class="dashicons-no sds_clear_image" title="Clear image field" href="#"></a>
            </label>

        </p> 

        

        <p>

            <label for="<?php echo $this->get_field_id('content4'); ?>"><strong><?php _e('Content 4', 'oxy') ?></strong></label>

            <textarea class="widefat" id="<?php echo $this->get_field_id('content4'); ?>" name="<?php echo $this->get_field_name('content4'); ?>"><?php echo $instance['content4']; ?></textarea>

        </p>             
        <!-- end -->
        <p>

            <label for="<?php echo $this->get_field_id('title5'); ?>">

                <strong><?php _e('Title 5', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('title5'); ?>" name="<?php echo $this->get_field_name('title5'); ?>" value="<?php echo $instance['title5']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('subtitle5'); ?>">

                <strong><?php _e('Subtitle 5', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('subtitle5'); ?>" name="<?php echo $this->get_field_name('subtitle5'); ?>" value="<?php echo $instance['subtitle5']; ?>" />

            </label>

        </p> 
        <p>

            <label for="<?php echo $this->get_field_id('image5'); ?>">

                <strong><?php _e('Image 5', 'oxy') ?>:</strong><br /><input class="widefat sds_widget_image" type="text" id="<?php echo $this->get_field_id('image5'); ?>" name="<?php echo $this->get_field_name('image5'); ?>" value="<?php echo $instance['image5']; ?>" />
                <a class="dashicons-no sds_clear_image" title="Clear image field" href="#"></a>
            </label>

        </p> 

        

        <p>

            <label for="<?php echo $this->get_field_id('content5'); ?>"><strong><?php _e('Content 5', 'oxy') ?></strong></label>

            <textarea class="widefat" id="<?php echo $this->get_field_id('content5'); ?>" name="<?php echo $this->get_field_name('content5'); ?>"><?php echo $instance['content5']; ?></textarea>

        </p>             
        <!-- end -->


        <?php
    }
    static function replace_blank_line($matches){        
        return '';        
    }

    function widget($args, $instance) {
        global $smof_data;

        extract($args);

        echo $before_widget;
        ?>
        <div class="product-right-sm-info">
        <?php
        
        for($i = 1; $i < 6; $i++){
        
            if(empty($instance['title'.$i])) continue;
            
            $rand = rand(0000,9999);
            
            ?>
            <div class="product-right-sm-info-content">
                <span class="p_icon">
                    <img src="<?php echo $instance['image'.$i]?>" alt="<?php echo $instance['title'.$i]?>">
                </span>
                <span class="p_title"><a href="#" data-reveal-id="oxyprodModal<?php echo $rand?>"><?php echo $instance['title'.$i]?></a></span>
                <span class="p_subtitle"><?php echo $instance['subtitle'.$i] ?></span>                
            </div>
            <script type="text/javascript"><!--
                jQuery(function($){
                    var html = "<div id='oxyprodModal<?php echo $rand?>' class='reveal-modal [expand, xlarge, large, medium, small]'>";
                    html += '<?php echo preg_replace_callback('/(\n|\r|\t)+/', array('Sdsshippinginfo_Widget','replace_blank_line'), $instance['content'.$i]);?>';                    
                    html += "<a class=\"close-reveal-modal\">×</a></div>";
                    
                    $('.wrapper').after(html);
                });
            //--></script>
        <?php
            
        }
        
        ?><script type="text/javascript"><!--
                jQuery(function($){
                    var n = 0;
                    
                    $('.product-right-sm-info-content').each(function(){                        
                        n++;                        
                        if(n < $('.product-right-sm-info-content').length){                            
                            var html = '';
                            var elem = $(this).next().next();
                            //var elem = $(this);
                            var id = elem.find('.p_title a').data('reveal-id');
                            var main = $(this).find('.p_title a').data('reveal-id');
                            var title = elem.find('.p_title a').text();                            
                            
                            html += '<p><a class="button" data-reveal-id="'+id+'" href="#">'+title+'</a></p>';
                            $('#'+main+' a.close-reveal-modal').before(html);
                        }                        
                    });
                });
            //--></script>
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        for($i = 1; $i < 6; $i++){
        
            $instance['title'.$i] = $new_instance['title'.$i];
            $instance['subtitle'.$i] = $new_instance['subtitle'.$i];
            $instance['image'.$i] = $new_instance['image'.$i];
            $instance['content'.$i] = $new_instance['content'.$i];            
        
        }


        return $instance;
    }

}
function reg_sds_shipping_info_widget(){
    
    return register_widget( "Sdsshippinginfo_Widget" );
}

add_action('widgets_init', 'reg_sds_shipping_info_widget');


