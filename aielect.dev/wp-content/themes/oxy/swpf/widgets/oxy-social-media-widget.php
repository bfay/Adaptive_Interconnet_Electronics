<?php

class Oxy_Social_Media_Widget extends WP_Widget {
    public $defs, $fieldlabels;
    
    public function __construct() {
        
        $this->defs = array(
            'title' => '',
            'facebook' => '',            
            'twitter' => '',            
            'google' => '',            
            'rss' => '',            
            'pinterest' => '',            
            'vimeo' => '',            
            'flickr' => '',            
            'linkedin' => '',            
            'youtube' => '',            
            'dribbble' => '',            
            'instagram' => '',            
            'behance' => '',            
            'skype' => '',            
            'forrst' => '',            
            'bing' => '',            
            'myspace' => '',            
            'tumblr' => '',            
            'reddit' => '',            
        );
        
        $this->fieldlabels = array(
            'title' => 'Widget Title: ',
            'facebook' => 'Facebook: ',            
            'twitter' => 'Twitter: ',            
            'google' => 'Google Plus: ',            
            'rss' => 'RSS: ',            
            'pinterest' => 'Pinterest: ',            
            'vimeo' => 'Vimeo: ',            
            'flickr' => 'Flickr: ',            
            'linkedin' => 'Linkedin: ',            
            'youtube' => 'Youtube: ',            
            'dribbble' => 'Dribbble: ',
            'instagram' => 'Instagram: ',            
            'behance' => 'Behance: ',            
            'skype' => 'Skype: ',            
            'forrst' => 'Forrst: ',            
            'bing' => 'Bing: ',            
            'myspace' => 'Myspace: ',            
            'tumblr' => 'Tumblr:',            
            'reddit' => 'Reddit: ', 
        );
        parent::__construct(
                'oxy-social-media', // Base ID  
                __('Oxy Social Media Widget','oxy'), 
                array(
                    'description' => __('Oxy Social Media Widget', 'oxy')
                )
        );
    }
    public function form($instance) {
        
        wp_parse_args((array) $instance, $this->defs);        
        foreach($this->fieldlabels as $key => $label):
            if(!isset($instance[$key]))
                $fieldval = $this->defs[$key];
            else
                $fieldval = $instance[$key];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $label ?></label><BR/>
            <input type="text" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" value="<?php echo $fieldval; ?>" style="width:275px; height:30px" />
        </p>
        <?php
        endforeach;
        
    }
     public function update($new_instance, $old_instance) {
         
         $instance['title'] = strip_tags($new_instance['title']);
         $k = 0;
         foreach($this->defs as $key => $val):
             $k++;
             if($k > 1)
             $instance[$key] = $new_instance[$key];
         
         endforeach;
        
        return $instance;
    }
    public function widget($args, $instance) {
        extract($args);
        
        echo $before_widget;
        
        if(!empty($instance['title']))
            echo $before_title.$instance['title'].$after_title;
        ?>
        <div class="social_widget">
        <ul>        
        <?php
        $k = 0;
        foreach($this->defs as $key => $val):
             $k++;
             if($k > 1 && $instance[$key] != '')             
                echo "<li class='{$key}'><a href='{$instance[$key]}' class='tiptip' title='".ucfirst($key)."' target='_blank'>".ucfirst($key)."</a></li>";
         endforeach;
        ?>
         </ul>
        </div>        
        <?php
        echo $after_widget;
    }
}

add_action('widgets_init', create_function('', 'register_widget( "Oxy_Social_Media_Widget" );'));