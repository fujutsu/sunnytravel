<?php
if( STUser_f::st_check_edit_partner(STInput::request('id')) == false ){
    return false;
}
$post_id = STInput::request('id');
$post = get_post( $post_id );
?>
<div class="st-create">
    <h2><?php echo __('Edit rental room', ST_TEXTDOMAIN); ?></h2>
</div>
<div class="msg">
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field('user_setting','st_update_rental_room'); ?>
    <div class="form-group form-group-icon-left">
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <label><?php echo __('Room Name', ST_TEXTDOMAIN); ?></label>
        <input id="title" name="title" type="text" placeholder="<?php st_the_language('user_create_room_title') ?>" class="form-control" value="<?php echo esc_html($post->post_title) ?>">
        <div class="st_msg console_msg_title"></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php  st_the_language('user_create_room_content') ?></label>
        <?php wp_editor( $post->post_content ,'st_content'); ?>
    </div>
    <div class="form-group">
        <label><?php st_the_language('user_create_room_description') ?></label>
        <textarea id="desc" name="desc" class="form-control"><?php echo esc_html($post->post_excerpt) ?></textarea>
        <div class="st_msg console_msg_desc"></div>
    </div>
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
    <div class="row">
        <?php
        $taxonomies = (get_object_taxonomies('rental_room'));
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
                                                <input name="taxonomy[]" class="i-check" <?php echo esc_html($check) ?>  type="checkbox" value="<?php echo esc_attr($k.','.$taxonomy_name) ?>" /><?php echo esc_html($v) ?>
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <label><?php echo __('Select Rental', ST_TEXTDOMAIN); ?></label>
                <?php $room_parent = get_post_meta($post_id , 'room_parent' ,true); ?>
                <input type="text" name="room_parent" placeholder="<?php st_the_language('user_create_room_search') ?>" id="room_parent" data-pl-name="<?php echo get_the_title($room_parent) ?>" data-pl-desc="" value="<?php echo esc_html($room_parent) ?>" class="st_post_select" data-author="<?php echo esc_attr($data->ID)?>" data-post-type="st_rental" style="width: 100%">
                <div class="st_msg console_msg_room_parent"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Adults Number",ST_TEXTDOMAIN) ?></label>
                <input id="adult_number" name="adult_number" type="text" placeholder="<?php _e("Adults Number",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'adult_number' , true); ?>" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Children Number",ST_TEXTDOMAIN) ?></label>
                <input id="children_number" name="children_number" type="text" placeholder="<?php _e("Children Number",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'children_number' , true); ?>" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Beds Number",ST_TEXTDOMAIN) ?></label>
                <input id="bed_number" name="bed_number" type="text" placeholder="<?php _e("Beds Number",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'bed_number' , true); ?>" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Room footage (square feet)",ST_TEXTDOMAIN) ?></label>
                <input id="room_footage" name="room_footage" type="text" placeholder="<?php _e("Room footage (square feet)",ST_TEXTDOMAIN) ?>" class="form-control" value="<?php echo get_post_meta( $post_id , 'room_footage' , true); ?>" >
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Room Description",ST_TEXTDOMAIN) ?></label>
                <textarea id="room_description" name="room_description" class="form-control"><?php echo get_post_meta( $post_id , 'room_description' , true); ?></textarea>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo __('Gallery Style', ST_TEXTDOMAIN); ?></label>
                <?php $gallery_style = get_post_meta($post_id , 'gallery_style' , true) ?>
                <select name="gallery_style" id="" class="form-control">
                    <option <?php if($gallery_style == 'slide') echo 'selected="selected"'; ?> value="slide"><?php echo __('Slide', ST_TEXTDOMAIN); ?></option>
                    <option <?php if($gallery_style == 'grid') echo 'selected="selected"'; ?> value="grid"><?php echo __('Grid', ST_TEXTDOMAIN); ?></option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
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
    <input name="btn_update_post_type_rental_room" id="btn_insert_rental_room" type="submit"  class="btn btn-primary" value="<?php _e("Update",ST_TEXTDOMAIN) ?>">
</form>