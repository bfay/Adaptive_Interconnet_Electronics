<?php

class Oxy_Brand_logo_Widget extends WP_Widget {
    
    
    public function __construct() {
        
        
        parent::__construct(
                'oxy-product-brand-logo', // Base ID  
                __('Oxy Product Brand Widget','oxy'), 
                array(
                    'description' => __('Oxy Product Brand Widget', 'oxy')
                )
        );
    }
    public function form($instance) {
        echo "Suitable only for Product Right Sidebar.";
    }
     public function update($new_instance, $old_instance) {
         
    }
    public function widget($args, $instance) {
        extract($args);
        
        echo $before_widget;
        
        if(function_exists('oxy_product_brand_logo'))
            oxy_product_brand_logo();
       
        echo $after_widget;
    }
}

add_action('widgets_init', create_function('', 'register_widget( "Oxy_Brand_logo_Widget" );'));