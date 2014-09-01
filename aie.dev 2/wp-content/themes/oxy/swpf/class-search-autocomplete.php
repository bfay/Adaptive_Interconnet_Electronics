<?php
class Oxy_product_auto_search {

    public static $instance;
    
    public function ajax_responder($data = '') {
        global $wpdb;
        
        $theme_mod = get_oxy_option('oxy-general-settings');
        
        $limit = isset($theme_mod['oxy_header_auto_suggest_limit']) 
                && !empty($theme_mod['oxy_header_auto_suggest_limit'])? (int)$theme_mod['oxy_header_auto_suggest_limit'] :  10;
        
        $filter = $_GET['filter_name'];

        if (!empty($filter))
            $filter = urldecode($filter);

        $posts = $wpdb->get_results("select * from $wpdb->posts where post_type = 'product' and post_status = 'publish' and post_title like '%{$filter}%' LIMIT 0,{$limit}");

        $dataarr = array();
        if(!empty($posts))
        foreach ($posts as $post):

            $product = get_product($post->ID);
            $dataarr[] = array(
                'link' => get_permalink($product->id),
                'name' => $post->post_title,                
            );

        endforeach;
        
        $output = json_encode($dataarr);
        header('Content-Type: application/json');
        echo $output;
        die();
    }

    public function oxy_product_search_callback() {
        global $smof_data;
        if($smof_data->oxy_general_settings['oxy_header_auto_suggest_status'] == 1){
        ?>
        
            <script type="text/javascript">
                jQuery(function($) {

                    var ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";


                    $("#header #searchform #s").autocomplete({
                        delay: 0,
                        minLength: 2,
                        selectFirst: false,
                        scroll: false,
                        source: function(request, response) {
                            
                            $.ajax({
                                url: ajaxurl,
                                data: {filter_name: encodeURIComponent(request.term), action: 'ajax_product_search'},
                                dataType: 'json',
                                success: function(json) {

                                    response($.map(json, function(item) {
                                        return {
                                            label: item.name,
                                            link: item.link,
                                            thumb: item.thumb
                                        }
                                        })
                                    );
                                }
                            });

                        },
                        select: function(event, ui) {

                                window.location.href = ui.item.link;

                            return false;

                        }
                    });

                });
            </script>        
        <?php
        }
    }

    static function get_instance(){
        
        if(empty(self::$instance) 
            or !is_object(self::$instance) 
            or !(self::$instance instanceof Oxy_product_auto_search)){
            
            return self::$instance = new Oxy_product_auto_search();
        }
        
        return self::$instance;
        
    }
    
}

$oxy_auto_search = Oxy_product_auto_search::get_instance();
add_action('wp_footer',array($oxy_auto_search,'oxy_product_search_callback'),20);
add_action('wp_ajax_ajax_product_search', array($oxy_auto_search, 'ajax_responder'));
add_action('wp_ajax_nopriv_ajax_product_search', array($oxy_auto_search, 'ajax_responder'));
