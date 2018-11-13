<div class="st-create">
    <h2><?php echo __('Add new rental room', ST_TEXTDOMAIN); ?></h2>
</div>
<div class="msg">
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field('user_setting','st_insert_rental_room'); ?>
    <div class="form-group form-group-icon-left">
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <label><?php echo __('Room Name', ST_TEXTDOMAIN); ?></label>
        <input id="title" name="title" type="text" placeholder="<?php st_the_language('user_create_room_title') ?>" class="form-control" value="">
        <div class="st_msg console_msg_title"></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php  st_the_language('user_create_room_content') ?></label>
        <?php wp_editor('','st_content'); ?>
    </div>
    <div class="form-group">
        <label><?php st_the_language('user_create_room_description') ?></label>
        <textarea id="desc" name="desc" class="form-control"></textarea>
        <div class="st_msg console_msg_desc"></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php _e("Featured Image",ST_TEXTDOMAIN) ?></label>
        <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="featured-image"  type="file" >
                    </span>
                </span>
            <input type="text" readonly="" value="" class="form-control data_lable">
        </div>
        <input id="id_featured_image" name="id_featured_image" type="hidden" value="">
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
                                    ?>
                                    <div class="col-md-3">
                                        <div class="checkbox-inline checkbox-stroke">
                                            <label>
                                                <i class="<?php echo esc_html($icon) ?>"></i>
                                                <input name="taxonomy[]" class="i-check" type="checkbox" value="<?php echo esc_attr($k.','.$taxonomy_name) ?>" /><?php echo esc_html($v) ?>
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
                <input type="text" name="room_parent" placeholder="<?php st_the_language('user_create_room_search') ?>" id="room_parent" class="st_post_select" data-author="<?php echo esc_attr($data->ID)?>" data-post-type="st_rental" style="width: 100%">
                <div class="st_msg console_msg_room_parent"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Adults Number",ST_TEXTDOMAIN) ?></label>
                <input id="adult_number" name="adult_number" type="text" placeholder="<?php _e("Adults Number",ST_TEXTDOMAIN) ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Children Number",ST_TEXTDOMAIN) ?></label>
                <input id="children_number" name="children_number" type="text" placeholder="<?php _e("Children Number",ST_TEXTDOMAIN) ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Beds Number",ST_TEXTDOMAIN) ?></label>
                <input id="bed_number" name="bed_number" type="text" placeholder="<?php _e("Beds Number",ST_TEXTDOMAIN) ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Room footage (square feet)",ST_TEXTDOMAIN) ?></label>
                <input id="room_footage" name="room_footage" type="text" placeholder="<?php _e("Room footage (square feet)",ST_TEXTDOMAIN) ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Room Description",ST_TEXTDOMAIN) ?></label>
                <input id="room_description" name="room_description" type="text" placeholder="<?php _e("Room Description",ST_TEXTDOMAIN) ?>" class="form-control">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo __('Gallery Style', ST_TEXTDOMAIN); ?></label>
                <select name="gallery_style" id="" class="form-control">
                    <option value="slide"><?php echo __('Slide', ST_TEXTDOMAIN); ?></option>
                    <option value="grid"><?php echo __('Grid', ST_TEXTDOMAIN); ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_create_hotel_gallery') ?></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-primary btn-file multiple">
                            <?php _e("Browse…",ST_TEXTDOMAIN) ?> <input name="gallery[]" id="gallery" multiple  type="file" >
                        </span>
                    </span>
                    <input type="text" readonly="" value="" class="form-control data_lable">
                </div>
            </div>
        </div>

    </div>
    <input name="btn_insert_post_type_rental_room" id="btn_insert_rental_room" type="submit"  class="btn btn-primary" value="SUBMIT">
</form>