<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
<a class="nav-tab <?php if((isset($_GET['page']) && $_GET['page']=="oxy-admin") or !isset($_GET['page'])) echo " nav-tab-active" ; ?>"
href="<?php echo admin_url('admin.php?page=oxy-admin')?>">General Options</a>
<a class="nav-tab <?php if(isset($_GET['page']) && $_GET['page']=="oxy_color_style_settings") echo " nav-tab-active" ; ?> " 
   href="<?php echo admin_url('admin.php?page=oxy_color_style_settings')?>">Colors and Styles</a>
<a class="nav-tab <?php if(isset($_GET['page']) && $_GET['page']=="oxy_background_images") echo " nav-tab-active" ; ?> "
href="<?php echo admin_url('admin.php?page=oxy_background_images')?>">Background Images</a>
<a class="nav-tab <?php if(isset($_GET['page']) && $_GET['page']=="oxy_fonts") echo " nav-tab-active" ; ?> "
   href="<?php echo admin_url('admin.php?page=oxy_fonts')?>">Fonts</a>
<a class="nav-tab <?php if(isset($_GET['page']) && $_GET['page']=="oxy_footer_settings") echo " nav-tab-active" ; ?> "
   href="<?php echo admin_url('admin.php?page=oxy_footer_settings')?>">Footer</a>
<a class="nav-tab <?php if(isset($_GET['page']) && $_GET['page']=="oxy_widgets_settings") echo " nav-tab-active" ; ?> "
   href="<?php echo admin_url('admin.php?page=oxy_widgets_settings')?>">Widgets</a>
<a class="nav-tab <?php if(isset($_GET['page']) && $_GET['page']=="oxy_custom_css") echo " nav-tab-active" ; ?> "
   href="<?php echo admin_url('admin.php?page=oxy_custom_css')?>">Custom CSS</a>
<a class="nav-tab <?php if(isset($_GET['page']) && $_GET['page']=="oxy_text_fields_settings") echo " nav-tab-active" ; ?> "
   href="<?php echo admin_url('admin.php?page=oxy_text_fields_settings')?>">Custom Text Fields</a>
</h2>



        
