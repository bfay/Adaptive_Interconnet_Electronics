/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#site-title a' ).html( newval );
		} );
	} );
	
 
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

 
	//Update site background color...
	wp.customize( 'oxy_color_settings[oxy_body_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );
	
	//Update site headings  color...
	wp.customize( 'oxy_color_settings[oxy_headings_color]', function( value ) {
		value.bind( function( newval ) {
			$('h1, h2, h3, h4, h5, h6, #content .box-heading').css('color', newval );
		} );
	} );
	
	//Update site body text  color...
	wp.customize( 'oxy_color_settings[oxy_body_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('body, .cart-info thead td, .checkout-product thead td, table tbody tr td, .wishlist-info thead td, .sitemap-info ul li ul li, .sitemap-info ul li ul li a, .product-grid .name a, #content .box-product .name a, .product-list .name a, .product-info .wishlist-compare-friend a, .product-bottom-related .name a, .product-box-slider .name a, .product-right-sm-info span.p_title a, .box-category-home .subcat a, .product-compare a, .product-info .review > div a, .mini-cart-info .name small, .mini-cart-info td, .mini-cart-total td').css('color', newval );
		} );
	} );
	
	//Update site light text  color...
	wp.customize( 'oxy_color_settings[oxy_light_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('.heading h5, .product_box_brand span, .product_box_brand a, .product-description-l, .product-description-l span, .product-description-l a, ul.breadcrumbs li:before, .product-info .cart .minimum, .product-info .you-save, .product-right-sm-info span.p_subtitle').css('color', newval );
		} );
	} );
	
	//Update site other links  color...
	wp.customize( 'oxy_color_settings[oxy_other_links_color]', function( value ) {
		value.bind( function( newval ) {
			$('a, .box ul li, .product-info .save-percent, #product-top .product-description .product-description-l span.stock').css('color', newval );
			$('#menu_contacts .mc:hover span.mm_icon, .product-info .cart .dec:hover, .product-info .cart .inc:hover, .contact-info .mc:hover span.mm_icon, #footer_a .mc:hover span.mm_icon, .es-nav span:hover, .product-related .bx-wrapper div.bx-next:hover, .product-related .bx-wrapper div.bx-prev:hover, #toTopHover, .product-right-sm-info span.p_icon, #livesearch_search_results li:hover, #livesearch_search_results .highlighted, #swipebox-action, .top-bar ul > li a:hover').css('background-color', newval );
			$('.product-info .image-additional img:hover, .product-info .image-additional-left img:hover').css({
				"border-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	//Update site links hover  color...
	wp.customize( 'oxy_color_settings[oxy_links_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('a:hover, .product-info .review > div a:hover, .sitemap-info ul li ul li:hover, .sitemap-info ul li ul li a:hover, .htabs a:hover, #header #cart:hover .heading a div#cart-total, .product-grid .name a:hover, #content .box-product .name a:hover, .product-list .name a:hover, .product-info .wishlist-compare-friend a:hover, .product-bottom-related .name a:hover, .product-right-sm-info span.p_title a:hover, .box-category-home .subcat a:hover').css('color', newval );
			$('.product-right-sm-info .product-right-sm-info-content:hover span.p_icon, .camera_wrap .camera_pag .camera_pag_ul li:hover > span, .flex-control-paging li a:hover, #swipebox-action:hover, .tp-bullets.simplebullets.round .bullet:hover').css('background-color', newval );
		} );
	} );
	
	/********************************************GENERAL END************************************************/


	/********************************************MAIN COLUMN************************************************/
	
	//Update site Background color...
	wp.customize( 'oxy_color_settings[oxy_main_column_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.wrapper').css('background-color', newval );
		} );
	} );
	
	//Update site Border color...
	wp.customize( 'oxy_color_settings[oxy_main_column_border_color]', function( value ) {
		value.bind( function( newval ) {
			//$('.wrapper').css('border 1px solid', newval );
			$('.wrapper').css({
				"border-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
        
	/********************************************MAIN COLUMN END************************************************/
	
	/********************************************Content Column************************************************/
	//Update site Highlighted Items background color...
	wp.customize( 'oxy_color_settings[oxy_content_column_hli_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.product-filter, #content .content, .cart-info thead td, .checkout-heading, .checkout-product thead td, table.list thead td, .compare-info thead td, .compare-info thead tr td:first-child, .attribute thead td, .attribute thead tr td:first-child, .tab-content, .manufacturer-heading, .wishlist-info thead td, #header #cart .content, .reveal-modal, .custom_box, .success, .warning, .attention, #cboxContent').css('background-color', newval );
		} );
	} );
	
	//Update site Headings border bottom color...
	wp.customize( 'oxy_color_settings[oxy_content_column_head_border_color]', function( value ) {
		value.bind( function( newval ) {
			$('#content h1, #content .box-heading, .product-bottom-related h2').css(
				{
					"border-bottom-color": newval,
					"border-width":"1px", 
		            "border-style":"solid"
				}
			);
		} );
	} );
	
	//Update site Separator color...
	wp.customize( 'oxy_color_settings[oxy_content_column_separator_color]', function( value ) {
		value.bind( function( newval ) {
			$('.pagination, .product-info .price, .product-info .review, .product-info .options, .product-info .cart, .product-right-sm-logo, .product-right-sm-custom, .product-right-sm-info, .product-right-sm-related, .product-share, .product-right-sm-tags').css(
					{
						"border-top-color": newval,
						"border-width":"0px", 
			             "border-style":"solid"
					}
			);
			$('.product-compare').css(
					{
						"border-left-color": newval,
						"border-width":"1px", 
			             "border-style":"solid"
					}
			);
			$('.product-info .image, .product-info .image-additional img, .product-info .image-additional-left img, .contact-map, .manufacturer-list, .checkout-heading, .review-list, .product-info .option-image img').css(
					{
						"border-color": newval,
						"border-width":"1px", 
			             "border-style":"solid"
					}
			);
			$('.cart-info table, .cart-total table, .checkout-product table, .wishlist-info table, .order-list .order-content, table.list, .attribute, .compare-info').css(
					{
						"border-top-color": newval,
						"border-width":"1px", 
			             "border-style":"solid"
					}
			);
			$('.cart-info thead td, .cart-info tbody td, .cart-total table, .checkout-product thead td, .checkout-product tbody td, .checkout-product tfoot td, .wishlist-info thead td, .wishlist-info tbody td, .order-list .order-content, table.list td, .box-category-home .subcat li, .attribute td, .compare-info td, .mini-cart-info td, .mini-cart-total').css(
					{
						"border-bottom-color": newval,
						"border-width":"1px", 
			             "border-style":"solid"
					}
			);
			$('.cart-info table, .checkout-product table, .wishlist-info table, table.list, .attribute, .compare-info').css(
					{
						"border-left-color": newval,
						"border-width":"1px", 
			             "border-style":"solid"
					}
			);
			$('.cart-info table, .checkout-product table, table thead tr th:last-child, table tfoot tr td:last-child, .wishlist-info table, table.list td, .attribute td, .compare-info td').css(
					{
						"border-right-color": newval,
						"border-width":"1px", 
			             "border-style":"solid"
					}
			);
		} );
	} );
	
	/********************************************Content Column end************************************************/
	
	/********************************************Left Column Heading************************************************/
	
	//Update site Separator color...
	wp.customize( 'oxy_color_settings[oxy_left_column_head_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-left .box .box-heading, #column-left .product-box-slider .box-heading').css('background-color', newval );
		} );
	} );
	
	//Update site Title color...
	wp.customize( 'oxy_color_settings[oxy_left_column_head_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-left .box .box-heading, #column-left .product-box-slider .box-heading').css('color', newval );
		} );
	} );
	
	//Update site Border bottom color..
	wp.customize( 'oxy_color_settings[oxy_left_column_head_border_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-left .box .box-heading, #column-left .product-box-slider .box-heading').css({
				"border-bottom-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	/********************************************Left Column Heading end************************************************/
	
	/********************************************Left Column Box************************************************/
	
	//Update site Box background color...
	wp.customize( 'oxy_color_settings[oxy_left_column_box_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-left .box .box-content, #column-left .product-box-slider .box-content').css('background-color', newval );
		} );
	} );
	
	//Update site Links color...
	wp.customize( 'oxy_color_settings[oxy_left_column_box_links_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-left .box-product, #column-left .box-product a, #column-left .box .box-content ul li a, #column-left .product-box-slider .name a').css('color', newval );
		} );
	} );
	
	//Update site Links color hover..
	wp.customize( 'oxy_color_settings[oxy_left_column_box_links_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('#column-left .box-product a:hover, #column-left .box .box-content ul li a:hover, #column-left .product-box-slider .name a:hover').css('color', newval );
		} );
	} );
	
	/********************************************Left Column Box end************************************************/
	
	/********************************************Right Column Heading************************************************/
	
	//Update site Heading background color...
	wp.customize( 'oxy_color_settings[oxy_right_column_head_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-right .box .box-heading, #column-right .product-box-slider .box-heading').css('background-color', newval );
		} );
	} );
	
	//Update site Title color...
	wp.customize( 'oxy_color_settings[oxy_right_column_head_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-right .box .box-heading, #column-right .product-box-slider .box-heading').css('color', newval );
		} );
	} );
	
	//Update site Border bottom color..
	wp.customize( 'oxy_color_settings[oxy_right_column_head_border_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-right .box .box-heading, #column-right .product-box-slider .box-heading').css({
				"border-bottom-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	/********************************************Right Column Heading end************************************************/
	
	/********************************************Right Column Box************************************************/
	
	//Update site Box background color...
	wp.customize( 'oxy_color_settings[oxy_right_column_box_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-right .box .box-content, #column-right .product-box-slider .box-content').css('background-color', newval );
		} );
	} );
	
	//Update site Links color...
	wp.customize( 'oxy_color_settings[oxy_right_column_box_links_color]', function( value ) {
		value.bind( function( newval ) {
			$('#column-right .box-product, #column-right .box-product a, #column-right .box .box-content ul li a, #column-right .product-box-slider .name a').css('color', newval );
		} );
	} );
	
	//Update site Links color hover..
	wp.customize( 'oxy_color_settings[oxy_right_column_box_links_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('#column-right .box-product a:hover, #column-right .box .box-content ul li a:hover, #column-right .product-box-slider .name a:hover').css('color', newval );
		} );
	} );
	
	/********************************************Right Column Box end************************************************/
	
	/********************************************Category Box Heading************************************************/
	
	//Update site Heading background color...
	wp.customize( 'oxy_color_settings[oxy_category_box_head_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-category .box-heading-category').css('background-color', newval );
		} );
	} );
	
	//Update site Title color...
	wp.customize( 'oxy_color_settings[oxy_category_box_head_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-category .box-heading-categor').css('color', newval );
		} );
	} );
	
	//Update site Border bottom color..
	wp.customize( 'oxy_color_settings[oxy_category_box_head_border_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-category .box-heading-category').css({
				"border-bottom-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	/********************************************Category Box Heading end************************************************/
	
	/********************************************Category Box Content************************************************/
	//Update site Box background color..
	wp.customize( 'oxy_color_settings[oxy_category_box_box_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-category .box-content-category').css('background-color', newval );
		} );
	} );
	
	//Update site Box background color hover
	wp.customize( 'oxy_color_settings[oxy_category_box_box_bg_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('.box-category .box-content-category ul > li > a:hover').css('background-color', newval );
		} );
	} );
	
	//Update site Links color
	wp.customize( 'oxy_color_settings[oxy_category_box_box_links_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-category .box-content-category ul > li > a ').css('color', newval );
		} );
	} );
	
	//Update site Links color hover
	wp.customize( 'oxy_color_settings[oxy_category_box_box_links_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('.box-category .box-content-category ul > li > a:hover').css('color', newval );
		} );
	} );
	
	//Update site Separator color
	wp.customize( 'oxy_color_settings[oxy_category_box_box_separator_color]', function( value ) {
		value.bind( function( newval ) {
			$('-category .box-content-category ul > li + li, .box-category .box-content-category ul > li ul ').css({
				"border-top-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	/********************************************Category Box Content end************************************************/
	
	/********************************************Filter Box Heading************************************************/
	
	//Update site Heading background color
	wp.customize( 'oxy_color_settings[oxy_filter_box_head_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-filter .box-heading').css('background-color', newval );
		} );
	} );
	
	//Update site Title color
	wp.customize( 'oxy_color_settings[oxy_filter_box_head_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-filter .box-heading').css('color', newval );
		} );
	} );
	
	//Update site Border bottom color
	wp.customize( 'oxy_color_settings[oxy_filter_box_head_border_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-filter .box-heading').css({
				"border-bottom-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	/********************************************Filter Box Heading end************************************************/
	
	/********************************************Filter Box Content************************************************/
	
	//Update site Box background color
	wp.customize( 'oxy_color_settings[oxy_filter_box_box_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-filter .box-content').css('background-color', newval );
		} );
	} );
	
	//Update site Links color
	wp.customize( 'oxy_color_settings[oxy_filter_box_box_links_color]', function( value ) {
		value.bind( function( newval ) {
			$('.box-filter .box-content span, .box-filter label').css('color', newval );
		} );
	} );
	
	//Update site Links color hover
	wp.customize( 'oxy_color_settings[oxy_filter_box_box_links_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('.box-filter label:hover').css('color', newval );
		} );
	} );
	/********************************************Filter Box Content end************************************************/
	
	/********************************************PRICES**************************************************************/
	//Update site Price color
	wp.customize( 'oxy_color_settings[oxy_price_color]', function( value ) {
		value.bind( function( newval ) {
			$('.price, .total, .product-info .price .discount').css('color', newval );
		} );
	} );
	
	//Update site Old price color
	wp.customize( 'oxy_color_settings[oxy_price_old_color]', function( value ) {
		value.bind( function( newval ) {
			$('.tax-brands .price del, .woocommerce .price del, .woocommerce-page .price del, .price-old, .wishlist-info tbody .price s').css('color', newval );
		} );
	} );
	
	//Update site New price color
	wp.customize( 'oxy_color_settings[oxy_price_new_color]', function( value ) {
		value.bind( function( newval ) {
			$('.tax-brands .price ins, .woocommerce .price ins, .woocommerce-page .price ins, .price-new, .cart-total .total-r').css('color', newval );
		} );
	} );
	
	//Update site Tax price color
	wp.customize( 'oxy_color_settings[oxy_price_tax_color]', function( value ) {
		value.bind( function( newval ) {
			$('.price-tax, .product-info .price .reward').css('color', newval );
		} );
	} );
	/********************************************PRICES END**************************************************************/
	
	/********************************************Buttons**************************************************************/
	//Update site Background color
	wp.customize( 'oxy_color_settings[oxy_button_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce #review_form #respond .form-submit input#submit, #articleComments p.form-submit input,a.button, input.button, .ei-title h4 a.button').css('background-color', newval );
		} );
	} );
	
	//Update site Background color hover
	wp.customize( 'oxy_color_settings[oxy_button_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce #review_form #respond .form-submit input#submit:hover,#articleComments p.form-submit input:hover,a.button:hover, input.button:hover, .ei-title h4 a.button:hover').css('background-color', newval );
		} );
	} );
	
	//Update site Text color
	wp.customize( 'oxy_color_settings[oxy_button_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce #review_form #respond .form-submit input#submit, #articleComments p.form-submit input,a.button, input.button, .ei-title h4 a.button').css('color', newval );
		} );
	} );
	
	//Update site Text color hover
	wp.customize( 'oxy_color_settings[oxy_button_text_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce #review_form #respond .form-submit input#submit:hover,#articleComments p.form-submit input:hover,a.button:hover, input.button:hover, .ei-title h4 a.button:hover').css('color', newval );
		} );
	} );
	/********************************************Buttons end**********************************************************/
	
	/********************************************Exclusive Buttons**************************************************************/
	
	//Update site Background color
	wp.customize( 'oxy_color_settings[oxy_button_exclusive_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, a.button-exclusive, input.button-exclusive').css('background-color', newval );
		} );
	} );
	
	//Update site Background color hover
	wp.customize( 'oxy_color_settings[oxy_button_exclusive_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce div.product form.cart .button:hover, .woocommerce #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover,a.button-exclusive:hover, input.button-exclusive:hover').css('background-color', newval );
		} );
	} );
	
	//Update site Text color
	wp.customize( 'oxy_color_settings[oxy_button_exclusive_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button,a.button-exclusive, input.button-exclusive').css('color', newval );
		} );
	} );
	
	//Update site Text color hover
	wp.customize( 'oxy_color_settings[oxy_button_exclusive_text_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce div.product form.cart .button:hover, .woocommerce #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover,a.button-exclusive:hover, input.button-exclusive:hover').css('color', newval );
		} );
	} );
	
	/********************************************Exclusive Buttons end**************************************************************/
	
	/********************************************Light Buttons***************************************************************/
	
	//Update site Background color
	wp.customize( 'oxy_color_settings[oxy_button_light_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.tax-brands a.button,.tax-brands input.button,.woocommerce-page a.button,.woocommerce a.button,.woocommerce-page input.button,.woocommerce input.button,.woocommerce-page #content input.button,.woocommerce #content input.button,.product-grid .cart input.button, .product-list .cart input.button, #content .box-product .cart input.button, .product-right-sm-tags div a, .product-box-slider .cart input.button, .product-bottom-related .cart input.button, #header #cart .checkout .mini-cart-button').css('background-color', newval );
		} );
	} );
	
	//Update site Background color hover
	wp.customize( 'oxy_color_settings[oxy_button_light_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.tax-brands a.button:hover,.tax-brands input.button:hover,.woocommerce-page a.button:hover,.woocommerce a.button:hover,.woocommerce-page input.button:hover,.woocommerce input.button:hover,.woocommerce-page #content input.button:hover,.woocommerce #content input.button:hover,.prev-next a:hover, .product-right-sm-related .flex-direction-nav a:hover, .product-bottom-related .flex-direction-nav a:hover, .product-box-slider .flex-direction-nav a:hover, .pagination .links b, .pagination .links a:hover, .flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover, .camera_prevThumbs:hover, .camera_nextThumbs:hover, .camera_prev:hover, .camera_next:hover, .camera_commands:hover, .camera_thumbs_cont:hover, .camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span, .flex-control-paging li a.flex-active, .slideshow .nivo-directionNav a:hover, .tp-bullets.simplebullets .bullet.selected, .tp-leftarrow:hover, .tp-rightarrow:hover').css('background-color', newval );
		} );
	} );
	
	//Update site Text color
	wp.customize( 'oxy_color_settings[oxy_button_light_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('.tax-brands a.button,.tax-brands input.button,.woocommerce-page a.button,.woocommerce a.button,.woocommerce-page input.button,.woocommerce input.button,.woocommerce-page #content input.button,.woocommerce #content input.button,.product-grid .cart input.button, .product-list .cart input.button, #content .box-product .cart input.button, .product-right-sm-tags div a, .product-box-slider .cart input.button, .product-bottom-related .cart input.button, #header #cart .checkout .mini-cart-button').css('color', newval );
		} );
	} );
	
	//Update site Text color hover
	wp.customize( 'oxy_color_settings[oxy_button_light_text_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.tax-brands a.button:hover,.tax-brands input.button:hover,.woocommerce-page a.button:hover,.woocommerce a.button:hover,.woocommerce-page input.button:hover,.woocommerce input.button:hover,.woocommerce-page #content input.button:hover,.woocommerce #content input.button:hover,.product-grid .cart input.button:hover, .product-list .cart input.button:hover, #content .box-product .cart input.button:hover, .product-right-sm-tags div a:hover, .product-box-slider .cart input.button:hover, .product-bottom-related .cart input.button:hover, #header #cart .checkout .mini-cart-button:hover').css('color', newval );
		} );
	} );
	
	/********************************************Light Buttons end***********************************************************/
	
	/********************************************Slider Buttons***********************************************************/
	//Update site Background color
	wp.customize( 'oxy_color_settings[oxy_button_slider_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.prev-next a, .product-bottom-related .flex-direction-nav a, .product-bottom-related .flex-direction-nav .flex-disabled:hover, .product-right-sm-related .flex-direction-nav a, .product-right-sm-related .flex-direction-nav .flex-disabled:hover, .product-box-slider .flex-direction-nav a, .product-box-slider .flex-direction-nav .flex-disabled:hover, .pagination .links a, .flex-direction-nav a, .flex-control-paging li a, .camera_prevThumbs, .camera_nextThumbs, .camera_prev, .camera_next, .camera_commands, .camera_thumbs_cont, .camera_wrap .camera_pag .camera_pag_ul li, .slideshow .nivo-directionNav a, .tp-bullets.simplebullets.round .bullet, .tp-leftarrow.default, .tp-rightarrow.default').css('background-color', newval );
		} );
	} );
	
	//Update site Background color hover
	wp.customize( 'oxy_color_settings[oxy_button_slider_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('v-next a:hover, .product-right-sm-related .flex-direction-nav a:hover, .product-bottom-related .flex-direction-nav a:hover, .product-box-slider .flex-direction-nav a:hover, .pagination .links b, .pagination .links a:hover, .flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover, .camera_prevThumbs:hover, .camera_nextThumbs:hover, .camera_prev:hover, .camera_next:hover, .camera_commands:hover, .camera_thumbs_cont:hover, .camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span, .flex-control-paging li a.flex-active, .slideshow .nivo-directionNav a:hover, .tp-bullets.simplebullets .bullet.selected, .tp-leftarrow:hover, .tp-rightarrow:hover').css('background-color', newval );
		} );
	} );
	/********************************************Slider Buttons end***********************************************************/
	
	/********************************************Header***********************************************************/

	//Update site Background color
	wp.customize( 'oxy_color_settings[oxy_top_area_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header').css('background-color', newval );
		} );
	} );
	
	//Update site Fixed Header (Mini Header) background color
	wp.customize( 'oxy_color_settings[oxy_top_area_mini_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.is-sticky #header').css('background-color', newval );
		} );
	} );

	/********************************************Header end***********************************************************/
	
	/********************************************Top Bar***********************************************************/

	//Update site Background color
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#top-line').css('background-color', newval );
		} );
	} );
	
	//Update site Border top color
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_top_border_color]', function( value ) {
		value.bind( function( newval ) {
			$('#top-line').css({
				"border-top-color": newval,
				"border-width":"4px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	//Update site Border bottom color
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_bottom_border_color]', function( value ) {
		value.bind( function( newval ) {
			$('#top-line').css({
				"border-bottom-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	//Update site Text Color
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('#top-line').css('color', newval );
		} );
	} );
	
	//Update site Link color
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#top-line a').css('color', newval );
		} );
	} );
	
	//Update site Link color hover
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_link_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('#top-line a:hover').css('color', newval );
		} );
	} );
	
	//Update site Separator color
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_separator_color]', function( value ) {
		value.bind( function( newval ) {
			$('#welcome ,#top-account, #top-wishlist, #top-cart, #top-checkout, .my-account, #top-menu ul li a').css('border-color', newval );
		} );
	} );
	
	//Update site Dropdowns background color
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_dropdown_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.dropdown_l ul').css('background-color', newval );
		} );
	} );
	
	//Update site Dropdowns background color hover
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_dropdown_bg_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('.dropdown_l li a:hove').css('background-color', newval );
		} );
	} );
	
	//Update site Dropdowns link color
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_dropdown_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('.dropdown_l li a').css('color', newval );
		} );
	} );
	
	//Update site Dropdowns link color hover
	wp.customize( 'oxy_color_settings[oxy_top_area_tb_dropdown_link_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('.dropdown_l li a:hover').css('color', newval );
		} );
	} );

	/********************************************Top Bar End***********************************************************/
	
	/********************************************Search Bar***********************************************************/
	//background color
	wp.customize( 'oxy_color_settings[oxy_top_area_search_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header #search input').css('background-color', newval );
		} );
	} );

	//border color
	wp.customize( 'oxy_color_settings[oxy_top_area_search_border_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header #search input').css('border-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_top_area_search_border_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('#header #search input:focus').css('border-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_top_area_search_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header #search input').css('color', newval );
		} );
	} );
	
	/********************************************Search Bar End***********************************************************/
	
	/********************************************Cart Section***********************************************************/
	wp.customize( 'oxy_color_settings[oxy_top_area_cart_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header #cart h5').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_top_area_cart_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header #cart .heading a div#cart-total').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_top_area_cart_link_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('#header #cart .heading a div#cart-total:hover').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_top_area_cart_separator_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header #cart .heading a div#cart-total').css({
				"border-right-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	/********************************************Cart Section End***********************************************************/
	
	/********************************************Main menu***************************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_separator_color]', function( value ) {
		value.bind( function( newval ) {
			$('u_oc > ul > li, #menu_v > ul > li, #menu_h > ul > li, #menu_brands > ul > li, .menu_links, #menu_custom_menu > ul > li, .menu_custom_block > ul > li, #menu_informations > ul > li, #menu_contacts > ul > li').css({
				"border-left-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_border_top_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu').css({
				"border-top-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_border_bottom_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu').css({
				"border-bottom-color": newval,
				"border-width":"1px", 
	             "border-style":"solid"
			});
		} );
	} );
	
	/********************************************Main menu end***********************************************************/
	
	/********************************************Home Page Link***********************************************************/

	wp.customize( 'oxy_color_settings[oxy_mm1_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header div.nav ul > li,#menu ul.nav > li').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm1_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header div.nav ul > li:hover,#menu ul.nav > li:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm1_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header div.nav ul > li > a,#menu ul.nav > li > a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm1_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu #homepage:hover a').css('color', newval );
		} );
	} );

	/********************************************Home Page Link end***********************************************************/
	
	/********************************************Categories Section***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm2_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_oc > ul > li, #menu_v > ul > li, #menu_h > ul > li').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm2_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_oc > ul > li:hover, #menu_v > ul > li:hover, #menu_h > ul > li:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm2_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_oc > ul > li > a, #menu_v > ul > li > a, #menu_h > ul > li > a ').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm2_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_oc > ul > li:hover > a, #menu_v > ul > li:hover > a, #menu_h > ul > li:hover > a').css('color', newval );
		} );
	} );
	
	/********************************************Categories Section end***********************************************************/
	
	/********************************************Brands Section***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm3_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_brands > ul > li').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm3_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_brands > ul > li:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm3_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_brands > ul > li > a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm3_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_brands > ul > li:hover > a').css('color', newval );
		} );
	} );
	
	/********************************************Brands Section end***********************************************************/
	
	/********************************************Custom Links Section***********************************************************/

	wp.customize( 'oxy_color_settings[oxy_mm4_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.menu_links').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm4_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.menu_links:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm4_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('.menu_links a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm4_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.menu_links:hover a').css('color', newval );
		} );
	} );

	/********************************************Custom Links Section end***********************************************************/
	
	/********************************************Custom Menu Section***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm6_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_custom_menu > ul > li').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm6_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_custom_menu > ul > li:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm6_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_custom_menu > ul > li > a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm6_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_custom_menu > ul > li:hover > a').css('color', newval );
		} );
	} );
	
	/********************************************Custom Menu Section***********************************************************/
	
	/********************************************Custom Blocks Section***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm8_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.menu_custom_block > ul > li').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm8_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.menu_custom_block > ul > li:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm8_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('.menu_custom_block > ul > li > a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm8_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.menu_custom_block > ul > li:hover > a').css('color', newval );
		} );
	} );
	
	/********************************************Custom Blocks Section end***********************************************************/
	
	/********************************************Information Section***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm5_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_informations > ul > li').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm5_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_informations > ul > li:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm5_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_informations > ul > li > a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm5_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_informations > ul > li:hover > a').css('color', newval );
		} );
	} );
	
	/********************************************Information Section end***********************************************************/
	
	/********************************************Contact Section***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm7_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_contacts > ul > li').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm7_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_contacts > ul > li:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm7_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_contacts > ul > li > a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm7_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_contacts > ul > li:hover > a').css('color', newval );
		} );
	} );
	
	/********************************************Contact Section end***********************************************************/
	
	/********************************************Sub-Menu***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm_sub_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu ul.nav li > ul.sub-menu,#menu ul.nav li div.large-10.columns, #menu ul.nav li div.large-6.columns.menu_contacts, #menu_oc > ul > li > div, #menu_oc > ul > li > div > ul > li > div, #menu_v > ul > li > div, #menu_v > ul > li > div > ul > li > div, #menu_v > ul > li > div > ul > li > div > ul > li > div, #menu_h > ul > li > div, #menu_brands > ul > li > div, #menu_custom_menu > ul > li > div, .menu_custom_block > ul > li > div, #menu_informations > ul > li > div, #menu_contacts > ul > li > div ').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_sub_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_oc > ul > li ul > li > a:hover, #menu_v > ul > li ul > li > a:hover, #menu_h > ul > li ul > li > a:hover, #menu_v > ul > li > div > ul > li ul > li > a:hover, #menu_h span a:hover, #menu_brands > ul > li > div > div:hover, #menu_custom_menu > ul > li ul > li > a:hover, #menu_informations > ul > li ul > li > a:hover').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_sub_titles_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu ul.nav li div.large-10.columns div.five-nb > span > a,#menu_h span a, #menu_informations span, #menu_contacts > ul > li > div > ul > li > .ngw, #menu_contacts > ul > li > div > ul > li > .social_widget').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_sub_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu ul.nav li div.large-10.columns div.five-nb > span > a, #menu_informations span, .menu_custom_block h1, #menu_contacts > ul > li > div > ul > li > .ngw, #menu_contacts span.mm').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_sub_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu ul.nav li > ul.sub-menu li a, #menu ul.nav > li div.large-10.columns a,#menu_oc > ul > li ul > li > a, #menu_v > ul > li ul > li > a, #menu_h span a, #menu_h > ul > li ul > li > a, #menu_brands > ul > li > div > div a, #menu_custom_menu > ul > li ul > li > a, .menu_custom_block > ul > li > div a, #menu_informations > ul > li ul > li > a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_sub_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_oc > ul > li ul > li > a:hover, #menu_v > ul > li ul > li > a:hover, #menu_v > ul > li > div > ul > li ul > li > a:hover, #menu_h span a:hover, #menu_h > ul > li ul > li > a:hover, #menu_brands > ul > li > div > div:hover a, #menu_custom_menu > ul > li ul > li > a:hover, .menu_custom_block > ul > li > div a:hover, #menu_informations > ul > li ul > li > a:hover').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mm_sub_separator_color]', function( value ) {
		value.bind( function( newval ) {
			$('#menu_h > ul > li ul > li ul > li:first-child').css('color', newval );
		} );
	} );

	/********************************************Sub-Menu end***********************************************************/
	
	/********************************************Mobile Main Menu Bar***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mm_mobile_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.top-bar ul > li.name a').css('background-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_mm_mobile_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.top-bar:hover ul > li.name a').css('background-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_mm_mobile_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('.top-bar ul > li.name a').css('color', newval );
		} );
	} );
	
	/********************************************Mobile Main Menu Bar end***********************************************************/
	
	/********************************************Midsection***************************************************************/
	
	/********************************************Product Box***************************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_box_bg_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('.product-grid > div:hover, .product-list > div:hover, #content .box-product > div:hover').css('background-color', newval );
		} );
	} );
        
	wp.customize( 'oxy_color_settings[oxy_mid_prod_stars_color]', function( value ) {
		value.bind( function( newval ) {
			$('.star-rating span').css('color', newval +'!important' );
		} );
	} );
        
	wp.customize( 'oxy_color_settings[oxy_mid_prod_box_sale_icon_color]', function( value ) {
		value.bind( function( newval ) {
			$('.tax-brands span.onsale, .woocommerce span.onsale, .woocommerce-page span.onsale').css('background-color', newval );
		} );
	} );
        
	
	
	/********************************************Product Box end***************************************************************/

	/********************************************Product Page - Tabs***************************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_page_tabs_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce-tabs .tabs li a,.htabs a').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_page_tabs_selected_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce-tabs .tabs li.active a,.htabs a.selected').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_page_tabs_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('.woocommerce-tabs .tabs li a,.woocommerce-tabs .tabs li.active a,.htabs a, .htabs a.selected').css('color', newval );
		} );
	} );
	/********************************************Product Page - Tabs end***************************************************************/

	/********************************************Product Slider on Home Page***************************************************************/
	wp.customize( 'oxy_color_settings[oxy_mid_prod_slider_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.ei-slider').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_slider_name_color]', function( value ) {
		value.bind( function( newval ) {
			$('.ei-title h2 a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_slider_desc_color]', function( value ) {
		value.bind( function( newval ) {
			$('.ei-title h3 a, .ei-title h4 a .price-old').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_slider_price_color]', function( value ) {
		value.bind( function( newval ) {
			$('.ei-title h4 a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_slider_links_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('.ei-title h2 a:hover, .ei-title h3 a:hover').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('.ei-slider-thumbs li a').css('background', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('.ei-slider-thumbs li a:hover').css('background', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_mid_prod_slider_bottom_bar_bg_color_active]', function( value ) {
		value.bind( function( newval ) {
			$('.ei-slider-thumbs li.ei-slider-element').css('background', newval );
		} );
	} );
/********************************************Product Slider on Home Page end***************************************************************/
	
/********************************************Midsection end***************************************************************/
	
/********************************************Footer**************************************************************/
/********************************************Feature Block*****************************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_fp_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_p').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_fp_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_p span.p_title a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_fp_title_color_hover]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_p span.p_title a:hover').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_fp_subtitle_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_p span.p_subtitle').css('color', newval );
		} );
	} );
        
        
	wp.customize( 'oxy_color_settings[oxy_fp_fb1_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_p span.pi1').css('background-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_fp_fb2_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_p span.pi2').css('background-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_fp_fb3_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_p span.pi3').css('background-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_fp_fb4_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_p span.pi4').css('background-color', newval );
		} );
	} );
	
/********************************************Feature Block end***********************************************************/
	
/********************************************About Us, Custom Column, Follow Us, Contact Us*******************************************/

	wp.customize( 'oxy_color_settings[oxy_f1_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_a').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_f1_titles_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_a h3').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_f1_titles_border_bottom_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_a h3').css({
				"border-bottom-color": newval,
				"border-bottom-width":"1px", 
                                "border-bottom-style":"solid"
			});
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_f1_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_f1_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_a a').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_f1_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_a a:hover').css('color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_f1_icon_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_a span.mm_icon, #footer_a .social_widget ul li').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'oxy_color_settings[oxy_f1_border_top_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_a').css({
				"border-top-color": newval,
				"border-top-width":"1px", 
                                "border-top-style":"solid"
			});
		} );
	} );

/********************************************About Us, Custom Column, Follow Us, Contact Us end***************************************/
	
/********************************************Information, Customer Service, Extras, My Account************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_f2_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_c ').css('background-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f2_titles_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_c h3').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f2_titles_border_bottom_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_c h3').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f2_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_c a').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f2_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_c').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f2_border_top_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_c a:hover').css('color', newval );
		} );
	} );

/********************************************Information, Customer Service, Extras, My Account end************************************************/
	
/********************************************Powered by, Payment Images***********************************************************/

	wp.customize( 'oxy_color_settings[oxy_f4_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_d').css('background-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f4_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_d').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f4_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_d a').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f4_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_d a:hover').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f4_border_top_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_d').css({
				"border-top-color": newval,
				"border-top-width":"1px", 
                                "border-top-style":"solid"
			});
		} );
	} );
	
/********************************************Powered by, Payment Images end***********************************************************/
	
/********************************************Bottom Custom Block***********************************************************/
	
	wp.customize( 'oxy_color_settings[oxy_f5_bg_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_e').css('background-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f5_text_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_e').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f5_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_e a').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f5_link_hover_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_e a:hover').css('color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_f5_border_top_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer_e').css({
				"border-top-color": newval,
				"border-top-width":"1px", 
                                "border-top-style":"solid"
			});
		} );
	} );
	
/********************************************Bottom Custom Block end***********************************************************/
/********************************************Footer end**************************************************************/
/********************************************Widgets start **************************************************************/
	wp.customize( 'oxy_color_settings[oxy_video_box_bg]', function( value ) {
		value.bind( function( newval ) {
			$('.video_box_left #video_box_icon, .video_box_right #video_box_icon').css('background-color', newval );
			$('.video_box_right .video_box, .video_box_left .video_box').css('border-color', newval );
		} );
	} );
	wp.customize( 'oxy_color_settings[oxy_custom_box_bg]', function( value ) {
		value.bind( function( newval ) {
			$('.custom_box_left #custom_box_icon, .custom_box_right #custom_box_icon').css('background-color', newval );
			$('.custom_box_right .custom_box, .custom_box_left .custom_box').css('border-color', newval );
		} );
	} );
} )( jQuery );

