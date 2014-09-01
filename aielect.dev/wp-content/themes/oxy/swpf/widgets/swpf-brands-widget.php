<?php

global $woocommerce;

if(isset($woocommerce) and !class_exists('SWPF_Brand_Widget')):

	class SWPF_Brand_Widget extends WP_Widget {
		
		
		public function __construct() {
			parent::__construct(
					'SWPF_Brand_Widget', // Base ID  
					'Oxy Woocommerce Brands', // Name  
					array('description' => __('Oxy Woocommerce Brands.','oxy'))
			);
		}
		public function form($instance) {
			$defaults = array(
				'title' => 'Brands',
				'number' => '5',
				'show_logo' => 'no'			
			);
			$instance = wp_parse_args((array) $instance, $defaults);
			
			extract($instance);
			
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'oxy') ?></label><br/>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title ?>"style="width:216px;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Show Brands at most:', 'oxy') ?></label><BR/>
			<input type="text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number ?>"style="width:216px;" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('show_logo'); ?>"><?php _e('Show Logo:', 'oxy') ?></label><br/>
			<select id="<?php echo $this->get_field_id('show_logo'); ?>" name="<?php echo $this->get_field_name('show_logo'); ?>" style="width:100%;">
            
            	<option value="no"<?php echo $show_logo == 'no'?" selected='selected'":""?>>No</option>
                <option value="yes"<?php echo $show_logo == 'yes'?" selected='selected'":""?>>Yes</option>
                
            
            </select>
		</p>
        
		<?php
		
		}
		
		 public function update($new_instance, $old_instance) {
			
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = $new_instance['number'];
			$instance['show_logo'] = strip_tags($new_instance['show_logo']);
			
			return $instance;
		}
	
		public function widget($args, $instance) {
			
			$title = apply_filters('widget_title', $instance['title']);
                        
			$number = $instance['number'];
			$show_logo = $instance['show_logo'];
			
			extract($args, EXTR_SKIP);
			
			$arr = array('hide_empty'=>0,'number'=>$number);
			
			$terms = get_terms('brands',$arr);
			
			if(!empty($terms)):
			
				echo $before_widget;
				
				$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
				
				if (!empty($title)):
                                   
					echo $before_title . $title . $after_title;
				endif;
			if($show_logo == 'yes'):
                            
                        $cselid = 'carousel'.rand(0000,9999);
		?>
                
                            <script type="text/javascript">
                                jQuery(function($) {
                                    $('#<?php echo $cselid?>').flexslider({
                                      animation: "slide",
                                      animationLoop: true,
                                              slideshow: true,  
                                              controlNav: false,
                                              itemWidth: 180,
                                              maxItems: 100,
                                              minItems: 1
                                     }); 	
                            });
                            </script>
                            <div class="carousel-flex">     
                                <div id="<?php echo $cselid?>" class="carousel0 carousel">
                        <?php 
                        endif;
                        ?>
				<ul <?php echo ($show_logo == 'yes')?"class='slides'":""?>>
                
                <?php
				foreach($terms as $term):
				
					$attach_id = wcm_sds_brands_thumbnail_id($term->term_id);
		
					$image = wp_get_attachment_image_src($attach_id,'medium');
				
					//echo gettype($attach_id);
				
					if($attach_id > 0)
						$image = $image[0];
					else
                                            $image = sprintf("%s/image/no_image.png",get_template_directory_uri());;
//					else $image = sprintf("%s/image/featured-43x43.jpg",get_template_directory_uri());
				
				?>	
                	<li class="<?php echo ($show_logo == 'yes')? "":"parent-cat"?>">
                    	<a title="<?php echo $term->name?>" href="<?php echo get_term_link($term->slug,'brands')?>">
                        <?php 
						if($show_logo == 'yes'):
						?>
                        <img class="attachment-shop_thumbnail wp-post-image" src="<?php echo $image?>" width="32" height="32" />
                        <?php
						else:
						?>
                        
						<?php echo $term->name;
                                                endif;
                                                ?></a>
                    </li>
                
                <?php
				endforeach;
				?>
                
                </ul>
		<?php
		if($show_logo == 'yes')
                    echo '</div></div>';
			
				echo $after_widget;
			
			endif;
		
		}
		
	}
	add_action('widgets_init', create_function('', 'register_widget( "SWPF_Brand_Widget" );'));
	
endif;



?>