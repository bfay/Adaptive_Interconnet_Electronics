<?php

function generate_texts_options_setting_fields($tab = '') {
    global $shortname;
    $of_options = array();
    
    $of_options['widget-custom-box'] = array(
        array(
            'name' =>'Top Area',
            'type' => 'heading'
        ),
       array("name" => 'Top Bar Custom Content:',            
            "id" => $shortname . '_top_bar_custom_text',
            "std" => "Free Ground Shipping on all orders over \$50",
            "type" => "textarea",
            "help_tip" => "#cas_43",
        ),
        
        array(
            'name' =>'Main Menu',
            'type' => 'heading'
        ),
        array("name" => 'Office Opening Hours:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_contact_hours1",
            "type" => "textarea",
            "std" => 'From Monday to Friday 9:00 a.m. to 5:00 p.m.',
            "lang" => TRUE,
            "help_tip" => "#go_13",
        ),
        
        array(
            'name' =>'Widgets',
            'type' => 'heading'
        ),
        array("name" => 'Widget Custom Box Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_custom_box_content1",
            "type" => "textarea",
            "std" => '<p><strong>CUSTOM BOX</strong></p>

<p>This is a CMS Box edited from admin panel. You can display this box on the left or right side.</p>

<p><img alt="" src="http://321theme.com/oxy/image/data/banners/banner_custom_1.png" style="width: 225px; height: 100px;" /></p>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed velit urna, elementum at dignissim varius, euismod a elit. Praesent ornare metus eget metus commodo rhoncus.</p>

<p><a class="button" href="http://wp-demo.oxy-theme.com">Read more</a></p>'
            , "lang" => TRUE
        ),
        
        array(
            'name' =>'Product Page',
            'type' => 'heading'
        ),    
        array("name" => 'Title:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_product_custom_tab_1_title1',
            "std" => "Custom Tab",
            "type" => "text",
            "help_tip" => "#go_30",
        ),
        array("name" => 'Custom Tab Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_product_custom_tab_1_content1",
            "type" => "textarea",
            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.',
            "lang" => TRUE,
            "help_tip" => "#go_30",
        ),
        array(
            'name' =>'Contact Page',
            'type' => 'heading'
        ),    
        array("name" => 'Google Map Marker Text:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_gmap_marker_content',
            "std" => "Custom Tab",
            "type" => "textarea",
            "help_tip" => "#go_32"
        ),
        
        array(
            'name' =>'Footer',
            'type' => 'heading'
        ),
        array(
            'name' =>'Feature box 1',
            'type' => 'sub_heading_tab',
            "help_tip" => "#f_1",
        ),
        array("name" => 'Title:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_fp_fb1_title1',
            "std" => "100% Fluid Responsive",
            "type" => "text",
            
        ),
        array("name" => 'Subtitle:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_fp_fb1_subtitle1',
            "std" => "Small subtitle here",
            "type" => "text",            
        ),
        array("name" => 'Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_fp_fb1_content1", //_fp_fb1_content1_arialbl
            "type" => "textarea",
            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.',
            "lang" => TRUE
        ),
        
        array(
            'name' =>'Feature box 2',
            'type' => 'sub_heading_tab',
            "help_tip" => "#f_2",
        ),
        array("name" => 'Title:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_fp_fb2_title1',
            "std" => "5 Ready-Made Skins",
            "type" => "text",
            
        ),
        array("name" => 'Subtitle:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_fp_fb2_subtitle1',
            "std" => "Small subtitle here",
            "type" => "text",
            
        ),
        array("name" => 'Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_fp_fb2_content1",
            "type" => "textarea",
            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
            , "lang" => TRUE
        ),
        
        array(
            'name' =>'Feature box 3',
            'type' => 'sub_heading_tab',
            "help_tip" => "#f_3",
        ),
        array("name" => 'Title:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_fp_fb3_title1',
            "std" => "10 Product Page Layouts",
            "type" => "text",
            
        ),
        array("name" => 'Subtitle:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_fp_fb3_subtitle1',
            "std" => "Small subtitle here",
            "type" => "text",
            
        ),
        array("name" => 'Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_fp_fb3_content1",
            "type" => "textarea",
            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
            , "lang" => TRUE
        ),
        
        array(
            'name' =>'Feature box 4',
            'type' => 'sub_heading_tab',
            "help_tip" => "#f_4",
        ),
        array("name" => 'Title:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_fp_fb4_title1',
            "std" => "Max-Width 1440px",
            "type" => "text",
            
        ),
        array("name" => 'Subtitle:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_fp_fb4_subtitle1',
            "std" => "Small subtitle here",
            "type" => "text",
            
        ),
        array("name" => 'Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_fp_fb4_content1",
            "type" => "textarea",
            "std" => ' This is a static CMS block edited from admin panel. You can insert any content here.'
            , "lang" => TRUE
        ),
        
        array(
            'name' =>'Powered By Section',
            'type' => 'sub_heading_tab',
            "help_tip" => "#f_14",
        ),        
        array("name" => 'Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_powered_content1",
            "type" => "textarea",
            "std" => '&copy; Copyright 2013. <a href="http://wp-demo.oxy-theme.com/">OXY Theme</a> by Smartdatasoft. <a href="#">Buy This Theme!</a><br>
Powered by <a href="http://wordpress.com/">Wordpress</a>'
            , "lang" => TRUE
        ),
        
        array(
            'name' =>'Bottom Custom Block',
            'type' => 'sub_heading_tab',
            "help_tip" => "#f_16",
        ),
        array("name" => 'Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_custom_3_content1",
            "type" => "textarea",
            "std" => '<p>This is a CMS block edited from theme admin panel. You can insert any content (text, images, HTML) here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque non dui at sapien tempor gravida ut vel arcu. Maecenas odio arcu, feugiat vel congue feugiat, laoreet vitae diam. In hac habitasse platea dictumst. Morbi consectetur nunc porta ligula tempor et varius nibh sollicitudin. Mauris risus felis, adipiscing eu consequat ac, aliquam vel urna. Duis bibendum sapien nec mi egestas tempor.</p>'            
        ),
    );


    if (!empty($tab))
        return $of_options[$tab];
    else
        return $of_options;
}

function get_texts_options_setting_fields($tab) {

    return generate_fields(generate_texts_options_setting_fields($tab));
    
}