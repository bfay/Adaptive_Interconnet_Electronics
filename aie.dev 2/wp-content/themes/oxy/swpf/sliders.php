<?php
function sds_product_eislideshow_markup($defaults = array(),$pp = -1){
	
        extract($defaults);
        
	$oxy_product_slider = json_decode( get_option('oxy_product_slider'),true) ;
	
	global $woocommerce;
	
	if( !isset($woocommerce) || empty($oxy_product_slider)) return;
	
	$args = array('post_type'=>'product','post__in'=>$oxy_product_slider,'posts_per_page'=>$pp);		
		
	$q = new WP_Query( $args );

	if($q->have_posts()):
	
            $id = 'ei-product-slider-'.rand(000000,999999);
        
        
        
        
	?>


<div class="woocommerce">
        <section class="product-slider">
            <div id="<?php echo $id?>" class="ei-slider">
                <ul class="ei-slider-large">
                   
                <?php 
                while ( $q->have_posts() ) : $q->the_post();
                ?>
                <li>
                <?php
                
                
//                if(has_post_thumbnail()){
//                
//                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()) ,'full',false);
//                $image = $image[0];
//                
//                
//                }
                ?>
                   <div class="image">
                   
                       <a href="<?php echo get_permalink();?>" class="product_image">
                        <?php  if ( has_post_thumbnail()) :?>
                        <?php the_post_thumbnail( 'medium' ); 
                        endif; ?></a>
                    </div>
                   <div class="ei-title">
                    <h2><a href="<?php echo get_permalink();?>"><?php echo the_title(); ?></a></h2>
                    <h3>
                        <a href="<?php echo get_permalink();?>">                        
                            <?php echo substr(get_the_excerpt(),20);  ?>
                        </a>                                
                    </h3>                                
                    <h4>
                        <a href="<?php echo get_permalink();?>">
                         <?php                                
                          do_action( 'woocommerce_after_shop_loop_item_title' );
                        ?>
                          </a><br /><br />
                          
                          <a style="font-size:14px;font-weight:bold" class="button ajax_add_to_cart_button" href="<?php echo get_permalink();?>" title="<?php _e('Shop Now!','oxy')?>"><?php _e('Shop Now!','oxy')?></a>
                    </h4>
                    </div>
                </li>
                <?php endwhile; ?>
                </ul>
                <ul class="ei-slider-thumbs">
                <li class="ei-slider-element"><?php _e('Current','oxy')?></li>
                 <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                    <li><a href="<?php echo get_permalink();?>"></a></li>
                 <?php   endwhile; ?>
                 
                </ul>
            </div>
        </section>
</div>   
        
        <script type="text/javascript">
            jQuery(function($) {
            $('#<?php echo $id?>').eislideshow({
                animation                       : 'center',
                autoplay                        : true,
                        slideshow_interval      : <?php echo $interval?>,
                        titlesFactor            : 0
            });
            });
        </script>

	<?php
	
	 endif;
	// Reset Query
	wp_reset_query();

}
