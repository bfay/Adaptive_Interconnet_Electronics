<?php

function generate_custom_css_options_setting_fields($tab = '') {
    global $shortname;
    $of_options = array();
    $of_options['custom-css'] = array(
            array(
            "name" => 'Custom CSS:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_custom_css",
            "type" => "textarea",
            "std" => ''            
        ));       
       $of_options['custom-js'] = array(
            array(
            "name" => 'Custom JavaScript:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_custom_js",
            "type" => "textarea",
            "std" => ''            
        ));
    
    if (!empty($tab))
        return $of_options[$tab];
    else
        return $of_options;
    
}

function get_custom_css_options_setting_fields($tab) {

    return generate_fields(generate_custom_css_options_setting_fields($tab));
    
}