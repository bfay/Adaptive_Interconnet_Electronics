<?php file_exists('../../../../wp-load.php') ? require_once('../../../../wp-load.php') : require_once('../../../../../wp-load.php'); 

$version = get_bloginfo('version'); 
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

	

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title></title>



	<link rel="stylesheet" type="text/css" href="shortcode_styles.css" />

	<script type="text/javascript" src="<?php echo includes_url('js/jquery/jquery.js?ver=1.8.3')?>"></script>

    <script type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>

    <script type="text/javascript">

		jQuery(document).ready(function() {

			jQuery('#insert').attr("disabled", true);

			jQuery('#insert').addClass("disabled");

			jQuery('#select_shortcode').change(function() {

				if( jQuery(this).val() == '' ) {

					jQuery('#insert').attr("disabled", true);

					jQuery('#insert').addClass("disabled");

				} else {

					jQuery('#insert').removeAttr("disabled");

					jQuery('#insert').removeClass("disabled");

				}

			});

		});

		

		function returnShortcodeValue() {

			var out;

			switch(jQuery('#select_shortcode').val())

			{

                                case "full": 

					out = "[full]<p>Your content here...</p>[/full]<br />";

					break;
                               
				case "half": 

					out = "[half]<p>Your content here...</p>[/half]<br />";

					break;
                                
				case "one_third": 

					out = "[one_third]<p>Your content here...</p>[/one_third]<br />";

					break;
                                
				case "one_fourth": 

					out = "[one_fourth]<p>Your content here...</p>[/one_fourth]<br />";

					break;
                                        				
                              
				case "one_sixth": 

					out = "[one_sixth]<p>Your content here...</p>[/one_sixth]<br />";

					break;
                                        
				

                                case "two_third": 

					out = "[two_third]p>Your content here...</p>[/two_third]<br />";

					break;
                                
                                        
				case "three_fourth": 

					out = "[three_fourth]<p>Your content here...</p>[/three_fourth]<br />";

					break;
                                
				case "five_sixth": 

					out = "[five_sixth]<p>Your content here...</p>[/five_sixth]<br />";

					break;
                                        
				
				case "button":

					out = "[button href ='' ]button text..[/button]";

					break;
				case "button_small":

					out = "[button_small href ='' ]button text..[/button_small]";

					break;
				case "button_medium":

					out = "[button_medium href ='' ]button text..[/button_medium]";

					break;
				case "button_large":

					out = "[button_large href ='' ]button text..[/button_large]";

					break;

				case "panel":

					out = "[panel]Content...[/panel]<br />";

					break;
				case "alert":

					out = "[alert]Content...[/alert]<br />";

					break;

				case "radius-panel":

					out = "[panel class = 'radius']Content...[/panel]<br />";

					break;
				case "callout-panel":

					out = "[panel class = 'callout']Content...[/panel]<br />";

					break;
				
				case "success-alert":

					out = "[success-alert]Content...[/success-alert]<br />";

					break;
					
				case "success-alert-radius":

					out = "[success-alert-radius]Content...[/success-alert-radius]<br />";

					break;
				case "success-alert-round":

					out = "[success-alert-round]Content...[/success-alert-round]<br />";

					break;
				case "warning-alert":

					out = "[warning-alert]Content...[/warning-alert]<br />";

					break;
				case "warning-alert-radius":

					out = "[warning-alert-radius]Content...[/warning-alert-radius]<br />";

					break;	
				case "warning-alert-round":

					out = "[warning-alert-round]Content...[/warning-alert-round]<br />";

					break;	
				case "info-alert":

					out = "[info-alert]Content...[/info-alert]<br />";

					break;
					
				case "info-alert-radius":

					out = "[info-alert-radius]Content...[/info-alert-radius]<br />";

					break;
				case "info-alert-round":

					out = "[info-alert-round]Content...[/info-alert-round]<br />";

					break;

				case "accordion":

					out = "[accordion][atab title=\"First tab\"]Tab content goes here[/atab][atab title=\"Second tab\"]Tab content goes here[/atab][atab title=\"Third tab\"]Tab content goes here[/atab][/accordion]<br />";

					break;
				
                                case 'oxy_product_cat':
                                
                                        out = '[oxy_product_cat show_icon="true" show_counter="true" cats_per_row="4" subcat_per_col="4"]';
                                
                                        break;
                                case 'oxy_product_brands':
                                
                                        out = '[oxy_product_brands per_row="4" limit="12"]';
                                
                                        break;
                                case 'oxy_products_slider':
                                
                                        out = '[oxy_products_slider type="recent_products" title="Recent Products" ids="" skus="" per_page="12" columns="6" orderby="date" order="desc" ]';
                                
                                        break;
                                
				case "tabs":

					out = "[tabgroup]<br />[tab title=\"First tab\"]Tab content goes here[/tab]<br />[tab title=\"Second tab\"]Tab content goes here[/tab]<br />[tab title=\"Third tab\"]Tab content goes here[/tab]<br /> [/tabgroup]<br />";

					break;

				case "toggle":

					out = "[toggle title=\"Toggle title...\"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.[/toggle]<br />";

					break;
					
				case "list_disc":

					out = "[list_disc][li]list item...[/li][li]list item...[/li][li]list item...[/li][/list_disc]";

					break;
					
				case "list_circle":

					out = "[list_circle][li]list item...[/li][li]list item...[/li][li]list item...[/li][/list_circle]";

					break;
					
				case "list_square":

					out = "[list_square][li]list item...[/li][li]list item...[/li][li]list item...[/li][/list_square]";

					break;
					
				case "list_no-bullet":

					out = "[list_no-bullet][li]list item...[/li][li]list item...[/li][li]list item...[/li][/list_no-bullet]";

					break;
					
				case "list_ol":

					out = "[list_ol][li]list item...[/li][li]list item...[/li][li]list item...[/li][/list_ol]";

					break;

				case "gmap":
				
					out = "[gmap type='ROADMAP' height='358' lat='51.5224954' lng='-0.1720996' zoom='15' contentwidth='250' markercontent='']";
				
					break;
				case "progressbar":

					out = "[progressbar width=30%]<br />";

					break;	
				case "progressbar-radius":

					out = "[progressbar-radius width=30%]<br />";

					break;
				case "progressbar-round":

					out = "[progressbar-round width=30%]<br />";

					break;
				case "progressbar-success":

					out = "[progressbar-success width=30%]<br />";

					break;
				case "progressbar-success-radius":

					out = "[progressbar-success-radius width='30%']<br />";

					break;
				case "progressbar-success-round":

					out = "[progressbar-success-round width=30%]<br />";

					break;
				case "progressbar-alert":

					out = "[progressbar-alert width=30%]<br />";

					break;
				case "progressbar-alert_radius":

					out = "[progressbar-alert_radius width=30%]<br />";

					break;
				case "progressbar-alert_round":

					out = "[progressbar-alert_round width=30%]<br />";

					break;
				case "progressbar-secondary":

					out = "[progressbar-secondary width=30%]<br />";

					break;
				case "progressbar-secondary-radius":

					out = "[progressbar-secondary-radius width=30%]<br />";

					break;
				case "progressbar-secondary-round":

					out = "[progressbar-secondary-round width=30%]<br />";

					break;
				
                                case "flexslider":

					out = "[flexslider][ftab title=\"title1\" link=\"\" imageurl=\"\"][/ftab][ftab title=\"title1\" link=\"\" imageurl=\"\"][/ftab][ftab title=\"title1\" link=\"\" imageurl=\"\"][/ftab][/flexslider]<br />";

					break;	
                                        
                                case "nivoslider":

					out = "[nivoslider][ntab title=\"title1\" link=\"\" imageurl=\"\"][/ntab][ntab title=\"title1\" link=\"\" imageurl=\"\"][/ntab][ntab title=\"title1\" link=\"\" imageurl=\"\"][/ntab][/nivoslider]<br />";

					break;	

				case "cameraslider":

					out = "[cameraslider][ctab link=\"\" imageurl=\"\"][/ctab][ctab link=\"\" imageurl=\"\"][/ctab][ctab link=\"\" imageurl=\"\"][/ctab][/cameraslider]<br />";

					break;	
                                
				case 'eiproductslider': 

					out = '[eiproductslider]';
                                        
                                        break;
                                        
				case 'oxy-latest-posts': 

					out = '[oxy-latest-posts showposts="12" orderby="date" order="order" title="Latest Blog Posts" slider="true"]';
                                        
                                        break;
                                        
				case 'testimonials': 

					out = '[testimonials showposts="-1" orderby="date" order="order" direction="horizontal" slideshowSpeed="7000"]';
                                        
                                        break;
                                        
				default: 

					out = '';

			}

			

			<?php if($version < 3.9){?>

                        window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, out);
                        window.tinyMCE.activeEditor.execCommand('mceRepaint');
                        tinyMCEPopup.close();

                        <?php }else{?>
                        parent.tinyMCE.execCommand('mceInsertContent', false,out);
                        parent.tinyMCE.activeEditor.windowManager.close();
                        <?php }?>

		}

    </script>

</head>

<body>

	<fieldset>

    <legend>Select a Shortcode</legend>

	<div>

        <select id="select_shortcode">

		<option value="">Select</option>

            <optgroup label="Columns">	

                <option value="full">Full</option>

                <option value="half">Half</option>

                <option value="one_third">One Third</option>

                <option value="two_third">Two Third</option>

                <option value="one_fourth">One Fourth</option>					

                <option value="one_sixth">One Sixed</option>					

                <option value="three_fourth">Three Fourth</option>

                <option value="five_sixth">five Sixth</option>

            </optgroup>

            <optgroup label="Button">
            
            	<option value="button">Default Button</option>

            	<option value="button_small">Small Button</option>
                
                <option value="button_medium">Medium Button</option>
                
                <option value="button_large">Large Button</option>
            
            </optgroup>

            <optgroup label="Progressbar">
            
            	<option value="progressbar">progressbar</option>
                
                <option value="progressbar-radius">progressbar-radius</option>
                
                <option value="progressbar-round">progressbar-round</option>

                <option value="progressbar-success">progressbar-success</option>

                <option value="progressbar-success-radius">progressbar-success-radius</option>

                <option value="progressbar-success-round">progressbar-success-round</option>

                <option value="progressbar-alert">progressbar-alert</option>

                <option value="progressbar-alert_radius">progressbar-alert_radius</option>

                <option value="progressbar-alert_round">progressbar-alert_round</option>

                <option value="progressbar-secondary">progressbar-secondary</option>

                <option value="progressbar-secondary-radius">progressbar-secondary-radius</option>

                <option value="progressbar-secondary-round">progressbar-secondary-round</option>
            
            </optgroup>

        <optgroup label="Message boxes">

                <option value="panel">panel</option>

                <option value="radius-panel">Radius Panel</option>

                <option value="callout-panel">Callout Panel</option>

                <option value="radius-panel">Radius Panel</option>

                <option value="callout-panel">Callout Panel</option>

                <option value="alert">Alert</option>
                
                <option value="success-alert">Success Alert</option>
                
                <option value="success-alert-radius">Success Alert Radius</option>
                
                <option value="success-alert-round">Success Alert Round</option>

                <option value="warning-alert">Warning Alert</option>

                <option value="warning-alert-radius">Warning Alert Radius</option>

                <option value="warning-alert-round">Warning Alert Round</option>

                <option value="info-alert">Info Alert</option>

                <option value="info-alert-radius">Info Alert Radius</option>

                <option value="info-alert-round">Info Alert Round</option>

        </optgroup>

            
        <optgroup label="Product Categories &amp; Brands">
            <option value="oxy_product_cat">Product Categories</option>
            <option value="oxy_product_brands">Product Brands</option>
            <option value="oxy_products_slider">Products Slider</option>
        </optgroup>
        <optgroup label="Toggle Elements">  

                <option value="accordion">Accordion</option>

                <option value="tabs">Tabs</option>  

                <option value="toggle">Toggle</option>	

        </optgroup>
        <optgroup label="Sliders">            	
            <option value="cameraslider">Camera Slider</option>
            <option value="flexslider">Flexslider</option>
            <option value="nivoslider">Nivoslider</option>
            <option value="eiproductslider">Product Banner Slider</option>
        </optgroup>
            <optgroup label="Google Map">

            	<option value="gmap">Google Map</option>

            </optgroup>

            <optgroup label="List Elements">

                    <option value="list_disc">List Disc</option>

                    <option value="list_circle">List Circle</option>	

                    <option value="list_no-bullet">List No Bullet</option>	

                    <option value="list_ol">Order List</option>

            </optgroup>		
            <optgroup label="Extra">

            	<option value="oxy-latest-posts">Latest Blog Posts</option>
            	<option value="testimonials">Testimonial Slider</option>

            </optgroup>
        </select>

		</div>

		</fieldset>



        <div>
            <?php if($version < 3.9){?>
            <input type="submit" value="Add" onclick="returnShortcodeValue()" id="insert" />
            <input type="button" value="Close" onclick="tinyMCEPopup.close()" id="cancel" />
            <?php } else{?>
            <button class="button button-primary submit" type="submit"  onclick="returnShortcodeValue()" id="insert" />Add</button>
            <button type="button" class="button button-secondary" onclick="parent.tinyMCE.activeEditor.windowManager.close()" id="cancel" />Close</button>
            <?php }?>
        </div>



</body>

</html>