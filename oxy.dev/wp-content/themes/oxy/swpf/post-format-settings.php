<?php
add_action( 'add_meta_boxes', 'oxy_resgister_post_meta_box' );
function oxy_resgister_post_meta_box() {
    $screens = array( 'post' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'oxy_post_meta_box',
            __( 'Post Format Features', 'oxy' ),
            'oxy_post_meta_box_cb',
            $screen,
            'normal',
            'core'
        );
    }
}

function oxy_post_meta_box_cb(){
	
	global $post;
	?>
    <style type="text/css">
		.oxy_post_format_manager > div{
			display:none;
			padding:20px 8%;
		}
		.oxy_post_format_manager input[type=text]{
			width:210px;	
		}
		.oxy_post_format_manager tr td:first-child{
			text-align:right;	
		}
		
	</style>
	<script type="text/javascript">
		jQuery(function($){
			$('input.post-format').each(function(){
                            if($(this).is(':checked')){					
                                $('.oxy_post_format_manager > div.'+$(this).attr('id')).show();
                            }
			});
			
			$('input.post-format').click(function(){
                            $(".oxy_post_format_manager > div").hide();
                            $('.oxy_post_format_manager > div.'+$(this).attr('id')).show();
			});
                        
                        /*
                         * 
                         * ui-shortable for gallery oxy theme
                         * 
                         */
                        getSort = function(obj){                            
                            var order = '', c = 0;
                            obj.find('li').each(function(){                                    
                                c++;
                                order += $(this).find('img').attr('id');
                                if(c < obj.find('li').length){
                                    order += ',';
                                }
                            });                            
                            return order;
                        }                        
                        $('.post-format-gallery ul.widget').sortable({                            
                            update :function(){
                                var sortval = '';                                
                                sortval = getSort($(this));                                
                                $('.post-format-gallery #oxy-gallery').val(sortval);
                            }
                        });
                        
                        
                        /*
                         * @wp media
                         * 
                         */
                        var file_frame;

			$(document).on( 'click', '.post-format-gallery .add_image', function( event ){
				
				event.preventDefault();
				
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					file_frame.open();
					return;
				}
				
				file_frame = wp.media.frames.downloadable_file = wp.media({
					title: '<?php _e( 'Choose an image', 'oxy' ); ?>',
					button: {
						text: '<?php _e( 'Insert image', 'oxy' ); ?>',
					},
					multiple: false
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
                                
					var attachment = file_frame.state().get('selection').first().toJSON();

                                        var sortval = '';
					//$('#wcm_sds_brand_logo').val( attachment.id );				
					
					$('.post-format-gallery .widget')
                                                .append('<li><img id="'+attachment.id+
                                                '" src="'+attachment.url+'" width="150" height="150" />'+
                                                '<span class="remove_item"></span>'+
                                                '</li>');
					                                
                                        sortval = getSort($('.post-format-gallery .widget'));                                        
                                        $('.post-format-gallery #oxy-gallery').val(sortval);
                                        
                                        
					//jQuery('.remove_image_button').show();
				});
				
				// Finally, open the modal.
				file_frame.open();
				
				return false;  
				
				
			});
			
			jQuery(document).on( 'click', '.remove_item', function( event ){
				
				var sortval = '';				
                                $(this).parent().remove();
                                
                                sortval = getSort($('.post-format-gallery .widget'));                                        
                                $('.post-format-gallery #oxy-gallery').val(sortval);
                                
				return false;
				
			});
                        
                        
                        
                        
		})
	</script>
    
    
    <div class="oxy_post_format_manager">
        <style type="text/css">
            .post-format-gallery > h4{
               background: none;
               margin-bottom:15px;
               font-size: 18px;
            }
             .post-format-gallery > ul.widget{ 
                list-style-type: none; 
                margin: 0 0 15px; 
                padding: 0;
                width: 100%;
                border: none;
                background: none;
                box-shadow: none;
                display: inline-block;
             }
            .post-format-gallery > ul.widget li { 
                margin: 3px 3px;
                display: inline-block;
                padding: 1px;
                border:1px solid #000;
                width: 150px;
                height: 150px;
                font-size: 4em;
                text-align: center;
                position: relative;
            }
            .post-format-gallery > ul.widget li:hover{
                cursor: move;
            }
            .post-format-gallery > ul.widget li .remove_item{
                width:16px;
                height: 16px;
                position: absolute;
                top: 5px;
                right:5px;
                display:none;
                background: url('<?php echo get_template_directory_uri() ?>/image/close.png') no-repeat;
                transition:all 0.2s ease-in;
            }
            .post-format-gallery > ul.widget li .remove_item:hover{
                cursor: pointer;
            }
            .post-format-gallery > ul.widget li:hover .remove_item{
                display:block;
            }
            
        </style>
        
        
    	<div class="post-format-audio">
        
        </div>
        <div class="post-format-gallery"> 
            <h4>Upload Gallery</h4>
            <ul class="widget">
            <?php 
            $galleries = get_post_meta($post->ID,'oxy-gallery',true);
            
            if(!empty($galleries)){
                $galleries = explode(',', $galleries);
                ?>
                
                <?php
                    foreach($galleries as $gallery){
                        $gallery = intval($gallery);
                        //$attach_page_link = get_attachment_link($gallery);
                        $attach_image_src = wp_get_attachment_image_src($gallery,'thumbnail');
                ?>
                    <li>
                        <img id="<?php echo $gallery;?>" src="<?php echo $attach_image_src[0];?>" />
                        <span class="remove_item"></span>
                    </li>    
                <?php        
                    }
                ?>
               
            <?php
            }

            ?>
            </ul>
            <input type="hidden" name="oxy-gallery" id="oxy-gallery" value="<?php echo get_post_meta($post->ID,'oxy-gallery',true)?>"  />
            <input type="button" class="button button-primary add_image" value="Add New" />
        </div>       
        <div class="post-format-link">
            <div>
                <div style="width:35%;">
                    <label for="link-title">Title:</label>
					
                </div>
                <div style="width:65%;">
                    <input type="text" name="oxy-link-title" value="<?php echo get_post_meta($post->ID,'oxy-link-title',true)?>" />    
                </div>
            </div>
            <div>
                <div style="width:35%;">    
                    <label for="link-title">Link:</label>
                </div>
                <div style="width:65%;">    
                    <textarea rows="3" cols="50" name="oxy-link"><?php echo get_post_meta($post->ID,'oxy-link',true)?></textarea>
                </div>
            </div>
        </div>
        <div class="post-format-quote">
        	<div>
                <div style="width:35%;">
                    <label for="link-title">Quote By:</label>
					
                </div>
                <div style="width:65%;">
                    <input type="text" name="oxy-quote-author" value="<?php echo get_post_meta($post->ID,'oxy-quote-author',true)?>" />
    
                </div>
            </div>
            <div>
                <div style="width:35%;">
                    <label for="link-title">Quote Author Link:</label>
					
                </div>
                <div style="width:65%;">
                    <input type="text" name="oxy-quote-author-link" value="<?php echo get_post_meta($post->ID,'oxy-quote-author-link',true)?>" />
    
                </div>
            </div>
            <div>
                <div style="width:35%;">    
					<label for="link-title">Quote:</label>                   
                </div>
                <div style="width:65%;">    
                    <textarea rows="3" cols="50" name="oxy-quote"><?php echo get_post_meta($post->ID,'oxy-quote',true)?></textarea>
                </div>
            </div>
        
        </div>
        <div class="post-format-video">
        	<div>
                <div style="width:35%;">    
                    <label for="link-title">Video Markup:</label>                   
                </div>
                <div style="width:65%;">    
                    <textarea rows="3" cols="50" name="oxy-video-link"><?php echo get_post_meta($post->ID,'oxy-video-link',true)?></textarea>
                </div>
            </div>
        </div>
    
    </div>
    
    <?php
}

function save_oxy_post_meta(){
	
	global $post,$post_type;	
	if($post_type != 'post' || !isset($post->ID)) return;	
	
	foreach($_POST as $key=>$value):	
            if(strpos($key,'oxy')!==FALSE){
                delete_post_meta($post->ID, $key);
                update_post_meta($post->ID,$key,$value,true);			
            }	
	endforeach;
		
}

add_action('save_post','save_oxy_post_meta');


function oxy_post_meta_box_scripts(){
	
	//wp_enqueue_script('jquery');
        
        wp_enqueue_script(array('jquery-ui-core','jquery-ui-sortable'),'',array('jquery'));
        
        wp_enqueue_media();
		
}


add_action('admin_enqueue_scripts','oxy_post_meta_box_scripts');

