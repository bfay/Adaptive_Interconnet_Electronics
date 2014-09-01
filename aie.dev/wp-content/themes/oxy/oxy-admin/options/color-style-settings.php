<?php
	
function generate_styles_options_setting_fields($tab = '') {

    global $shortname, $oxy_image_url;
   //$color_schema = array();

    $color_schema = get_color_schema();

    $of_options = array();

    $of_options['general'] = array(
        
        array("name" => 'Color scheme:',
            "desc" => 'Select any predefine color schema',
            "id" =>  'color_scheme',
            "std" => "color_schema",
            "type" => "color_schema",
             "class"=> "color_schema_link_list",

             "sbubtype" => $color_schema,
            
        ),
        
        array("name" => 'Load cached css style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_cached_css_status',
            "std" => "0",
            "type" => "iphone_checkboxes",
            
        ),
        
         
        array("name" => 'General icons style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_general_icons_style',
            "std" => "1",            
            "type" => "images",
            "options" => array(
                '1' => "{$oxy_image_url}oxy-compare-1.png",
                '2' => "{$oxy_image_url}oxy-compare-2.png",
            )
        ),
        array("name" => 'Show main column background color:',
            "help_tip" => "#cas_8",
            "id" => $shortname . '_main_column_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        
        array("name" => 'Show main column border:',
            "help_tip" => "#cas_6",
            "id" => $shortname . '_main_column_border_status',
            "std" => "0",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Main column border size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_main_column_border_size',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Main column border style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_main_column_border_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
       
        array("name" => 'Show main column box shadow:',
            "help_tip" => "#cas_7",
            "id" => $shortname . '_main_column_shadow',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        
        array("name" => 'Show content column headings border:',
            "help_tip" => "#cas_10",
            "id" => $shortname . '_content_color_head_border_status', //oxy_content_column_head_border_status
            "std" => "1",
            "type" => "iphone_checkboxes",
           
        ),
        array("name" => 'Content column headings border size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_content_column_head_border_size', //oxy_content_column_head_border_size
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Content column headings border style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_content_column_head_border_style', //oxy_content_column_separator_style
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array("name" => 'Content column separator size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_content_column_separator_size', //oxy_content_column_separator_size
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Content column separator style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_content_column_separator_style', //oxy_content_column_separator_style
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        array(
            "name" => 'Left Column:',
            "type" => "sub_heading_tab",             
        ),
        array("name" => 'Show left column headings background color:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_left_column_head_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        
        array(
            "name" => 'Show left column headings background image:',
            "desc" => 'Upload a custom logo for your Website.',
            "help_tip" => "#cas_13",
            "id" => $shortname . "_left_column_head_custom",
            "std" => '', //$image_url_logo
            "type" => "upload",
        ),
        
        array("name" => 'Show left column headings border:',
            "help_tip" => "#cas_15",
            "id" => $shortname . '_left_column_head_border_status', //oxy_left_column_head_border_status
            "std" => "0",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Show left column headings border size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_left_column_head_border_size', //oxy_left_column_head_border_size
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Show left column headings border style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_left_column_head_border_style', //oxy_left_column_head_border_style
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
       
        array("name" => 'Show left column box background color:',
            "help_tip" => "#cas_16",
            "id" => $shortname . '_left_column_box_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        
//        array("name" => 'Left column box background color:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_left_column_box_bg_color',
//            "std" => "#464646",
//            "type" => "color",            
//        ),
//        array("name" => 'Links color:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_left_column_box_links_color',
//            "std" => "#464646",
//            "type" => "color",            
//        ),
        
        
        
        array(
            "name" => 'Right Column:',
            "type" => "sub_heading_tab",             
        ),
        array("name" => 'Show right column heading background color:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_right_column_head_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        
        array("name" => 'Right column heading custom background:',
            "help_tip" => "#cas_13",
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_right_column_head_custom",
            "std" => '', //$image_url_logo
            "type" => "upload",
        ),
        
        array("name" => 'Show Right column heading border:',
            "help_tip" => "#cas_15",
            "id" => $shortname . '_right_color_head_border_status', //oxy_right_column_head_border_status
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Right column heading border size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_right_color_head_border_size', //oxy_right_column_head_border_size
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Right column heading border style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_right_color_head_border_style', //oxy_right_column_head_border_style
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array("name" => 'Show Right column box background color:',
            "help_tip" => "#cas_16",
            "id" => $shortname . '_right_column_box_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
      
    );

    $of_options['buttons'] = array(
        array("name" => 'Button border radius:',
            "help_tip" => "#cas_34",
            "id" => $shortname . '_button_border_radius',
            "std" => "1",
            "type" => "select",
            "options" => array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'
            )
        ),        
    );

    $of_options['top-area-header'] = array(
        array("name" => 'Show background color:',
            "help_tip" => "#cas_38",
            "id" => $shortname . '_top_area_status',
            "std" => "0",
            "type" => "iphone_checkboxes",
           
        ),
        
        array("name" => 'Show Top Bar background color:',
            "help_tip" => "#cas_40",
            "id" => $shortname . '_top_area_tb_bg_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
        ),
        
        array("name" => 'Show Top Bar border top:',
            "help_tip" => "#cas_41",
            "id" => $shortname . '_top_area_tb_top_bor_status', //oxy_top_area_tb_top_border_status
            "std" => "0",
            "type" => "iphone_checkboxes",
            
        ),
        
        array("name" => 'Show Top Bar border bottom:',
            "help_tip" => "#cas_42",
            "id" => $shortname . '_top_area_tb_bot_bor_status', //oxy_top_area_tb_bottom_border_status
            "std" => "0",
            "type" => "iphone_checkboxes",
            
        ),
        
        array("name" => "Cart icon style",
            "help_tip" => "#cas_58",
            "id" => $shortname . "_top_area_cart_icon_style",
            "std" => "1",
            "type" => "images",
            "options" => array(
                '1' => $oxy_image_url . 'icon_cart_1.png',
                '2' => $oxy_image_url . 'icon_cart_2.png',
                '3' => $oxy_image_url . 'icon_cart_3.png',
                '4' => $oxy_image_url . 'icon_cart_4.png',
                '5' => $oxy_image_url . 'icon_cart_5.png',
                '6' => $oxy_image_url . 'icon_cart_6.png',
                '7' => $oxy_image_url . 'icon_cart_7.png',
                '8' => $oxy_image_url . 'icon_cart_8.png',
            )
        ),
    );

    $of_options['top-area-main-menu'] = array(
        array("name" => 'Show background color: 	',
            "help_tip" => "#cas_59",
            "id" => $shortname . '_mm_bg_color_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        
        array("name" => 'Show separator:',
            "help_tip" => "#cas_60",
            "id" => $shortname . '_mm_separator_status',
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Separator size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm_separator_size',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Separator style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm_separator_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array("name" => 'Show Top Border:',
            "help_tip" => "#cas_61",
            "id" => $shortname . '_mm_border_top_status',
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Border Size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm_border_top_size',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Border Style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm_border_top_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array("name" => 'Show Border Bottom:',
            "help_tip" => "#cas_62",
            "id" => $shortname . '_mm_border_bottom_status',
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Border Size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm_border_bottom_size',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Border Style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm_border_bottom_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array(
            "name" => 'Parent menu item:',
            "type" => "heading",            
        ),
        
        array("name" => 'Show background color: 	',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm1_bg_color_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
//        
//        array("name" => 'Show background color: 	',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_mm2_bg_color_status',
//            "std" => "0",
//            "type" => "iphone_checkboxes",            
//        ),
//        
//        array("name" => 'Show background color: 	',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_mm3_bg_color_status',
//            "std" => "1",
//            "type" => "iphone_checkboxes",
//            
//        ),
//        
//        array("name" => 'Show background color: 	',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_mm4_bg_color_status',
//            "std" => "1",
//            "type" => "iphone_checkboxes",            
//        ),
//        
//        
//        array("name" => 'Show background color: 	',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_mm6_bg_color_status',
//            "std" => "1",
//            "type" => "iphone_checkboxes",
//            
//        ),
//        
//        array("name" => 'Show background color: 	',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_mm8_bg_color_status',
//            "std" => "1",
//            "type" => "iphone_checkboxes",
//            
//        ),
//        
//        array("name" => 'Show background color: 	',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_mm5_bg_color_status',
//            "std" => "1",
//            "type" => "iphone_checkboxes",
//            
//        ),
//        
//        
//        array("name" => 'Show background color: 	',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_mm7_bg_color_status',
//            "std" => "1",
//            "type" => "iphone_checkboxes",            
//        ),
        
      
        array(
            "name" => 'Sub Menu:',
            "type" => "sub_heading_tab",
            "help_tip" => "#cas_67",
        ),
        
        array("name" => 'Sub menu items border bottom style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm_sub_separator_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array("name" => 'Show sub menu box shadow:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_mm_sub_box_shadow',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        
    );

    $of_options['midsection'] = array(
       
        array("name" => 'Product Box Shadow hover:',
            "help_tip" => "#cas_79",
            "id" => $shortname . '_mid_prod_box_shadow_hover',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        
    );
    
    
    $of_options['footer'] = array(
        
        array(
            "name" => 'About Us, Custom Column, Follow Us, Contact Us:',            
            "type" => "heading",            
        ),
        
        array("name" => 'Titles bottom border size:',
            "help_tip" => "#cas_92",
            "id" => $shortname . '_f1_titles_border_bottom_size', //oxy_f1_titles_border_bottom_size
            "std" => "2",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Titles bottom border style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f1_titles_border_bottom_style', //_f1_titles_border_bottom_style
            "std" => "dotted",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
       
        array("name" => 'Show Top border:',
            "help_tip" => "#cas_97",
            "id" => $shortname . '_f1_border_top_status',
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Top border size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f1_border_top_size',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Top border style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f1_border_top_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array(
            "name" => 'Footer 2nd Row:',            
            "type" => "heading",            
        ),
        
        
        array("name" => 'Titles bottom border size:',
            "help_tip" => "#cas_101",
            "id" => $shortname . '_f2_titles_border_bottom_size', //oxy_f2_titles_border_bottom_size
            "std" => "1",
            "type" => "select",
            "options" => array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Titles bottom border style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f2_titles_border_bottom_style', //oxy_f2_titles_border_bottom_style
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array("name" => 'Show top border:',
            "help_tip" => "#cas_104",
            "id" => $shortname . '_f2_border_top_status',
            "std" => "0",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Top border size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f2_border_top_size',
            "std" => "1",
            "type" => "select",
            "options" => array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Top border style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f2_border_top_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array(
            "name" => 'Footer Powered by, Payment Images:',            
            "type" => "heading",            
        ),
        
        array("name" => 'Show top border:',
            "help_tip" => "#cas_110",
            "id" => $shortname . '_f4_border_top_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Top border size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f4_border_top_size',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f4_border_top_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
        array(
            "name" => 'Footer Custom Block:',            
            "type" => "heading",            
        ),
        
        array("name" => 'Show top border:',
            "help_tip" => "#cas_116",
            "id" => $shortname . '_f5_border_top_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            
        ),
        array("name" => 'Top border Size:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f5_border_top_size',
            "std" => "1",
            "type" => "select",
            "options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'
            )
        ),
        array("name" => 'Top border Style:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_f5_border_top_style',
            "std" => "solid",
            "type" => "select",
            "options" => array('solid' => 'Solid', 'dotted' => 'Dotted', 'dashed' => 'Dashed'
            )
        ),
        
    );
    $of_options['colorie'] = array(
        
        array(
            "name" => 'Import &amp; export color values:',            
            "type" => "heading",            
        ),
        array(
            "desc" => '',
            "type" => "color-transfer",            
        ),
    );

    if (!empty($tab))
        return $of_options[$tab];
    else
        return $of_options;
}

function get_styles_options_setting_fields($tab) {

    return generate_fields(generate_styles_options_setting_fields($tab));
}

?>