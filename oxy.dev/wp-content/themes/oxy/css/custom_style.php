<?php 
$res = preg_split('/wp-content/', dirname(__FILE__));
include $res[0].'wp-load.php';
global $smof_data;
header('Content-type:text/css;');
global $smof_data;

$smof_color_data = get_option( 'oxy_color_settings' ); // array
?>

/* font family */

body, p, .ei-title h3 { 
    font-family: <?php echo !empty($smof_data->oxy_fonts_settings['oxy_body_font'])?"'".str_replace('+',' ',$smof_data->oxy_fonts_settings['oxy_body_font'])."'":"'Open Sans'"?>,Arial,Helvetica,sans-serif; 
}
<?php 
if(!empty($smof_data->oxy_fonts_settings['oxy_body_font_size'])){?>
body, p, td, th, input, textarea, select, a, label, .count, ul, ol, dl, ul li ul, ul li ol, .articleHeader span, .articleHeader span a ,
table tr th, table tr td, table thead tr th, table thead tr td, table tfoot tr th, table tfoot tr td
{
  font-size: <?php echo $smof_data->oxy_fonts_settings['oxy_body_font_size']?>px;
}
<?php }?>
h1, h2, h3, h4, h5, h6, .woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a, .woocommerce-page ul.cart_list li a, .woocommerce-page ul.product_list_widget li a, #content .box-heading, .box-category .box-heading-category, .box-filter .box-heading, #column-left .box .box-heading, #column-right .box .box-heading, #column-left .product-box-slider .box-heading, #column-right .product-box-slider .box-heading, .woocommerce ul.products .name a, .product-grid .name a, .product-list .name a, #content .box-product .name a, .product-right-sm-related .name a, .product-bottom-related .name a, #column-left .box-product .name a, #column-right .box-product .name a, .product-box-slider .name a, .box-category-home a, .woocommerce-page #content div.product form.cart .variations label, .quote_bottom_content p.quote_author { 
    font-family: <?php echo !empty($smof_data->oxy_fonts_settings['oxy_title_font'])?"'".str_replace('+',' ',$smof_data->oxy_fonts_settings['oxy_title_font'])."'":"'Bitter'"?>,Arial,Helvetica,sans-serif; 
    font-weight : <?php echo $smof_data->oxy_fonts_settings['oxy_title_font_weight']?>;    
    <?php if($smof_data->oxy_fonts_settings['oxy_title_font_uppercase'] == 1){?>
    text-transform : uppercase;
    <?php }else{?>
    text-transform : none;
    <?php }?>
}

.price, .tax-brands .price del, .woocommerce ul.product_list_widget li .amount, .woocommerce ul.product_list_widget li del, .woocommerce ul.product_list_widget li del .amount, .woocommerce ul.product_list_widget li ins, .woocommerce ul.product_list_widget li ins .amount, .woocommerce .price del, .woocommerce-page .price del,.tax-brands .price ins, .woocommerce .price ins, .woocommerce-page .price ins, .product-info .saved { 
    font-family: <?php echo !empty($smof_data->oxy_fonts_settings['oxy_price_font'])?"'".str_replace('+',' ',$smof_data->oxy_fonts_settings['oxy_price_font'])."'":"'Bitter'"?>,Arial,Helvetica,sans-serif; 
    font-weight : <?php echo $smof_data->oxy_fonts_settings['oxy_price_font_weight']?>;    
}
.articleContent input[type=submit],
.button, .woocommerce #review_form #respond .form-submit input#submit,
#articleComments p.form-submit input,
a.button, input.button, .ei-title h4 a.button,
.woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button,
a.button-exclusive, input.button-exclusive,
.tax-brands a.button,.tax-brands input.button,.woocommerce-page a.button,.woocommerce a.button,.woocommerce-page input.button,.woocommerce input.button,.woocommerce-page #content input.button,.woocommerce #content input.button,
.product-grid .cart input.button, .product-list .cart input.button, #content .box-product .cart input.button, .product-right-sm-tags div a, .product-box-slider .cart input.button, .product-bottom-related .cart input.button, #header #cart .checkout .mini-cart-button { 
    font-family: <?php echo !empty($smof_data->oxy_fonts_settings['oxy_button_font'])?"'".str_replace('+',' ',$smof_data->oxy_fonts_settings['oxy_button_font'])."'":"'Open Sans'"?>,Arial,Helvetica,sans-serif; 
    font-weight : <?php echo $smof_data->oxy_fonts_settings['oxy_button_font_weight']?>;    
    <?php if($smof_data->oxy_fonts_settings['oxy_button_font_uppercase'] == 1){?>
    text-transform : uppercase;
    <?php }else{?>
    text-transform : none;
    <?php }?>
}

#header #search input { 
    font-family: <?php echo !empty($smof_data->oxy_fonts_settings['oxy_search_font'])?"'".str_replace('+',' ',$smof_data->oxy_fonts_settings['oxy_search_font'])."'":"'Open Sans'"?>,Arial,Helvetica,sans-serif; 
    font-weight : <?php echo $smof_data->oxy_fonts_settings['oxy_search_font_weight']?>;    
    font-size : <?php echo $smof_data->oxy_fonts_settings['oxy_search_font_size']?>px;    
    <?php if($smof_data->oxy_fonts_settings['oxy_search_font_uppercase'] == 1){?>
    text-transform : uppercase;
    <?php }else{?>
    text-transform : none;
    <?php }?>
}

#header #cart .heading a div#cart-total { 
    font-family: <?php echo !empty($smof_data->oxy_fonts_settings['oxy_cart_font'])?"'".str_replace('+',' ',$smof_data->oxy_fonts_settings['oxy_cart_font'])."'":"'Bitter'"?>,Arial,Helvetica,sans-serif; 
    font-weight : <?php echo $smof_data->oxy_fonts_settings['oxy_cart_font_weight']?>;    
    font-size : <?php echo $smof_data->oxy_fonts_settings['oxy_cart_font_size']?>px;    
    <?php if($smof_data->oxy_fonts_settings['oxy_cart_font_uppercase'] == 1){?>
    text-transform : uppercase;
    <?php }else{?>
    text-transform : none;
    <?php }?>
}
#mobile-menu ul.nav > li > a,
#header div.nav ul > li > a, #menu ul.nav > li > a, #header .mobile_menu_trigger, #header .mobile-nav ul.nav ul li a, 
#header .mobile-nav ul.nav .brands-wall a ,#header .mobile-nav ul.nav .small-10.columns .five-nb.columns a{ 
    font-family: <?php echo !empty($smof_data->oxy_fonts_settings['oxy_main_menu_font'])?"'".str_replace('+',' ',$smof_data->oxy_fonts_settings['oxy_main_menu_font'])."'":"'Bitter'"?>,Arial,Helvetica,sans-serif; 
    font-weight : <?php echo $smof_data->oxy_fonts_settings['oxy_mm_font_weight']?>;    
    font-size : <?php echo $smof_data->oxy_fonts_settings['oxy_mm_font_size']?>px;    
}
#mobile-menu ul.nav li a,
#header div.nav ul li a, #menu ul.nav li a, #header .mobile_menu_trigger, #header .mobile-nav ul.nav ul li a, 
#header .mobile-nav ul.nav .brands-wall a, #header .mobile-nav ul.nav .small-10.columns .five-nb.columns a {  
    <?php if($smof_data->oxy_fonts_settings['oxy_mm_font_uppercase'] == 1){?>
    text-transform : uppercase;
    <?php }else{?>
    text-transform : none;
    <?php }?>
}


/*  Body background color and pattern  */
body {

<?php if(isset($smof_color_data['oxy_body_bg_color']) 
        && $smof_color_data['oxy_body_bg_color'] != '') { ?>
    background-color: <?php echo $smof_color_data['oxy_body_bg_color']; ?>;
<?php      
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_custom']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_custom'])){
?>
    background-image: url('<?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_custom'] ?>');
<?php

}elseif(isset($smof_data->oxy_background_images_settings['oxy_pattern_oxy']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_pattern_oxy'])
        && $smof_data->oxy_background_images_settings['oxy_pattern_oxy'] != '0'){    
    ?>
    
    background-image: url('<?php echo oxy_get_bg_pattern_by_id($smof_data->oxy_background_images_settings['oxy_pattern_oxy']) ?>');
<?php  
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_position']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_position'])){
?>
    background-position: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_position'] ?>;
<?php
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_repeat']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_repeat'])){
?>
    background-repeat: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_repeat'] ?>;
<?php
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_attachment']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_attachment'])){
?>
    background-attachment: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_attachment'] ?>;
<?php
}
?>
    
}

/* Headings color*/
.panel h1, .panel h2, .panel h3, .panel h4, .panel h5, .panel h6,
h1, h2, h3, h4, h5, h6, #content .box-heading, .woocommerce form .form-row label, label, .woocommerce-page form .form-row label, #jckqv h1 { 
	<?php if($smof_color_data['oxy_headings_color'] !='') { ?>
		color: <?php echo $smof_color_data['oxy_headings_color']; ?>;
	<?php      
	}
	?>
}

/* Body text color*/
.ui-widget-content,
.prod-friend a,
body, 
.panel p,
table thead tr th, table thead tr td, table tfoot tr th, table tfoot tr td,
table tr th, table tr td, .woocommerce #content div.product .product-buy .product_custom_review_bottom span, blockquote, blockquote p, .woocommerce ul.products .name a, .cart-info thead td, .checkout-product thead td, table tbody tr td, .wishlist-info thead td, .sitemap-info ul li ul li, .sitemap-info ul li ul li a, .product-grid .name a, #content .box-product .name a, .product-list .name a, .product-info .wishlist-compare-friend a, .product-bottom-related .name a, .product-box-slider .name a, .product-right-sm-info span.p_title a, .box-category-home .subcat a, .product-compare a, .product-info .review > div a, .mini-cart-info .name small, .mini-cart-info td, .mini-cart-total td, .yith-wcwl-add-to-wishlist a, a.compare, #jckqv p { 
	<?php if($smof_color_data['oxy_body_text_color'] !='') { ?>
		color: <?php echo $smof_color_data['oxy_body_text_color']; ?>;
	<?php      
	}
	?>
}

/* Light text color*/
.heading h5, .product_box_brand span, .product_box_brand a, .product-description-l, .product-description-l span, .product-description-l a, ul.breadcrumbs li:before, .product-info .cart .minimum, .product-info .you-save, .product-right-sm-info span.p_subtitle, .breadcrumb, .woocommerce .woocommerce-breadcrumb, .woocommerce-page .woocommerce-breadcrumb, .widget_recent_entries > ul > li > span.post-date, .articleHeader, #jckqv .woocommerce-product-rating .text-rating { 
	<?php if($smof_color_data['oxy_light_text_color'] !='') { ?>
		color: <?php echo $smof_color_data['oxy_light_text_color']; ?>;
	<?php      
	}
	?>
}

/* Other links color*/
.accordion .ui-state-default, .accordion h3, .toggle-box h2.trigger,
.woocommerce .woocommerce-breadcrumb a, .woocommerce-page .woocommerce-breadcrumb a,
a, .box ul li, .product-info .save-percent, #product-top .product-description .product-description-l span.stock, .quote_bottom_content p.quote_author, .testimonial_slider .quote_icon i { 
	<?php if($smof_color_data['oxy_other_links_color'] !='') { ?>
		color: <?php echo $smof_color_data['oxy_other_links_color']; ?>;
	<?php      
	}
	?>
}
.ui-autocomplete.ui-widget-content.ui-widget li:hover,#menu ul.nav li div.large-6.columns.menu_contacts .mc:hover span.mm_icon, .product-info .cart .dec:hover, .product-info .cart .inc:hover, .contact-info .mc:hover span.mm_icon, #footer_a .mc:hover span.mm_icon, .es-nav span:hover, .product-related .bx-wrapper div.bx-next:hover, .product-related .bx-wrapper div.bx-prev:hover, #toTopHover, .product-right-sm-info span.p_icon, #livesearch_search_results li:hover, #livesearch_search_results .highlighted, #swipebox-action, .top-bar ul > li a:hover { 
	<?php if($smof_color_data['oxy_other_links_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_other_links_color']; ?>;
	<?php      
	}
	?>
}
.product-info .image-additional img:hover, .product-info .image-additional-left img:hover {
	<?php if($smof_color_data['oxy_other_links_color'] !='') { ?>
		border: 1px solid <?php echo $smof_color_data['oxy_other_links_color']; ?>;
	<?php      
	}
	?>
}


/* Links hover color*/
a:hover, .product-info .review > div a:hover, .sitemap-info ul li ul li:hover, .sitemap-info ul li ul li a:hover, .htabs a:hover, .product-grid .name a:hover, #content .box-product .name a:hover, .product-list .name a:hover, .product-info .wishlist-compare-friend a:hover, .product-bottom-related .name a:hover, .product-right-sm-info span.p_title a:hover, .box-category-home .subcat a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .woocommerce-page .woocommerce-breadcrumb a:hover { 
	<?php if($smof_color_data['oxy_links_hover_color'] !='') { ?>
		color: <?php echo $smof_color_data['oxy_links_hover_color']; ?>;
	<?php      
	}
	?>
}
.product-right-sm-info .product-right-sm-info-content:hover span.p_icon, .camera_wrap .camera_pag .camera_pag_ul li:hover > span, .flex-control-paging li a:hover, #swipebox-action:hover, .tp-bullets.simplebullets.round .bullet:hover{ 
	<?php if($smof_color_data['oxy_links_hover_color'] !='') { ?>
		background-color: <?php echo $smof_color_data['oxy_links_hover_color']; ?>;
	<?php      
	}
	?>
}

/********************************************GENERAL END************************************************/


/********************************************MAIN COLUMN************************************************/

/*Background color*/
.wrapper {
        <?php      

        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_mc_custom']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_mc_custom'])){
        ?>
            background-image: url('<?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_mc_custom'] ?>');
        <?php        
        }elseif(isset($smof_data->oxy_background_images_settings['oxy_pattern_oxy_mc']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_pattern_oxy_mc'])
                && $smof_data->oxy_background_images_settings['oxy_pattern_oxy_mc'] != '0'){    
            
           ?>
            background-image: url('<?php echo oxy_get_bg_pattern_by_id($smof_data->oxy_background_images_settings['oxy_pattern_oxy_mc']) ?>');
        <?php  
                }
        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_mc_position']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_mc_position'])){
        ?>
            background-position: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_mc_position'] ?>;
        <?php
        }
        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_mc_repeat']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_mc_repeat'])){
        ?>
            background-repeat: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_mc_repeat'] ?>;
        <?php
        }
        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_mc_attachment']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_mc_attachment'])){
        ?>
            background-attachment: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_mc_attachment'] ?>;
        <?php
        }
        ?>
        
	<?php if($smof_color_data['oxy_main_column_bg_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_main_column_status'] == 1) { ?>
		background-color: <?php echo $smof_color_data['oxy_main_column_bg_color']; ?>;
	<?php }?>
	<?php if($smof_color_data['oxy_main_column_border_color'] != '' && 
                $smof_data->oxy_color_style_settings['oxy_main_column_border_status'] == 1) { ?>
		border: <?php echo $smof_data->oxy_color_style_settings['oxy_main_column_border_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_main_column_border_style']?> <?php echo $smof_color_data['oxy_main_column_border_color']; ?>;
	<?php }?>
        <?php if( $smof_data->oxy_color_style_settings['oxy_main_column_shadow'] == 1) { ?>     
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        <?php }
        /*if($smof_data->oxy_general_settings['oxy_layout_style'] == 2 ){
        ?>
        margin:0;
        width: 100%;
        max-width: none;
        <?php }*/ ?>
}

<?php if($smof_data->oxy_general_settings['oxy_layout_s'] =='0') { ?>	
.wrapper {
    min-width: 940px;
}
.row {
    min-width: 920px;
}
<?php } ?>
<?php if($smof_data->oxy_general_settings['oxy_layout_style'] =='2') { ?>	
.wrapper {
	max-width: 100%;
	margin: 0;
	padding: 0 10px;
}
<?php } ?>


/******************************************** Top Area *****************************************************/

#header{
    <?php      

        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_ta_custom']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_ta_custom'])){
        ?>
            background-image: url('<?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_ta_custom'] ?>');
        <?php        
        }elseif(isset($smof_data->oxy_background_images_settings['oxy_pattern_oxy_ta']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_pattern_oxy_ta'])
                && $smof_data->oxy_background_images_settings['oxy_pattern_oxy_ta'] != '0'){    
           ?>
            background-image: url('<?php echo oxy_get_bg_pattern_by_id($smof_data->oxy_background_images_settings['oxy_pattern_oxy_ta']) ?>');
        <?php  
                }
        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_ta_position']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_ta_position'])){
        ?>
            background-position: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_ta_position'] ?>;
        <?php
        }
        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_ta_repeat']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_ta_repeat'])){
        ?>
            background-repeat: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_ta_repeat'] ?>;
        <?php
        }
        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_ta_attachment']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_ta_attachment'])){
        ?>
            background-attachment: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_ta_attachment'] ?>;
        <?php
        }        
        ?>
            
            

}



/********************************************Content Column************************************************/
/*Highlighted Items background color*/
#content .contact-sidebar .contact-widget-bg,
.product-filter, #content .content, .cart-info thead td, .checkout-heading, .checkout-product thead td, table.list thead td, .compare-info thead td, .compare-info thead tr td:first-child, .attribute thead td, .attribute thead tr td:first-child, .tab-content, .manufacturer-heading, .wishlist-info thead td, #header #cart .content, .reveal-modal, .custom_box, .success, .warning, .attention, #cboxContent, .panel, table thead, .woocommerce .woocommerce-message,.woocommerce .woocommerce-error,.woocommerce .woocommerce-info,.woocommerce-page .woocommerce-message,.woocommerce-page .woocommerce-error,.woocommerce-page .woocommerce-info, table tr.even, table tr.alt, table tr:nth-of-type(2n), #jckqv, #jckqv .product_meta, .accordion .ui-widget-content, .toggle-box .toggle_container {
	<?php if($smof_color_data['oxy_content_column_hli_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_content_column_hli_bg_color']; ?>;
	<?php }?>
}

/*Headings border bottom color*/
#content h1, #content .box-heading, .product-bottom-related h2, #blogCatArticles > div .articleContent {

	<?php if($smof_color_data['oxy_content_column_head_border_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_content_color_head_border_status'] == 1) { ?>
		border-bottom: <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_head_border_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_head_border_style']?> <?php echo $smof_color_data['oxy_content_column_head_border_color']; ?>;
	<?php }?>
}
#blogCatArticles > div:last-child .articleContent,
#blogCatArticles > div.large-4 .articleContent,
#blogCatArticles > div.large-6 .articleContent{
    border-bottom:none;
}
/*Separator color*/
.pagination, .product-info .price, .product-buy .product_custom_review, .product-buy .short-description, .product-buy .product_meta, .product-info .cart, .product-share, 
.product-right-sidebar, #jckqv .product_meta > span {
	<?php if($smof_color_data['oxy_content_column_separator_color'] != '') { ?>
		border-top: <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_style']?> <?php echo $smof_color_data['oxy_content_column_separator_color']; ?>;
	<?php }?>
}
.product-compare{
	<?php if($smof_color_data['oxy_content_column_separator_color'] != '') { ?>
		border-left: <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_style']?> <?php echo $smof_color_data['oxy_content_column_separator_color']; ?>;
	<?php }?>
}
.product-info .image, .product-info .image-additional img, .product-info .image-additional-left img, .contact-map, .manufacturer-list, .checkout-heading, .review-list, .product-info .option-image img{
	<?php if($smof_color_data['oxy_content_column_separator_color'] != '') { ?>
		border: <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_style']?> <?php echo $smof_color_data['oxy_content_column_separator_color']; ?>;
	<?php }?>
}
.cart-info table, .cart-total table, .checkout-product table, .wishlist-info table, .order-list .order-content, table.list, .attribute, .compare-info{
	<?php if($smof_color_data['oxy_content_column_separator_color'] != '') { ?>
		border-top: <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_style']?> <?php echo $smof_color_data['oxy_content_column_separator_color']; ?>;
	<?php }?>
}
.cart-info thead td, .cart-info tbody td, .cart-total table, .checkout-product thead td, .checkout-product tbody td, .checkout-product tfoot td, .wishlist-info thead td, .wishlist-info tbody td, .order-list .order-content, table.list td, .box-category-home .subcat li, .attribute td, .compare-info td, .mini-cart-info td, .mini-cart-total {
	<?php if($smof_color_data['oxy_content_column_separator_color'] != '') { ?>
		border-bottom: <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_style']?> <?php echo $smof_color_data['oxy_content_column_separator_color']; ?>;
	<?php }?>
}
.cart-info table, .checkout-product table, .wishlist-info table, table.list, .attribute, .compare-info{
	<?php if($smof_color_data['oxy_content_column_separator_color'] != '') { ?>
		border-left: <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_style']?> <?php echo $smof_color_data['oxy_content_column_separator_color']; ?>;
	<?php }?>
}
.cart-info table, .checkout-product table, .wishlist-info table, table.list td, .attribute td, .compare-info td {
	<?php if($smof_color_data['oxy_content_column_separator_color'] != '') { ?>
		border-right: <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_content_column_separator_style']?> <?php echo $smof_color_data['oxy_content_column_separator_color']; ?>;
	<?php }?>
}

.woocommerce .cart-collaterals .cross-sells > ul > li.columns:hover, .woocommerce-page .cart-collaterals .cross-sells > ul > li.columns:hover, .product-grid ul > li:hover, .woocommerce ul.products > li:hover {
    <?php if($smof_data->oxy_color_style_settings['oxy_mid_prod_box_shadow_hover'] == 1){?>
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
    <?php }?>
}

/********************************************Content Column end************************************************/

/********************************************Left Column Heading************************************************/

/*Heading background color*/
#column-left .box .box-heading, #column-left .product-box-slider .box-heading {
	
        <?php         
        if($smof_color_data['oxy_left_column_head_bg_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_left_column_head_status'] == 1) { ?>
		background-color: <?php echo $smof_color_data['oxy_left_column_head_bg_color']; ?>;
	<?php }
        if($smof_data->oxy_color_style_settings['oxy_left_column_head_custom'] != ''){
        ?>
                background-image: url(<?php echo $smof_data->oxy_color_style_settings['oxy_left_column_head_custom']?>);
        <?php } ?>
}

/*Title color*/
#column-left .box .box-heading, #column-left .product-box-slider .box-heading {
	<?php if($smof_color_data['oxy_left_column_head_title_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_left_column_head_title_color']; ?>;
	<?php }?>
}

/*Border bottom color*/
#column-left .box .box-heading, #column-left .product-box-slider .box-heading {
	<?php if($smof_color_data['oxy_left_column_head_border_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_left_column_head_border_status'] == 1) { ?>
		border-bottom: <?php echo $smof_data->oxy_color_style_settings['oxy_left_column_head_border_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_left_column_head_border_style']?> <?php echo $smof_color_data['oxy_left_column_head_border_color']; ?>;
	<?php }?>
}

/********************************************Left Column Heading end************************************************/

/********************************************Left Column Box****************************************************/

/*Box background color*/
#column-left .box .box-content, 
#column-left .box, 
#column-left .product-box-slider .box-content {
	<?php if($smof_color_data['oxy_left_column_box_bg_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_left_column_box_status'] == 1) { ?>
		background-color: <?php echo $smof_color_data['oxy_left_column_box_bg_color']; ?>;
	<?php }?>
}

/*Links color*/
.woocommerce ul.product_list_widget li > a, 
#column-left .box a,
#column-left .box ul li a,
#column-left .box-product a, #column-left .box .box-content ul li a, #column-left .product-box-slider .name a {
	<?php if($smof_color_data['oxy_left_column_box_links_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_left_column_box_links_color']; ?>;
	<?php }?>
                
}

/*Links color hover*/
.woocommerce ul.product_list_widget li > a:hover,
#column-left .box a:hover, 
#column-left .box ul li a:hover, 
#column-left .box-product a:hover, 
#column-left .box .box-content ul li a:hover, #column-left .product-box-slider .name a:hover {
	<?php if($smof_color_data['oxy_left_column_box_links_color_hover'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_left_column_box_links_color_hover']; ?>;
	<?php }?>
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {
	<?php if($smof_color_data['oxy_left_column_box_links_color_hover'] != '') { ?>
		background: <?php echo $smof_color_data['oxy_left_column_box_links_color_hover']; ?>;
	<?php }?>
}

/********************************************Left Column Box end************************************************/

/********************************************Right Column Heading************************************************/

/*Heading background color*/
#column-right .box .box-heading, #column-right .product-box-slider .box-heading {
	<?php if($smof_color_data['oxy_right_column_head_bg_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_right_column_head_status'] == 1) { ?>
		background-color: <?php echo $smof_color_data['oxy_right_column_head_bg_color']; ?>;
	<?php }?>
        <?php if($smof_data->oxy_color_style_settings['oxy_right_column_head_custom'] != ''){?>
                background-image: url(<?php echo $smof_data->oxy_color_style_settings['oxy_right_column_head_custom']?>);
        <?php }?>
}

/*Title color*/
#column-right .box .box-heading, #column-right .product-box-slider .box-heading {
	<?php if($smof_color_data['oxy_right_column_head_title_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_right_column_head_title_color']; ?>;
	<?php }?>
}


/*Border bottom color*/
#column-right .box .box-heading, #column-right .product-box-slider .box-heading{
	<?php if($smof_color_data['oxy_right_column_head_border_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_right_color_head_border_status'] == 1) { ?>
		border-bottom: <?php echo $smof_data->oxy_color_style_settings['oxy_right_color_head_border_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_right_color_head_border_style']?> <?php echo $smof_color_data['oxy_right_column_head_border_color']; ?>;
	<?php }?>
}

/********************************************Right Column Heading end************************************************/

/********************************************Right Column Box************************************************/

/*Box background color*/
#column-right .box,
#column-right .box .box-content, #column-right .product-box-slider .box-content {
	<?php if($smof_color_data['oxy_right_column_box_bg_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_right_column_box_status'] == 1) { ?>
		background-color: <?php echo $smof_color_data['oxy_right_column_box_bg_color']; ?>;
	<?php }?>
}

/*Links color*/
#column-right .box a,
#column-right .box ul li a,
#column-right .box-product a, #column-right .box .box-content ul li a, #column-right .product-box-slider .name a {
	<?php if($smof_color_data['oxy_right_column_box_links_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_right_column_box_links_color']; ?>;
	<?php }?>
}

/*Links color hover*/
#column-right .box a:hover, 
#column-right .box ul li a:hover, 
#column-right .box-product a:hover, 
#column-right .box .box-content ul li a:hover, #column-right .product-box-slider .name a:hover {
	<?php if($smof_color_data['oxy_right_column_box_links_color_hover'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_right_column_box_links_color_hover']; ?>;
	<?php }?>
}

/********************************************Right Column Box end************************************************/

/********************************************Category Box Heading************************************************/


#column-left .box.widget_product_categories .box-heading,
#column-right .box.widget_product_categories .box-heading
 {
	<?php if($smof_color_data['oxy_category_box_head_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_category_box_head_bg_color']; ?>;
	<?php }?>
        <?php if($smof_color_data['oxy_category_box_head_title_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_category_box_head_title_color']; ?>;
	<?php }?>
        <?php if($smof_color_data['oxy_category_box_head_border_color'] != '') { ?>
		border-bottom: 1px solid <?php echo $smof_color_data['oxy_category_box_head_border_color']; ?>;
	<?php }?>
}


/********************************************Category Box Heading end************************************************/

/********************************************Category Box Content************************************************/

/*Box background color*/
ul.product-categories, ul.product-categories ul,.box-category .box-content-category{
	<?php if($smof_color_data['oxy_category_box_box_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_category_box_box_bg_color']; ?>;
	<?php }?>
}

/*Box background color hover*/
ul.product-categories li:hover,.box-category .box-content-category ul > li > a:hover, .woocommerce-page .widget_layered_nav ul li:hover {
	<?php if($smof_color_data['oxy_category_box_box_bg_color_hover'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_category_box_box_bg_color_hover']; ?>;
	<?php }?>
}

/*Links color*/
#column-left .box.widget_product_categories ul li a,
#column-right .box.widget_product_categories ul li a,
.box ul li span,
ul.product-categories li a, ul.product-categories li .count,
.box-category .box-content-category ul > li > a {
	<?php if($smof_color_data['oxy_category_box_box_links_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_category_box_box_links_color']; ?>;
	<?php }?>
}

/*Links color hover*/
#column-left .box.widget_product_categories ul li a:hover,
#column-right .box.widget_product_categories ul li a:hover,
ul.product-categories li a:hover,
.box-category .box-content-category ul > li > a:hover,
.woocommerce-page .widget_layered_nav ul li:hover a {
	<?php if($smof_color_data['oxy_category_box_box_links_color_hover'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_category_box_box_links_color_hover']; ?>;
	<?php }?>
}

/*Separator color*/
.widget_meta ul > li+li,
.widget_archive ul > li+li,
.widget_recent_comments ul > li+li,
ul.product-categories li + li, ul.product-categories ul, .box-category .box-content-category ul > li ul, .woocommerce-page .widget_layered_nav ul li, .blog .widget_recent_entries ul > li + li, .widget_recent_entries ul > li + li, .blog .widget_categories ul > li + li, .widget_categories ul > li + li, .widget_pages ul > li + li  {
	<?php if($smof_color_data['oxy_category_box_box_separator_color'] != '') { ?>
		border-top: 1px solid <?php echo $smof_color_data['oxy_category_box_box_separator_color']; ?>;
	<?php }?>
}

/********************************************Category Box Content end************************************************/

/********************************************Filter Box Heading************************************************/
<?php 
/* 	

.box-filter .box-heading {
	<?php if($smof_color_data['oxy_filter_box_head_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_filter_box_head_bg_color']; ?>;
	<?php }?>
}


.box-filter .box-heading {
	<?php if($smof_color_data['oxy_filter_box_head_title_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_filter_box_head_title_color']; ?>;
	<?php }?>
}


.box-filter .box-heading {
	<?php if($smof_color_data['oxy_filter_box_head_border_color'] != '') { ?>
		border-bottom: 1px solid <?php echo $smof_color_data['oxy_filter_box_head_border_color']; ?>;
	<?php }?>
}	
*/?>
/********************************************Filter Box Heading end************************************************/

/********************************************Filter Box Content************************************************/
<?php /*

.box-filter .box-content {
	<?php if($smof_color_data['oxy_filter_box_box_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_filter_box_box_bg_color']; ?>;
	<?php }?>
}


.box-filter .box-content span, .box-filter label{
	<?php if($smof_color_data['oxy_filter_box_box_links_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_filter_box_box_links_color']; ?>;
	<?php }?>
}


.box-filter label:hover {
	<?php if($smof_color_data['oxy_filter_box_box_links_color_hover'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_filter_box_box_links_color_hover']; ?>;
	<?php }?>
}	
*/?>
/********************************************Filter Box Content end************************************************/

/********************************************General end************************************************/

/********************************************Prices************************************************/

/*Price color*/
.woocommerce div.product .product-buy p.price, .woocommerce #content div.product .product-buy p.price, .woocommerce-page div.product .product-buy p.price, .woocommerce #content div.product .single_variation_wrap span.price,
.woocommerce ul.product_list_widget li .amount, .price, .total, .product-info .price .discount {
	<?php if($smof_color_data['oxy_price_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_price_color']; ?>;
	<?php }?>
}

/*Old price color*/
.woocommerce div.product .product-buy p.price del, .woocommerce #content div.product .product-buy p.price del, .woocommerce-page div.product .product-buy p.price del,
.woocommerce #content div.product p.price del, .woocommerce #content div.product span.price del, .woocommerce div.product p.price del, .woocommerce div.product span.price del, .woocommerce-page #content div.product p.price del, .woocommerce-page #content div.product span.price del, .woocommerce-page div.product p.price del, .woocommerce-page div.product span.price del,
.woocommerce ul.product_list_widget li del, .woocommerce ul.product_list_widget li del .amount,
.tax-brands .price del, .woocommerce .price del, .woocommerce-page .price del,
.price-old, .wishlist-info tbody .price s, #jckqv .price del {
	<?php if($smof_color_data['oxy_price_old_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_price_old_color']; ?>;
	<?php }?>
                text-decoration: line-through;
}

/*New price color*/
.woocommerce ul.product_list_widget li ins, .woocommerce ul.product_list_widget li ins .amount,
.tax-brands .price ins, .woocommerce .price ins, .woocommerce-page .price ins,
.price-new, .cart-total .total-r, #jckqv .price, #jckqv .price ins {
	<?php if($smof_color_data['oxy_price_new_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_price_new_color']; ?>;
	<?php }?>
}

/*Tax price color*/
.price-tax, .product-info .price .reward {
	<?php if($smof_color_data['oxy_price_tax_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_price_tax_color']; ?>;
	<?php }?>
}
/********************************************Prices end************************************************/

/********************************************Buttons**************************************************************/

/*Background color*/
.articleContent input[type=submit],
.woocommerce #review_form #respond .form-submit input#submit,
#articleComments p.form-submit input,
a.button, input.button, .ei-title h4 a.button, #jckqv .button, .image .jckqvBtn {
	<?php if($smof_color_data['oxy_button_bg_color'] != '') { ?>
	background-color: <?php echo $smof_color_data['oxy_button_bg_color']; ?>;
	<?php }?>
        border-radius:<?php echo $smof_data->oxy_color_style_settings['oxy_button_border_radius']?>px;
        <?php if($smof_color_data['oxy_button_text_color'] != '') { ?>
        color: <?php echo $smof_color_data['oxy_button_text_color']; ?>;
	<?php }?>
}

/*Background color hover*/
.articleContent input[type=submit]:hover,
.woocommerce #review_form #respond .form-submit input#submit:hover,
#articleComments p.form-submit input:hover,
a.button:hover, input.button:hover, .ei-title h4 a.button:hover, #jckqv .button:hover, .image .jckqvBtn:hover {
	<?php if($smof_color_data['oxy_button_bg_hover_color'] != '') { ?>
        background-color: <?php echo $smof_color_data['oxy_button_bg_hover_color']; ?>;
	<?php }?>
        <?php if($smof_color_data['oxy_button_text_hover_color'] != '') { ?>
        color: <?php echo $smof_color_data['oxy_button_text_hover_color']; ?>;
	<?php }?>
}

/********************************************Buttons end**********************************************************/

/********************************************Exclusive Buttons**************************************************************/

/*Background color*/

.woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button,
a.button-exclusive, input.button-exclusive {
	<?php if($smof_color_data['oxy_button_exclusive_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_button_exclusive_bg_color']; ?>;
	<?php }?>
        <?php if($smof_color_data['oxy_button_exclusive_text_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_button_exclusive_text_color']; ?>;
	<?php }?>
}

/*Background color hover*/
.woocommerce div.product form.cart .button:hover, .woocommerce #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover,
a.button-exclusive:hover, input.button-exclusive:hover {
	<?php if($smof_color_data['oxy_button_exclusive_bg_hover_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_button_exclusive_bg_hover_color']; ?>;
	<?php }?>
        <?php if($smof_color_data['oxy_button_exclusive_text_hover_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_button_exclusive_text_hover_color']; ?>;
	<?php }?>
}

/********************************************Exclusive Buttons end**************************************************************/

/********************************************Light Buttons***************************************************************/

/*Background color*/
.button,
.widget_product_tag_cloud .tagcloud a,
#column-right .box.widget_product_tag_cloud .tagcloud a,
#column-left .box.widget_product_tag_cloud .tagcloud a,
.tax-brands a.button,.tax-brands input.button,.woocommerce-page a.button,.woocommerce a.button,.woocommerce-page input.button,.woocommerce input.button,.woocommerce-page #content input.button,.woocommerce #content input.button,
.product-grid .cart input.button, .product-list .cart input.button, #content .box-product .cart input.button, .product-right-sm-tags div a, .product-box-slider .cart input.button, .product-bottom-related .cart input.button, #header #cart .checkout .mini-cart-button {
	<?php if($smof_color_data['oxy_button_light_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_button_light_bg_color']; ?>;
	<?php }?>
        <?php if($smof_color_data['oxy_button_light_text_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_button_light_text_color']; ?>;
	<?php }?>
}

/*Background color hover*/
.button:hover,
.widget_product_tag_cloud .tagcloud a:hover,
#column-right .box.widget_product_tag_cloud .tagcloud a:hover,
#column-left .box.widget_product_tag_cloud .tagcloud a:hover,
.tax-brands a.button:hover,.tax-brands input.button:hover,.woocommerce-page a.button:hover,.woocommerce a.button:hover,.woocommerce-page input.button:hover,.woocommerce input.button:hover,.woocommerce-page #content input.button:hover,.woocommerce #content input.button:hover,
.product-grid .cart input.button:hover, .product-list .cart input.button:hover, #content .box-product .cart input.button:hover, .product-right-sm-tags div a:hover, .product-box-slider .cart input.button:hover, .product-bottom-related .cart input.button:hover, #header #cart .checkout .mini-cart-button:hover, .woocommerce #content .quantity .plus:hover, .woocommerce-page #content .quantity .plus:hover, .woocommerce #content .quantity .minus:hover, .woocommerce-page #content .quantity .minus:hover {
	<?php if($smof_color_data['oxy_button_light_bg_hover_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_button_light_bg_hover_color']; ?>;
	<?php }?>
        <?php if($smof_color_data['oxy_button_light_text_hover_color'] != '') { ?>
		color: <?php echo $smof_color_data['oxy_button_light_text_hover_color']; ?>;
	<?php }?>
}

/*Text color*/
.product-grid .cart input.button, .product-list .cart input.button, #content .box-product .cart input.button, .product-right-sm-tags div a, .product-box-slider .cart input.button, .product-bottom-related .cart input.button, #header #cart .checkout .mini-cart-button {
	
}

/*Text color hover*/
.product-grid .cart input.button:hover, .product-list .cart input.button:hover, #content .box-product .cart input.button:hover, .product-right-sm-tags div a:hover, .product-box-slider .cart input.button:hover, .product-bottom-related .cart input.button:hover, #header #cart .checkout .mini-cart-button:hover {
	
}

/********************************************Light Buttons end***************************************************************/

/********************************************Slider Buttons***********************************************************/

/*Background color*/
.prev-next a, .product-bottom-related .flex-direction-nav a, .product-bottom-related .flex-direction-nav .flex-disabled:hover, .product-right-sm-related .flex-direction-nav a, .product-right-sm-related .flex-direction-nav .flex-disabled:hover, .product-box-slider .flex-direction-nav a, .product-box-slider .flex-direction-nav .flex-disabled:hover, .pagination .links a, .flex-direction-nav a, .flex-control-paging li a, .camera_prevThumbs, .camera_nextThumbs, .camera_prev, .camera_next, .camera_commands, .camera_thumbs_cont, .camera_wrap .camera_pag .camera_pag_ul li, .slideshow .nivo-directionNav a, .tp-bullets.simplebullets.round .bullet, .tp-leftarrow.default, .tp-rightarrow.default {
	<?php if($smof_color_data['oxy_button_slider_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_button_slider_bg_color']; ?>;
	<?php }?>
}

/*Background color hover*/
v-next a:hover, .product-right-sm-related .flex-direction-nav a:hover, .product-bottom-related .flex-direction-nav a:hover, .product-box-slider .flex-direction-nav a:hover, .pagination .links b, .pagination .links a:hover, .flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover, .camera_prevThumbs:hover, .camera_nextThumbs:hover, .camera_prev:hover, .camera_next:hover, .camera_commands:hover, .camera_thumbs_cont:hover, .camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span, .flex-control-paging li a.flex-active, .slideshow .nivo-directionNav a:hover, .tp-bullets.simplebullets .bullet.selected, .tp-leftarrow:hover, .tp-rightarrow:hover{
	<?php if($smof_color_data['oxy_button_slider_bg_hover_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_button_slider_bg_hover_color']; ?>;
	<?php }?>
}

/********************************************Slider Buttons end***********************************************************/

/********************************************Header***********************************************************/

/*Background color*/
#header {

	<?php if($smof_data->oxy_color_style_settings['oxy_top_area_status'] == 1 
                and $smof_color_data['oxy_top_area_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_top_area_bg_color']; ?>;
	<?php }?>
}

/*Fixed Header (Mini Header) background color*/
.is-sticky #header {
	<?php if($smof_color_data['oxy_top_area_mini_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_top_area_mini_bg_color']; ?>;
	<?php }?>
}

/********************************************Header end***********************************************************/

/********************************************Top Bar***********************************************************/

/*Background color*/
#top-line {
	<?php if($smof_data->oxy_color_style_settings['oxy_top_area_tb_bg_status'] == '1' 
                and $smof_color_data['oxy_top_area_tb_bg_color'] != '') { ?>
		background-color: <?php echo $smof_color_data['oxy_top_area_tb_bg_color']; ?>;
	<?php }?>
}

/*Border top color*/
#top-line {
	<?php if($smof_data->oxy_color_style_settings['oxy_top_area_tb_top_bor_status'] == '1' 
                and $smof_color_data['oxy_top_area_tb_top_border_color'] != '') { ?>
		 border-top: 4px solid  <?php echo $smof_color_data['oxy_top_area_tb_top_border_color']; ?>;
	<?php }?>
}

/*Border bottom color*/
#top-line {
	<?php if($smof_data->oxy_color_style_settings['oxy_top_area_tb_bot_bor_status'] == '1' 
                and $smof_color_data['oxy_top_area_tb_bottom_border_color'] != '') { ?>
		 border-bottom: 1px solid <?php echo $smof_color_data['oxy_top_area_tb_bottom_border_color']; ?>;
	<?php }?>
}

/*Text color*/
#top-line {
	<?php if($smof_color_data['oxy_top_area_tb_text_color'] != '') { ?>
            color: <?php echo $smof_color_data['oxy_top_area_tb_text_color']; ?>;
	<?php }?>        
}

#top-line a{
	<?php if($smof_color_data['oxy_top_area_tb_link_color'] != '') { ?>
            color: <?php echo $smof_color_data['oxy_top_area_tb_link_color']; ?>;
	<?php }?>        
}

/*Link color hover*/
#top-line a:hover{
	<?php if($smof_color_data['oxy_top_area_tb_link_color_hover'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_top_area_tb_link_color_hover']; ?>;
	<?php }?>
}



/*Separator color*/
#welcome {
	<?php if($smof_color_data['oxy_top_area_tb_separator_color'] != '') { ?>
		 border-left: 1px solid <?php echo $smof_color_data['oxy_top_area_tb_separator_color']; ?>;
         border-right: 1px solid <?php echo $smof_color_data['oxy_top_area_tb_separator_color']; ?>;
	<?php }?>
}
#top-account, #top-wishlist, #top-cart, #top-checkout, .my-account, #top-menu ul li a {
	<?php if($smof_color_data['oxy_top_area_tb_separator_color'] != '') { ?>
         border-right: 1px solid <?php echo $smof_color_data['oxy_top_area_tb_separator_color']; ?>;
	<?php }?>
}

/*Dropdowns background color*/
#top-line .dropdown_l ul{
	<?php if($smof_color_data['oxy_top_area_tb_dropdown_bg_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_top_area_tb_dropdown_bg_color']; ?>;
	<?php }?>
}

/*Dropdowns background color hover*/
#top-line .dropdown_l li a:hover{
	<?php if($smof_color_data['oxy_top_area_tb_dropdown_bg_color_hover'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_top_area_tb_dropdown_bg_color_hover']; ?>;
	<?php }?>
}

/*Dropdowns link color*/
#top-line .dropdown_l li a{
	<?php if($smof_color_data['oxy_top_area_tb_dropdown_link_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_top_area_tb_dropdown_link_color']; ?>;
	<?php }?>
}

/*Dropdowns link color hover*/
#top-line .dropdown_l li a:hover{
	<?php if($smof_color_data['oxy_top_area_tb_dropdown_link_color_hover'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_top_area_tb_dropdown_link_color_hover']; ?>;
	<?php }?>
}

/********************************************Top Bar End***********************************************************/

/********************************************Search Bar***********************************************************/
#header #search input {
	<?php if($smof_color_data['oxy_top_area_search_bg_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_top_area_search_bg_color']; ?>;
	<?php }?>
	<?php if($smof_color_data['oxy_top_area_search_border_color'] != '') { ?>
		 border-color: <?php echo $smof_color_data['oxy_top_area_search_border_color']; ?>;
	<?php }?>
		<?php if($smof_color_data['oxy_top_area_search_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_top_area_search_text_color']; ?>;
	<?php }?>
}
#header #search input:focus {
	<?php if($smof_color_data['oxy_top_area_search_border_color_hover'] != '') { ?>
		 border-color: <?php echo $smof_color_data['oxy_top_area_search_border_color_hover']; ?>;
	<?php }?>
}
/********************************************Search Bar End***********************************************************/

/********************************************Cart Section***********************************************************/

#header #cart h5 {
	<?php if($smof_color_data['oxy_top_area_cart_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_top_area_cart_text_color']; ?>;
	<?php }?>
}

#header #cart .heading a div#cart-total {
	<?php if($smof_color_data['oxy_top_area_cart_link_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_top_area_cart_link_color']; ?>;
	<?php }?>
}

#header #cart .heading a div#cart-total:hover {
	<?php if($smof_color_data['oxy_top_area_cart_link_color_hover'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_top_area_cart_link_color_hover']; ?>;
	<?php }?>
}

#header #cart .heading a div#cart-total {
	<?php if($smof_color_data['oxy_top_area_cart_separator_color'] != '') { ?>
		 border-right: 1px solid <?php echo $smof_color_data['oxy_top_area_cart_separator_color']; ?>;
	<?php }?>
}

#header #cart .heading a div#cart-icon{
    background: url("../image/icon_cart_<?php echo $smof_data->oxy_color_style_settings['oxy_top_area_cart_icon_style']?>.png") no-repeat scroll 65% 50% rgba(0, 0, 0, 0);
}

/********************************************Cart Section End***********************************************************/

/********************************************Main menu***********************************************************/

#header div.nav, #menu, #mobile-menu {
        <?php      

        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_mm_custom']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_mm_custom'])){
        ?>
            background-image: url('<?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_mm_custom'] ?>');
        <?php        
        }elseif(isset($smof_data->oxy_background_images_settings['oxy_pattern_oxy_mm']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_pattern_oxy_mm'])
                && $smof_data->oxy_background_images_settings['oxy_pattern_oxy_mm'] != '0'){    
        ?>
            background-image: url('<?php echo oxy_get_bg_pattern_by_id($smof_data->oxy_background_images_settings['oxy_pattern_oxy_mm']) ?>');
        <?php  
        }        
        if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_mm_repeat']) 
                && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_mm_repeat'])){
        ?>
            background-repeat: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_mm_repeat'] ?>;
        <?php
        }
        ?>
	<?php if($smof_color_data['oxy_mm_bg_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_mm_bg_color_status'] == 1) { ?>
		 background-color: <?php echo $smof_color_data['oxy_mm_bg_color']; ?>;
	<?php }?>
}

#header div.nav ul > li,#menu ul.nav > li, #menu_oc > ul > li, #menu_v > ul > li, #menu_h > ul > li, #menu_brands > ul > li, .menu_links, #menu_custom_menu > ul > li, .menu_custom_block > ul > li, #menu_informations > ul > li, #menu_contacts > ul > li {
        
	<?php if($smof_color_data['oxy_mm_separator_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_mm_separator_status'] == 1) { ?>
		 border-left: <?php echo $smof_data->oxy_color_style_settings['oxy_mm_separator_size'] ?>px <?php echo $smof_data->oxy_color_style_settings['oxy_mm_separator_style'] ?> <?php echo $smof_color_data['oxy_mm_separator_color']; ?>;
	<?php }?>
}

#header div.nav,#menu, #mobile-menu {
	<?php if($smof_color_data['oxy_mm_border_top_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_mm_border_top_status'] == 1) { ?>
		 border-top: <?php echo $smof_data->oxy_color_style_settings['oxy_mm_border_top_size'] ?>px <?php echo $smof_data->oxy_color_style_settings['oxy_mm_border_top_style'] ?> <?php echo $smof_color_data['oxy_mm_border_top_color']; ?>;
	<?php }?>

	<?php if($smof_color_data['oxy_mm_border_bottom_color'] != '' 
                && $smof_data->oxy_color_style_settings['oxy_mm_border_bottom_status'] == 1) { ?>
		 border-bottom: <?php echo $smof_data->oxy_color_style_settings['oxy_mm_border_bottom_size'] ?>px <?php echo $smof_data->oxy_color_style_settings['oxy_mm_border_bottom_style'] ?> <?php echo $smof_color_data['oxy_mm_border_bottom_color']; ?>;
	<?php }?>
}

/********************************************Menu item Link***********************************************************/

#header div.nav ul > li,#menu ul.nav > li {
	<?php if($smof_color_data['oxy_mm1_bg_color'] != ''
                && $smof_data->oxy_color_style_settings['oxy_mm1_bg_color_status'] == 1) { ?>
		 background-color: <?php echo $smof_color_data['oxy_mm1_bg_color']; ?>;
	<?php }else{?>
                background-color: transparent; 
        <?php } ?>
}

#header div.nav ul > li:hover, #menu ul.nav > li:hover, #header div.nav ul > li.current-menu-item, #menu ul.nav > li.current-menu-item {
	<?php if($smof_color_data['oxy_mm1_bg_hover_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mm1_bg_hover_color']; ?>;
	<?php }?>
}



#mobile-menu ul.nav li a,
#header div.nav ul > li > a, #menu ul.nav > li > a{
	<?php if($smof_color_data['oxy_mm1_link_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm1_link_color']; ?>;
	<?php }?>
}
#mobile-menu ul.nav li a:hover,
#header div.nav ul > li:hover > a, #menu ul.nav > li:hover > a, #header div.nav ul > li.current-menu-item > a, #menu ul.nav > li.current-menu-item > a {
	<?php if($smof_color_data['oxy_mm1_link_hover_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm1_link_hover_color']; ?>;
	<?php }?>
}

#mobile-menu .mobile_menu_trigger{
    <?php if($smof_color_data['oxy_mm_mobile_bg_color'] != '') { ?>
            background-color: <?php echo $smof_color_data['oxy_mm_mobile_bg_color']; ?>;
   <?php }?>
    <?php if($smof_color_data['oxy_mm_mobile_text_color'] != '') { ?>
            color: <?php echo $smof_color_data['oxy_mm_mobile_text_color']; ?>;
   <?php }?>
}

#mobile-menu ul.nav li a:hover,
#mobile-menu .mobile_menu_trigger:hover{
    <?php if($smof_color_data['oxy_mm_mobile_bg_hover_color'] != '') { ?>
            background-color: <?php echo $smof_color_data['oxy_mm_mobile_bg_hover_color']; ?>;
   <?php }?>
}

/********************************************Contact Section***********************************************************/


#menu ul.nav li div.large-6.columns.menu_contacts ul li .mc span.mm {
	
        <?php if($smof_color_data['oxy_mm_sub_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm_sub_text_color']; ?>;
	<?php }?>
                 
}
#content .contact-sidebar .mc:hover span.mm_icon,
#menu ul.nav li div.large-6.columns.menu_contacts ul li .mc:hover span.mm_icon, #menu_contacts > ul > li:hover {
	<?php if($smof_color_data['oxy_other_links_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_other_links_color']; ?>;
	<?php }?>
        <?php /*if($smof_color_data['oxy_mm7_link_hover_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm7_link_hover_color']; ?>;
	<?php }*/?>
}

#menu ul.nav li div.large-6.columns.menu_contacts ul li .mc span.mm_icon,#menu_contacts > ul > li > a {
	
}

#menu ul.nav li div.large-6.columns.menu_contacts ul li .mc:hover span.mm_icon,#menu_contacts > ul > li:hover > a {
	
}

/********************************************Contact Section end***********************************************************/

/********************************************Sub-Menu***********************************************************/
#menu ul.nav li > ul.sub-menu,#menu ul.nav > li div.large-10.columns, #menu ul.nav li div.large-6.columns.menu_contacts, #menu_oc > ul > li > div, #menu_oc > ul > li > div > ul > li > div, #menu_v > ul > li > div, #menu_v > ul > li > div > ul > li > div, #menu_v > ul > li > div > ul > li > div > ul > li > div, #menu_h > ul > li > div, #menu_brands > ul > li > div, #menu_custom_menu > ul > li > div, .menu_custom_block > ul > li > div, #menu_informations > ul > li > div, #menu_contacts > ul > li > div {
    <?php if($smof_color_data['oxy_mm_sub_bg_color'] != '') { ?>
    background-color: <?php echo $smof_color_data['oxy_mm_sub_bg_color']; ?>;
    <?php } ?>
}
#menu ul.nav li > ul.sub-menu,#menu ul.nav > li div.large-10.columns, #menu ul.nav li div.large-6.columns.menu_contacts, #menu_oc > ul > li > div, #menu_oc > ul > li > div > ul > li > div, #menu_v > ul > li > div, #menu_v > ul > li > div > ul > li > div, #menu_v > ul > li > div > ul > li > div > ul > li > div, #menu_h > ul > li > div, #menu_brands > ul > li > div, #menu_custom_menu > ul > li > div, .menu_custom_block > ul > li > div, #menu_informations > ul > li > div, #menu_contacts > ul > li > div {
    <?php if($smof_data->oxy_color_style_settings['oxy_mm_sub_box_shadow'] == 1){?>                 
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    <?php }?>
}


#menu ul.nav > li div.large-10.columns ul li, #menu ul.nav li ul.sub-menu > li{
    border-bottom: 1px <?php echo $smof_data->oxy_color_style_settings['oxy_mm_sub_separator_style'] ?> <?php echo $smof_color_data['oxy_mm_sub_separator_color']; ?>;
}
#menu ul.nav li > ul.sub-menu a, #menu ul.nav > li div.large-10.columns a{
    font-size: 12px;
}


#menu ul.nav > li div.large-10.columns a:hover, #menu ul.nav li div.large-10.columns div.five-nb > span > a:hover, 
#menu ul.nav li > ul.sub-menu li a:hover ,#menu_oc > ul > li ul > li > a:hover, #menu_v > ul > li ul > li > a:hover, #menu_h > ul > li ul > li > a:hover, #menu_v > ul > li > div > ul > li ul > li > a:hover, #menu_h span a:hover, #menu_brands > ul > li > div > div:hover, #menu_custom_menu > ul > li ul > li > a:hover, #menu_informations > ul > li ul > li > a:hover, #menu ul.nav > li div.large-10.columns.brands-wall .name a:hover{
	<?php if($smof_color_data['oxy_mm_sub_bg_hover_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mm_sub_bg_hover_color']; ?>;
	<?php }?>
}



#menu ul.nav li > ul.sub-menu li a, #menu ul.nav > li div.large-10.columns a,#menu_oc > ul > li ul > li > a, #menu_v > ul > li ul > li > a, #menu_h span a, #menu_h > ul > li ul > li > a, #menu_brands > ul > li > div > div a, #menu_custom_menu > ul > li ul > li > a, .menu_custom_block > ul > li > div a, #menu_informations > ul > li ul > li > a{
	<?php if($smof_color_data['oxy_mm_sub_link_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm_sub_link_color']; ?>;
	<?php }?>
}

#menu ul.nav li > ul.sub-menu li a:hover, #menu ul.nav > li div.large-10.columns a:hover,#menu_oc > ul > li ul > li > a:hover, #menu_v > ul > li ul > li > a:hover, #menu_v > ul > li > div > ul > li ul > li > a:hover, #menu_h span a:hover, #menu_h > ul > li ul > li > a:hover, #menu_brands > ul > li > div > div:hover a, #menu_custom_menu > ul > li ul > li > a:hover, .menu_custom_block > ul > li > div a:hover, #menu_informations > ul > li ul > li > a:hover{
	<?php if($smof_color_data['oxy_mm_sub_link_hover_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm_sub_link_hover_color']; ?>;
	<?php }?>
}

#menu ul.nav li div.large-6.columns.menu_contacts ul li .ngw,#menu ul.nav li.oxymega > ul.sub-menu > li > a, #menu ul.nav li div.large-10.columns div.five-nb > span > a,#menu_h span a, #menu_informations span, #menu_contacts > ul > li > div > ul > li > .ngw, #menu_contacts > ul > li > div > ul > li > .social_widget {
	<?php if($smof_color_data['oxy_mm_sub_titles_bg_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mm_sub_titles_bg_color']; ?>;
	<?php }?>
}

#menu ul.nav li.oxymega > ul.sub-menu > li > a, #menu ul.nav li div.large-10.columns div.five-nb > span > a , #menu_informations span, .menu_custom_block h1, #menu_contacts > ul > li > div > ul > li > .ngw, #menu_contacts span.mm{
	<?php if($smof_color_data['oxy_mm_sub_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm_sub_text_color']; ?>;
	<?php }?>
}


#menu_h > ul > li ul > li ul > li:first-child{
	<?php if($smof_color_data['oxy_mm_sub_separator_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm_sub_separator_color']; ?>;
	<?php }?>
}

/********************************************Sub-Menu end***********************************************************/

/********************************************Main menu end***********************************************************/

/********************************************Mobile Main Menu Bar***********************************************************/

.top-bar ul > li.name a {
	<?php if($smof_color_data['oxy_mm_mobile_bg_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mm_mobile_bg_color']; ?>;
	<?php }?>
}
.top-bar:hover ul > li.name a {
	<?php if($smof_color_data['oxy_mm_mobile_bg_hover_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mm_mobile_bg_hover_color']; ?>;
	<?php }?>
}
.top-bar ul > li.name a {
	<?php if($smof_color_data['oxy_mm_mobile_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mm_mobile_text_color']; ?>;
	<?php }?>
}

/********************************************Mobile Main Menu Bar end***********************************************************/

/********************************************Midsection***************************************************************/
	
/********************************************Product Box***************************************************************/
.woocommerce .product-list ul.products > li:hover,
.woocommerce .cart-collaterals .cross-sells > ul > li.columns:hover, .woocommerce-page .cart-collaterals .cross-sells > ul > li.columns:hover, .product-grid ul > li:hover,  .woocommerce ul.products > li:hover,
.product-grid > div:hover, .product-list > div:hover, #content .box-product > div:hover{
	<?php if($smof_color_data['oxy_mid_prod_box_bg_hover_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mid_prod_box_bg_hover_color']; ?>;
	<?php }?>
}
<?php if($smof_data->oxy_general_settings['oxy_category_prod_zoom_status'] == 1){?>
#content .product-grid ul.products .image:hover a img{
    transform: scale(1.1);
}
<?php }?>

.tax-brands span.onsale, .woocommerce span.onsale, .woocommerce-page span.onsale, #jckqv .onsale {
    <?php if($smof_color_data['oxy_mid_prod_box_sale_icon_color'] != '') { ?>
             background-color: <?php echo $smof_color_data['oxy_mid_prod_box_sale_icon_color']; ?>;
    <?php }?>
}

.woocommerce .star-rating span:before, .woocommerce-page .star-rating span:before, #jckqv .woocommerce-product-rating .star-rating span:before {
    color:<?php echo $smof_color_data['oxy_mid_prod_stars_color']?>;
}
.product-buy .add_to_wishlist{
    background-image: url(<?php echo SWPF_THEME_URI.'/image/oxy-wishlist-'.$smof_data->oxy_color_style_settings['oxy_general_icons_style']?>.png);
}
.product-buy .prod-friend span.friend{
    background-image: url(<?php echo SWPF_THEME_URI.'/image/oxy-send-'.$smof_data->oxy_color_style_settings['oxy_general_icons_style']?>.png);
    background-repeat: no-repeat;
    background-position: left center;    
}
.product-buy .prod-compare a.compare span{
    background-image: url(<?php echo SWPF_THEME_URI.'/image/oxy-compare-'.$smof_data->oxy_color_style_settings['oxy_general_icons_style']?>.png);    
}
ul.products > li .wishlist{
    background-image: url(<?php echo SWPF_THEME_URI.'/image/oxy-wishlist-'.$smof_data->oxy_color_style_settings['oxy_general_icons_style']?>.png);
    background-position: center;
    background-repeat : no-repeat;
}
ul.products > li .compare{
    background-image: url(<?php echo SWPF_THEME_URI.'/image/oxy-compare-'.$smof_data->oxy_color_style_settings['oxy_general_icons_style']?>.png);
    background-position: center;
    background-repeat : no-repeat;
}


.pagination ul li .page-numbers,
.prev-next a, .product-bottom-related .flex-direction-nav a, .product-bottom-related .flex-direction-nav .flex-disabled:hover, .product-right-sm-related .flex-direction-nav a, .product-right-sm-related .flex-direction-nav .flex-disabled:hover, .product-box-slider .flex-direction-nav a, .product-box-slider .flex-direction-nav .flex-disabled:hover, .pagination .links a, .flex-direction-nav a, .flex-control-paging li a, .camera_prevThumbs, .camera_nextThumbs, .camera_prev, .camera_next, .camera_commands, .camera_thumbs_cont, .camera_wrap .camera_pag .camera_pag_ul li, .slideshow .nivo-directionNav a, .tp-bullets.simplebullets.round .bullet, .tp-leftarrow.default, .tp-rightarrow.default {
	background-color: <?php echo $smof_color_data['oxy_button_slider_bg_color']; ?>;
}
.pagination ul li .page-numbers.current, .pagination ul li .page-numbers:hover,
.prev-next a:hover, .product-right-sm-related .flex-direction-nav a:hover, .product-bottom-related .flex-direction-nav a:hover, .product-box-slider .flex-direction-nav a:hover, .carousel-flex .flex-direction-nav a:hover, .pagination .links b, .pagination .links a:hover, .flexslider:hover .flex-next:hover, .flexslider:hover .flex-prev:hover, .camera_prevThumbs:hover, .camera_nextThumbs:hover, .camera_prev:hover, .camera_next:hover, .camera_commands:hover, .camera_thumbs_cont:hover, .camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span, .flex-control-paging li a.flex-active, .slideshow .nivo-directionNav a:hover, .tp-bullets.simplebullets .bullet.selected, .tp-leftarrow:hover, .tp-rightarrow:hover {
	background-color: <?php echo $smof_color_data['oxy_button_slider_bg_hover_color']; ?>;
}


/********************************************Product Box end***************************************************************/

/********************************************Product Page - Tabs***************************************************************/
.woocommerce-tabs .tabs li a,.htabs a, .tabs dd > a, .accordion h3.ui-accordion-header.ui-state-default, .accordion h3.ui-accordion-header, .toggle-box h2.trigger{
	<?php if($smof_color_data['oxy_mid_prod_page_tabs_bg_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mid_prod_page_tabs_bg_color']; ?>;
	<?php }?>
        <?php if($smof_color_data['oxy_mid_prod_page_tabs_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mid_prod_page_tabs_text_color']; ?>;
	<?php }?>
}

.woocommerce-tabs .tabs li.active a,.htabs a.selected, .tabs dd.active > a, .tabs dd > a:hover, .accordion h3.ui-accordion-header-active.ui-state-default, .accordion h3.ui-accordion-header-active, .toggle-box h2.trigger.active{
	<?php if($smof_color_data['oxy_mid_prod_page_tabs_selected_bg_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mid_prod_page_tabs_selected_bg_color']; ?>;
	<?php }?>
}

/********************************************Product Page - Tabs end***************************************************************/

/********************************************Product Slider on Home Page***************************************************************/
.ei-slider {
	<?php if($smof_color_data['oxy_mid_prod_slider_bg_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_mid_prod_slider_bg_color']; ?>;
	<?php }?>
}

.ei-title h2 a {
	<?php if($smof_color_data['oxy_mid_prod_slider_name_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mid_prod_slider_name_color']; ?>;
	<?php }?>
}

.ei-title h3 a, .ei-title h4 a .price-old {
	<?php if($smof_color_data['oxy_mid_prod_slider_desc_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mid_prod_slider_desc_color']; ?>;
	<?php }?>
}

.ei-title h4 a {
	<?php if($smof_color_data['oxy_mid_prod_slider_price_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mid_prod_slider_price_color']; ?>;
	<?php }?>
}

.ei-title h2 a:hover, .ei-title h3 a:hover {
	<?php if($smof_color_data['oxy_mid_prod_slider_links_color_hover'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_mid_prod_slider_links_color_hover']; ?>;
	<?php }?>
}

.ei-slider-thumbs li a {
	<?php if($smof_color_data['oxy_mid_prod_slider_bottom_bar_bg_color'] != '') { ?>
		 background: <?php echo $smof_color_data['oxy_mid_prod_slider_bottom_bar_bg_color']; ?>;
	<?php }?>
}

.ei-slider-thumbs li a:hover {
	<?php if($smof_color_data['oxy_mid_prod_slider_bottom_bar_bg_color_hover'] != '') { ?>
		 background: <?php echo $smof_color_data['oxy_mid_prod_slider_bottom_bar_bg_color_hover']; ?>;
	<?php }?>
}

.ei-slider-thumbs li.ei-slider-element {
	<?php if($smof_color_data['oxy_mid_prod_slider_bottom_bar_bg_color_active'] != '') { ?>
		 background: <?php echo $smof_color_data['oxy_mid_prod_slider_bottom_bar_bg_color_active']; ?>;
	<?php }?>
}

/********************************************Product Slider on Home Page end***************************************************************/
	
/********************************************Midsection end********************************************************************************/

/********************************************Footer**************************************************************/
/********************************************Feature Block*****************************************************************/

#footer_p {
	<?php if($smof_color_data['oxy_fp_bg_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_fp_bg_color']; ?>;
	<?php }?>
}
#footer_p span.pi1{
    background-color: <?php echo $smof_color_data['oxy_fp_fb1_bg_color']?>;
}
#footer_p span.pi1:hover{
    background-color: <?php echo $smof_color_data['oxy_fp_fb1_bg_color_hover']?>;
}
#footer_p span.pi2{
    background-color: <?php echo $smof_color_data['oxy_fp_fb2_bg_color']?>;
}
#footer_p span.pi2:hover{
    background-color: <?php echo $smof_color_data['oxy_fp_fb2_bg_color_hover']?>;
}
#footer_p span.pi3{
    background-color: <?php echo $smof_color_data['oxy_fp_fb3_bg_color']?>;
}
#footer_p span.pi3:hover{
    background-color: <?php echo $smof_color_data['oxy_fp_fb3_bg_color_hover']?>;
}
#footer_p span.pi4{
    background-color: <?php echo $smof_color_data['oxy_fp_fb4_bg_color']?>;
}
#footer_p span.pi4:hover{
    background-color: <?php echo $smof_color_data['oxy_fp_fb4_bg_color_hover']?>;
}



#footer_p span.p_title a {
	<?php if($smof_color_data['oxy_fp_title_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_fp_title_color']; ?>;
	<?php }?>
}
#footer_p span.p_title a:hover {
	<?php if($smof_color_data['oxy_fp_title_color_hover'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_fp_title_color_hover']; ?>;
	<?php }?>
}
#footer_p span.p_subtitle {
	<?php if($smof_color_data['oxy_fp_subtitle_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_fp_subtitle_color']; ?>;
	<?php }?>
}

/********************************************Feature Block end***********************************************************/

/********************************************About Us, Custom Column, Follow Us, Contact Us*******************************************/

#footer_a {
<?php if($smof_color_data['oxy_f1_bg_color'] != '') { ?>
         background-color: <?php echo $smof_color_data['oxy_f1_bg_color']; ?>;
<?php
}
?>
<?php
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f1_custom']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f1_custom'])){
?>
    background-image: url('<?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f1_custom'] ?>');
<?php

}elseif(isset($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f1']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f1'])
        && $smof_data->oxy_background_images_settings['oxy_pattern_oxy_f1'] != '0'){    
    ?>
    background-image: url('<?php echo oxy_get_bg_pattern_by_id($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f1']) ?>');
<?php  
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f1_position']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f1_position'])){
?>
    background-position: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f1_position'] ?>;
<?php
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f1_repeat']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f1_repeat'])){
?>
    background-repeat: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f1_repeat'] ?>;
<?php
}
if($smof_data->oxy_color_style_settings['oxy_f1_border_top_status'] == 1){
?>
    border-top: <?php echo $smof_data->oxy_color_style_settings['oxy_f1_border_top_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_f1_border_top_style']?> <?php echo $smof_data->oxy_color_style_settings['oxy_f1_border_top_color']?>;
<?php
}
?>
    
}
#footer_a h3 {
	<?php if($smof_color_data['oxy_f1_titles_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f1_titles_color']; ?>;
		 border-bottom: <?php echo $smof_data->oxy_color_style_settings['oxy_f1_titles_border_bottom_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_f1_titles_border_bottom_style']?> <?php echo $smof_color_data['oxy_f1_titles_border_bottom_color']; ?>
	<?php }?>
}
#footer_a {
	<?php if($smof_color_data['oxy_f1_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f1_text_color']; ?>;
	<?php }?>
}
#footer_a a {
	<?php if($smof_color_data['oxy_f1_link_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f1_link_color']; ?>;
	<?php }?>
}
#footer_a a:hover {
	<?php if($smof_color_data['oxy_f1_link_hover_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f1_link_hover_color']; ?>;
	<?php }?>
}
#footer_a span.mm_icon, .social_widget ul li {
	<?php if($smof_color_data['oxy_f1_icon_color'] != '') { ?>
		 background-color: <?php echo $smof_color_data['oxy_f1_icon_color']; ?>;
	<?php }?>
}


/********************************************About Us, Custom Column, Follow Us, Contact Us end*******************************************/

/********************************************Information, Customer Service, Extras, My Account************************************************/

#footer_c {
<?php if($smof_color_data['oxy_f2_bg_color'] != '') { ?>
    background-color: <?php echo $smof_color_data['oxy_f2_bg_color']; ?>;
<?php }?>
<?php
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f2_custom']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f2_custom'])){
?>
    background-image: url('<?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f2_custom'] ?>');
<?php

}elseif(isset($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f2']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f2'])
        && $smof_data->oxy_background_images_settings['oxy_pattern_oxy_f2'] != '0'){    
    ?>
    background-image: url('<?php echo oxy_get_bg_pattern_by_id($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f2']) ?>');
<?php  
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f2_position']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f2_position'])){
?>
    background-position: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f2_position'] ?>;
<?php
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f2_repeat']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f2_repeat'])){
?>
    background-repeat: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f2_repeat'] ?>;
<?php
}
if($smof_data->oxy_color_style_settings['oxy_f2_border_top_status'] == 1){
?>
    border-top: <?php echo $smof_data->oxy_color_style_settings['oxy_f2_border_top_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_f2_border_top_style']?> <?php echo $smof_color_data['oxy_f2_border_top_color']?>;
<?php
}
?>
}
#footer_c h3 {
	<?php if($smof_color_data['oxy_f2_titles_color'] != '') { ?>
		border-bottom: 1px <?php echo $smof_data->oxy_color_style_settings['oxy_f2_titles_border_bottom_style']?> <?php echo $smof_color_data['oxy_f2_titles_border_bottom_color']; ?>;
		 color: <?php echo $smof_color_data['oxy_f2_titles_color']; ?>;
	<?php }?>
}
#footer_c ul li{
    color: <?php echo $smof_color_data['oxy_f2_titles_border_bottom_color']; ?>;
}

#footer_c a {
	<?php if($smof_color_data['oxy_f2_link_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f2_link_color']; ?>;
	<?php }?>
}
#footer_c a:hover {
	<?php if($smof_color_data['oxy_f2_link_hover_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f2_link_hover_color']; ?>;
	<?php }?>
}


/********************************************Information, Customer Service, Extras, My Account end************************************************/

/********************************************Powered by, Payment Images***********************************************************/

#footer_d {
<?php if($smof_color_data['oxy_f4_bg_color'] != '') { ?>
    background-color: <?php echo $smof_color_data['oxy_f4_bg_color']; ?>;
<?php }?>
<?php
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f4_custom']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f4_custom'])){
?>
    background-image: url('<?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f4_custom'] ?>');
<?php

}elseif(isset($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f4']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f4'])
        && $smof_data->oxy_background_images_settings['oxy_pattern_oxy_f4'] != '0'){    
    ?>
    background-image: url('<?php echo oxy_get_bg_pattern_by_id($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f4']) ?>');
<?php  
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f4_position']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f4_position'])){
?>
    background-position: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f4_position'] ?>;
<?php
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f4_repeat']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f4_repeat'])){
?>
    background-repeat: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f4_repeat'] ?>;
<?php
}
?>
<?php if($smof_color_data['oxy_f4_border_top_color'] != '' 
             && $smof_data->oxy_color_style_settings['oxy_f4_border_top_status'] == 1) { ?>
    border-top: <?php echo $smof_data->oxy_color_style_settings['oxy_f4_border_top_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_f4_border_top_style']?> <?php echo $smof_color_data['oxy_f4_border_top_color']; ?>;
<?php }?> 
}
#footer_d {
	<?php if($smof_color_data['oxy_f4_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f4_text_color']; ?>;
	<?php }?>
}
#footer_d a {
	<?php if($smof_color_data['oxy_f4_link_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f4_link_color']; ?>;
	<?php }?>
}
#footer_d a:hover {
	<?php if($smof_color_data['oxy_f4_link_hover_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f4_link_hover_color']; ?>;
	<?php }?>
}
#footer_d {
	
}

/********************************************Powered by, Payment Images end***********************************************************/

/********************************************Bottom Custom Block***********************************************************/

#footer_e {
<?php if($smof_color_data['oxy_f5_bg_color'] != '') { ?>
    background-color: <?php echo $smof_color_data['oxy_f5_bg_color']; ?>;
<?php }?>
<?php
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f5_custom']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f5_custom'])){
?>
    background-image: url('<?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f5_custom'] ?>');
<?php

}elseif(isset($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f5']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f5'])
        && $smof_data->oxy_background_images_settings['oxy_pattern_oxy_f5'] != '0'){    
    ?>
    background-image: url('<?php echo oxy_get_bg_pattern_by_id($smof_data->oxy_background_images_settings['oxy_pattern_oxy_f5']) ?>');
<?php  
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f5_position']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f5_position'])){
?>
    background-position: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f5_position'] ?>;
<?php
}
if(isset($smof_data->oxy_background_images_settings['oxy_bg_image_f5_repeat']) 
        && !empty($smof_data->oxy_background_images_settings['oxy_bg_image_f5_repeat'])){
?>
    background-repeat: <?php echo $smof_data->oxy_background_images_settings['oxy_bg_image_f5_repeat'] ?>;
<?php
}
?>
    
<?php if($smof_color_data['oxy_f5_border_top_color'] != '' 
            && $smof_data->oxy_color_style_settings['oxy_f5_border_top_status'] == 1) { ?>
    border-top: <?php echo $smof_data->oxy_color_style_settings['oxy_f5_border_top_size']?>px <?php echo $smof_data->oxy_color_style_settings['oxy_f5_border_top_style']?> <?php echo $smof_color_data['oxy_f5_border_top_color']; ?>;
<?php }?>
}
#footer_e {
	<?php if($smof_color_data['oxy_f5_text_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f5_text_color']; ?>;
	<?php }?>
}
#footer_e a {
	<?php if($smof_color_data['oxy_f5_link_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f5_link_color']; ?>;
	<?php }?>
}
#footer_e a:hover {
	<?php if($smof_color_data['oxy_f5_link_hover_color'] != '') { ?>
		 color: <?php echo $smof_color_data['oxy_f5_link_hover_color']; ?>;
	<?php }?>
}


/********************************************Bottom Custom Block end***********************************************************/

/********************************************Footer**************************************************************/


/******************************************** Widgets start **************************************************************/

.video_box_left #video_box_icon, .video_box_right #video_box_icon {
    background-color: <?php echo $smof_color_data['oxy_video_box_bg']; ?>;
}
.video_box_right .video_box, .video_box_left .video_box {
    border: 4px solid <?php echo $smof_color_data['oxy_video_box_bg']; ?>;
}

.custom_box_left #custom_box_icon,
.custom_box_right #custom_box_icon{
    background-color: <?php echo $smof_color_data['oxy_custom_box_bg']?>;
}
.custom_box_right .custom_box, .custom_box_left .custom_box {
    border: 4px solid <?php echo $smof_color_data['oxy_custom_box_bg']?>;
}
/******************************************** Widgets end **************************************************************/



 
<?php if($smof_data->oxy_custom_css_settings['oxy_custom_css'] !='') { ?>
/*  Custom CSS */
<?php echo htmlspecialchars_decode($smof_data->oxy_custom_css_settings['oxy_custom_css'], ENT_QUOTES ); ?>
<?php } 