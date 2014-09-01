<?php
/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */
global $smof_data, $post;
get_header(); 
//if(is_front_page())
//    $design = $smof_data->oxy_general_settings['oxy_home_page_display_style'];
//else
//    $design = $smof_data->oxy_general_settings['oxy_inner_page_display_style'];

$pagetitle_status = get_post_meta($post->ID, 'oxy_show_page_title', true);
$breadcrumb_status = get_post_meta($post->ID, 'oxy_show_breadcrumb', true);
$design = get_post_meta($post->ID, 'oxy_page_layout', true);


$leftbar = $rightbar = $main = '';

switch ((int) $design){
    case 1:
        $rightbar = 'hidesidebar';
        $main = 'large-9 medium-9';
        break;
    case 2:
        $leftbar = 'hidesidebar';
        $main = 'large-9 medium-9';
        break;
    
    case 4:        
        $main = 'large-6 medium-6';
        break;
    
    default:        
        $leftbar = $rightbar = 'hidesidebar';
        $main = 'large-12 medium-12';
        break;
    
}
?>

<section id="midsection" class="container">
<div class="row">
        <?php if(empty($leftbar) && $leftbar != 'hidesidebar'){?>
        <aside id="column-left" class="large-3 medium-3 columns <?php echo $leftbar?>">
        <?php get_sidebar('page-left'); ?>
        </aside>    
        <?php }?>
	<section class="<?php echo $main?> columns" id="content">
            
        
		<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( is_page() and $pagetitle_status == 1 ) : ?>
		    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                <?php endif; ?>
                <?php if($breadcrumb_status == 1 && function_exists('bcn_display')){?>
                    <div class="breadcrumb">                
                        <?php 
                            bcn_display();
                        ?>                
                    </div> 
                    <?php }?>
			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php else : ?>
				<div class="entry-content">                                    
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'oxy' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>	
		<?php endwhile; // end of the loop. ?>
		<?php 
                if ( comments_open() )
                comments_template(); ?>

	</section>
        <?php if(empty($rightbar) && $rightbar != 'hidesidebar'){?>
        <aside id="column-right" class="large-3 medium-3 columns <?php echo $rightbar?>">
        <?php get_sidebar('page-right'); ?>
        </aside>
        <?php }?>
</div>
	
</section>

<?php get_footer(); ?>