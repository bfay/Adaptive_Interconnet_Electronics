<?php
/**
 * @package sellya
 * @subpackage sellya
 */
global $smof_data ,$woocommerce;

?>
<footer id="footer">

<div id="footer_p">
<div class="row">
    <?php 
    if(isset($smof_data) && $smof_data->oxy_footer_settings['oxy_fp_fb1_status'] == 1){ ?>
<div class="p_content s3 large-3 medium-3 small-12 columns">
      <span class="p_icon pi1">
                <img src="<?php echo $smof_data->oxy_footer_settings['oxy_fp_fb1_icon']; ?>" alt="+" title="+">
		  </span>
<span class="p_title"><a href="#" data-reveal-id="oxyModal1"><?php echo get_option('oxy_fp_fb1_title1'); ?></a></span>
<span class="p_subtitle"><?php echo get_option('oxy_fp_fb1_subtitle1'); ?></span>

</div>
<?php
    }
    if(isset($smof_data) && $smof_data->oxy_footer_settings['oxy_fp_fb2_status'] == 1){
?>
<div class="p_content s3 large-3 medium-3 small-12 columns">
      <span class="p_icon pi2">
                <img src="<?php echo $smof_data->oxy_footer_settings['oxy_fp_fb2_icon']; ?>" alt="+" title="+">
		  </span>
<span class="p_title"><a href="#" data-reveal-id="oxyModal2"><?php echo get_option('oxy_fp_fb2_title1'); ?></a></span>
<span class="p_subtitle"><?php echo get_option('oxy_fp_fb2_subtitle1'); ?></span>

</div>
<?php
    }
    if(isset($smof_data) && $smof_data->oxy_footer_settings['oxy_fp_fb3_status'] == 1){
?>
<div class="p_content s3 large-3 medium-3 small-12 columns">
      <span class="p_icon pi3">
                <img src="<?php echo $smof_data->oxy_footer_settings['oxy_fp_fb3_icon']; ?>" alt="+" title="+">
		  </span>
<span class="p_title"><a href="#" data-reveal-id="oxyModal3"><?php echo get_option('oxy_fp_fb3_title1'); ?></a></span>
<span class="p_subtitle"><?php echo get_option('oxy_fp_fb3_subtitle1'); ?></span>

</div>
    <?php
    }
    if(isset($smof_data) && $smof_data->oxy_footer_settings['oxy_fp_fb4_status'] == 1){
    ?>

<div class="p_content s3 large-3 medium-3 small-12 columns">
      <span class="p_icon pi4">
                <img src="<?php echo $smof_data->oxy_footer_settings['oxy_fp_fb4_icon']; ?>" alt="+" title="+">
		  </span>
<span class="p_title"><a href="#" data-reveal-id="oxyModal4"><?php echo get_option('oxy_fp_fb4_title1'); ?></a></span>
<span class="p_subtitle"><?php echo get_option('oxy_fp_fb4_subtitle1'); ?></span>

</div>
    <?php }?>
</div>
</div>
<?php if(is_active_sidebar('footer1')){?>
<div id="footer_a">
<div class="row">
<?php 
    dynamic_sidebar('footer1');
?>

</div>
</div>
<?php }if(is_active_sidebar('footer2')){?>
<div id="footer_c">
<div class="row">

<?php 
    dynamic_sidebar('footer2');
?>    
 
</div>
</div>
<?php }?>
<div id="footer_d">
<div class="row">
<?php if($smof_data->oxy_footer_settings['oxy_powered_status'] != 0){ ?>
<div id="footer_d_1" class="s6 large-6 medium-6 small-12 columns">
<div id="powered_content">
		        <p><?php echo get_option('oxy_powered_content1'); ?></p>
</div>
</div>
<?php } ?>
<?php if($smof_data->oxy_footer_settings['oxy_payment_block_status'] != 0){ ?>
<div id="footer_d_2" class="s6 large-6 medium-6 small-12 columns">
<div id="payment_logos">
      <?php if($smof_data->oxy_footer_settings['oxy_show_paypal'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_paypal_url']; ?>" target="_blank">
			   <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_paypal']; ?>" alt="PayPal" title="PayPal">
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_visa'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_visa_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_visa']; ?>" alt="Visa" title="Visa">
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_mastercard'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_mastercard_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_mastercard']; ?>" alt="MasterCard" title="MasterCard">
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_maestro'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_maestro_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_maestro']; ?>" alt="Maestro" title="Maestro">
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_discover'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_discover_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_discover']; ?>" alt="Discover" title="Discover">
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_moneybookers'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_moneybookers_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_moneybookers']; ?>" alt="Moneybookers" title="Moneybookers">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_american_express'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_american_express_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_american_express']; ?>" alt="american express" title="american express">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_cirrus'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_cirrus_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_cirrus']; ?>" alt="cirrus" title="cirrus">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_delta'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_delta_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_delta']; ?>" alt="delta" title="delta">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_google'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_google_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_google']; ?>" alt="google" title="google">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_2co'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_2co_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_2co']; ?>" alt="2CO" title="2CO">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_sage'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_sage_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_sage']; ?>" alt="Sage" title="Sage">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_solo'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_solo_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_solo']; ?>" alt="Solo" title="Solo">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_switch'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_switch_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_switch']; ?>" alt="switch" title="switch">            
      </a>
      <?php } ?>
      <?php if($smof_data->oxy_footer_settings['oxy_show_western_union'] != 0){ ?>
      <a href="<?php echo $smof_data->oxy_footer_settings['oxy_payment_western_union_url']; ?>" target="_blank">
          <img src="<?php echo $smof_data->oxy_footer_settings['oxy_payment_western_union']; ?>" alt="western union" title="western union">            
      </a>
      <?php } ?>
</div>
</div>
<?php } ?>
</div>
</div>

<?php
if($smof_data->oxy_footer_settings['oxy_custom_3_status'] != 0 ){
?>
<div id="footer_e">
<div class="row">
<div id="footer_e_1" class="large-12 medium-12 columns">
        <p><?php echo get_option('oxy_custom_3_content1'); ?></p>
         
</div>
</div>
</div>
<?php } ?>
</footer>
</div>
<!--.wrapper-->
<?php
if(isset($smof_data) && $smof_data->oxy_footer_settings['oxy_fp_fb1_status'] == 1){
?>
<div id="oxyModal1" class="reveal-modal [expand, xlarge, large, medium, small]">
    <?php echo get_option('oxy_fp_fb1_content1'); ?>
    <a class="close-reveal-modal">&#215;</a>
</div>
<?php
}
if(isset($smof_data) && $smof_data->oxy_footer_settings['oxy_fp_fb2_status'] == 1){
?>
<div id="oxyModal2" class="reveal-modal [expand, xlarge, large, medium, small]">
    <?php echo get_option('oxy_fp_fb2_content1'); ?>
    <a class="close-reveal-modal">&#215;</a>
</div>
<?php
}
if(isset($smof_data) && $smof_data->oxy_footer_settings['oxy_fp_fb3_status'] == 1){
?>
<div id="oxyModal3" class="reveal-modal [expand, xlarge, large, medium, small]">
    <?php echo get_option('oxy_fp_fb3_content1'); ?>
    <a class="close-reveal-modal">&#215;</a>
</div>
<?php
}
if(isset($smof_data) && $smof_data->oxy_footer_settings['oxy_fp_fb4_status'] == 1){
?>
<div id="oxyModal4" class="reveal-modal [expand, xlarge, large, medium, small]">
    <?php echo get_option('oxy_fp_fb4_content1'); ?>
    <a class="close-reveal-modal">&#215;</a>
</div> 
<?php
}
?>
<?php wp_footer(); ?>

</body>
</html>