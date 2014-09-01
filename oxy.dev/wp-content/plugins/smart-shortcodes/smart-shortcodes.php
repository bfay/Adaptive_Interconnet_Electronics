<?php
/**
 * Plugin Name: OXY Shortcodes
 * 
 * Description: OXY Shortcodes plugin for wordpress
 * Version: 1.0
 * Author: Smartdatasoft
 * Author URI: http://www.smartdatasoft.com/
 * Requires at least: 3.5
 * Tested up to: 3.6
 *
 * Text Domain: smart
 * Domain Path: /i18n/languages/
 *
 * @package smart
 * @category Core
 * @author Smartdatasoft
 */
 
function smart_shortcodes_activation() {
	
}
register_activation_hook(__FILE__, 'smart_shortcodes_activation');

function smart_shortcodes_deactivation() {
	
}

register_deactivation_hook(__FILE__, 'smart_shortcodes_deactivation');

if(!class_exists('smartShortcodes')):
	
	class smartShortcodes{
		
		public static $plugindir, $pluginurl;
		
		function __construct(){
			
			smartShortcodes::$plugindir = dirname(__FILE__);
			
			smartShortcodes::$pluginurl = plugins_url('',__FILE__);
			
			add_action( 'admin_enqueue_scripts', array($this,'load_smart_shortcodes_admin_scripts') );
					
			add_action( 'init', array($this,'smart_shortcode_button') );
			
			add_action( 'wp_enqueue_scripts', array($this,'load_smart_shortcodes_styles'), 19 );
			
                        add_action( 'init', array($this,'register_oxy_testimonial_postype') );
                        
                        add_action('admin_init', array($this,'add_oxy_testimonial_meta_field'));
                        
                        add_action('save_post', array($this,'save_testimonial_meta'));
			
                        
		}
		
		function load_smart_shortcodes_admin_scripts(){
			
			wp_enqueue_script('jquery');
			
		}
		

		function smart_shortcode_button() {
		
			if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		
				return;
		
			// Add only in Rich Editor mode
		
			if ( get_user_option('rich_editing') == 'true') {
		
				add_filter("mce_external_plugins", array($this,"smart_add_shortcode_tinymce_plugin"));
		
				add_filter('mce_buttons', array($this,'smart_register_shortcode_button'));
		
			}
		
		}
		
		/**
		 * Register the TinyMCE Shortcode Button
		 */
		
		function smart_register_shortcode_button($buttons) {
		
			array_push($buttons, "|", "smartshortcodes");
		
			return $buttons;
		
		}
		
		/**
		 * Load the TinyMCE plugin: shortcode_plugin.js
		 */
		
		function smart_add_shortcode_tinymce_plugin($plugin_array) {	
		
		   $plugin_array['smartshortcodes'] = smartShortcodes::$pluginurl . '/assets/js/shortcode_plugin.js';
		
		   return $plugin_array;
		
		}

		function load_smart_shortcodes_styles(){
			
			wp_enqueue_style( 'smart-shortcodes', smartShortcodes::$pluginurl . '/assets/css/shortcode-styles.css', '', '1.0' );
			
			
			
		}
		
                
                

            function register_oxy_testimonial_postype() {

                $labels = array(
                    'name' => __( 'Testimonial','oxy'),
                    'singular_name' => __( 'Testimonial','oxy' ),
                    'add_new' => __('Add New','oxy'),
                    'add_new_item' => __('Add New Testimonial','oxy'),
                    'edit_item' => __('Edit Testimonial','oxy'),
                    'new_item' => __('New Testimonial','oxy'),
                    'view_item' => __('View Testimonial','oxy'),
                    'search_items' => __('Search Testimonial','oxy'),
                    'not_found' =>  __('No Testimonial found','oxy'),
                    'not_found_in_trash' => __('No Testimonial found in Trash','oxy'),
                    'parent_item_colon' => ''
                );

                $args = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'query_var' => true,        
                    'rewrite' => true,
                    'capability_type' => 'post',
                    'hierarchical' => false,        
                    'supports' => array('title','editor', 'thumbnail'),
                    'rewrite' => array( 'slug' => __('testimonial', 'oxy') )
                );

                register_post_type( 'oxy-testimonial', $args);

            }

            

            function add_oxy_testimonial_meta_field() {
                add_meta_box('oxy_testimonial_meta_fields', __('Manage Testimonial Meta Fields', 'oxy'), array($this,'testimonial_metabox_cb'), 'oxy-testimonial', 'normal', 'core');
            }

            function testimonial_metabox_cb($post){

                echo '<input type="hidden" name="oxy-testimonial-nonce" id="oxy-testimonial-nonce" value="' . wp_create_nonce('oxy-testimonial-nonce') . '" />';

                $testimonial_metas = get_post_meta($post->ID, 'testimonial-metas', true);
                if (!empty($testimonial_metas)) {
                    $testimonial_metas = json_decode($testimonial_metas, true);
                }
                ?>

                <table cellspacing="0" cellpadding="0" border="0" class="testimonial-meta-table">
                    <tr><td>Testimonial author name:</td><td><input type="text" name="testimonial-author" value="<?php echo isset($testimonial_metas["testimonial-author"]) ? urldecode($testimonial_metas["testimonial-author"]) : '' ?>" /></td></tr>        
                </table>
                <?php

            }

            function save_testimonial_meta($post_id) {


                if (!isset($_POST['oxy-testimonial-nonce']) || !wp_verify_nonce($_POST['oxy-testimonial-nonce'], 'oxy-testimonial-nonce')) 
                    return $post_id;

                if (!current_user_can('edit_post', $post_id))
                    return $post_id;

                $testimonial_metas = array();

                foreach($_POST as $key=>$field){        
                    if(strpos($key,'testimonial-') !== FALSE){            
                        $testimonial_metas[$key] = !empty($field)? urlencode($field) : '' ;
                    }        
                }    
                update_post_meta($post_id, 'testimonial-metas', json_encode($testimonial_metas));
            }

	
	}
	

	$smartShortcodes = new smartShortcodes();
			
	require_once( smartShortcodes::$plugindir . "/lib/shortcodes.php" );
	
endif;


?>