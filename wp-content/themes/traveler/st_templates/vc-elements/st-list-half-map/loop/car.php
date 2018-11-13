<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element loop 2
 *
 * Created by ShineTheme
 *
 */


$link = st_get_link_with_search( get_permalink() , array(
    'pick-up' ,
    'location_id_pick_up' ,
    'drop-off' ,
    'location_id_drop_off' ,
    'drop-off-time' ,
    'pick-up-time' ,
    'drop-off-date' ,
    'pick-up-date'
) , $_GET );

$info_price = STCars::get_info_price();
$price      = $info_price[ 'price' ];
$count_sale = $info_price[ 'discount' ];
if(!empty( $count_sale )) {
    $price      = $info_price[ 'price' ];
    $price_sale = $info_price[ 'price_old' ];
}
$thumb_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
?>
<div class="div_item_map">
    <div class="st_featured"><?php echo esc_html( $post_type ) ?></div>
    <div class="thumb item_map" data-tag="st_tag_<?php the_ID() ?>">
        <header class="thumb-header">
            <div class="booking-item-img-wrap st-popup-gallery">
                <a href="<?php echo esc_url($thumb_url) ?>" class="st-gp-item">
                    <?php the_post_thumbnail(array(800, 400, 'bfi_thumb' => TRUE)) ?>
                </a>
                <?php
                $count = 0;
                $gallery = get_post_meta(get_the_ID(), 'gallery', TRUE);
                $gallery = explode(',', $gallery);
                if (!empty($gallery) and $gallery[0]) {
                    $count += count($gallery);
                }
                if (has_post_thumbnail()) {$count++;}
                if ($count) {
                    echo '<div class="booking-item-img-num"><i class="fa fa-picture-o"></i>';
                    echo esc_attr($count);
                    echo '</div>';
                }
                ?>
                <div class="hidden">
                    <?php if (!empty($gallery) and $gallery[0]) {
                        $count += count($gallery);
                        foreach ($gallery as $key => $value) {
                            $img_link = wp_get_attachment_image_src($value, array(800, 600, 'bfi_thumb' => TRUE));
                            if (isset($img_link[0]))
                                echo "<a class='st-gp-item' href='{$img_link[0]}'></a>";
                        }
                    } ?>
                </div>
            </div>
        </header>
        <div class="thumb-caption">
            <h5 class="thumb-title">
                <a class="text-darken" href="<?php echo esc_attr( $link ) ?>"><?php the_title() ?></a>
            </h5>
            <?php $category = get_the_terms( get_the_ID() , 'st_category_cars' ) ?>
            <?php
            $txt = '';
            if(!empty( $category )) {
                foreach( $category as $k => $v ) {
                    $txt .= $v->name . ' ,';
                }
                $txt = substr( $txt , 0 , -1 );
            }
            ?>
            <small><?php echo esc_html( $txt ); ?></small>
            <ul class="booking-item-features booking-item-features-small booking-item-features-sign clearfix mt5">
                <?php
                $i             = 0;
                $limit         = st()->get_option( 'car_equipment_info_limit' , 11 );
                $taxonomy      = get_object_taxonomies( 'st_cars' , 'object' );
                $taxonomy_info = get_post_meta( get_the_ID() , 'cars_equipment_info' , true );
                if(!empty( $taxonomy ) and is_array( $taxonomy )) {
                    foreach( $taxonomy as $key => $value ) {
                        if($key != 'st_category_cars') {
                            if($key != 'st_cars_pickup_features') {
                                $data_term = get_the_terms( get_the_ID() , $key , true );
                                if(!empty( $data_term ) and is_array( $data_term )) {
                                    foreach( $data_term as $k => $v ) {
                                        // check taxonomy info
                                        $dk_check = false;
                                        if(is_array( $taxonomy_info )) {
                                            foreach( $taxonomy_info as $k_info => $v_info ) {
                                                if(!empty( $v_info[ 'cars_equipment_taxonomy_id' ] )) {
                                                    if($v->term_id == $v_info[ 'cars_equipment_taxonomy_id' ]) {
                                                        $dk_check        = true;
                                                        $data_info       = $v_info[ 'cars_equipment_taxonomy_info' ];
                                                        $data_title_info = "";
                                                        if(!empty( $v_info[ 'title' ] ))
                                                            $data_title_info = $v_info[ 'title' ];
                                                    }
                                                }
                                            }
                                        }
                                        if($i < $limit) {
                                            if($dk_check == true) {
                                                echo '<li title="" data-placement="top" rel="tooltip" data-original-title="' . $data_title_info . '">
                                                                        <i class="' . TravelHelper::handle_icon( get_tax_meta( $v->term_id , 'st_icon' , true ) ) . '"></i>
                                                                        <span class="booking-item-feature-sign">' . $data_info . '</span>
                                                                    </li>';
                                            } else {
                                                /*echo '<li title="" data-placement="top" rel="tooltip" data-original-title="'.esc_html($v->name).'">
                                                                    <i class="'.TravelHelper::handle_icon(get_tax_meta($v->term_id, 'st_icon',true)).'"></i>
                                                              </li>';*/
                                            }
                                        }
                                        $i++;
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
            </ul>
            <div class="item_price_map cars">
                <?php if(!empty( $count_sale )) { ?>
                    <span class="text-small lh1em  onsale">
                                    <?php echo TravelHelper::format_money( $price_sale ) ?>
                                </span>
                <?php } ?>
                <?php
                if(!empty( $price )) {
                    echo '<span class="text-darken mb0 text-color">' . TravelHelper::format_money( $price ) . '<small> /' . strtolower( STCars::get_price_unit( 'label' ) ) . '</small></span>';
                }
                ?>
            </div>
            <a class="btn btn-primary" href="<?php echo esc_url(get_permalink())?>"><?php _e("Book Now",ST_TEXTDOMAIN) ?></a>
            <button class="btn btn-default pull-right close_map" ><?php _e("Close",ST_TEXTDOMAIN) ?></button>
            <?php echo st()->load_template('user/html/html_add_wishlist',null,array("title"=>'','class'=>'btn-default pull-right')) ?>
        </div>
        <script>
            jQuery(function($){
                $('.st_list_half_map .div_item_map').hide();
                $('.st_list_half_map .div_item_map').fadeIn(1000);
                $('.close_map').click(function(){
                    $(this).parent().parent().parent().fadeOut(500);
                });
                $('.st-popup-gallery').each(function () {
                    $(this).magnificPopup({
                        delegate: '.st-gp-item',
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                    });
                });
            })
        </script>
    </div>
    <div class="gap"></div>
</div>


