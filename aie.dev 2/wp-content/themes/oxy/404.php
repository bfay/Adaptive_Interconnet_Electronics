<?php
/**
 * @package oxy
 * @subpackage oxy
 */

global $smof_data;
global $wp_query;
get_header(); 

$design = $smof_data->oxy_general_settings['oxy_blog_page_display_style'];
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
    
    case 3:        
        $leftbar = $rightbar = 'hidesidebar';
        $main = 'large-12 medium-12';
        break;
    
    default:        
        $main = 'large-6 medium-6';
        break;
    
}
?>

<section id="midsection" class="container">
    <div class="row">
        <aside id="column-left" class="large-3 medium-3 columns <?php echo $leftbar?>">
        <?php get_sidebar(); ?>
        </aside>
	<div class="<?php echo $main?> columns" id="content">
            <div class="columns">                        
                <header class="archive-header">           
                <h1 class="archive-title"><?php _e('The page you requested cannot be found!','oxy') ?></h1>
                </header><!-- .archive-header -->
                <div class="breadcrumb">                
                    <?php 
                        bcn_display();
                    ?>                
                </div>
                <div class="content"><?php _e('The page you requested cannot be found.','oxy') ?></div>
                <div class="buttons">
                    <div class="right"><a class="button" href="<?php echo home_url()?>"><?php _e('Continue','oxy')?></a></div>
                </div>
                
            </div>
        </div>
        <aside id="column-right" class="large-3 medium-3 columns <?php echo $rightbar?>">
        <?php get_sidebar('right'); ?>
        </aside>
    </div>
</section>
<?php get_footer(); ?>