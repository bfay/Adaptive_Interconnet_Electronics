<?php

function oxy_get_pattern_images_src($type = 'transparent') {

    $bg_transparent_images_path = get_template_directory() . "/image/patterns/{$type}/"; // change this to where you store your bg images         
    $bg_transparent_images_url = get_template_directory_uri() . "/image/patterns/{$type}/"; // change this to where you store your bg images
    $bg_transparent_images = array();

    if (is_dir($bg_transparent_images_path)) {
        if ($bg_images_dir = opendir($bg_transparent_images_path)) {
            while (($bg_images_file = readdir($bg_images_dir)) !== false) {
                if (stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {                    
                    preg_match('/\d+/',$bg_images_file,$match);
                    $key = $match[0];
                    $bg_transparent_images["p{$key}"] = $bg_transparent_images_url . $bg_images_file;
                }
            }
        }
    }
    if (!empty($bg_transparent_images))
        return $bg_transparent_images;

    return false;
}

function generate_bg_options_setting_fields($tab = '') {
    global $shortname, $bgp, $oxy_image_url;
    $color_schema = get_color_schema();
    $bg_transparent_images = oxy_get_pattern_images_src();
    $bg_non_transparent_images = oxy_get_pattern_images_src('non_transparent');
    
    $bgp = array(''=> 'none');
    $bgp = array_merge($bgp,$bg_transparent_images);    
    $bgp = array_merge($bgp,$bg_non_transparent_images);
    
    array_walk($bgp, create_function('&$item,$key','preg_match("/\d+/",basename($item),$match); if(isset($match[0]) && !empty($match[0])) $item = $match[0]; '));
    
    
    
    $of_options = array();
    $of_options['body'] = array(
        
        array("name" => 'Color scheme:',
            "desc" => 'Select any predefine color schema',
            "id" =>  'color_scheme',
            "std" => "color_schema",
            "type" => "color_schema",
             "class"=> "color_schema_link_list",
             "sbubtype" => $color_schema,            
        ),
        array(
            "name" => 'Body:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#cas_1",
        ),
        array("name" => 'Upload your own pattern or background image:',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_bg_image_custom",
            "std" => $oxy_image_url.'main_bg_5.jpg', //$image_url_logo
            "type" => "upload",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_position',
            "std" => "top center",
            "type" => "select",
            "options" => array('top center' => 'Top center', 'top left' => 'Top left', 'top right' => 'Top right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom center', 'bottom left' => 'Bottom left', 'bottom right' => 'Bottom right'
            )
        ),
        array("name" => 'Repeat:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_repeat',
            "std" => "repeat",
            "type" => "select",
            "options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat'
            )
        ),
        array("name" => 'Attachment:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_attachment',
            "std" => "fixed",
            "type" => "select",
            "options" => array('scroll' => 'Scroll', 'fixed' => 'Fixed'
            )
        ),
        array("name" => 'Body background pattern:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . "_pattern_oxy",
            "std" => "",
            "type" => "select",
            "options" => $bgp
        ),
        
        array("name" => "",
            // "desc" => "Select a background pattern.",            
            "type" => "pattern_tiles_showcase",
            "transparent_options" => $bg_transparent_images,
            "non_transparent_options" => $bg_non_transparent_images
        ),
    );

    $of_options['main-column'] = array(
        array(
            "name" => 'Main Column:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#cas_8",
        ),
        array("name" => 'Upload your own pattern or background image:',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_bg_image_mc_custom",
            "std" => '', //$image_url_logo
            "type" => "upload",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_mc_position',
            "std" => "top center",
            "type" => "select",
            "options" => array('top center' => 'Top center', 'top left' => 'Top left', 'top right' => 'Top right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom center', 'bottom left' => 'Bottom left', 'bottom right' => 'Bottom right'
            )
        ),
        array("name" => 'Repeat:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_mc_repeat',
            "std" => "2",
            "type" => "select",
            "options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat'
            )
        ),
        array("name" => 'Attachment:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_mc_attachment',
            "std" => "scroll",
            "type" => "select",
            "options" => array('scroll' => 'Scroll', 'fixed' => 'Fixed'
            )
        ),
        array("name" => 'Main column pattern background:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . "_pattern_oxy_mc",
            "std" => "scroll",
            "type" => "select",
            "options" => $bgp
        ),
        
        array("name" => "",
            // "desc" => "Select a background pattern.",            
            "type" => "pattern_tiles_showcase",
            "transparent_options" => $bg_transparent_images,
            "non_transparent_options" => $bg_non_transparent_images
        ),
        
    );

    $of_options['top-area'] = array(
        array(
            "name" => 'Header:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#cas_38",
        ),
        array("name" => 'Upload your own pattern or background image:',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_bg_image_ta_custom",
            "std" => '', //$image_url_logo
            "type" => "upload",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_ta_position',
            "std" => "top center",
            "type" => "select",
            "options" => array('top center' => 'Top center', 'top left' => 'Top left', 'top right' => 'Top right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom center', 'bottom left' => 'Bottom left', 'bottom right' => 'Bottom right'
            )
        ),
        array("name" => 'Repeat:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_ta_repeat',
            "std" => "2",
            "type" => "select",
            "options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat'
            )
        ),
        array("name" => 'Attachment:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_ta_attachment',
            "std" => "scroll",
            "type" => "select",
            "options" => array('scroll' => 'Scroll', 'fixed' => 'Fixed'
            )
        ),
        
        array("name" => 'Header pattern background:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . "_pattern_oxy_ta",
            "std" => "scroll",
            "type" => "select",
            "options" => $bgp
        ),
        
        array("name" => "",
            // "desc" => "Select a background pattern.",            
            "type" => "pattern_tiles_showcase",
            "transparent_options" => $bg_transparent_images,
            "non_transparent_options" => $bg_non_transparent_images
        ),
        
    );

    $of_options['main-menu'] = array(
        array(
            "name" => 'Main Menu:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#cas_59",
        ),
        array("name" => 'Main Menu Custom Background:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_mm_custom',
            "std" => "",
            "type" => "upload",
           
        ),
        array("name" => 'Repeat:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_mm_repeat',
            "std" => "repeat",
            "type" => "select",
            "options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat'
            )
        ),
        array("name" => 'Main Menu pattern background:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . "_pattern_oxy_mm",
            "std" => "",
            "type" => "select",
            "options" => $bgp
        ),
        
        array("name" => "",                        
            "type" => "pattern_tiles_showcase",
            "transparent_options" => $bg_transparent_images,
            "non_transparent_options" => $bg_non_transparent_images
        ),
        
    );

    $of_options['footer'] = array(
        array(
            "name" => 'Footer:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#cas_89",
        ),
        array("name" => 'About Us, Custom Column, Follow Us, Contact Us',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_pattern_oxy_f1',
            "std" => "",
            "type" => "select",
            "options" => $bgp
        ),
        array("name" => 'Upload your own pattern or background image:',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_bg_image_f1_custom",
            "std" => '', //$image_url_logo
            "type" => "upload",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_f1_position',
            "std" => "top center",
            "type" => "select",
            "options" => array('top center' => 'Top center', 'top left' => 'Top left', 'top right' => 'Top right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom center', 'bottom left' => 'Bottom left', 'bottom right' => 'Bottom right'
            )
        ),
        array("name" => 'Repeat:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_f1_repeat',
            "std" => "repeat",
            "type" => "select",
            "options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat'
            )
        ),
        array("name" => 'Information, Customer Service, Extras, My Account',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_pattern_oxy_f2',
            "std" => "",
            "type" => "select",
            "options" => $bgp
        ),
        array("name" => 'Upload your own pattern or background image:',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_bg_image_f2_custom",
            "std" => '', //$image_url_logo
            "type" => "upload",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_f2_position',
            "std" => "top center",
            "type" => "select",
            "options" => array('top center' => 'Top center', 'top left' => 'Top left', 'top right' => 'Top right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom center', 'bottom left' => 'Bottom left', 'bottom right' => 'Bottom right'
            )
        ),
        array("name" => 'Repeat:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_f2_repeat',
            "std" => "repeat",
            "type" => "select",
            "options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat'
            )
        ),
        array("name" => 'Powered by, Payment Images',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_pattern_oxy_f4',
            "std" => "",
            "type" => "select",
            "options" => $bgp
        ),
        array("name" => 'Upload your own pattern or background image:',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_bg_image_f4_custom",
            "std" => '', //$image_url_logo
            "type" => "upload",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_f4_position',
            "std" => "top center",
            "type" => "select",
            "options" => array('top center' => 'Top center', 'top left' => 'Top left', 'top right' => 'Top right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom center', 'bottom left' => 'Bottom left', 'bottom right' => 'Bottom right'
            )
        ),
        array("name" => 'Repeat:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_f4_repeat',
            "std" => "2",
            "type" => "select",
            "options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat'
            )
        ),
        array("name" => 'Bottom Custom Block',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_pattern_oxy_f5',
            "std" => "",
            "type" => "select",
            "options" => $bgp
        ),
        array("name" => 'Upload your own pattern or background image:',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_bg_image_f5_custom",
            "std" => '', //$image_url_logo
            "type" => "upload",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_f5_position',
            "std" => "top center",
            "type" => "select",
            "options" => array('top center' => 'Top center', 'top left' => 'Top left', 'top right' => 'Top right', 'center' => 'Center', 'left' => 'Left', 'right' => 'Right', 'bottom center' => 'Bottom center', 'bottom left' => 'Bottom left', 'bottom right' => 'Bottom right'
            )
        ),
        array("name" => 'Repeat:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_bg_image_f5_repeat',
            "std" => "2",
            "type" => "select",
            "options" => array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No repeat'
            )
        ),
        array("name" => "Background Paterns",            
            "type" => "pattern_tiles_showcase",
            "transparent_options" => $bg_transparent_images,
            "non_transparent_options" => $bg_non_transparent_images
        ),
    );

    if (!empty($tab))
        return $of_options[$tab];
    else
        return $of_options;
}

function get_bg_options_setting_fields($tab) {

    return generate_fields(generate_bg_options_setting_fields($tab));
}

