<?php

function generate_footer_options_setting_fields($tab = '') {

    global $shortname,$oxy_image_url;
    $color_schema = get_color_schema();
    $of_options = array();
    
    $of_options['feature-box'] = array(
        array("name" => 'Color scheme:',
            "desc" => 'Select any predefine color schema',
            "id" =>  'color_scheme',
            "std" => "color_schema",
            "type" => "color_schema",
             "class"=> "color_schema_link_list",
             "sbubtype" => $color_schema,            
        ),
        array(
            "name" => 'Feature box 1:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#f_1",
        ),
        array("name" => 'Feature box 1 Status',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_fp_fb1_status",
            "std" => '1', //$image_url_logo
            "type" => "iphone_checkboxes",
        ),
        array("name" => 'Feature box 1 Icon',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_fp_fb1_icon",
            "std" => $oxy_image_url.'fbb_icon_1.png', //$image_url_logo
            "type" => "upload",
        ),
        
//        array("name" => 'Title:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_fp_fb1_title1',
//            "std" => "100% Fluid Responsive",
//            "type" => "text",
//            "options" => array('' => ''
//            )
//        ),
//        array("name" => 'Subtitle:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_fp_fb1_subtitle1',
//            "std" => "Small subtitle here",
//            "type" => "text",
//            "options" => array('' => ''
//            )
//        ),
//        array("name" => 'Content:',
//            // "desc" => "Custom block Content in product page",
//            "id" => $shortname . "_fp_fb1_content1", //_fp_fb1_content1_arialbl
//            "type" => "textarea",
//            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
//            , "lang" => TRUE
//        ),
        array(
            "name" => 'Feature box 2:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#f_2",
        ),
        array("name" => 'Feature box 2 Status',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_fp_fb2_status",
            "std" => '1', //$image_url_logo
            "type" => "iphone_checkboxes",
        ),
        array("name" => 'Feature box 2 Icon',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_fp_fb2_icon",
            "std" => $oxy_image_url.'fbb_icon_1.png', //$image_url_logo
            "type" => "upload",
        ),
        
//        array("name" => 'Title:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_fp_fb2_title1',
//            "std" => "5 Ready-Made Skins",
//            "type" => "text",
//            "options" => array('' => ''
//            )
//        ),
//        array("name" => 'Subtitle:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_fp_fb2_subtitle1',
//            "std" => "Small subtitle here",
//            "type" => "text",
//            "options" => array('' => ''
//            )
//        ),
//        array("name" => 'Content:',
//            // "desc" => "Custom block Content in product page",
//            "id" => $shortname . "_fp_fb2_content1",
//            "type" => "textarea",
//            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
//            , "lang" => TRUE
//        ),
        
        array(
            "name" => 'Feature box 3:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#f_3",
        ),
        array("name" => 'Feature box 3 Status',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_fp_fb3_status",
            "std" => '1',
            "type" => "iphone_checkboxes",
        ),
        array("name" => 'Feature box 3 Icon',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_fp_fb3_icon",
            "std" => $oxy_image_url.'fbb_icon_1.png', //$image_url_logo
            "type" => "upload",
        ),
        
//        array("name" => 'Title:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_fp_fb3_title1',
//            "std" => "10 Product Page Layouts",
//            "type" => "text",
//            "options" => array('' => ''
//            )
//        ),
//        array("name" => 'Subtitle:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_fp_fb3_subtitle1',
//            "std" => "Small subtitle here",
//            "type" => "text",
//            "options" => array('' => ''
//            )
//        ),
//        array("name" => 'Content:',
//            // "desc" => "Custom block Content in product page",
//            "id" => $shortname . "_fp_fb3_content1",
//            "type" => "textarea",
//            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
//            , "lang" => TRUE
//        ),
        
        array(
            "name" => 'Feature box 4:',
            "type" => "sub_heading_tab", 
            "help_tip" => "#f_4",
        ),
        array("name" => 'Feature box 4 Status',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_fp_fb4_status",
            "std" => '1', //$image_url_logo
            "type" => "iphone_checkboxes",
        ),
        array("name" => 'Feature box 4 Icon',
            "desc" => 'Upload a custom logo for your Website.',
            "id" => $shortname . "_fp_fb4_icon",
            "std" => $oxy_image_url.'fbb_icon_1.png',
            "type" => "upload",
        ),
        
//        array("name" => 'Title:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_fp_fb4_title1',
//            "std" => "Max-Width 1440px",
//            "type" => "text",
//            "options" => array('' => ''
//            )
//        ),
//        array("name" => 'Subtitle:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_fp_fb4_subtitle1',
//            "std" => "Small subtitle here",
//            "type" => "text",
//            "options" => array('' => ''
//            )
//        ),
//        array("name" => 'Content:',
//            // "desc" => "Custom block Content in product page",
//            "id" => $shortname . "_fp_fb4_content1",
//            "type" => "textarea",
//            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
//            , "lang" => TRUE
//        ),
    );


    $of_options['powered'] = array(
        
        array("name" => 'Show powered by:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_powered_status',
            "std" => "1",
            "type" => "iphone_checkboxes", 
            "help_tip" => "#f_14",
        ),
//        array("name" => 'Content:',
//            // "desc" => "Custom block Content in product page",
//            "id" => $shortname . "_powered_content1",
//            "type" => "textarea",
//            "std" => '&copy; Copyright 2013. <a href="http://smartdatasoft.com/oxy/">OXY Theme</a> by Smartdatasoft. <a href="#">Buy This Theme!</a><br>
//Powered by <a href="http://wordpress.com/">Wordpress</a>'
//            , "lang" => TRUE
//        ),
    );

    $of_options['payment-images'] = array(
        array("name" => 'Show payment icons',
            //"desc" => "Show background color:",
            "id" => $shortname . "_payment_block_status",
            "type" => "iphone_checkboxes",
            "std" => 1,
            "help_tip" => "#f_15",
        ),
        array("name" => 'Show Paypal icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_paypal",
            "type" => "iphone_checkboxes",
            "std" => 1
        ),
        array("name" => 'PayPal',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_paypal',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_paypal.png",
            "type" => "media"
        ),
        array("name" => 'Paypal URL:',
            "id" => $shortname . '_payment_paypal_url',
            "std" => "https://www.paypal.com",
            "type" => "text",
        ),
        array("name" => 'Show Visa icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_visa",
            "type" => "iphone_checkboxes",
            "std" => 1
        ),
        array("name" => 'Visa',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_visa',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_visa.png",
            "type" => "media"
        ),
        array("name" => 'Visa URL:',
            "id" => $shortname . '_payment_visa_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show MasterCard icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_mastercard",
            "type" => "iphone_checkboxes",
            "std" => 1
        ),
        array("name" => 'MasterCard',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_mastercard',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_mastercard.png",
            "type" => "media"
        ),
        array("name" => 'MasterCard URL:',
            "id" => $shortname . '_payment_mastercard_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Maestro icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_maestro",
            "type" => "iphone_checkboxes",
            "std" => 1
        ),
        array("name" => 'Maestro',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_maestro',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_maestro.png",
            "type" => "media"
        ),
        array("name" => 'Maestro URL:',
            "id" => $shortname . '_payment_maestro_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Discover icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_discover",
            "type" => "iphone_checkboxes",
            "std" => 1
        ),
        array("name" => 'Discover',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_discover',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_discover.png",
            "type" => "media"
        ),
        array("name" => 'Discover URL:',
            "id" => $shortname . '_payment_discover_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Moneybookers icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_moneybookers",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'Moneybookers',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_moneybookers',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_moneybookers.png",
            "type" => "media"
        ),
        array("name" => 'Moneybookers URL:',
            "id" => $shortname . '_payment_moneybookers_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show American Express',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_american_express",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'American Express',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_american_express',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_american_express.png",
            "type" => "media"
        ),
        array("name" => 'American Express URL:',
            "id" => $shortname . '_payment_american_express_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Cirrus icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_cirrus",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'Cirrus',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_cirrus',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_cirrus.png",
            "type" => "media"
        ),
        array("name" => 'Cirrus URL:',
            "id" => $shortname . '_payment_cirrus_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Delta icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_delta",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'Delta',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_delta',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_delta.png",
            "type" => "media"
        ),
        array("name" => 'Delta URL:',
            "id" => $shortname . '_payment_delta_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Google Checkout icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_google",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'Google Checkout',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_google',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_google.png",
            "type" => "media"
        ),
        array("name" => 'Google Checkout URL:',
            "id" => $shortname . '_payment_google_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show 2CheckOut icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_2co",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => '2CheckOut',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_2co',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_2co.png",
            "type" => "media"
        ),
        array("name" => '2CheckOut URL:',
            "id" => $shortname . '_payment_2co_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Sage icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_sage",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'Sage',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_sage',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_sage.png",
            "type" => "media"
        ),
        array("name" => 'Sage URL:',
            "id" => $shortname . '_payment_sage_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Solo icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_solo",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'Solo',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_solo',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_solo.png",
            "type" => "media"
        ),
        array("name" => 'Solo URL:',
            "id" => $shortname . '_payment_solo_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Switch icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_switch",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'Switch',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_switch',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_switch.png",
            "type" => "media"
        ),
        array("name" => 'Switch URL:',
            "id" => $shortname . '_payment_switch_url',
            "std" => "",
            "type" => "text",
        ),
        array("name" => 'Show Western Union icon',
            //"desc" => "Show background color:",
            "id" => $shortname . "_show_western_union",
            "type" => "iphone_checkboxes",
            "std" => 0
        ),
        array("name" => 'Western Union',
            // "desc" => 'Background Attachment',
            "id" => $shortname . '_payment_western_union',
            "std" => get_template_directory_uri() . "/image/payment/payment_image_western_union.png",
            "type" => "media"
        ),
        array("name" => 'Western Union URL:',
            "id" => $shortname . '_payment_western_union_url',
            "std" => "",
            "type" => "text",
        ),
    );

    $of_options['custom-block'] = array(
        array("name" => 'Show Bottom Custom Block:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_custom_3_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
            "help_tip" => "#f_16",
        ),
//        array("name" => 'Content:',
//            // "desc" => "Custom block Content in product page",
//            "id" => $shortname . "_custom_3_content1",
//            "type" => "textarea",
//            "std" => '<p>This is a CMS block edited from theme admin panel. You can insert any content (text, images, HTML) here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque non dui at sapien tempor gravida ut vel arcu. Maecenas odio arcu, feugiat vel congue feugiat, laoreet vitae diam. In hac habitasse platea dictumst. Morbi consectetur nunc porta ligula tempor et varius nibh sollicitudin. Mauris risus felis, adipiscing eu consequat ac, aliquam vel urna. Duis bibendum sapien nec mi egestas tempor.</p>'            
//        ),
    );


    if (!empty($tab))
        return $of_options[$tab];
    else
        return $of_options;
}

function get_footer_options_setting_fields($tab) {

    return generate_fields(generate_footer_options_setting_fields($tab));
}
