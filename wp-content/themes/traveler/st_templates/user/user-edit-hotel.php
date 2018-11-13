<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User Update hotel
 *
 * Created by ShineTheme
 *    value="<?php echo get_post_meta( $post_id , '' , true); ?>"
 */


if( STUser_f::st_check_edit_partner(STInput::request('id')) == false ){
    return false;
}
$post_id = STInput::request('id');
$post = get_post( $post_id );
?>
<div class="st-create">
    <h2><?php _e("Edit Hotel",ST_TEXTDOMAIN) ?></h2>
</div>
<div class="msg">
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field('user_setting','st_update_post_hotel'); ?>
    <div class="form-group form-group-icon-left">
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <label><?php st_the_language('user_create_hotel_title') ?></label>
        <input id="title" name="title" type="text" placeholder="<?php _e("Title",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo esc_html($post->post_title) ?>">
        <div class="st_msg console_msg_title"></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php st_the_language('user_create_hotel_content') ?></label>
        <?php wp_editor( $post->post_content ,'st_content'); ?>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php st_the_language('user_create_hotel_description') ?></label>
        <textarea id="desc" name="desc" class="form-control"><?php echo esc_html($post->post_excerpt) ?></textarea>
        <div class="st_msg console_msg_desc"></div>
    </div>
    <h4><?php st_the_language('user_create_hotel_detail') ?></h4>
    <div class="row">
        <?php
        $taxonomies = (get_object_taxonomies('st_hotel'));
        if (is_array($taxonomies) and !empty($taxonomies)){
            foreach ($taxonomies as $key => $value) {
            ?>
                <div class="col-md-12">
                    <?php

                    $category = STUser_f::get_list_taxonomy($value);
                    $taxonomy_tmp = get_taxonomy( $value );
                    $taxonomy_label =  ($taxonomy_tmp->label );
                    $taxonomy_name =  ($taxonomy_tmp->name );
                    if(!empty($category)):
                        ?>
                        <div class="form-group form-group-icon-left">
                            <label> <?php echo esc_html($taxonomy_label); ?></label>
                            <div class="row">
                                <?php foreach($category as $k=>$v):
                                    $icon = get_tax_meta($k,'st_icon');
                                    $icon = TravelHelper::handle_icon($icon);

                                    $check = '';
                                    if(STUser_f::st_check_post_term_partner( $post_id  ,$value , $k) == true ){
                                        $check = 'checked';
                                    }
                                    ?>
                                    <div class="col-md-3">
                                        <div class="checkbox-inline checkbox-stroke">
                                            <label>
                                                <i class="<?php echo esc_html($icon) ?>"></i>
                                                <input name="taxonomy[]" class="i-check" type="checkbox" <?php echo esc_html($check) ?>  value="<?php echo esc_attr($k.','.$taxonomy_name) ?>" /><?php echo esc_html($v) ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            <?php
            }
        }
        ?>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-envelope-o input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_email') ?></label>
                <input id="email" name="email" type="email" placeholder="<?php st_the_language('user_create_hotel_email') ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'email' , true); ?>">
                <div class="st_msg console_msg_email"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-info-circle input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_website') ?></label>
                <input id="website" name="website" type="text" placeholder="<?php st_the_language('user_create_hotel_website') ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'website' , true); ?>">
                <div class="st_msg console_msg_website"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-phone input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_phone') ?></label>
                <input id="phone" name="phone" type="text" placeholder="<?php st_the_language('user_create_hotel_phone') ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'phone' , true); ?>">
                <div class="st_msg console_msg_phone"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-phone input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_fax_number') ?></label>
                <input id="fax" name="fax" type="text" placeholder="<?php st_the_language('user_create_hotel_fax_number') ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'fax' , true); ?>">
                <div class="st_msg console_msg_fax"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-youtube input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_video') ?></label>
                <input id="video" name="video" type="text" placeholder="<?php st_the_language('user_create_hotel_video') ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'video' , true); ?>">
                <div class="st_msg console_msg_video"></div>
            </div>
        </div>
    </div>
    <h4><?php st_the_language('user_create_hotel_location') ?></h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_create_hotel_location') ?></label>

                <div id="setting_multi_location" class="location-front">
                    <select placeholder="<?php echo __('Select location...'); ?>" tabindex="-1" name="multi_location[]" id="multi_location" class="option-tree-ui-select list-item-post-type" data-post-type="location">
                        <?php 
                            $locations = TravelHelper::getLocationBySession();
                            if(is_array($locations) && count($locations)):
                                foreach($locations as $key => $value):
                        ?>
                        <option value="<?php echo $value->ID; ?>"><?php echo $value->name; ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                  <!-- <input type="text" name="id_location" placeholder="<?php //st_the_language('user_create_rental_search') ?>" id="id_location" class="st_post_select" data-post-type="location" style="width: 100%"> -->
                <div class="st_msg console_msg_id_location"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-home input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_address') ?></label>
                <input id="address" name="address" type="text" placeholder="<?php st_the_language('user_create_hotel_address') ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'address' , true); ?>">
                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-rocket input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_latitude') ?></label>
                <input id="map_lat" name="map_lat" type="text" placeholder="<?php st_the_language('user_create_hotel_latitude') ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'map_lat' , true); ?>">
                <div class="st_msg console_msg_map_lat"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-rocket input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_longitude') ?></label>
                <input id="map_lng" name="map_lng" type="text" placeholder="<?php st_the_language('user_create_hotel_longitude') ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'map_lng' , true); ?>">
                <div class="st_msg console_msg_map_lng"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-plus-square input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_hotel_map_zoom') ?></label>
                <input id="map_zoom" name="map_zoom" type="text" placeholder="<?php st_the_language('user_create_hotel_map_zoom') ?>" class="form-control" value="13" value="<?php echo get_post_meta( $post_id , 'map_zoom' , true); ?>">
                <div class="st_msg console_msg_map_zoom"></div>
            </div>
        </div>
    </div>
    <h4><?php _e("Price",ST_TEXTDOMAIN) ?></h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <?php  $is_auto_caculate =  get_post_meta( $post_id , 'is_auto_caculate' , true) ;?>
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Auto calculate price avg",ST_TEXTDOMAIN) ?></label>
                <select class="form-control" name="is_auto_caculate">
                    <option value="on"  <?php if( $is_auto_caculate == 'on' ) echo 'selected="selected"';?> ><?php _e("Yes",ST_TEXTDOMAIN) ?></option>
                    <option value="off" <?php if( $is_auto_caculate == 'off' ) echo 'selected="selected"';?> ><?php _e("No",ST_TEXTDOMAIN) ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-money input-icon input-icon-hightlight"></i>
                <label><?php _e("Price AVG",ST_TEXTDOMAIN) ?></label>
                <input id="price_avg" name="price_avg" type="text" placeholder="<?php _e("Price AVG",ST_TEXTDOMAIN) ?>" class="form-control"  value="<?php echo get_post_meta( $post_id , 'price_avg' , true); ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class='col-md-12'>
            <div class='form-group form-group-icon-left'>
                <?php if (st()->get_option('partner_set_feature') =="on"){ ?>
                    <i class="fa fa-star input-icon input-icon-hightlight"></i>
                    <label><?php _e(" Set as Featured" , ST_TEXTDOMAIN)?>     </label>
                    <div class='row'>
                        <div class='col-md-4'>
                            <select class='form-control' name='is_featured' >
                                <option value='off'>  &nbsp; &nbsp;&nbsp;&nbsp;No  </option>
                                <option value='on'>  &nbsp; &nbsp;&nbsp;&nbsp;Yes  </option>
                            </select>
                            <i class="fa fa-angle-down input-icon-right"></i>
                        </div>
                    </div>
                    <br>
                <?php }; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php _e("Featured Image",ST_TEXTDOMAIN) ?></label>
                <?php $id_img = get_post_thumbnail_id($post_id);
                $post_thumbnail_id = wp_get_attachment_image_src($id_img, 'full');
                ?>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="featured-image"  type="file" >
                        </span>
                    </span>
                    <input type="text" readonly="" value="<?php echo esc_url($post_thumbnail_id['0']); ?>" class="form-control data_lable">
                </div>
                <input id="id_featured_image" name="id_featured_image" type="hidden" value="<?php echo esc_attr($id_img) ?>">
                <?php
                if(!empty($post_thumbnail_id)){
                    echo '<div class="user-profile-avatar user_seting st_edit">
                            <div><img width="300" height="300" class="avatar avatar-300 photo img-thumbnail" src="'.$post_thumbnail_id['0'].'" alt=""></div>
                            <input name="" type="button"  class="btn btn-danger  btn_featured_image" value="'.st_get_language('user_delete').'">
                          </div>';
                }
                ?>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php _e("Logo",ST_TEXTDOMAIN) ?></label>
                <?php $id_img = get_post_meta($post_id , 'logo',true);
                $post_thumbnail_id = wp_get_attachment_image_src($id_img, 'full');
                ?>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="logo"  type="file" >
                        </span>
                    </span>
                    <input type="text" readonly="" value="<?php echo esc_url($post_thumbnail_id['0']); ?>" class="form-control data_lable">
                </div>
                <input id="id_logo" name="id_logo" type="hidden" value="<?php echo esc_attr($id_img) ?>">
                <?php
                if(!empty($post_thumbnail_id)){
                    echo '<div class="user-profile-avatar user_seting st_edit">
                            <div><img width="300" height="300" class="avatar avatar-300 photo img-thumbnail" src="'.$post_thumbnail_id['0'].'" alt=""></div>
                            <input name="" type="button"  class="btn btn-danger  btn_del_logo" value="'.st_get_language('user_delete').'">
                          </div>';
                }
                ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <label><?php _e("Gallery",ST_TEXTDOMAIN) ?></label>
                <?php $id_img = get_post_meta($post_id , 'gallery',true);?>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="gallery[]" id="gallery" multiple  type="file" >
                        </span>
                    </span>
                    <input type="text" readonly="" value="<?php echo esc_html($id_img) ?>" class="form-control data_lable">
                </div>
                <input id="id_gallery" name="id_gallery" type="hidden" value="<?php echo esc_attr($id_img) ?>">
                <?php
                if(!empty($id_img)){
                    echo '<div class="user-profile-avatar user_seting st_edit"><div>';
                    foreach(explode(',',$id_img) as $k=>$v){
                        $post_thumbnail_id = wp_get_attachment_image_src($v, 'full');
                        echo '<img width="300" height="300" class="avatar avatar-300 photo img-thumbnail" src="'.$post_thumbnail_id['0'].'" alt="">';
                    }
                    echo '</div><input name="" type="button"  class="btn btn-danger  btn_del_gallery" value="'.st_get_language('user_delete').'">
                      </div>';
                }
                ?>
            </div>

        </div>

    </div>
    <?php
    $custom_field = st()->get_option( 'hotel_unlimited_custom_field' );
    if(!empty( $custom_field ) and is_array( $custom_field )) {
        ?>
        <h4><?php _e( "Custom field" ) ?></h4>
        <div class="row">
            <?php
            foreach( $custom_field as $k => $v ) {
                $key   = str_ireplace( '-' , '_' , 'st_custom_' . sanitize_title( $v[ 'title' ] ) );
                $class = 'col-md-12';
                if($v[ 'type_field' ] == "date-picker") {
                    $class = 'col-md-4';
                }
                ?>
                <div class="<?php echo esc_attr( $class ) ?>">
                    <div class="form-group form-group-icon-left">
                        <label><?php _e( $v[ 'title' ] , ST_TEXTDOMAIN ) ?></label>
                        <?php if($v[ 'type_field' ] == "text") { ?>
                            <input id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text"
                                   placeholder="<?php _e( $v[ 'title' ] , ST_TEXTDOMAIN ) ?>" class="form-control" value="<?php echo get_post_meta( $post_id , $key , true); ?>">
                        <?php } ?>
                        <?php if($v[ 'type_field' ] == "date-picker") { ?>
                            <input id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text"
                                   placeholder="<?php _e( $v[ 'title' ] , ST_TEXTDOMAIN ) ?>"
                                   class="date-pick form-control" <?php echo get_post_meta( $post_id , $key , true); ?>>
                        <?php } ?>
                        <div class="st_msg console_msg_"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <input  type="button" id="btn_check_insert_post_type_hotel"  class="btn btn-primary" value="<?php _e("Update",ST_TEXTDOMAIN) ?>">
    <input name="btn_update_post_type_hotel" id="btn_insert_post_type_hotel" type="submit"  class="btn btn-primary hidden" hidden="" value="<?php _e("Update",ST_TEXTDOMAIN) ?>">
</form>
