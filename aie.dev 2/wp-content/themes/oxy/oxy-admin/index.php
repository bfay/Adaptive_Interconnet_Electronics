<?php
/*
  @package  Oxy
  URI: http://smartdatasoft.com
  Description:
  Version: 1.0
  Author: Muhammad Arifur Rahman from SDS Team
  Author URI: http://smartdatasoft.com
 */
// global varibles

if(!defined('ABSPATH')) die();

define('SWPF_THEME_URL', get_template_directory_uri());
define('SWPF_THEME_DIR', get_template_directory());

global $sds_oxy_admin;
$sds_oxy_admin = "Oxy Admin Panel";

global $sds_oxy_db_version;
$sds_oxy_db_version = "1.0";

global $sds_oxy_admin_base_url;
//$sds_oxy_admin_base_url = WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), "", plugin_basename(__FILE__));
$sds_oxy_admin_base_url = SWPF_THEME_URL.'/'.  basename(dirname(__FILE__)).'/';



if (!defined('OXY_ADMIN_PLUGIN_URL'))
    define('OXY_ADMIN_PLUGIN_URL', $sds_oxy_admin_base_url);

define('ADMIN_DIR',OXY_ADMIN_PLUGIN_URL);

global $sds_oxy_admin_base_baseFile;
//$sds_oxy_admin_base_baseFile = WP_PLUGIN_URL . '/' . plugin_basename(__FILE__);
$sds_oxy_admin_base_baseFile = $sds_oxy_admin_base_url;

$shortname = "oxy";


//include __DIR__.'/options/options-loader.php';
include SWPF_THEME_DIR.'/'.basename(dirname(__FILE__)).'/options/options-loader.php';


class Options_Machine{
    /*
    * Mega Menu functions
    */

    public static function get_categories(){

           global $wpdb;			
           $res = $wpdb->get_results("select * from $wpdb->term_taxonomy tt left join $wpdb->terms t on tt.term_id = t.term_id where tt.taxonomy = 'product_cat'");			
           if(!is_wp_error($res)) return $res;				
           return false;						
    }

    public static function product_cat_items_option($data){
        
        
       $terms = Options_Machine::get_categories();
       
       $catmenu = "<option value=\"\">None</option>";
       if(!empty($terms) && function_exists('WC')):					

               foreach($terms as $term):
                       $selected = "";
                       if(intval($data) == intval($term->term_id)):
                               $selected = "selected=\"selected\"";
                       endif;
                       $title = '';
                       $titlearray = array();
                       $id = $term->parent;

                       for(;;):
                               $pr = get_term($id,'product_cat');

                               if(!is_wp_error($pr)):
                                       $id = $pr->parent;
                                       $titlearray[] = $pr->name;
                               endif;

                               if($id == 0) break;
                       endfor;

                       if(!empty($titlearray)):
                               $titlearray = array_reverse($titlearray);
                               foreach($titlearray as $a)
                                   $title .= "$a &raquo; ";

                       endif;
                       $title .= $term->name;
                       $catmenu .= "<option $selected value=\"$term->term_id\">".addslashes($title)."</option>";
               endforeach;



       endif;

       //$catmenu .= '</select></div>';                    
       return $catmenu;


    }
    public static function primary_menu_items_array($menu_loc = 'primary'){

       $menuid = get_nav_menu_locations();

       $newmenu = array('' => 'Select');

       if (isset($menuid[$menu_loc])) {
           $menu = wp_get_nav_menu_object($menuid[$menu_loc]);
           $items = wp_get_nav_menu_items($menu); 
           
           if(!empty($items))
               foreach($items as $item)
                   $newmenu[$item->object_id] = $item->title;

       }
       
       return $newmenu;

    }

    public static function primary_menu_items_option($data,$menu_loc = 'primary'){

       $menuid = get_nav_menu_locations();
       $menu_items = "<option value=\"\">Select</option>";
       if (isset($menuid[$menu_loc])) {
           $menu = wp_get_nav_menu_object($menuid[$menu_loc]);
           $items = wp_get_nav_menu_items($menu);

           if (!empty($items)) {      
               
               foreach ($items as $item) {
                   if($item->menu_item_parent == 0){
                        $selected = $data == $item->object_id ? 'selected="selected"' : '';
                        $menu_items .= "<option {$selected} value=\"{$item->object_id}\">{$item->title}</option>";
                   }
               }

           }

   }
   //$menu_items .= "</select></div>";

   return $menu_items;

}


public static function optionsframework_mega_menu_function($id,$std,$oldorder,$order){
    
    $smof_data = get_oxy_option('oxy-general-settings');   
    $slider = '';
    $slide = array();
    if (isset($smof_data[$id]))
    $slide = $smof_data[$id];

       
       
   if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}

       if(count($slide) < 2)
           $order = 1;

       //initialize all vars
       $slidevars = array('menu_id','category_id','display_style','show_icon','orderby','order','limit','menu_top','menu_bottom');

       foreach ($slidevars as $slidevar) {
               if (!isset($val[$slidevar])) {
                       $val[$slidevar] = '';
               }
       }

       //begin slider interface	

       $slider .= '<li><div class="slide_header"><strong>Item '.$order.'</strong>';


       $slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';

       $slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';

       $slider .= '<div class="slide_body">';

       $slider .= '<label>Menu Item</label>';
       $slider .= '<div class="select_wrapper ">'
           .'<select class="slide select of-input" name="'.$id.'['.$order.'][menu_id]" id="'. $id .'_'.$order .'_slide_menu_id">';
       $slider .= Options_Machine::primary_menu_items_option($val['menu_id']);
       $slider .= "</select></div>";

       $slider .= '<label>Base Category</label>';
       $slider .= '<div class="slide select_wrapper">'
           ."<select class='slide select of-input' name='{$id}[{$order}][category_id]' id='{$id}_{$order}_slide_category_id'>";

       $slider .= Options_Machine::product_cat_items_option($val['category_id']);
       $slider .= "</select></div>";

       $selected1 = $selected2 = '';
       if($val['display_style'] == 2)
           $selected2 = 'selected="selected"';
       else
           $selected1 = 'selected="selected"';
       
       $slider .= '<label>Display Style</label><div class="slide select_wrapper">';
       $slider .= "<select class='slide select of-input' name='{$id}[{$order}][display_style]' id='{$id}_{$order}_slide_display_style'>";       
       $slider .= "<option value='1' {$selected1}>Horizontal</option>";
       $slider .= "<option value='2' {$selected2}>Vertical</option>";
       $slider .= "</select></div>";
       
       $selected1 = $selected2 = '';
       if($val['show_icon'] == 2)
           $selected2 = 'selected="selected"';
       else
           $selected1 = 'selected="selected"';
       
       $slider .= '<label>Show Icon(Horizontal only)</label><div class="slide select_wrapper">';
       $slider .= "<select class='slide select of-input' name='{$id}[{$order}][show_icon]' id='{$id}_{$order}_slide_show_icon'>";       
       $slider .= "<option value='1' {$selected1}>No</option>";
       $slider .= "<option value='2' {$selected2}>Yes</option>";
       $slider .= "</select></div>";
       
       
       
       $slider .= '<label>Order By</label><div class="slide select_wrapper">';
       $slider .= "<select class='slide select of-input' name='{$id}[{$order}][orderby]' id='{$id}_{$order}_slide_orderby'>";
       $oxy_menu_orderby = array('name','id','count','slug');
       foreach($oxy_menu_orderby as $key => $v){
            $selected1 = '';
            if($v == $val['orderby'])
                $selected1 = 'selected="selected"';
            
            $slider .= "<option value='{$v}' {$selected1}>{$v}</option>";
       
       }
       $slider .= "</select></div>";
       
       $selected1 = $selected2 = '';
       if($val['order'] == 'DESC')
           $selected2 = 'selected="selected"';
       else
           $selected1 = 'selected="selected"';
       
       $slider .= '<label>Order</label><div class="slide select_wrapper">';
       $slider .= "<select class='slide select of-input' name='{$id}[{$order}][order]' id='{$id}_{$order}_slide_order'>";       
       $slider .= "<option value='ASC' {$selected1}>ASC</option>";
       $slider .= "<option value='DESC' {$selected2}>DESC</option>";
       $slider .= "</select></div>";
       
       $slider .= '<label>Child Category Limit(Horizontal only)</label>';
       $slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][limit]" id="'. $id .'_'.$order .'_slide_limit" value="'. $val['limit'] .'" />';

       $slider .= '<label>Top Content</label>';
       $slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][menu_top]" id="'. $id .'_'.$order .'_slide_menu_top" cols="8" rows="8">'.stripslashes($val['menu_top']).'</textarea>';

//       $slider .= '<label>Right Content</label>';
//       $slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][menu_right]" id="'. $id .'_'.$order .'_slide_menu_right" cols="8" rows="8">'.stripslashes($val['menu_right']).'</textarea>';

       $slider .= '<label>Bottom Content</label>';
       $slider .= '<textarea class="slide of-input" name="'. $id .'['.$order.'][menu_bottom]" id="'. $id .'_'.$order .'_slide_menu_bottom" cols="8" rows="8">'.stripslashes($val['menu_bottom']).'</textarea>';

       $slider .= '<a class="slide_delete_button delete_megamenu" href="#">Delete</a>';
       $slider .= '<div class="clear"></div>' . "\n";

       $slider .= '</div>';
       $slider .= '</li>';

       return $slider;

    }
    
    
}

function get_oxy_option($name){
    $modval = get_theme_mod($name);
    if(!empty($modval)){ 
        $newval = unserialize($modval);   
        
        return $newval;        
    }    
    return false;
}

function of_save_options($oxy_data, $option_name, $savedirect = true){
    
    if(empty($oxy_data) or empty($option_name)) return false;
    
    $new_data = $oxy_data;
    
    if(!$savedirect){
        $new_data = array();    
        foreach($oxy_data as $lv1){
            foreach($lv1 as $value){
                if(isset($value['id'])){
                    if(isset($value['std']))
                        $new_data[$value['id']] = $value['std'];
                    else
                        $new_data[$value['id']] = '';
                }
            }        
        }
    }
    
    $json_data = serialize($new_data);    
    set_theme_mod($option_name,$json_data);
    
    if(file_exists(SWPF_THEME_DIR.'/css/custom_style.php')){        
        $filename = SWPF_THEME_DIR.'/css/custom_style.css';        
        if(is_dir(SWPF_THEME_DIR.'/css') && ($contents = @file_get_contents(SWPF_THEME_URL.'/css/custom_style.php')) !== FALSE){
            try{
                file_put_contents($filename, $contents);
            }catch(Exception $e){
                throw new Exception(SWPF_THEME_DIR.'/css/custom_style.css file is not writeable.');
            }
        }
    }
        
}

function sds_save_admin_text_fields($oxy_data){
   if(!empty($oxy_data)){                    
       foreach($oxy_data as $key=>$value){
           update_option($key, $value); 
       }
   }
   return true;
}
function sds_init_save_admin_text_fields($fields){
    foreach($fields as $f1){
        foreach($f1 as $field){
            if($field['type'] == 'text' || $field['type'] == 'textarea'){
                if(!get_option($field['id']))
                    update_option($field['id'],$field['std']);
            }
        }
    }
    
}

add_action('admin_init','oxy_preloader');

function oxy_preloader(){
    global $oxy_options;
    
    if(isset($_POST['oxy-theme-option-nonce'])) return;
    
    $optnames = array_values($oxy_options);
    $values = get_theme_mod($optnames[0]);
     
    if(empty($values)){
        
        $fields = generate_texts_options_setting_fields();
        sds_init_save_admin_text_fields($fields);
        
        foreach($oxy_options as $key => $opt_name){        
        
            switch($opt_name){
                case 'oxy-general-settings':                                

                        $fields = generate_general_options_setting_fields();
                        of_save_options($fields, $opt_name, false);

                    break;
                case 'oxy-color-style-settings':

                        $fields = generate_styles_options_setting_fields();
                        of_save_options($fields, $opt_name, false);

                    break;
                case 'oxy-background-images-settings':
                        
                        $fields = generate_bg_options_setting_fields();
                        of_save_options($fields, $opt_name, false);
                        
                    break;
                case 'oxy-fonts-settings':

                    break;
                case 'oxy-footer-settings':

                        $fields = generate_footer_options_setting_fields();
                        of_save_options($fields, $opt_name, false);
                    
                    break;
                case 'oxy-widgets-settings':

                        $fields = generate_widgets_options_setting_fields();
                        of_save_options($fields, $opt_name, false);
                    
                    break;
                case 'oxy-custom-css-settings':
                        
                        $fields = generate_custom_css_options_setting_fields();
                        of_save_options($fields, $opt_name, false);
                        
                    break;
            }
        }
    }
    
}

function of_reset_options(){
    global $oxy_options;
    foreach($oxy_options as $name)
        remove_theme_mod($name);    
}


add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

function of_ajax_callback() 
{
	global $oxy_options;
	
        if(!isset($_POST['security'])) die('-1');
        
        $nonce = $_POST['security'];
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
        
        
        $opt_name = (isset($_POST['tabname']) && isset($oxy_options[$_POST['tabname']])) ? $oxy_options[$_POST['tabname']] : '';
	
	$save_type = $_POST['type'];
	
	//Uploads
	if($save_type == 'upload')
	{
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			of_save_options($upload_image);
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	}
	elseif($save_type == 'image_reset')
	{
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			of_save_options($delete_image ) ;
	
	}
	elseif($save_type == 'backup_options')
	{
			
		$backup = $all;
		$backup['backup_log'] = date('r');
		
		of_save_options($backup, BACKUPS) ;
			
		die('1'); 
	}
	elseif($save_type == 'restore_options')
	{
			
		$smof_data = of_get_options(BACKUPS);

		of_save_options($smof_data);
		
		die('1'); 
	}
	elseif($save_type == 'import_options'){

                $oxy_color_data = base64_decode($_POST['data']);                
                update_option('oxy_color_settings',  unserialize($oxy_color_data));                
		die('1'); 
	}
	elseif ($save_type == 'save')
	{
            
		wp_parse_str(stripslashes($_POST['data']), $smof_data);
                
		unset($smof_data['security']);
		unset($smof_data['of_save']);
                unset($smof_data['tab_page']);
                
               
                if(!empty($opt_name) && $_POST['tabname'] != 'oxy_text_fields_settings'){
                        
                        of_save_options($smof_data, $opt_name);
                        
                    }else{
                        
                        sds_save_admin_text_fields($smof_data);
                    }
                    
                   
                
		
		die('1');
	}
	elseif ($save_type == 'reset')
	{
            of_reset_options();		
            die('1'); //options reset
	}

	elseif($save_type == 'import_schema_options')

	{

		$smof_color_data = get_option( 'oxy_color_settings' ); // array

		$color_schema_array = get_color_schema();

		$new_color_schema_array = array();





 $selected_option = array();





/*at first we have to find which optio is selected*/



foreach($color_schema_array as $options):

			foreach($options as $key=>$opt):

				if(($key=='schema_id')&&($opt==$_POST['schema_id'])):

 						$selected_option = $options ;

				endif;


			endforeach;	

	endforeach;



/*now we need to populate the predefine color schema array value to customizer*/


 
foreach($smof_color_data as $key=>$options):


 
if (array_key_exists($key, $selected_option)) :

	$new_color_schema_array[$key]= $selected_option[$key];
	else:
	//print_r( $smof_color_data[$key]);
	$new_color_schema_array[$key]= $smof_color_data[$key];
	endif;
	

	endforeach;

 

	update_option('oxy_color_settings',$new_color_schema_array);

        
        echo  json_encode($selected_option);

	}

  	die();
}










/*
 * includes files
 */

function sds_oxy_admin_setting() {

    $settings_tab = isset($_GET['page']) ? $_GET['page'] : '';
    
    ?>
    <script type="text/javascript">

        jQuery(function($) {
            
            $('.vtabs > a:first-child').addClass('selected');
            var defelem = $('.vtabs > a:first-child').attr('href');
            $(defelem).show();
            $('.vtabs >  a').click(function() {                
                var elem = $(this).attr('href');
                $('.vtabs-content').hide();
                $('.vtabs > a').removeClass('selected');
                $(this).addClass('selected');
                $(elem).fadeIn(400);
                return false;
            });
        });

    </script>
    <?php

    include('includes/general-settings.php');


    switch ($settings_tab) {

        case 'oxy_color_style_settings':
            include('includes/color-style-settings.php');
            break;
        case 'oxy_background_images':
            include ('includes/background-images.php');
            break;
        case 'oxy_fonts':
            include('includes/fonts-settings.php');
            break;
        case 'oxy_footer_settings':
            include('includes/footer-settings.php');
            break;
        case 'oxy_widgets_settings':
            include('includes/widgets-settings.php');
            break;
        case 'oxy_custom_css':
            include('includes/custom-css-settings.php');
            break;
        case 'oxy_text_fields_settings':            
            include('includes/text-fields-settings.php');
            break;
        default:            
            include('includes/general-options-settings.php');
            break;
    }
}

function sds_oxy_admin_menu() {

//register settings page
    
        $of_page =   add_menu_page('Oxy Theme Options', 'Oxy Admin', 'manage_options', 'oxy-admin', 'sds_oxy_admin_setting', '');

        $submenus = array(
            'oxy_color_style_settings' => array('Colors &amp; Styles','Color Settings'),
            'oxy_background_images' => array('Background Images','Background Settings'),
            'oxy_fonts' => array('Fonts','Font Settings'),
            'oxy_footer_settings' => array('Footer','Footer Settings'),
            'oxy_widgets_settings' => array('Widgets','Widget Settings'),
            'oxy_custom_css' => array('Custom CSS','Custom CSS'),
            'oxy_text_fields_settings' => array('Custom Text Fields','Custom Text Fields'),
            );
        add_submenu_page('oxy-admin','General Options', 'General Options', 'manage_options', 'oxy-admin', 'sds_oxy_admin_setting', '');
        
        foreach($submenus as $menu_tab => $submenu){
            $of_sub_page = add_submenu_page('oxy-admin',$submenu[0],$submenu[1],'manage_options',$menu_tab,'sds_oxy_admin_setting');
            
            add_action("admin_print_scripts-$of_sub_page", 'of_load_only');
            add_action("admin_print_styles-$of_sub_page",'of_style_only');
        }
       
         
    	add_action("admin_print_scripts-$of_page", 'of_load_only');
	add_action("admin_print_styles-$of_page",'of_style_only');
}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function of_style_only(){
	wp_enqueue_style('admin-style', ADMIN_DIR . 'assets/css/admin-style.css');
	
	wp_enqueue_style('jquery-ui-custom-admin', ADMIN_DIR .'assets/css/jquery-ui-custom.css');
	wp_enqueue_style('admin-iphone-style', ADMIN_DIR . 'assets/css/iphone-style-checkboxes.css');

	wp_enqueue_style('tip-twitter', ADMIN_DIR . 'assets/css/tip-twitter.css');

	if ( !wp_style_is( 'wp-color-picker','registered' ) ) {
		wp_register_style( 'wp-color-picker', ADMIN_DIR . 'assets/css/color-picker.min.css' );
	}
	wp_enqueue_style( 'wp-color-picker' );
	do_action('of_style_only_after');
}	

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function of_load_only() 
{
	//add_action('admin_head', 'smof_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-input-mask', ADMIN_DIR .'assets/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('tipsy', ADMIN_DIR .'assets/js/jquery.tipsy.js', array( 'jquery' ));
	//wp_enqueue_script('color-picker', ADMIN_DIR .'assets/js/colorpicker.js', array('jquery'));
	
	wp_enqueue_script('admin-iphone', ADMIN_DIR . 'assets/js/iphone-style-checkboxes.js', 'jquery');
	
	wp_enqueue_script('admin-jquery-maskedinput', ADMIN_DIR . 'assets/js/jquery.maskedinput-1.2.2.js', 'jquery');
	//wp_enqueue_script('admin-dependClass', ADMIN_DIR . 'assets/js/jquery.dependClass.js', 'jquery');
	
	wp_enqueue_script('poshytip', ADMIN_DIR . 'assets/js/jquery.poshytip.js', 'jquery');
	
	wp_enqueue_script('cookie', ADMIN_DIR . 'assets/js/cookie.js', 'jquery');
	
	wp_enqueue_script('smof', ADMIN_DIR .'assets/js/smof.js', array( 'jquery' ));


	// Enqueue colorpicker scripts for versions below 3.5 for compatibility
	if ( !wp_script_is( 'wp-color-picker', 'registered' ) ) {
		wp_register_script( 'iris', ADMIN_DIR .'assets/js/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
		wp_register_script( 'wp-color-picker', ADMIN_DIR .'assets/js/color-picker.min.js', array( 'jquery', 'iris' ) );
	}
	wp_enqueue_script( 'wp-color-picker' );
	

	/**
	 * Enqueue scripts for file uploader
	 */
	
	if ( function_exists( 'wp_enqueue_media' ) )
		wp_enqueue_media();

	do_action('of_load_only_after');

}


add_action('admin_menu', 'sds_oxy_admin_menu');



function generate_fields($options) {
    
    global $oxy_options, $oxy_doc_url;
    $output = '';
    $counter = 0;
    $setting_op_name = $oxy_options['oxy_general_settings'];
//    if(isset($_GET['tab']) && !empty($_GET['tab']) && array_key_exists($_GET['tab'],$oxy_options))
//        $setting_op_name = $oxy_options[$_GET['tab']];
    
    if(isset($_GET['page']) && !empty($_GET['page']) && array_key_exists($_GET['page'],$oxy_options))
        $setting_op_name = $oxy_options[$_GET['page']];
    
    
    
    $smof_data = get_theme_mod($setting_op_name);    
    $smof_data = unserialize($smof_data);
    
    foreach ($options as $value):

        $counter++;
        $val = '';
//        // sanitize option
//        if ($value['type'] != "heading")
//            $value = $value;

        //Start Heading
        if ($value['type'] != "heading") {


            $class = '';
            if (isset($value['class'])) {
                $class = $value['class'];
            }

            //hide items in checkbox group
            $fold = '';
            if (array_key_exists("fold", $value)) {
                if (isset($smof_data[$value['fold']]) && $smof_data[$value['fold']]) {
                    $fold = "f_" . $value['fold'] . " ";
                } else {
                    $fold = "f_" . $value['fold'] . " temphide ";
                }
            }

            $output .= '<div class="' . $fold . 'section section-' . $value['type'] . ' ' . $class . '">' . "\n";

            //only show header if 'name' value exists
            //only show header if 'name' value exists
            if (!isset($value['help_tip']) && isset($value['name'])) {

                $output .= '<h3 class="heading">' . $value['name'] . '</h3>';
            } elseif (isset($value['help_tip']) && isset($value['name'])) {
                $output .= '<div style="float:left"><h3 class="heading">' . $value['name'] . '</h3></div><div style="float:left"><span class="sellya_help_tip"><a target="_blank" href="'.$oxy_doc_url.$value['help_tip'].'">?</a>
					</span></div>';
            }


            if ($value['type'] != "sub_heading_tab") :

                $output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
            else:
                $output .= '<div class="option">' . "\n" . '<div>' . "\n";
            endif;
        }
        //End Heading
        //if (!isset($smof_data[$value['id']]) && $value['type'] != "heading")
        //	continue;
        //switch statement to handle various options type                              
        switch ($value['type']) {

            case 'heading':
                $output .= '<div class="section">';                
                $output .= "<h3 class='heading'>{$value['name']}</h3>";
                $output .= '</div>';
                
                break;
            
            case 'megamenu':
                                    
                $output .= '<div class="megamenu_settings"><ul id="'.$value['id'].'">';
                $slides = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : array();
                $count = count($slides);

                if ($count < 2) {
                        $oldorder = 1;
                        $order = 1;
                        
                        if(!empty($slides) && is_array($slides))
                            $mega_menu_order = array_keys($slides);
                        
                        if(isset($mega_menu_order[0]) && is_numeric($mega_menu_order[0]) )
                            $oldorder = $order = $mega_menu_order[0];
                        
                        $output .= Options_Machine::optionsframework_mega_menu_function($value['id'],$value['std'],$oldorder,$order);
                } else {
                        $i = 0;
                        foreach ($slides as $slide) {
                                $oldorder = $slide['order'];
                                $i++;

                                $order = $i;
                                $output .= Options_Machine::optionsframework_mega_menu_function($value['id'],$value['std'],$oldorder,$order);
                        }
                }			
                $output .= '</ul>';
                $output .= '<a href="#" class="button mega_menu_add_button">Add New Mega Menu</a></div>';

            break;
              case 'color_schema':

                    

                        $i = 0;



                        $output .= '<div id="div_' . $value['id'] . '" class="color_scheme">';



                       // if ($this->get_option($value['id']))

                        //    $select_value = $this->get_option($value['id']);

                     //   else

                       //     $select_value = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];



                        /*

                        $output .=' <div style="margin-left:0px;" class="color-buttons">

                                <div style="float:left;margin-left:0px;">

                                <input value="My theme" name="color_scheme_name" class="color_scheme_name" id="color_scheme_name" style=""> 

                                </div><a id="exportColors">Save color scheme</a> 

                                <div style="float:right;margin-left:0px;">

                                <select id="import_scheme_name" name="import_scheme_name">

                                <option value="0">SimpleGreat Default</option>

                                    ';

                        

                        

                         foreach ($value['sbubtype'] as $key => $option) {

                             

                           

                              $output .='<option value="'.$i.'">My them'.$key.'</option>'   ;

                              

                         }

                        

                       $output .=' 

                                        </select>

                                        <a id="importColors">Load color scheme</a> 

                                        <a id="deleteColors">Delete selected scheme</a>

                                        </div>

                                        <div style="clear:both">

                                        </div>

                                        </div>';

                             */           

                        foreach ($value['sbubtype'] as $key => $option) {

                            $i++;



                            $active = $style = $class = $data = "";

                            if (isset($option['style']))

                                $style = " style ='" . $option['style'] . "'";



                            $select_value = '';



                            if (isset($option['color_scheme']) && $select_value == $option['color_scheme'])

                                $active = " active_color_scheme";

                            #active

                            //color_scheme

                            foreach ($option as $datakey => $datavalue) {

                                $data .="data-" . $datakey . "='" . $datavalue . "'";

                            }

                            $output .="<a id='color_scheme_" . $i . "' href='#'" . $data . " " . $style . " class ='color_schema_link_list color_scheme_" . $i . $active . $class . "'>" . $key . "</a>";

                        }

                        $output .= '<input type="hidden" value="' . $select_value . '" id="' . $value['std'] . '" name ="' . $value['id'] . '"/>';



                        $output .= '</div>';

                        break;



				 
            //select option
            case 'googlefonts':
                global $googlefonts;
                $mini = '';
                if (!isset($value['mod']))
                    $value['mod'] = '';
                if ($value['mod'] == 'mini') {
                    $mini = 'mini';
                }
                $output .= '<div class="select_wrapper ' . $mini . '">';

                //$googlefonts = Options_Machine::googleFonts();



                $output .= '<select class="of-typography of-typography-face select" name="' . $value['id'] . '" id="' . $value['id'] . '">';
                //selected($data[$value['id']], $option, false) .

                $selected_value = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';

                // echo $value['id'];
                //echo "<br/>" .  $selected_value;
                $selected = '';

                //echo  $selected_value    ;   
                foreach ($googlefonts as $fkey => $fonts) {


                    /*
                      echo "<pre>";
                      print_r(  $fonts);
                      echo "</pre>";
                     */
                    if ($selected_value != '') {
                        if ($selected_value == $fkey) {
                            $selected = ' selected="selected"';
                        } else {
                            $selected = '';
                        }
                    }

                    $output .= '<option id="' . $fkey . '" value="' . $fkey . '" ' . $selected . ' />' . $fonts . '</option>';

                    //  $output .= '<option value="' .$fkey .'">' . $fonts . '</option>';
                }

                $output .= '</select></div>';

                // die();
                break;



            case 'pattern_tiles_showcase':

                $output .= ' <div>Transparent patterns:</div><br />';

                $output .= ' <div style="float:left;margin-bottom:20px" class="bg_transparent">';
                $i = 0;
        
                //usort($value['transparent_options'],  create_function('$a,$b', 'echo $a; echo $b; return 0;'));
                sort($value['transparent_options']);
                
                foreach ($value['transparent_options'] as $key => $option) {
                    $i++;

                    //sellya_body_bg
                    
                    $img_file = basename($option);
                    preg_match('/\d+/',$img_file,$match);
                    $output .= '<span>';
                    
                    $output .= '<div class="of-pattern-tile-img" style="background: url(' . $option . ')"></div><br />'.$match[0];
                    $output .= '</span>';
                }
                $output .= '</div>';


                $output .= ' <div style="float:left;margin-bottom:20px" class="bg_non_transparent">';

                $checked = '';


                $output .= '<div style="float:left;margin-bottom:20px">Non-transparent patterns</div>  ';
                $output .= '<div style="float:left"> ';
                foreach ($value['non_transparent_options'] as $key => $option) {
                    $i++;

                   
                    //$saved_std=$saved_std
                    $img_file = basename($option);
                    preg_match('/\d+/',$img_file,$match);

                    $output .= '<span>';
                    
                    $output .= '<div class="of-pattern-tile-img" style="background: url(' . $option . ')"></div><br />'.$match[0];
                    $output .= '</span>';
                }
                $output .= '</div>';
                $output .= '</div>';
                break; 
                
                
                
                case 'pattern_tiles':



                $output .= ' <div>Transparent patterns:</div><br />';

                $output .= ' <div style="float:left;margin-bottom:20px" class="bg_transparent">';
                $i = 0;
                $checked = '';

                $saved_std = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';


                $std = $value['std'];


                foreach ($value['transparent_options'] as $key => $option) {
                    $i++;

                    //sellya_body_bg
                    //  print_r($option."<br/><br/>");
                    //die();
                    if (!empty($saved_std)) {
                        if ($saved_std == $option) {
                            $selected = 'of-radio-tile-selected';
                            $chk = 'checked';
                        } else {
                            $selected = '';
                            $chk = '';
                        }
                    } elseif ($std == $option) {
                        $selected = 'of-radio-tile-selected';
                        $chk = 'checked';
                    } else {
                        $selected = '';
                        $chk = '';
                    }

                    //$saved_std=$saved_std



                    $output .= '<span>';
                    $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $option . '" name="' . $value['id'] . '"  ' . $chk . '  />';
                    $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
                    $output .= '</span>';
                }
                $output .= '</div>';


                $output .= ' <div style="float:left;margin-bottom:20px" class="bg_non_transparent">';

                $checked = '';


                $output .= '<div style="float:left;margin-bottom:20px">Non-transparent patterns</div>  ';
                $output .= '<div style="float:left"> ';
                foreach ($value['non_transparent_options'] as $key => $option) {
                    $i++;

                    //sellya_body_bg
                    // print_r($key."<br/><br/>");
                    //die();
                    if (!empty($saved_std)) {
                        if ($saved_std == $option) {
                            $selected = 'of-radio-tile-selected';
                            $chk = 'checked';
                        } else {
                            $selected = '';
                            $chk = '';
                        }
                    } elseif ($std == $option) {
                        $selected = 'of-radio-tile-selected';
                        $chk = 'checked';
                    } else {
                        $selected = '';
                        $chk = '';
                    }

                    //$saved_std=$saved_std



                    $output .= '<span>';
                    $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $option . '" name="' . $value['id'] . '"  ' . $chk . '  />';
                    $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
                    $output .= '</span>';
                }
                $output .= '</div>';
                $output .= '</div>';
                break;
            //text input
            //text input
            case 'text':
                $t_value = '';                
                if(isset($smof_data[$value['id']]))
                    $t_value = stripslashes($smof_data[$value['id']]);
                elseif(get_option($value['id']) !== FALSE)                    
                    $t_value = stripslashes(get_option($value['id']));
                elseif(isset($value['std']))
                    $t_value = stripslashes($value['std']);
                
                $mini = '';
                if (!isset($value['mod']))
                    $value['mod'] = '';
                if ($value['mod'] == 'mini') {
                    $mini = 'mini';
                }

                $output .= '<input class="of-input ' . $mini . '" name="' . $value['id'] . '" id="' . $value['id'] . '" type="' . $value['type'] . '" value="' . $t_value . '" />';
                break;

            //select option
            case 'select':

                $mini = '';
                if (!isset($value['mod']))
                    $value['mod'] = '';
                if ($value['mod'] == 'mini') {
                    $mini = 'mini';
                }
                
                $old_selected = '';
                
                if(!isset($smof_data[$value['id']])){                    
                    if(isset($value['std']) and !empty($value['std'])){
                        $old_selected = $value['std'];
                    }
                }
                else
                    $old_selected = $smof_data[$value['id']];
                
                $output .= '<div class="select_wrapper ' . $mini . '">';

                $output .= '<select class="select of-input" name="' . $value['id'] . '" id="' . $value['id'] . '">';

                foreach ($value['options'] as $select_ID => $option) {
                    $theValue = $option;
                    if (!is_numeric($select_ID))
                        $theValue = $select_ID;
                    $output .= '<option id="' . $select_ID . '" value="' . $select_ID . '" ' . selected($old_selected, $select_ID, false) . ' />' . $option . '</option>';
                }
                $output .= '</select></div>';
                break;

            //textarea option
            case 'textarea':


                $cols = '8';
                $ta_value = '';

                if (isset($value['options'])) {
                    $ta_options = $value['options'];
                    if (isset($ta_options['cols'])) {
                        $cols = $ta_options['cols'];
                    }
                }
                if(isset($smof_data[$value['id']]))
                    $ta_value = $smof_data[$value['id']];
                elseif(get_option($value['id']) !== FALSE){
                    $ta_value = get_option($value['id']);                      
                }
                elseif(isset($value['std']))
                    $ta_value = $value['std'];
                
                //$ta_value = stripslashes(get_option($value['id']));
                $output .= '<textarea class="of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" cols="' . $cols . '" rows="8">' . $ta_value . '</textarea>';
                break;

            //radiobox option
            case "radio":

                $checked = (isset($smof_data[$value['id']])) ? checked($smof_data[$value['id']], $option, false) : '';
                foreach ($value['options'] as $option => $name) {
                    $output .= '<input class="of-input of-radio" name="' . $value['id'] . '" type="radio" value="' . $option . '" ' . checked($smof_data[$value['id']], $option, false) . ' /><label class="radio">' . $name . '</label><br/>';
                }
                break;

            //checkbox option
            case 'checkbox':

                if (!isset($smof_data[$value['id']])) {
                    $smof_data[$value['id']] = 0;
                }

                $fold = '';
                if (array_key_exists("folds", $value))
                    $fold = "fld ";

                $output .= '<input type="hidden" class="' . $fold . 'checkbox of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="0"/>';
                $output .= '<input type="checkbox" class="' . $fold . 'checkbox of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="1" ' . checked($smof_data[$value['id']], 1, false) . ' />';
                break;

            //multiple checkbox option
            case 'multicheck':

                (isset($smof_data[$value['id']])) ? $multi_stored = $smof_data[$value['id']] : $multi_stored = "";

                foreach ($value['options'] as $key => $option) {
                    if (!isset($multi_stored[$key])) {
                        $multi_stored[$key] = '';
                    }
                    $of_key_string = $value['id'] . '_' . $key;
                    $output .= '<input type="checkbox" class="checkbox of-input" name="' . $value['id'] . '[' . $key . ']' . '" id="' . $of_key_string . '" value="1" ' . checked($multi_stored[$key], 1, false) . ' /><label class="multicheck" for="' . $of_key_string . '">' . $option . '</label><br />';
                }
                break;

            // Color picker
            case "color":

                $colorval = $default_color = '';
                
                if(isset($smof_data[$value['id']]))
                    $colorval = $smof_data[$value['id']];
                
                if (isset($value['std'])) {
                    $default_color = ' data-default-color="' . $value['std'] . '" ';                    
                }
                $output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" class="of-color"  type="text" value="' . $colorval . '"' . $default_color . ' />';

                break;

            //typography option	
            case 'typography':

                $typography_stored = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];

                /* Font Size */

                if (isset($typography_stored['size'])) {
                    $output .= '<div class="select_wrapper typography-size" original-title="Font size">';
                    $output .= '<select class="of-typography of-typography-size select" name="' . $value['id'] . '[size]" id="' . $value['id'] . '_size">';
                    for ($i = 9; $i < 20; $i++) {
                        $test = $i . 'px';
                        $output .= '<option value="' . $i . 'px" ' . selected($typography_stored['size'], $test, false) . '>' . $i . 'px</option>';
                    }

                    $output .= '</select></div>';
                }

                /* Line Height */
                if (isset($typography_stored['height'])) {

                    $output .= '<div class="select_wrapper typography-height" original-title="Line height">';
                    $output .= '<select class="of-typography of-typography-height select" name="' . $value['id'] . '[height]" id="' . $value['id'] . '_height">';
                    for ($i = 20; $i < 38; $i++) {
                        $test = $i . 'px';
                        $output .= '<option value="' . $i . 'px" ' . selected($typography_stored['height'], $test, false) . '>' . $i . 'px</option>';
                    }

                    $output .= '</select></div>';
                }

                /* Font Face */
                if (isset($typography_stored['face'])) {

                    $output .= '<div class="select_wrapper typography-face" original-title="Font family">';
                    $output .= '<select class="of-typography of-typography-face select" name="' . $value['id'] . '[face]" id="' . $value['id'] . '_face">';

                    $faces = array('arial' => 'Arial',
                        'verdana' => 'Verdana, Geneva',
                        'trebuchet' => 'Trebuchet',
                        'georgia' => 'Georgia',
                        'times' => 'Times New Roman',
                        'tahoma' => 'Tahoma, Geneva',
                        'palatino' => 'Palatino',
                        'helvetica' => 'Helvetica');
                    foreach ($faces as $i => $face) {
                        $output .= '<option value="' . $i . '" ' . selected($typography_stored['face'], $i, false) . '>' . $face . '</option>';
                    }

                    $output .= '</select></div>';
                }

                /* Font Weight */
                if (isset($typography_stored['style'])) {

                    $output .= '<div class="select_wrapper typography-style" original-title="Font style">';
                    $output .= '<select class="of-typography of-typography-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';
                    $styles = array('normal' => 'Normal',
                        'italic' => 'Italic',
                        'bold' => 'Bold',
                        'bold italic' => 'Bold Italic');

                    foreach ($styles as $i => $style) {

                        $output .= '<option value="' . $i . '" ' . selected($typography_stored['style'], $i, false) . '>' . $style . '</option>';
                    }
                    $output .= '</select></div>';
                }

                /* Font Color */
                if (isset($typography_stored['color'])) {

                    $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: ' . $typography_stored['color'] . '"></div></div>';
                    $output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="' . $value['id'] . '[color]" id="' . $value['id'] . '_color" type="text" value="' . $typography_stored['color'] . '" />';
                }

                break;

            //border option
            case 'border':

                /* Border Width */
                $border_stored = $smof_data[$value['id']];

                $output .= '<div class="select_wrapper border-width">';
                $output .= '<select class="of-border of-border-width select" name="' . $value['id'] . '[width]" id="' . $value['id'] . '_width">';
                for ($i = 0; $i < 21; $i++) {
                    $output .= '<option value="' . $i . '" ' . selected($border_stored['width'], $i, false) . '>' . $i . '</option>';
                }
                $output .= '</select></div>';

                /* Border Style */
                $output .= '<div class="select_wrapper border-style">';
                $output .= '<select class="of-border of-border-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';

                $styles = array('none' => 'None',
                    'solid' => 'Solid',
                    'dashed' => 'Dashed',
                    'dotted' => 'Dotted');

                foreach ($styles as $i => $style) {
                    $output .= '<option value="' . $i . '" ' . selected($border_stored['style'], $i, false) . '>' . $style . '</option>';
                }

                $output .= '</select></div>';

                /* Border Color */
                $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: ' . $border_stored['color'] . '"></div></div>';
                $output .= '<input class="of-color of-border of-border-color" name="' . $value['id'] . '[color]" id="' . $value['id'] . '_color" type="text" value="' . $border_stored['color'] . '" />';

                break;

            //images checkbox - use image as checkboxes
            case 'images':

                $i = 0;

                $select_value = (isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : $value['std'];

                foreach ($value['options'] as $key => $option) {
                    $i++;

                    $checked = '';
                    $selected = '';
                    if (NULL != checked($select_value, $key, false)) {
                        $checked = checked($select_value, $key, false);
                        $selected = 'of-radio-img-selected';
                    }
                    $output .= '<span>';
                    $output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . ' />';
                    $output .= '<div class="of-radio-img-label">' . $key . '</div>';
                    $output .= '<img src="' . $option . '" alt="" class="of-radio-img-img ' . $selected . '" onClick="document.getElementById(\'of-radio-img-' . $value['id'] . $i . '\').checked = true;" />';
                    $output .= '</span>';
                }

                break;

            //info (for small intro box etc)
            case "info":
                $info_text = $value['std'];
                $output .= '<div class="of-info">' . $info_text . '</div>';
                break;

            //display a single image
            case "image":
                $src = $value['std'];
                $output .= '<img src="' . $src . '">';
                break;

            //tab heading
//            case 'heading':
//
//                if ($counter >= 2) {
//                    $output .= '</div>' . "\n";
//                }
//                //custom icon
//                $icon = '';
//                if (isset($value['icon'])) {
//                    $icon = ' style="background-image: url(' . $value['icon'] . ');"';
//                }
//                $header_class = str_replace(' ', '', strtolower($value['name']));
//                $jquery_click_hook = str_replace(' ', '', strtolower($value['name']));
//                $jquery_click_hook = "of-option-" . trim(preg_replace('/ +/', '', preg_replace('/[^A-Za-z0-9 ]/', '', urldecode(html_entity_decode(strip_tags($jquery_click_hook))))));
//
//                $menu .= '<li class="' . $header_class . '"><a title="' . $value['name'] . '" href="#' . $jquery_click_hook . '"' . $icon . '>' . $value['name'] . '</a></li>';
//                $output .= '<div class="group" id="' . $jquery_click_hook . '"><h2>' . $value['name'] . '</h2>' . "\n";
//                break;

            //drag & drop slide manager
            case 'slider':

                $output .= '<div class="slider"><ul id="' . $value['id'] . '">';
                $slides = $smof_data[$value['id']];
                $count = count($slides);


                if ($count < 2) {
                    $oldorder = 1;
                    $order = 1;
                    $output .= Options_Machine::optionsframework_slider_function($value['id'], $value['std'], $oldorder, $order);
                } else {
                    $i = 0;
                    foreach ($slides as $slide) {
                        $oldorder = $slide['order'];
                        $i++;
                        $order = $i;
                        $output .= Options_Machine::optionsframework_slider_function($value['id'], $value['std'], $oldorder, $order);
                    }
                }
                $output .= '</ul>';
                $output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';

                break;

            //drag & drop block manager
            case 'sorter':

                // Make sure to get list of all the default blocks first
                $all_blocks = $value['std'];

                $temp = array(); // holds default blocks
                $temp2 = array(); // holds saved blocks

                foreach ($all_blocks as $blocks) {
                    $temp = array_merge($temp, $blocks);
                }

                $sortlists = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];

                foreach ($sortlists as $sortlist) {
                    $temp2 = array_merge($temp2, $sortlist);
                }

                // now let's compare if we have anything missing
                foreach ($temp as $k => $v) {
                    if (!array_key_exists($k, $temp2)) {
                        $sortlists['disabled'][$k] = $v;
                    }
                }

                // now check if saved blocks has blocks not registered under default blocks
                foreach ($sortlists as $key => $sortlist) {
                    foreach ($sortlist as $k => $v) {
                        if (!array_key_exists($k, $temp)) {
                            unset($sortlist[$k]);
                        }
                    }
                    $sortlists[$key] = $sortlist;
                }

                // assuming all sync'ed, now get the correct naming for each block
                foreach ($sortlists as $key => $sortlist) {
                    foreach ($sortlist as $k => $v) {
                        $sortlist[$k] = $temp[$k];
                    }
                    $sortlists[$key] = $sortlist;
                }

                $output .= '<div id="' . $value['id'] . '" class="sorter">';


                if ($sortlists) {

                    foreach ($sortlists as $group => $sortlist) {

                        $output .= '<ul id="' . $value['id'] . '_' . $group . '" class="sortlist_' . $value['id'] . '">';
                        $output .= '<h3>' . $group . '</h3>';

                        foreach ($sortlist as $key => $list) {

                            $output .= '<input class="sorter-placebo" type="hidden" name="' . $value['id'] . '[' . $group . '][placebo]" value="placebo">';

                            if ($key != "placebo") {

                                $output .= '<li id="' . $key . '" class="sortee">';
                                $output .= '<input class="position" type="hidden" name="' . $value['id'] . '[' . $group . '][' . $key . ']" value="' . $list . '">';
                                $output .= $list;
                                $output .= '</li>';
                            }
                        }

                        $output .= '</ul>';
                    }
                }

                $output .= '</div>';
                break;

            //background images option
            case 'tiles':

                $i = 0;
                $select_value = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';
                if (is_array($value['options'])) {
                    foreach ($value['options'] as $key => $option) {
                        $i++;

                        $checked = '';
                        $selected = '';
                        if (NULL != checked($select_value, $option, false)) {
                            $checked = checked($select_value, $option, false);
                            $selected = 'of-radio-tile-selected';
                        }
                        $output .= '<span>';
                        $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $option . '" name="' . $value['id'] . '" ' . $checked . ' />';
                        $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
                        $output .= '</span>';
                    }
                }

                break;

            //backup and restore options data
            case 'backup':

                $instructions = $value['desc'];
                $backup = of_get_options(BACKUPS);
                $init = of_get_options('smof_init');


                if (!isset($backup['backup_log'])) {
                    $log = 'No backups yet';
                } else {
                    $log = $backup['backup_log'];
                }

                $output .= '<div class="backup-box">';
                $output .= '<div class="instructions">' . $instructions . "\n";
                $output .= '<p><strong>' . __('Last Backup : ', 'sellya') . '<span class="backup-log">' . $log . '</span></strong></p></div>' . "\n";
                $output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
                $output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
                $output .= '</div>';

                break;

            //export or import data between different installs
            case 'transfer':

                $instructions = $value['desc'];
                $output .= '<textarea id="export_data" rows="8">' . base64_encode(serialize($smof_data)) /* 100% safe - ignore theme check nag */ . '</textarea>' . "\n";
                $output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';

                break;
            case 'color-transfer':
                
                $oxy_color_settings = get_option('oxy_color_settings');
                
                $instructions = $value['desc'];
                
                $output .= '<textarea id="export_data" rows="8">' . base64_encode(serialize($oxy_color_settings)) /* 100% safe - ignore theme check nag */ . '</textarea>' . "<br />";
                $output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import color</a>';

                break;

            // google font field
            case 'select_google_font':

                $output .= '<div class="select_wrapper">';
                $output .= '<select class="select of-input google_font_select" name="' . $value['id'] . '" id="' . $value['id'] . '">';
                foreach ($value['options'] as $select_key => $option) {
                    $output .= '<option value="' . $select_key . '" ' . selected((isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : "", $option, false) . ' />' . $option . '</option>';
                }
                $output .= '</select></div>';

                if (isset($value['preview']['text'])) {
                    $g_text = $value['preview']['text'];
                } else {
                    $g_text = '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz';
                }
                if (isset($value['preview']['size'])) {
                    $g_size = 'style="font-size: ' . $value['preview']['size'] . ';"';
                } else {
                    $g_size = '';
                }
                $hide = " hide";
                if ($smof_data[$value['id']] != "none" && $smof_data[$value['id']] != "")
                    $hide = "";

                $output .= '<p class="' . $value['id'] . '_ggf_previewer google_font_preview' . $hide . '" ' . $g_size . '>' . $g_text . '</p>';
                break;

            //JQuery UI Slider
            case 'sliderui':

                $s_val = $s_min = $s_max = $s_step = $s_edit = ''; //no errors, please

                $s_val = stripslashes($smof_data[$value['id']]);

                if (!isset($value['min'])) {
                    $s_min = '0';
                } else {
                    $s_min = $value['min'];
                }
                if (!isset($value['max'])) {
                    $s_max = $s_min + 1;
                } else {
                    $s_max = $value['max'];
                }
                if (!isset($value['step'])) {
                    $s_step = '1';
                } else {
                    $s_step = $value['step'];
                }

                if (!isset($value['edit'])) {
                    $s_edit = ' readonly="readonly"';
                } else {
                    $s_edit = '';
                }

                if ($s_val == '')
                    $s_val = $s_min;

                //values
                $s_data = 'data-id="' . $value['id'] . '" data-val="' . $s_val . '" data-min="' . $s_min . '" data-max="' . $s_max . '" data-step="' . $s_step . '"';

                //html output
                $output .= '<input type="text" name="' . $value['id'] . '" id="' . $value['id'] . '" value="' . $s_val . '" class="mini" ' . $s_edit . ' />';
                $output .= '<div id="' . $value['id'] . '-slider" class="smof_sliderui" style="margin-left: 7px;" ' . $s_data . '></div>';

                break;


            //Switch option
            case 'switch':
                if (!isset($smof_data[$value['id']])) {
                    $smof_data[$value['id']] = 0;
                }

                $fold = '';
                if (array_key_exists("folds", $value))
                    $fold = "s_fld ";

                $cb_enabled = $cb_disabled = ''; //no errors, please
                //Get selected
                if ($smof_data[$value['id']] == 1) {
                    $cb_enabled = ' selected';
                    $cb_disabled = '';
                } else {
                    $cb_enabled = '';
                    $cb_disabled = ' selected';
                }

                //Label ON
                if (!isset($value['on'])) {
                    $on = "On";
                } else {
                    $on = $value['on'];
                }

                //Label OFF
                if (!isset($value['off'])) {
                    $off = "Off";
                } else {
                    $off = $value['off'];
                }

                $output .= '<p class="switch-options">';
                $output .= '<label class="' . $fold . 'cb-enable' . $cb_enabled . '" data-id="' . $value['id'] . '"><span>' . $on . '</span></label>';
                $output .= '<label class="' . $fold . 'cb-disable' . $cb_disabled . '" data-id="' . $value['id'] . '"><span>' . $off . '</span></label>';

                $output .= '<input type="hidden" class="' . $fold . 'checkbox of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="0"/>';
                $output .= '<input type="checkbox" id="' . $value['id'] . '" class="' . $fold . 'checkbox of-input main_checkbox" name="' . $value['id'] . '"  value="1" ' . checked($smof_data[$value['id']], 1, false) . ' />';

                $output .= '</p>';

                break;

            // Uploader 3.5
            case "upload":
            case "media":

                if (!isset($value['mod']))
                    $value['mod'] = '';

                $u_val = '';
                
                if (isset($smof_data[$value['id']]))
                    $u_val = stripslashes($smof_data[$value['id']]);
                else
                    $u_val = isset($value['std']) ? $value['std'] : $u_val;

                
                $output .= optionsframework_media_uploader_function($value['id'], $u_val, $value['mod'],$smof_data);

                break;
            case "iphone_checkboxes":

//                if (!isset($smof_data[$value['id']])) {
//
//                    $smof_data[$value['id']] = $value['std'];
//                }


                $saved_std = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];

                $checked = '';

                $saved_std = intval($saved_std);

                if ($saved_std == 1) {
                    $checked = 'checked="checked"';
                } else {
                    $checked = '';
                }
                 

                $fold = '';

                if (array_key_exists("folds", $value))
                    $fold = "fld ";


                $output .= '<input type="hidden" class="' . $fold . 'checkbox aq-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="0"/>';

                $output .= '<input type="checkbox" class="iphone_checkboxes"   name="' . $value['id'] . '" id="' . $value['id'] . '" value="1" ' . $checked . ' />';




                break;
        }



        //description of each option
        if ($value['type'] != 'heading') {
            if (!isset($value['desc'])) {
                $explain_value = '';
            } else {
                $explain_value = '<div class="explain">' . $value['desc'] . '</div>' . "\n";
            }
            $output .= '</div>' . $explain_value . "\n";
            $output .= '<div class="clear"> </div></div></div>' . "\n";
        }

    endforeach;




    return $output;
}

function optionsframework_media_uploader_function($id,$std,$mod, $save_data){

        $smof_data = $save_data;
       
        $uploader = '';
        $upload = "";
        if (isset($smof_data[$id]))
        $upload = $smof_data[$id];
        $hide = '';

        if ($mod == "min") {$hide ='hide';}

    if ( $upload != "") { $val = $upload; } else {$val = $std;}

        $uploader .= '<input type="text" class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'" value="'. $val .'" />';	

        //Upload controls DIV
        $uploader .= '<div class="upload_button_div">';
        //If the user has WP3.5+ show upload/remove button
        if ( function_exists( 'wp_enqueue_media' ) ) {
                $uploader .= '<span class="button media_upload_button" id="'.$id.'">Upload</span>';

                if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
                $uploader .= '<span class="button remove-image '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
        }
        else 
        {
                $output .= '<p class="upload-notice"><i>Upgrade your version of WordPress for full media support.</i></p>';
        }

        $uploader .='</div>' . "\n";

        //Preview
        $uploader .= '<div class="screenshot">';
        if(!empty($upload)){	
        $uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
        $uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
        $uploader .= '</a>';			
                }
        $uploader .= '</div>';
        $uploader .= '<div class="clear"></div>' . "\n"; 

        return $uploader;

}