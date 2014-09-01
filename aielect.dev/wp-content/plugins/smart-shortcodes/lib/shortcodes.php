<?php
add_shortcode('testimonials', 'testimonials_cb');

function testimonials_cb($atts = array()) {
    
    extract(shortcode_atts(array('showposts' => '-1','orderby' => 'date', 'order' => 'DESC', 'direction' => 'horizontal','slideshowSpeed' => '7000'), $atts));
    
    ob_start();    
    $test_query = new WP_Query("post_type=oxy-testimonial&showposts={$showposts}&orderby={$orderby}&order={$order}");
    if ($test_query->have_posts()) {
        $rand = rand(000000,999999);
        
        ?>
        <div id="testimonial_slider_<?php echo $rand?>" class="testimonial_slider_wrap"><ul class="testimonial_slider">
            <?php while ($test_query->have_posts()): $test_query->the_post();             
            $testimonial_metas = get_post_meta(get_the_ID(), 'testimonial-metas', true);
            $testimonial_metas = json_decode($testimonial_metas,true);            
            ?>
                <li>
                    <div class="quote_icon">
                        <i class="dashicons dashicons-format-quote"></i>
                    </div>
                    <div class="quote_bottom_content">
                        <h2 class="author"><?php the_title() ?></h2>
                        <p><?php echo strip_tags(get_the_content()) ?></p>                    
                        <p class="quote_author"><?php echo urldecode($testimonial_metas['testimonial-author'])?></p>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul></div>
<script type="text/javascript">
// <![CDATA[
    jQuery(function($){
        $(window).load(function(){
            var ts = $('#testimonial_slider_<?php echo $rand?>');
            ts.flexslider({
                animation: "slide",                
                slideshow: true,
                slideshowSpeed: <?php echo intval($slideshowSpeed)?>,
                controlNav: true,
                directionNav: false,
                pauseOnHover: true,
                smoothHeight : true,
                direction: '<?php echo $direction?>',
                selector : 'ul.testimonial_slider > li'
            });
        });
    });
// ]]>
</script>
    <?php } wp_reset_query(); 
    $content = ob_get_clean();
    
    return $content;
}



add_shortcode('oxy-latest-posts', 'oxy_latest_posts_cb');

function oxy_latest_posts_cb($atts = array()) {

    extract(shortcode_atts(array('showposts' => '4','orderby' => 'date', 'order' => 'DESC', 'title' => 'Latest Blog Posts', 'slider' => 'true'), $atts));
    
    $rowclass = 'row';
    if($slider == 'true')
        $rowclass = 'blogrow';
    
    $rand = rand(000000,999999);
    $posthtml = '<div class="product-box-slider">';
    $posthtml .= '<div class="box-heading">'.$title.'</div>';
    
    $posthtml .= '<div id="latest_blog_'.$rand.'" class="product-box-slider-flexslider">';
    
    $posthtml .= '<div class="'.$rowclass.'">';
    $query = new WP_Query("showposts={$showposts}&orderby={$orderby}&order={$order}");
    $n = 0;
    while ($query->have_posts()) : $query->the_post();
        $clear = '';
        if(++$n % 4 == 0 && $slider != 'true')
            $clear = ' clearleft';
    
        $posthtml .= '<div class="large-3 medium-3 small-6 columns'.$clear.'">';
        $posthtml .= '<span class="news_module_image_holder">';
        if(get_post_format() == 'video'){            
            $posthtml .= get_post_meta(get_the_ID(),'oxy-video-link',true);
        }elseif(get_post_format() == 'gallery'){
            $galleries = get_post_meta(get_the_ID(), 'oxy-gallery', true);
            if (!empty($galleries)) {
                $galleries = explode(',', $galleries);
                ob_start();
                ?>
                <div class="flexslider flexshortcode">             
                    <ul class="list-unstyled slides">
                        <?php
                        foreach ($galleries as $gallery) {
                            $gallery = intval($gallery);
                            ?>
                            <li>
                                <a href="<?php echo get_permalink($gallery); ?>">
                                <?php echo wp_get_attachment_image($gallery, 'blog-thumb-medium'); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php
                $posthtml .= ob_get_clean();
            }
        }
        else
            $posthtml .= '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(),'blog-thumb-medium').'</a></span>';
        
        $posthtml .= '<span>'.get_the_date().'</span>';
        $posthtml .= '<h4><a href="'.get_permalink().'" title="'.get_the_title().'">' . get_the_title() . '</a></h4>';
        $posthtml .= '<p>' . substr(get_the_excerpt(), 0, 150) . '</p>';
        $posthtml .= '<a href="' . get_permalink() . '" class="r_more">' . __('Read More', 'galka') . '</a>';
        $posthtml .= '</div>';
    endwhile;
    wp_reset_query();
    
    $posthtml .= '</div></div></div>';
    
    if($slider == 'true')
        $posthtml .= "<script type='text/javascript'>
            jQuery(function(\$) {
                var main = \$('#latest_blog_{$rand}');
                var wd = main.find('div.blogrow > div.columns:first-child').width();
                
                main.flexslider({
                    animation: \"slide\",
                    animationLoop: false,
                    slideshow: false,
                    controlNav: false,
                    itemWidth: wd,
                    maxItems: 4,
                    minItems: 1,
                    selector: 'div.blogrow > div.columns',
                });
            });
            </script>";
                
    return $posthtml;
}

// Start full width 
function shortcode_full($atts, $content = null){
    
    return '<div class="small-12 medium-12 large-12 ">' . do_shortcode($content) . '</div>';
}
add_shortcode('full', 'shortcode_full');
// End full width 
// Start half width 
function shortcode_half($atts, $content = null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div class="small-6 medium-6 large-6 columns '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('half', 'shortcode_half');
// End half width 
// Start one_third
function shortcode_onethird($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div class="small-4 medium-4 large-4 columns '.$class.'">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_third', 'shortcode_onethird');
// end one_third
//start one fourth
function shortcode_onefourth($atts, $content=null){
     extract(shortcode_atts(array(
        'class' => ''
    ), $atts));
return '<div class="small-3 medium-3 large-3 columns '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'shortcode_onefourth');
//end one fourth

//start one sixth
function shortcode_onesixth($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div class="small-2 medium-2 large-2 columns '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'shortcode_onesixth');
//end one sixth
//start two thirds
function shortcode_twothirds($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
	return '<div class="small-8 medium-8 large-8 columns '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'shortcode_twothirds');
//end two third
//start three fourth
function shortcode_threefourths($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div class="small-9 medium-9 large-9 columns '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'shortcode_threefourths');
//end three fourth
//start five_sixth
function shortcode_five_sixth($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div class="small-10 medium-10 large-10 columns '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'shortcode_five_sixth');
//end five_sixth

//start small button 
function shortcode_button_small($atts, $content = NULL){
    $defaults = array(
		'href' => '#'
	);
    extract(shortcode_atts($defaults,$atts));
	return "<a class='button tiny' href='{$href}'>".do_shortcode($content)."</a>";
}
add_shortcode('button_small', 'shortcode_button_small');
//end small button 
//start medium button 
function shortcode_button_medium($atts, $content = NULL){
    $defaults = array(
		'href' => '#'
	);
    extract(shortcode_atts($defaults,$atts));	
        return "<a class='button' href='{$href}'>".do_shortcode($content)."</a>";
}
add_shortcode('button_medium', 'shortcode_button_medium');
//end medium button 
//start large button 
function shortcode_button_large($atts, $content = NULL){
    $defaults = array(
		'href' => '#'
	);
    extract(shortcode_atts($defaults,$atts));	
        return "<a class='button expand' href='{$href}'>".do_shortcode($content)."</a>";
}
add_shortcode('button_large', 'shortcode_button_large');
//end large button 
//start button 
function shortcode_button($atts, $content = NULL){
	$defaults = array(
		'href' => '#'
	);
	extract(shortcode_atts($defaults,$atts));	
	return "<a class='button ' href='{$href}'>".do_shortcode($content)."</a>";
}
add_shortcode('button', 'shortcode_button');
//end button 
//start panel 
function shortcode_panel($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div class="panel '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('panel', 'shortcode_panel');
//end panel 
//start alert 
function shortcode_alert($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('alert', 'shortcode_alert');
//end alert 
//start success alert 
function shortcode_alert_success($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box success '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('success-alert', 'shortcode_alert_success');
//end success alert 
//start success alert radius
function shortcode_success_alert_radius($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box success radius '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('success-alert-radius', 'shortcode_success_alert_radius');
//end success alert radius
//start success alert round
function shortcode_success_alert_round($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box success round '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('success-alert-round', 'shortcode_success_alert_round');
//end success alert round
//start warning alert 
function shortcode_alert_warning($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box warning '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('warning-alert', 'shortcode_alert_warning');
//end warning alert 
//start warning alert radius
function shortcode_warning_alert_radius($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box warning radius '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('warning-alert-radius', 'shortcode_warning_alert_radius');
//end warning alert radius
//start warning alert round
function shortcode_warning_alert_round($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box warning round '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('warning-alert-round', 'shortcode_warning_alert_round');
//end warning alert round
//start info alert 
function shortcode_alert_info($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box info '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('info-alert', 'shortcode_alert_info');
//end info alert 
//start info alert radius
function shortcode_info_alert_radius($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box info radius '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('info-alert-radius', 'shortcode_info_alert_radius');
//end info alert radius
//start info alert round
function shortcode_info_alert_round($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => ''        
    ), $atts));
return '<div data-alert class="alert-box info round '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('info-alert-round', 'shortcode_info_alert_round');
//end info alert round
//start Progressbar
function shortcode_progressbar($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar', 'shortcode_progressbar');
//end Progressbar
//start Progressbar radius
function shortcode_progressbar_radius($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress radius '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-radius', 'shortcode_progressbar_radius');
//end Progressbar radius
//start Progressbar round
function shortcode_progressbar_round($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress round '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-round', 'shortcode_progressbar_round');
//end Progressbar round
//start Progressbar success 
function shortcode_progressbar_success($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress success '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-success', 'shortcode_progressbar_success');
//end Progressbar success
//start Progressbar success radius
function shortcode_progressbar_success_radius($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress success radius '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-success-radius', 'shortcode_progressbar_success_radius');
//end Progressbar success radius
//start Progressbar success round
function shortcode_progressbar_success_round($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress success round '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-success-round', 'shortcode_progressbar_success_round');
//end Progressbar success round
//start Progressbar alert  
function shortcode_progressbar_alert($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress alert '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-alert', 'shortcode_progressbar_alert');
//end Progressbar alert
//start Progressbar alert  radius
function shortcode_progressbar_alert_radius($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress alert radius '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-alert_radius', 'shortcode_progressbar_alert_radius');
//end Progressbar alert radius

//start Progressbar alert  round
function shortcode_progressbar_alert_round($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress alert round '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-alert_round', 'shortcode_progressbar_alert_round');
//end Progressbar alert round

//start Progressbar secondary
function shortcode_progressbar_secondary($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress secondary '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-secondary', 'shortcode_progressbar_secondary');
//end Progressbar secondary 
//start Progressbar secondary radius
function shortcode_progressbar_secondary_radius($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress secondary radius '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-secondary-radius', 'shortcode_progressbar_secondary_radius');
//end Progressbar secondary radius

//start Progressbar secondary round
function shortcode_progressbar_secondary_round($atts, $content=null){
    extract(shortcode_atts(array(
        'class' => '',
        'width' => ''
    ), $atts));
return '<div class="progress secondary round '.$class.'"><span style="width: '.$width.';" class="meter"></span></div>';
}
add_shortcode('progressbar-secondary-round', 'shortcode_progressbar_secondary_round');
//end Progressbar secondary round

function oxy_gmap_cb($atts = array()){
    
    $theme = wp_get_theme();
    $theme = $theme->__toString();
    $theme = strtolower($theme);
    
    if(strpos($theme,'oxy') === false) {        
        echo "<strong>Oxy</strong> theme is not activated!";
        return;
    }
    
    extract(shortcode_atts(array(
        'type' => 'ROADMAP',
        'lat' => '51.5224954',
        'lng' => '-0.1720996',        
        'zoom' => '15',        
        'height' => '358',        
        'markercontent' => '',
        'contentwidth' => '250'
    ), $atts));
    $markercontent = preg_replace_callback('/(\r|\n|\t)+/', create_function('$match','return "";'), addslashes($markercontent));
    $lat = trim($lat);
    $lng = trim($lng);
    
    if(empty($lat) || empty($lng)) return false;
    
     wp_enqueue_script('google-map', '//maps.google.com/maps/api/js?sensor=true', array('jquery'), '', true);
    
    $rand = rand(00000,99999);
ob_start();
?>

<div class="contact-map">
<div id="map_div_<?php echo $rand?>"></div>
</div>


<script type="text/javascript">
    jQuery(function($) {

            //------- Google Maps ---------//
            // Creating a LatLng object containing the coordinate for the center of the map
            var latlng = new google.maps.LatLng(parseFloat(<?php echo $lat?>),parseFloat(<?php echo $lng?>));

            // Creating an object literal containing the properties we want to pass to the map  
            var options = {  
                    zoom: <?php echo $zoom?>, // This number can be set to define the initial zoom level of the map
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.<?php echo $type;?>, // This value can be set to define the map type ROADMAP/SATELLITE/HYBRID/TERRAIN
                    scrollwheel : false
            };  
            // Calling the constructor, thereby initializing the map  
            var map = new google.maps.Map(document.getElementById('map_div_<?php echo $rand?>'), options);  

            
            var ph = $('#map_div_<?php echo $rand?>').parent().css('padding-top').replace(/[^0-9]+/,'');            
            ph = parseInt(ph) * 2;
            ph += <?php echo $height?>;
            
            
            
            $('#map_div_<?php echo $rand?>').css('height','<?php echo $height?>px');
            $('#map_div_<?php echo $rand?>').parent().css('min-height',ph+'px');
            // Define Marker properties
            var image = new google.maps.MarkerImage(
                    //Image file name
                    '<?php echo get_template_directory_uri() ?>/image/map_marker.png',
                    // This marker is 129 pixels wide by 42 pixels tall.
                    new google.maps.Size(57, 76),
                    // The origin for this image is 0,0.
                    new google.maps.Point(0,0),
                    // The anchor for this image is the base of the flagpole at 18,42.
                    new google.maps.Point(30, 76)
            );

            // Add Marker
            var marker1 = new google.maps.Marker({
                    position: new google.maps.LatLng(parseFloat(<?php echo $lat?>),parseFloat(<?php echo $lng?>)), 
                    map: map,
                    icon: image // This path is the custom pin to be shown. Remove this line and the proceeding comma to use default pin
            });	

            // Add listener for a click on the pin
            
            <?php if(!empty($markercontent)){?>
            // Add information window
            var infowindow1 = new google.maps.InfoWindow({  
                    content:  '<?php echo $markercontent?>',
                    maxWidth: parseFloat(<?php echo $contentwidth?>)
            }); 
            
            google.maps.event.addListener(marker1, 'mouseover', function() {
                infowindow1.open(map, marker1);
            });
            <?php }?>
    });
</script>
<?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}
add_shortcode('gmap', 'oxy_gmap_cb');
//end gmap
//start toggle
function shortcode_toggle($atts, $content = null) {

    extract(shortcode_atts(array(
        'title' => ''
                    ), $atts));

    return '<div class="toggle-box"><h2 class="trigger">' . $title . '</h2>

<div class="toggle_container">' . do_shortcode($content) . '</div></div>';
}

add_shortcode('toggle', 'shortcode_toggle');
//end toggle

//start accordion
function shortcode_accordions($attr, $content) {
    wp_enqueue_script(array('jquery-ui-accordion'), '', array('jquery','jquery-ui-core'));
    return "<div class='accordion'>" . do_shortcode($content) . "</div>";
}
add_shortcode('accordion', 'shortcode_accordions');
function shortcode_accordion($atts, $contents) {
    $defaults = array('title' => '');
    extract(shortcode_atts($defaults, $atts));
    ob_start();
    ?>
    <h3><?php echo $title; ?></h3>
    <div class="toggleText">
    <?php echo $contents; ?>
    </div>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('atab', 'shortcode_accordion');
//end accordion

// ui-tabs

class SDS_UI_Tabs {

    static $tab_counter = 0, $tablink = '', $tabcontent = '';

    static function smart_tabgroup($atts, $contents) {

        self::$tab_counter = 1;
        wp_enqueue_script(array('jquery-ui-tabs'), '', array('jquery','jquery-ui-core'));
        do_shortcode($contents);

        return "<dl class='tabs' data-tab>" . self::$tablink . "</dl><div class='tabs-content'>" . do_shortcode(self::$tabcontent) . "</div>";
    }

    static function smart_tab($atts, $contents) {

        extract(shortcode_atts(array(
            'title' => '',
            'unique' => 'true'
            ), $atts));

        $unique_tab = !empty($unique) && $unique == 'true' ? rand(0000, 9999) : self::$tab_counter;
        


        if (self::$tab_counter == 1):

            self::$tablink = "<dd class='active'><a href='#panel2-{$unique_tab}'>{$title}</a></dd>";

            self::$tabcontent = "<div id='panel2-{$unique_tab}' class='content active'><p>{$contents}</p></div>";

        else:

            self::$tablink .= "<dd><a href='#panel2-{$unique_tab}'>$title</a></dd>";

            self::$tabcontent .= "<div id='panel2-{$unique_tab}' class='content'><p>$contents</p></div>";

        endif;

        self::$tab_counter++;
    }

}

add_shortcode('tabgroup', array('SDS_UI_Tabs', 'smart_tabgroup'));

add_shortcode('tab', array('SDS_UI_Tabs', 'smart_tab'));



add_shortcode('oxy_product_cat','oxy_product_cat_cb');

function oxy_product_cat_cb($atts=array()){
    
    if(!function_exists('WC')) return false;
    
    $defaults = array(
        'show_icon' => 'true',
        'show_counter' => 'true',        
        'cats_per_row' => '4',
        'subcat_per_col' => '5',        
    );
    extract(shortcode_atts($defaults, $atts));
    
    $args = array('hide_empty'=>false,'parent'=>0);
    $taxonomy = 'product_cat';
    $terms = get_terms($taxonomy,$args);
    if(!empty($terms)){
        $content = '<section id="homepage-category-wall"><div class="box-category-home row">';
        $col_class = 'columns ';
        if(!empty($cats_per_row)){
            switch((int)$cats_per_row){
                case 5:
                    $col_class .= 'small-6 five-noc';
                    break;
                case 6:
                    $col_class .= 'large-2 medium-2 small-6';
                    break;
                default:
                    $col_class .= 'large-3 medium-3 small-6';
                    break;
            }
            
        }        
        foreach($terms as $term){
            $image = '';
            
            $content .= '<div class="'.$col_class.'">';
            $term_parent_link = get_term_link($term->slug,$taxonomy);
            $childterms = get_terms($taxonomy,array('parent'=>$term->term_id,'hide_empty'=>false, 'number' => (int)$subcat_per_col));
            
            if($show_icon == 'true'){
                
                $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
                if(!empty($thumbnail_id)){
                    $image = wp_get_attachment_image_src($thumbnail_id,'full');
                    $image = $image[0]; 
                }
                else $image = wc_placeholder_img_src();
                
                $content .= '<div class="image"><a href="'.$term_parent_link.'"><img alt="'.$term->name.'" title="'.$term->name.'" src="'.$image.'"></a></div>';
            }
            $content .= '<a href="'.$term_parent_link.'">'.$term->name.'"</a>';
            if(!empty($childterms)){
                $content .= '<div class="subcat"><ul>';
                foreach($childterms as $cterm){
                    
                    $pcount = $show_counter == 'true' ? " ({$cterm->count})" : '';                    
                    $term_link = get_term_link($cterm->slug,$taxonomy);
                    $content .= "<li><a href='{$term_link}'>{$cterm->name}{$pcount}</a></li>";
                }
                $content .= '</ul></div>';
            
                $content .= '<div class="all"><a href="'.$term_parent_link.'">'.__('More','oxy').'</a></div>';
            }
            
            $content .= '</div>';
        }
        $content .= '</div></section>';
    }
    
    
    return isset($content) ? $content : false;
    
}


function oxy_brand_general_markup($terms,$atts){
    
    $taxonomy = "brands";
    
    $per_row = $atts['per_row'];
    $design = $atts['design'];
    
    if(!empty($terms)){
       
       $col_class = 'columns ';
       $content = '<section id="homepage-brands-wall"><div class="box-manufacturers-home row">';
       switch((int)$per_row){
            case 5:
                $col_class .= 'small-6 five-noc';
                break;
            case 6:
                $col_class .= 'large-2 medium-2 small-6';
                break;
            default:
                $col_class .= 'large-3 medium-3 small-6';
                break;
           
       }
       
       foreach($terms as $term):
           $term_link = get_term_link($term,$taxonomy);
           
           $content .= "<div class='{$col_class}'>";
           
           switch((int) $design){
           
                case 2:                    
                    $content .= '<div class="name"><a href="'.$term_link.'">'.$term->name.'</a></div>';                    
                break;
                case 3:
                    $thumb_id = wcm_sds_brands_thumbnail_id($term->term_id);
                    if(!empty($thumb_id)){
                        $image = wp_get_attachment_image_src($thumb_id, 'full');
                        $image = $image[0];
                        $content .= '<div class="image"><a href="'.$term_link.'"><img alt="'.$term->name.'" title="'.$term->name.'" src="'.$image.'"></a></div>';
                    }
                    $content .= '<div class="name"><a href="'.$term_link.'">'.$term->name.'</a></div>';
                break;
                default:
                    $thumb_id = wcm_sds_brands_thumbnail_id($term->term_id);
                    if(!empty($thumb_id)){
                        $image = wp_get_attachment_image_src($thumb_id, 'full');
                        $image = $image[0];
                        $content .= '<div class="image"><a href="'.$term_link.'"><img alt="'.$term->name.'" title="'.$term->name.'" src="'.$image.'"></a></div>';
                    }
                    
                break;
           }
           $content .= '</div>';
       endforeach;
       $content .= '</div></section>';
       return $content;
   }
   return false;
}
function oxy_brand_carousel_markup($terms){
    
    $taxonomy = "brands";
    wp_enqueue_script('flexslider-min',SWPF_THEME_URI.'/js/jquery.flexslider-min.js',array('jquery'),'',true);		
    if(!empty($terms)){
       
       $content = '<div class="carousel-flex"><div class="carousel0 carousel"><ul class="slides">';
       
       foreach($terms as $term):
           $term_link = get_term_link($term,$taxonomy);
           
           $content .= "<li>";
                
            $thumb_id = wcm_sds_brands_thumbnail_id($term->term_id);
            if(!empty($thumb_id)){
                $image = wp_get_attachment_image_src($thumb_id, 'full');
                $image = $image[0];
                $content .= '<a href="'.$term_link.'"><img alt="'.$term->name.'" title="'.$term->name.'" src="'.$image.'"></a>';
            }
            
           $content .= '</li>';
       endforeach;
       $content .= '</ul></div></div>';
       return $content;
   }
   return false;
}


function oxy_product_brands_cb($atts = array()){
    
    if(!function_exists('WC') || !function_exists('wcm_sds_brands_thumbnail_id')) return false;
   
    $newatts = shortcode_atts(array(
        'design' => '1',//1 => logo , 2 -> name , 3 -> logo+name
        'per_row' => '4',
        'limit' => '12',
        'carousel' => 'true',
        'parent' => '0',
    ),$atts);
    
    extract($newatts);
   
    $taxonomy = "brands";
    $args = array('hide_empty' => false, 'number' => (int)$limit, 'parent' => (int)$parent);
    $terms = get_terms($taxonomy,$args);
    wp_enqueue_script('flexslider-min',SWPF_THEME_URI.'/js/jquery.flexslider-min.js',array('jquery'),'',true);
    if((bool)$carousel === true){        
        $content = oxy_brand_carousel_markup($terms);
    }
    else{
        $content = oxy_brand_general_markup($terms,$newatts);
    }
   
   
   return isset($content) ? $content : false;
}

add_shortcode('oxy_product_brands','oxy_product_brands_cb');

function productbanner_shortcode($atts, $content) {
    $content = '';
    $defaults = array(
        'interval' => '3000',
    );
    $atts = shortcode_atts($defaults, $atts);
    if(function_exists('sds_product_eislideshow_markup')){
        wp_enqueue_script('eislideshow',get_template_directory_uri().'/js/jquery.eislideshow.js',array('jquery'),'1.0',true);
        ob_start();
        sds_product_eislideshow_markup($atts);
        $content = ob_get_clean();
    }
    return $content;
}

add_shortcode('eiproductslider', 'productbanner_shortcode');



function flexslider_shortcode($atts, $content) {
    
    wp_enqueue_script('flexslider-min',SWPF_THEME_URI.'/js/jquery.flexslider-min.js',array('jquery'),'',true);
    
    $defaults = array(
        'class' => ' ',        
    );
    $id = 'flexslider-'.rand(000000,999999);
    
    extract(shortcode_atts($defaults, $atts));
    $class .= 'flexslider flexshortcode';
    return "<section id='$id' class=\"$class\">
		<ul class=\"slides\">" . do_shortcode(str_replace('<br />', '', $content)) . "</ul>
	</section>
	<script type='text/javascript'>
		jQuery(function($){
			$('#{$id}').flexslider({controlNav:false});	
		});
	</script>";
}

add_shortcode('flexslider', 'flexslider_shortcode');

function flextab_shortcode($atts, $content) {

    $defaults = array(
        'link' => '',
        'imageurl' => '#',
        'title' => 'title'
    );

    extract(shortcode_atts($defaults, $atts));

    ob_start();
    ?>
    <li>
    <?php if ($link) { ?>
            <a href="<?php echo $link; ?>"><img src="<?php echo $imageurl; ?>" alt="<?php echo $title; ?>" /></a>
    <?php } else { ?>
            <img src="<?php echo $imageurl; ?>" alt="<?php echo $title; ?>" />
    <?php } ?>
    </li> 

    <?php
    $output = ob_get_contents();

    ob_end_clean();

    return $output;
}

add_shortcode('ftab', 'flextab_shortcode');



function nivoslider_shortcode($atts, $content) {

    $defaults = array(
        'class' => ' ',        
    );
    extract(shortcode_atts($defaults, $atts));
    $id = 'nivoslider-'.rand(000000,999999);
    $class .= 'nivoSliderx';
    extract(shortcode_atts($defaults, $atts));
    
    wp_enqueue_script('nivoslider',get_template_directory_uri().'/js/jquery.nivo.slider.pack.js',array('jquery'),'1.0',true);
    
    return "<div class='slideshow'><div id='$id' class=\"$class\">" . do_shortcode(str_replace('<br />', '', $content)) . "</div></div>
	<script type='text/javascript'>
		jQuery(function($){
			$('#{$id}').nivoSliderx({controlNav:false});	
		});
	</script>";
}

add_shortcode('nivoslider', 'nivoslider_shortcode');

function nivotab_shortcode($atts, $content) {

    $defaults = array(
        'link' => '',
        'imageurl' => '#',
        'title' => 'title'
    );

    extract(shortcode_atts($defaults, $atts));

    ob_start();
     if ($link) { ?>
            <a href="<?php echo $link; ?>"><img src="<?php echo $imageurl; ?>" alt="<?php echo $title; ?>" /></a>
    <?php } else { ?>
            <img src="<?php echo $imageurl; ?>" alt="<?php echo $title; ?>" />
    <?php } 
    
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('ntab', 'nivotab_shortcode');


function cameraslider_shortcode($atts, $content) {

    $defaults = array(
        'class' => ' ',
        'id' => 'camera_wrap_'.rand(000000,999999)
    );
    extract(shortcode_atts($defaults, $atts));
    $class = 'camera_wrap camera_azure_skin';
    
    wp_enqueue_script('camera', get_template_directory_uri() . '/js/camera.js', array('jquery'), '', true);
    return "<section class='fluid_container slider-pull-left'><div id='{$id}' class='{$class}'>" . do_shortcode(str_replace('<br />', '', $content)) . "</div></section>
	<script type='text/javascript'>
		jQuery(function($){			
                        $('#{$id}').camera({
				thumbnails: true,
				loader: true,
				hover: false
			});	
		});
	</script>";
}

add_shortcode('cameraslider', 'cameraslider_shortcode');

function camtab_shortcode($atts, $content) {

    $defaults = array(
        'link' => '',
        'imageurl' => get_template_directory_uri() . '/image/responsive.png',
    );

    extract(shortcode_atts($defaults, $atts));

    ob_start();
    ?>
    <div data-link="<?php echo $link; ?>" data-thumb="<?php echo $imageurl; ?>" data-src="<?php echo $imageurl; ?>"></div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('ctab', 'camtab_shortcode');


add_shortcode('oxy_products_slider','oxy_products_slider_cb');

function oxy_products_slider_cb($atts = array()){
    wp_enqueue_script('flexslider-min',SWPF_THEME_URI.'/js/jquery.flexslider-min.js',array('jquery'),'',true);
    $vars = shortcode_atts(array(
        'type' => 'recent_products',
        'ids' => '',
        'skus' => '',        
        'title' => 'Recent Products',
        'per_page' => '12',
        'columns' => '6',
        'orderby' => 'date',
        'order' => 'desc',        
    ), $atts);
    
    if(!empty($vars)){
        
        $excluded = array('type','title');        
        $content = '<div class="product-box-slider">';
        $content .= '<div class="box-heading">'.$vars['title'].'</div>';
        $counter = 0;
        $rand = rand(0000,9999);
        $content .= '<div id="products_slider_'.$rand.'" class="product-box-slider-flexslider">';
        $ws = '['.$vars['type'].' ';
        
        foreach($vars as $k => $v){            
            if(empty($v) or in_array($k, $excluded)) continue;
            
            if($counter++ > 0){
                $ws .= ' ';
            }
            $ws .= "{$k}='{$v}'";
            
        }
        $ws .= ']';
        $content .= do_shortcode($ws);
        $content .= '</div></div>';
        $content .= "<script type='text/javascript'>
            jQuery(function(\$) {
                var main = \$('#products_slider_{$rand} > .woocommerce');
                var wd = main.find('ul.products li:first-child').width();
                
                main.flexslider({
                    animation: \"slide\",
                    animationLoop: false,
                    slideshow: false,
                    controlNav: false,
                    itemWidth: wd,
                    maxItems: ".$vars['columns'].",
                    minItems: 1,
                    selector: 'ul.products > li',
                });
            });
            </script>";
        
        $contents = do_shortcode($content);        
        return $contents;
    }
    return false;
    
}



function remove_li_shortcode_directives($content) {
    $content = preg_replace('/\]/', '>', preg_replace('/\[/', '<', $content));

    return $content;
}

function shortcode_list_disc($atts, $content = null) {
    return '<ul class="disc" >' . remove_li_shortcode_directives($content) . '</ul>';
}
add_shortcode('list_disc', 'shortcode_list_disc');

function shortcode_list_circle($atts, $content = null) {
    return '<ul class="circle" >' . remove_li_shortcode_directives($content) . '</ul>';
}
add_shortcode('list_circle', 'shortcode_list_circle');

function shortcode_list_square($atts, $content = null) {
    return '<ul class="square" >' . remove_li_shortcode_directives($content) . '</ul>';
}
add_shortcode('list_square', 'shortcode_list_square');

function shortcode_list_no_bullet($atts, $content = null) {
    return '<ul class="no-bullet" >' . remove_li_shortcode_directives($content) . '</ul>';
}
add_shortcode('list_no-bullet', 'shortcode_list_no_bullet');

function shortcode_list_ol($atts, $content = null) {
    return '<ol>' . remove_li_shortcode_directives($content) . '</ol>';
}
add_shortcode('list_ol', 'shortcode_list_ol');

