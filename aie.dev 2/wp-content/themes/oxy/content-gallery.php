<?php    
    $galleries = get_post_meta(get_the_ID(), 'oxy-gallery', true);
    if (!empty($galleries)) {
        $galleries = explode(',', $galleries);
        ?>
        <div class="flexslider flexshortcode">             
            <ul class="list-unstyled slides">
                <?php
                foreach ($galleries as $gallery) {
                    $gallery = intval($gallery);
                    ?>
                    <li>
                        <a href="<?php echo get_attachment_link($gallery); ?>">
    <?php echo wp_get_attachment_image($gallery, 'full'); ?>
                        </a>
                    </li>
<?php } ?>
            </ul>
        </div>
        <?php
    }
