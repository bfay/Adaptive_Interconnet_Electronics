<?php

// check for an import
global $wpv_theme_import, $wpv_theme_import_xml;
$wpv_theme_import = '';
$wpv_theme_import_xml = '';
if (file_exists(dirname(__FILE__) . '/settings.php')) {
    
    $wpv_theme_import = dirname(__FILE__) . '/settings.php';
    $wpv_theme_import_xml = dirname(__FILE__) . '/settings.xml';
}

if(defined('WPV_VERSION')) {
 
    // the plugin version is present.
    
    return; 
}

// THEME VERSION

define('WPV_VERSION', '1.6.3');
define('WPV_PATH', dirname(__FILE__));
define('WPV_PATH_EMBEDDED', dirname(__FILE__));

if (!defined('WPV_FOLDER')) {
	define('WPV_FOLDER', basename(WPV_PATH));
}

// Module Manager integration
require WPV_PATH_EMBEDDED . '/inc/wpv-module-manager.php';

if(strpos(str_replace('\\', '/', WPV_PATH_EMBEDDED), str_replace('\\', '/', WP_PLUGIN_DIR)) !== false){
	$wpv_url = plugins_url('embedded-views' , dirname(__FILE__));
	if ( defined( 'WPV_EMBEDDED_ALONE' ) ) {
		$wpv_url = plugins_url() . '/' . WPV_FOLDER;
	}
	if ( ( defined( 'FORCE_SSL_ADMIN' ) && FORCE_SSL_ADMIN ) || is_ssl() ) {
		$wpv_url = str_replace( 'http://', 'https://', $wpv_url );
	}
	define('WPV_URL', $wpv_url);
	define('WPV_URL_EMBEDDED', $wpv_url);
} else {
	define('WPV_URL', get_stylesheet_directory_uri() . '/' . WPV_FOLDER);
	define('WPV_URL_EMBEDDED', WPV_URL);
}

if( defined('WPV_URL_EMBEDDED') ){
    // load on the go resources
    require_once WPV_PATH_EMBEDDED . '/onthego-resources/onthegosystems-branding-loader.php';
    ont_set_on_the_go_systems_uri_and_start( WPV_URL_EMBEDDED . '/onthego-resources/' );
}

if (!defined('EDITOR_ADDON_RELPATH')) {
    define('EDITOR_ADDON_RELPATH', WPV_URL . '/common/visual-editor');
}

if ( !function_exists( 'wplogger' ) ) {
	require_once(WPV_PATH_EMBEDDED) . '/common/wplogger.php';
}

if ( !function_exists( 'wpv_debuger' ) ) { 
	require_once(WPV_PATH_EMBEDDED) . '/inc/wpv-query-debug.class.php';
}

require WPV_PATH_EMBEDDED . '/inc/wpv-admin-messages.php';
require WPV_PATH_EMBEDDED . '/inc/functions-core-embedded.php';

require_once WPV_PATH_EMBEDDED . '/common/wp-pointer.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-shortcodes.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-shortcodes-in-shortcodes.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-shortcodes-gui.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-layout-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-meta-html-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-pagination-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-archive-loop.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-category-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-custom-field-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-order-by-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-post-types-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-search-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-status-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-author-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-users-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-usermeta-field-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-id-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-parent-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-types-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-post-relationship-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-taxonomy-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-limit-embedded.php';


require WPV_PATH_EMBEDDED . '/inc/wpv-user-functions.php';

require WPV_PATH_EMBEDDED . '/inc/wpv-widgets.php';

require WPV_PATH_EMBEDDED . '/inc/wpv.class.php';

require WPV_PATH_EMBEDDED . '/inc/wpv-condition.php';

require WPV_PATH_EMBEDDED . '/common/WPML/wpml-string-shortcode.php';
require WPV_PATH_EMBEDDED . '/inc/WPML/wpv_wpml.php';


if (is_admin()) {
    require WPV_PATH_EMBEDDED . '/inc/wpv-import-export-embedded.php';
}

global $WP_Views;
$WP_Views = new WP_Views();

require WPV_PATH . '/inc/views-templates/functions-templates.php';
require WPV_PATH . '/inc/views-templates/wpv-template.class.php';

global $WPV_templates;
$WPV_templates = new WPV_template();

require WPV_PATH_EMBEDDED . '/inc/wpv-summary-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-readonly-embedded.php';

function wpv_get_affiliate_url() {
    global $wpv_theme_import;
    
    $affiliate_url = '?utm_source=viewsplugin&utm_campaign=views&utm_medium=affiliate-link&utm_term=http://www.wp-types.com';
    if ($wpv_theme_import != '') {
		include $wpv_theme_import;
        
        if (isset($affiliate_id) && isset($affiliate_key)) {
            $affiliate_url = '&aid=' . $affiliate_id . '&affiliate_key=' . $affiliate_key;
        }
        
    }
    
    return $affiliate_url;

}
function wpv_promote_views_admin() {
    global $wpdb, $wpv_theme_import;
    
    $view_template_available = $wpdb->get_results("SELECT ID, post_name FROM {$wpdb->posts} WHERE post_type='view-template' AND post_status in ('publish')");
    $view_available = $wpdb->get_results("SELECT ID, post_name FROM {$wpdb->posts} WHERE post_type='view' AND post_status in ('publish')");
    
    $affiliate_url = wpv_get_affiliate_url();

    ?>
    
    <?php
        if (sizeof($view_available) > 0) {
            echo '<p>' . __('Views are lists and groups of content, like a listing or showcase page. On your theme the following Views are defined:', 'wpv-views') . "</p>\n";
            echo "<ul style='margin-left:20px;'>\n";
            foreach($view_available as $view) {
                echo "<li>" . $view->post_name . "</li>\n";
            }
            echo "</ul>\n";
        }
        if (sizeof($view_template_available) > 0) {
            echo '<p>' . __('Content Templates are applied to pages to create different layouts. On your theme the following Content Templates are defined:', 'wpv-views') . "</p>\n";
            echo "<ul style='margin-left:20px;'>\n";
            foreach($view_template_available as $template) {
                echo "<li>" . $template->post_name . "</li>\n";
            }
            echo "</ul>\n";
        }
    ?>
    <p><?php echo sprintf(__('If you want to edit these or create your own you can purchase the full version of <strong>Views</strong> from %s', 'wpv-views'),
                            '<a href="http://wp-types.com/' . $affiliate_url . '" target="_blank">http://wp-types.com/ &raquo;</a>'); ?></p>
    
    <?php
    
}

if (!is_admin()) {
	add_action('init', 'wpv_add_jquery');

    function wpv_add_jquery() {
		wp_enqueue_script('jquery');
	}
}
