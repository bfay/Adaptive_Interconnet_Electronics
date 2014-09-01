<?php
/**
 * Adds the stylesheets to the dashboard.
 *
 * @since    1.0.0
 */
function cpmb_add_admin_styles() {
	wp_enqueue_style( 'cpmb-admin', get_template_directory_uri().'/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'cpmb_add_admin_styles' );

/**
 * Adds the plugin's JavaScript to the 'Post' page
 *
 * @since    1.0.0
 */
function cpmb_add_admin_scripts() {
	
	// Get the current screen
	$screen = get_current_screen();
	
	// Compare the current screen's ID with 'post'. If they are equal, enqueue the JavaScript
	if( 'product' == $screen->id ) {
		wp_enqueue_script( 'cpmb-admin', get_template_directory_uri().'/js/admin.js' );
	}
	
}
add_action( 'admin_enqueue_scripts', 'cpmb_add_admin_scripts' );

/**
 * Register the 'Add MP3' meta box for the 'Post' post type.
 *
 * @since    1.0.0
 */
function cpmb_add_meta_box() {
	
	add_meta_box(
		'cpmb_audio',             // The ID for the meta box
		'Add MP3',                // The title of the meta box
		'cpmb_display_meta_box',  // The function for rendering the markup
		'product',                   // We'll only be displaying this on post pages
		'side',                   // Where the meta box should appear
		'core'                    // The priority of where the meta box should be displayed
	);
	
}
add_action( 'add_meta_boxes', 'cpmb_add_meta_box' );

/**
 * Displays an optional error message and a view for the custom meta box.
 *
 * @param    object    $post    The post object to which this meta box is being displayed.
 * @since    1.0.0
 */
function cpmb_display_meta_box( $post ) {
	
	// Define the nonce for security purposes
	wp_nonce_field( plugin_basename( __FILE__ ), 'cpmb-nonce-field' );
	
	// Start the HTML string so that all other strings can be concatenated
	$html = '';
	
	// If the current post has an invalid file type associated with it,
	// then display an error message.
        
        $product_layout_value = get_post_meta( $post->ID, 'product_layout_value', true );
        
	if ( 'invalid-file-type' == get_post_meta( $post->ID, 'mp3', true ) ) {
		
		$html .= '<div id="invalid-file-type" class="error">';
			$html .= '<p>You are trying to upload a file other than an MP3.</p>';
		$html .= '</div>';
		
	}
	
	$product_layout_array = array(
            'pl_1.png',
            'pl_2.png',
            'pl_3.png',
            'pl_4.png',
            'pl_5.png',
            'pl_6.png',
            'pl_7.png',
            'pl_8.png',
            'pl_9.png',
            'pl_10.png'
	);
	
	
	$html .='<div id="product_layout_container">
			<ul class="product_images">';
		
        $i=1;		
        foreach($product_layout_array as $img):
		
            $active = '';
            if(!empty($product_layout_value) && $i == $product_layout_value)
                $active = ' active';
            
            $html .='<li><a data-value="'.$i.'" href="#" class="product_layout'.$active.'">';                
            $html .= '<img width="50" height="50" src="'.get_template_directory_uri() .'/images/oxy_img/'.$img.'" class="attachment-thumbnail" alt="cd_6_flat">';
            $html .= '</a>';

            $html .='</li>';
            $i++;
        endforeach;		
		
								 
        $html .='</ul>'.
                '<input type="hidden" id="product_layout_value" name="product_layout_value" value="' . ( !empty($product_layout_value) ? 
                $product_layout_value : '1' ) . '">'.
                '</div>';
		
	
	echo $html;
	
}

/**
 * Adds the stylesheets to the dashboard.
 *
 * @param    int      $post_id    The ID for which we're saving data
 * @since    1.0.0
 */
function cpmb_save_meta_box_data( $post_id ) {
	
	
		print_r( $_POST['product_layout_value']);
	// If the user has permission to save data...
	if ( cpmb_user_can_save( $post_id, 'cpmb-nonce-field' ) ) {
		
		// ...and if the MP3 title is set and valid, then sanitize it and save it
		if ( isset( $_POST['product_layout_value'] ) && 0 < count( strlen( trim( $_POST['product_layout_value'] ) ) ) ) {
			
			$layout_field = stripslashes( strip_tags( $_POST['product_layout_value'] ) );
			update_post_meta( $post_id, 'product_layout_value', $layout_field );
			
		}

	
		
	}
	
}
add_action( 'save_post', 'cpmb_save_meta_box_data' );

/**
 * Appends a link to the MP3 associated with this post, if it's not invalid.
 *
 * @param    string    $content    The content to be rendered for this post.
 * @since    1.0.0
 */
function cpmb_display_mp3( $content ) {
	
	if ( is_single() ) {
	
		if ( 'invalid-file-type' != get_post_meta( get_the_ID(), 'mp3', true ) ) {
	
			$html = '<a href="' . get_post_meta( get_the_ID(), 'mp3', true ) . '">';
				$html .= get_post_meta( get_the_ID(), 'mp3-title', true );
			$html .= '</a>';
		
			$content .= $html;
		
		} 
		
	}
	
	return $content;
	
}
add_action( 'the_content', 'cpmb_display_mp3' );

/**
 * A helper function to determine if the specified filename is a valid MP3.
 *
 * @param    string    $filename    The name of the file of which evaluate its file type
 * @return   boolean                True if the file is an MP3; false, otherwise.
 * @since    1.0.0
 */
function cpmb_is_valid_mp3( $filename ) {
	
	$path_parts = pathinfo( $filename );
	return 'mp3' == strtolower( $path_parts['extension'] );
	
}

/**
 * A helper function to determine if the specified filename is a valid MP3.
 *
 * @param    int       $post_id     The name of the file of which evaluate its file type
 * @param    string    $nonce       The nonce value (which should be declared earlier in the context of this plugin
 * @return   boolean                True if the user has permission to save the data; false, otherwise.
 * @since    1.0.0
 */
function cpmb_user_can_save( $post_id, $nonce ) {
	
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], plugin_basename( __FILE__ ) ) );

	return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
	
}