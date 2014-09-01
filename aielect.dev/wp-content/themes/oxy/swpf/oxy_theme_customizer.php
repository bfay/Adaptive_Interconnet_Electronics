<?php

function oxy_customize_register($wp_customize) {
	include_once 'oxy_custom_control.php';
	/*
	 * $wp_customize->get_setting('blogname')->transport = 'postMessage'; $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	 */
	
	// =============================
	// = Color Picker =
	// =============================
	/**
	 * ******************************************GENERAL***********************************************
	 */
	
	$wp_customize->add_section ( 'oxy_color_scheme_general', array (
			'title' => __ ( 'General', 'themename' ),
			'priority' => 1
	) );
	
	// custom control
	$wp_customize->add_setting ( 'GeneralBasic' );
	$wp_customize->add_control ( new WP_Customize_GeneralBasic_Control ( $wp_customize, 'GeneralBasic', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 1 
	) ) );
	
	// Body Color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_body_bg_color]', array (
			'default' => '#F6F6F6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_body_bg_color', array (
			'label' => __ ( 'Body background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_body_bg_color]',
			'priority' => 2 
	) ) );
	
	// Headings Color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_headings_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_headings_color', array (
			'label' => __ ( 'Headings color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_headings_color]',
			'priority' => 3 
	) ) );
	
	// Body text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_body_text_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_body_text_color', array (
			'label' => __ ( 'Body text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_body_text_color]',
			'priority' => 4 
	) ) );
	
	// Light text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_light_text_color]', array (
			'default' => '#B6B6B6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_light_text_color', array (
			'label' => __ ( 'Light text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_light_text_color]',
			'priority' => 5 
	) ) );
	
	// Other links color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_other_links_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_other_links_color', array (
			'label' => __ ( 'Other links color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_other_links_color]',
			'priority' => 6 
	) ) );
	
	// Links hover text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_links_hover_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_links_hover_color', array (
			'label' => __ ( 'Links color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_links_hover_color]',
			'priority' => 7 
	) ) );
	
	/**
	 * ******************************************GENERAL END***********************************************
	 */
	
	/**
	 * ******************************************MAIN COLUMN***********************************************
	 */
	
	$wp_customize->add_setting ( 'MainColumn' );
	$wp_customize->add_control ( new WP_Customize_MainColumn_Control ( $wp_customize, 'MainColumn', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 8 
	) ) );
	
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_main_column_bg_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_main_column_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_main_column_bg_color]',
			'priority' => 9 
	) ) );
	
	// Border color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_main_column_border_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_main_column_border_color', array (
			'label' => __ ( 'Border color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_main_column_border_color]',
			'priority' => 10 
	) ) );
	
	/**
	 * ******************************************MAIN COLUMN END***********************************************
	 */
	
	/**
	 * ******************************************Content Column***********************************************
	 */
	$wp_customize->add_setting ( 'ContentColumn' );
	$wp_customize->add_control ( new WP_Customize_ContentColumn_Control ( $wp_customize, 'ContentColumn', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 11 
	) ) );
	// Highlighted Items background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_content_column_hli_bg_color]', array (
			'default' => '#F6F6F6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_content_column_hli_bg_color', array (
			'label' => __ ( 'Highlighted Items background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_content_column_hli_bg_color]',
			'priority' => 12 
	) ) );
	
	// Headings border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_content_column_head_border_color]', array (
			'default' => '#EAEAEA',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_content_column_head_border_color', array (
			'label' => __ ( 'Headings border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_content_column_head_border_color]',
			'priority' => 13 
	) ) );
	
	// Separator color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_content_column_separator_color]', array (
			'default' => '#EAEAEA',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_content_column_separator_color', array (
			'label' => __ ( 'Separator color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_content_column_separator_color]',
			'priority' => 14 
	) ) );
	
	/**
	 * ******************************************Content Column end***********************************************
	 */
	
	/**
	 * ******************************************Left Column Heading***********************************************
	 */
	
	$wp_customize->add_setting ( 'LeftColumnHeading' );
	$wp_customize->add_control ( new WP_Customize_LeftColumnHeading_Control ( $wp_customize, 'LeftColumnHeading', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 15 
	) ) );
	
	// Heading background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_left_column_head_bg_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_left_column_head_bg_color', array (
			'label' => __ ( 'Heading background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_left_column_head_bg_color]',
			'priority' => 16 
	) ) );
	
	// Title color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_left_column_head_title_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_left_column_head_title_color', array (
			'label' => __ ( 'Title color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_left_column_head_title_color]',
			'priority' => 17 
	) ) );
	
	// Border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_left_column_head_border_color]', array (
			'default' => '#EAEAEA',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_left_column_head_border_color', array (
			'label' => __ ( 'Border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_left_column_head_border_color]',
			'priority' => 18 
	) ) );
	
	/**
	 * ******************************************Left Column Heading end***********************************************
	 */
	
	/**
	 * ******************************************Left Column Box***********************************************
	 */
	
	$wp_customize->add_setting ( 'LeftColumnBox' );
	$wp_customize->add_control ( new WP_Customize_LeftColumnBox_Control ( $wp_customize, 'LeftColumnBox', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 19 
	) ) );
	// Box background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_left_column_box_bg_color]', array (
			'default' => '#F6F6F6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_left_column_box_bg_color', array (
			'label' => __ ( 'Box background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_left_column_box_bg_color]',
			'priority' => 20 
	) ) );
	
	// Links color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_left_column_box_links_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_left_column_box_links_color', array (
			'label' => __ ( 'Links color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_left_column_box_links_color]',
			'priority' => 21 
	) ) );
	
	// Links color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_left_column_box_links_color_hover]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_left_column_box_links_color_hover', array (
			'label' => __ ( 'Links color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_left_column_box_links_color_hover]',
			'priority' => 22 
	) ) );
	
	/**
	 * ******************************************Left Column Box end***********************************************
	 */
	
	/**
	 * ******************************************Right Column Heading***********************************************
	 */
	
	$wp_customize->add_setting ( 'RightColumnHeading' );
	$wp_customize->add_control ( new WP_Customize_RightColumnHeading_Control ( $wp_customize, 'RightColumnHeading', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 23 
	) ) );
	
	// Heading background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_right_column_head_bg_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_right_column_head_bg_color', array (
			'label' => __ ( 'Heading background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_right_column_head_bg_color]',
			'priority' => 24 
	) ) );
	
	// Title color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_right_column_head_title_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_right_column_head_title_color', array (
			'label' => __ ( 'Title color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_right_column_head_title_color]',
			'priority' => 25 
	) ) );
	
	// Border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_right_column_head_border_color]', array (
			'default' => '#EAEAEA',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_right_column_head_border_color', array (
			'label' => __ ( 'Border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_right_column_head_border_color]',
			'priority' => 26 
	) ) );
	
	/**
	 * ******************************************Right Column Heading end***********************************************
	 */
	
	/**
	 * ******************************************Right Column Box***********************************************
	 */
	$wp_customize->add_setting ( 'RightColumnBox' );
	$wp_customize->add_control ( new WP_Customize_RightColumnBox_Control ( $wp_customize, 'RightColumnBox', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 27 
	) ) );
	// Box background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_right_column_box_bg_color]', array (
			'default' => '#F6F6F6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_right_column_box_bg_color', array (
			'label' => __ ( 'Box background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_right_column_box_bg_color]',
			'priority' => 28 
	) ) );
	
	// Links color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_right_column_box_links_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_right_column_box_links_color', array (
			'label' => __ ( 'Links color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_right_column_box_links_color]',
			'priority' => 29 
	) ) );
	
	// Links color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_right_column_box_links_color_hover]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_right_column_box_links_color_hover', array (
			'label' => __ ( 'Links color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_right_column_box_links_color_hover]',
			'priority' => 30 
	) ) );
	
	/**
	 * ******************************************Right Column Box end***********************************************
	 */
	
	/**
	 * ******************************************Category Box Heading***********************************************
	 */
	$wp_customize->add_setting ( 'CategoryBoxHeading' );
	$wp_customize->add_control ( new WP_Customize_CategoryBoxHeading_Control ( $wp_customize, 'CategoryBoxHeading', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 31 
	) ) );
	// Heading background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_category_box_head_bg_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_category_box_head_bg_color', array (
			'label' => __ ( 'Heading background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_category_box_head_bg_color]',
			'priority' => 32 
	) ) );
	
	// Title color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_category_box_head_title_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_category_box_head_title_color', array (
			'label' => __ ( 'Title color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_category_box_head_title_color]',
			'priority' => 33 
	) ) );
	
	// Border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_category_box_head_border_color]', array (
			'default' => '#EAEAEA',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_category_box_head_border_color', array (
			'label' => __ ( 'Border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_category_box_head_border_color]',
			'priority' => 34 
	) ) );
	
	/**
	 * ******************************************Category Box Heading end***********************************************
	 */
	
	/**
	 * ******************************************Category Box Content***********************************************
	 */
	$wp_customize->add_setting ( 'CategoryBoxContent' );
	$wp_customize->add_control ( new WP_Customize_CategoryBoxContent_Control ( $wp_customize, 'CategoryBoxContent', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 35 
	) ) );
	// Box background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_category_box_box_bg_color]', array (
			'default' => '#F6F6F6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_category_box_box_bg_color', array (
			'label' => __ ( 'Category box background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_category_box_box_bg_color]',
			'priority' => 36 
	) ) );
	
	// Box background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_category_box_box_bg_color_hover]', array (
			'default' => '#F0F0F0',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_category_box_box_bg_color_hover', array (
			'label' => __ ( 'Category box background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_category_box_box_bg_color_hover]',
			'priority' => 37 
	) ) );
	
	// Links color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_category_box_box_links_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_category_box_box_links_color', array (
			'label' => __ ( 'Links color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_category_box_box_links_color]',
			'priority' => 38 
	) ) );
	
	// Links color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_category_box_box_links_color_hover]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_category_box_box_links_color_hover', array (
			'label' => __ ( 'Links color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_category_box_box_links_color_hover]',
			'priority' => 39 
	) ) );
	
	// Separator color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_category_box_box_separator_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_category_box_box_separator_color', array (
			'label' => __ ( 'Separator color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_category_box_box_separator_color]',
			'priority' => 40 
	) ) );
	
	/**
	 * ******************************************Category Box Content end***********************************************
	 */
	
	/**
	 * ******************************************Filter Box Heading***********************************************
	 
	$wp_customize->add_setting ( 'FilterBoxHeading' );
	$wp_customize->add_control ( new WP_Customize_FilterBoxHeading_Control ( $wp_customize, 'FilterBoxHeading', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 41 
	) ) );
	// Heading background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_filter_box_head_bg_color]', array (
			'default' => '#424242',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_filter_box_head_bg_color', array (
			'label' => __ ( 'Heading background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_filter_box_head_bg_color]',
			'priority' => 42 
	) ) );
	
	// Title color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_filter_box_head_title_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_filter_box_head_title_color', array (
			'label' => __ ( 'Title color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_filter_box_head_title_color]',
			'priority' => 43 
	) ) );
	
	// Border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_filter_box_head_border_color]', array (
			'default' => '#EAEAEA',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_filter_box_head_border_color', array (
			'label' => __ ( 'Border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_filter_box_head_border_color]',
			'priority' => 44 
	) ) );
	
	/**
	 * ******************************************Filter Box Heading end***********************************************
	 */
	
	/**
	 * ******************************************Filter Box Content***********************************************
	 
	$wp_customize->add_setting ( 'FilterBoxContent' );
	$wp_customize->add_control ( new WP_Customize_FilterBoxContent_Control ( $wp_customize, 'FilterBoxContent', array (
			'section' => 'oxy_color_scheme_general',
			'priority' => 45 
	) ) );
	// Box background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_filter_box_box_bg_color]', array (
			'default' => '#F6F6F6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_filter_box_box_bg_color', array (
			'label' => __ ( 'Box background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_filter_box_box_bg_color]',
			'priority' => 46 
	) ) );
	
	// Links color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_filter_box_box_links_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_filter_box_box_links_color', array (
			'label' => __ ( 'Links color:', 'oxy' ),
			'section' => 'oxy_color_scheme_general',
			'settings' => 'oxy_color_settings[oxy_filter_box_box_links_color]',
			'priority' => 47 
	) ) );
	
	// Links color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_filter_box_box_links_color_hover]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_filter_box_box_links_color_hover', array (
			'label' => __ ( 'Links color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme',
			'settings' => 'oxy_color_settings[oxy_filter_box_box_links_color_hover]',
			'priority' => 48 
	) ) );
	
	/**
	 * ******************************************Filter Box Content end***********************************************
	 */
	
	/**
	 * ******************************************GENERAL END*************************************************************
	 */
	
	/**
	 * ******************************************PRICES*************************************************************
	 */
	
	$wp_customize->add_section ( 'oxy_color_scheme_prices', array (
			'title' => __ ( 'Prices', 'themename' ),
			'priority' => 2
	) );
	
	$wp_customize->add_setting ( 'PricesBasic' );
	$wp_customize->add_control ( new WP_Customize_PricesBasic_Control ( $wp_customize, 'PricesBasic', array (
			'section' => 'oxy_color_scheme_prices',
			'priority' => 1 
	) ) );
	
	// Price color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_price_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_price_color', array (
			'label' => __ ( 'Price color:', 'oxy' ),
			'section' => 'oxy_color_scheme_prices',
			'settings' => 'oxy_color_settings[oxy_price_color]',
			'priority' => 2 
	) ) );
	
	// Old price color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_price_old_color]', array (
			'default' => '#B6B6B6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_price_old_color', array (
			'label' => __ ( 'Old price color:', 'oxy' ),
			'section' => 'oxy_color_scheme_prices',
			'settings' => 'oxy_color_settings[oxy_price_old_color]',
			'priority' => 3 
	) ) );
	
	// New price color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_price_new_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_price_new_color', array (
			'label' => __ ( 'New price color:', 'oxy' ),
			'section' => 'oxy_color_scheme_prices',
			'settings' => 'oxy_color_settings[oxy_price_new_color]',
			'priority' => 4 
	) ) );
	
	// Tax price color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_price_tax_color]', array (
			'default' => '#B6B6B6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_price_tax_color', array (
			'label' => __ ( 'Tax price color:', 'oxy' ),
			'section' => 'oxy_color_scheme_prices',
			'settings' => 'oxy_color_settings[oxy_price_tax_color]',
			'priority' => 5 
	) ) );
	
	/**
	 * ******************************************PRICES END*************************************************************
	 */
	
	/**
	 * ******************************************Buttons*************************************************************
	 */
	$wp_customize->add_section ( 'oxy_color_scheme_buttons', array (
			'title' => __ ( 'Buttons', 'themename' ),
			'priority' => 3 
	) );
	
	$wp_customize->add_setting ( 'Buttons' );
	$wp_customize->add_control ( new WP_Customize_Buttons_Control ( $wp_customize, 'Buttons', array (
			'section' => 'oxy_color_scheme_buttons',
			'priority' => 1 
	) ) );
	
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_bg_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_bg_color]',
			'priority' => 2 
	) ) );
	
	// Background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_bg_hover_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_bg_hover_color', array (
			'label' => __ ( 'Background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_bg_hover_color]',
			'priority' => 3 
	) ) );
	
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_text_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_text_color]',
			'priority' => 4 
	) ) );
	
	// Text color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_text_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_text_hover_color', array (
			'label' => __ ( 'Text color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_text_hover_color]',
			'priority' => 5 
	) ) );
	/**
	 * ******************************************Buttons END*************************************************************
	 */
	
	/**
	 * ******************************************Exclusive Buttons*************************************************************
	 */
	$wp_customize->add_setting ( 'ExclusiveButtons' );
	$wp_customize->add_control ( new WP_Customize_ExclusiveButtons_Control ( $wp_customize, 'ExclusiveButtons', array (
			'section' => 'oxy_color_scheme_buttons',
			'priority' => 6 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_exclusive_bg_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_exclusive_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_exclusive_bg_color]',
			'priority' => 7 
	) ) );
	
	// Background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_exclusive_bg_hover_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_exclusive_bg_hover_color', array (
			'label' => __ ( 'Background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_exclusive_bg_hover_color]',
			'priority' => 8 
	) ) );
	
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_exclusive_text_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_exclusive_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_exclusive_text_color]',
			'priority' => 9 
	) ) );
	
	// Text color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_exclusive_text_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_exclusive_text_hover_color', array (
			'label' => __ ( 'Text color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_exclusive_text_hover_color]',
			'priority' => 10 
	) ) );
	
	/**
	 * ******************************************Exclusive Buttons end**********************************************************
	 */
	
	/**
	 * ******************************************Light Buttons**************************************************************
	 */
	$wp_customize->add_setting ( 'LightButtons' );
	$wp_customize->add_control ( new WP_Customize_LightButtons_Control ( $wp_customize, 'LightButtons', array (
			'section' => 'oxy_color_scheme_buttons',
			'priority' => 11 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_light_bg_color]', array (
			'default' => '#EFEFEF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_light_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_light_bg_color]',
			'priority' => 12 
	) ) );
	
	// Background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_light_bg_hover_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_light_bg_hover_color', array (
			'label' => __ ( 'Background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_light_bg_hover_color]',
			'priority' => 13 
	) ) );
	
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_light_text_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_light_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_light_text_color]',
			'priority' => 14 
	) ) );
	
	// Text color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_light_text_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_light_text_hover_color', array (
			'label' => __ ( 'Text color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_light_text_hover_color]',
			'priority' => 15 
	) ) );
	
	/**
	 * ******************************************Light Buttons end**********************************************************
	 */
	
	/**
	 * ******************************************Slider Buttons**********************************************************
	 */
	$wp_customize->add_setting ( 'SliderButtons' );
	$wp_customize->add_control ( new WP_Customize_SliderButtons_Control ( $wp_customize, 'SliderButtons', array (
			'section' => 'oxy_color_scheme_buttons',
			'priority' => 16 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_slider_bg_color]', array (
			'default' => '#EEEEEE',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_slider_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_slider_bg_color]',
			'priority' => 17 
	) ) );
	
	// Background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_button_slider_bg_hover_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_button_slider_bg_hover_color', array (
			'label' => __ ( 'Background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_buttons',
			'settings' => 'oxy_color_settings[oxy_button_slider_bg_hover_color]',
			'priority' => 18 
	) ) );
	
	/**
	 * ******************************************Slider Buttons end**********************************************************
	 */
	
	/**
	 * ******************************************Header**********************************************************
	 */
	
	$wp_customize->add_section ( 'oxy_color_scheme_header', array (
			'title' => __ ( 'Header', 'themename' ),
			'priority' => 4 
	) );
	
	$wp_customize->add_setting ( 'Header' );
	$wp_customize->add_control ( new WP_Customize_Header_Control ( $wp_customize, 'Header', array (
			'section' => 'oxy_color_scheme_header',
			'priority' => 1 
	) ) );
	
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_bg_color]', array (
			'default' => '#F8F8F8',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_bg_color]',
			'priority' => 2 
	) ) );
	
	// Fixed Header (Mini Header) background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_mini_bg_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_mini_bg_color', array (
			'label' => __ ( 'Fixed Header (Mini Header) background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_mini_bg_color]',
			'priority' => 3 
	) ) );
	
	/**
	 * ******************************************Header end**********************************************************
	 */
	
	/**
	 * ******************************************Top Bar**********************************************************
	 */
	$wp_customize->add_setting ( 'TopBar' );
	$wp_customize->add_control ( new WP_Customize_TopBar_Control ( $wp_customize, 'TopBar', array (
			'section' => 'oxy_color_scheme_header',
			'priority' => 4 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_bg_color]', array (
			'default' => '#424242',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_bg_color]',
			'priority' => 5 
	) ) );
	
	// Border top color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_top_border_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_top_border_color', array (
			'label' => __ ( 'Border top color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_top_border_color]',
			'priority' => 6 
	) ) );
	
	// Border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_bottom_border_color]', array (
			'default' => '#525252',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_bottom_border_color', array (
			'label' => __ ( 'Border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_bottom_border_color]',
			'priority' => 7 
	) ) );
	
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_text_color]', array (
			'default' => '#CCCCCC',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_text_color]',
			'priority' => 8 
	) ) );
	
	// Link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_link_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_link_color', array (
			'label' => __ ( 'Link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_link_color]',
			'priority' => 9 
	) ) );
	
	// Link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_link_color_hover]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_link_color_hover', array (
			'label' => __ ( 'Link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_link_color_hover]',
			'priority' => 10 
	) ) );
        
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_link_bg_hover]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_link_bg_hover', array (
			'label' => __ ( 'Link hover background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_link_bg_hover]',
			'priority' => 11 
	) ) );
	
	// Separator color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_separator_color]', array (
			'default' => '#525252',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_separator_color', array (
			'label' => __ ( 'Separator color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_separator_color]',
			'priority' => 12 
	) ) );
	
	// Dropdowns background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_dropdown_bg_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_dropdown_bg_color', array (
			'label' => __ ( 'Dropdowns background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_dropdown_bg_color]',
			'priority' => 13 
	) ) );
	
	// Dropdowns background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_dropdown_bg_color_hover]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_dropdown_bg_color_hover', array (
			'label' => __ ( 'Dropdowns background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_dropdown_bg_color_hover]',
			'priority' => 14 
	) ) );
	
	// Dropdowns link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_dropdown_link_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_dropdown_link_color', array (
			'label' => __ ( 'Dropdowns link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_dropdown_link_color]',
			'priority' => 15 
	) ) );
	
	// Dropdowns link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_tb_dropdown_link_color_hover]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_tb_dropdown_link_color_hover', array (
			'label' => __ ( 'Dropdowns link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_tb_dropdown_link_color_hover]',
			'priority' => 16 
	) ) );
	
	/**
	 * ******************************************Top Bar End**********************************************************
	 */
	
	/**
	 * ******************************************Search Bar**************************************************************
	 */
	$wp_customize->add_setting ( 'SearchBar' );
	$wp_customize->add_control ( new WP_Customize_SearchBar_Control ( $wp_customize, 'SearchBar', array (
			'section' => 'oxy_color_scheme_header',
			'priority' => 17 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_search_bg_color]', array (
			'default' => '#F3F3F3',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_search_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_search_bg_color]',
			'priority' => 18 
	) ) );
	
	// Border color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_search_border_color]', array (
			'default' => '#DFDFDF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_search_border_color', array (
			'label' => __ ( 'Border color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_search_border_color]',
			'priority' => 19 
	) ) );
	
	// Border color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_search_border_color_hover]', array (
			'default' => '#CCCCCC',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_search_border_color_hover', array (
			'label' => __ ( 'Border color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_search_border_color_hover]',
			'priority' => 20 
	) ) );
	
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_search_text_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_search_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_search_text_color]',
			'priority' => 21 
	) ) );
	
	/**
	 * ******************************************Search Bar End**********************************************************
	 */
	
	/**
	 * ******************************************Cart Section**********************************************************
	 */
	$wp_customize->add_setting ( 'CartSection' );
	$wp_customize->add_control ( new WP_Customize_CartSection_Control ( $wp_customize, 'CartSection', array (
			'section' => 'oxy_color_scheme_header',
			'priority' => 22 
	) ) );
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_cart_text_color]', array (
			'default' => '#B6B6B6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_cart_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_cart_text_color]',
			'priority' => 23 
	) ) );
	
	// Link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_cart_link_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_cart_link_color', array (
			'label' => __ ( 'Link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_cart_link_color]',
			'priority' => 24 
	) ) );
	
	// Link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_cart_link_color_hover]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_cart_link_color_hover', array (
			'label' => __ ( 'Link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_cart_link_color_hover]',
			'priority' => 25 
	) ) );
	
	// Separator
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_top_area_cart_separator_color]', array (
			'default' => '#EDEDED',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_top_area_cart_separator_color', array (
			'label' => __ ( 'Separator:', 'oxy' ),
			'section' => 'oxy_color_scheme_header',
			'settings' => 'oxy_color_settings[oxy_top_area_cart_separator_color]',
			'priority' => 26 
	) ) );
	/**
	 * ******************************************Cart Section End**********************************************************
	 */
	
	/**
	 * ******************************************Main menu**************************************************************
	 */
	
	$wp_customize->add_section ( 'oxy_color_scheme_mainmenu', array (
			'title' => __ ( 'Main Menu', 'themename' ),
			'priority' => 5 
	) );
	$wp_customize->add_setting ( 'MainMenuBar' );
	$wp_customize->add_control ( new WP_Customize_MainMenuBar_Control ( $wp_customize, 'MainMenuBar', array (
			'section' => 'oxy_color_scheme_mainmenu',
			'priority' => 1 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_bg_color]', array (
			'default' => '#424242',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_bg_color]',
			'priority' => 2 
	) ) );
	
	// Separator color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_separator_color]', array (
			'default' => '#4F4F4F',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_separator_color', array (
			'label' => __ ( 'Separator color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_separator_color]',
			'priority' => 3 
	) ) );
	
	// Border top color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_border_top_color]', array (
			'default' => '#EEEEEE',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_border_top_color', array (
			'label' => __ ( 'Border top color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_border_top_color]',
			'priority' => 4 
	) ) );
	
	// Border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_border_bottom_color]', array (
			'default' => '#EEEEEE',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_border_bottom_color', array (
			'label' => __ ( 'Border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_border_bottom_color]',
			'priority' => 5 
	) ) );
	
	/**
	 * ******************************************Main menu end**********************************************************
	 */
	
	/**
	 * ******************************************Home Page Link**********************************************************         
	 */
	$wp_customize->add_setting ( 'MenuItems' );
	$wp_customize->add_control ( new WP_Customize_HomePageLink_Control ( $wp_customize, 'MenuItems', array (
			'section' => 'oxy_color_scheme_mainmenu',
			'priority' => 6 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm1_bg_color]', array (
			'default' => '#424242',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm1_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm1_bg_color]',
			'priority' => 7 
	) ) );
	
	// Background hover color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm1_bg_hover_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm1_bg_hover_color', array (
			'label' => __ ( 'Background hover color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm1_bg_hover_color]',
			'priority' => 8 
	) ) );
	
	// Link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm1_link_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm1_link_color', array (
			'label' => __ ( 'Link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm1_link_color]',
			'priority' => 9 
	) ) );
	
	// link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm1_link_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm1_link_hover_color', array (
			'label' => __ ( 'Link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm1_link_hover_color]',
			'priority' => 10 
	) ) );
	
	/**
	 * ******************************************Home Page Link end**********************************************************
	 */
	
	
	/**
	 * ******************************************Contact Section**********************************************************
	 */
//	$wp_customize->add_setting ( 'ContactSection' );
//	$wp_customize->add_control ( new WP_Customize_ContactSection_Control ( $wp_customize, 'ContactSection', array (
//			'section' => 'oxy_color_scheme_mainmenu',
//			'priority' => 11 
//	) ) );
//	// Background color
//	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm7_bg_color]', array (
//			'default' => '#E5E5E5',
//			'sanitize_callback' => 'sanitize_hex_color',
//			'capability' => 'edit_theme_options',
//			'type' => 'option',
//			'transport' => 'postMessage' 
//	)
//	 );
//	
//	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm7_bg_color', array (
//			'label' => __ ( 'Background color:', 'oxy' ),
//			'section' => 'oxy_color_scheme_mainmenu',
//			'settings' => 'oxy_color_settings[oxy_mm7_bg_color]',
//			'priority' => 12 
//	) ) );
//	
//	// Background hover color
//	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm7_bg_hover_color]', array (
//			'default' => '#4BB8E2',
//			'sanitize_callback' => 'sanitize_hex_color',
//			'capability' => 'edit_theme_options',
//			'type' => 'option',
//			'transport' => 'postMessage' 
//	)
//	 );
//	
//	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm7_bg_hover_color', array (
//			'label' => __ ( 'Background hover color:', 'oxy' ),
//			'section' => 'oxy_color_scheme_mainmenu',
//			'settings' => 'oxy_color_settings[oxy_mm7_bg_hover_color]',
//			'priority' => 13 
//	) ) );
//	
//	// Link color
//	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm7_link_color]', array (
//			'default' => '#FFFFFF',
//			'sanitize_callback' => 'sanitize_hex_color',
//			'capability' => 'edit_theme_options',
//			'type' => 'option',
//			'transport' => 'postMessage' 
//	)
//	 );
//	
//	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm7_link_color', array (
//			'label' => __ ( 'Link color:', 'oxy' ),
//			'section' => 'oxy_color_scheme_mainmenu',
//			'settings' => 'oxy_color_settings[oxy_mm7_link_color]',
//			'priority' => 14 
//	) ) );
//	
//	// link color hover
//	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm7_link_hover_color]', array (
//			'default' => '#FFFFFF',
//			'sanitize_callback' => 'sanitize_hex_color',
//			'capability' => 'edit_theme_options',
//			'type' => 'option',
//			'transport' => 'postMessage' 
//	)
//	 );
//	
//	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm7_link_hover_color', array (
//			'label' => __ ( 'Link color hover:', 'oxy' ),
//			'section' => 'oxy_color_scheme_mainmenu',
//			'settings' => 'oxy_color_settings[oxy_mm7_link_hover_color]',
//			'priority' => 15 
//	) ) );
//	
	/**
	 * ******************************************Contact Section end**********************************************************
	 */
	
	/**
	 * ******************************************Sub-Menu**********************************************************
	 */
	$wp_customize->add_setting ( 'SubMenu' );
	$wp_customize->add_control ( new WP_Customize_SubMenu_Control ( $wp_customize, 'SubMenu', array (
			'section' => 'oxy_color_scheme_mainmenu',
			'priority' => 16 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_sub_bg_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_sub_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_sub_bg_color]',
			'priority' => 17 
	) ) );
	
	// Background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_sub_bg_hover_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_sub_bg_hover_color', array (
			'label' => __ ( 'Item background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_sub_bg_hover_color]',
			'priority' => 18 
	) ) );
	
	// Heading background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_sub_titles_bg_color]', array (
			'default' => '#F5F5F5',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_sub_titles_bg_color', array (
			'label' => __ ( 'Heading background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_sub_titles_bg_color]',
			'priority' => 19 
	) ) );
	
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_sub_text_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_sub_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_sub_text_color]',
			'priority' => 20 
	) ) );
	
	// Link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_sub_link_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_sub_link_color', array (
			'label' => __ ( 'Link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_sub_link_color]',
			'priority' => 21 
	) ) );
	
	// Link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_sub_link_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_sub_link_hover_color', array (
			'label' => __ ( 'Link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_sub_link_hover_color]',
			'priority' => 22 
	) ) );
	
	// Separator color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_sub_separator_color]', array (
			'default' => '#F1F1F1',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_sub_separator_color', array (
			'label' => __ ( 'Separator color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_sub_separator_color]',
			'priority' => 23 
	) ) );
	
	/**
	 * ******************************************Sub-Menu end**********************************************************
	 */
	
	/**
	 * ******************************************Mobile Main Menu Bar**********************************************************
	 */
	$wp_customize->add_setting ( 'MobileMainMenuBar' );
	$wp_customize->add_control ( new WP_Customize_MobileMainMenuBar_Control ( $wp_customize, 'MobileMainMenuBar', array (
			'section' => 'oxy_color_scheme_mainmenu',
			'priority' => 24 
	) ) );
	
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_mobile_bg_color]', array (
			'default' => '#424242',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_mobile_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_mobile_bg_color]',
			'priority' => 25 
	) ) );
	
	// Background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_mobile_bg_hover_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_mobile_bg_hover_color', array (
			'label' => __ ( 'Background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_mobile_bg_hover_color]',
			'priority' => 26 
	) ) );
	
	// "MENU" text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mm_mobile_text_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mm_mobile_text_color', array (
			'label' => __ ( '"MENU" text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_mainmenu',
			'settings' => 'oxy_color_settings[oxy_mm_mobile_text_color]',
			'priority' => 27 
	) ) );
	
	/**
	 * ******************************************Mobile Main Menu Bar end**********************************************************
	 */
	
	/**
	 * ******************************************Midsection**************************************************************
	 */
	$wp_customize->add_section ( 'oxy_color_scheme_midsection', array (
			'title' => __ ( 'Midsection', 'themename' ),
			'priority' => 6 
	) );
	/**
	 * ******************************************Product Box**************************************************************
	 */
	$wp_customize->add_setting ( 'ProductBox' );
	$wp_customize->add_control ( new WP_Customize_ProductBox_Control ( $wp_customize, 'ProductBox', array (
			'section' => 'oxy_color_scheme_midsection',
			'priority' => 1 
	) ) );
	// Background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_box_bg_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_box_bg_hover_color', array (
			'label' => __ ( 'Background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_box_bg_hover_color]',
			'priority' => 2 
	) ) );
	// Rating Color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_stars_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_stars_color', array (
			'label' => __ ( 'Rating color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_stars_color]',
			'priority' => 3 
	) ) );
	
	// Sale Badge color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_box_sale_icon_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_box_sale_icon_color', array (
			'label' => __ ( 'Sale Badge color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_box_sale_icon_color]',
			'priority' => 4 
	) ) );
	/**
	 * ******************************************Product Box end**************************************************************
	 */
	
	/**
	 * ******************************************Product Page - Tabs**************************************************************
	 */
	$wp_customize->add_setting ( 'ProductPageTabs' );
	$wp_customize->add_control ( new WP_Customize_ProductPageTabs_Control ( $wp_customize, 'ProductPageTabs', array (
			'section' => 'oxy_color_scheme_midsection',
			'priority' => 5 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_page_tabs_bg_color]', array (
			'default' => '#424242',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_page_tabs_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_page_tabs_bg_color]',
			'priority' => 6	
            ) ) );
	
	// Selected tab background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_page_tabs_selected_bg_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_page_tabs_selected_bg_color', array (
			'label' => __ ( 'Selected tab background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_page_tabs_selected_bg_color]',
			'priority' => 7 
	) ) );
	
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_page_tabs_text_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_page_tabs_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_page_tabs_text_color]',
			'priority' => 8 
	) ) );
	/**
	 * ******************************************Product Page - Tabs end**************************************************************
	 */
	
	/**
	 * ******************************************Product Slider on Home Page**************************************************************
	 */
	$wp_customize->add_setting ( 'ProductSlideronHomePage' );
	$wp_customize->add_control ( new WP_Customize_ProductSlideronHomePage_Control ( $wp_customize, 'ProductSlideronHomePage', array (
			'section' => 'oxy_color_scheme_midsection',
			'priority' => 9 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_slider_bg_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_slider_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_slider_bg_color]',
			'priority' => 10 
	) ) );
	
	// Product name color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_slider_name_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_slider_name_color', array (
			'label' => __ ( 'Product name color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_slider_name_color]',
			'priority' => 11 
	) ) );
	
	// Product description color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_slider_desc_color]', array (
			'default' => '#A3A3A3',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_slider_desc_color', array (
			'label' => __ ( 'Product description color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_slider_desc_color]',
			'priority' => 12 
	) ) );
	
	// Product price color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_slider_price_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_slider_price_color', array (
			'label' => __ ( 'Product price color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_slider_price_color]',
			'priority' => 13 
	) ) );
	
	// Product links color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_slider_links_color_hover]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_slider_links_color_hover', array (
			'label' => __ ( 'Product links color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_slider_links_color_hover]',
			'priority' => 14 
	) ) );
	
	// Bottom bar background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color]', array (
			'default' => '#E8E8E8',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_slider_bottom_bar_bg_color', array (
			'label' => __ ( 'Bottom bar background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color]',
			'priority' => 15 
	) ) );
	
	// Bottom bar background color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color_hover]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_slider_bottom_bar_bg_color_hover', array (
			'label' => __ ( 'Bottom bar background color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color_hover]',
			'priority' => 16 
	) ) );
	
	// Bottom bar background color active
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color_active]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_mid_prod_slider_bottom_bar_bg_color_active', array (
			'label' => __ ( 'Bottom bar background color active:', 'oxy' ),
			'section' => 'oxy_color_scheme_midsection',
			'settings' => 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color_active]',
			'priority' => 17 
	) ) );
	
	/**
	 * ******************************************Product Slider on Home Page end**************************************************************
	 */
	
	/**
	 * **********************************************************Midsection end*************************************************************
	 */
	
	/**
	 * *************************************************************Footer******************************************************************
	 */
	$wp_customize->add_section ( 'oxy_color_scheme_footer', array (
			'title' => __ ( 'Footer', 'themename' ),
			'priority' => 7 
	) );
	/**
	 * *****************************************************Feature Block*******************************************************************
	 */
	$wp_customize->add_setting ( 'FeatureBlock' );
	$wp_customize->add_control ( new WP_Customize_FeatureBlock_Control ( $wp_customize, 'FeatureBlock', array (
			'section' => 'oxy_color_scheme_footer',
			'priority' => 1 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_bg_color]', array (
			'default' => '#F6F6F6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_bg_color]',
			'priority' => 2 
	) ) );
	// Titles color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_title_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_title_color', array (
			'label' => __ ( 'Titles color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_title_color]',
			'priority' => 3 
	) ) );
	// Titles color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_title_color_hover]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_title_color_hover', array (
			'label' => __ ( 'Titles color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_title_color_hover]',
			'priority' => 4 
	) ) );
	// Subtitles color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_subtitle_color]', array (
			'default' => '#B6B6B6',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_subtitle_color', array (
			'label' => __ ( 'Subtitles color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_subtitle_color]',
			'priority' => 5 
	) ) );
        
        
        /*
         * Feature box icon colors
         */
        
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_fb1_bg_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_fb1_bg_color', array (
			'label' => __ ( 'Feature box 1 icon background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_fb1_bg_color]',
			'priority' => 6 
	) ) );
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_fb1_bg_color_hover]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_fb1_bg_color_hover', array (
			'label' => __ ( 'Feature box 1 icon hover background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_fb1_bg_color_hover]',
			'priority' => 7 
	) ) );
        
        
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_fb2_bg_color]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_fb2_bg_color', array (
			'label' => __ ( 'Feature box 2 icon background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_fb2_bg_color]',
			'priority' => 8 
	) ) );
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_fb2_bg_color_hover]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_fb2_bg_color_hover', array (
			'label' => __ ( 'Feature box 2 icon hover background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_fb2_bg_color_hover]',
			'priority' => 9 
	) ) );
        
        
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_fb3_bg_color]', array (
			'default' => '#FFCA00',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_fb3_bg_color', array (
			'label' => __ ( 'Feature box 3 icon background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_fb3_bg_color]',
			'priority' => 10 
	) ) );
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_fb3_bg_color_hover]', array (
			'default' => '#FFCA00',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_fb3_bg_color_hover', array (
			'label' => __ ( 'Feature box 3 icon hover background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_fb3_bg_color_hover]',
			'priority' => 11 
	) ) );
        
        
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_fb4_bg_color]', array (
			'default' => '#9AE24B',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_fb4_bg_color', array (
			'label' => __ ( 'Feature box 4 icon background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_fb4_bg_color]',
			'priority' => 12 
	) ) );
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_fp_fb4_bg_color_hover]', array (
			'default' => '#9AE24B',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_fp_fb4_bg_color_hover', array (
			'label' => __ ( 'Feature box 4 icon hover background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_fp_fb4_bg_color_hover]',
			'priority' => 13 
	) ) );
	/**
	 * ******************************************Feature Block end**********************************************************
	 */
	
	/**
	 * ******************************************About Us, Custom Column, Follow Us, Contact Us***********************************
	 */
	$wp_customize->add_setting ( 'AboutUsCustomColumnFollowUsContactUs' );
	$wp_customize->add_control ( new WP_Customize_AboutUsCustomColumnFollowUsContactUs_Control ( $wp_customize, 'AboutUsCustomColumnFollowUsContactUs', array (
			'section' => 'oxy_color_scheme_footer',
			'priority' => 14
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f1_bg_color]', array (
			'default' => '#373737',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f1_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f1_bg_color]',
			'priority' => 15 
	) ) );
	// Titles color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f1_titles_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f1_titles_color', array (
			'label' => __ ( 'Titles color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f1_titles_color]',
			'priority' => 16 
	) ) );
	// Titles border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f1_titles_border_bottom_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f1_titles_border_bottom_color', array (
			'label' => __ ( 'Titles border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f1_titles_border_bottom_color]',
			'priority' => 17 
	) ) );
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f1_text_color]', array (
			'default' => '#8C8C8C',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f1_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f1_text_color]',
			'priority' => 18 
	) ) );
	// Link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f1_link_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f1_link_color', array (
			'label' => __ ( 'Link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f1_link_color]',
			'priority' => 19 
	) ) );
	// Link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f1_link_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f1_link_hover_color', array (
			'label' => __ ( 'Link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f1_link_hover_color]',
			'priority' => 20 
	) ) );
	// Icon color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f1_icon_color]', array (
			'default' => '#525252',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f1_icon_color', array (
			'label' => __ ( 'Icon color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f1_icon_color]',
			'priority' => 21 
	) ) );
	// Border top color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f1_border_top_color]', array (
			'default' => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f1_border_top_color', array (
			'label' => __ ( 'Border top color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f1_border_top_color]',
			'priority' => 22 
	) ) );
	/**
	 * ******************************************About Us, Custom Column, Follow Us, Contact Us end**********************************************************
	 */
	
	/**
	 * ******************************************Information, Customer Service, Extras, My Account**********************************************************
	 */
	$wp_customize->add_setting ( 'InformationCustomerServiceExtrasMyAccount' );
	$wp_customize->add_control ( new WP_Customize_InformationCustomerServiceExtrasMyAccount_Control ( $wp_customize, 'InformationCustomerServiceExtrasMyAccount', array (
			'section' => 'oxy_color_scheme_footer',
			'priority' => 23 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f2_bg_color]', array (
			'default' => '#2F2F2F',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f2_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f2_bg_color]',
			'priority' => 24 
	) ) );
	// Titles color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f2_titles_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f2_titles_color', array (
			'label' => __ ( 'Titles color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f2_titles_color]',
			'priority' => 25 
	) ) );
	// Titles border bottom color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f2_titles_border_bottom_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f2_titles_border_bottom_color', array (
			'label' => __ ( 'Titles border bottom color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f2_titles_border_bottom_color]',
			'priority' => 26 
	) ) );
	// Link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f2_link_color]', array (
			'default' => '#8C8C8C',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f2_link_color', array (
			'label' => __ ( 'Link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f2_link_color]',
			'priority' => 27 
	) ) );
	// Link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f2_link_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f2_link_hover_color', array (
			'label' => __ ( 'Link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f2_link_hover_color]',
			'priority' => 28 
	) ) );
	
	// Border top color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f2_border_top_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f2_border_top_color', array (
			'label' => __ ( 'Border top color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f2_border_top_color]',
			'priority' => 29 
	) ) );
	
	/**
	 * ******************************************Information, Customer Service, Extras, My Account end**********************************************************
	 */
	
	/**
	 * ******************************************Powered by, Payment Images**********************************************************
	 */
	$wp_customize->add_setting ( 'PoweredbyPaymentImages' );
	$wp_customize->add_control ( new WP_Customize_PoweredbyPaymentImages_Control ( $wp_customize, 'PoweredbyPaymentImages', array (
			'section' => 'oxy_color_scheme_footer',
			'priority' => 30 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f4_bg_color]', array (
			'default' => '#2F2F2F',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f4_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f4_bg_color]',
			'priority' => 31 
	) ) );
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f4_text_color]', array (
			'default' => '#8C8C8C',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f4_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f4_text_color]',
			'priority' => 32 
	) ) );
	// Link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f4_link_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f4_link_color', array (
			'label' => __ ( 'Link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f4_link_color]',
			'priority' => 33 
	) ) );
	
	// Link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f4_link_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f4_link_hover_color', array (
			'label' => __ ( 'Link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f4_link_hover_color]',
			'priority' => 34 
	) ) );
	
	// Border top color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f4_border_top_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f4_border_top_color', array (
			'label' => __ ( 'Border top color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f4_border_top_color]',
			'priority' => 35 
	) ) );
	
	/**
	 * ******************************************Powered by, Payment Images end**********************************************************
	 */
	
	/**
	 * ******************************************Bottom Custom Block**********************************************************
	 */
	$wp_customize->add_setting ( 'BottomCustomBlock' );
	$wp_customize->add_control ( new WP_Customize_BottomCustomBlock_Control ( $wp_customize, 'BottomCustomBlock', array (
			'section' => 'oxy_color_scheme_footer',
			'priority' => 36 
	) ) );
	// Background color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f5_bg_color]', array (
			'default' => '#2F2F2F',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f5_bg_color', array (
			'label' => __ ( 'Background color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f5_bg_color]',
			'priority' => 37 
	) ) );
	// Text color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f5_text_color]', array (
			'default' => '#8C8C8C',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f5_text_color', array (
			'label' => __ ( 'Text color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f5_text_color]',
			'priority' => 38 
	) ) );
	// Link color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f5_link_color]', array (
			'default' => '#4BB8E2',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f5_link_color', array (
			'label' => __ ( 'Link color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f5_link_color]',
			'priority' => 39 
	) ) );
	
	// Link color hover
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f5_link_hover_color]', array (
			'default' => '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f5_link_hover_color', array (
			'label' => __ ( 'Link color hover:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f5_link_hover_color]',
			'priority' => 40 
	) ) );
	
	// Border top color
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_f5_border_top_color]', array (
			'default' => '#464646',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_f5_border_top_color', array (
			'label' => __ ( 'Border top color:', 'oxy' ),
			'section' => 'oxy_color_scheme_footer',
			'settings' => 'oxy_color_settings[oxy_f5_border_top_color]',
			'priority' => 41 
	) ) );
        
        /**
	 * ******************************************Footer end**********************************************************
	 */
	
	/**
	 * ******************************************Widgets start **********************************************************
	 */
        
        $wp_customize->add_section ( 'oxy_color_scheme_widget', array (
			'title' => __ ( 'Widgets', 'oxy' ),
			'priority' => 8 
	) );
        // Oxy Video Widget
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_video_box_bg]', array (
			'default' => '#ED5053',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_video_box_bg', array (
			'label' => __ ( 'Video box bg color:', 'oxy' ),
			'section' => 'oxy_color_scheme_widget',
			'settings' => 'oxy_color_settings[oxy_video_box_bg]',
			'priority' => 1 
	) ) );
        
        // Oxy Custom Widget
	$wp_customize->add_setting ( 'oxy_color_settings[oxy_custom_box_bg]', array (
			'default' => '#FFCA00',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options',
			'type' => 'option',
			'transport' => 'postMessage' 
	)
	 );
	
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'oxy_custom_box_bg', array (
			'label' => __ ( 'Custom box bg color:', 'oxy' ),
			'section' => 'oxy_color_scheme_widget',
			'settings' => 'oxy_color_settings[oxy_custom_box_bg]',
			'priority' => 2 
	) ) );
        
        
        

    $wp_customize->get_setting('blogname')->transport = 'postMessage';

    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
}

add_action( 'customize_register', 'oxy_customize_register' );