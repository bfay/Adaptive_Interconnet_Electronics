<?php
/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */
get_header();

global $post,$smof_data;

$post_type = $post->post_type;
?>

<?php
$design = $smof_data->oxy_general_settings['oxy_blog_page_display_style'];
$leftbar = $rightbar = $main = '';

switch ($design){    
    case 1:
        $rightbar = 'hidesidebar';
        $main = 'large-9 medium-9';
        break;
    case 2:
        $leftbar = 'hidesidebar';
        $main = 'large-9 medium-9';
        break;
    
    case 3:        
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
        <aside id="column-left" class="large-3 medium-3 columns <?php echo $leftbar?>">
        <?php get_sidebar(); ?>
        </aside>        
        <div class="<?php echo $main?> columns" id="content">            
                <div class="blog single-post">        
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="articleHeader">
         <h1 itemprop="headline"><?php the_title(); ?></h1>
            <span>
               <?php _e('Posted by','oxy')?> <span itemprop="author"><?php the_author();?></span></span> <?php _e('in','oxy')?> <span itemprop="articleSection"><?php $cats = get_the_category(); 
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
                                                       echo '<a href="'.$day_link.'">'.get_the_date().'</a>'?></span><?php comments_popup_link(
                                                               __( ' 0 comments', 'oxy' ),
                                                               __( ' 1 comment', 'oxy' ),
                                                               __( ' % comments', 'oxy' ),
                                                               '',__( ' Comments off', 'oxy' )
                                                               )?>            
            </span>
            
      </div>
      <div itemprop="articleBody" class="articleContent">
            <?php get_template_part( 'content', get_post_format() ); ?>
            <?php the_content(); 
            wp_link_pages(array('before' => '<div class="post_paginate">' . __('Pages:&nbsp;', 'oxy'), 'after' => '</div>', 'next_or_number' => 'number', 'nextpagelink' => '<span class="next">Next &raquo;</span>', 'previouspagelink' => '', 'link_before' => '<span>', 'link_after' => '</span>'));
            ?>
      </div>
                    <?php endwhile; // end of the loop.  ?>
                </div><!--.blog -->			

                <div class="clear"></div>

<?php
if ($post_type == 'post'):
    // If a user has filled out their description, show a bio on their entries.
    if (get_the_author_meta('description')) :
        ?>
            <div class="large-12 medium-12 columns">
                        <?php
                        $related = array();

                        if (!empty($cats)):

                            foreach ($cats as $cat):

                                $args = array('category' => $cat->term_id, 'posts_per_page' => -1);

                                $p1 = get_posts($args);

                                foreach ($p1 as $p):

                                    if ($p->ID != $post->ID)
                                        $related[] = $p->ID;

                                endforeach;

                            endforeach;


                            $args = array("showposts" => 3, 'post__in' => $related);

                            $q = new WP_Query($args);

                            if ($q->have_posts()):

                                $i = 0;
                                /* Start the Loop */
                                while ($q->have_posts()) : $q->the_post();
                                    ?>

                                    <div class="large-4 medium-4 columns">
                                        <div class="image_related"  >
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">

                                            <?php the_post_thumbnail(array(211, 124)); ?>

                                            </a>   
                                        </div>                         
                                        <div class="large-12 medium-12">

                                            <h2 class="blog_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                              
                                        </div> <!--.span5 -->                                   
                                    </div><!--.four -->						
                                     
                    <?php
                    $i++;
                endwhile;

            endif;
            wp_reset_query();
        endif;
        ?>

                        </div>
                        <div class="large-12 medium-12">
                            <div class="v-card gray">
                                <div class="v-image">
                            <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('sellya_author_bio_avatar_size', 80)); ?>
                                </div><!-- .author-avatar -->
                                <div class="v-details">
                                    <h5><?php printf(__('About %s', 'oxy'), get_the_author()); ?></h5>
        <?php the_author_meta('description'); ?>
                                </div><!-- .author-description	-->
                            </div><!-- .author-info -->
                        </div>
    <?php
    endif;
endif;
?>	
                <div class="nav-links large-12 medium-12">

                <?php previous_post_link('%link', _x('<i class="dashicons dashicons-arrow-left-alt"></i> %title', 'Previous post link', 'oxy')); ?>
                <?php next_post_link('%link', _x('%title <i class="dashicons dashicons-arrow-right-alt"></i>', 'Next post link', 'oxy')); ?>

                </div><!-- .nav-links -->

                <div class="clear"></div>
                <?php if($smof_data->oxy_general_settings['oxy_related_posts_status'] == 1){?>
                <div class="large-12 medium-12">
                    <div id="blogpostRelated">
                       <h4><?php _e('Related Posts:','oxy')?> </h4>
                    <div class="box-product product-grid">
                        <?php
                            $terms = get_the_terms(get_the_ID(),'category');
                            $categories = array();
                            foreach($terms as $term){
                                $categories[] = $term->term_id;
                            }
                            $loop = new WP_Query(
                                array(
                                    'cat__in'=>$categories,
                                    'showposts' => 4,
                                    'post__not_in' =>array(get_the_ID()),
                                    'ignore_sticky_posts' => true,
                                    'orderby'=>'rand'
                                    )
                                );

                            if ( $loop->have_posts() ){
                                while ( $loop->have_posts() ){
                                  $loop->the_post();
                                    ?>
                                 <div class="relProduct columns relblogpost">
                                 
                                 <div class="image"><a href="<?php the_permalink(); ?>">
                                    <?php  if(has_post_thumbnail()) {  ?>
                                    <?php the_post_thumbnail(array(300,400)); ?> 
                                    <?php } ?>
                                  </a></div>
                                  <div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                  <div class="desc"><p><?php echo substr(get_the_excerpt(),0,80); ?></p></div>
                                  <div class="cart"><a class="button" href="<?php the_permalink(); ?>"><span><?php _e('Read More..','oxy')?></span></a></div>
                                  </div>
                            <?php   }
                                wp_reset_query();
                            }
                        ?>
                    </div>
                    </div>
                </div>
                <?php }?>
<?php comments_template(); ?>

        </div><!--#content -->
        <aside id="column-right" class="large-3 medium-3 columns <?php echo $rightbar?>">
        <?php get_sidebar('right'); ?>
        </aside> 
    </div><!--.row -->
</section><!--.container -->
<?php get_footer(); ?>