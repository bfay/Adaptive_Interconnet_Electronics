<?php

class Oxy_Related_Products_Widget extends WP_Widget {
    
    
    public function __construct() {
        
        
        parent::__construct(
                'oxy-related-products-widget', // Base ID  
                __('Oxy Related Products Widget','oxy'), 
                array(
                    'description' => __('Oxy Related Products Widget', 'oxy')
                )
        );
    }
    public function form($instance) {
        extract(wp_parse_args((array) $instance, array('title' => 'Related Products', 'numposts' => 4)));
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label><BR/>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" style="width:275px; height:30px" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('numposts'); ?>">Number of Product:</label><BR/>
            <input type="text" id="<?php echo $this->get_field_id('numposts'); ?>" name="<?php echo $this->get_field_name('numposts'); ?>" value="<?php echo $numposts; ?>" style="width:275px; height:30px" />
        </p>
        <?php
    }
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['numposts'] = strip_tags($new_instance['numposts']);
        return $instance;
    }
    public function widget($args, $instance) {
        extract($args);
        
        echo $before_widget;
        
        echo '<div class="product-right-sm-related">'.
        $before_title.$instance['title'].$after_title;
        
        if(function_exists('oxy_get_related_products_right'))
            oxy_get_related_products_right((int)$instance['numposts']);
        
        echo '</div>';
        
        echo $after_widget;
    }
}

add_action('widgets_init', create_function('', 'register_widget( "Oxy_Related_Products_Widget" );'));