<?php
 /*
  * Template Name: Contact
  */
global $post, $smof_data;  

$pagetitle_status = get_post_meta($post->ID, 'oxy_show_page_title', true);
$breadcrumb_status = get_post_meta($post->ID, 'oxy_show_breadcrumb', true);
$design = get_post_meta($post->ID, 'oxy_page_layout', true);

$sidebarleft = $sidebarright = '';
$content_class = 'large-12 medium-12';
switch($design){
   case 1:
       $sidebarleft = get_contact_page_sidebar_markup();//contact-left-sidebar contact-right-sidebar
       $content_class = 'large-8 medium-8';
       break;
   case 2:
       $sidebarright = get_contact_page_sidebar_markup('contact-right-sidebar');
       $content_class = 'large-8 medium-8';
       break;
   
   case 4:
       $sidebarleft = get_contact_page_sidebar_markup('contact-left-sidebar', 'large-3 medium-3');
       $sidebarright = get_contact_page_sidebar_markup('contact-right-sidebar', 'large-3 medium-3');
       $content_class = 'large-6 medium-6';       
       break;
   
   default:
       $content_class = 'large-12 medium-12';
       break;
}

get_header();
?>
<section id="midsection">
    <div class="row">
        <section id="content" class="columns op">
            
            <div class="row">
                <div class="large-12 medium-12 columns">
                    <?php if($pagetitle_status == 1){?>
                    <h2><?php the_title()?></h2>
                    <?php }?>
                    <?php if($breadcrumb_status == 1 && function_exists('bcn_display')){?>
                    <div class="breadcrumb">                
                        <?php 
                            bcn_display();
                        ?>                
                    </div> 
                    <?php }?>
                    <?php if(isset($smof_data->oxy_general_settings['oxy_contact_map_status']) 
                            && $smof_data->oxy_general_settings['oxy_contact_map_status'] == 1){?>
                    <div class="contact-map">
                    <div id="map_div"></div>
                    </div>
                            <?php }?>
                    
                </div>
            </div>
            <div class="row">
                
                <?php echo $sidebarleft?>
                <div class="<?php echo $content_class?> columns contact_section">
                    <?php
                    if(have_posts()):while(have_posts()): the_post();
                        the_content();
                    endwhile; endif;
                    ?>
                </div>
                <?php echo $sidebarright?>                
            </div>
        </section>
        
    </div>
</section>

<?php
get_footer();