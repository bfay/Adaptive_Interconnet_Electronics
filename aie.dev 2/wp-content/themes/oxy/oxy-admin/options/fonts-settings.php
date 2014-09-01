<?php
function generate_fonts_options_setting_fields($tab = '') {
    global $shortname;
    $color_schema = get_color_schema();
    $of_options = array(
        'main' => array(
            array("name" => 'Color scheme:',
                "desc" => 'Select any predefine color schema',
                "id" =>  'color_scheme',
                "std" => "color_schema",
                "type" => "color_schema",
                "class"=> "color_schema_link_list",
                "sbubtype" => $color_schema,
            ),
            array(
                "name" => 'Body font:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_body_font",
                "type" => "googlefonts",
                "std" => ''           
            ),
            array(
                "name" => 'Body font size:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_body_font_size",
                "type" => "select",
                "std" => '12',
                "options" => array(
                    '12'=>'12px',
                    '13'=>'13px',
                    '14'=>'14px',
                    '15'=>'15px',
                    '16'=>'16px',
                    '17'=>'17px',
                    '18'=>'18px',
                    '19'=>'19px',
                    '20'=>'20px',
                    '21'=>'21px',
                    '22'=>'22px',
                    '23'=>'23px',
                    '24'=>'24px',
                    ),
            ),
            array(
                "name" => 'Headings and Product Name:',                
                "type" => "sub-heading",                
            ),
            array(
                "name" => 'Headings and Product Name font:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_title_font",
                "type" => "googlefonts",
                "std" => ''           
            ),
            array(
                "name" => 'Headings and Product Name font Weight:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_title_font_weight",
                "type" => "select",
                "options" => array('normal'=>'Normal','bold'=>'Bold'),
                "std" => 'normal'           
            ),
            array(
                "name" => 'Headings and Product Name font Uppercase:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_title_font_uppercase",
                "type" => "iphone_checkboxes",
                "std" => '1'           
            ),
            array(
                "name" => 'Price:',                
                "type" => "sub-heading",                
            ),
            array(
                "name" => 'Price font:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_price_font",
                "type" => "googlefonts",
                "std" => ''           
            ),
            array(
                "name" => 'Price font weight:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_price_font_weight",
                "type" => "select",
                "std" => 'normal',
                "options" => array('normal'=>'Normal','bold'=>'Bold'),                
            ),
            
            
            array(
                "name" => 'Button:',                
                "type" => "sub-heading",                
            ),
            array(
                "name" => 'Button font:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_button_font",
                "type" => "googlefonts",
                "std" => ''           
            ),
            array(
                "name" => 'Button font weight:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_button_font_weight",
                "type" => "select",
                "std" => 'normal',
                "options" => array('normal'=>'Normal','bold'=>'Bold'),                
            ),
            array(
                "name" => 'Button font Uppercase:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_button_font_uppercase",
                "type" => "iphone_checkboxes",
                "std" => '1'           
            ),
            
            array(
                "name" => 'Search:',                
                "type" => "sub-heading",                
            ),
            array(
                "name" => 'Search font:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_search_font",
                "type" => "googlefonts",
                "std" => ''           
            ),
            array(
                "name" => 'Search font weight:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_search_font_weight",
                "type" => "select",
                "std" => 'normal',
                "options" => array('normal'=>'Normal','bold'=>'Bold'),                
            ),
            array(
                "name" => 'Search font size:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_search_font_size",
                "type" => "select",
                "std" => '13',
                "options" => array(
                    '12'=>'12px',
                    '13'=>'13px',
                    '14'=>'14px',
                    '15'=>'15px',
                    '16'=>'16px',
                    '17'=>'17px',
                    '18'=>'18px',
                    '19'=>'19px',
                    '20'=>'20px',
                    '21'=>'21px',
                    '22'=>'22px',
                    '23'=>'23px',
                    '24'=>'24px',
                    ),
            ),
            array(
                "name" => 'Search font Uppercase:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_search_font_uppercase",
                "type" => "iphone_checkboxes",
                "std" => '1'           
            ),
            
            array(
                "name" => 'Cart:',                
                "type" => "sub-heading",                
            ),
            array(
                "name" => 'Cart font:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_cart_font",
                "type" => "googlefonts",
                "std" => ''           
            ),
            array(
                "name" => 'Cart font weight:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_cart_font_weight",
                "type" => "select",
                "std" => 'normal',
                "options" => array('normal'=>'Normal','bold'=>'Bold'),                
            ),
            array(
                "name" => 'Cart font size:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_cart_font_size",
                "type" => "select",
                "std" => '17',
                "options" => array(
                    '12'=>'12px',
                    '13'=>'13px',
                    '14'=>'14px',
                    '15'=>'15px',
                    '16'=>'16px',
                    '17'=>'17px',
                    '18'=>'18px',
                    '19'=>'19px',
                    '20'=>'20px',
                    '21'=>'21px',
                    '22'=>'22px',
                    '23'=>'23px',
                    '24'=>'24px',
                    ),
            ),
            array(
                "name" => 'Cart font Uppercase:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_cart_font_uppercase",
                "type" => "iphone_checkboxes",
                "std" => '0'           
            ),
            array(
                "name" => 'Main menu:',                
                "type" => "sub-heading",                
            ),
            array(
                "name" => 'Main menu font:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_main_menu_font",
                "type" => "googlefonts",
                "std" => ''           
            ),
            array(
                "name" => 'Main menu font weight:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_mm_font_weight",
                "type" => "select",
                "std" => 'normal',
                "options" => array('normal'=>'Normal','bold'=>'Bold'),                
            ),
            array(
                "name" => 'Main menu font size:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_mm_font_size",
                "type" => "select",
                "std" => '16',
                "options" => array(
                    '12'=>'12px',
                    '13'=>'13px',
                    '14'=>'14px',
                    '15'=>'15px',
                    '16'=>'16px',
                    '17'=>'17px',
                    '18'=>'18px',
                    '19'=>'19px',
                    '20'=>'20px',
                    '21'=>'21px',
                    '22'=>'22px',
                    '23'=>'23px',
                    '24'=>'24px',
                    ),
            ),
            array(
                "name" => 'Main menu font Uppercase:',
                // "desc" => "Custom block Content in product page",
                "id" => $shortname . "_mm_font_uppercase",
                "type" => "iphone_checkboxes",
                "std" => '1'           
            ),
            
        ),        
        
    );
    
    if (!empty($tab))
        return $of_options[$tab];
    else
        return $of_options;
    
}

function get_fonts_options_setting_fields($tab) {

    return generate_fields(generate_fonts_options_setting_fields($tab));
    
}