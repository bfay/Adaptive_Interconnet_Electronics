<?php

class Oxy_product_slider_options_page {

    public function ajax_responder($data = '') {
        global $wpdb;

        $filter = $_GET['filter_name'];

        if (!empty($filter))
            $filter = urldecode($filter);
     

        $posts = $wpdb->get_results("select * from $wpdb->posts where post_type = 'product' and post_status = 'publish' and post_title like '%{$filter}%'");


        $dataarr = array();

        foreach ($posts as $post):

            $attach_id = get_post_thumbnail_id($post->ID);
            
            if (!empty($attach_id)):

                $image = wp_get_attachment_image_src($attach_id, array(50, 50));

                $image = $image[0];

            else:

                $image = SWPF_THEME_URI.'/image/no_image-50x50.jpg';

            endif;


            $dataarr[] = array(
                'ID' => $post->ID,
                'name' => $post->post_title,
                'thumb' => $image
            );

        endforeach;

        $output = json_encode($dataarr);

        header('Content-Type: application/json');

        echo $output;

        die();
    }

    public function product_slider_options_callback() {

        if (!isset($_POST['p_id'])) {

            $products = 0;

            $output_products = '';
        } else {

            $products = $_POST['p_id'];

            $output_products = json_encode($products);
        }

        if (isset($_POST['add_product'])) {

            $option_name = 'oxy_product_slider';

            $new_value = $output_products;

            update_option($option_name, $output_products);

            die("<script type='text/javascript'>
				window.location.href = '" . admin_url('themes.php?page=oxy-product-slider') . "';
			</script>");
        }
        ?>
        <h2>Products Banner Slider.</h2>
        <style>
            #slides li {
                list-style: none;
                margin: 0 0 4px 0;
                padding: 10px;
                background-color: #F4E6C9;
                border: #CCCCCC solid 1px;
                color:#000;
            }
        </style>
        <style type="text/css">
            .scrollbox {
                background: none repeat scroll 0 0 #FFFFFF;
                border: 1px solid #CCCCCC;
                height: 170px;
                overflow-y: scroll;
                width: 350px;
            }

            .scrollbox div.even {
                background: none repeat scroll 0 0 #FFFFFF;
            }
            .scrollbox div {
                width:97%;
                float:left;
                padding: 3px;
            }
            .scrollbox div.odd {
                background: none repeat scroll 0 0 #E4EEF7;
            }
            .scrollbox i.del {
                cursor: pointer;
                float: right;
            }
            .scrollbox div input {
                margin: 0 3px 0 0;
                padding: 0;
            }
           
        </style>
        <fieldset>
            <legend><i class="dashicons dashicons-format-gallery"></i> Slider configuration</legend>
            <form action="<?php echo admin_url('themes.php?page=oxy-product-slider&save_product_slider_data=true') ?>" method="post" enctype="multipart/form-data" id="form">
                <table class="form">
                    <tbody><tr>
                            <td>Products:<br><span class="help">(Autocomplete)</span></td>
                            <td><input type="text" role="textbox" class="ui-autocomplete-input" name="product" id="product_auto_comple" value=""></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>   
                                <div id="oxy_product_slider-product" class="scrollbox">
                                    <?php
                                    $oxy_product_slider = json_decode(get_option('oxy_product_slider'), true);

                                    if (!empty($oxy_product_slider)) :

                                        $args = array('post_type' => 'product', 'post__in' => $oxy_product_slider, 'posts_per_page' => -1);

                                        $q = new WP_Query($args);
                                        if ($q->have_posts()):
                                            $i = 0;
                                            while ($q->have_posts()) : $q->the_post();
                                                ?>
                                                <div class="oxy_product_slider-product <?php echo ($i % 2 == 0) ? 'even' : 'odd'; ?>" id="oxy_product_slider-product<?php echo get_the_ID(); ?>">
                                                    <?php
                                                    $product = get_product(get_the_ID());

                                                    $attaches = $product->get_gallery_attachment_ids();

                                                    if (!empty($attaches)):

                                                        $image = wp_get_attachment_image_src($attaches[0], array(50, 50));

                                                        $image = $image[0];

                                                    endif;
                                                    ?>
                                                    <img src="<?php echo $image ?>" width="50" height="50" style="float:left;" />

                                                    <span>
                                                        <?php echo the_title(); ?><i class="del dashicons dashicons-dismiss"></i><input type="hidden" name="p_id[]"  value="<?php echo get_the_ID(); ?>"></span>
                                                </div>

                                                <?php
                                                $i++;
                                            endwhile;
                                        endif;
                                    // Reset Query
                                    //wp_reset_query();

                                    endif;
                                    ?></div>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <input type="submit" value="Submit" id="button" class="button-primary" name="add_product">

            </form>

            <script type="text/javascript">
                jQuery(function($) {

                    var ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";


                    $("#product_auto_comple").autocomplete({
                        delay: 0,
                        minLength: 3,
                        selectFirst: false,
                        scroll: false,
                        source: function(request, response) {
                            
                            $.ajax({
                                url: ajaxurl,
                                data: {filter_name: encodeURIComponent(request.term), id_lang: 1, action: 'ajax_responder'},
                                dataType: 'json',
                                success: function(json) {

                                    response($.map(json, function(item) {
                                        return {
                                            label: item.name,
                                            value: item.ID,
                                            thumb: item.thumb
                                        };
                                    })
                                    );
                                }
                            });

                        },
                        select: function(event, ui) {
                            $("#oxy_product_slider-product" + ui.item.value).remove();

                            $("#oxy_product_slider-product").append("<div class = 'oxy_product_slider-product' id='oxy_product_slider-product" + ui.item.value + "' ><img src='" + ui.item.thumb + "' width='50' height='50' style='float:left;' /><span>" + ui.item.label + "<i class=\'del dashicons dashicons-dismiss\'></i><input type=\'hidden\' name=\'p_id[]\' value=" + ui.item.value + " /></span></div>");

                            $("#oxy_product_slider-product div:odd").attr("class", "oxy_product_slider-product odd");
                            $("#oxy_product_slider-product div:even").attr("class", "oxy_product_slider-product even");

                            var data = $.map($("#oxy_product_slider-product input"), function(element) {
                                return $(element).attr("value");
                            });

                            $("input[name=\'oxy_product_slider_product\']").attr("value", data.join());

                            return false;

                        }
                    });

                    $(document.body).on("click",'#oxy_product_slider-product div .del', function() {

                        $(this).parents('.oxy_product_slider-product').remove();

                        $("#oxy_product_slider-product div:odd").attr("class", "oxy_product_slider-product odd");
                        $("#oxy_product_slider-product div:even").attr("class", "oxy_product_slider-product even");

                        var data = $.map($("#oxy_product_slider-product input"), function(element) {
                            return $(element).attr("value");
                        });

                        $("input[name='oxy_product_slider_product']").attr("value", data.join());
                    });
                });
            </script>
        </fieldset>

        <?php
    }

}

function add_jquery_to_oxy_product_slider_options_page() {

    wp_enqueue_script(array('jquery', 'jquery-ui-core', 'jquery-ui-autocomplete'));
    //wp_enqueue_style('autocomplete-css',get_template_directory_uri().'/css/jquery.autocomplete.css');
    wp_enqueue_style('dashicons');
}

function add_oxy_product_slider_menu() {

    $obj = new Oxy_product_slider_options_page;

    add_theme_page('Product Slider', 'Product Slider', 'edit_theme_options', 'oxy-product-slider', array($obj, 'product_slider_options_callback'));
}

$obj = new Oxy_product_slider_options_page;

add_action('admin_menu', 'add_oxy_product_slider_menu');

add_action('admin_enqueue_scripts', 'add_jquery_to_oxy_product_slider_options_page');

add_action('wp_ajax_ajax_responder', array($obj, 'ajax_responder'));

