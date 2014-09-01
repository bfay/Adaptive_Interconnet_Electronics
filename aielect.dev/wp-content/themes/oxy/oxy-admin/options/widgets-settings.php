<?php

function generate_widgets_options_setting_fields($tab = '') {
    global $shortname;
    $of_options = array();
    
    $of_options['facebook'] = array(
        array("name" => 'Show Facebook Box:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_facebook_likebox_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
        array("name" => 'Facebook FanPage ID',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_facebook_likebox_id',
            "std" => "109822959866",
            "type" => "text",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_facebook_likebox_position',
            "std" => "right",
            "type" => "select",
            "options" => array('right' => 'Right', 'left' => 'Left'
            )
        ),
    );

    $of_options['twitter'] = array(
        array("name" => 'Show Twitter Box:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_twitter_block_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
        ),
        array("name" => 'Twitter username:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_twitter_block_user',
            "std" => "@321cart_com",
            "type" => "text",
        ),
        array("name" => 'Widget ID:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_twitter_block_widget_id',
            "std" => "344798604503969792",
            "type" => "text",
        ),
        array("name" => 'Tweet limit:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_twitter_block_tweets',
            "std" => "3",
            "type" => "text",
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_twitter_block_position',
            "std" => "right",
            "type" => "select",
            "options" => array('right' => 'Right', 'left' => 'Left'
            )
        ),
    );

    $of_options['video-box'] = array(
        array("name" => 'Show Video Box:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_video_box_status',
            "std" => "1",
            "type" => "iphone_checkboxes",
        ),
        array("name" => 'Video Content:',
            // "desc" => "Custom block Content in product page",
            "id" => $shortname . "_video_box_content1",
            "type" => "textarea",
            "std" => '<p><iframe allowfullscreen="" frameborder="0" height="315" src="//www.youtube.com/embed/SZEflIVnhH8" width="560"></iframe></p>'
            , "lang" => TRUE
        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_video_box_position',
            "std" => "right",
            "type" => "select",
            "options" => array('right' => 'Right', 'left' => 'Left'
            )
        ),
    );

    $of_options['custom-box'] = array(
        array("name" => 'Show Custom Box:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_custom_box_status',
            "std" => "1",
            "type" => "iphone_checkboxes",            
        ),
//        array("name" => 'Content:',
//            // "desc" => "Custom block Content in product page",
//            "id" => $shortname . "_custom_box_content1",
//            "type" => "textarea",
//            "std" => '<p><strong>CUSTOM BOX</strong></p>
//
//<p>This is a CMS Box edited from admin panel. You can display this box on the left or right side.</p>
//
//<p><img alt="" src="http://321theme.com/oxy/image/data/banners/banner_custom_1.png" style="width: 225px; height: 100px;" /></p>
//
//<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed velit urna, elementum at dignissim varius, euismod a elit. Praesent ornare metus eget metus commodo rhoncus.</p>
//
//<p><a class="button" href="http://321cart.com/sellya/">Read more</a></p>'
//            , "lang" => TRUE
//        ),
        array("name" => 'Position:',
            //"desc" => 'Body Background Repeat',
            "id" => $shortname . '_custom_box_position',
            "std" => "right",
            "type" => "select",
            "options" => array('right' => 'Right', 'left' => 'Left'
            )
        ),
//        array("name" => 'Background color:',
//            //"desc" => 'Body Background Repeat',
//            "id" => $shortname . '_custom_box_bg',
//            "std" => "#FFCA00",
//            "type" => "color",
//        ),
//        
    );


    if (!empty($tab))
        return $of_options[$tab];
    else
        return $of_options;
}

function get_widgets_options_setting_fields($tab) {

    return generate_fields(generate_widgets_options_setting_fields($tab));
    
}