<?php

require_once( WPV_PATH_EMBEDDED . '/common/visual-editor/editor-addon.class.php');
require_once( WPV_PATH_EMBEDDED . '/common/views/promote.php');
if ( !defined( 'WPT_LOCALIZATION' ) ) {
	require_once( WPV_PATH_EMBEDDED . '/common/localization/wpt-localization.php' );
}
if ( !defined( 'ADODB_DATE_VERSION' ) ) {
	if ( defined( 'WPTOOLSET_FORMS_ABSPATH' ) ) {
		require_once WPTOOLSET_FORMS_ABSPATH . '/lib/adodb-time.inc.php';
	}
}

require WPV_PATH_EMBEDDED . '/inc/wpv-filter-query.php';

class WP_Views{

    function __construct(){

        add_action('init', array($this, 'init'));
        add_action('widgets_init', array($this, 'widgets_init'));

        $this->options = null;
        $this->view_ids = array();
        $this->current_view = null;
        $this->CCK_types = array();
		$this->widget_view_id = 0;
		$this->view_depth = 0;
        $this->view_count = array();
        $this->set_view_counts = array();
		$this->view_shortcode_attributes = array();
		$this->view_used_ids = array();
		$this->rendering_views_form_in_progress = false;

        $this->post_query = null;
		$this->post_query_stack = array();
		$this->top_current_page = null;
        $this->current_page = array();

		$this->taxonomy_data = array();
		$this->parent_taxonomy = 0;
		
		$this->users_data = array();
		$this->parent_user = 0;

		$this->variables = array();
		
		$this->force_disable_dependant_parametric_search = false;
		$this->returned_ids_for_parametric_search = array();

        /*
		* Compatibility
		*/
		// WPML
        add_filter( 'icl_cf_translate_state', array( $this, 'custom_field_translate_state' ), 10, 2 );
		// WooCommerce
		add_filter( 'woocommerce_product_add_to_cart_url', array( $this, 'wpv_woocommerce_product_add_to_cart_url' ), 10, 2 );

    }


    function __destruct(){

    }

    function init(){

        $this->wpv_register_type_view();
        
        if(is_admin()){
			add_action( 'admin_enqueue_scripts', array( $this,'wpv_admin_enqueue_scripts' ) );
		}

        add_action('wp_ajax_wpv_get_type_filter_summary', 'wpv_ajax_get_type_filter_summary');
        add_action('wp_ajax_wpv_get_table_row_ui', array($this, 'ajax_get_table_row_ui'));
        add_action('wp_ajax_wpv_add_custom_field', 'wpv_ajax_add_custom_field');
        add_action('wp_ajax_wpv_add_taxonomy', 'wpv_ajax_add_taxonomy');
        add_action('wp_ajax_wpv_pagination', 'wpv_ajax_pagination');
        add_action('wp_ajax_wpv_views_editor_height', array($this, 'save_editor_height'));
        add_action('wp_ajax_wpv_get_posts_select', 'wpv_get_posts_select');
        add_action('wp_ajax_wpv_get_taxonomy_parents_select', 'wpv_get_taxonomy_parents_select');
        add_action('wp_ajax_wpv_get_taxonomy_term_check', 'wpv_get_taxonomy_term_check');
        add_action('wp_ajax_wpv_get_taxonomy_term_summary', 'wpv_ajax_get_taxonomy_term_summary');
        add_action('wp_ajax_wpv_get_post_relationship_info', 'wpv_ajax_wpv_get_post_relationship_info');
		// AJAX calls to insert View forms shortcode
		add_action('wp_ajax_wpv_view_form_popup', 'wpv_ajax_wpv_view_form_popup');
		// AJAX calls to insert View Search term shortcode
		add_action('wp_ajax_wpv_search_term_popup', 'wpv_ajax_wpv_search_term_popup');
		// AJAX calls to insert Translatable String shortcode
		add_action('wp_ajax_wpv_translatable_string_popup', 'wpv_ajax_wpv_translatable_string_popup');
		// AJAX calls for the Settings page
		add_action('wp_ajax_wpv_save_theme_debug_settings', array($this, 'wpv_save_theme_debug_settings'));
		add_action('wp_ajax_wpv_save_wpml_settings', array($this, 'wpv_save_wpml_settings'));
		add_action('wp_ajax_wpv_get_show_hidden_custom_fields', array($this, 'wpv_get_show_hidden_custom_fields'));
		add_action('wp_ajax_wpv_update_custom_inner_shortcodes', array($this, 'wpv_update_custom_inner_shortcodes'));
		add_action('wp_ajax_wpv_update_custom_conditional_functions', array($this, 'wpv_update_custom_conditional_functions'));
		add_action('wp_ajax_wpv_update_map_plugin_status', array($this, 'wpv_update_map_plugin_status'));
		add_action('wp_ajax_wpv_update_bootstrap_version_status', array($this, 'wpv_update_bootstrap_version_status'));
		add_action('wp_ajax_wpv_update_show_edit_view_link_status', array($this, 'wpv_update_show_edit_view_link_status'));
		add_action('wp_ajax_wpv_update_debug_mode_status', array($this, 'wpv_update_debug_mode_status'));
		add_action('wp_ajax_wpv_switch_debug_check', array($this, 'wpv_switch_debug_check'));
		// AJAX calls for date filters
		add_action('wp_ajax_wpv_format_date', array($this, 'wpv_format_date'));
		add_action('wp_ajax_nopriv_wpv_format_date', array($this, 'wpv_format_date'));

        add_action('wp_ajax_wpv_view_media_manager', array($this, 'wp_ajax_wpv_view_media_manager')); // NOTE this should be DEPRECATED

        if(is_admin()){

            if (function_exists('wpv_admin_menu_import_export_hook')) {
                add_action('wp_loaded', 'wpv_admin_menu_import_export_hook');
            }

            add_action('admin_menu', array($this, 'admin_menu'), 20);
            add_action('admin_head', array($this, 'settings_box_load'));
        //    add_action('admin_footer', array($this, 'hide_view_body_controls'));// DEPRECATED
            add_action('save_post', array($this, 'save_view_settings'));

            global $pagenow;

            if($pagenow == 'post.php' ||
			   $pagenow == 'post-new.php' ||
			   ($pagenow == 'admin.php' && isset($_GET['page']) && $_GET['page'] == 'dd_layouts_edit')){
                add_action('admin_head', array($this,'post_edit_tinymce'));
            //    add_action('admin_head', array($this,'add_css')); // TODO DEPRECATED this is not used anymore
            //    add_action('admin_print_scripts', array($this,'add_js')); // TODO DEPRECATED this is not used anymore

				add_action('icl_post_languages_options_after', array($this, 'language_options'));
                add_action('admin_head', array($this, 'set_editor_height'));

            }

            global $wp_version;
            if (version_compare($wp_version, '3.3', '<')) {
                add_filter('contextual_help', array($this, 'admin_plugin_help'), 10, 3);
            }

            promote_types_and_views();
            
            // Add action to be executed on plugins_loaded in Views taxonomy-related View loops admin GUIs
            
            add_filter( 'wpv_admin_exclude_tax_slugs', 'wpv_admin_exclude_tax_slugs' );

        } else {

            // Add scripts and styles to the frontend
			add_action('wp_enqueue_scripts', array($this, 'wpv_frontend_enqueue_scripts'));

            add_action('wp_footer', array($this, 'wpv_meta_html_extra_css'), 5); // Set priority lower than 20, so we load the CSS before the footer scripts and avoid the bottleneck
			add_action('wp_footer', array($this, 'wpv_meta_html_extra_js'), 25); // Set priority higher than 20, when all the footer scripts are loaded

        }

         /*shorttags*/
        add_shortcode( 'wpv-view', array($this, 'short_tag_wpv_view') );
        add_shortcode( 'wpv-form-view', array($this, 'short_tag_wpv_view_form') );

		add_filter('edit_post_link', array($this, 'edit_post_link'), 10, 2);


        // check for views import.

        global $wpv_theme_import, $wpv_theme_import_xml;
        if (isset($wpv_theme_import) && $wpv_theme_import != '') {
            include $wpv_theme_import;

            $dismissed = get_option('wpv-dismissed-messages', array());
			if ( empty( $dismissed ) ) {
				$dismissed = get_option('views_dismissed_messages', array());
			}
            if (!in_array($timestamp, $dismissed)) {
                if ($timestamp > get_option('views-embedded-import', 0)) {
                    // something new to import.
                    if ($auto_import) {
                        if (!isset($_POST['import'])) {
                            // setup an automatic import
                            $_POST['import'] = __('Import', 'wpv-views');
                            $_POST['wpv-import-nonce'] = wp_create_nonce('wpv-import-nonce');
                            $_POST['views-overwrite'] = 'on';
                            $_POST['view-templates-overwrite'] = 'on';
                            $_POST['import-file'] = $wpv_theme_import_xml;
                        }
                    } else {
                        global $pagenow;
                        if ($pagenow != 'options-general.php' || !isset($_GET['page']) || $_GET['page'] != 'wpv-import-theme') {

                            // add admin message about importing.
                            $link = '<a href=\"' . admin_url('options-general.php') . '?page=wpv-import-theme\">';
                            $text = sprintf(__('You have <strong>Views</strong> import pending. %sClick here to import%s | %sDismiss this message%s', 'wpv-views'),
									$link,
									'</a>',
                                    '<a class=\"js-wpv-embedded-import-dismiss\" onclick=\"var data = {action: \'wpv_dismiss_message\', message_id: \'embedded-import-' . $timestamp . '\', timestamp: ' . $timestamp . ', _wpnonce: \'' . wp_create_nonce("dismiss_message") . '\'};jQuery.get(ajaxurl, data, function(response) {jQuery(\'.js-wpv-embedded-import-dismiss\').parent().parent().fadeOut();});return false;\" href=\"#\">',
									'</a>'
							);
                            $code = 'echo "<div class=\"message updated\"><p>' . $text . '</p></div>";';
                            add_action('admin_notices', create_function('$a=1', $code));
                        }

                    }
                }
            }

			add_action('admin_menu', array($this, 'add_import_menu')); // TODO check where we put this
		}
    }

    function wpv_register_type_view()
    {
      $labels = array(
        'name' => _x('Views', 'post type general name'),
        'singular_name' => _x('View', 'post type singular name'),
        'add_new' => _x('Add New', 'book'),
        'add_new_item' => __('Add New View', 'wpv-views'),
        'edit_item' => __('Edit View', 'wpv-views'),
        'new_item' => __('New View', 'wpv-views'),
        'view_item' => __('View Views', 'wpv-views'),
        'search_items' => __('Search Views', 'wpv-views'),
        'not_found' =>  __('No views found', 'wpv-views'),
        'not_found_in_trash' => __('No views found in Trash', 'wpv-views'),
        'parent_item_colon' => '',
        'menu_name' => 'Views'

      );
      $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => false,
        'show_in_menu' => false,
        'query_var' => false,
        'rewrite' => false,
        'can_export' => false,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 80,
        'supports' => array('title','editor','author')
      );
      register_post_type('view',$args);
    }

    function custom_field_translate_state($state, $field_name) {
        switch($field_name) {
            case '_wpv_settings':
            case '_wpv_layout_settings':
            case '_wpv_view_sync':
                return 'ignore';

            default:
                return $state;
        }
    }

	// Add WPML sync options.

	function language_options() {

        // not needed for theme version.

	}
	
	//Fix malformed add to cart URL in Views AJAX pagination and automatic results in a parametric search
	//https://icanlocalize.basecamphq.com/projects/11629195-toolset-peripheral-work/todo_items/186738278/comments
	function wpv_woocommerce_product_add_to_cart_url( $add_to_cart_url, $wc_prod_object ) {
		if (
			strpos( $add_to_cart_url, 'wpv-ajax-pagination' ) !== false
			|| ( defined('DOING_AJAX') && DOING_AJAX && isset( $_REQUEST['action'] ) && $_REQUEST['action']  == 'wpv_update_filter_form'  )
		) {
			$parsed = array();
			$parsed = parse_url( $add_to_cart_url );
			if ( isset( $parsed['query'] ) ) {
				wp_parse_str( $parsed['query'], $parsed_query );
				// Only alter the URL if it already contains a numeric add-to-cart parameter
				if ( isset( $parsed_query['add-to-cart'] ) && is_numeric( $parsed_query['add-to-cart'] ) ) {
					// If the product is a variation, we need to handle the variation_id parameter too
					if (
						isset( $wc_prod_object->product_type )
						&& $wc_prod_object->product_type == 'variation'
						&& isset( $wc_prod_object->variation_id )
						&& isset( $wc_prod_object->variation_data )
					) {
						$query_args_to_add = array_merge( array( 'variation_id' => $wc_prod_object->variation_id ), $wc_prod_object->variation_data );
					} else {
						$query_args_to_add = array();
					}
					// Build the base URL, it should have a referrer being the actual current page
					if ( wp_get_referer() ) {
						$base_url = wp_get_referer();
					} else {
						$base_url = get_home_url();
					}echo $base_url;
					// Modify the URL
					$query_args_to_add['add-to-cart'] = $parsed_query['add-to-cart'];
					$add_to_cart_url = remove_query_arg( 'added-to-cart', add_query_arg( $query_args_to_add, $base_url ) );
				}
			}
		}
		return $add_to_cart_url;
	}

    function widgets_init(){
        register_widget('WPV_Widget');
        register_widget('WPV_Widget_filter');
    }

    function register_CCK_type($type) {
        $this->CCK_types[] = $type;
    }

    function can_include_type($type) {
        return !in_array($type, $this->CCK_types);
    }
	
	/**
	* admin_menu
	*
	* Creates the admin menus and submenus items when using the embedded version
	*
	* @since unknown
	*/

    function admin_menu() {
		// Make readonly versions available when pointing to the right URL
		// Module Manager can offer that link for Module Libraries installed
		$cap = 'manage_options';
		if ( defined( 'MODMAN_CAPABILITY' ) && isset( $_GET['page'] ) && 'views-embedded' == $_GET['page'] ) {
			add_submenu_page( 'ModuleManager_Modules', __( 'Embedded View', 'wpv-views' ), __( 'Embedded View', 'wpv-views'), MODMAN_CAPABILITY, 'views-embedded', 'views_embedded_html' );
		} else if ( isset( $_GET['page'] ) && 'views-embedded' == $_GET['page'] ) {
			// DEVCYCLE this should not be in the tools.php menu at all
			add_submenu_page( 'admin.php', __( 'Embedded View', 'wpv-views' ), __( 'Embedded View', 'wpv-views' ), $cap, 'views-embedded', 'views_embedded_html');
		}
		
		if ( defined( 'MODMAN_CAPABILITY' ) && isset( $_GET['page'] ) && 'view-templates-embedded' == $_GET['page'] ) {
			add_submenu_page( 'ModuleManager_Modules', __( 'Embedded Content Template', 'wpv-views' ), __( 'Embedded Content Template', 'wpv-views'), MODMAN_CAPABILITY, 'view-templates-embedded', 'content_templates_embedded_html' );
		} else if ( isset( $_GET['page'] ) && 'view-templates-embedded' == $_GET['page'] ) {
			// DEVCYCLE this should not be in the tools.php menu at all
			add_submenu_page( 'admin.php', __( 'Embedded Content Template', 'wpv-views' ), __( 'Embedded Content Template', 'wpv-views' ), $cap, 'view-templates-embedded', 'content_templates_embedded_html');
		}
		
		if ( defined( 'MODMAN_CAPABILITY' ) && isset( $_GET['page'] ) && 'view-archives-embedded' == $_GET['page'] ) {
			add_submenu_page( 'ModuleManager_Modules', __( 'Embedded WordPress Archive', 'wpv-views' ), __( 'Embedded WordPress Archive', 'wpv-views'), MODMAN_CAPABILITY, 'view-archives-embedded', 'view_archives_embedded_html' );
		} else if ( isset( $_GET['page'] ) && 'view-archives-embedded' == $_GET['page'] ) {
			// DEVCYCLE this should not be in the tools.php menu at all
			add_submenu_page( 'admin.php', __( 'Embedded WordPress Archive', 'wpv-views' ), __( 'Embedded WordPress Archive', 'wpv-views' ), $cap, 'view-archives-embedded', 'view_archives_embedded_html');
		}
    }

    function add_import_menu() {
        add_options_page(__('Import Views for theme', 'wpv-views'), 'Import Views', 'manage_options', 'wpv-import-theme', array($this, 'import_views_from_theme'));
    }

    function import_views_from_theme() {

        global $wpv_theme_import_xml;

        global $import_errors, $import_messages;
		if (isset($_POST['import']) && $_POST['import'] == __('Import', 'wpv-views') &&
			wp_verify_nonce($_POST['wpv-import-nonce'], 'wpv-import-nonce') &&
			!$import_errors)

			{
			?>

			<div class="wrap">

				<div id="icon-views" class="icon32"><br /></div>
				<h2><?php _e('Views Import', 'wpv-views') ?></h2>

				<br />

				<h3><?php _e('Views import complete', 'wpv-views') ?></h3>

			</div>

			<?php
		} else {
			?>

			<div class="wrap">

				<div id="icon-views" class="icon32"><br /></div>
				<h2><?php _e('Views Import', 'wpv-views') ?></h2>

				<br />

				<?php wpv_admin_import_form($wpv_theme_import_xml); ?>

			</div>

			<?php
		}
    }

    function settings_box_load(){
		global $pagenow;
        if ($pagenow == 'options-general.php' && isset($_GET['page']) && $_GET['page'] == 'wpv-import-theme') {
            $this->include_admin_css();
        }
    }

    function include_admin_css() {
        $link_tag = '<link rel="stylesheet" href="'. WPV_URL . '/res/css/wpv-views.css?v='.WPV_VERSION.'" type="text/css" media="all" />';
        echo $link_tag;
    }

    
    function save_view_settings($post_id){
        // do nothing in the theme version.
    }


    function get_view_id($atts){
        global $wpdb;

        extract(
            shortcode_atts( array(
                'id'    => false,
                'name'  => false
            ), $atts )
        );

        if(empty($id) && !empty($name)){
            // lookup by post title first
            $id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type='view' AND post_title=%s", $name));
            if (!$id) {
                // try the post name
                $id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type='view' AND post_name=%s", $name));
            }
        }

		return $id;
	}

    /**
     * Process the view shortcode
     *
     * eg. [wpv-view name='my-view']
     *
     */

    function short_tag_wpv_view($atts){

        global $wplogger, $WPVDebug;
        $wplogger->log($atts);
        
        apply_filters('wpv_shortcode_debug','wpv-view', json_encode($atts), '' , 'Output shown in the Nested elements section');

		$id = $this->get_view_id($atts);

        if(empty($id)){
            return sprintf('<!- %s ->', __('View not found', 'wpv-views'));
        }

        $this->view_used_ids[] = $id;

		array_push($this->view_shortcode_attributes, $atts);
        $out = $this->render_view_ex($id, md5(serialize($atts)));
		array_pop($this->view_shortcode_attributes);
        return $out;

    }

    /**
     * Process the view shortcode
     *
     * eg. [wpv-form-view name='my-view' target_id='xx']
     *
     */

    function short_tag_wpv_view_form($atts){
        global $wpdb, $sitepress;

        global $wplogger;
        $wplogger->log($atts);
        
        apply_filters('wpv_shortcode_debug','wpv-form-view', json_encode($atts), '', 'Output shown in the Nested elements section');

        extract(
            shortcode_atts( array(
                'id'    => false,
                'name'  => false,
				'target_id' => ''
            ), $atts )
        );

        if(empty($id) && !empty($name)){
            // lookup by post name first
            $id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type='view' AND post_name=%s", $name));
            if (!$id) {
                // try the post title
                $id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type='view' AND post_title=%s", $name));
            }
        }

        if(empty($id)){
            return sprintf('<!- %s ->', __('View not found', 'wpv-views'));
        }

        $this->view_used_ids[] = $id;
		
		//$this->returned_ids_for_parametric_search = array();

		$this->rendering_views_form_in_progress = true;

		$out = '';

        $view_settings = $this->get_view_settings($id);
	    if (isset($view_settings['filter_meta_html'])) {
			
			$this->view_depth++;
			array_push($this->view_ids, $this->current_view);
			$this->current_view = $id;
			
			// increment the view count.
			if (!isset($this->view_count[$this->view_depth])) {
				$this->view_count[$this->view_depth] = 0;
			}
			$this->view_count[$this->view_depth]++;
			
			$form_class = array();
			// Dependant stuf
			$dps_enabled = false;
			$counters_enabled = false;
			if ( !isset( $view_settings['dps'] ) || !is_array( $view_settings['dps'] ) ) {
				$view_settings['dps'] = array();
			}
			if ( isset( $view_settings['dps']['enable_dependency'] ) && $view_settings['dps']['enable_dependency'] == 'enable' ) {
				$dps_enabled = true;
				$controls_per_kind = wpv_count_filter_controls( $view_settings );
				$controls_count = 0;
				$no_intersection = array();
				if ( !isset( $controls_per_kind['error'] ) ) {
				//	$controls_count = array_sum( $controls_per_kind );
					$controls_count = $controls_per_kind['cf'] + $controls_per_kind['tax'] + $controls_per_kind['pr'];
					if ( $controls_per_kind['cf'] > 1 && ( !isset( $view_settings['custom_fields_relationship'] ) || $view_settings['custom_fields_relationship'] != 'AND' ) ) {
						$no_intersection[] = __( 'custom field', 'wpv-views' );
					}
					if ( $controls_per_kind['tax'] > 1 && ( !isset( $view_settings['taxonomy_relationship'] ) || $view_settings['taxonomy_relationship'] != 'AND' ) ) {
						$no_intersection[] = __( 'taxonomy', 'wpv-views' );
					}
				} else {
					$dps_enabled = false;
				}
				if ( $controls_count > 0 ) {
					if ( count( $no_intersection ) > 0 ) {
						$dps_enabled = false;
					}
				} else {
					$dps_enabled = false;
				}
			}
			if ( !isset( $view_settings['filter_meta_html'] ) ) {
				$view_settings['filter_meta_html'] = '';
			}
			if ( strpos( $view_settings['filter_meta_html'], '%%COUNT%%' ) !== false ) {
				$counters_enabled = true;
			}
			if ( $dps_enabled || $counters_enabled ) {
				if ( $dps_enabled ) {
					$form_class[] = 'js-wpv-dps-enabled';
					$form_class[] = 'js-wpv-dps-only-form';
				}
				wpv_filter_extend_query_for_parametric_and_counters( array(), $view_settings, $id );
			} else {
				// Set the force value
				$this->set_force_disable_dependant_parametric_search( true );
			}
			if ( !isset( $view_settings['dps']['spinner'] ) ) {
				$view_settings['dps']['spinner'] = 'none';
			}
			$spinner_image = '';
			if ( $view_settings['dps']['spinner'] == 'custom' ) {
				if ( isset( $view_settings['dps']['spinner_image_uploaded'] ) ) {
					$spinner_image = $view_settings['dps']['spinner_image_uploaded'];
				}
			} else if ( $view_settings['dps']['spinner'] == 'inhouse' ) {
				if ( isset( $view_settings['dps']['spinner_image'] ) ) {
					$spinner_image = $view_settings['dps']['spinner_image'];
				}
			}
			
			$page = 1;
			
			$effect = 'fade';
			$spinner = $view_settings['dps']['spinner'];
			$ajax_before = '';
			if ( isset( $view_settings['dps']['ajax_results_before'] ) ) {
				$ajax_before = esc_attr( $view_settings['dps']['ajax_results_before'] );
			}
			$ajax_after = '';
			if ( isset( $view_settings['dps']['ajax_results_after'] ) ) {
				$ajax_after = esc_attr( $view_settings['dps']['ajax_results_after'] );
			}
			
			$url = get_permalink($target_id);
			if(isset($sitepress)){
				// Dirty hack to be able to use the wpml_content_fix_links_to_translated_content() function
				// It will take a string, parse its links based on <a> tag and return the translated link
				// TODO use the icl_object_id function instead
				$url = '<a href="' . $url . '"></a>';
				$url = wpml_content_fix_links_to_translated_content($url);
				$url = substr($url, 9, -6);
			}
			
			$out .= '<form autocomplete="off" action="' . $url . '" method="get" class="wpv-filter-form js-wpv-filter-form js-wpv-filter-form-' . $this->get_view_count() . ' ' . implode( ' ', $form_class ) . '" data-viewnumber="' . $this->get_view_count() . '" data-targetid="' . $target_id . '" data-viewid="' . $id . '">';
        
			$out .= '<input type="hidden" class="js-wpv-dps-filter-data js-wpv-filter-data-for-this-form" data-action="' . $url . '" data-page="' . $page . '" data-ajax="disable" data-effect="' . $effect . '" data-spinner="' . $spinner . '" data-spinnerimage="' . $spinner_image . '" data-ajaxbefore="' . $ajax_before . '" data-ajaxafter="' . $ajax_after . '" />';
			
			// Set a hidden input for the View attributes, so we can pass them if needed
			$view_attrs = $atts;
			if ( isset( $view_attrs['name'] ) ) {
				unset( $view_attrs['name'] );
			}
			if ( isset( $view_attrs['target_id'] ) ) {
				unset( $view_attrs['target_id;'] );
			}
			if ( !empty( $view_attrs ) && is_array( $view_attrs ) ) {
				$att_data = '';
				foreach ( $view_attrs as $att_key => $att_val ) {
					$att_data .= ' data-' . $att_key . '="' . esc_attr( $att_val ) . '"';
				}
				$out .= '<input type="hidden" class="js-wpv-view-attributes"' . $att_data . ' />';
			}
			
			// add hidden inputs for any url parameters.
			// We need these for when the form is submitted.
			$url_query = parse_url($url, PHP_URL_QUERY);
			if ($url_query != '') {
				$query_parts = explode('&', $url_query);
				foreach($query_parts as $param) {
					$item = explode('=', $param);
					if (strpos($item[0], 'wpv_') !== 0) {
						$out .= '<input id="wpv_param_' . $item[0] . '" type="hidden" name="' . $item[0] . '" value="' . $item[1] . '" />' . "\n";
					}
				}
			}

			$meta_html = $view_settings['filter_meta_html'];
			
			if( preg_match('#\\[wpv-filter-controls\\](.*?)\\[\/wpv-filter-controls\\]#is', $meta_html, $matches) ) 
			{
				$fixmatches = str_replace(' hide="true"', '', $matches[0]);
			}
			elseif( preg_match('#\\[wpv-control.*?\\]#is', $meta_html) || preg_match('#\\[wpv-filter-search-box.*?\]#is', $meta_html) ) 
			{
				if(	preg_match('#\\[wpv-filter-start.*?\](.*?)\\[\wpv-filter-end\\]#is', $meta_html, $matches) )
				{
					$fixmatches = str_replace(' hide="true"', '', $matches[1]);
				}
			}
			$out .= wpv_do_shortcode($fixmatches);
			$out .= '</form>';

			$this->current_view = array_pop($this->view_ids);
			if ($this->current_view == null) {
				$this->current_view = $id;
			}
			$this->view_depth--;
        
		}

		//$this->returned_ids_for_parametric_search = array();
		$this->rendering_views_form_in_progress = false;


        return $out;

    }

	function rendering_views_form() {
		return $this->rendering_views_form_in_progress;
	}

    function get_current_page() {
		$aux_array = $this->current_page;
        return end($aux_array);
    }

	function get_view_shortcodes_attributes() {
		$aux_array = $this->view_shortcode_attributes;
		return end($aux_array);
	}

    function get_top_current_page() {
		if (is_single() || is_page()) { // in this case, check directly the current page - needed to make the post_type_dont_include_current_page setting work in AJAX pagination
			global $wp_query;
			if (isset($wp_query->posts[0])) {
				$current_post = $wp_query->posts[0];
				return $current_post;
			} else {
				return $this->top_current_page;
			}
		} else {
			return $this->top_current_page;
		}
    }

    /**
     * get the current view we are processing.
     *
     */

    function get_current_view() {
        return $this->current_view;
    }

    /**
     * get the current view count
     *
     */

    function get_view_count() {
		if (isset($this->set_view_counts[$this->current_view])) {
			return $this->set_view_counts[$this->current_view];
		} else {
			return 10000 * ($this->view_depth - 1) + $this->view_count[$this->view_depth];
		}
    }

    function set_view_count($count, $view_id) {
		if ($view_id) {
			$this->set_view_counts[$view_id] = $count;
		} else {
			$this->view_count[$this->view_depth] = $count;
		}
    }

    /**
     * get the view settings for the current view
     *
     * @param integer $view_id View post ID
     * @param $settings Additional forced settings
     */

    function get_view_settings($view_id = null, $settings = array()) {
        static $view_settings = array();

        if (is_null($view_id)) {
            $view_id = $this->get_current_view();
        }

        if (!isset($view_settings[$view_id])) {
            $view_settings[$view_id] = apply_filters('wpv_view_settings', (array)get_post_meta($view_id, '_wpv_settings', true), $view_id);
            if (!empty($settings) && is_array($settings)) {
                $view_settings[$view_id] = wpv_parse_args_recursive($settings, $view_settings[$view_id]);
            }

			// PATCH - v1.1 - add the default view mode to normal (not archive)
			if (!isset($view_settings[$view_id]['view-query-mode'])) {
				$view_settings[$view_id]['view-query-mode'] = 'normal';
			}

        }

        return $view_settings[$view_id];
    }

    /**
     * get the view layout settings for the current view
     *
     */

    function get_view_layout_settings() {
        static $view_layout_settings = array();

        if (!isset($view_layout_settings[$this->get_current_view()])) {
            $view_layout_settings[$this->get_current_view()] = (array)get_post_meta($this->get_current_view(), '_wpv_layout_settings', true);
        }

        return $view_layout_settings[$this->get_current_view()];
    }

    /**
     * Keep track of the current view and render the view.
     *
     */

    function render_view_ex($id, $hash){

        global $post, $WPVDebug, $sitepress;

		$this->view_depth++;
		$WPVDebug->wpv_debug_start( $id, $this->view_shortcode_attributes );
        //$this->returned_ids_for_parametric_search = array();
		

        if ($this->top_current_page == null) {
            $this->top_current_page = isset($post) ? clone $post : null;
        }

        array_push($this->current_page, isset($post) ? clone $post : null);

        array_push($this->view_ids, $this->current_view);

        if (isset($sitepress) && function_exists('icl_object_id')) {
            $id = icl_object_id($id, 'view', true);
        }
        $this->current_view = $id;

		array_push($this->post_query_stack, $this->post_query);

		// save original taxonomy term if any
		$tmp_parent_taxonomy = $this->parent_taxonomy;
		if (isset($this->taxonomy_data['term'])) {
			$this->parent_taxonomy = $this->taxonomy_data['term']->term_id;
		} else {
			$this->parent_taxonomy = 0;
		}
		$tmp_taxonomy_data = $this->taxonomy_data;
		
		// save original users if any
		$tmp_parent_user = $this->parent_user;
		if (isset($this->users_data['term'])) {
			$this->parent_user = $this->users_data['term']->ID;
		} else {
			$this->parent_user = 0;
		}
		$tmp_users_data = $this->users_data;

        $out =  $this->render_view($id, $hash);

        $out = wpv_do_shortcode($out);

		$this->taxonomy_data = $tmp_taxonomy_data;
		$this->parent_taxonomy = $tmp_parent_taxonomy;
		
		$this->users_data = $tmp_users_data;
		$this->parent_user = $tmp_parent_user;

        $this->current_view = array_pop($this->view_ids);
        if ($this->current_view == null) {
            $this->current_view = $id;
        }

        array_pop($this->current_page);

		$this->post_query = array_pop($this->post_query_stack);

		$this->view_depth--;
		$WPVDebug->wpv_debug_end();
		//$this->returned_ids_for_parametric_search = array();
        return $out;
    }

    /**
     * Render the view and loops through the found posts
     *
     */

    function render_view($view_id, $hash){

        global $post, $wpdb;
		global $WPVDebug;
        global $wplogger;
		
		$options = $this->get_options();


        static $processed_views = array();
        
        // increment the view count.
		if (!isset($this->view_count[$this->view_depth])) {
			$this->view_count[$this->view_depth] = 0;
		}
        $this->view_count[$this->view_depth]++;

        $view = get_post($view_id);
        $this->view_used_ids[] = $view_id;

        $out = '';

        $view_caller_id = (isset($post) && isset($post->ID)) ? get_the_ID() : 0; // post or widget

        if(!isset($processed_views[$view_caller_id][$hash]) || 0 === $view_caller_id){

            //$processed_views[$view_caller_id][$hash] = true; // mark view as processed for this post

            if(!empty($view)){

                $post_content = $view->post_content;

                // apply the layout meta html if we have some.
                $view_layout_settings = $this->get_view_layout_settings();

                if (isset($view_layout_settings['layout_meta_html'])) {
                    $post_content = str_replace('[wpv-layout-meta-html]', $view_layout_settings['layout_meta_html'], $post_content);
                }

		        $post_content = wpml_content_fix_links_to_translated_content($post_content);

				$view_settings = $this->get_view_settings();

                // find the loop

                if(preg_match('#\<wpv-loop(.*?)\>(.*)</wpv-loop>#is', $post_content, $matches)) {
                    // get the loop arguments.
                    $args = $matches[1];
                    $exp = array_map('trim', explode(' ', $args));
                    $args = array();
                    foreach($exp as $e){
                        $kv = explode('=', $e);
                        if (sizeof($kv) == 2) {
                            $args[$kv[0]] = trim($kv[1],'\'"');
                        }
                    }
                    if (isset($args['wrap'])) {
                        $args['wrap'] = intval($args['wrap']);
                    }
                    if (isset($args['pad'])) {
                        $args['pad'] = $args['pad'] == 'true';
                    } else {
                        $args['pad'] = false;
                    }

                    $tmpl = $matches[2];
                    $item_indexes = $this->_get_item_indexes($tmpl);

					if ($view_settings['query_type'][0] == 'posts') {
						// get the posts using the query settings for this view.

						$archive_query = null;
						if ($view_settings['view-query-mode'] == 'archive') {

							// check for an archive loop
							global $WPV_view_archive_loop;
							if (isset($WPV_view_archive_loop)) {
								$archive_query = $WPV_view_archive_loop->get_archive_loop_query();
							}

						} else if  ($view_settings['view-query-mode'] == 'layouts-loop') {
							global $wp_query;
							$archive_query = clone $wp_query;
						}
							

						if ($archive_query) {
							$this->post_query = $archive_query;
						} else {
							$this->post_query = wpv_filter_get_posts($view_id);
						}
						$items = $this->post_query->posts;

                        $wplogger->log('Found '. count($items) . ' posts');

                        if ($wplogger->isMsgVisible(WPLOG_DEBUG)) {

                            // simplify the output
                            $out_items = array();
                            foreach($items as $item) {
                                $out_items[] = array('ID' => $item->ID, 'post_title' => $item->post_title);
                            }
                            $wplogger->log($out_items, WPLOG_DEBUG);
                        }

					}

                    // save original post
                    global $post, $authordata, $id;
                    $tmp_post = isset($post) ? clone $post : null;
                    if ($authordata) {
                        $tmp_authordata = clone $authordata;
                    } else {
                        $tmp_authordata = null;
                    }
                    $tmp_id = $id;

					if ($view_settings['query_type'][0] == 'taxonomy') {
						$items = $this->taxonomy_query($view_settings);

                        $wplogger->log($items, WPLOG_DEBUG);

						// taxonomy views can be recursive so remove from
						// the processed array
			            //unset($processed_views[$view_caller_id][$hash]);

					}
                    if ($view_settings['query_type'][0] == 'users') {
                        $items = $this->users_query($view_settings);
                        $wplogger->log($items, WPLOG_DEBUG);
                    }
					
					if ( isset($options['wpv_debug_mode']) && !empty($options['wpv_debug_mode']) ){
						$WPVDebug->add_log('items_count', count($items));		
					}
                    $loop = '';
                    for($i = 0; $i < count($items); $i++){
						$WPVDebug->set_index();
                        $index = $i;
						
                        if (isset($args['wrap'])) {
                            $index %= $args['wrap'];
                        }

                        $index++; // [wpv-item index=xx] uses base 1
                        $index = strval($index);


						if ($view_settings['query_type'][0] == 'posts') {
							$post = clone $items[$i];
							$authordata = new WP_User($post->post_author);
							$id = $post->ID;
							$temp_variables = $this->variables;
							$this->variables = array();
							do_action('wpv-before-display-post', $post, $view_id);
						}
						if ($view_settings['query_type'][0] == 'taxonomy') {
							$this->taxonomy_data['term'] = $items[$i];
							do_action('wpv-before-display-taxonomy', $items[$i], $view_id);
						}
                        if ($view_settings['query_type'][0] == 'users') {
                            
                            $user_id = $items[$i]->ID;
                            $user_meta = get_user_meta( $user_id );
                            $items[$i]->meta = $user_meta;
                            $this->users_data['term'] = $items[$i];
							do_action('wpv-before-display-user', $items[$i], $view_id);                            
                        }
						$WPVDebug->add_log( $view_settings['query_type'][0] , $items[$i]);
						

                        // first output the "all" index.
                        $shortcodes_output = wpv_do_shortcode($item_indexes['all']);
                        $loop .= $shortcodes_output; 
						$WPVDebug->add_log_item( 'shortcodes', $item_indexes['all'] );
						$WPVDebug->add_log_item( 'output', $shortcodes_output );

                        // Output each index we find
                        // otherwise output 'other'
                        if (isset($item_indexes[$index])) {
                        	$shortcodes_output = wpv_do_shortcode($item_indexes[$index]);
                            $loop .= $shortcodes_output;
                            $WPVDebug->add_log_item( 'shortcodes', $item_indexes[$index] );
							$WPVDebug->add_log_item( 'output', $shortcodes_output );
                        } elseif (isset($item_indexes['other'])) {
                        	$shortcodes_output = wpv_do_shortcode($item_indexes['other']);
                            $loop .= $shortcodes_output;
							$WPVDebug->add_log_item( 'shortcodes', $item_indexes['other'] );
							$WPVDebug->add_log_item( 'output', $shortcodes_output );
                        }

						if ($view_settings['query_type'][0] == 'posts') {
							do_action('wpv-after-display-post', $post, $view_id);
							$this->variables = $temp_variables;
						}
						if ($view_settings['query_type'][0] == 'taxonomy') {
							do_action('wpv-after-display-taxonomy', $items[$i], $view_id);
						}
                        if ($view_settings['query_type'][0] == 'users') {
                            do_action('wpv-after-display-user', $items[$i], $view_id);                           
                        }

                    }
					
                    //print $loop;exit;
					// see if we should pad the remaining items.
					if (isset($args['wrap']) && isset($args['pad'])) {
						while (($i % $args['wrap']) && $args['pad']) {
	                        $index = $i;
                            $index %= $args['wrap'];

							if($index == $args['wrap'] - 1) {
		                        $loop .= wpv_do_shortcode($item_indexes['pad-last']);
							} else {
		                        $loop .= wpv_do_shortcode($item_indexes['pad']);
							}

							$i++;
						}
					}
					
					$WPVDebug->clean_index();

                    $out .= str_replace($matches[0], $loop, $post_content);

                    $post = isset($tmp_post) ? clone $tmp_post : null; // restore original $post
                    if ($tmp_authordata) {
                        $authordata = clone $tmp_authordata;
                    } else {
                        $authordata = null;
                    }
                    $id = $tmp_id;

                }
            }else{
                $out .= sprintf('<!- %s ->', __('View not found', 'wpv-views'));
            }

        }else{

            if($processed_views[$view_caller_id][$hash] !== true){
                $out .= $processed_views[$view_caller_id][$hash]; // use output from cache
            }

        }
        
        return $out;
    }

    /**
     * Get the html for each of the wpv-item index.
     *
     * <wpv-loop wrap=8 pad=true>
     * Output for all items
     * [wpv-item index=1]
     * Output for item 1
     * [wpv-item index=4]
     * Output for item 4
     * [wpv-item index=8]
     * Output for item 8
     * [wpv-item index=others]
     * Output for other items
     * [wpv-item index=pad]
     * Output for when padding is required
     * [wpv-item index=pad-last]
     * Output for the last item when padding is required
     * </wpv-loop>
     *
     * Will return an array with the output for each index
     *
     * eg array('all' => 'Output for all items',
     *          '1' => 'Output for item 1',
     *          '4' => 'Output for item 4',
     *          '8' => 'Output for item 8',
     *          'other' => 'Output for other items',
     *          )
     *
     */

    function _get_item_indexes($template) {
        $indexes = array();
        $indexes['all'] = '';
        $indexes['pad'] = '';
        $indexes['pad-last'] = '';

        // search for the [wpv-item index=xx] shortcode
        $found = false;
        $last_index = -1;

        while(preg_match('#\\[wpv-item index=([^\[]+)\]#is', $template, $matches)) {
            $pos = strpos($template, $matches[0]);

            if (!$found) {

                // found the first one.
                // use all the stuff before for the all index.

                $indexes['all'] = substr($template, 0, $pos);
                $found = true;
            } else

            if ($last_index != -1) {
                // All the stuff before belongs to the previous index
                $indexes[$last_index] = substr($template, 0, $pos);
            }

            $template = substr($template, $pos + strlen($matches[0]));

            $last_index = $matches[1];

        }

        if (!$found) {
            $indexes['all'] = $template;
        } else {
            $indexes[$last_index] = $template;
        }

        return $indexes;
    }

    /**
     * get the current post query
     *
     */

    function get_query() {
        return $this->post_query;
    }

    /**
     * Add the view button to the toolbar of required edit pages.
     *
     * Also force the view editor to be in HTML mode.
     *
     */

    function post_edit_tinymce() {
        global $post;

	    if( is_object( $post ) === false ) return;

        if ($post->post_type != 'view-template') {
            $this->editor_addon = new Editor_addon('wpv-views',
                                                   __('Insert Views Shortcodes', 'wpv-views'),
                                                   WPV_URL . '/res/js/views_editor_plugin.js',
                                                   '', true, 'icon-views ont-icon-25');
        }

        if ($post->post_type == 'view') { // TODO DEPRECATED this is not used anymore

            add_short_codes_to_js(array('post','body-view-templates'), $this->editor_addon);
        }

        if ($post->post_type != 'view' && $post->post_type != 'view-template') { // TODO half DEPRECATED the View part is not used anymore

            // add tool bar to other edit pages so they can insert the view shortcodes.
            add_short_codes_to_js(array('view', 'view-form', 'wpml','body-view-templates-posts'), $this->editor_addon, 'add-basics');
        }

    }

    /**
     * Get all the views that have been created.
     *
     */

    function get_views(){
        $views = get_posts(array(
            'post_type'         => 'view',
            'post_status'       => 'publish',
			'numberposts'		=> -1
        ));
        return $views;
    }

    // new method to get Content templates for module manager
    function get_view_templates(){
        $view_templates = get_posts(array(
            'post_type'         => 'view-template',
            'post_status'       => 'publish',
			'numberposts'		=> -1
        ));
        return $view_templates;
    }

    function get_view_titles() {
        global $wpdb;

        static $views_available = null;

		if ($views_available === null) {

			$views_available = array();
			$views = $wpdb->get_results("SELECT ID, post_title, post_name FROM {$wpdb->posts} WHERE post_type='view'");
			foreach ($views as $view) {
				$views_available[$view->ID] = $view->post_title;
			}
		}
		return $views_available;
	}


    /**
     * Add css required when editing a view
     *
     */
/*
    function add_css() { // TODO DEPRECATED this is not used anymore
        global $post;

	    if( is_object( $post ) === false ) return;

        if ($post->post_type == 'view') {
            add_thickbox();
        }
    }
*/
    /**
     * Add the javascript files when editing a "view" post type.
     *
     */
/*
    function add_js() { // TODO DEPRECATED this is not used anymore
        global $post;
        if (is_object( $post ) && $post->post_type == 'view') {

        }
    }
  */  
    /**
     * Add the frontend styles and scripts
     *
     */

    function wpv_frontend_enqueue_scripts() {
		
		// Datepicker script bundled with WordPress
		wp_enqueue_script( 'jquery-ui-datepicker' );
		// Datepicker localization
		$lang = get_locale();
		$lang = str_replace('_', '-', $lang);
		$real_lang = false;
		// TODO integrate this with WPML lang
		if ( file_exists( WPV_PATH_EMBEDDED . '/res/js/i18n/jquery.ui.datepicker-' . $lang . '.js' ) ) {
			if ( !wp_script_is( 'jquery-ui-datepicker-local-' . $lang, 'registered' ) ) {
				wp_register_script( 'jquery-ui-datepicker-local-' . $lang, WPV_URL_EMBEDDED . '/res/js/i18n/jquery.ui.datepicker-' . $lang . '.js', array('jquery-ui-core', 'jquery', 'jquery-ui-datepicker'), WPV_VERSION, true );
			}
			if ( !wp_script_is( 'jquery-ui-datepicker-local-' . $lang ) ) {
				wp_enqueue_script( 'jquery-ui-datepicker-local-' . $lang );
			}
			$real_lang = $lang;
		} else {
			$lang = substr($lang, 0, 2);
			if ( file_exists( WPV_PATH_EMBEDDED . '/res/js/i18n/jquery.ui.datepicker-' . $lang . '.js' ) ) {
				if ( !wp_script_is( 'jquery-ui-datepicker-local-' . $lang, 'registered' ) ) {
					wp_register_script( 'jquery-ui-datepicker-local-' . $lang, WPV_URL_EMBEDDED . '/res/js/i18n/jquery.ui.datepicker-' . $lang . '.js', array('jquery-ui-core', 'jquery', 'jquery-ui-datepicker'), WPV_VERSION, true );
				}
				if ( !wp_script_is( 'jquery-ui-datepicker-local-' . $lang ) ) {
					wp_enqueue_script( 'jquery-ui-datepicker-local-' . $lang );
				}
			}
			$real_lang = $lang;
		}
		
		// Pagination script and style
		wp_register_script( 'views-pagination-script', WPV_URL_EMBEDDED . '/res/js/wpv-pagination-embedded.js', array('jquery', 'jquery-ui-datepicker'), WPV_VERSION, true );
		wp_enqueue_script( 'views-pagination-script' );
		$calendar_image = WPV_URL_EMBEDDED . '/res/img/calendar.gif';
		$calendar_image = apply_filters( 'wpv_filter_wpv_calendar_image', $calendar_image );
		$calendar_image = apply_filters( 'wptoolset_filter_wptoolset_calendar_image', $calendar_image );
		$wpv_pagination_localization = array(
			'regional' => $real_lang,
			'front_ajaxurl' => admin_url('admin-ajax.php', null),
			'calendar_image' => $calendar_image,
			'calendar_text' => esc_js(__('Select date', 'wpv-views'))
		);
        wp_localize_script( 'views-pagination-script', 'wpv_pagination_local', $wpv_pagination_localization );
		wp_register_style( 'views-pagination-style', WPV_URL_EMBEDDED . '/res/css/wpv-pagination.css', array(), WPV_VERSION );
		wp_enqueue_style( 'views-pagination-style' );
		
		// Map script - only load it if the Setting is enabled
		if ( ( defined( 'FORCE_SSL_ADMIN' ) && FORCE_SSL_ADMIN ) || is_ssl() ) {
			$protocol = 'https';
		} else {
			$protocol = 'http';
		}
		wp_register_script( 'wpv-google-map-script', $protocol . '://maps.googleapis.com/maps/api/js?sensor=false&ver=3.5.2', array(), null, true );
		wp_register_script( 'views-map-script', WPV_URL_EMBEDDED . '/res/js/jquery.wpvmap.js', array('wpv-google-map-script', 'jquery'), WPV_VERSION, true );
		$options = $this->get_options();
		if ( isset( $options['wpv_map_plugin'] ) && $options['wpv_map_plugin'] != '' ) {
			wp_enqueue_script( 'views-map-script' );
		}
    }


    /**
     * Called when adding a filter to the view query
     *
     * This function will return the html elements for the type of
     * query that is being added
     *
	 * DEPRECATED
     */

    function ajax_get_table_row_ui() {

        if (wp_verify_nonce($_POST['wpv_nonce'], 'wpv_get_table_row_ui_nonce')) {
            $type = apply_filters('wpv_get_table_row_ui_type', $_POST['type_data']);

            $checkboxes = array();
            if (isset($_POST['checkboxes'])) {
                $checkboxes = $_POST['checkboxes'];
            }

            echo call_user_func('wpv_get_table_row_ui_' . $type, $_POST['row'], $_POST['type_data'], $checkboxes, array());
        }

        die();
    }

    /**
     * get all the meta keys used in all the posts
     *
     * returns an array
     */

    function get_meta_keys($include_hidden = false) {
        global $wpdb;
        static $cf_keys = null;

        if ($cf_keys == null) {
            // get the custom field keys
            $cf_keys_limit = 10000; // jic
            $cf_keys = $wpdb->get_col( "
                SELECT DISTINCT meta_key
                FROM $wpdb->postmeta
                ORDER BY meta_key
                LIMIT $cf_keys_limit" );

            if (function_exists('wpcf_get_post_meta_field_names')) {
                $types_fields = wpcf_get_post_meta_field_names();
                foreach($types_fields as $field) {
                    if (!in_array($field, $cf_keys)) {
                        $cf_keys[] = $field;
                    }
                }
            }

            // exclude these keys.
            $cf_keys_exceptions = array('_edit_last', '_edit_lock', '_wp_page_template', '_wp_attachment_metadata', '_icl_translator_note', '_alp_processed',
                                        '_icl_translation', '_thumbnail_id', '_views_template', '_wpml_media_duplicate', '_wpml_media_featured',
                                        '_top_nav_excluded', '_cms_nav_minihome',
                                        'wpml_media_duplicate_of', 'wpml_media_lang', 'wpml_media_processed',
                                        '_wpv_settings', '_wpv_layout_settings', '_wpv_view_sync',
										'_wpv_view_template_fields', '_wpv_view_template_mode',
										'dd_layouts_settings');

            $cf_keys = array_diff($cf_keys, $cf_keys_exceptions);

			if (!$include_hidden) {

				$options = $this->get_options();
				if (isset($options['wpv_show_hidden_fields'])) {
					$include_these_hidden = explode(',', $options['wpv_show_hidden_fields']);
				} else {
					$include_these_hidden = array();
				}
				// exclude hidden fields (starting with an underscore)
				foreach ($cf_keys as $index => $field) {
					if (strpos($field, '_') === 0) {
						if (!in_array($field, $include_these_hidden)) {
							unset($cf_keys[$index]);
						}
					}
				}
			}

            if ( $cf_keys ) {
                natcasesort($cf_keys);
            }


        }

        return $cf_keys;
    }

	/**
	 * If the post has a view
	 * add an view edit link to post.
	 */

	function edit_post_link($link, $post_id) {

        // do nothing for theme version.

		return $link;
	}

    /**
     * Saves View editor height
	 *
	 * DEPRECATED
     */
    function save_editor_height() {
        if (isset($_POST['height'])) {
            $type = isset($_POST['type']) ? $_POST['type'] : 'view';
            setcookie('wpv_views_editor_height_' . strval($type), intval($_POST['height']), time() + 60*60*24*30, COOKIEPATH, COOKIE_DOMAIN);
        }
    }

    /**
     * Sets View editor height
	 *
	 * DEPRECATED
     */
    function set_editor_height() {
        $post_type = get_post_type();
        if (in_array($post_type, array('view', 'view-template'))) {
            add_action('admin_footer', array($this, 'editor_height_js'));
        }
    }

    function editor_height_js() {// DEPRECATED
        echo '
<script type="text/javascript">
//<![CDATA[
function wpv_views_editor_resize_init() {
        jQuery("#editorcontainer").resizable({
            handles: "s",
            alsoResize: "#content",
            stop: function(event, ui) {
                jQuery.post(ajaxurl, {
                    action: "wpv_views_editor_height",
                    height: jQuery(this).height(),
                    type: "' . get_post_type() . '"
                });
                jQuery(this).css("width", "100%").find("#content").css("width", "100%");
            }';
        if (isset($_COOKIE['wpv_views_editor_height_' . get_post_type()])) {
            $height = intval($_COOKIE['wpv_views_editor_height_' . get_post_type()]);
            if ($height < 200) {
                $height = 200;
            }
            echo ',
                    create: function(event, ui) {
                        jQuery("#editorcontainer, #content").css("height", "' . $height . 'px").height(' . $height . ');
                    }';
        }
        echo '
        });
    }';
echo '
jQuery(document).ready(function(){
    var timeoutWpvViewsEditorResize = window.setTimeout("wpv_views_editor_resize_init()", 1000);
});

//]]>
</script>
';
    }


    function get_options() {
        if ($this->options !== null) {
            return $this->options;
        }
        $this->options = get_option('wpv_options');
        if (!$this->options) {
            $this->options = array();
        }

        return $this->options;
    }

    function save_options($options) {
        update_option('wpv_options', $options);
        $this->options = $options;
    }

    /**
    * Adds help on admin pages.
    *
    * @param type $contextual_help
    * @param type $screen_id
    * @param type $screen
    * @return type
    */
    function admin_plugin_help($contextual_help, $screen_id, $screen) {
        return $contextual_help;
    }

    function is_embedded() {
        return true;
    }

    function convert_ids_to_names_in_settings($settings) {
        global $wpdb;

        if ( isset( $settings['post_type'] ) ) {
            if ( is_array( $settings['post_type'] ) ) {
				$settings['post_types'] = $settings['post_type'];
				unset( $settings['post_type'] );
				foreach( $settings['post_types'] as $key => $value ) {
					$settings['post_types']['post_type-' . $key] = $value;
					unset($settings['post_types'][$key]);
				}
				$settings['post_types']['__key'] = 'post_type';
			} else {
				unset( $settings['post_type'] );
			}
        }

        if (isset($settings['post_status'])) {
            if ( is_array( $settings['post_status'] ) ) {
				$settings['post_statuses'] = $settings['post_status'];
				unset( $settings['post_status'] );
				foreach($settings['post_statuses'] as $key => $value) {
					$settings['post_statuses']['post_status-' . $key] = $value;
					unset($settings['post_statuses'][$key]);
				}
				$settings['post_statuses']['__key'] = 'post_status';
			} else {
				unset( $settings['post_status'] );
			}
        }

        if (isset($settings['parent_id']) && $settings['parent_id'] != '') {
            $parent_name = $wpdb->get_var("SELECT post_name FROM {$wpdb->posts} WHERE ID = " . $settings['parent_id']);
            $settings['parent_id'] = $parent_name;
        }

        if (isset($settings['post_relationship_id']) && $settings['post_relationship_id'] != '') {
            $parent_name = $wpdb->get_var("SELECT post_name FROM {$wpdb->posts} WHERE ID = " . $settings['post_relationship_id']);
            $settings['post_relationship_id'] = $parent_name;
        }

        if (isset($settings['post_relationship_mode'][0])) {
            $settings['post_relationship_mode'] = $settings['post_relationship_mode'][0];
        }

        if (isset($settings['parent_mode'])) {
            $settings['parent_mode'] = $settings['parent_mode'][0];
        }

		/*
	    $taxonomies = get_taxonomies('', 'objects');
		foreach ($taxonomies as $category_slug => $category) {
			$save_name = ( $category->name == 'category' ) ? 'post_category' : 'tax_input_' . $category->name;

            if ( isset( $settings[$save_name] ) ) {
                if ( is_array( $settings[$save_name] ) ) {
					foreach( $settings[$save_name] as $key => $id ) {
						$term = get_term_by('id', $id, $category->name);
						if ($term) {
							$settings[$save_name]['cat-' . $key] = $term->name;
						}
						unset( $settings[$save_name][$key] );
					}
					$settings[$save_name]['__key'] = 'cat';
				} else {
					unset( $settings[$save_name] );
				}
            }
            // Use this to check attribute-url-format
            $attribute_url_format = 'taxonomy-' . $category->name . '-attribute-url-format';
            if (isset($settings[$attribute_url_format][0])) {
                $settings[$attribute_url_format] = $settings[$attribute_url_format][0];
            }
        }
		*/
		
		// We need to do it just the opposite: loop through the $settings and see if it contains some tax filter data
		// In case it does, check if the taxonomy exists and delete otherwise
		$taxonomies = get_taxonomies('', 'names');
		foreach ( $settings as $set_key => $set_value ) {
			if ( $set_key == 'post_category' ) {
				// Special case: category taxonomy
				// Check if category is a valid taxonomy and if we have an array of terms
				if ( in_array( 'category', $taxonomies ) ) {
					if ( is_array( $settings['post_category'] ) ) {
						foreach( $settings['post_category'] as $key => $id ) {
							$term = get_term_by('id', $id, 'category');
							if ( $term ) {
								$settings['post_category']['cat-' . $key] = $term->name;
							}
							unset( $settings['post_category'][$key] );
						}
						$settings['post_category']['__key'] = 'cat';
					} else {
						unset( $settings['post_category'] );
					}
				} else {
					$to_delete = array(
						'post_category',
						'tax_category_relationship',
						'taxonomy-category-attribute-url',
						'taxonomy-category-attribute-url-format',
						'taxonomy-category-attribute-operator',
					);
					foreach ($to_delete as $cat_index_to_delete) {
						if ( isset( $settings[$cat_index_to_delete] ) ) {
							unset( $settings[$cat_index_to_delete] );
						}
					}
				}
			} else if ( strpos( $set_key, 'tax_input_' ) === 0 ) {
				// Any other taxonomy
				// Check if this is a valid taxonomy and if we have an array of terms
				$tax_key = substr( $set_key, strlen( 'tax_input_' ) );
				if ( in_array( $tax_key, $taxonomies ) ) {
					if ( is_array( $settings[$set_key] ) ) {
						foreach( $settings[$set_key] as $key => $id ) {
							$term = get_term_by('id', $id, $tax_key);
							if ( $term ) {
								$settings[$set_key]['cat-' . $key] = $term->name;
							}
							unset( $settings[$set_key][$key] );
						}
						$settings[$set_key]['__key'] = 'cat';
					} else {
						unset( $settings[$set_key] );
					}
				} else {
					$to_delete = array(
						$set_key,
						'tax_' . $tax_key . '_relationship',
						'taxonomy-' . $tax_key . '-attribute-url',
						'taxonomy-' . $tax_key . '-attribute-url-format',
						'taxonomy-' . $tax_key . '-attribute-operator',
					);
					foreach ($to_delete as $tax_index_to_delete) {
						if ( isset( $settings[$tax_index_to_delete] ) ) {
							unset( $settings[$tax_index_to_delete] );
						}
					}
				}
			} else if ( strpos( $set_key, 'taxonomy-' ) === 0 && strpos( $set_key, '-attribute-url-format' ) === strlen( $set_key ) - strlen( '-attribute-url-format' ) ) {
				$tax_key = substr( $set_key, 0, strlen( $set_key ) - strlen( '-attribute-url-format' ) );
				$tax_key = substr( $tax_key, strlen( 'taxonomy-' ) );
				if ( in_array( $tax_key, $taxonomies ) ) {
					if ( isset( $settings[$set_key][0] ) ) {
						$settings[$set_key] = $settings[$set_key][0];
					}
				} else {
					$to_delete = array(
						'tax_' . $tax_key . '_relationship',
						'taxonomy-' . $tax_key . '-attribute-url',
						'taxonomy-' . $tax_key . '-attribute-url-format',
						'taxonomy-' . $tax_key . '-attribute-operator',
					);
					foreach ($to_delete as $tax_index_to_delete) {
						if ( isset( $settings[$tax_index_to_delete] ) ) {
							unset( $settings[$tax_index_to_delete] );
						}
					}
				}
			}
		}

        if(isset($settings['pagination'][0])) {
            $settings['pagination']['state'] = $settings['pagination'][0];
            unset($settings['pagination'][0]);
        }

        if(isset($settings['ajax_pagination'][0])) {
            $settings['ajax_pagination']['state'] = $settings['ajax_pagination'][0];
            unset($settings['ajax_pagination'][0]);
        }

        if(isset($settings['query_type'][0])) {
            $settings['query_type']['state'] = $settings['query_type'][0];
            unset($settings['query_type'][0]);
        }

        if ( isset( $settings['taxonomy_type'] ) ) {
            if ( is_array( $settings['taxonomy_type'] ) ) {
				$settings['taxonomy_types'] = $settings['taxonomy_type'];
				unset( $settings['taxonomy_type'] );
				foreach( $settings['taxonomy_types'] as $key => $value ) {
					$settings['taxonomy_types']['taxonomy_type-' . $key] = $value;
					unset($settings['taxonomy_types'][$key]);
				}
				$settings['taxonomy_types']['__key'] = 'taxonomy_type';
			} else {
				unset( $settings['taxonomy_type'] );
			}
        }
        
        if ( isset( $settings['roles_type'] ) ) {
            if ( is_array( $settings['roles_type'] ) ) {
				$settings['roles_types'] = $settings['roles_type'];
				unset( $settings['roles_type'] );
				foreach( $settings['roles_types'] as $key => $value ) {
					$settings['roles_types']['roles_type-' . $key] = $value;
					unset( $settings['roles_types'][$key] );
				}
				$settings['roles_types']['__key'] = 'roles_type';
			} else {
				unset( $settings['roles_type'] );
			}
        }



        // Fix the taxonomy_terms keys
        if ( isset( $settings['taxonomy_terms'] ) ) {
            if ( is_array( $settings['taxonomy_terms'] ) ) {
				foreach( $settings['taxonomy_terms'] as $key => $value ) {
					$settings['taxonomy_terms']['taxonomy_term-' . $key] = $value;
					unset( $settings['taxonomy_terms'][$key] );
				}
				$settings['taxonomy_terms']['__key'] = 'taxonomy_term';
			} else {
				unset( $settings['taxonomy_terms'] );
			}
        }

		// fix filter control settings so arrays get output correctly.
		$filter_control_settings = array('filter_controls_enable',
										 'filter_controls_param',
										 'filter_controls_mode',
										 'filter_controls_field_name',
										 'filter_controls_label',
										 'filter_controls_type',
										 'filter_controls_values'
										 );

		foreach( $filter_control_settings as $filter_control ) {
			if ( isset( $settings[$filter_control] ) ) {
				if ( is_array( $settings[$filter_control] ) ) {
					foreach ( $settings[$filter_control] as $key => $value ) {
						$settings[$filter_control][$filter_control . '-' . $key] = $value;
						unset( $settings[$filter_control][$key] );
					}
					$settings[$filter_control]['__key'] = $filter_control;
				} else {
					unset( $settings[$filter_control] );
				}
			}
		}

        return $settings;
    }

    function convert_ids_to_names_in_filters($id_list) {
        global $wpdb;
        $id_array = array_map('trim', explode(',', $id_list));
        $post_names = array();
        $counter = 0;
        foreach ($id_array as $id_post) {
			$name = $wpdb->get_var("SELECT post_name FROM {$wpdb->posts} WHERE ID = " . $id_post);
			if (!is_null($name)) $post_names['post-'.$counter] = $name;
			$counter++;
        }
        return $post_names;
        }

    function convert_ids_to_names_in_layout_settings($settings) {
        global $wpdb;

		if (isset($settings['fields'][0])) {
			// This are old settings. We can delete.
			unset($settings['fields']);
		}

		/*
		if (isset($settings['fields'])) {
			foreach($settings['fields'] as $key => $value) {
				if (substr($key, 0, 5) == 'name_') {// Not needed anymore as the data structure seems to have changed and we store now the template name anyway
					if (substr($value, 0, 13) == 'wpv-post-body') {
						// use the Content template name instead of the id
						$parts = explode(' ', $value);
						if (sizeof($parts) == 2) {
							$view_template_id = $parts[1];
							$view_template_name = $wpdb->get_var("SELECT post_name FROM {$wpdb->posts} WHERE ID = " . $view_template_id);
							if ($view_template_name) {
								$settings['fields'][$key] = 'wpv-post-body ' . $view_template_name;
							}
						}
					}
				}
			}
        }
		*/
		
		if ( isset( $settings['real_fields'] ) ) {
			// Fix an issue with imported Views not correctly setting the layout_settings[real_fields] array
			// and breaking the XML file when exporting
			if ( is_array( $settings['real_fields'] ) && isset( $settings['real_fields']['real_fields'] ) ) {
				$trans = $settings['real_fields']['real_fields'];
				$settings['real_fields'] = $trans;
			}
			if ( is_array( $settings['real_fields'] ) ) {
				// Only add the layout_settings[real_fields] items if this is an array
				// On 1.3? there might be a problem when there is only one item, and it is stored as a string instead
				// Some eggs need to be broken: no layout edit using the Wizard in this case will be available
				$real_fields = $settings['real_fields'];
				$settings['real_fields'] = array('__key' => 'real_fields');
				foreach($real_fields as $key => $value) {
					$settings['real_fields']['real_field-'.$key] = $value;
				}
			} else {
				// If there is only one item and it's not wrapped in an array, say goodbye to the Wizard edit advantage
				// Those eggs are already broken
				unset( $settings['real_fields'] );
			}
		}

		if (isset($settings['post_type'])) {
			$post_type = $settings['post_type'];
			$settings['post_type'] = array('__key' => 'post_type');
			foreach ($post_type as $key => $value) {
				$settings['post_type']['post_type'.$key] = $value;
			}
		}
		
		// Fix the export/import flow for the Temlates attached to a View
		if ( isset( $settings['included_ct_ids'] ) ) {
			$templates = explode( ',', $settings['included_ct_ids'] );
			$template_export = array();
			if ( count( $templates ) > 0 ) {
				$attached_templates = count( $templates );
				for ( $i=0; $i<$attached_templates; $i++ ) {
					if ( is_numeric( $templates[$i] ) ) {
						$template_post = get_post($templates[$i]);
						if ( is_object( $template_post ) ) {
							$template_export[] = $template_post->post_title;
						}
					}
				}
			}
			if ( count( $template_export ) > 0 ) {
				$settings['included_ct_ids'] = implode( '#SEPARATOR#', $template_export );
			} else {
				unset( $settings['included_ct_ids'] );
			}
		}
		
        return $settings;
    }

    function convert_names_to_ids_in_settings($settings) {
        global $wpdb;

        if ( isset( $settings['post_types'] ) ) {
            $settings['post_type'] = $settings['post_types'];
            unset($settings['post_types']);
            if( is_array( $settings['post_type']['post_type'] ) ) {
                $settings['post_type'] = $settings['post_type']['post_type'];
            } else if ( isset( $settings['post_type']['post_type'] ) ) {
                $settings['post_type'][0] = $settings['post_type']['post_type'];
                unset( $settings['post_type']['post_type'] );
            }
        }

        if ( isset( $settings['post_statuses'] ) ) {
            $settings['post_status'] = $settings['post_statuses'];
            unset($settings['post_statuses']);
            if( is_array( $settings['post_status']['post_status'] ) ) {
                $settings['post_status'] = $settings['post_status']['post_status'];
            } else if ( isset( $settings['post_status']['post_status'] ) ) {
                $settings['post_status'][0] = $settings['post_status']['post_status'];
                unset( $settings['post_status']['post_status'] );
            }
        }

        if (isset($settings['parent_id']) && $settings['parent_id'] != '') {
            $parent_id = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE post_name = '{$settings['parent_id']}'");
            $settings['parent_id'] = $parent_id;
        }

        if (isset($settings['parent_mode'])) {
            $settings['parent_mode'] = array($settings['parent_mode']);
        }

        if (isset($settings['post_relationship_mode'])) {
            $settings['post_relationship_mode'] = array($settings['post_relationship_mode']);
        }

        if (isset($settings['post_relationship_id'])) {
            $parent_id = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE post_name = '{$settings['post_relationship_id']}'");
            $settings['post_relationship_id'] = $parent_id;
        }

	    $taxonomies = get_taxonomies('', 'objects');
		foreach ( $taxonomies as $category_slug => $category ) {
			$save_name = ( $category->name == 'category' ) ? 'post_category' : 'tax_input_' . $category->name;

            if ( isset( $settings[$save_name] ) ) {
                if ( is_array( $settings[$save_name]['cat'] ) ) {
                    $settings[$save_name] = $settings[$save_name]['cat'];
                } else if ( isset( $settings[$save_name]['cat'] ) ) {
                    $settings[$save_name][0] = $settings[$save_name]['cat'];
                    unset( $settings[$save_name]['cat'] );
                } else {
					$settings[$save_name] = array();
				}

                foreach( $settings[$save_name] as $key => $name ) {
                    $term = get_term_by( 'name', $name, $category->name );
                    if ($term) {
                        $settings[$save_name][$key] = $term->term_id;
                    }
                }
            }

            // Use this to check attribute-url-format
            $attribute_url_format = 'taxonomy-' . $category->name . '-attribute-url-format';
            if (isset($settings[$attribute_url_format])) {
                $settings[$attribute_url_format] = array($settings[$attribute_url_format]);
            }

        }

        if(isset($settings['pagination']['state'])) {
            $settings['pagination'][0] = $settings['pagination']['state'];
            unset($settings['pagination']['state']);
        }

        if(isset($settings['ajax_pagination']['state'])) {
            $settings['ajax_pagination'][0] = $settings['ajax_pagination']['state'];
            unset($settings['ajax_pagination']['state']);
        }

        if(isset($settings['query_type']['state'])) {
            $settings['query_type'][0] = $settings['query_type']['state'];
            unset($settings['query_type']['state']);
        } else {
            $settings['query_type'][0] = 'posts';
        }


        if (isset($settings['taxonomy_types'])) {
            $settings['taxonomy_type'] = $settings['taxonomy_types'];
            unset($settings['taxonomy_types']);
            if(is_array($settings['taxonomy_type']['taxonomy_type'])) {
                $settings['taxonomy_type'] = $settings['taxonomy_type']['taxonomy_type'];
            } else if ( isset( $settings['taxonomy_type']['taxonomy_type'] ) ) {
                $settings['taxonomy_type'][0] = $settings['taxonomy_type']['taxonomy_type'];
                unset($settings['taxonomy_type']['taxonomy_type']);
            }
        }
        
        if (isset($settings['roles_types'])) {
            $settings['roles_type'] = $settings['roles_types'];
            unset($settings['roles_types']);
            if(is_array($settings['roles_type']['roles_type'])) {
                $settings['roles_type'] = $settings['roles_type']['roles_type'];
            } else if ( isset( $settings['roles_type']['roles_type'] ) ) {
                $settings['roles_type'][0] = $settings['roles_type']['roles_type'];
                unset($settings['roles_type']['roles_type']);
            }
        }

        if (isset($settings['taxonomy_terms'])) {
            if(is_array($settings['taxonomy_terms']['taxonomy_term'])) {
                $settings['taxonomy_terms'] = $settings['taxonomy_terms']['taxonomy_term'];
            } else if ( isset( $settings['taxonomy_terms']['taxonomy_term'] ) ) {
                $settings['taxonomy_terms'][0] = $settings['taxonomy_terms']['taxonomy_term'];
                unset($settings['taxonomy_terms']['taxonomy_term']);
            }
        }

		// fix filter control settings
		$filter_control_settings = array('filter_controls_enable',
										 'filter_controls_param',
										 'filter_controls_mode',
										 'filter_controls_field_name',
										 'filter_controls_label',
										 'filter_controls_type',
										 'filter_controls_values'
										 );

		foreach($filter_control_settings as $filter_control) {
			if ( isset( $settings[$filter_control][$filter_control] ) ) {
				if ( is_array( $settings[$filter_control][$filter_control] ) ) {
					$settings[$filter_control] = $settings[$filter_control][$filter_control];
				}
				unset( $settings[$filter_control][$filter_control] );
			}
		}
		
	// Adjust user ID in Views filter by specific users
	
	// First, for author filter for Views listing posts
	
	if ( isset( $settings['author_name'] ) && !empty( $settings['author_name'] ) ) {
		$new_author = '';
		$new_author = $wpdb->get_var("SELECT ID FROM {$wpdb->users} WHERE display_name = '{$settings['author_name']}'");
		if ( isset( $new_author ) && !empty( $new_author ) ) {
			$settings['author_id'] = $new_author;
		} else {
			unset( $settings['author_name'] );
			unset( $settings['author_id'] );
		}
	}
	
	// Second, for filter by specific users for Views listing users users_name
	
	if ( isset( $settings['users_name'] ) && !empty( $settings['users_name'] ) ) {
		$user_list = array_map( 'trim', explode( ',', $settings['users_name'] ) );
		$new_users = array();
		$new_users_names = array();
		if ( !empty( $user_list ) ) {
			foreach ( $user_list as $user_name ) {
				$new_author = '';
				$new_author = $wpdb->get_var("SELECT ID FROM {$wpdb->users} WHERE display_name = '{$user_name}'");
				if ( isset( $new_author ) && !empty( $new_author ) ) {
					$new_users[] = $new_author;
					$new_users_names[] = $user_name;
				}
				
			}
			if ( !empty( $new_users ) ) {
				$settings['users_name'] = implode(",", $new_users_names);
				$settings['users_id'] = implode(",", $new_users);
			} else {
				unset( $settings['users_name'] );
				unset( $settings['users_id'] );
			}
		}
	}

        return $settings;
    }

    function convert_names_to_ids_in_filters($names_array) {
	global $wpdb;
	if (!is_array($names_array)) return;
	$ids_list = array();
	$ids_lost = array();
	foreach ($names_array as $post_name) {
		$found_post = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE post_name = '{$post_name}'");
		if (is_null($found_post)) {
			$ids_lost[] = $post_name;
		} else {
			$ids_list[] = $found_post;
		}
	}
	$ids_list = implode(',', $ids_list);
	$result = array(
		'ids_list' => $ids_list,
		'ids_lost' => $ids_lost
	);
	return $result;
    }

    function convert_names_to_ids_in_layout_settings($settings) {
        global $wpdb;

        if (isset($settings['fields'])) {
            foreach($settings['fields'] as $key => $value) {
                if (substr($key, 0, 5) == 'name_') {/* not needed anymore as we are storing the name anyway on export
                    if (substr($value, 0, 13) == 'wpv-post-body') {
                        // use the Content template id instead of the name
                        $parts = explode(' ', $value);
                        if (sizeof($parts) == 2) {
                            $view_template_name = $parts[1];
                            $view_template_id = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'view-template' AND post_name = '{$view_template_name}'");
                            if ($view_template_id) {
                                $settings['fields'][$key] = 'wpv-post-body ' . $view_template_id;
                            }
                        }
                    }*/
                    if (!isset($settings['fields']['suffix_' + substr($key, 5)])) {
                        $settings['fields']['suffix_' . substr($key, 5)] = '';
                    }
                    if (!isset($settings['fields']['prefix_' + substr($key, 5)])) {
                        $settings['fields']['prefix_' . substr($key, 5)] = '';
                    }
                }

            }
        }
        
        // Fix the not-well-formatted layout_settings[real_fields] array after exporting and XML-to-array conversion
        // It pushes the data in a one-level-deep array when it should be just an indexed array
        if ( isset( $settings['real_fields'] ) && isset( $settings['real_fields']['real_fields'] ) ) {
			$trans = $settings['real_fields']['real_fields'];
			$settings['real_fields'] = $trans;
		}
		
		// Fix the export/import flow for the Temlates attached to a View
		if ( isset( $settings['included_ct_ids'] ) ) {
			$templates = explode( '#SEPARATOR#', $settings['included_ct_ids'] );
			$template_import = array();
			if ( count( $templates ) > 0 ) {
				$attached_templates = count( $templates );
				for ( $i=0; $i<$attached_templates; $i++ ) {
					$template_found = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE post_title = '{$templates[$i]}' AND post_type = 'view-template'");
					if ( !is_null( $template_found ) ) {
						$template_import[] = $template_found;
					}
				}
			}
			if ( count( $template_import ) > 0 ) {
				$settings['included_ct_ids'] = implode( ',', $template_import );
			} else {
				unset( $settings['included_ct_ids'] );
			}
		}
			
        return $settings;
    }

	function get_current_taxonomy_term() {
		if (isset($this->taxonomy_data['term'])) {
			return $this->taxonomy_data['term'];
		} else {
			return null;
		}
	}

	function taxonomy_query($view_settings) {
		$items = get_taxonomy_query($view_settings);

		$this->taxonomy_data['item_count'] = sizeof($items);

		if ($view_settings['pagination'][0] == 'disable') {
			$this->taxonomy_data['max_num_pages'] = 1;
			$this->taxonomy_data['item_count_this_page'] = $this->taxonomy_data['item_count'];
		} else {
			// calculate the number of pages.
			$posts_per_page = $view_settings['posts_per_page'];
			if (isset($view_settings['pagination']['mode']) && $view_settings['pagination']['mode'] == 'rollover') {
				$posts_per_page = $view_settings['rollover']['posts_per_page'];
			}

			$this->taxonomy_data['max_num_pages'] = ceil($this->taxonomy_data['item_count'] / $posts_per_page);

			if ($this->taxonomy_data['item_count'] > $posts_per_page) {
				// return the paged result

				$page = 1;
				if (isset($_GET['wpv_paged'])) {
					$page = $_GET['wpv_paged'];
				}

				$this->taxonomy_data['page_number'] = $page;

				// only return 1 page of items.
				$items = array_slice($items, ($page - 1) * $posts_per_page, $posts_per_page);

			}
		}
		$this->taxonomy_data['item_count_this_page'] = sizeof($items);
		return $items;
	}

    /*
     * Get Users query
     */
    function users_query($view_settings) {
        $items = get_users_query($view_settings);
        
        $this->users_data['item_count'] = sizeof($items);

        if ($view_settings['pagination'][0] == 'disable') {
        	$this->users_data['item_count_this_page'] = $this->users_data['item_count'];
            $this->users_data['max_num_pages'] = 1;
        } else {
            // calculate the number of pages.
            $posts_per_page = $view_settings['posts_per_page'];
            if (isset($view_settings['pagination']['mode']) && $view_settings['pagination']['mode'] == 'rollover') {
                $posts_per_page = $view_settings['rollover']['posts_per_page'];
            }

            $this->users_data['max_num_pages'] = ceil($this->users_data['item_count'] / $posts_per_page);

            if ($this->users_data['item_count'] > $posts_per_page) {
                // return the paged result

                $page = 1;
                if (isset($_GET['wpv_paged'])) {
                    $page = $_GET['wpv_paged'];
                }

                $this->users_data['page_number'] = $page;

                // only return 1 page of items.
                $items = array_slice($items, ($page - 1) * $posts_per_page, $posts_per_page);

            }
        }
        $this->users_data['item_count_this_page'] = sizeof($items);
        return $items;
    } 

	function get_current_page_number() {
		if ($this->post_query) {
			return intval( $this->post_query->query_vars['paged'] );
		} elseif ( isset( $this->users_data ) && isset( $this->users_data['page_number'] ) ){
			return $this->users_data['page_number'];
        } elseif ( isset( $this->taxonomy_data ) && isset( $this->taxonomy_data['page_number'] ) ) {
			// Taxonomy query
			return $this->taxonomy_data['page_number'];
		}
		return 1;
	}

	function get_max_pages() {
		if ( $this->post_query ) {
			return $this->post_query->max_num_pages;
		} elseif ( isset( $this->users_data ) && isset( $this->users_data['max_num_pages'] ) ) {
			return $this->users_data['max_num_pages'];
		} elseif ( isset( $this->taxonomy_data ) && isset( $this->taxonomy_data['max_num_pages'] ) ) {
			// Taxonomy query
			return $this->taxonomy_data['max_num_pages'];
		}
		return 1;
	}

	function get_taxonomy_found_count() {
		if (isset($this->taxonomy_data['item_count'])) {
			return $this->taxonomy_data['item_count'];
		} else {
			return 0;
		}
	}
    
    function get_users_found_count() {
        if (isset($this->users_data['item_count'])) {
            return $this->users_data['item_count'];
        } else {
            return 0;
        }
    }

	function get_parent_view_taxonomy() {
		return $this->parent_taxonomy;
	}
	
	function get_parent_view_user() {
		return $this->parent_user;
	}

	/**
	 * type should be 'taxonomy' or 'post'
	 *
	 */

	function get_add_field_view_select_box($row, $view_selected, $type) {
		global $wpdb;

        $views_available = $wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type='view' AND post_status in ('publish')");

        $view_select_box = '';
		if ($row === '') {
			$view_select_box .= '<select class="' . $type . '_view_select" name="' . $type . '_view" id="' . $type . '_view">';
		} else {
			$view_select_box .= '<select class="' . $type . '_view_select" name="' . $type . '_view_' . $row . '" id="' . $type . '_view_' . $row . '">';
		}

        foreach($views_available as $view) {
            if ($view_selected == $view->ID)
                $selected = ' selected="selected"';
            else
                $selected = '';

            $view_settings = get_post_meta($view->ID, '_wpv_settings', true);
			$title = $view->post_title . ' - ' . __('Post View', 'wpv-views');
			if (isset($view_settings['query_type'][0]) && $view_settings['query_type'][0] == 'taxonomy') {
				$title = $view->post_title . ' - ' . __('Taxonomy View', 'wpv-views');
			}

            $view_select_box .= '<option value="' . $view->ID . '"' . $selected . '>' . $title . '</option>';
        }
        $view_select_box .= '</select>';

        return $view_select_box;
	}

    function set_widget_view_id($id) {
        $this->widget_view_id = $id;
    }

    function get_widget_view_id() {
        return $this->widget_view_id;
    }

	function set_variable($name, $value) {
		$this->variables[$name] = $value;
	}

	function get_variable($name) {
        if (strpos($name, '$') === 0) {
			$name = substr($name, 1);

			if (isset($this->variables[$name])) {
				return $this->variables[$name];
			}
		}
		return null;
	}

	function get_view_shortcode_params($view_id) {
		$settings = $this->get_view_settings($view_id);

		$params = wpv_get_custom_field_view_params($settings);
		$params = array_merge($params, wpv_get_taxonomy_view_params($settings));

		return $params;
	}

	function hide_view_template_author() {

	}

	/**
	 * See if a view has any enbabled from controls
	 *
	 */

	function does_view_have_form_controls($view_id) {
		$view_settings = $this->get_view_settings($view_id);

		if (isset($view_settings['filter_controls_enable']) && is_array($view_settings['filter_controls_enable'])) {
			foreach($view_settings['filter_controls_enable'] as $enable) {
				if ($enable) {
					return true;
				}
			}
		}
		
		// Sometimes, the above check is not enough because the filters have been deleted => search for the actual controls shortcodes
		
		if ( isset( $view_settings['filter_meta_html'] ) ) {
			if ( strpos($view_settings['filter_meta_html'], "[wpv-control") ) return true;
			if ( strpos($view_settings['filter_meta_html'], "[wpv-filter-search-box") ) return true;
			if ( strpos($view_settings['filter_meta_html'], "[wpv-filter-submit") ) return true;
		}

		return false;
	}

	/**
	 *	See if a view is used for an archive
	 *
	 */

	function is_archive_view($view_id) {
		$view_settings = $this->get_view_settings($view_id);

		return $view_settings['view-query-mode'] == 'archive';
	}

	function wpv_format_date() {

		$date_format = $_POST['date-format'];
		if ($date_format == '') {
			$date_format = get_option('date_format');
		}
		$date_format = str_replace('\\\\', '\\', $date_format); // this is needed to escape characters in the date_i18n function
		$date = $_POST['date'];
		// We can not be sure that the adodb_xxx functions are available, so we do different things whether they exist or not
		if ( defined( 'ADODB_DATE_VERSION' ) ) {
			$date = adodb_mktime(0, 0, 0, substr($date, 2, 2), substr($date, 0, 2), substr($date, 4, 4));
			echo json_encode(array('display' => adodb_date($date_format, $date),'timestamp' => $date));
		} else {
			$date = mktime(0, 0, 0, substr($date, 2, 2), substr($date, 0, 2), substr($date, 4, 4));
			echo json_encode(array('display' => date_i18n($date_format, intval($date)),'timestamp' => $date));
		}
		die();

	}
	
	function wpv_meta_html_extra_css() {
		$view_ids = array_unique( $this->view_used_ids );
		$cssout = '';
		foreach ( $view_ids as $view_id ) {
			$meta = get_post_custom( $view_id );
			if ( isset( $meta['_wpv_settings'] ) ) $meta = maybe_unserialize($meta['_wpv_settings'][0]);
			if ( isset( $meta['filter_meta_html_css'] ) ) {
				$cssout .= $meta["filter_meta_html_css"];
			}
			if ( isset( $meta['layout_meta_html_css'] ) ) {
				$cssout .= $meta["layout_meta_html_css"];
			}
		}
		if ( '' != $cssout ) {
			echo "\n<style type=\"text/css\" media=\"screen\">\n$cssout\n</style>\n";
		}
	}

	function wpv_meta_html_extra_js() {
		$view_ids = array_unique( $this->view_used_ids );
		$jsout = '';
		foreach ( $view_ids as $view_id ) {
			$meta = get_post_custom( $view_id );
			if ( isset( $meta['_wpv_settings'] ) ) $meta = maybe_unserialize($meta['_wpv_settings'][0]);
			if ( isset( $meta['filter_meta_html_js'] ) ) {
				$jsout .= $meta["filter_meta_html_js"];
			}
			if ( isset( $meta['layout_meta_html_js'] ) ) {
				$jsout .= $meta["layout_meta_html_js"];
			}
		}
		if ( '' != $jsout ) {
			echo "\n<script type=\"text/javascript\">\n$jsout\n</script>\n";
		}
	}

	function wp_ajax_wpv_view_media_manager() {

		if (wp_verify_nonce($_POST['_wpnonce'], 'wpv_media_manager_callback')) {

			global $wpdb;

			$view_id = $_POST['view_id'];
			$table = '';

			$args = array(
				'post_type' => 'attachment',
				'numberposts' => null,
				'post_status' => null,
				'post_parent' => $view_id
			);
			$attachments = get_posts($args);
			if ($attachments) {
			$table = '<table class="wpv_table_attachments widefat"><thead><tr><th>' . __('Thumbnail', 'wpv-views') . '</th><th>' . __('URL', 'wpv-views') . '</th></thead>';
				foreach ($attachments as $attachment) {
					$guid = $attachment->guid;
					$title = $attachment->post_title;
					$type = get_post_mime_type($attachment->ID);
					$icon = wp_mime_type_icon($type);
					if ( $type == 'image/gif' || $type == 'image/jpeg' || $type == 'image/png' ) {
						$thumb = '<img src="' .  $attachment->guid . '" alt="' . $attachment->post_title . '" width="60" height="60" />';
					} else {
						$thumb = '<img src="' . $icon . '" />';
					}
					$table .= "<tr><td>$thumb</td><td><a href='$guid'>$guid</a></td></tr>";
				}
			$table .= '</table>';
			}
			echo $table;
		}

		die();

	}
	
	function wpv_admin_enqueue_scripts($hook) {
	
		// Register general scripts needed in the embedded version
	
		wp_deregister_script( 'toolset-colorbox' );
		wp_register_script( 'toolset-colorbox' , WPV_URL_EMBEDDED . '/res/js/lib/jquery.colorbox-min.js', array('jquery'), WPV_VERSION);
	
		wp_register_script( 'views-select2-script' , WPV_URL_EMBEDDED . '/res/js/lib/select2/select2.min.js', array('jquery'), WPV_VERSION);
		wp_register_script( 'views-utils-script' , WPV_URL_EMBEDDED . '/res/js/lib/utils.js', array('jquery','toolset-colorbox', 'views-select2-script'), WPV_VERSION);
		
		// CodeMirror

		wp_register_script( 'views-codemirror-script' , WPV_URL_EMBEDDED . '/res/js/codemirror/lib/codemirror.js', array(), WPV_VERSION, false);
		wp_register_script( 'views-codemirror-overlay-script' , WPV_URL_EMBEDDED . '/res/js/codemirror/addon/mode/overlay.js', array('views-codemirror-script'), WPV_VERSION, false);
		wp_register_script( 'views-codemirror-xml-script' , WPV_URL_EMBEDDED . '/res/js/codemirror/mode/xml/xml.js', array('views-codemirror-overlay-script'), WPV_VERSION, false);
		wp_register_script( 'views-codemirror-css-script' , WPV_URL_EMBEDDED . '/res/js/codemirror/mode/css/css.js', array('views-codemirror-overlay-script'), WPV_VERSION, false);
		wp_register_script( 'views-codemirror-js-script' , WPV_URL_EMBEDDED . '/res/js/codemirror/mode/javascript/javascript.js', array('views-codemirror-overlay-script'), WPV_VERSION, false);
		wp_register_script( 'views-codemirror-conf-script' , WPV_URL_EMBEDDED . '/res/js/views_codemirror_conf.js', array('jquery','views-codemirror-script'), WPV_VERSION, false);
		wp_register_script( 'views-embedded-script',  WPV_URL_EMBEDDED . '/res/js/views_embedded.js', array('jquery','views-codemirror-overlay-script'), WPV_VERSION, true);
		
		// Register general CSS needed in the embedded version
		
		wp_deregister_style( 'toolset-font-awesome' );
		wp_register_style( 'toolset-font-awesome', WPV_URL_EMBEDDED . '/res/css/font-awesome/css/font-awesome.min.css', array(), WPV_VERSION );
		
		wp_deregister_style( 'toolset-colorbox' );
		wp_register_style( 'toolset-colorbox', WPV_URL_EMBEDDED . '/res/css/colorbox.css', array(), WPV_VERSION );
		
		wp_register_style( 'views-notifications-css', WPV_URL_EMBEDDED . '/res/css/notifications.css', array(), WPV_VERSION );
		wp_register_style( 'views-dialogs-css', WPV_URL_EMBEDDED . '/res/css/dialogs.css', array(), WPV_VERSION );
		wp_register_style( 'views-select2-css', WPV_URL_EMBEDDED . '/res/js/lib/select2/select2.css', array(), WPV_VERSION );
		
		// CodeMirror style

		wp_register_style( 'views-codemirror-css' , WPV_URL_EMBEDDED . '/res/js/codemirror/lib/codemirror.css', array(), WPV_VERSION);
		
		// General Views redesign style

		wp_register_style( 'views-admin-css', WPV_URL_EMBEDDED . '/res/css/views-admin.css',
		  array('toolset-font-awesome','toolset-colorbox','views-notifications-css','views-dialogs-css','views-select2-css'), WPV_VERSION );
	
		// Enqueue scripts and styles needed in the embedded version
		
		if ( ( $hook == 'post.php' || $hook == 'post-new.php' ) ) { // This is to show the Views form popup
			if ( !wp_script_is( 'views-utils-script' ) ) {
				wp_enqueue_script( 'views-utils-script');
				$help_box_translations = array(
				'wpv_dont_show_it_again' => __("Got it! Don't show this message again", 'wpv-views'),
				'wpv_close' => __("Close", 'wpv-views')
				);
				wp_localize_script( 'views-utils-script', 'wpv_help_box_texts', $help_box_translations );
			}
			if ( !wp_script_is( 'suggest' ) ) {
				wp_enqueue_script('suggest');
			}
			if ( !wp_style_is( 'toolset-font-awesome' ) ) {
				wp_enqueue_style('toolset-font-awesome');
			}
			if ( !wp_style_is( 'toolset-colorbox' ) ) {
				wp_enqueue_style('toolset-colorbox');
			}
			if ( !wp_style_is( 'views-notifications-css' ) ) {
				wp_enqueue_style('views-notifications-css');
			}
			if ( !wp_style_is( 'views-dialogs-css' ) ) {
				wp_enqueue_style('views-dialogs-css');
			}
			if ( !wp_script_is( 'jquery-ui-resizable' ) ) {
				wp_enqueue_script('jquery-ui-resizable');
			}
		}
		
		if ( isset( $_GET['page'] ) && ( $_GET['page'] == 'views-embedded' || $_GET['page'] == 'view-templates-embedded' || $_GET['page'] == 'view-archives-embedded' || $_GET['page'] == 'ModuleManager_Modules' ) ) {
			wp_enqueue_script('wp-pointer');
			wp_enqueue_style('wp-pointer');
			wp_enqueue_script('views-codemirror-script');
			wp_enqueue_script('views-codemirror-overlay-script');
			wp_enqueue_script('views-codemirror-xml-script');
			wp_enqueue_script('views-codemirror-css-script');
			wp_enqueue_script('views-codemirror-js-script');
			wp_enqueue_script('views-codemirror-conf-script');
			wp_enqueue_script('views-embedded-script');
			if ( !wp_script_is( 'views-utils-script' ) ) {
				wp_enqueue_script( 'views-utils-script');
				$help_box_translations = array(
				'wpv_dont_show_it_again' => __("Got it! Don't show this message again", 'wpv-views'),
				'wpv_close' => __("Close", 'wpv-views')
				);
				wp_localize_script( 'views-utils-script', 'wpv_help_box_texts', $help_box_translations );
			}
			wp_enqueue_style( 'views-codemirror-css' );
			wp_enqueue_style( 'views-admin-css' );
		}
		
		
	}
	
	function wpv_update_map_plugin_status() {

		if ( ! wp_verify_nonce( $_POST['wpv_map_plugin_nonce'], 'wpv_map_plugin_nonce' ) ) die("Security check");

		$options = $this->get_options();
		$options['wpv_map_plugin'] = esc_attr($_POST['wpv_map_plugin_status']);
		if ( empty($options['wpv_map_plugin']) || $options['wpv_map_plugin'] == 1){
			$this->save_options($options);
			echo 'ok';
		}else{
			echo 'error';	
		}
		die();
	}
	
	/*
	* Update bootstrap version option
	*/
	function wpv_update_bootstrap_version_status() {

		if ( ! wp_verify_nonce( $_POST['wpv_bootstrap_version_nonce'], 'wpv_bootstrap_version_nonce' ) ) die("Security check");

		$options = $this->get_options();
		$options['wpv_bootstrap_version'] = esc_attr($_POST['wpv_bootstrap_version_status']);
		if ( $options['wpv_bootstrap_version'] == 1 || $options['wpv_bootstrap_version'] == 2 || $options['wpv_bootstrap_version'] == 3 ){
		$this->save_options($options);
		echo 'ok';
		}else{
			echo 'error';	
		}
		die();
	}
	
	/*
	* Update 'edit view' link status options
	*/
	function wpv_update_show_edit_view_link_status() {

		if ( ! wp_verify_nonce( $_POST['wpv_show_edit_view_link_nonce'], 'wpv_show_edit_view_link_nonce' ) ) die("Security check");

		$options = $this->get_options();
		$options['wpv_show_edit_view_link'] = esc_attr($_POST['wpv_show_edit_view_link_status']);
		if ( empty($options['wpv_show_edit_view_link']) || $options['wpv_show_edit_view_link'] == 1){
			$this->save_options($options);
			echo 'ok';
		}else{
			echo 'error';	
		}
		die();
	}
	
	function wpv_update_debug_mode_status() {

		if ( ! wp_verify_nonce( $_POST['wpv_debug_mode_option'], 'wpv_debug_mode_option' ) ) die("Security check");

		$options = $this->get_options();
		$options['wpv_debug_mode'] = esc_attr($_POST['debug_status']);
		$options['wpv-debug-mode-type'] = esc_attr($_POST['wpv_dembug_mode_type']);
		if ( empty($options['wpv_debug_mode']) || $options['wpv_debug_mode'] == 1 ){
			$this->save_options($options);
			echo 'ok';
		}else{
			echo 'error';	
		}
		die();
	}
	
	function wpv_switch_debug_check() {
		if ( ! wp_verify_nonce( $_POST['wpnonce'], 'wpv_debug_mode_option' ) ) die("Security check");
		$options = $this->get_options();
		if ( !isset( $_POST['result'] ) ) {
			$_POST['result'] = 'dismiss';
		}
		switch ( $_POST['result'] ) {
			case 'recover':
				$options['dismiss_debug_check'] = 'false';
				break;
			case 'dismiss':
			default:
				$options['dismiss_debug_check'] = 'true';
				break;
		}
		$this->save_options($options);
		echo 'ok';
		die();
	}
	
	function get_force_disable_dependant_parametric_search() {
		return $this->force_disable_dependant_parametric_search;
    }
    
    function check_force_disable_dependant_parametric_search() {
		$force_disable = false;
		$view_settings = $this->get_view_settings();
		if ( isset( $view_settings['dps'] ) && isset( $view_settings['dps']['enable_dependency'] ) && $view_settings['dps']['enable_dependency'] == 'enable' ) {
			$controls_per_kind = wpv_count_filter_controls( $view_settings );
			$controls_count = 0;
			$no_intersection = array();
			if ( !isset( $controls_per_kind['error'] ) ) {
			//	$controls_count = array_sum( $controls_per_kind );
				$controls_count = $controls_per_kind['cf'] + $controls_per_kind['tax'] + $controls_per_kind['pr'];
				if ( $controls_per_kind['cf'] > 1 && ( !isset( $view_settings['custom_fields_relationship'] ) || $view_settings['custom_fields_relationship'] != 'AND' ) ) {
					$no_intersection[] = __( 'custom field', 'wpv-views' );
				}
				if ( $controls_per_kind['tax'] > 1 && ( !isset( $view_settings['taxonomy_relationship'] ) || $view_settings['taxonomy_relationship'] != 'AND' ) ) {
					$no_intersection[] = __( 'taxonomy', 'wpv-views' );
				}
			} else {
				$force_disable = true;
			}
			if ( $controls_count > 0 ) {
				if ( count( $no_intersection ) > 0 ) {
					$force_disable = true;
				}
			} else {
				$force_disable = true;
			}
		}
		$this->set_force_disable_dependant_parametric_search( $force_disable );
		return $force_disable;
    }
    
    function set_force_disable_dependant_parametric_search( $bool = false ) {
		$this->force_disable_dependant_parametric_search = $bool;
    }
    
    /*
	* wpv_get_view_url_params TODO
	*
	*/
	
	function wpv_get_view_url_params( $id = null ) {
		$view_settings = $this->get_view_settings( $view_id );
		
	}

}
/**
 * render_view
 *
 * Renders a view and returns the result
 *
 * $args is an array. You can pass one of these keys:
 *
 * 'name' => The View post_name
 * 'title' => The View post_title
 * 'id' => The View post ID
 * 'target_id' => The target page ID if you want to render just the View form
 *
 * $post_override is an array to be used to override $_GET values
 *
 *	Example:  <?php echo render_view(array('title' => 'Top pages')); ?>
 *
 */

function render_view( $args, $get_override = array() ) {

    global $wpdb, $WP_Views;

    $id = 0;

    if (isset($args['id'])) {
        $id = $args['id'];
    } elseif (isset($args['name'])) {
        $id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type='view' AND post_name=%s", $args['name']));
    } elseif (isset($args['title'])) {
        $id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE post_type='view' AND post_title=%s", $args['title']));
    }

    if ($id) {

		if ( !empty( $get_override ) ) {
			$post_old = $_GET;
			foreach ( $get_override as $key => $value ) {
				$_GET[$key] = $value;
			}
		}
		
		$args['id'] = $id;
		array_push($WP_Views->view_shortcode_attributes, $args);
		if ( isset( $args['target_id'] ) ) {
			$out = $WP_Views->short_tag_wpv_view_form( array( 'id' => $id, 'target_id' => $args['target_id'] ) );
		} else {
			$out = $WP_Views->render_view_ex($id, md5(serialize($args)));
		}
        $WP_Views->view_used_ids[] = $id;

		array_pop($WP_Views->view_shortcode_attributes);
		
		if ( !empty( $get_override ) ) {
			$_GET = $post_old;
		}

        return $out;
    } else {
        return '';
    }
}

function wpv_views_plugin_activate() {
    add_option('wpv_views_plugin_do_activation_redirect', true);
}

function wpv_views_plugin_deactivate() {
    delete_option('wpv_views_plugin_do_activation_redirect', true);
}

function wpv_views_plugin_redirect() {
    if (get_option('wpv_views_plugin_do_activation_redirect', false)) {
        delete_option('wpv_views_plugin_do_activation_redirect');
        wp_redirect(admin_url() . 'admin.php?page='. WPV_FOLDER .'/menu/help.php');
        exit;
    }
}

function wpv_views_plugin_action_links($links, $file) {
    $this_plugin = basename(WPV_PATH) . '/wp-views.php';
    if($file == $this_plugin) {
        $links[] = '<a href="admin.php?page='.basename(WPV_PATH).'/menu/help.php">' . __('Getting started', 'wpv-views') . '</a>';
    }
    return $links;
}

/**
 * WPML translate call.
 *
 * @param type $name
 * @param type $string
 * @return type
 *
 * @todo maybe move to the WPML file
 */
function wpv_translate($name, $string, $register = false, $context = 'plugin Views') {
    if (!function_exists('icl_t')) {
        return $string;
    }

    if ($register) {
		icl_register_string($context, $name, $string);
	}

    return icl_t($context, $name, stripslashes($string));
}

/**
 * get_view_query_results
 *
 * Returns the result of a query filtered by a View
 *
 * @param $view_id the ID of the relevant View
 * @param $post_in (optional) (post object) sets the global $post
 * @param $current_user_in (optional) (user object) sets the global $current_user
 * @param $args (optional) an array of attributes to pass to the View, like shortcode attributes when using [wpv-view]
 *
 * @return an array of $post objects if the View lists posts, $term objects if the View lists taxonomies or $user objects if the View lists users
 *
 * Example:  <?php echo get_view_query_results(80)); ?>
 *
 */

function get_view_query_results( $view_id, $post_in = null, $current_user_in = null, $args = array() ) {

	global $WP_Views, $post, $current_user, $id;
	if ( $post_in ) $post = $post_in;
	if ( $current_user_in ) $current_user = $current_user_in;
	$view_settings = $WP_Views->get_view_settings( $view_id );
	
	array_push( $WP_Views->view_shortcode_attributes, $args );

	if ( $view_settings['query_type'][0] == 'posts' ) {
		// get the posts using the query settings for this view.

		$archive_query = null;
		if ( $view_settings['view-query-mode'] == 'archive' ) {

			// check for an archive loop
			global $WPV_view_archive_loop;
			if ( isset( $WPV_view_archive_loop ) ) {
				$archive_query = $WPV_view_archive_loop->get_archive_loop_query();
			}

		} else if  ($view_settings['view-query-mode'] == 'layouts-loop') {
			global $wp_query;
			$archive_query = clone $wp_query;
		}

		if ( $archive_query ) {
			$ret_query = $archive_query;
		} else {
			$ret_query = wpv_filter_get_posts( $view_id );
		}
		$items = $ret_query->posts;
	}

	if ( $view_settings['query_type'][0] == 'taxonomy' ) {
		$items = $WP_Views->taxonomy_query( $view_settings );
	}
	
	if ( $view_settings['query_type'][0] == 'users' ) {
		$items = $WP_Views->users_query( $view_settings );
	}
	
	array_pop( $WP_Views->view_shortcode_attributes );

	return $items;
}

/**
* wpv_admin_exclude_tax_slugs
*
* Applied in the filter wpv_admin_exclude_tax_slugs
*
* Returns an array of taxonomy slugs that are left out in Views taxonomy-related View loops admin GUIs
*
* We take out taxonomies with show_ui set to false by default, but some custom taxonomies declared for internal use by some plugins do not use it
* If that is the case and no custom labels are provided, the custom taxonomy hijacks Categories or Post Tags in some Views taxonomy-related View loops admin GUIs that rely on the labels
* This filte takes those internal taxonomies out of our loops
*
* @param $exclude_tax_slugs (array) the slugs to be excluded
*
*/

function wpv_admin_exclude_tax_slugs($exclude_tax_slugs) {
	
	// first we exclude the three biult-in taxonomies that we want to leave out_items
	if ( !in_array( 'post_format', $exclude_tax_slugs ) ) {
		$exclude_tax_slugs[] = 'post_format';
	}
	if ( !in_array( 'link_category', $exclude_tax_slugs ) ) {
		$exclude_tax_slugs[] = 'link_category';
	}
	if ( !in_array( 'nav_menu', $exclude_tax_slugs ) ) {
		$exclude_tax_slugs[] = 'nav_menu';
	}
	
	// WP RSS Aggregator issue: https://icanlocalize.basecamphq.com/projects/7393061-toolset/todo_items/171941369/comments
	// Filtering out an internal custom taxonomy with slug wp_log_type
	
	if ( !in_array( 'wp_log_type', $exclude_tax_slugs ) ) {
		$exclude_tax_slugs[] = 'wp_log_type';
	}
	
	return $exclude_tax_slugs;
}

/**
* 	get_view_allowed_attributes
* 
*   Return array of possible attributes for view shortcode
* 
* 	@param $view_id the ID of the relevant View
* 
*   @return  numeric array of possible attributes for $view_id
*   @return output example:
* 			'query_type' => posts|taxonomy|users
* 			'filter_type' => filter that this attribute is used on (post_id, post_author, etc..)
* 			'value' => filter from where attribute getting data
* 			'attribute' => the actual shortcode attribute
* 			'expected' => input data type integer|string|numeric
* 
*  Example:  <?php echo get_view_allowed_attributes(80)); ?>
* 
*/
function get_view_allowed_attributes( $view_id ) {
	$output = array();
	
	if ( empty($view_id) ){
		return;	
	}
	
	$view_settings = get_post_meta( $view_id, '_wpv_settings', true );
	if ( is_array( $view_settings ) ){
		
		//Post types attributes
		if ( isset($view_settings['query_type'][0]) && $view_settings['query_type'][0] == 'posts' ){	
			//author shortcode
			if ( isset($view_settings['author_mode'][0]) && $view_settings['author_mode'][0] == 'shortcode' ){
				$output[] = array(
					'query_type' => $view_settings['query_type'][0],
					'filter_type' => 'post_author',
					'value' => $view_settings['author_shortcode_type'],
					'attribute' => $view_settings['author_shortcode'],
					'expected' => $view_settings['author_shortcode_type'] == 'id'? 'integer':'string'
				);	
		    }
			
			//post id shortcode
			if ( isset($view_settings['id_mode'][0]) && $view_settings['id_mode'][0] == 'shortcode' ){
				$output[] = array(
					'query_type' => $view_settings['query_type'][0],
					'filter_type' => 'post_id',
					'value' => 'post_id',
					'attribute' => $view_settings['post_ids_shortcode'],
					'expected' => 'integer'
				);	
		    }
			
			//taxonomies
			$taxonomies=get_taxonomies( array( 'public' => true ), 'names' ); 
			foreach ($taxonomies as $taxonomy ) {
			  if ( isset($view_settings['tax_'.$taxonomy.'_relationship']) && $view_settings['tax_'.$taxonomy.'_relationship'] == 'FROM ATTRIBUTE' ){
			  		$output[] = array(
						'query_type' => $view_settings['query_type'][0],
						'filter_type' => 'taxonomy_'.$taxonomy,
						'value' => $view_settings['taxonomy-'.$taxonomy.'-attribute-url-format'][0],
						'attribute' => $view_settings['taxonomy-'.$taxonomy.'-attribute-url'],
						'expected' => 'string'
					);	
			  }
			}
			
			//post relationship
			if ( isset($view_settings['post_relationship_mode'][0]) && $view_settings['post_relationship_mode'][0] == 'shortcode_attribute' ){
				$output[] = array(
					'query_type' => $view_settings['query_type'][0],
					'filter_type' => 'post_relationship',
					'value' => 'ancestor_id',
					'attribute' => $view_settings['post_relationship_shortcode_attribute'],
					'expected' => 'integer'
				);	
		    }
			
			//custom fields
			foreach($view_settings as $key => $value){
				if ( preg_match("/custom-field-(.*)_value/",$key, $res) && preg_match("/VIEW_PARAM\(([^\)]+)\)/",$value,$shortcode) ){
					$output[] = array(
						'query_type' => $view_settings['query_type'][0],
						'filter_type' => 'custom-field_'. $res[1],
						'value' => 'custom_field_value',
						'attribute' => $shortcode[1],
						'expected' => in_array( $view_settings['custom-field-'.$res[1].'_type'], array('NUMERIC','DATE','DATETIME','TIME') )? 'integer' : ($view_settings['custom-field-'.$res[1].'_type'] == 'DECIMAL' ? 'decimal':'string')
					);	
				}
			}
			
			
		}
		
		//Users attributes
		if ( isset($view_settings['query_type'][0]) && $view_settings['query_type'][0] == 'users' ){	
			//users shortocde
			if ( isset($view_settings['users_mode'][0]) && $view_settings['users_mode'][0] == 'shortcode' ){
				$output[] = array(
					'query_type' => $view_settings['query_type'][0],
					'filter_type' => 'user',
					'value' => $view_settings['users_shortcode_type'],
					'attribute' => $view_settings['users_shortcode'],
					'expected' => $view_settings['users_shortcode_type'] == 'id'? 'integer':'string'
				);	
		    }
		    
		    //usermeta fields
		    foreach($view_settings as $key => $value){
				if ( preg_match("/usermeta-field-(.*)_value/",$key, $res) && preg_match("/VIEW_PARAM\(([^\)]+)\)/",$value,$shortcode) ){
					$output[] = array(
						'query_type' => $view_settings['query_type'][0],
						'filter_type' => 'usermeta-field_'. $res[1],
						'value' => 'usermeta_field_value',
						'attribute' => $shortcode[1],
						'expected' => in_array( $view_settings['usermeta-field-'.$res[1].'_type'], array('NUMERIC','DATE','DATETIME','TIME') )? 'integer' : ($view_settings['usermeta-field-'.$res[1].'_type'] == 'DECIMAL' ? 'decimal':'string')
					);	
				}
			}
	    }
	}
	
	return $output;	
}
