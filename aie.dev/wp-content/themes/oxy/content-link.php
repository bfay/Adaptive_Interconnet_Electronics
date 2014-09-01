<?php $linktitle = get_post_meta(get_the_ID(),'oxy-link-title',true);
if(!empty($linktitle)){
?>

<div class="link large-12 medium-12">
    <label class="dashicons dashicons-admin-links"></label><h3><a href="<?php echo get_post_meta(get_the_ID(),'oxy-link',true)?>"><?php echo $linktitle?></a></h3>
</div>
<?php }?>