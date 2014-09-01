<?php
/**
 * @package oxy
 * @subpackage oxy
 */

global $smof_data;
global $wp_query;
get_header(); 

$design = $smof_data->oxy_general_settings['oxy_blog_page_display_style'];
$cols = $smof_data->oxy_general_settings['oxy_blog_page_columns'];

$leftbar = $rightbar = $main = '';

if(isset($_GET['oxy_page_layout']) && is_numeric($_GET['oxy_page_layout']))
    $design = $_GET['oxy_page_layout'];

if(isset($_GET['oxy_cols']) && is_numeric($_GET['oxy_cols']))
    $cols = $_GET['oxy_cols'];


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

switch ($cols){            
    case 2:        
        $colclass = 'large-6 medium-6 small-6 columns';
        break;    
    case 3:        
        $colclass = 'large-4 medium-4 small-6 columns';
        break;    
    default:        
        $colclass = 'large-12 medium-12 small-12 columns';
        break; 
}

?>

<section id="midsection" class="container">
    <div class="row">
        <?php if($leftbar == ''){?>
        <aside id="column-left" class="large-3 medium-3 columns <?php echo $leftbar?>">
        <?php get_sidebar(); ?>
        </aside>
        <?php }?>
	<div class="<?php echo $main?> columns" id="content">
            
            
            <?php if ( have_posts() ) :         
                if(get_option('page_for_posts') != 0):        
                        $blog = get_page(intval(get_option('page_for_posts')));           
                        $blogtitle = $blog->post_title;         
                elseif(is_front_page()):            
                        $blogtitle = "";            
                else:           
                        $blogtitle = __("Blog",'oxy');            
                endif;          
        ?>
                <header class="archive-header">           
                <h1 class="archive-title"><?php echo $blogtitle; ?></h1>
                </header><!-- .archive-header -->                     
            <div class="row" id="blogCatArticles">
                   <?php   
                   $n = 0;
                   while ( have_posts() ) : the_post(); 
                   $clearclass = '';
                   if((int)$cols > 0 && ($n++ % (int)$cols) == 0)
                       $clearclass .= 'clearleft';                   
                   ?>
                         <div itemtype="http://schema.org/Article" itemscope="" id="post-<?php the_ID()?>" <?php post_class("articleCat {$colclass} {$clearclass}")?>>
                            <div class="articleHeader">
                               <h3 itemprop="name"><a itemprop="url" title="<?php the_title(); ?>" href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                                  <span>
                                      <?php _e('Posted by','oxy')?> <span itemprop="author"><?php the_author();?></span> <?php _e('in','oxy')?> <span itemprop="articleSection"><?php $cats = get_the_category(); 
                                                       if(!empty($cats)):
                                                           foreach ($cats as $i => $cat):
                                                               if ($i > 0)
                                                                   echo ', ';
                                                               echo "<a href='" . get_category_link($cat->term_id) . "'>$cat->name</a>";
                                                           endforeach;
                                                       endif;
                                                       ?></span> <?php the_tags()?> <?php _e('on','oxy')?> <span itemprop="dateCreated"><?php
                                                        $arch_day = get_the_time('d');					
                                                        $arch_mon = get_the_time('m');
                                                        $arch_year = get_the_time('Y');
                                                        $day_link = get_day_link($arch_year,$arch_mon,$arch_day);
                                                       echo '<a href="'.$day_link.'">'.get_the_date().'</a>'?></span>
                                  </span>
                            </div>
                            <div class="articleContent">
                              <?php get_template_part( 'content', get_post_format() ); ?>
                                  <div itemprop="description" class="blockClear"><?php the_content(); 
                                  wp_link_pages(array('before' => '<div class="post_paginate">' . __('Pages:&nbsp;', 'oxy'), 'after' => '</div>', 'next_or_number' => 'number', 'nextpagelink' => '<span class="next">Next &raquo;</span>', 'previouspagelink' => '', 'link_before' => '<span>', 'link_after' => '</span>'));
                                  ?></div>
                                    <div class="readMore">
                                      <span class="comment"><a title="Comments" href="<?php the_permalink();?>"><?php comments_popup_link(
                                                                   __( ' 0 comments', 'oxy' ),
                                                                   __( ' 1 comment', 'oxy' ),
                                                                   __( ' % comments', 'oxy' ),
                                                                   '',__( ' Comments off', 'oxy' )
                                                                   )?></a></span>
                                        <?php global $oxy_found_more_tag; if($oxy_found_more_tag){ $oxy_found_more_tag = false; //reset more tag..?>
                                      <span class="more"><a title="<?php the_title(); ?>" href="<?php the_permalink();?>#more-<?php the_ID()?>"><?php _e('Read more..','oxy')?></a></span>
                                        <?php }?>
                                   </div>
                            </div>
                         </div> 
                   <?php endwhile; ?>
            </div>
            
            <div class="pagination">
                    <?php
                   
                            $big = 999999999; // need an unlikely integer					
                            echo paginate_links( array(
                                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                    'format' => '?paged=%#%',
                                    'current' => max( 1, get_query_var('paged') ),
                                    'total' => $wp_query->max_num_pages,
                                    'type' => 'list'
                            ) );
                    ?>
            </div>
       <?php else : ?>
                    <h1><?php _e('No posts have been found at this moment.','oxy')?></h1>
        <?php endif; ?> 
        </div>
    <?php if($rightbar == ''){?>    
    <aside id="column-right" class="large-3 medium-3 columns <?php echo $rightbar?>">
    <?php get_sidebar('right'); ?>
    </aside>
    <?php }?>
    </div>
</section>
<?php get_footer(); ?>