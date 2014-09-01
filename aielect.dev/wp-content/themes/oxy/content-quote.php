<?php $quote = get_post_meta(get_the_ID(),'oxy-quote',true);
if(!empty($quote)){
?>
<div class="quote large-12 medium-12">
    <label class="dashicons dashicons-format-quote"></label>    
    <h3><?php echo $quote?></h3>
    <h4><a href="<?php echo get_post_meta(get_the_ID(),'oxy-quote-author-link',true)?>"><?php echo get_post_meta(get_the_ID(),'oxy-quote-author',true)?></a></h4>
</div>
<?php }?>