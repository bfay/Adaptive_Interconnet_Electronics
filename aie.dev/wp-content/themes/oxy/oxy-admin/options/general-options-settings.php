<?php

//add_action('admin_init', 'register_oxy_admin_settings');

function generate_general_options_setting_fields($tab = '') {

    global $shortname, $oxy_image_url;

     $color_schema = array();

     $color_schema = get_color_schema();
        
    $gn_sett_of_options = array();
    /*
     * Layout
     */
    $gn_sett_of_options['layout'] = array(
        array(
            "name" => 'Shop ON/OFF',
            //"desc" => 'Home Page link style:',
            "id" => $shortname . '_enable_shop',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
         array("name" => 'Color scheme:',
            "desc" => 'Select any predefine color schema',
            "id" =>  'color_scheme',
            "std" => "color_schema",
            "type" => "color_schema",
             "class"=> "color_schema_link_list",

             "sbubtype" => $color_schema,
            
        ),
        array(
            "name" => 'Upload favicon',
            //"desc" => 'Upload your own pattern or background image:',
            "id" => $shortname . "_favicon",
            "std" => $oxy_image_url.'cart.png',
            "type" => "upload"
        ),
        array(
            "name" => 'Upload your site logo',
            //"desc" => 'Upload your own pattern or background image:',
            "id" => $shortname . "_sitelogo",
            "std" => $oxy_image_url.'logo_2_oxy_5.png',
            "type" => "upload"
        ),
        array("name" => 'Layout style:',            
            "id" => $shortname . "_layout_style",
            "type" => "select",
            "std" => "1",
            "help_tip" => "#go_36",
            "options" => array('1' => 'Boxed',
                '2' => 'Full width')
        ),
        array("name" => 'Mobile layout (<980px):',
            //"desc" => 'Body Background Position',
            "id" => $shortname . '_layout_s',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Maximum width:',
            "help_tip" => "#go_35",
            "id" => $shortname . '_layout_l',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '980px', '2' => '1170px', '3' => '1440px'
            )
        ),        
    );

    $gn_sett_of_options['header'] = array(
        array("name" => 'Fixed Header (Mini Header):',
            "help_tip" => "#go_2",
            "id" => $shortname . '_header_fixed_header_status',
            "std" => "0",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Quick Search Auto-Suggest:',
            "help_tip" => "#go_3",
            "id" => $shortname . '_header_auto_suggest_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        
        array("name" => 'Quick Search Auto-Suggest Limit:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_header_auto_suggest_limit',
            "std" => "10",
            "type" => "text",            
        ),
        
        array("name" => 'Logo position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_logo_position',
            "std" => "left",
            "type" => "select",
            "options" => array('left' => 'Left', 'center' => 'Center'
            )
        ),
        array("name" => 'Show Search:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_search_bar_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Search Bar position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_search_bar_position',
            "std" => "center",
            "type" => "select",
            "options" => array('right' => 'Right', 'center' => 'Center', 'left' => 'Left'
            )
        ),
//        array("name" => 'Top Bar Custom Content:',            
//            "id" => $shortname . '_top_bar_custom_text',
//            "std" => "Free Ground Shipping on all orders over \$50",
//            "type" => "textarea",
//        ),
       
    );

    $gn_sett_of_options['main-menu'] = array(
        

        array("name" => 'Category Mega Menu:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mega_menu',
            "std" => "",
            "type" => "megamenu",
            "options" => Options_Machine::primary_menu_items_array(),
        ),
        array("name" => 'Show Brands:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_menu_brands_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Show Brands Under:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_menu_brands_page',
            "std" => "0",
            "type" => "select",
            "options" => admin_oxy_menu_items()
        ),
        array("name" => 'Brands display style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_menu_brands_style',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => 'Logo', '2' => 'Name', '3' => 'Logo + Name'
            )
        ),
        array("name" => 'Brands per row:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_menu_brands_per_row',
            "std" => "6",
            "type" => "select",
            "options" => array('3' => '3', '4' => '4', '5' => '5', '6' => '6', '8' => '8', '10' => '10', '12' => '12'
            )
        ),

        array("name" => 'Show Contacts Block:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_menu_contacts_block_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),

        array("name" => 'Show Contacts Under:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_menu_contacts_page',
            "std" => "0",
            "type" => "select",
            "options" => admin_oxy_menu_items()
        ),
        array("name" => 'Title:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contacts_title1',
            "std" => "Contact Us",
            "type" => "text",
        ),
        array("name" => 'Mobile phone 1:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_mphone1',
            "std" => "Call us FREE!",
            "type" => "text",
        ),
        array("name" => 'Mobile phone 2:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_mphone2',
            "std" => "0123 123 1234",
            "type" => "text",
        ),
        array("name" => 'Static phone 1:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_sphone1',
            "std" => "0123 123 1235",
            "type" => "text",
        ),
        array("name" => 'Static phone 2:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_sphone2',
            "std" => "0123 123 1235",
            "type" => "text",
        ),
        array("name" => 'Fax 1:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_fax1',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Fax 2:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_fax2',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'E-mail 1:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_email1',
            "std" => "one@address.com",
            "type" => "text",
        ),
        array("name" => 'E-mail 2:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_email2',
            "std" => "two@address.com",
            "type" => "text",
        ),
        array("name" => 'Skype 1:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_skype1',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Skype 2:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_skype2',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Address 1:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_location1',
            "std" => "135 South Park Avenue",
            "type" => "text",
        ),
        array("name" => 'Address 2:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_location2',
            "std" => "Los Angeles, CA 90024. USA",
            "type" => "text",
        ),

    );

                
    $gn_sett_of_options['category'] = array(
        array("name" => 'Shop page display style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_shop_page_display_style',
            "std" => "1",
            "type" => "images",
            "options" => array(
                '1' => "{$oxy_image_url}oxy_col/category-layout-1.png",
                '2' => "{$oxy_image_url}oxy_col/category-layout-2.png",
                '3' => "{$oxy_image_url}oxy_col/category-layout-3.png",
                '4' => "{$oxy_image_url}oxy_col/category-layout-4.png",
            )
        ),
        array("name" => 'Default products display:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_display',
            "std" => "grid",
            "type" => "images",
            "options" => array(
                'list' => "{$oxy_image_url}oxy_col/list.png",
                'grid' => "{$oxy_image_url}oxy_col/grid.png",
            )
        ),
        array("name" => 'Show subcategories:',
            
            "id" => $shortname . '_cat_subcategories_status', //_category_subcategories_status
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),

        array("name" => 'Products in a row:',
            "help_tip" => "#go_17",
            "id" => $shortname . '_layout_pb_noc',
            "std" => "4",
            "type" => "select",
            "options" => array('2' => '2', '3' => '3', '4' => '4', '6' => '6'
            )
        ),
        array(
            "name" => 'Product Box:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#go_18",
        ),
        array("name" => 'Show sale badge:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_sale_badge_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Show product name:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_name_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Show product brand:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_brand_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Show product price:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_price_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Show "Add to Cart" button:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_cart_button_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Show rating stars:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_ratings_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
           
        ),
        array("name" => 'Show "Add to Wishlist" and "Add to Compare" links:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_cat_prod_wis_com_status', //_category_prod_wis_com_status
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Show zoom image effect:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_zoom_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Show swap image effect:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_swap_status',
            "std" => "0",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Align elements to:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_category_prod_align',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => 'Left', '2' => 'Center'
            )
        ),
    );
    
    $gn_sett_of_options['product'] = array(
        
        array("name" => 'Product Page Sidebar Layout:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_product_page_sidebar_layout',
            "std" => "3",
            "type" => "images",
            "options" => array(
                '1' => $oxy_image_url . 'oxy_col/category-layout-1.png', 
                '2' => $oxy_image_url . 'oxy_col/category-layout-2.png', 
                '3' => $oxy_image_url . 'oxy_col/category-layout-3.png', 
                '4' => $oxy_image_url . 'oxy_col/category-layout-4.png',                 
            )
        ),
        array("name" => 'Product Page Layout:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_layout_product_page',
            "std" => "1",
            "type" => "images",
            "options" => array(
                '1' => $oxy_image_url . 'oxy_img/pl_1.png', 
                '2' => $oxy_image_url . 'oxy_img/pl_2.png', 
                '3' => $oxy_image_url . 'oxy_img/pl_3.png', 
                '4' => $oxy_image_url . 'oxy_img/pl_4.png', 
                '5' => $oxy_image_url . 'oxy_img/pl_5.png', 
                '6' => $oxy_image_url . 'oxy_img/pl_6.png', 
                '7' => $oxy_image_url . 'oxy_img/pl_7.png', 
                '8' => $oxy_image_url . 'oxy_img/pl_8.png', 
                '9' => $oxy_image_url . 'oxy_img/pl_9.png', 
                '10' => $oxy_image_url . 'oxy_img/pl_10.png'
            )
        ),

        array("name" => 'Cloud Zoom:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_product_zoom_type',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Show Save Percent:',
            "help_tip" => "#go_20",
            "id" => $shortname . '_product_save_percent_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array(
            "name" => 'Related Products:',
            "type" => "sub_heading_tab",             
        ),
        array("name" => 'Show related products:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_product_related_status',
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Related products numbers:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_product_related_num',
            "std" => "4",
            "type" => "text",                        
        ),

        array("name" => 'Related products style:',
            "help_tip" => "#go_25",
            "id" => $shortname . '_product_related_style',
            "std" => "0",
            "type" => "select",
            "options" => array('1' => 'Slider', '0' => 'Grid'
            )
        ),
        array("name" => 'Related products columns:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_product_related_cols',
            "std" => "4",
            "type" => "select",
            "options" => array( '3' => '3', '4' => '4' , '6' => '6' 
            )
        ),
        array(
            "name" => 'Custom Tab:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#go_30",
        ),
        array("name" => 'Show custom tab 1:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_product_custom_tab_1_status',
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),
//        array("name" => 'Title:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_product_custom_tab_1_title1',
//            "std" => "Custom Tabs",
//            "type" => "text",
//        ),
//        array("name" => 'Content:',
//            // "desc" => "Custom block Content in product page",
//            "id" => $shortname . "_product_custom_tab_1_content1",
//            "type" => "textarea",
//            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
//            , "lang" => TRUE
//        ),

    );
    $gn_sett_of_options['blog'] = array(
        array("name" => 'Blog page display style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_blog_page_display_style',
            "std" => "1",
            "type" => "images",
            "options" => array(
                '1' => "{$oxy_image_url}oxy_col/category-layout-1.png",
                '2' => "{$oxy_image_url}oxy_col/category-layout-2.png",
                '3' => "{$oxy_image_url}oxy_col/category-layout-3.png",
                '4' => "{$oxy_image_url}oxy_col/category-layout-4.png",
            )
        ),
        array("name" => 'Columns:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_blog_page_columns',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => 'One Column', '2' => 'Two Columns', '3' => 'Three Columns'
            )
        ),
        array("name" => 'Show Related Posts Under Single Post:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_related_posts_status',
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),                
    );
    $gn_sett_of_options['contact'] = array(

        array(
            "name" => 'Google Map:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#go_32",
        ),
        array("name" => 'Show Google Map:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_map_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Latitude, Longitude:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_map_ll',
            "std" => "51.5224954,-0.1720996",
            "type" => "text",
        ),
        array("name" => 'Map type:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_map_type',
            "std" => "ROADMAP",
            "type" => "select",
            "options" => array('ROADMAP' => 'ROADMAP', 'SATELLITE' => 'SATELLITE', 'HYBRID' => 'HYBRID', 'TERRAIN' => 'TERRAIN'
            )
        ),
        array("name" => 'Zoom Level:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_contact_map_zoom',
            "std" => "15",
            "type" => "select",
            "options" => array(                
                '5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12','13' => '13', '14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20','21' => '21',
            )
        ),
        array("name" => 'Show Google Map Marker:',            
            "id" => $shortname . '_gmap_marker_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Marker Text Box Width:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_gmap_marker_textbox_width',
            "std" => "220",
            "type" => "text",
        ),
    );

    $gn_sett_of_options['others'] = array(
        array("name" => 'Show "Scroll To Top" button:',
            "help_tip" => "#go_34",
            "id" => $shortname . '_others_totop',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Google Analytics:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_google_analytics',
            "std" => "",
            "type" => "textarea",
            
        ),
    );
    //register_setting( 'oxy-general-settings', $value['id'] );
    if (!empty($tab))
        return $gn_sett_of_options[$tab];
    else
        return $gn_sett_of_options;
}

function get_general_options_setting_fields($tab) {

    return generate_fields(generate_general_options_setting_fields($tab));
}

?>