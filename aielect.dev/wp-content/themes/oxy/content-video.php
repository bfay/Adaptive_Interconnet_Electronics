<?php
$videomarkup = get_post_meta(get_the_ID(),'oxy-video-link',true);
if(!empty($videomarkup)){   
?>
<div class="video large-12 medium-12 flex-video">
    <?php echo get_post_meta(get_the_ID(),'oxy-video-link',true)?>
</div>
<?php
}