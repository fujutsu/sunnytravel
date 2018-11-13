<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single room
 *
 * Created by ShineTheme
 *
 */
get_header();?>
<?php get_template_part('breadcrumb'); ?>
<?php 
    if(has_post_thumbnail())
        $thumb_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

    $gallery=get_post_meta(get_the_ID(),'gallery',true);
    $gallery_array=explode(',',$gallery);
    $fancy_arr = array();
    if(is_array($gallery_array) and !empty($gallery_array)){
        foreach($gallery_array as $key=>$value){
            $img_link=wp_get_attachment_image_src($value,array(800,600,'bfi_thumb'=>true));
            $fancy_arr[] = array(
                'href' => $img_link[0],
                'title' => ''
                );
        }
    }

?>
<div id="single-room"  class="booking-item-details">
    <div class="thumb">
        <a href="javascript:;" id="fancy-gallery">
            <?php the_post_thumbnail(array(1600, 500, 'bfi_thumb' => TRUE), array('class'=> 'fancy-responsive')) ?>
        </a>
    </div>
	<?php
        $layout = st()->get_option('hotel_single_room_layout','');
        if(get_post_meta(get_the_ID(), 'st_custom_layout', true))
            $layout = get_post_meta(get_the_ID(), 'st_custom_layout', true);
        if($layout && !empty($layout))
        {
            echo STTemplate::get_vc_pagecontent($layout);
            
        }else{
            echo do_shortcode('
                [vc_row][vc_column width="2/3"][st_hotel_room_header][st_hotel_room_facility facility_des="" choose_taxonomies="room_type"][st_hotel_room_gallery style="slide"][/vc_column][vc_column width="1/3"][st_hotel_room_sidebar][/vc_column][/vc_row][vc_row full_width="" parallax="" parallax_image="" row_fullwidth="no" parallax_class="no" bg_video="no" row_id=""][vc_column width="1/1" css=".vc_custom_1435226180968{margin-top: 20px !important;}"][vc_column_text]
<h4>Reviews</h4>
[/vc_column_text][st_hotel_room_review][/vc_column][/vc_row]
            ');
        }
    ?>
</div>
<?php 
    if(is_array($fancy_arr) && count($fancy_arr)):
?>
    <script>
        jQuery(document).ready(function($) {
            $('a#fancy-gallery').click(function(event) {
                var list = <?php echo json_encode($fancy_arr); ?>;
                $.fancybox.open(list);
            });
        });
    </script>
<?php endif; ?>
<script>
    jQuery(document).ready(function($) {
        $('a.button-readmore').click(function(){
            if($('#read-more').length > 0){
                $('#read-more').removeClass('hidden');
                $(this).addClass('hidden');
                $('#show-description').remove();
            }
        });
    });
</script>
<?php get_footer( ) ?>