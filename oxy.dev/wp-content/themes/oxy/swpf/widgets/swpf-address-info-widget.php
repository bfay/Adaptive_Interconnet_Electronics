<?php

class sds_widget_address_info extends WP_Widget {

    public function __construct() {

        parent::__construct(
                'sds_widget_address_info', // Base ID  
                __('Oxy Address Info','oxy'), // Name  
                array(
            'description' => __('This widget will show Address.', 'oxy')
                )
        );
    }

    function form($instance) {

        $defaults = array(
            'title' => __('Contact Us', 'oxy'),
            'mobile_phone' => 'Call us FREE!',
            'mobile_phone2' => '0123 123 1234',
            'land_phone' => '0123 123 1234',
            'land_phone2' => '0123 123 1234',
            'fax1'=>'',
            'fax2'=>'',
            'email' => 'info@321cart.com',
            'email2' => 'office@321cart.com',
            'skype' => "",
            'skype2' => "",
            'address' => '135 South Park Avenue',
            'address2' => 'Los Angeles, CA 90024. USA ',
            'hours' => 'From Monday to Friday <br />9:00 a.m. to 5:00 p.m.'
        );



        $instance = wp_parse_args((array) $instance, $defaults);
        ?>



        <p>

            <label for="<?php echo $this->get_field_id('title'); ?>">

                <strong><?php _e('Title', 'oxy') ?>:</strong><br /><input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />

            </label>

        </p> 

        <p>

            <label for="<?php echo $this->get_field_id('mobile_phone'); ?>"><?php _e('Mobile Phone', 'oxy') ?></label>

            <input type="text"  class="widefat" id="<?php echo $this->get_field_id('mobile_phone'); ?>" name="<?php echo $this->get_field_name('mobile_phone'); ?>" value="<?php echo $instance['mobile_phone']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('mobile_phone2'); ?>" name="<?php echo $this->get_field_name('mobile_phone2'); ?>" value="<?php echo $instance['mobile_phone2']; ?>" />

        </p> 

        <p>

            <label for="<?php echo $this->get_field_id('land_phone'); ?>"><?php _e('Land Phone', 'oxy') ?></label>

            <input type="text"  class="widefat" id="<?php echo $this->get_field_id('land_phone'); ?>" name="<?php echo $this->get_field_name('land_phone'); ?>" value="<?php echo $instance['land_phone']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('land_phone2'); ?>" name="<?php echo $this->get_field_name('land_phone2'); ?>" value="<?php echo $instance['land_phone2']; ?>" />

        </p>
        
        <p>

            <label for="<?php echo $this->get_field_id('fax1'); ?>"><?php _e('Fax', 'oxy') ?></label>

            <input type="text"  class="widefat" id="<?php echo $this->get_field_id('fax1'); ?>" name="<?php echo $this->get_field_name('fax1'); ?>" value="<?php echo $instance['fax1']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('fax2'); ?>" name="<?php echo $this->get_field_name('fax2'); ?>" value="<?php echo $instance['fax2']; ?>" />

        </p>

        <p>

            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email', 'oxy') ?></label>

            <input type="text"  class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('email2'); ?>" name="<?php echo $this->get_field_name('email2'); ?>" value="<?php echo $instance['email2']; ?>" />

        </p>

        <p>

            <label for="<?php echo $this->get_field_id('skype'); ?>"><?php _e('Skype', 'oxy') ?></label>

            <input type="text"  class="widefat" id="<?php echo $this->get_field_id('skype'); ?>" name="<?php echo $this->get_field_name('skype'); ?>" value="<?php echo $instance['skype']; ?>" /><input type="text"  class="widefat" id="<?php echo $this->get_field_id('skype2'); ?>" name="<?php echo $this->get_field_name('skype2'); ?>" value="<?php echo $instance['skype2']; ?>" />

        </p>   

        <p>

            <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address', 'oxy') ?></label>

            <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $instance['address']; ?></textarea><textarea class="widefat" id="<?php echo $this->get_field_id('address2'); ?>" name="<?php echo $this->get_field_name('address2'); ?>"><?php echo $instance['address2']; ?></textarea>

                        </p> 

        		<p>

                            <label for="<?php echo $this->get_field_id('hours'); ?>"><?php _e('Hours', 'oxy') ?></label>

                            <textarea class="widefat" id="<?php echo $this->get_field_id('hours'); ?>" name="<?php echo $this->get_field_name('hours'); ?>"><?php echo $instance['hours']; ?></textarea>

                        

                </p>             



        <?php
    }

    function widget($args, $instance) {
        global $smof_data;

        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
 
        echo $before_widget;
?>
        
<?php
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        };
        ?>
        <div class="contact-widget-bg">
            <?php
            if (!empty($instance['mobile_phone']) or !empty($instance['mobile_phone2'])):
                ?>

            <div class="mc">    
            <span class="mm_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_contact/icon-contact-mphone-38.png" alt="Phone" title="Phone"></span>     
            <?php if (!empty($instance['mobile_phone'])) { ?>
            <span class="mm"><?php echo $instance['mobile_phone']; ?></span>
                    <?php } ?>
                    <?php if (!empty($instance['mobile_phone2'])) { ?>
            <span class="mm"><?php echo $instance['mobile_phone2']; ?></span>
                    <?php } ?>
            </div>

            <?php endif; ?>    

            <?php
            if (!empty($instance['land_phone']) or !empty($instance['land_phone2'])):
                ?>

                <div class="mc">    
                <span class="mm_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_contact/icon-contact-sphone-38.png" alt="Phone" title="Phone"></span>     
                <?php if (!empty($instance['land_phone'])) { ?>
                <span class="mm"><?php echo $instance['land_phone']; ?></span>
                        <?php } ?>
                        <?php if (!empty($instance['land_phone2'])) { ?>
                <span class="mm"><?php echo $instance['land_phone2']; ?></span>
                        <?php } ?>
                </div>


            <?php endif; ?>

            <?php
            if (!empty($instance['fax1']) or !empty($instance['fax2'])):
                ?>

                <div class="mc">    
                <span class="mm_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_contact/icon-contact-fax-38.png" alt="Phone" title="Phone"></span>     
                <?php if (!empty($instance['fax1'])) { ?>
                <span class="mm"><?php echo $instance['fax1']; ?></span>
                        <?php } ?>
                        <?php if (!empty($instance['fax2'])) { ?>
                <span class="mm"><?php echo $instance['fax2']; ?></span>
                        <?php } ?>
                </div>


            <?php endif; ?> 


            <?php
            if (!empty($instance['email']) or !empty($instance['email2'])):
                ?>

                <div class="mc">    
                <span class="mm_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_contact/icon-contact-email-38.png" alt="Phone" title="Phone"></span>     
                <?php if (!empty($instance['email'])) { ?>
                <span class="mm"><?php echo $instance['email']; ?></span>
                        <?php } ?>
                        <?php if (!empty($instance['email2'])) { ?>
                <span class="mm"><?php echo $instance['email2']; ?></span>
                        <?php } ?>
                </div>

            <?php endif; ?>               


            <?php
            if (!empty($instance['skype']) or !empty($instance['skype2'])):
                ?>

                <div class="mc">    
                <span class="mm_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_contact/icon-contact-skype-38.png" alt="Phone" title="Phone"></span>     
                <?php if (!empty($instance['skype'])) { ?>
                <span class="mm"><?php echo $instance['skype']; ?></span>
                        <?php } ?>
                        <?php if (!empty($instance['skype2'])) { ?>
                <span class="mm"><?php echo $instance['skype2']; ?></span>
                        <?php } ?>
                </div>

            <?php endif; ?>           


            <?php
            if (!empty($instance['address']) or !empty($instance['address2'])):
                ?>

                 <div class="mc">    
                <span class="mm_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_contact/icon-contact-location-38.png" alt="Phone" title="Phone"></span>     
                <?php if (!empty($instance['address'])) { ?>
                <span class="mm"><?php echo $instance['address']; ?></span>
                        <?php } ?>
                        <?php if (!empty($instance['address2'])) { ?>
                <span class="mm"><?php echo $instance['address2']; ?></span>
                        <?php } ?>
                </div>

            <?php endif; ?>

            <?php
            if (!empty($instance['hours'])):
                ?>        
                <div class="mc">            
                <span class="mm_icon"><img src="<?php echo get_template_directory_uri(); ?>/image/icons_contact/icon-contact-hours-38.png" alt="Hours" title="Hours"></span>         
                <span class="mm"><?php echo $instance['hours']; ?></span>
                </div>

            <?php endif; ?>
        </div>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        $instance['address'] = $new_instance['address'];

        $instance['address2'] = $new_instance['address2'];

        $instance['mobile_phone'] = $new_instance['mobile_phone'];

        $instance['mobile_phone2'] = $new_instance['mobile_phone2'];

        $instance['skype'] = $new_instance['skype'];

        $instance['skype2'] = $new_instance['skype2'];

        $instance['land_phone'] = $new_instance['land_phone'];

        $instance['land_phone2'] = $new_instance['land_phone2'];

        $instance['email'] = $new_instance['email'];

        $instance['email2'] = $new_instance['email2'];

        $instance['hours'] = $new_instance['hours'];
        $instance['fax1'] = $new_instance['fax1'];
        $instance['fax2'] = $new_instance['fax2'];


        return $instance;
    }

}

add_action('widgets_init', create_function('', 'register_widget( "sds_widget_address_info" );'));
?>