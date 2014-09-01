<?php
/**
 * @package Sellya
 * @subpackage Sellya
 */
define('SWPF_FREAMWORK_DIRECTORY', 'swpf');
define('SWPF_THEME_URI', get_template_directory_uri());


require_once("oxy-admin/index.php");
require_once("swpf/oxy_theme_customizer.php");
require_once("swpf/widgets/oxy-social-media-widget.php");
require_once("swpf/widgets/oxy-related-products-widget.php");
require_once("swpf/widgets/swpf-address-info-widget.php");
require_once("swpf/widgets/swpf-product-shipping-info-widget.php");
require_once("swpf/widgets/swpf-brands-widget.php");
require_once("swpf/ctp/sds_wcm_brands.php");
require_once("swpf/nav_menu_walker.php");
require_once("swpf/post-format-settings.php");
require_once("swpf/productslider.class.php");
require_once("swpf/sliders.php");
require_once("swpf/header-area.php");
require_once("swpf/class-tgm-plugin-activation.php");
require_once("swpf/class-search-autocomplete.php");
require_once("swpf/widgets/oxy-product-brand-logo-widget.php");

/* Remove unwanted actions */


/* Remove Add to cart button and quantity from single product and from whole wp site */

function oxy_wcm_init(){
    global $woocommerce,$smof_data;
    if(!isset($woocommerce)) 
        return;
    
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    
    add_action('woocommerce_before_shop_loop','hook_oxy_grid_list_trigger',11);
    
    add_action( 'sds_wc_product_title', 'woocommerce_template_single_title' );
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );    
    add_action( 'oxy_product_sale_icon', 'woocommerce_show_product_sale_flash' );
    
    add_action( 'woocommerce_before_shop_loop_item_title', 'oxy_template_loop_product_thumbnail', 9 );
    add_action( 'wp_footer', 'oxy_template_loop_product_thumbnail_script', 100 );
    
    add_action('woocommerce_single_product_summary','hook_oxy_send_to_friend',31);
    add_action('woocommerce_single_product_summary','hook_oxy_product_social_share',100);
    
    if(isset($smof_data->oxy_general_settings) && $smof_data->oxy_general_settings['oxy_category_sale_badge_status'] != 1)
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
    
    if(isset($smof_data->oxy_general_settings) && $smof_data->oxy_general_settings['oxy_category_prod_price_status'] != 1)
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    
    if(isset($smof_data->oxy_general_settings) && $smof_data->oxy_general_settings['oxy_category_prod_cart_button_status'] != 1)
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    
    if(isset($smof_data->oxy_general_settings) && $smof_data->oxy_general_settings['oxy_category_prod_ratings_status'] != 1)
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    
    if(isset($smof_data->oxy_general_settings) && $smof_data->oxy_general_settings['oxy_enable_shop'] != 1){
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
    
}

add_action('init','oxy_wcm_init');

function hook_oxy_grid_list_trigger(){
    ?>
    <div class="display">
        <span><?php _e('Display:', 'oxy') ?></span>&nbsp;
        <a class="list-trigger">
            <img src="<?php echo get_template_directory_uri(); ?>/image/icon_list.png" alt="List" title="List" />
        </a>
        <a class="grid-trigger">
            <img src="<?php echo get_template_directory_uri(); ?>/image/icon_grid.png" alt="Grid" title="Grid" />
        </a>
    </div>
    <?php
    
}

function hook_oxy_send_to_friend(){
    global $post,$product;
    if(class_exists('YITH_Woocompare_Frontend')){
        $oxy_yith_cmp = new YITH_Woocompare_Frontend;
    ?>
        <div class="prod-compare"><a class="compare" data-product_id="<?php echo $product->id?>" href="<?php echo $oxy_yith_cmp->add_product_url( $product->id )?>"><span></span><?php _e('Add to Compare','oxy')?></a></div>
    <?php }?>
    <div class="prod-friend">
        <a href="mailto:enterfriend@addresshere.com?subject=<?php echo $post->post_title?>&body=<?php echo $post->post_title?>: <?php echo get_permalink($post->ID)?>">
            <span class="friend"></span><?php _e('Send to a friend','oxy');?>
        </a>
    </div>
    <?php
}
function hook_oxy_product_social_share(){
    ?>
    <div class="product-share">       
        <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_preferred_1"></a>
            <a class="addthis_button_preferred_2"></a>
            <a class="addthis_button_preferred_3"></a>
            <a class="addthis_button_preferred_4"></a>
            <a class="addthis_button_preferred_5"></a>
            <a class="addthis_button_preferred_6"></a>
            <a class="addthis_button_preferred_7"></a>
            <a class="addthis_button_preferred_8"></a>
            <a class="addthis_button_compact"></a>
        </div>
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js"></script>    
    </div>
    <?php
    
}
/* end add/remove actions */

add_filter('widget_text','do_shortcode',11);


add_shortcode('oxy_theme_url',  create_function('', "return get_template_directory_uri();"));




add_action( 'init', 'oxy_load_color_schema' ); //insert color scheme code

function oxy_load_color_schema(){
    
    $colordata = get_option('oxy_color_settings');
    
    if(empty($colordata)){        
        $colordata = "YToxNTE6e3M6MTc6Im94eV9ib2R5X2JnX2NvbG9yIjtzOjc6IiNGNkY2RjYiO3M6MTg6Im94eV9oZWFkaW5nc19jb2xvciI7czo3OiIjNDY0NjQ2IjtzOjE5OiJveHlfYm9keV90ZXh0X2NvbG9yIjtzOjc6IiM0NjQ2NDYiO3M6MjA6Im94eV9saWdodF90ZXh0X2NvbG9yIjtzOjc6IiNCNkI2QjYiO3M6MjE6Im94eV9vdGhlcl9saW5rc19jb2xvciI7czo3OiIjNEJCOEUyIjtzOjIxOiJveHlfbGlua3NfaG92ZXJfY29sb3IiO3M6NzoiI0VENTA1MyI7czoyNDoib3h5X21haW5fY29sdW1uX2JnX2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6Mjg6Im94eV9tYWluX2NvbHVtbl9ib3JkZXJfY29sb3IiO3M6NzoiI0NDQ0NDQyI7czozMToib3h5X2NvbnRlbnRfY29sdW1uX2hsaV9iZ19jb2xvciI7czo3OiIjRjZGNkY2IjtzOjM2OiJveHlfY29udGVudF9jb2x1bW5faGVhZF9ib3JkZXJfY29sb3IiO3M6NzoiI0VBRUFFQSI7czozNDoib3h5X2NvbnRlbnRfY29sdW1uX3NlcGFyYXRvcl9jb2xvciI7czo3OiIjRUFFQUVBIjtzOjI5OiJveHlfbGVmdF9jb2x1bW5faGVhZF9iZ19jb2xvciI7czo3OiIjNEJCOEUyIjtzOjMyOiJveHlfbGVmdF9jb2x1bW5faGVhZF90aXRsZV9jb2xvciI7czo3OiIjRkZGRkZGIjtzOjMzOiJveHlfbGVmdF9jb2x1bW5faGVhZF9ib3JkZXJfY29sb3IiO3M6NzoiI0VBRUFFQSI7czoyODoib3h5X2xlZnRfY29sdW1uX2JveF9iZ19jb2xvciI7czo3OiIjRjZGNkY2IjtzOjMxOiJveHlfbGVmdF9jb2x1bW5fYm94X2xpbmtzX2NvbG9yIjtzOjc6IiM0NjQ2NDYiO3M6Mzc6Im94eV9sZWZ0X2NvbHVtbl9ib3hfbGlua3NfY29sb3JfaG92ZXIiO3M6NzoiI0VENTA1MyI7czozMDoib3h5X3JpZ2h0X2NvbHVtbl9oZWFkX2JnX2NvbG9yIjtzOjc6IiM0QkI4RTIiO3M6MzM6Im94eV9yaWdodF9jb2x1bW5faGVhZF90aXRsZV9jb2xvciI7czo3OiIjRkZGRkZGIjtzOjM0OiJveHlfcmlnaHRfY29sdW1uX2hlYWRfYm9yZGVyX2NvbG9yIjtzOjc6IiNFQUVBRUEiO3M6Mjk6Im94eV9yaWdodF9jb2x1bW5fYm94X2JnX2NvbG9yIjtzOjc6IiNGNkY2RjYiO3M6MzI6Im94eV9yaWdodF9jb2x1bW5fYm94X2xpbmtzX2NvbG9yIjtzOjc6IiM0NjQ2NDYiO3M6Mzg6Im94eV9yaWdodF9jb2x1bW5fYm94X2xpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiNFRDUwNTMiO3M6MzA6Im94eV9jYXRlZ29yeV9ib3hfaGVhZF9iZ19jb2xvciI7czo3OiIjRUQ1MDUzIjtzOjMzOiJveHlfY2F0ZWdvcnlfYm94X2hlYWRfdGl0bGVfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czozNDoib3h5X2NhdGVnb3J5X2JveF9oZWFkX2JvcmRlcl9jb2xvciI7czo3OiIjRUFFQUVBIjtzOjI5OiJveHlfY2F0ZWdvcnlfYm94X2JveF9iZ19jb2xvciI7czo3OiIjRjZGNkY2IjtzOjM1OiJveHlfY2F0ZWdvcnlfYm94X2JveF9iZ19jb2xvcl9ob3ZlciI7czo3OiIjRjBGMEYwIjtzOjMyOiJveHlfY2F0ZWdvcnlfYm94X2JveF9saW5rc19jb2xvciI7czo3OiIjNDY0NjQ2IjtzOjM4OiJveHlfY2F0ZWdvcnlfYm94X2JveF9saW5rc19jb2xvcl9ob3ZlciI7czo3OiIjNEJCOEUyIjtzOjM2OiJveHlfY2F0ZWdvcnlfYm94X2JveF9zZXBhcmF0b3JfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyODoib3h5X2ZpbHRlcl9ib3hfaGVhZF9iZ19jb2xvciI7czo3OiIjNDI0MjQyIjtzOjMxOiJveHlfZmlsdGVyX2JveF9oZWFkX3RpdGxlX2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6MzI6Im94eV9maWx0ZXJfYm94X2hlYWRfYm9yZGVyX2NvbG9yIjtzOjc6IiNFQUVBRUEiO3M6Mjc6Im94eV9maWx0ZXJfYm94X2JveF9iZ19jb2xvciI7czo3OiIjRjZGNkY2IjtzOjMwOiJveHlfZmlsdGVyX2JveF9ib3hfbGlua3NfY29sb3IiO3M6NzoiIzQ2NDY0NiI7czozNjoib3h5X2ZpbHRlcl9ib3hfYm94X2xpbmtzX2NvbG9yX2hvdmVyIjtzOjc6IiNFRDUwNTMiO3M6MTU6Im94eV9wcmljZV9jb2xvciI7czo3OiIjNEJCOEUyIjtzOjE5OiJveHlfcHJpY2Vfb2xkX2NvbG9yIjtzOjc6IiNCNkI2QjYiO3M6MTk6Im94eV9wcmljZV9uZXdfY29sb3IiO3M6NzoiI0VENTA1MyI7czoxOToib3h5X3ByaWNlX3RheF9jb2xvciI7czo3OiIjQjZCNkI2IjtzOjE5OiJveHlfYnV0dG9uX2JnX2NvbG9yIjtzOjc6IiM0QkI4RTIiO3M6MjU6Im94eV9idXR0b25fYmdfaG92ZXJfY29sb3IiO3M6NzoiI0VENTA1MyI7czoyMToib3h5X2J1dHRvbl90ZXh0X2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6Mjc6Im94eV9idXR0b25fdGV4dF9ob3Zlcl9jb2xvciI7czo3OiIjRkZGRkZGIjtzOjI5OiJveHlfYnV0dG9uX2V4Y2x1c2l2ZV9iZ19jb2xvciI7czo3OiIjRUQ1MDUzIjtzOjM1OiJveHlfYnV0dG9uX2V4Y2x1c2l2ZV9iZ19ob3Zlcl9jb2xvciI7czo3OiIjNEJCOEUyIjtzOjMxOiJveHlfYnV0dG9uX2V4Y2x1c2l2ZV90ZXh0X2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6Mzc6Im94eV9idXR0b25fZXhjbHVzaXZlX3RleHRfaG92ZXJfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyNToib3h5X2J1dHRvbl9saWdodF9iZ19jb2xvciI7czo3OiIjRUZFRkVGIjtzOjMxOiJveHlfYnV0dG9uX2xpZ2h0X2JnX2hvdmVyX2NvbG9yIjtzOjc6IiM0QkI4RTIiO3M6Mjc6Im94eV9idXR0b25fbGlnaHRfdGV4dF9jb2xvciI7czo3OiIjNDY0NjQ2IjtzOjMzOiJveHlfYnV0dG9uX2xpZ2h0X3RleHRfaG92ZXJfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyNjoib3h5X2J1dHRvbl9zbGlkZXJfYmdfY29sb3IiO3M6NzoiI0VFRUVFRSI7czozMjoib3h5X2J1dHRvbl9zbGlkZXJfYmdfaG92ZXJfY29sb3IiO3M6NzoiIzRCQjhFMiI7czoyMToib3h5X3RvcF9hcmVhX2JnX2NvbG9yIjtzOjc6IiNGOEY4RjgiO3M6MjY6Im94eV90b3BfYXJlYV9taW5pX2JnX2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6MjQ6Im94eV90b3BfYXJlYV90Yl9iZ19jb2xvciI7czo3OiIjNDI0MjQyIjtzOjMyOiJveHlfdG9wX2FyZWFfdGJfdG9wX2JvcmRlcl9jb2xvciI7czo3OiIjNEJCOEUyIjtzOjM1OiJveHlfdG9wX2FyZWFfdGJfYm90dG9tX2JvcmRlcl9jb2xvciI7czo3OiIjNTI1MjUyIjtzOjI2OiJveHlfdG9wX2FyZWFfdGJfdGV4dF9jb2xvciI7czo3OiIjQ0NDQ0NDIjtzOjI2OiJveHlfdG9wX2FyZWFfdGJfbGlua19jb2xvciI7czo3OiIjY2NjY2NjIjtzOjMyOiJveHlfdG9wX2FyZWFfdGJfbGlua19jb2xvcl9ob3ZlciI7czo3OiIjZmZmZmZmIjtzOjI5OiJveHlfdG9wX2FyZWFfdGJfbGlua19iZ19ob3ZlciI7czo3OiIjNEJCOEUyIjtzOjMxOiJveHlfdG9wX2FyZWFfdGJfc2VwYXJhdG9yX2NvbG9yIjtzOjc6IiM1MjUyNTIiO3M6MzM6Im94eV90b3BfYXJlYV90Yl9kcm9wZG93bl9iZ19jb2xvciI7czo3OiIjRkZGRkZGIjtzOjM5OiJveHlfdG9wX2FyZWFfdGJfZHJvcGRvd25fYmdfY29sb3JfaG92ZXIiO3M6NzoiIzRCQjhFMiI7czozNToib3h5X3RvcF9hcmVhX3RiX2Ryb3Bkb3duX2xpbmtfY29sb3IiO3M6NzoiIzQ2NDY0NiI7czo0MToib3h5X3RvcF9hcmVhX3RiX2Ryb3Bkb3duX2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI0ZGRkZGRiI7czoyODoib3h5X3RvcF9hcmVhX3NlYXJjaF9iZ19jb2xvciI7czo3OiIjRjNGM0YzIjtzOjMyOiJveHlfdG9wX2FyZWFfc2VhcmNoX2JvcmRlcl9jb2xvciI7czo3OiIjREZERkRGIjtzOjM4OiJveHlfdG9wX2FyZWFfc2VhcmNoX2JvcmRlcl9jb2xvcl9ob3ZlciI7czo3OiIjQ0NDQ0NDIjtzOjMwOiJveHlfdG9wX2FyZWFfc2VhcmNoX3RleHRfY29sb3IiO3M6NzoiIzQ2NDY0NiI7czoyODoib3h5X3RvcF9hcmVhX2NhcnRfdGV4dF9jb2xvciI7czo3OiIjQjZCNkI2IjtzOjI4OiJveHlfdG9wX2FyZWFfY2FydF9saW5rX2NvbG9yIjtzOjc6IiM0QkI4RTIiO3M6MzQ6Im94eV90b3BfYXJlYV9jYXJ0X2xpbmtfY29sb3JfaG92ZXIiO3M6NzoiI0VENTA1MyI7czozMzoib3h5X3RvcF9hcmVhX2NhcnRfc2VwYXJhdG9yX2NvbG9yIjtzOjc6IiNFREVERUQiO3M6MTU6Im94eV9tbV9iZ19jb2xvciI7czo3OiIjNDI0MjQyIjtzOjIyOiJveHlfbW1fc2VwYXJhdG9yX2NvbG9yIjtzOjc6IiM0RjRGNEYiO3M6MjM6Im94eV9tbV9ib3JkZXJfdG9wX2NvbG9yIjtzOjc6IiNFRUVFRUUiO3M6MjY6Im94eV9tbV9ib3JkZXJfYm90dG9tX2NvbG9yIjtzOjc6IiNFRUVFRUUiO3M6MTY6Im94eV9tbTFfYmdfY29sb3IiO3M6NzoiIzQyNDI0MiI7czoyMjoib3h5X21tMV9iZ19ob3Zlcl9jb2xvciI7czo3OiIjNEJCOEUyIjtzOjE4OiJveHlfbW0xX2xpbmtfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyNDoib3h5X21tMV9saW5rX2hvdmVyX2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6MTY6Im94eV9tbTdfYmdfY29sb3IiO3M6NzoiIzQyNDI0MiI7czoyMjoib3h5X21tN19iZ19ob3Zlcl9jb2xvciI7czo3OiIjNEJCOEUyIjtzOjE4OiJveHlfbW03X2xpbmtfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyNDoib3h5X21tN19saW5rX2hvdmVyX2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6MTk6Im94eV9tbV9zdWJfYmdfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyNToib3h5X21tX3N1Yl9iZ19ob3Zlcl9jb2xvciI7czo3OiIjNEJCOEUyIjtzOjI2OiJveHlfbW1fc3ViX3RpdGxlc19iZ19jb2xvciI7czo3OiIjRjVGNUY1IjtzOjIxOiJveHlfbW1fc3ViX3RleHRfY29sb3IiO3M6NzoiIzQ2NDY0NiI7czoyMToib3h5X21tX3N1Yl9saW5rX2NvbG9yIjtzOjc6IiM0NjQ2NDYiO3M6Mjc6Im94eV9tbV9zdWJfbGlua19ob3Zlcl9jb2xvciI7czo3OiIjRkZGRkZGIjtzOjI2OiJveHlfbW1fc3ViX3NlcGFyYXRvcl9jb2xvciI7czo3OiIjRjFGMUYxIjtzOjIyOiJveHlfbW1fbW9iaWxlX2JnX2NvbG9yIjtzOjc6IiM0MjQyNDIiO3M6Mjg6Im94eV9tbV9tb2JpbGVfYmdfaG92ZXJfY29sb3IiO3M6NzoiI0VENTA1MyI7czoyNDoib3h5X21tX21vYmlsZV90ZXh0X2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6MzE6Im94eV9taWRfcHJvZF9ib3hfYmdfaG92ZXJfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyNDoib3h5X21pZF9wcm9kX3N0YXJzX2NvbG9yIjtzOjc6IiM0QkI4RTIiO3M6MzI6Im94eV9taWRfcHJvZF9ib3hfc2FsZV9pY29uX2NvbG9yIjtzOjc6IiNFRDUwNTMiO3M6MzE6Im94eV9taWRfcHJvZF9wYWdlX3RhYnNfYmdfY29sb3IiO3M6NzoiIzQyNDI0MiI7czo0MDoib3h5X21pZF9wcm9kX3BhZ2VfdGFic19zZWxlY3RlZF9iZ19jb2xvciI7czo3OiIjNEJCOEUyIjtzOjMzOiJveHlfbWlkX3Byb2RfcGFnZV90YWJzX3RleHRfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyODoib3h5X21pZF9wcm9kX3NsaWRlcl9iZ19jb2xvciI7czo3OiIjRkZGRkZGIjtzOjMwOiJveHlfbWlkX3Byb2Rfc2xpZGVyX25hbWVfY29sb3IiO3M6NzoiIzQ2NDY0NiI7czozMDoib3h5X21pZF9wcm9kX3NsaWRlcl9kZXNjX2NvbG9yIjtzOjc6IiNBM0EzQTMiO3M6MzE6Im94eV9taWRfcHJvZF9zbGlkZXJfcHJpY2VfY29sb3IiO3M6NzoiI0VENTA1MyI7czozNzoib3h5X21pZF9wcm9kX3NsaWRlcl9saW5rc19jb2xvcl9ob3ZlciI7czo3OiIjNEJCOEUyIjtzOjM5OiJveHlfbWlkX3Byb2Rfc2xpZGVyX2JvdHRvbV9iYXJfYmdfY29sb3IiO3M6NzoiI0U4RThFOCI7czo0NToib3h5X21pZF9wcm9kX3NsaWRlcl9ib3R0b21fYmFyX2JnX2NvbG9yX2hvdmVyIjtzOjc6IiNFRDUwNTMiO3M6NDY6Im94eV9taWRfcHJvZF9zbGlkZXJfYm90dG9tX2Jhcl9iZ19jb2xvcl9hY3RpdmUiO3M6NzoiIzRCQjhFMiI7czoxNToib3h5X2ZwX2JnX2NvbG9yIjtzOjc6IiNGNkY2RjYiO3M6MTg6Im94eV9mcF90aXRsZV9jb2xvciI7czo3OiIjNDY0NjQ2IjtzOjI0OiJveHlfZnBfdGl0bGVfY29sb3JfaG92ZXIiO3M6NzoiI0VENTA1MyI7czoyMToib3h5X2ZwX3N1YnRpdGxlX2NvbG9yIjtzOjc6IiNCNkI2QjYiO3M6MTk6Im94eV9mcF9mYjFfYmdfY29sb3IiO3M6NzoiIzRCQjhFMiI7czoyNToib3h5X2ZwX2ZiMV9iZ19jb2xvcl9ob3ZlciI7czo3OiIjNEJCOEUyIjtzOjE5OiJveHlfZnBfZmIyX2JnX2NvbG9yIjtzOjc6IiNFRDUwNTMiO3M6MjU6Im94eV9mcF9mYjJfYmdfY29sb3JfaG92ZXIiO3M6NzoiI0VENTA1MyI7czoxOToib3h5X2ZwX2ZiM19iZ19jb2xvciI7czo3OiIjRkZDQTAwIjtzOjI1OiJveHlfZnBfZmIzX2JnX2NvbG9yX2hvdmVyIjtzOjc6IiNGRkNBMDAiO3M6MTk6Im94eV9mcF9mYjRfYmdfY29sb3IiO3M6NzoiIzlBRTI0QiI7czoyNToib3h5X2ZwX2ZiNF9iZ19jb2xvcl9ob3ZlciI7czo3OiIjOUFFMjRCIjtzOjE1OiJveHlfZjFfYmdfY29sb3IiO3M6NzoiIzM3MzczNyI7czoxOToib3h5X2YxX3RpdGxlc19jb2xvciI7czo3OiIjRkZGRkZGIjtzOjMzOiJveHlfZjFfdGl0bGVzX2JvcmRlcl9ib3R0b21fY29sb3IiO3M6NzoiIzQ2NDY0NiI7czoxNzoib3h5X2YxX3RleHRfY29sb3IiO3M6NzoiIzhDOEM4QyI7czoxNzoib3h5X2YxX2xpbmtfY29sb3IiO3M6NzoiIzRCQjhFMiI7czoyMzoib3h5X2YxX2xpbmtfaG92ZXJfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoxNzoib3h5X2YxX2ljb25fY29sb3IiO3M6NzoiIzUyNTI1MiI7czoyMzoib3h5X2YxX2JvcmRlcl90b3BfY29sb3IiO3M6NzoiIzAwMDAwMCI7czoxNToib3h5X2YyX2JnX2NvbG9yIjtzOjc6IiMyRjJGMkYiO3M6MTk6Im94eV9mMl90aXRsZXNfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czozMzoib3h5X2YyX3RpdGxlc19ib3JkZXJfYm90dG9tX2NvbG9yIjtzOjc6IiM0NjQ2NDYiO3M6MTc6Im94eV9mMl9saW5rX2NvbG9yIjtzOjc6IiM4QzhDOEMiO3M6MjM6Im94eV9mMl9saW5rX2hvdmVyX2NvbG9yIjtzOjc6IiNGRkZGRkYiO3M6MjM6Im94eV9mMl9ib3JkZXJfdG9wX2NvbG9yIjtzOjc6IiM0NjQ2NDYiO3M6MTU6Im94eV9mNF9iZ19jb2xvciI7czo3OiIjMkYyRjJGIjtzOjE3OiJveHlfZjRfdGV4dF9jb2xvciI7czo3OiIjOEM4QzhDIjtzOjE3OiJveHlfZjRfbGlua19jb2xvciI7czo3OiIjNEJCOEUyIjtzOjIzOiJveHlfZjRfbGlua19ob3Zlcl9jb2xvciI7czo3OiIjRkZGRkZGIjtzOjIzOiJveHlfZjRfYm9yZGVyX3RvcF9jb2xvciI7czo3OiIjNDY0NjQ2IjtzOjE1OiJveHlfZjVfYmdfY29sb3IiO3M6NzoiIzJGMkYyRiI7czoxNzoib3h5X2Y1X3RleHRfY29sb3IiO3M6NzoiIzhDOEM4QyI7czoxNzoib3h5X2Y1X2xpbmtfY29sb3IiO3M6NzoiIzRCQjhFMiI7czoyMzoib3h5X2Y1X2xpbmtfaG92ZXJfY29sb3IiO3M6NzoiI0ZGRkZGRiI7czoyMzoib3h5X2Y1X2JvcmRlcl90b3BfY29sb3IiO3M6NzoiIzQ2NDY0NiI7czoxNjoib3h5X3ZpZGVvX2JveF9iZyI7czo3OiIjRUQ1MDUzIjtzOjE3OiJveHlfY3VzdG9tX2JveF9iZyI7czo3OiIjRkZDQTAwIjt9";
        update_option('oxy_color_settings',unserialize(base64_decode($colordata)));
    }
    
}
add_action( 'init', 'custom_fix_thumbnail' ); //change woocommerce placeholder image
 
function custom_fix_thumbnail() {
  add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
   
    function custom_woocommerce_placeholder_img_src( $src ) {
        
        $src = SWPF_THEME_URI . '/image/no_image.png';
        return $src;
    }
}



function oxy_template_loop_product_thumbnail(){
    global $product, $smof_data;
    if(!function_exists('WC') || empty($product) || $smof_data->oxy_general_settings['oxy_category_prod_swap_status'] != 1) return;
    
    $attachment_ids = $product->get_gallery_attachment_ids();
    if(isset($attachment_ids[0])&& !empty($attachment_ids[0])){        
        $secondary_image = wp_get_attachment_image_src($attachment_ids[0], array(400,400));
        $secondary_image = $secondary_image[0];
    }
    ?>
    <?php if (isset($secondary_image) && !empty($secondary_image)) { ?>        
        <input type="hidden" class="secondary_product_image_src" value="<?php echo $secondary_image; ?>">        
<?php
    }
    
}
function oxy_template_loop_product_thumbnail_script(){
    global $product, $smof_data;
    if(!function_exists('WC')) return;
    
    if ($smof_data->oxy_general_settings['oxy_category_prod_swap_status'] == 1) { ?>        
        <script type="text/javascript">
            jQuery(function($){
                
                $('.woocommerce ul.products li .image').each(function(){
                    var elem = $(this).find('img.attachment-shop_catalog');
                    var oversrc = $(this).find('input.secondary_product_image_src').val();
                    $(this).find('input.secondary_product_image_src').remove();
                    elem.attr('origsrc',elem.attr('src'));
                    elem.attr('oversrc',oversrc);   
                });

                $(document.body).on('mouseenter','#content .product-grid ul.products li .image, .product-box-slider-flexslider ul.products li .image',function(){
                    var elem = $(this).find('img.attachment-shop_catalog');
                    var oversrc = elem.attr('oversrc');                        
                    elem.attr('src',oversrc);                           
                });

                $(document.body).on('mouseleave','#content .product-grid ul.products li .image, .product-box-slider-flexslider ul.products li .image',function(){
                    var elem = $(this).find('img.attachment-shop_catalog');
                    var origsrc = elem.attr('origsrc');
                    elem.attr('src',origsrc);
                });                  
               
                
            });
        </script>        
<?php
    }
    
}

/*
 * Page Meta box
 * 
 * 
 */
function oxy_reg_page_meta_box() {
    $screens = array('page');
    foreach ($screens as $screen) {        
        add_meta_box(
                'oxy_page_layout_meta_box', __('Page Layout', 'oxy'), 'oxy_page_layout_meta_box_cb', $screen, 'normal', 'core'
        );
    }
}



add_action('add_meta_boxes', 'oxy_reg_page_meta_box');

function oxy_page_layout_meta_box_cb($post) {
    $saved_page_layout = get_post_meta($post->ID, 'oxy_page_layout', true);
    $show_page_title = get_post_meta($post->ID, 'oxy_show_page_title', true);
    $show_breadcrumb = get_post_meta($post->ID, 'oxy_show_breadcrumb', true);
    
    if(empty($saved_page_layout) || !is_numeric((int)$show_page_title)){
        $saved_page_layout = 1;
    }
    
    $page_layouts = array(
        1 => SWPF_THEME_URI.'/image/oxy_col/category-layout-1.png',
        2 => SWPF_THEME_URI.'/image/oxy_col/category-layout-2.png',
        3 => SWPF_THEME_URI.'/image/oxy_col/category-layout-3.png',
        4 => SWPF_THEME_URI.'/image/oxy_col/category-layout-4.png',
    );  
    ?>
        <style type="text/css">
            input.of-radio-img-radio{display: none;}
            .tile_img_wrap{
                display: block;                
            }
            .tile_img_wrap > span > img{
                float: left;
                margin:0 5px 10px 0;
            }
            .tile_img_wrap > span > img:hover{
                cursor: pointer;
            }            
            .tile_img_wrap img.of-radio-img-selected{
                border: 3px solid #CCCCCC;
            }
            
        </style>
        
    <?php
    echo "<input type='hidden' name='oxy_page_layout_verifier' value='".wp_create_nonce('oxy_7a81jjde')."' />";    
    $output = '<div class="tile_img_wrap">';
        foreach ($page_layouts as $key => $img) {
            $checked = '';
            $selectedClass = '';
            if($saved_page_layout == $key){
                $checked = 'checked="checked"';
                $selectedClass = 'of-radio-img-selected';
            }
            $output .= '<span>';
            $output .= '<input type="radio" class="checkbox of-radio-img-radio" value="' . $key . '" name="oxy_page_layout" ' . $checked . ' />';            
            $output .= '<img src="' . $img . '" alt="" class="of-radio-img-img ' . $selectedClass . '" />';
            $output .= '</span>';
                  
        }    
    $output .= '</div>';
    echo $output;
    ?>
        
        <script type="text/javascript">
        jQuery(function($){            
            $(document.body).on('click','.of-radio-img-img',function(){
                $(this).parents('.tile_img_wrap').find('.of-radio-img-img').removeClass('of-radio-img-selected');
                $(this).parent().find('.of-radio-img-radio').attr('checked','checked');
                $(this).addClass('of-radio-img-selected');
            });            
	});
        
        </script>    
        
        
    <h2>Show page title</h2>
    <p><input type="radio" name="oxy_show_page_title" value="1" <?php 
        echo "checked='checked'";
     ?> /><label>Yes</label>&nbsp;<input type="radio" name="oxy_show_page_title" value="0" <?php if($show_page_title === '0'){
        echo "checked='checked'";
    } ?> /><label>No</label></p>
    
    <h2>Show breadcrumb</h2>
    <p><input type="radio" name="oxy_show_breadcrumb" value="1" <?php 
        echo "checked='checked'";
     ?> /><label>Yes</label>&nbsp;<input type="radio" name="oxy_show_breadcrumb" value="0" <?php if($show_breadcrumb === '0'){
        echo "checked='checked'";
    } ?> /><label>No</label></p>
    
    <?php
    
    
}
add_action('save_post', 'save_oxy_page_layout_meta_box_values');

function save_oxy_page_layout_meta_box_values($post_id){
    if (!isset($_POST['oxy_page_layout_verifier']) 
            || !wp_verify_nonce($_POST['oxy_page_layout_verifier'], 'oxy_7a81jjde') 
            || !isset($_POST['oxy_page_layout']) 
            || !isset($_POST['oxy_show_page_title']) )
        return $post_id;
    
    
    add_post_meta($post_id,'oxy_page_layout',$_POST['oxy_page_layout'],true) or 
    update_post_meta($post_id,'oxy_page_layout',$_POST['oxy_page_layout']);
    
    add_post_meta($post_id,'oxy_show_page_title',$_POST['oxy_show_page_title'],true) or 
    update_post_meta($post_id,'oxy_show_page_title',$_POST['oxy_show_page_title']);
    
    add_post_meta($post_id,'oxy_show_breadcrumb',$_POST['oxy_show_breadcrumb'],true) or 
    update_post_meta($post_id,'oxy_show_breadcrumb',$_POST['oxy_show_breadcrumb']);
    
    
}




/*
 * TGM
 */

add_action('tgmpa_register', 'oxy_register_required_plugins');

function oxy_register_required_plugins() {

    
    $plugins = array(
        array(
            'name' => 'Smart Shortcodes', // The plugin name
            'slug' => 'smart-shortcodes', // The plugin slug (typically the folder name)
            'source' => get_template_directory() . '/swpf/plugins/smart-shortcodes.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),        
        array(
            'name' => 'Revolution Slider', // The plugin name
            'slug' => 'revslider', // The plugin slug (typically the folder name)
            'source' => get_template_directory() . '/swpf/plugins/revslider.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '4.1.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'WooCommerce Quickview', // The plugin name
            'slug' => 'jck_woo_quickview', // The plugin slug (typically the folder name)
            'source' => get_template_directory() . '/swpf/plugins/jck_woo_quickview.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'YITH Woocommerce Compare', // The plugin name
            'slug' => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
            'source' => get_template_directory() . '/swpf/plugins/yith-woocommerce-compare.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Breadcrumb NavXT', // The plugin name
            'slug' => 'breadcrumb-navxt', // The plugin slug (typically the folder name)
            'source' => 'http://downloads.wordpress.org/plugin/breadcrumb-navxt.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Contact Form 7', // The plugin name
            'slug' => 'contact-form-7', // The plugin slug (typically the folder name)
            'source' => 'http://downloads.wordpress.org/plugin/contact-form-7.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Really Simple CAPTCHA', // The plugin name
            'slug' => 'really-simple-captcha', // The plugin slug (typically the folder name)
            'source' => 'http://downloads.wordpress.org/plugin/really-simple-captcha.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),        
        array(
            'name' => 'Codestyling Localization', // The plugin name
            'slug' => 'codestyling-localization', // The plugin slug (typically the folder name)
            'source' => 'http://downloads.wordpress.org/plugin/codestyling-localization.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name' => 'Regenerate Thumbnails', // The plugin name
            'slug' => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
            'source' => 'http://downloads.wordpress.org/plugin/regenerate-thumbnails.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '', // If set, overrides default API URL and points to an external URL
        ),
                
    );



    // Change this to your theme text domain, used for internationalising strings

    $theme_text_domain = 'oxy';

   
    $config = array(
        'domain' => $theme_text_domain, // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'parent_menu_slug' => 'themes.php', // Default parent menu slug
        'parent_url_slug' => 'themes.php', // Default parent URL slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => false, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'strings' => array(
            'page_title' => __('Install Required Plugins', $theme_text_domain),
            'menu_title' => __('Install Plugins', $theme_text_domain),
            'installing' => __('Installing Plugin: %s', $theme_text_domain), // %1$s = plugin name
            'oops' => __('Something went wrong with the plugin API.', $theme_text_domain),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins'),
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins'),
            'return' => __('Return to Required Plugins Installer', $theme_text_domain),
            'plugin_activated' => __('Plugin activated successfully.', $theme_text_domain),
            'complete' => __('All plugins installed and activated successfully. %s', $theme_text_domain), // %1$s = dashboard link
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa($plugins, $config);
}

//add_action('post_thumbnail_html', 'set_oxy_default_post_image', 20, 5);

function set_oxy_default_post_image($html, $post_id, $post_thumbnail_id, $size, $attr) {

    if (!$post_thumbnail_id):

        $w = gettype($size[0]) != 'integer' ? '' : $size[0];

        $h = gettype($size[0]) != 'integer' ? '' : $size[1];

        if (gettype($size) != 'array'):

            $w = get_option($size . '_size_w');

            $h = get_option($size . '_size_h');

        endif;
        return $img = sprintf("<img src='" . SWPF_THEME_URI . "/image/post-thumbs/featured-%sx$h.jpg' alt='featured-%sx$h' height='$h' width='$w' />", $w, $w);

    endif;

    return $html;
}

function oxy_setup() {
    /*
     * Makes oxy Sport available for translation.
     *
     * Translations can be added to the /languages/ directory.
     * If you're building a theme based on oxy Sport, use a find and replace
     * to change 'oxy' to the name of your theme in all the template files.
     */

    load_theme_textdomain('oxy', get_template_directory() . '/languages');

    // This theme styles the visual editor with editor-style.css to match the theme style.

    add_editor_style();

    // Custom Header

    $defaults = array(
        'default-image' => '',
        'random-default' => false,
        'width' => 0,
        'height' => 0,
        'flex-height' => false,
        'flex-width' => false,
        'default-text-color' => '',
        'header-text' => true,
        'uploads' => true,
        'wp-head-callback' => '',
        'admin-head-callback' => '',
        'admin-preview-callback' => '',
    );    
    // Adds RSS feed links to <head> for posts and comments.

    add_theme_support('automatic-feed-links');

    add_theme_support('woocommerce');

        
    // This theme uses wp_nav_menu() in one location.

    register_nav_menu('primary', __('Primary Menu', 'oxy'));
    register_nav_menu('topnavhor', __('Top Horizontal Menu', 'oxy'));
    register_nav_menu('topnav', __('Top Dropdown Menu', 'oxy'));

    /*
     * This theme supports custom background color and image, and here
     * we also set up the default background color.
     */

    /* add_theme_support( 'custom-background', array(

      'default-color' => 'e6e6e6',

      ) );
     */
    add_theme_support('post-formats', array(
        'gallery', 'image', 'link', 'quote', 'video'
    ));
    
    // This theme uses a custom image size for featured images, displayed on "standard" posts.

    add_theme_support('post-thumbnails');

    set_post_thumbnail_size(590, 211); // Unlimited height, soft crop
    // Add Twenty Eleven's custom image sizes.
    // Used for large feature (header) images.    
    add_image_size( 'blog-thumb-medium', 250, 97, true );
    
    create_wcm_sds_brands_table(); // create wp_wcm_sds_brands table if not exists
  
}

add_action('after_setup_theme', 'oxy_setup');


function sds_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'oxy' ), max( $paged, $page ) );
	}
        
	return $title;
}
add_filter( 'wp_title', 'sds_wp_title', 10, 2 );


/**
 * Enqueues scripts and styles for front-end.
 *
 * @since oxy Sport 1.0
 */
function oxy_scripts_styles() {

    global $wp_styles, $wp_scripts;
    global $smof_data;

    
    
    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */

    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    /*
     * Loads our main stylesheet.
     */
    //$protocol = is_ssl() ? 'https' : 'http';
    $protocol = 'https';    
    $subsets = 'latin,cyrillic-ext,latin-ext,cyrillic,greek-ext,greek,vietnamese';
    $query_args = array(
            'family' => 'Open+Sans',
            'subset' => $subsets,
        );

    wp_enqueue_style('OpenSans', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"), array(), null);
    
    $query_args = array(
            'family' => 'Bitter',
            'subset' => $subsets,
        );

    wp_enqueue_style('Bitter', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"), array(), null);
    
    $query_args = array(
            'family' => 'PT+Sans+Narrow',
            'subset' => $subsets,
        );

    wp_enqueue_style('PT-Sans-Narrow', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"), array(), null);
    
    $query_args = array(
            'family' => 'Droid+Sans',
            'subset' => $subsets,
        );

    wp_enqueue_style('Droid-Sans', add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"), array(), null);
    $font_areas = array(
        'oxy_body_font',
        'oxy_title_font',
        'oxy_price_font',
        'oxy_button_font',
        'oxy_search_font',
        'oxy_cart_font',
        'oxy_main_menu_font',
        );
    foreach($font_areas as $font_area){
        if(!empty($smof_data->oxy_fonts_settings[$font_area])){
            $query_args = array(
                    'family' => str_replace(' ','+',$smof_data->oxy_fonts_settings[$font_area]),
                    'subset' => $subsets,
                );
                $stylename = str_replace(' ','-',$smof_data->oxy_fonts_settings[$font_area]);
            wp_enqueue_style($stylename, add_query_arg($query_args, "$protocol://fonts.googleapis.com/css"), array(), null);   
        }
    }
    
    if(file_exists(ABSPATH.'wp-includes/css/dashicons.min.css')){
        wp_enqueue_style( 'dashicons' );
    }
    wp_enqueue_style('Awesome-styles', "//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css", '', '4.1.0');
    wp_enqueue_style('foundation', SWPF_THEME_URI . '/css/foundation.css');
    wp_enqueue_style('normalize', SWPF_THEME_URI . '/css/normalize.css');
    wp_enqueue_style('stylesheet', SWPF_THEME_URI . '/css/stylesheet.css');
    wp_enqueue_style('blog', SWPF_THEME_URI . '/css/blog.css');
    wp_enqueue_style('blog_module', SWPF_THEME_URI . '/css/blog_module.css');
    
    wp_enqueue_style('custom_plugin_style', SWPF_THEME_URI . '/css/custom_plugin_style.css');

    wp_enqueue_style('jquery-ui-css', SWPF_THEME_URI . '/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
    
    
    wp_enqueue_style('oxy-style', get_stylesheet_uri());
    
    if($smof_data->oxy_general_settings['oxy_layout_s'] == 1)
        wp_enqueue_style('stylesheet-small-screens', SWPF_THEME_URI . '/css/style_small.css');
    
    if($smof_data->oxy_general_settings['oxy_layout_l'] == 2)
        wp_enqueue_style('stylesheet-large-screens', SWPF_THEME_URI . '/css/style_large.css');
    
    if($smof_data->oxy_general_settings['oxy_layout_l'] == 3)
        wp_enqueue_style('stylesheet-very-large-screens', SWPF_THEME_URI . '/css/style_very_large.css');
    
    wp_enqueue_style('responsive', SWPF_THEME_URI . '/css/responsive.css');
    
    if(!file_exists(get_template_directory().'/css/custom_style.css') || $smof_data->oxy_color_style_settings['oxy_cached_css_status'] != 1)
        wp_enqueue_style('custom-style', SWPF_THEME_URI . '/css/custom_style.php', array(), '1.0');
    else
        wp_enqueue_style('custom-style', SWPF_THEME_URI . '/css/custom_style.css', array(), '1.0');
  

//    wp_enqueue_script(array('jquery-ui-accordion', 'jquery-ui-tabs', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-position'), '', array('jquery', 'jquery-ui-core'));
}

add_action('wp_enqueue_scripts', 'oxy_scripts_styles', 20);


function oxy_front_init_js_var() {
    global $yith_wcwl,$post;    
    ?>
    <script type="text/javascript">
        var OXY_PRODUCT_PAGE = false;
        var THEMEURL = '<?php echo SWPF_THEME_URI ?>';
        var IMAGEURL = '<?php echo SWPF_THEME_URI ?>/image';
        var CSSURL = '<?php echo SWPF_THEME_URI ?>/css';
    <?php if (isset($yith_wcwl) && is_object($yith_wcwl)) { ?>
            var OXY_ADD_TO_WISHLIST_SUCCESS_TEXT = '<?php printf(preg_replace_callback('/(\r|\n|\t)+/',  create_function('$match', 'return "";'),__('Product successfully added to wishlist. <a href="%s">Browse Wishlist</a>', 'oxy')), $yith_wcwl->get_wishlist_url()) ?>';
            var OXY_ADD_TO_WISHLIST_EXISTS_TEXT = '<?php printf(preg_replace_callback('/(\r|\n|\t)+/',  create_function('$match', 'return "";'),__('The product is already in the wishlist! <a href="%s">Browse Wishlist</a>', 'oxy')), $yith_wcwl->get_wishlist_url()) ?>';
    <?php } ?>
        <?php if(is_singular('product')){?>
            OXY_PRODUCT_PAGE = true;
        <?php }?>
    </script>
    <?php
}

add_action('wp_head', 'oxy_front_init_js_var', 1);



function admin_oxy_menu_items() {
    $menu_items = oxy_nav_menu_items();
    $items = array('Select');
    if (!empty($menu_items)) {

        foreach ($menu_items as $item):
            $items[$item[0]] = $item[1];

        endforeach;
    }
    return $items;
}

function oxy_nav_menu_items($menu_loc = 'primary') {

    $menuid = get_nav_menu_locations();

    //return;

    if (isset($menuid[$menu_loc])) {
        $menu = wp_get_nav_menu_object($menuid[$menu_loc]);
        $items = wp_get_nav_menu_items($menu);
        $menu_items = array();

        if (!empty($items)) {
            foreach ($items as $item) {

                if ($item->menu_item_parent == 0) {
                    if (is_numeric($item->post_name)) {
                        $menu_item_object_id = get_post_meta($item->ID, '_menu_item_object_id', true);
                        
                        if($item->type=='taxonomy'){
                            
                            $p = get_term($item->object_id,$item->object);
                            $post_name = $p->name;
                        }
                        else{                        
                            $p = get_post((int) $menu_item_object_id);
                            //$p = get_post((int) $item->object_id);
                            $post_name = $p->post_name;
                        }
                        $menu_items[] = array((int) $item->object_id, $item->title, $post_name, $item->classes);
                        
                    } else {
                        $menu_items[] = array((int) $item->object_id, $item->title, $item->post_name, $item->classes);
                    }
                }
            }

            if (!empty($menu_items))
                return $menu_items;
        }
    }
    return false;
}

function oxy_wp_head_scripts() {
    global $smof_data;
  ?>
<script type="text/javascript">    
 jQuery(document).ready(function($){ 
        "use strict";
        $(".facebook_right").hover(function(){            
            $(".facebook_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
        },
        function(){            
              $(".facebook_right").stop(true, false).animate({right: "-245" }, 800, 'easeInQuint' );        
        },1000);    
                
        $(".facebook_left").hover(function(){            
            $(".facebook_left").stop(true, false).animate({left: "0" }, 800, 'easeOutQuint' );        
        },
        function(){            
            $(".facebook_left").stop(true, false).animate({left: "-245" }, 800, 'easeInQuint' );        
        },1000);    
        
        $(".twitter_right").hover(function(){            
            $(".twitter_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
        },
        function(){            
            $(".twitter_right").stop(true, false).animate({right: "-245" }, 800, 'easeInQuint' );        
        },1000);    
            
        $(".twitter_left").hover(function(){            
            $(".twitter_left").stop(true, false).animate({left: "0" }, 800, 'easeOutQuint' );        
        },
        function(){            
            $(".twitter_left").stop(true, false).animate({left: "-245" }, 800, 'easeInQuint' );        
        },1000);    
            
        $(".video_box_right").hover(function(){            
            $(".video_box_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
        },
        function(){            
            $(".video_box_right").stop(true, false).animate({right: "-588" }, 800, 'easeInQuint' );      
        },1000);    
         
        $(".video_box_left").hover(function(){            
            $(".video_box_left").stop(true, false).animate({left: "0" }, 800, 'easeOutQuint' );        
        },
        function(){            
            $(".video_box_left").stop(true, false).animate({left: "-588" }, 800, 'easeInQuint' );        
        },1000);    
        
        $(".custom_box_right").hover(function(){            
            $(".custom_box_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
        },
        function(){            
            $(".custom_box_right").stop(true, false).animate({right: "-245" }, 800, 'easeInQuint' );      
        },1000);    
                
        $(".custom_box_left").hover(function(){            
            $(".custom_box_left").stop(true, false).animate({left: "0" }, 800, 'easeOutQuint' );        
        },
        function(){            
            $(".custom_box_left").stop(true, false).animate({left: "-245" }, 800, 'easeInQuint' );        
        },1000);
        <?php
        if($smof_data->oxy_general_settings['oxy_header_fixed_header_status'] == 1){
        ?>  
        $(window).load(function() {
            if($(window).width() > 991)
            $("#header").sticky({topSpacing: 0});
        });        
        <?php
        }
        ?>
        <?php echo $smof_data->oxy_custom_css_settings['oxy_custom_js']?>

  });  
</script>  
    <?php
   
}

add_action('wp_footer', 'oxy_wp_head_scripts', 10);

function oxy_scripts_styles_pre() {

    global $post;
    global $smof_data;
    $pagetemplate = '';

    $oxy_page_template = '';

    if (is_page()) {

        $pagetemplate = get_page_template();
        $oxy_page_template = get_post_meta($post->ID, 'oxy_page_template', true);
    }

    /**
     * Loading js
     */
    
    wp_enqueue_script(array('jquery-ui-core','jquery-ui-autocomplete','jquery-effects-core'),'',array('jquery'));
    
    wp_enqueue_script('foundation-min', SWPF_THEME_URI . '/js/foundation.min.js', array('jquery'), '', true);
    
    wp_enqueue_script('modernizr', SWPF_THEME_URI . '/js/modernizr.js', array('jquery'), '', true);
    wp_enqueue_script('oxy-common', SWPF_THEME_URI . '/js/common.js', array('jquery'), '1.0', true);

    wp_enqueue_script('foundation-reveal', SWPF_THEME_URI . '/js/jquery.foundation.reveal.js', array('jquery'), '', true);    

    if(is_singular('product') || (isset($post->post_type) && $post->post_type == 'post'))
        wp_enqueue_script('flexslider-min',SWPF_THEME_URI.'/js/jquery.flexslider-min.js',array('jquery'),'',true);
    
    wp_enqueue_script('jquery.sticky', SWPF_THEME_URI . '/js/jquery.sticky.js', array('jquery'), '', true);

    wp_enqueue_script('jquery.tipTip', SWPF_THEME_URI . '/js/jquery.tipTip.js', array('jquery'), '', true);
    if($smof_data->oxy_general_settings['oxy_others_totop'] != 0){
        wp_enqueue_script('jquery.ui.totop', SWPF_THEME_URI . '/js/jquery.ui.totop.js', array('jquery'), '', true);
    }
    if(is_singular('product') && $smof_data->oxy_general_settings['oxy_product_zoom_type'] != 0)
        wp_enqueue_script('cloud-zoom', SWPF_THEME_URI . '/js/cloud-zoom.js', array('jquery'), '', true);
  
    
    if(is_page() && basename($pagetemplate) == 'template-contact.php'){        
        wp_enqueue_script('google-map', '//maps.google.com/maps/api/js?sensor=true', array('jquery'), '', true);
    }
    
}

add_action('wp_enqueue_scripts', 'oxy_scripts_styles_pre');

function set_oxy_skin_cookie() {

    if (isset($_GET['skin'])) {

        $theme_skin = $_GET['skin'];
        setcookie('oxy_skin', $theme_skin, time() + ( 2 * 3600), '/', $_SERVER['HTTP_HOST']);
    }
}

add_action('wp', 'set_oxy_skin_cookie');


function oxy_footer_callback() {

    global $post, $woocommerce, $smof_data;


    $template = '';

    if (is_page()):
        $template = basename(get_page_template());
        $template = substr($template, 0, strrpos($template, '.'));
    endif;

    $protocol = is_ssl() ? "https:" : "http:";

    $pagetemplate = $template;

    $elastisliders = array('featured-slider' => true, 'latest-slider' => true);
    
        
    ?>    
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        <?php 
    if($pagetemplate === 'template-contact' 
    && isset($smof_data->oxy_general_settings['oxy_contact_map_status']) 
    && $smof_data->oxy_general_settings['oxy_contact_map_status'] == 1){

        $markercontent = get_option('oxy_gmap_marker_content');
        $markercontent = preg_replace_callback('/(\r|\n|\t)+/', create_function('$match','return "";'), addslashes($markercontent));
        ?>    
            var ll = '<?php echo $smof_data->oxy_general_settings['oxy_contact_map_ll']?>';
            var platlng = ll.split(',');
            if(platlng[0] !== undefined && platlng[1] !== undefined){
                platlng[0] = platlng[0].trim();
                platlng[1] = platlng[1].trim();
            }
            else return;

            //------- Google Maps ---------//
            // Creating a LatLng object containing the coordinate for the center of the map
            var latlng = new google.maps.LatLng(parseFloat(platlng[0]),parseFloat(platlng[1]));

            // Creating an object literal containing the properties we want to pass to the map  
            var options = {  
                    zoom: <?php echo $smof_data->oxy_general_settings['oxy_contact_map_zoom']?>, // This number can be set to define the initial zoom level of the map
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.<?php echo $smof_data->oxy_general_settings['oxy_contact_map_type']?>, // This value can be set to define the map type ROADMAP/SATELLITE/HYBRID/TERRAIN
                    scrollwheel : false                
            };  
            // Calling the constructor, thereby initializing the map  
            var map = new google.maps.Map(document.getElementById('map_div'), options);  

            // Define Marker properties
            var image = new google.maps.MarkerImage(
                    //Image file name
                    '<?php echo SWPF_THEME_URI ?>/image/map_marker.png',
                    // This marker is 129 pixels wide by 42 pixels tall.
                    new google.maps.Size(57, 76),
                    // The origin for this image is 0,0.
                    new google.maps.Point(0,0),
                    // The anchor for this image is the base of the flagpole at 18,42.
                    new google.maps.Point(30, 76)
            );
            <?php if($smof_data->oxy_general_settings['oxy_gmap_marker_status'] == 1){?>
                // Add Marker
                var marker1 = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(platlng[0]),parseFloat(platlng[1])), 
                        map: map,
                        icon: image // This path is the custom pin to be shown. Remove this line and the proceeding comma to use default pin
                });	

                var infowindow1 = new google.maps.InfoWindow({  
                        content:  '<?php echo $markercontent;?>',
                        maxWidth: parseFloat(<?php echo $smof_data->oxy_general_settings['oxy_gmap_marker_textbox_width']?>)
                }); 
                google.maps.event.addListener(marker1, 'mouseover', function() {
                    infowindow1.open(map, marker1);
                });
            <?php } ?>


    <?php     
    }
    if (is_singular('product') and isset($woocommerce)):
    ?>

            <?php if($smof_data->oxy_general_settings['oxy_product_zoom_type'] == 1){?>
                    $('.cloud-zoom').CloudZoom({zoomWidth:'auto',zoomHeight:'auto',position:'inside'});
                    $(document.body).on('click','.image-additional a,.cloud-zoom-gallery',function(){

                        var $this = $(this);
                        var src = $this.attr('href');                                
                        $('.product-left .image > #wrap a').attr('href',src);
                        $('.product-left .image > #wrap a img').attr('src',src);                        
                        $('.cloud-zoom').data('zoom').destroy();                                
                        $('.cloud-zoom').CloudZoom({zoomWidth:'auto',zoomHeight:'auto',position:'inside'});  
                        setTimeout(function(){
                            if($('.mousetrap').length > 1)
                                $('.mousetrap:not(:last-child)').remove();
                        },500);
                        return false;
                    });
            <?php }?>
            $( document.body ).on('change','.variations_form .variations select',function(){

                var $product = $(this).closest('.product');
                var $product_img = $product.find('div.images img:eq(0)');                    
                var src = $product_img.attr('src');                        
                var nsrc = src.replace(/\-([0-9]+)x([0-9]+)\./,'.');

                $.ajax({
                    url: nsrc,
                    complete : function(xhr,req){
                        if(xhr.status != 200){                                    
                            nsrc = src;                                    
                        }
                        $product_img.parent().attr('href',nsrc);
                        $product_img.attr('src',nsrc);
                        <?php if($smof_data->oxy_general_settings['oxy_product_zoom_type'] == 1){?>

                                if($('.cloud-zoom').data('zoom') != null)
                                    $('.cloud-zoom').data('zoom').destroy();
                                setTimeout(function(){
                                    $('.cloud-zoom').CloudZoom({zoomWidth:'auto',zoomHeight:'auto',position:'inside'});
                                },600);                                        
                        <?php }?>
                    }                            
                });

            });
            $(".variations_form .variations select").change();
        <?php if($smof_data->oxy_general_settings['oxy_product_zoom_type'] == 1){?>

        $('.variations_form').on('found_variation',function(event, variation){

                var $product 		= $(this).closest( '.product' );
                var $product_img 	= $product.find( 'div.images img:eq(0)' );
                var $product_link 	= $product.find( 'div.images a.cloud-zoom:eq(0)' );

                var cloud_zoom          = $product.find('a.cloud-zoom');

                if(variation.variation_id != 'undefined'){                                

                    cloud_zoom.attr("href",variation.image_link);
                    cloud_zoom.find('img').attr("src",variation.image_link);

                    $product.find('.zoom-b a.colorbox').attr("href",variation.image_link);
                }

        }).on('reset_image', function(event) {

           var $product 		= $(this).closest( '.product' );
                var $product_img 	= $product.find( 'div.images img:eq(0)' );
                var $product_link 	= $product.find( 'div.images a.cloud-zoom:eq(0)' );

                var o_src 		= $product_img.attr('src');

                var image_alt           = $product_img.attr('title');

                var cloud_zoom          = $product.find('a.cloud-zoom');

                cloud_zoom.attr("href",o_src);
                cloud_zoom.find('img').attr("src",o_src);

                //$product.find('.zoom-b a.colorbox').attr("href",o_src);
                $('.cloud-zoom').data('zoom').destroy();
                $('.cloud-zoom').CloudZoom({zoomWidth:'auto',zoomHeight:'auto',position:'inside'});
        });
        <?php } ?>            
    <?php
    endif;
    ?>

//    var revapi;            
    $('#header #search #searchform .button-search').click(function() {
        if ($(this).next('input#s').val() != '')
            $(this).parent().submit();
    });        

    <?php if($smof_data->oxy_general_settings['oxy_others_totop'] != 0){?>
    jQuery().UItoTop({easingType: 'easeOutQuart'});
    <?php }?>

    $("#buttonForModal").click(function() {
        $("#myModal").reveal();
    });

    $(window).load(function(){

        $(window).trigger('resize');
    });

    $(".tiptip").tipTip();

    if($.fn.flexslider){        
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: true,
            pausePlay: false,
            controlNav: false,
            smoothHeight: true,
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
        $('.carousel0').flexslider({
            animation: "slide",
            animationLoop: true,
            slideshow: true,
            controlNav: false,
            itemWidth: 180,
            maxItems: 100,
            minItems: 1
        });
        $('.product-right-sm-related-flexslider').flexslider({
            animation: "slide",
            animationLoop: false,
            controlNav: false
        });
    }
    $(document.body).on('mouseover', '#cart > .heading a', function() {                
        $('#cart').addClass('active');
        $('#cart .content').show();                
    });
    $(document.body).on('mouseleave','#cart', function() {
        $(this).removeClass('active');
        $(this).find('.content').hide();
    });

    $('.woocommerce-tabs ul.tabs li a').off('click'); //unbind woocommerce default event on woocommerce-tabs 

    $('.woocommerce-tabs ul.tabs li a').on('click',function() {

        var $tab = $(this);

        var $tabs_wrapper = $tab.closest('.woocommerce-tabs');

        var $tab_parent = $tab.closest('li');

        if ($('html,body').outerWidth(true) < 751 && $tab_parent.hasClass('hidden-phone')) {
            return false;
        }

        $('ul.tabs li', $tabs_wrapper).removeClass('active');
        $('div.panel', $tabs_wrapper).hide();
        $('div' + $tab.attr('href')).show();
        $tab.parent().addClass('active');

        return false;
    });

    if($.fn.tabs){
        $("#tab").tabs();
        $('.oxy_tabs').tabs();
    }


    $(document.body).on('DOMNodeInserted','#content #comments .commentList li', function(e) {                
        e.preventDefault();
        var widW = $(window).width();
        var elem = $('#content #comments .commentList li div#respond');
        var topV = 24;
        topV += $('#wpadminbar').length > 0 ? $('#wpadminbar').height() : 0;

        if (widW > 750) {
            elem.css('top', topV + 'px');
        }
    });

});
    (function($){

        $.fn.smart_js = function(opts){

                var options = $.extend({

                        accordionElem : $('.accordion'),

                        tabsElem : $('.smart_tabs'),

                        toggleElem : $('.toggle-box h2.trigger'),

                }, opts );

                if($.fn.accordion)
                    options.accordionElem.accordion({collapsible:true,active:false,heightStyle:"content"});
            
                if($.fn.tabs)
                    options.tabsElem.tabs();

                options.toggleElem.on('click',function(){			
                    var h2 = $(this);
                    if(!h2.hasClass('active')){
                        h2.addClass('active');
                        h2.next('.toggle_container').slideDown(300);
                    }else{
                        h2.removeClass('active');			
                        h2.next('.toggle_container').slideUp(300);
                    }			
                });


        };


    }(jQuery));

    jQuery.fn.smart_js();
    </script>
    <?php
}

add_action('wp_footer', 'oxy_footer_callback', 100);


/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since oxy Sport 1.0
 */
function oxy_page_menu_args($args) {

    if (!isset($args['show_home']))
        $args['show_home'] = true;

    return $args;
}

add_filter('wp_page_menu_args', 'oxy_page_menu_args');

/**
 * Enabling Shortcode in Text Widget
 *
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since oxy Sport 1.0
 */
function oxy_widgets_init() {

    register_sidebar(array(
        'name' => __('Blog Left Sidebar', 'oxy'),
        'id' => 'blogsidebar',
        'before_widget' => '<div class="box %2$s" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<div class="box-heading">',
        'after_title' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('Blog Right Sidebar', 'oxy'),
        'id' => 'blogrightsidebar',
        'before_widget' => '<div class="box %2$s" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<div class="box-heading">',
        'after_title' => '</div>',
    ));

    register_sidebar(array(
        'name' => __('Page Left Sidebar', 'oxy'),
        'id' => 'page-left-sidebar',
        'before_widget' => '<div class="box %2$s" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<div class="box-heading">',
        'after_title' => '</div>',
    ));

    register_sidebar(array(
        'name' => __('Page Right Sidebar', 'oxy'),
        'id' => 'page-right-sidebar',
        'before_widget' => '<div class="box %2$s" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<div class="box-heading">',
        'after_title' => '</div>',
    ));

    register_sidebar(array(
        'name' => __('Shop Left Sidebar', 'oxy'),
        'id' => 'leftbar',
        'before_widget' => '<div class="box %2$s" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<div class="box-heading">',
        'after_title' => '</div>',
    ));

    register_sidebar(array(
        'name' => __('Shop Right Sidebar', 'oxy'),
        'id' => 'shoprightbar',
        'before_widget' => '<div class="box %2$s" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<div class="box-heading">',
        'after_title' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('Product Right Sidebar', 'oxy'),
        'id' => 'productrightbar',
        'before_widget' => '<div class="%2$s product-right-sidebar" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => __('Contact Left Sidebar', 'oxy'),
        'id' => 'contact-left-sidebar',
        'before_widget' => '<div class="contact-sidebar %2$s" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<div class="box-heading">',
        'after_title' => '</div>',
    ));

    register_sidebar(array(
        'name' => __('Contact Right Sidebar', 'oxy'),
        'id' => 'contact-right-sidebar',
        'before_widget' => '<div class="contact-sidebar %2$s" id="%1$s"> ',
        'after_widget' => "</div>",
        'before_title' => '<div class="box-heading">',
        'after_title' => '</div>',
    ));

    register_sidebar(array(
        'name' => __('Footer1', 'oxy'),
        'id' => 'footer1',
        'before_widget' => '<div id="%1$s" class="s3 large-3 medium-3 small-12 columns %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer2', 'oxy'),
        'id' => 'footer2',
        'before_widget' => '<div id="%1$s" class="s3 large-3 medium-3 small-12 columns %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'oxy_widgets_init');

function get_contact_page_sidebar_markup($sidebar = 'contact-left-sidebar', $class = 'large-4 medium-4'){
    ob_start();
    if(is_active_sidebar($sidebar)){        
    ?>
        <div class="<?php echo $class?> columns">
             <?php dynamic_sidebar($sidebar)?>       
        </div>
    <?php
    }
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

if (!function_exists('oxy_content_nav')) :

    /**
     * Displays navigation to next/previous pages when applicable.
     *
     * @since oxy Sport 1.0
     */
    function oxy_content_nav($html_id) {

        global $wp_query;

        $html_id = esc_attr($html_id);

        if ($wp_query->max_num_pages > 1) :
            ?>

            <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">

                <h3 class="assistive-text"><?php _e('Post navigation', 'oxy'); ?></h3>

                <div class="nav-previous alignleft"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'oxy')); ?></div>

                <div class="nav-next alignright"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'oxy')); ?></div>

                            </nav><!-- #<?php echo $html_id; ?> .navigation -->

        <?php
        endif;
    }

endif;



if (!function_exists('oxy_comment')) :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own oxy_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since oxy Sport 1.0
     */
    function oxy_comment($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;

        $max_depth = $args['max_depth'];

        $liclass = ( $GLOBALS['ncc'] % 2 == 0 ) ? 'even' : 'odd';
        ?>

        <li class="<?php echo $liclass . " depth-$depth" ?>">

            <div itemtype="http://schema.org/UserComments" itemscope="" itemprop="comment" id="comment-<?php echo $comment->comment_ID ?>">

        <?php echo get_avatar($comment->user_id, 54, '', $comment->comment_author); ?>

                <div class="name"><?php echo $comment->comment_author; ?></div>

                <div class="created">

                    <span itemprop="commentTime"><?php echo date(get_option('date_format') . ' ' . get_option('time_format'), strtotime($comment->comment_date)); ?></span>

                </div>

                <p itemprop="commentText"><?php echo get_comment_text($comment->comment_ID); ?></p>

                <div class="reply">

        <?php
        $arr = array('reply_text' => __('Reply', 'oxy'));

        comment_reply_link(array_merge($arr, array('depth' => $depth, 'max_depth' => $max_depth)));
        ?>

                </div>

            </div>

        <?php
        $GLOBALS['ncc'] ++;
    }

endif; // ends check for oxy_comment()

if (!function_exists('oxy_entry_meta')) :

    /**
     * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
     *
     * Create your own oxy_entry_meta() to override in a child theme.
     *
     * @since oxy Sport 1.0
     */
    function oxy_entry_meta() {

        // Translators: used between list items, there is a space after the comma.

        $categories_list = get_the_category_list(__(', ', 'oxy'));

        // Translators: used between list items, there is a space after the comma.
        //$tag_list = get_the_tag_list( '', __( ', ', 'oxy' ) );

        $date = sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', esc_url(get_permalink()), esc_attr(get_the_time()), esc_attr(get_the_date('c')), esc_html(get_the_date())
        );

        $author = sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_attr(sprintf(__('View all posts by %s', 'oxy'), get_the_author())), get_the_author()
        );

        // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.

        if ($categories_list) {

            $utility_text = __('Posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'oxy');
        } else {

            $utility_text = __('This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'oxy');
        }

        printf(
                $utility_text, $categories_list, $tag_list, $date, $author
        );
    }

endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since oxy Sport 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function oxy_body_class($classes) {

    $background_color = get_background_color();



    if (!is_active_sidebar('sidebar-1') || is_page_template('page-templates/full-width.php'))
        $classes[] = 'full-width';



    if (is_page_template('page-templates/front-page.php')) {

        $classes[] = 'template-front-page';

        if (has_post_thumbnail())
            $classes[] = 'has-post-thumbnail';

        if (is_active_sidebar('sidebar-2') && is_active_sidebar('sidebar-3'))
            $classes[] = 'two-sidebars';
    }



    if (empty($background_color))
        $classes[] = 'custom-background-empty';

    elseif (in_array($background_color, array('fff', 'ffffff')))
        $classes[] = 'custom-background-white';



    // Enable custom font class only if the font CSS is queued to load.

    if (wp_style_is('oxy-fonts', 'queue'))
        $classes[] = 'custom-font-enabled';



    if (!is_multi_author())
        $classes[] = 'single-author';



    return $classes;
}

add_filter('body_class', 'oxy_body_class');

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since oxy Sport 1.0
 */
function oxy_content_width() {

    if (is_page_template('page-templates/full-width.php') || is_attachment() || !is_active_sidebar('sidebar-1')) {

        global $content_width;

        $content_width = 960;
    }
}

add_action('template_redirect', 'oxy_content_width');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since oxy Sport 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since oxy Sport 1.0
 */
function oxy_customize_preview_js() {

    wp_enqueue_script('oxy-customizer', SWPF_THEME_URI . '/js/theme-customizer.js', array('customize-preview'), '20120827', true);
}

add_action('customize_preview_init', 'oxy_customize_preview_js');

function new_excerpt_more($more) {

    global $post;
    
    return '<div class="entry-meta"><a class="post-read-more" href="' . get_permalink($post->ID) . '">' . __('Continue Reading &raquo;', 'oxy') . '</a></div>';
}

add_filter('excerpt_more', 'new_excerpt_more');

if(!is_admin()){
$oxy_found_more_tag = false;

function oxy_content_more_link($more){
    global $oxy_found_more_tag;
    $oxy_found_more_tag = true;
    
    return false;   
}
}
add_filter('the_content_more_link', 'oxy_content_more_link',20);




function mytheme_init() {

    add_filter('comment_form_defaults', 'mytheme_comments_form_defaults');
}

add_action('after_setup_theme', 'mytheme_init');

function mytheme_comments_form_defaults($default) {

    unset($default['comment_notes_after']);

    return $default;
}

function get_leftbar($name = null) {

    get_sidebar($name);
}

if (!function_exists('get_blogleftbar')) {

    function get_blogleftbar($name = null) {

        get_sidebar($name);
    }

}


add_action('add_meta_boxes', 'add_custom_template_meta_box');


add_action('save_post', 'save_template_sidebar_location');

function add_custom_template_meta_box() {

    add_meta_box('_change_sidebar_position', 'Sidebar Position', 'change_template_sidebar_location', 'page', 'side');
}

function change_template_sidebar_location($post) {

    $sidebar_pos = get_post_meta($post->ID, 'page-sidebar-pos', true);

    $templateFile = 'template-home-with-sidebars.php';

    $currentTemplate = get_post_meta($post->ID, '_wp_page_template', true);

    if ($templateFile != $currentTemplate):
        ?>

            <style type="text/css">

                #_change_sidebar_position{ display:none;}

            </style>

            <?php
        endif;
        ?>

        <div id="page-sidebar-pos-parent">    	
            <select name="page-sidebar-pos">

                <option value="left"<?php if ($sidebar_pos == 'left') echo ' selected="selected"'; ?>>Left</option>

                <option value="right"<?php if ($sidebar_pos == 'right') echo ' selected="selected"'; ?>>Right</option>

            </select>

        </div>

        <script type="text/javascript">

            jQuery(function($) {

                "use strict";

                var templateFile = '<?php echo $templateFile; ?>';

                $('#page_template').change(function() {

                    var pageTemplate = $(this).val();

                    if (pageTemplate === templateFile) {

                        $('#_change_sidebar_position').show();

                    }

                    else {

                        $('#_change_sidebar_position').hide();

                    }

                });

            });

        </script>

        <?php
    }

    function save_template_sidebar_location($post_id) {

        if (!isset($_POST['page-sidebar-pos']))
            return;

        $metaval = $_POST['page-sidebar-pos'];

        add_post_meta($post_id, 'page-sidebar-pos', $metaval, true) or update_post_meta($post_id, 'page-sidebar-pos', $metaval);
    }

    add_action('woocommerce_single_product_summary', 'add_rating_to_single_product_summary');

    function add_rating_to_single_product_summary() {

        global $wpdb, $post, $product;
        ?>
        <div class="product_custom_review">

            <div class="product_custom_rating">

                <div id="reviews">

                    <div id="comments">        

                        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">

        <?php echo $product->get_rating_html() ?>

                        </div>

                    </div><!--#comments-->

                </div><!--#reviews-->

            </div>

        <?php if (comments_open()) : ?>

                <div class="product_custom_review_bottom">
                        <span class="write_review_link review_num"><?php echo comments_number(__('0 review', 'oxy'), __('1 review', 'oxy'), __('% reviews', 'oxy')); ?></span>
                        &nbsp;|&nbsp;
                        <span class="write_review_link"><?php echo __('Write a review', 'oxy') ?></span>
                </div>

                <script type="text/javascript">

                    jQuery(function($) {

                        "use strict";
                        
                        $('span.write_review_link').click(function() {
                            
                            $('.woocommerce-tabs ul.tabs li').removeClass('active');

                            $('.woocommerce-tabs .panel').hide();

                            $('.woocommerce-tabs ul.tabs li.reviews_tab').addClass('active');

                            $('.woocommerce-tabs #tab-reviews').show();

                            var revpos = 0;
                            var fcs = false;

                            if ($(this).hasClass('review_num')) {

                                revpos = $('.woocommerce-tabs #tab-reviews').offset();

                            }

                            else {

                                revpos = $('#review_form_wrapper #commentform').offset();
                                fcs = true;

                            }

                            revpos = revpos.top;
                            revpos -= $('#header').outerHeight(); 

                            if ($('#wpadminbar').length > 0) {

                                revpos -= $('#wpadminbar').outerHeight();

                            }

                            $('html,body').animate({scrollTop: revpos + 'px'}, 500, function(){
                                if(fcs)
                                $('#review_form_wrapper #commentform #comment').focus();                                
                            });

                        });

                    });

                </script>

        <?php endif; ?>

        </div>

        <?php
    }

    function show_header_carts() {

        global $woocommerce;

        if(!isset($woocommerce)) return ;
        
        if (sizeof($woocommerce->cart->get_cart()) > 0) :
            ?>

            <div class="mini-cart-info">

                <table>

                    <tbody>

            <?php
            foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :

                $_product = $cart_item['data'];

                if (!apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key) || !$_product->exists() || $cart_item['quantity'] == 0)
                    continue;

                // Get price

                $product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

                $product_price = apply_filters('woocommerce_cart_item_price_html', woocommerce_price($product_price), $cart_item, $cart_item_key);
                ?>

                            <tr>

                                <td class="image">

                                    <a href="<?php echo get_permalink($cart_item['product_id']); ?>"><?php echo $_product->get_image(); ?></a>

                                </td>

                                <td class="name"><a href="<?php echo get_permalink($cart_item['product_id']); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product); ?></a>

                                </td>

                                <td class="quantity"><?php print( '&times; ' . $cart_item['quantity']); ?></td>

                                <td class="total"><?php echo $product_price; ?></td>

                            </tr>

                <?php
            endforeach;
            ?>

                    </tbody></table>

            </div>

            <div class="mini-cart-total">
                <table>
                    <tbody>
                        <tr><td align="right"><b><?php _e('Sub-Total:','oxy');?></b></td><td align="right"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></td>
                        </tr><tr><td align="right"><b><?php _e('Total:', 'oxy');?></b></td><td align="right"><?php echo $woocommerce->cart->get_cart_total(); ?></td></tr>
                    </tbody>
                </table>
            </div>

            <div class="checkout"><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button"><?php _e('View Cart', 'oxy'); ?></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="button checkout"><?php _e('Checkout', 'oxy'); ?></a></div>

    <?php else: ?>
            <div class="empty"><?php _e('Your shopping cart is empty!', 'oxy'); ?></div>
        
        <?php
    endif;
}

function oxy_get_related_products_right($numposts){
    global $product, $smof_data;
    if(!function_exists('WC') || !isset($product) || empty($product)) return;
    
    $related = $product->get_related($numposts);
    //$numposts = $smof_data->oxy_general_settings['oxy_product_related_num'];
    //if ($smof_data->oxy_general_settings['oxy_product_related_status'] != '0' && $smof_data->oxy_general_settings['oxy_product_related_position'] == 'right' && !empty($related)):
    if (!empty($related)):
    
    $args = apply_filters('woocommerce_related_products_args', array(
            'post_type' => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows' => 1,
            'showposts' => $numposts,
            'orderby' => 'rand',
            'post__in' => $related,
        ));

    $q = new WP_Query($args);
    if ($q->have_posts()):
    ?>
<!--    <div class="product-right-sm-related">
        <h5><?php //_e('Related Products','oxy')?></h5>-->
        <div class="product-right-sm-related-flexslider carousel">       
            <ul class="slides">     
                <?php  while ($q->have_posts()): $q->the_post();
                $p = get_product(get_the_ID());
                ?>
                 <li>
                     <div class="image"><a href="<?php the_permalink()?>"><?php the_post_thumbnail(array(300,400)); ?></a></div>
                     <div class="name"><a href="<?php the_permalink()?>"><?php the_title();?></a></div>
                     <div class="description-r"><?php echo substr(get_the_excerpt(),0,60)?>..</div>
                     <div class="price">
                         <?php echo $p->get_price_html()?>                     
                     </div>
                 </li>
                 <?php endwhile;  ?>
             </ul>            
        </div><!--.product-right-sm-related-flexslider-->
    <!--</div>-->        
    <?php
    endif;
    endif;
    wp_reset_query();
    
}

add_action('woocommerce_after_single_product', 'get_bottom_related_product');

function get_bottom_related_product() {

    global $smof_data, $woocommerce, $wpdb, $post, $product, $yith_wcwl;

    if (!isset($woocommerce))
        return;
    $numposts = $smof_data->oxy_general_settings['oxy_product_related_num'];
    $related = $product->get_related($numposts);
    
    //$posts_per_page = ($smof_data->oxy_general_settings['oxy_product_page_design'] == 1) ? 4 : 3;
    
    $cols = $smof_data->oxy_general_settings['oxy_product_related_cols'];

    switch ((int)$cols){            
        case 3:        
            $colclass = 'large-4 medium-4 small-6';
            break;    
        case 6:        
            $colclass = 'large-2 medium-2 small-6';
            break;    
        default:
            
            $colclass = 'large-3 medium-4 small-6';
            break;        
    }
    
    
    
    if ($smof_data->oxy_general_settings['oxy_product_related_status'] != '0' 
            //&& $smof_data->oxy_general_settings['oxy_product_related_position'] == 'bottom' 
            && !empty($related)):

        $args = apply_filters('woocommerce_related_products_args', array(
            'post_type' => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows' => 1,
            'showposts' => (int)$numposts,
            'orderby' => 'rand',
            'post__in' => $related,
        ));

        $q = new WP_Query($args);
        $n = 0;
      
        $title = __('Related Products', 'oxy');
        
        $startwraping =  $endwraping = '';
        
        if($smof_data->oxy_general_settings['oxy_product_related_style'] == 0){
            
            $startwraping = '<div class="related-products-bottom"><h2>'.$title.'</h2><div class="product-grid">';
            $endwraping = '</div></div>';
            
        }else{            
            
            $startwraping = '<div class="product-box-slider"><div class="box-heading">'.$title.'</div><div id="related_product_slider" class="product-box-slider-flexslider"><div class="woocommerce">';
            $endwraping = '</div></div></div>';
            
            $endwraping .= "<script type='text/javascript'>
            jQuery(function(\$) {
                \$(window).load(function(){
                    var main = \$('#related_product_slider > .woocommerce');
                    var wd = main.find('ul.products li:first-child').width();
                    main.find('ul.products li').each(function(){
                        var \$this = \$(this);
                        if(\$this.width() > wd)
                            wd = \$this.width();
                    });
                    if(\$.fn.flexslider)
                    \$('#related_product_slider > .woocommerce').flexslider({
                        animation: \"slide\",
                        animationLoop: false,
                        slideshow: false,
                        controlNav: false,
                        itemWidth: wd,
                        maxItems: ".count($related).",
                        minItems: 1,
                        useCSS: false,
                        selector: 'ul.products > li',
                    });
                });
            });
            </script>";
        }
        
        echo $startwraping;
        
        ?>
        
            <ul class="products">
            <?php
            if ($q->have_posts()): while ($q->have_posts()): $q->the_post();

                    $product_id = get_the_ID();
                    $n++;
                    ?>

                <li class="<?php echo $colclass?>">

                <?php do_action('woocommerce_before_shop_loop_item'); ?>

                    <div class="image">

                        <a href="<?php the_permalink(); ?>">

                <?php
                /**
                 * woocommerce_before_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action('woocommerce_before_shop_loop_item_title');
                ?>
                </a>
                <?php
                if($smof_data->oxy_general_settings['oxy_cat_prod_wis_com_status'] == 1){
                    $product = get_product($product_id);
                ?>
                    <div class="flybar"> 
                        <?php 

                        if(isset($yith_wcwl) && is_object($yith_wcwl)){ 
                        $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist wishlist add_to_wishlist_small"';    
                      ?>
                        <a href="<?php echo esc_url( $yith_wcwl->get_addtowishlist_url() )?>" data-product-id="<?php echo $product_id ?>" data-product-type="<?php echo $product->product_type ?>" <?php echo $classes?>><div><?php _e('Add to Wish List','oxy')?></div></a>
                        <a title="<?php _e('Add to Wish List','oxy')?>" class="wishlist-tip"><div><?php _e('Add to Wish List','oxy')?></div></a>
                    <?php
                    }
                    if(class_exists('YITH_Woocompare_Frontend')){
                      $oxy_yith_cmp = new YITH_Woocompare_Frontend;
                    ?>            
                        <a class="compare add_to_compare_small" data-product_id="<?php echo $product_id?>" href="<?php echo $oxy_yith_cmp->add_product_url( $product_id )?>"><div><?php _e('Add to Compare','oxy')?></div></a>
                        <a title="<?php _e('Add to Compare','oxy')?>" class="compare-tip"><div><?php _e('Add to Compare','oxy')?></div></a>
                    <?php
                    }
                    ?>
                    </div>
                <?php
                }
                ?>
                </div>
                <div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                
                <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action('woocommerce_after_shop_loop_item_title');
                ?>
                <div class="cart"><?php do_action('woocommerce_after_shop_loop_item'); ?></div>
                <div class="clear"></div>
            </li>

            <?php endwhile;
        endif;
        wp_reset_query(); ?>
                    </ul>                
            <?php
            echo $endwraping;
        endif;
    }

    function get_product_slider($attr = array()) {

        /**
         * @get_product_slider function
         * element id(id), heading title(title), type = (featured, top rated, recent), number of posts(number)
         *
         */
        global $woocommerce, $wpdb;

        global $smof_data;



        if (!isset($woocommerce))
            return;

        $defaults = array(
            'number' => -1,
            'slider' => true
        );

        $params = wp_parse_args($attr, $defaults);

        extract($params);

        $query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product');

        switch ($type):

            case 'featured':

                $query_args['meta_query'] = $woocommerce->query->get_meta_query();

                $query_args['meta_query'][] = array(
                    'key' => '_featured',
                    'value' => 'yes'
                );

                break;

            case 'top_rated':

                $query_args['meta_query'] = $woocommerce->query->get_meta_query();

                break;

            default:

                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'] = array_filter($query_args['meta_query']);
                break;

        endswitch;

        $q = new WP_Query($query_args);

        if ($q->have_posts()):
            ?>

            <div class="featured-wrap">

                <h2><?php echo $title; ?></h2>

                <div class="product-grid">

                    <div class="woocommerce">

                        <div id="<?php echo $id; ?>" class="products-slider textwidget">

                            <ul class="products">

        <?php
        while ($q->have_posts()): $q->the_post();

            $product_id = get_the_ID();

            $altimgclass = $smof_data['oxy_product_alt_image_setting'] != 0 ? ' havealtimg' : '';
            ?>

                                    <li class="<?php echo $altimgclass ?>">

                                        <div class="pbox">

                <?php do_action('woocommerce_before_shop_loop_item'); ?>

                                            <div class="image">

                                                <a href="<?php the_permalink(); ?>">

                <?php
                do_action('woocommerce_before_shop_loop_item_title');
                ?>                              

                                                </a>      

                                            </div><!--.image -->
                <?php
                $product = get_product($product_id);
                if ($smof_data['oxy_product_alt_image_setting'] == 0) {
                    ?>

                                                <div class="description hidden-phone hidden-tablet">
                    <?php echo apply_filters('woocommerce_short_description', $product->post->post_excerpt) ?>
                                                </div>

                                                <div class="rating hidden-phone hidden-tablet">
                                                    <div id="reviews">
                                                        <div id="comments">                        
                                                            <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                    <?php echo $product->get_rating_html(); ?>
                                                            </div>
                                                        </div><!--#comments-->
                                                    </div><!--#reviews-->
                                                </div><!--.rating-->
                    <?php
                } else {
                    ?>
                                                <div class="description hidden-phone hidden-tablet">
                    <?php
                    $attchments = $product->get_gallery_attachment_ids();

                    if (isset($attchments[0])) {
                        echo wp_get_attachment_image($attchments[0], 'thumbnail', false, array('class' => "product-img-alt attchment-thumbnail"));
                    } else {
                        the_post_thumbnail('thumbnail');
                    }
                    ?>
                                                </div>
            <?php } ?>

                                            <div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

                        <?php
                        do_action('woocommerce_after_shop_loop_item_title');
                        ?>

                                            <div class="cart"><?php do_action('woocommerce_after_shop_loop_item'); ?></div>

                                            <div class="clear"></div>

                                        </div><!--.pbox -->

                                    </li>

                    <?php endwhile; ?>

                            </ul><!--.products -->

                        </div><!--.textwidget -->

                    </div><!--.woocommerce -->

                </div><!--.product-grid-->

            </div><!--.featured-wrap -->

                                    <?php
                                    if ($slider):

                                        if (isset($GLOBALS['elastislides'])):

                                            if (!empty($GLOBALS['elastislides']))
                                                $GLOBALS['elastislides'] .= "#{$id},";
                                            else
                                                $GLOBALS['elastislides'] = "#{$id},";

                                        endif;

                                    endif;

                                endif;
                                wp_reset_query();
                            }

                            add_action('admin_enqueue_scripts', 'oxy_admin_enqueue');

                            function oxy_admin_enqueue() {

                                wp_enqueue_script('jquery');
                            }

                            if (!function_exists('oxy_product_category_markup')) {

                                function oxy_product_category_markup() {

                                    global $smof_data;

                                    global $woocommerce;



                                    if (!isset($woocommerce))
                                        return;
                                    ?>

            <div class="box-content">

                <div class="box-category-home row-fluid">

        <?php
        $args = array('hide_empty' => false, 'parent' => 0);

        $terms = get_terms('product_cat', $args);

        $n = 0;

        $cat_per_row = intval($smof_data['oxy_categories_per_row']);

        if ($cat_per_row == 6)
            $col_class = 2;
        elseif ($cat_per_row == 4)
            $col_class = 3;
        elseif ($cat_per_row == 3)
            $col_class = 4;
        else
            $col_class = 6;


        //$col_class = $cat_per_row == 6 ? 2 : 3;

        $subcat_per_col = intval($smof_data['oxy_subcategories_per_column']);

        if (!empty($terms)): foreach ($terms as $term):

                $term_link = $term_parent_link = get_term_link($term->slug, 'product_cat');

                $thumbnail_id = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);

                $image = wp_get_attachment_image_src($thumbnail_id, 'full');

                $image = $image[0];

                $no_img_class = '';

                if (!$thumbnail_id):

                    $image = sprintf("%s/image/no_image-100x100.png", SWPF_THEME_URI);

                    $no_img_class = "no-cat-img";

                endif;
                ?>                

                            <div class="span<?php echo $col_class ?><?php echo ( $n % $cat_per_row == 0 ) ? " span-first-child" : "" ?>">
                    <?php if ($smof_data['oxy_category_grid_icon_status'] != 0): ?>

                                    <div class="image"><a href="<?php echo $term_link ?>"><img class="<?php echo $no_img_class ?>" src="<?php echo $image; ?>" width="100" height="100" title="<?php echo $term->name ?>" alt="<?php echo $term->name ?>"></a>

                                    </div>

                    <?php endif; ?>

                                <a href="<?php echo $term_link ?>"><?php echo $term->name ?></a>

                    <?php
                    $arg2 = array('hide_empty' => false, 'parent' => $term->term_id, 'number' => $subcat_per_col);

                    $t2 = get_terms('product_cat', $arg2);

                    if (!empty($t2)):
                        ?>

                                    <div>

                                        <ul>

                        <?php
                        foreach ($t2 as $child):

                            $term_link = get_term_link($child->slug, 'product_cat');
                            ?>

                                                <li><a href="<?php echo $term_link ?>"><?php echo $child->name ?> (<?php echo $child->count ?>)</a></li>

                        <?php endforeach; ?>

                                        </ul>

                                    </div>
                                    <div class="all">
                                        <a href="<?php echo $term_parent_link ?>">More</a>
                                    </div>
                    <?php endif; ?>

                            </div><!--.span2 -->

                    <?php
                    $n++;

                endforeach;

            endif;
            ?>

                </div><!--.box-category-home -->

            </div><!--.box-content -->

            <?php
        }

    }

    function blog_one_column_excerpt($content, $len = 20) {

        $arr = explode(" ", $content);

        $cont = '';
        if (count($arr) > $len):

            for ($n = 0; $n < $len; $n++):

                if ($n > 0)
                    $cont .= ' ';

                $cont .= $arr[$n];

            endfor;
            return '<p>' . $cont . '</p><br />';
        endif;
        return "<p>.$content</p><br />";
    }
    
    
    function get_oxy_single_product_cb(){
        global $woocommerce;
        
        if(!isset($_POST['product_id']) || empty($_POST['product_id'])){
            echo json_encode (array('error'=>'Product id not found'));
            die();
        }
        $id = (int) $_POST['product_id'];        
        if(is_numeric($id)){            
            $p = get_post($id);
            if(!empty($p)){
                $link1 = sprintf("<a href='%s'>%s</a>",get_permalink($p->ID),$p->post_title);
                $link2 = sprintf("<a href='%s'>%s</a>!",$woocommerce->cart->get_cart_url(),__('shopping cart','oxy'));
                $output = '<div class="success">';
                $output .= sprintf('%s %s %s %s',__('Success: You have added','oxy'),$link1,__('to your','oxy'),$link2);
                $output .= '<img class="close" alt="" src="'.SWPF_THEME_URI.'/image/close.png" />';
                $output .= '</div>';
                
                echo json_encode(array(
                        'success'=>1,
                        'html'=>$output
                     ));
            }
        }        
        die();
    }
    add_action('wp_ajax_get_oxy_single_product','get_oxy_single_product_cb');
    add_action('wp_ajax_nopriv_get_oxy_single_product','get_oxy_single_product_cb');
    
    function top_cart_script() {
        global $woocommerce;
        if (isset($woocommerce) && get_option('woocommerce_cart_redirect_after_add') != 'yes'):
            ?>

            <script type="text/javascript">

                jQuery(function($) {

                    "use strict";

                    $(document).off("click", ".add_to_cart_button");

                    $(document).on("click", ".add_to_cart_button", function() {
                        //return false;
                        var t = $(this);
                        var product_id = t.attr("data-product_id");
                        
                        if (t.hasClass('product_type_variable') || t.hasClass('product_type_grouped') || $('#header #cart').length < 1) {
                            return true;
                        }

                        t.removeClass("added");
                        t.addClass("loading");
                        var data = {action: "woocommerce_add_to_cart", product_id: t.attr("data-product_id"), quantity: t.attr("data-quantity")};
                        var res = '';
                        var symbol = "<?php echo utf8_encode(get_woocommerce_currency_symbol()) ?>";

                        if ($('input.currency_symbol').length < 1) {

                            $('#footer').append("<input class='currency_symbol' type='hidden' value='" + symbol + "' />");

                        }

                        symbol = $('input.currency_symbol').val();
                        
                        var ajax_url = '<?php echo admin_url('admin-ajax.php')?>';
                        //woocommerce_params.ajax_url
                        $.post(ajax_url, data, function(n) {
                            
                            t.removeClass("loading");                            
                            //console.log(n);
                            $.each(n.fragments, function(k, v) {
                                res = v;
                            });

                            if ($("#footer .top_cart_elem").length > 0) {

                                $("#footer .top_cart_elem").html(res);

                            }

                            else {

                                $("#footer").prepend("<div class='top_cart_elem' style='visibility:hidden;'></div>");

                                $("#footer .top_cart_elem").html(res);

                            }

                            var telem = $('.top_cart_elem');

                            var cart_list = [];

                            var totallen = telem.find('ul.cart_list.product_list_widget li').length;

                            var total = $.trim(telem.find('p.total span.amount').text());

                            var qty = 0;

                            for (var i = 0; i < totallen; i++) {

                                cart_list[i] = [];

                                var li = telem.find('ul.cart_list.product_list_widget li').eq(i);

                                cart_list[i].href = li.find('a').attr('href');

                                cart_list[i].img = li.find('a img').attr('src');

                                cart_list[i].title = $.trim(li.find('a').text());

                                cart_list[i].quantity = li.find('span.quantity').text();

                                qty = cart_list[i].quantity.split(symbol);

                                cart_list[i].quantity = parseInt($.trim(qty[0]), 10);

                                cart_list[i].price = symbol + qty[1];

                            }

                            var thtml = '';

                            var totalq = 0;

                            $.each(cart_list, function(key, value) {

                                thtml += "<tr>";

                                thtml += "<td class='image'><a href='" + value.href + "'><img src='" + value.img + "' class='attachment-shop_thumbnail wp-post-image' width='90' height='90'></a></td>";

                                thtml += "<td class='name'><a href='" + value.href + "'>" + value.title + "</a></td>";

                                thtml += "<td class='quantity buttons_added'>x&nbsp;" + value.quantity + "</td>";

                                thtml += "<td class='total'><span class='amount'>" + value.price + "</span></td>";

                                thtml += "</tr>";

                                totalq += value.quantity;

                            });

                            thtml = '<div class="mini-cart-info"><table>' + thtml + '</table></div>';

                            thtml += '<div class="mini-cart-total"><table><tr><td align="right"><b>Sub-Total:</b></td><td align="right"><span class="amount">' + total + '</span></td></tr><tr><td align="right"><b>Total:</b></td><td align="right"><span class="amount">' + total + '</span></td></tr></table></div>';

                            thtml += '<div class="checkout"><a class="button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php _e('View Cart', 'oxy') ?></a>&nbsp;&nbsp;<a class="button checkout" href="<?php echo $woocommerce->cart->get_checkout_url() ?>"><?php _e('Checkout', 'oxy') ?></a></div>';

                            var itemtext = totalq > 1 ? "<?php _e('items', 'oxy') ?>" : "<?php _e('item', 'oxy') ?>";

                            $("#header #cart .heading div#cart-total").html(totalq + ' ' + itemtext + ' - <span class="amount">' + total + '</span>');

                            $("#header #cart .content").html(thtml);
                            
                            var clicked = {action : 'get_oxy_single_product',product_id : product_id};                            
                            
                            $.post(ajax_url, clicked, function(resp){                                                                
                                if(resp.success !== undefined){
                                    $('#notification').html(resp.html);
                                    $('#notification').find('.success').fadeIn(400,function(){                                        
                                        setTimeout(function() {                                            
                                            $('#notification').find('.success').fadeOut(400);
                                        }, 10000);
                                    });
                                }
                                
                            },'json');
                            
                            
                            
                            setTimeout(function() {
                                $('.add_to_cart_button').removeClass('added');
                            }, 2000);
                            
                            $("#footer .top_cart_elem").html('');

                        });

                        return false;

                    });

                    $('#notification .success .close').live('click',function(){
                        $(this).parent().fadeOut(400);
                    });

                });

            </script>

    <?php
    endif; //if(isset($woocommerce))
}

add_action('wp_footer', 'top_cart_script', 20);

function footer_google_analytics_code() {

    global $smof_data;

    if (empty($smof_data->oxy_general_settings['oxy_google_analytics']))
        return;

    echo $smof_data->oxy_general_settings['oxy_google_analytics'];
}

add_action('wp_footer', 'footer_google_analytics_code', 100);

function get_prev_next_product_object($postid, $dir = 'next') {

    global $wpdb;

    if ($dir == 'prev')
        $sql = "SELECT * FROM $wpdb->posts where post_type = 'product' and post_status = 'publish' and ID < $postid order by ID desc limit 0,1";
    else
        $sql = "SELECT * FROM $wpdb->posts where post_type = 'product' and post_status = 'publish' and ID > $postid order by ID asc limit 0,1";

    $result = $wpdb->get_row($sql);

    if (!is_wp_error($result)):
        if (!empty($result)):
            return $result;
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}

function wcm_sds_single_product_prev_next() {

    global $woocommerce, $post;

    if (!isset($woocommerce) or !is_single())
        return;
    ?>

        <div id="prev-next" class="prev-next">

                    <?php
                    $prev = get_prev_next_product_object($post->ID, 'prev');
                    if (!empty($prev)):
                    ?>
                        <a href="<?php echo get_permalink($prev->ID) ?>" class="product-prev">&nbsp;</a>
                        <a href="<?php echo get_permalink($prev->ID) ?>" class="product-prev-tip"><?php echo $prev->post_title ?></a>
                        
                    <?php
                endif;

                $next = get_prev_next_product_object($post->ID);

                if (!empty($next)):

                    ?>
                        <a href="<?php echo get_permalink($next->ID) ?>" class="product-next">&nbsp;</a>
                        <a href="<?php echo get_permalink($next->ID) ?>" class="product-next-tip"><?php echo $next->post_title ?></a>                        
                <?php
                endif;
                ?>

        </div><!--#prev-next -->

    <?php
}

add_action('oxy_single_product_prev_next', 'wcm_sds_single_product_prev_next');



function remove_sorting_action_from_brands_list() {

    $tax = get_query_var('taxonomy');

    $tax = $tax == 'brands' ? $tax : false;

    if ($tax)
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}

add_action('template_redirect', 'remove_sorting_action_from_brands_list');

function get_brands_carousel() {

    global $woocommerce, $smof_data;

    if (!isset($woocommerce) or $smof_data['oxy_show_brands'] != 1)
        return;

    $taxonomy = 'brands';

    $args = array('hide_empty' => false);

    $terms = get_terms($taxonomy, $args);

    if (!empty($terms)):
        ?>

            <section id="homepage-brands-wall" class="span">

        <?php
        if ($smof_data['oxy_brands_wall_status'] != 1):

            $pref = '<div class="es-carousel-banners-wrapper"><div id="carouselbanners" class="es-carousel-banners"><ul>';

            $suff = '</ul></div>';

        else:

            $pref = '';

            $suff = '';

        endif;

        echo $pref;

        foreach ($terms as $c => $term):

            $attach_id = wcm_sds_brands_thumbnail_id($term->term_id);

            if ($attach_id):

                $image = wp_get_attachment_image_src($attach_id, 'full');

                $image = $image[0];
                ?>

                <?php if ($smof_data['oxy_brands_wall_status'] != 1): ?>

                            <li><a href="<?php echo get_term_link($term->slug, $taxonomy) ?>"><img src="<?php echo $image ?>"  alt="<?php echo $term->name ?>" title="<?php echo $term->name ?>" width="133" /></a></li>        

                <?php
                else:

                    $bpr = $smof_data['oxy_brands_per_row'];
                    $class = $bpr == 4 ? "span3" : "span2";
                    $class .= (($c % $bpr) == 0) ? " span-first-child" : "";
                    ?>

                            <div class="<?php echo $class ?> brand-wall-item">
                                <div class="image">
                                    <a href="<?php echo get_term_link($term->slug, $taxonomy) ?>">
                                        <img title="<?php echo $term->name ?>" alt="<?php echo $term->name ?>" src="<?php echo $image ?>">
                                    </a>
                                </div><!--.image -->
                            </div>
                <?php endif; ?>
                <?php
            endif;
        endforeach;
        ?>  
        <?php echo $suff; ?>
            </div><!--.es-carousel-banners -->

        </section>

        <?php
    endif;
}

function oxy_product_brand_logo(){
    global $woocommerce, $product, $post, $smof_data;
    if(!isset($woocommerce) || !isset($product) || !is_singular('product')) return;
    
    $terms = wp_get_post_terms($product->id,'brands');    
    if(!empty($terms)):
        $term = $terms[0];
        $attach_id = wcm_sds_brands_thumbnail_id($term->term_id);	
        $image = wp_get_attachment_url($attach_id);	
        //$term = get_term($term_id,'brands');
        ?>        
        <div class="product-right-sm-logo">   
            <a href="<?php echo get_term_link($term,'brands');?>">
                <?php echo '<img src="'.$image.'" alt="'.$term->name.'" />';?>
            </a>
        </div>        
        <?php
        
    endif;
}
function oxy_product_tags(){
    global $woocommerce, $product, $smof_data;
    
    $tags = wp_get_post_terms($product->id,'product_tag');
    if(empty($tags)) return;
    ?>
        <div class="product-right-sm-tags">  
            <h5><?php _e('Tags:','oxy'); ?></h5>
              <?php foreach ($tags as $tag) { ?>             
              <div><a href="<?php echo get_term_link($tag,'product_tag'); ?>"><?php echo $tag->name; ?></a></div>              
              <?php } ?>
        </div>
    <?php
}

//add_action('woocommerce_right_sm_product_summary', 'oxy_product_tags', 3);

if (!function_exists('get_oxy_blog_short_text')) {
    function get_oxy_blog_short_text($content) {
        /*
         * Developed in contrast of WP Ver 3.8
         */
        preg_match('/\"((.*?)#more-([0-9]+?))\"/', $content,$readmore);        
        $cont = preg_replace('/\[[^\]]*\]/', '', $content);        
        $cont = str_replace('(more&hellip;)', '', $cont);       
        $cont = "<p>" . strip_tags($cont) . "</p>";
        if(isset($readmore[1]))
            $cont .= '<a class="readmore" href="'.$readmore[1].'">'.__('Read More&nbsp;<i class="dashicons dashicons-arrow-right-alt"></i>','oxy').'</a>';
        return $cont;
        
    }
}

function oxy_get_product_prices($product){
    
    $tax_display_mode      = get_option( 'woocommerce_tax_display_shop' );
    $display_price         = $tax_display_mode == 'incl' ? $product->get_price_including_tax() : $product->get_price_excluding_tax();
    $display_regular_price = $tax_display_mode == 'incl' ? $product->get_price_including_tax( 1, $product->get_regular_price() ) : $product->get_price_excluding_tax( 1, $product->get_regular_price() );
    $display_sale_price    = $tax_display_mode == 'incl' ? $product->get_price_including_tax( 1, $product->get_sale_price() ) : $product->get_price_excluding_tax( 1, $product->get_sale_price() );
    
    switch($product->product_type){
        case 'variable':            
            $price = $product->get_variation_regular_price( 'min', true );
            $sale = $display_price;            
            break;
        case 'simple':            
            $price = $display_regular_price;
            $sale = $display_sale_price;
            break;
    }
    
    if(isset($sale) && !empty($sale) && isset($price) && !empty($price))
        return array('sale' => $sale, 'price' => $price);
    
    return FALSE;
    
}

function oxy_product_special_price_calc($data){ //sale and price
    
    if(!empty($data))
        extract($data);
    
    
    $prefix = '';
    if(isset($sale) && !empty($sale) && isset($price) && !empty($price)){
        if($price > $sale){
            $prefix = '-';
            $dval = $price - $sale;
            $percent = ( $dval / $price ) * 100;
        }
    }
    
    if(isset($percent) && !empty($percent))
        return array( 'prefix' => $prefix, 'percent' => round($percent,1));
    
    return false;
    
}


function oxy_deduction_percent(){
    
    global $product;
    
    if(!$product->is_on_sale()) return false;
    
    $prices = oxy_get_product_prices($product);    
    $returned = oxy_product_special_price_calc($prices);
    
    if(!empty($returned))
        extract($returned);
    
    if(isset($percent) && !empty($percent))
        echo "<div class=\"saved\"><span class=\"you-save\">".__('Save:','oxy')."</span><span class=\"save-percent\">{$percent}%</span></div>";
    
     
}


function oxy_get_bg_pattern_by_id($id){
    if(empty($id)) return false;
    
    preg_match('/\d+/',$id,$match);
    if(!isset($match[0])) return false;
    
    $id = $match[0];
    $id = (int) $id;
    $src = false;
    $theme_dir = get_template_directory();
    if((int) $id > 0){
        if($id > 75 && file_exists("{$theme_dir}/image/patterns/non_transparent/p{$id}.png")){
            $src = SWPF_THEME_URI."/image/patterns/non_transparent/p{$id}.png";   
        }
        elseif(file_exists("{$theme_dir}/image/patterns/transparent/p{$id}.png")){
            $src = SWPF_THEME_URI."/image/patterns/transparent/p{$id}.png";
        }
    }
    return $src;

}
function oxy_blog_read_more($more){    
    return '';    
}

add_action('excerpt_more','oxy_blog_read_more');