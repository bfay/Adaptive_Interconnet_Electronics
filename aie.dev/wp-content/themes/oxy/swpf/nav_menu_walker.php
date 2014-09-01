<?php

class Main_nav_menu_walker extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0){
        
        if(!isset($item->object_id)){
        
            if(!is_object($args)) $args = (object) $args;

            if(empty($item->url))
                $item->url = get_permalink($item->ID);            
            if(empty($item->title)) $item->title = $item->post_title;

        }
        parent::start_el($output, $item, $depth, $args);
        
    }
    
    
    function end_el(&$output, $item, $depth = 0, $args = array()) {

        global $smof_data;
        
        if(isset($item->object_id)){            
            if($depth == 0)        
            switch ($item->object_id) {
    //            case $smof_data->oxy_general_settings['oxy_menu_categories_page']:
    //                $output .= self::get_product_categories_markup();                
    //                break;
                case $smof_data->oxy_general_settings['oxy_menu_brands_page']:
                    $output .= self::get_product_brands_markup();
                    break;
    //            case $smof_data->oxy_general_settings['oxy_menu_custom_block_page']:
    //                $output .= self::get_menu_custom_block();
    //                break;
                case $smof_data->oxy_general_settings['oxy_menu_contacts_page']:

                    $output .= self::get_menu_contact_block($item);
                    break;

                default:
                    $megamenus = $smof_data->oxy_general_settings['oxy_mega_menu'];
                    if(!empty($megamenus))
                    foreach($megamenus as $megamenu){
                        if((int)$megamenu['menu_id'] == $item->object_id){                        
                            if($megamenu['display_style'] == 2)
                                $output .= self::get_product_categories_vertical_markup($megamenu);    
                            else    
                                $output .= self::get_product_categories_markup($megamenu);
                        }
                    }
                    break;
            }
        }
        else{
            if(!is_object($args)) $args = (object) $args;
            
            if(empty($item->url))
                $item->url = get_permalink($item->ID);            
            if(empty($item->title)) $item->title = $item->post_title;
        }
        
        parent::end_el($output, $item, $depth, $args);
    }

    public static function get_menu_contact_block($item) {
        global $smof_data;
        if (!isset($smof_data->oxy_general_settings['oxy_menu_contacts_block_status']) or $smof_data->oxy_general_settings['oxy_menu_contacts_block_status'] == 0)
            return;
        ob_start();
        ?>
        <div class="large-6 medium-6 small-6 columns menu_contacts hide-for-small" style="margin-left: -346.5px;">

            <ul class="s6 columns">
                <li>               
                    <span class="ngw"><?php _e('Contacts','oxy')?></span>

                    <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_mphone1']) || 
                            !empty($smof_data->oxy_general_settings['oxy_contact_mphone2'])){?>
                    <div class="mc">    
                        <span class="mm_icon"><img title="Phone" alt="Phone" src="<?php echo get_template_directory_uri()?>/image/icons_contact/icon-contact-mphone-38.png"></span>     
                        <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_mphone1'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_mphone1'] ?></span>
                        <?php }if(!empty($smof_data->oxy_general_settings['oxy_contact_mphone2'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_mphone2'] ?></span>
                        <?php }?>
                    </div>
                    <?php
                    }
                    ?>


                    <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_sphone1']) || 
                            !empty($smof_data->oxy_general_settings['oxy_contact_sphone2'])){?>
                    <div class="mc">    
                        <span class="mm_icon"><img title="Phone" alt="Phone" src="<?php echo get_template_directory_uri()?>/image/icons_contact/icon-contact-sphone-38.png"></span>     
                        <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_sphone1'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_sphone1'] ?></span>
                        <?php }if(!empty($smof_data->oxy_general_settings['oxy_contact_sphone2'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_sphone2'] ?></span>
                        <?php }?>
                    </div>
                    <?php
                    }
                    ?>
                    
                    <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_fax1']) || 
                            !empty($smof_data->oxy_general_settings['oxy_contact_fax2'])){?>
                    <div class="mc">    
                        <span class="mm_icon"><img title="Phone" alt="Phone" src="<?php echo get_template_directory_uri()?>/image/icons_contact/icon-contact-fax-38.png"></span>     
                        <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_fax1'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_fax1'] ?></span>
                        <?php }if(!empty($smof_data->oxy_general_settings['oxy_contact_fax2'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_fax2'] ?></span>
                        <?php }?>
                    </div>
                    <?php
                    }
                    ?>
                    
                    <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_email1']) || 
                            !empty($smof_data->oxy_general_settings['oxy_contact_email2'])){?>
                    <div class="mc">    
                        <span class="mm_icon"><img title="Phone" alt="Phone" src="<?php echo get_template_directory_uri()?>/image/icons_contact/icon-contact-email-38.png"></span>     
                        <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_email1'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_email1'] ?></span>
                        <?php }if(!empty($smof_data->oxy_general_settings['oxy_contact_email2'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_email2'] ?></span>
                        <?php }?>
                    </div>
                    <?php
                    }
                    ?>
                    
                    <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_skype1']) || 
                            !empty($smof_data->oxy_general_settings['oxy_contact_skype2'])){?>
                    <div class="mc">    
                        <span class="mm_icon"><img title="Phone" alt="Phone" src="<?php echo get_template_directory_uri()?>/image/icons_contact/icon-contact-skype-38.png"></span>     
                        <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_skype1'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_skype1'] ?></span>
                        <?php }if(!empty($smof_data->oxy_general_settings['oxy_contact_skype2'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_skype2'] ?></span>
                        <?php }?>
                    </div>
                    <?php
                    }
                    ?>
                    
                </li>
            </ul>  

            <ul class="s6 columns">
                <li>
                    <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_location1']) || 
                            !empty($smof_data->oxy_general_settings['oxy_contact_location2'])){?>
                    <span class="ngw"><?php _e('Address','oxy');?></span>      
                    <div class="mc">        
                        <span class="mm_icon"><img title="Location" alt="Location" src="<?php echo get_template_directory_uri()?>/image/icons_contact/icon-contact-location-38.png"></span>
                        <?php if(!empty($smof_data->oxy_general_settings['oxy_contact_location1'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_location1']?></span>
                        <?php }if(!empty($smof_data->oxy_general_settings['oxy_contact_location2'])){?>
                        <span class="mm"><?php echo $smof_data->oxy_general_settings['oxy_contact_location2']?></span>
                        <?php }?>
                    </div>
                    <?php }
                    $oxy_contact_hours1 = get_option('oxy_contact_hours1');
                    if(!empty($oxy_contact_hours1)){?>
                    <br> 	        
                    <span class="ngw"><?php _e('Office Opening Hours','oxy');?></span>
                    <div class="mc">               
                        <span class="mm_icon"><img title="Hours" alt="Hours" src="<?php echo get_template_directory_uri()?>/image/icons_contact/icon-contact-hours-38.png"></span>         
                        <span class="mm"><?php //echo $smof_data->oxy_general_settings['oxy_contact_hours1']
                        echo $oxy_contact_hours1;
                        ?></span>
                    </div>
                    <br>
                    <?php }?>
                    <a class="button" href="<?php echo get_permalink($item->object_id);?>"><?php _e('Contact Form','oxy')?></a> 
                </li>
            </ul>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public static function get_menu_custom_block() {
        global $smof_data;
        if (!isset($smof_data->oxy_general_settings['oxy_menu_custom_block_content_11']) or empty($smof_data->oxy_general_settings['oxy_menu_custom_block_content_11']))
            return;
        ob_start();
        ?>
        <div class="menu_custom_block">
            <ul>
                <li>
                    <div>
        <?php echo $smof_data->oxy_general_settings['oxy_menu_custom_block_content_11']; ?>
                    </div>
                </li>
            </ul>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public static function get_product_categories_vertical_markup($megamenu) {
        global $woocommerce;

        if (!isset($woocommerce))
            return;
        
        extract($megamenu);
        $parent = !empty($category_id) ? (int) $category_id : 0;
        
        $args = array('hide_empty' => false, 'parent' =>$parent);
        if(isset($orderby) && isset($order)){
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        }
        $terms = get_terms('product_cat', $args);
        
        if (empty($terms) or is_wp_error($terms))
            return;
        
        ob_start();
        ?>
        <ul class="sub-menu">
            <?php foreach($terms as $t1){?>            
            <li>
                <a href="<?php echo get_term_link($t1, 'product_cat')?>"><?php echo $t1->name?></a>
                <?php                
                $t2 = get_terms('product_cat', array('hide_empty' => false, 'parent' => $t1->term_id));
                if(!empty($t2) && !is_wp_error($t2)){
                ?>                
                <ul class="sub-menu">
                    <?php foreach($t2 as $t3){?>
                    <li>
                        <a href="<?php echo get_term_link($t3, 'product_cat')?>"><?php echo $t3->name?></a>
                        <?php                
                        $t4 = get_terms('product_cat', array('hide_empty' => false, 'parent' => $t3->term_id));
                        if(!empty($t4) && !is_wp_error($t4)){
                        ?>                
                        <ul class="sub-menu">
                            <?php foreach($t4 as $t5){?>
                            <li>
                                <a href="<?php echo get_term_link($t5, 'product_cat')?>"><?php echo $t5->name?></a>
                            </li>
                            <?php }?>
                        </ul>                        
                        <?php }?>
                    </li>                     
                    <?php }?>                    
                </ul>                        
                <?php }?>
            </li>
            <?php }?>
        </ul>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        
        return $content;
    }
    

    public static function get_product_categories_markup($megamenu) {
        global $woocommerce;

        if (!isset($woocommerce))
            return;
        
        extract($megamenu);
        $parent = !empty($category_id) ? (int) $category_id : 0;
        
        $args = array('hide_empty' => false, 'parent' =>$parent);
        if(isset($orderby) && isset($order)){
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        }
            
        
        $terms = get_terms('product_cat', $args);
        
        if (empty($terms) or is_wp_error($terms))
            return;
        
        ob_start();
        ?>
        <div class="large-10 medium-10 small-10 columns">
            <?php if(!empty($menu_top)){?>
            <div class="large-12 megamenu_content">
                <?php echo $menu_top?>
            </div>
            <?php
            }
            ?>
            <div>
            <?php
            foreach ($terms as $term):    
                $term_link = get_term_link($term, 'product_cat');                
                ?>
                <div class="five-nb columns">
                    <?php if($show_icon == 2){?>
                    <div class="image">
                        <a href="<?php echo $term_link; ?>">
                            <?php 
                            $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
                            $image = woocommerce_placeholder_img_src();
                            if(!empty($thumbnail_id)){
                                $image = wp_get_attachment_image_src($thumbnail_id,array(100,100));
                                $image = $image[0];
                            }
                            ?>                            
                            <img alt="<?php echo $term->name; ?>" width='100' height='100' title="<?php echo $term->name; ?>" src="<?php echo $image?>">
                        </a>
                    </div>
                    <?php }?>
                    <span><a href="<?php echo $term_link; ?>"><?php echo $term->name; ?></a></span>
                    <?php
                    $args2 = array('hide_empty' => false, 'parent' => $term->term_id);
                    $child_terms = get_terms('product_cat', $args2);
                    $c = 0;                    
                    if (!empty($child_terms) && !is_wp_error($child_terms)):
                        ?>          
                        <ul>
                            <?php foreach ($child_terms as $t): 
                                if(++$c > (int) $limit) break;
                                ?>
                                <li><a href="<?php echo get_term_link($t, 'product_cat'); ?>"><?php echo $t->name; ?></a>                    
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            </div>
            <?php if(!empty($menu_bottom)){?>
            <div class="large-12 megamenu_content">                
                <?php echo $menu_bottom?>                
            </div>
            <?php }?>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public static function get_product_brands_markup() {

        global $smof_data, $woocommerce;

        if (!isset($smof_data->oxy_general_settings['oxy_menu_brands_status']) 
                || $smof_data->oxy_general_settings['oxy_menu_brands_status'] != 1)
            return;
        
        if (!isset($woocommerce))
            return;
        $args = array('hide_empty' => false, 'parent' => 0);
        $terms = get_terms('brands', $args);
        if (empty($terms) or is_wp_error($terms))
            return;
        $c = 0;
        ob_start();
        ?>

        <div class="large-10 medium-10 small-10 columns brands-wall"> 

            <?php
            $per_row = (int)$smof_data->oxy_general_settings['oxy_menu_brands_per_row'] + 1;
            
            foreach ($terms as $term):
                $c++;
                $thumb_id = wcm_sds_brands_thumbnail_id($term->term_id);
                if (!empty($thumb_id)) {
                    $image = wp_get_attachment_image_src((int) $thumb_id, 'full');
                    $image = $image[0];
                }
                $class = '';
                if ($c % $per_row == 0)
                    $class = 'clearleft';
                
                $link = get_term_link($term, 'brands');                
                ?>

                <div class="large-2 medium-2 small-12 columns <?php echo $class ?>">
                    
                    <?php
                        switch ((int)$smof_data->oxy_general_settings['oxy_menu_brands_style']){
                            case 2:
                            ?>
                            <div class="name"><a href="<?php echo $link ?>"><?php echo $term->name ?></a></div>
                              <?php  
                                break;
                            case 3:
                            ?>
                            <div class="image">
                                <a href="<?php echo $link ?>">
                                <?php if (isset($image)) { ?>
                                    <img alt="<?php echo $term->name ?>" 
                                         title="<?php echo $term->name ?>"
                                         src="<?php echo $image ?>" />
                                <?php } ?>
                                </a>
                            </div>
                            <div class="name"><a href="<?php echo $link ?>"><?php echo $term->name ?></a></div>                            
                            <?php
                            break;
                            default: ?>
                            <div class="image">
                                <a href="<?php echo $link ?>">
                                <?php if (isset($image)) { ?>
                                    <img alt="<?php echo $term->name ?>" 
                                         title="<?php echo $term->name ?>"
                                         src="<?php echo $image ?>" />
                                <?php } ?>
                                </a>
                            </div>
                        <?php
                            break;
                        }
                    ?>
                </div>

        <?php endforeach; ?>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    function product_category_listing() {

        global $smof_data, $woocommerce;

        if (!isset($woocommerce))
            return;

        ob_start();

        $args = array('hide_empty' => false, 'parent' => 0);
        $terms = get_terms('product_cat', $args);

        if (!empty($terms)):

            if ($smof_data->oxy_general_settings['sellya_menu_categories_style'] == 'Horizontal'):
                ?>
                <ul class="large-10 medium-10 small-10 sub-menu">
                    <?php
                    foreach ($terms as $i => $term):

                        $args = array('hide_empty' => false, 'parent' => $term->term_id);
                        $t2 = get_terms('product_cat', $args);
                        ?>
                        <div class="span2<?php echo $i % 5 == 0 ? " span-first-child" : "" ?>">

                            <?php
                            if ($smof_data->oxy_general_settings['sellya_mm2_main_category_icon_status'] != 0):

                                $thumbnail_id = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);

                                $image = wp_get_attachment_image_src($thumbnail_id, 'full');

                                $image = $image[0];

                                $img_class = '';

                                if (!$thumbnail_id):
                                    $image = sprintf("%s/image/no_image-100x100.png", get_template_directory_uri());
                                    $img_class = 'no_image';

                                endif;
                                ?>                
                                <div class="image catmegamenu"><a href="<?php echo get_term_link($term->slug, 'product_cat'); ?>"><img alt="<?php echo $term->name ?>" class="<?php echo $img_class; ?>" title="<?php echo $term->name ?>" src="<?php echo $image ?>"></a></div>

                        <?php
                    endif;
                    ?>

                            <div class="menu-category-wall-sub-name">
                                <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?>"><?php echo $term->name ?></a>
                            </div>
                    <?php if (!empty($t2)): ?>
                                <div>
                                    <ul>
                        <?php foreach ($t2 as $t): ?>
                                            <li><a href="<?php echo get_term_link($t->slug, 'product_cat'); ?>"><?php echo $t->name ?> (<?php echo $t->count ?>)</a></li>

                        <?php endforeach; ?>
                                    </ul>
                                </div>
                    <?php endif; ?>
                        </div>

                    <?php
                endforeach;
                ?>

                </ul>
                <?php
            else:
                ?>
                <ul class="sub-menu">
                <?php
                foreach ($terms as $i => $term):

                    $args = array('hide_empty' => false, 'parent' => $term->term_id);
                    $t2 = get_terms('product_cat', $args);
                    ?>
                        <li>
                            <a href="<?php echo get_term_link($term->slug, 'product_cat'); ?>"><?php echo $term->name ?></a>
                    <?php if (!empty($t2)): ?>
                                <ul class="sub-menu">
                                <?php foreach ($t2 as $t): ?>
                                        <li><a href="<?php echo get_term_link($t->slug, 'product_cat'); ?>"><?php echo $t->name ?> (<?php echo $t->count ?>)</a></li>

                        <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                        </li>

                    <?php
                endforeach;
                ?>

                </ul>
            <?php
            endif; //
        endif; //if(!empty($terms)):

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }

}
?>