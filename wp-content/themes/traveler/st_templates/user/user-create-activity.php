<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create activity
 *
 * Created by ShineTheme
 *
 */
?>
<div class="st-create">
    <h2><?php st_the_language( 'user_create_activity' ) ?></h2>
</div>
<div class="msg">
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field( 'user_setting' , 'st_insert_post_activity' ); ?>
    <div class="form-group form-group-icon-left">
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <label><?php st_the_language( 'user_create_activity_title' ) ?></label>
        <input id="title" name="title" type="text"
               placeholder="<?php st_the_language( 'user_create_activity_title' ) ?>" class="form-control">

        <div class="st_msg console_msg_title"></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php st_the_language( 'user_create_activity_content' ) ?></label>
        <?php wp_editor( '' , 'st_content' ); ?>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php st_the_language( 'user_create_activity_description' ) ?></label>
        <textarea id="desc" name="desc" class="form-control"></textarea>

        <div class="st_msg console_msg_desc"></div>
    </div>
    <div class="form-group form-group-icon-left">
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
        <label><?php _e( "Featured Image" , ST_TEXTDOMAIN ) ?></label>

        <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        <?php _e( "Browse…" , ST_TEXTDOMAIN ) ?> <input name="featured-image" type="file">
                    </span>
                </span>
            <input type="text" readonly="" value="" class="form-control data_lable">
        </div>
    </div>


    <h4><?php st_the_language( 'user_create_activity_general' ) ?></h4>

    <div class="row">
        <?php
        $taxonomies = (get_object_taxonomies('st_activity'));
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
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-envelope-o input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_email' ) ?></label>
                <input id="email" name="email" type="email"
                       placeholder="<?php st_the_language( 'user_create_activity_email' ) ?>" class="form-control">

                <div class="st_msg console_msg_email"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-phone input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_phone' ) ?></label>
                <input id="phone" name="phone" type="phone"
                       placeholder="<?php st_the_language( 'user_create_activity_phone' ) ?>" class="form-control">

                <div class="st_msg console_msg_email"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-wordpress input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_website' ) ?></label>
                <input id="website" name="website" type="website"
                       placeholder="<?php st_the_language( 'user_create_activity_website' ) ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-youtube input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_video' ) ?></label>
                <input id="video" name="video" type="text"
                       placeholder="<?php st_the_language( 'user_create_activity_video' ) ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_style_gallery' ) ?></label>
                <select id="gallery_style" name="gallery_style" class="form-control">
                    <option selected="selected"
                            value="grid"><?php st_the_language( 'user_create_activity_grid' ) ?></option>
                    <option value="slider"><?php st_the_language( 'user_create_activity_slider' ) ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language( 'user_create_activity_gallery' ) ?></label>
                <input id="gallery" name="gallery[]" type="file" multiple class="">

                <div class="st_msg console_msg_email"></div>
            </div>
        </div>
    </div>
    <h4><?php st_the_language( 'user_create_activity_location' ) ?></h4>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language( 'user_create_activity_location' ) ?></label>
                <div id="setting_multi_location" class="location-front">
                    <select  placeholder="<?php echo __('Select location...'); ?>" tabindex="-1" name="multi_location[]" id="multi_location" class="option-tree-ui-select list-item-post-type" data-post-type="location">
                        <?php 
                            $locations = TravelHelper::getLocationBySession();
                            if(is_array($locations) && count($locations)):
                                foreach($locations as $key => $value):
                        ?>
                        <option value="<?php echo $value->ID; ?>"><?php echo $value->name; ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <!-- <input type="text" name="id_location"
                       placeholder="<?php st_the_language( 'user_create_activity_location_search' ) ?>" id="id_location"
                       class="st_post_select" data-post-type="location" style="width: 100%"> -->

                <div class="st_msg console_msg_id_location"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-home input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_address' ) ?></label>
                <input id="address" name="address" type="text"
                       placeholder="<?php st_the_language( 'user_create_activity_address' ) ?>" class="form-control">

                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-rocket input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_latitude' ) ?></label>
                <input id="map_lat" name="map_lat" type="text"
                       placeholder="<?php st_the_language( 'user_create_activity_latitude' ) ?>" class="form-control">

                <div class="st_msg console_msg_map_lat"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-rocket input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_longitude' ) ?></label>
                <input id="map_lng" name="map_lng" type="text"
                       placeholder="<?php st_the_language( 'user_create_activity_longitude' ) ?>" class="form-control">

                <div class="st_msg console_msg_map_lng"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-plus-square input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_map_zoom' ) ?></label>
                <input id="map_zoom" name="map_zoom" type="text"
                       placeholder="<?php st_the_language( 'user_create_activity_map_zoom' ) ?>" class="form-control"
                       value="13">

                <div class="st_msg console_msg_map_zoom"></div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
    <h4><?php _e("Info",ST_TEXTDOMAIN) ?></h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <label><?php _e("Activity Type") ?></label>
                <select class="form-control" name="type_activity" id="type_activity">
                    <option  value="specific_date"><?php _e('Specific Date',ST_TEXTDOMAIN) ?></option>
                    <option  value="daily_activity"><?php _e('Daily Activity',ST_TEXTDOMAIN) ?></option>
                </select>

                <div class="st_msg console_msg_id_location"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_start_date' ) ?></label>
                <input type="text" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" name="check_in"
                       class="date-pick form-control">

                <div class="st_msg console_msg_id_location"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_end_date' ) ?></label>
                <input type="text" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" name="check_out"
                       class="date-pick form-control">

                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-clock-o input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_activity_time' ) ?></label>
                <input name="activity-time" class="time-pick form-control" type="text"
                       placeholder="<?php st_the_language( 'user_create_activity_activity_time' ) ?>">

                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-clock-o input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_duration' ) ?></label>
                <input type="text" name="duration" class="form-control"
                       placeholder="<?php st_the_language( 'user_create_activity_duration' ) ?>">

                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language( 'user_create_activity_venue_facilities' ) ?></label>
                <textarea class="form-control" name="venue-facilities"></textarea>

                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
    </div>
    <h4><?php st_the_language( 'user_create_activity_price' ) ?></h4>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e( "Type Price" , ST_TEXTDOMAIN ) ?></label>
                <select id="type_price" name="type_price" class="form-control">
                    <option selected="selected"
                            value="activity_price"><?php _e( "Price / Activity" , ST_TEXTDOMAIN ) ?></option>
                    <option value="people_price"><?php _e( "Price / Person" , ST_TEXTDOMAIN ) ?></option>
                </select>

                <div class="st_msg console_msg_tour_type"></div>
            </div>
        </div>
        <div class="activity_price">
            <div class="col-md-12">
                <div class="form-group form-group-icon-left">
                    <i class="fa fa-money input-icon input-icon-hightlight"></i>
                    <label><?php st_the_language( 'user_create_activity_price' ) ?></label>
                    <input id="price" name="price" type="text"
                           placeholder="<?php st_the_language( 'user_create_activity_price' ) ?>" class="form-control">

                    <div class="st_msg console_msg_id_location"></div>
                </div>
            </div>
        </div>
        <div class="people_price">
            <div class="col-md-6">
                <div class="form-group form-group-icon-left">
                    <i class="fa fa-money input-icon input-icon-hightlight"></i>
                    <label><?php _e( "Adult Price" , ST_TEXTDOMAIN ) ?></label>
                    <input id="adult_price" name="adult_price" type="text"
                           placeholder="<?php _e( "Adult Price" , ST_TEXTDOMAIN ) ?>" class="form-control">

                    <div class="st_msg console_msg_adult_price"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-icon-left">
                    <i class="fa fa-money input-icon input-icon-hightlight"></i>
                    <label><?php _e( "Child Price" , ST_TEXTDOMAIN ) ?></label>
                    <input id="child_price" name="child_price" type="text"
                           placeholder="<?php _e( "Child Price" , ST_TEXTDOMAIN ) ?>" class="form-control">

                    <div class="st_msg console_msg_child_price"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-star  input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_discount' ) ?></label>
                <input id="discount" name="discount" type="text"
                       placeholder="<?php st_the_language( 'user_create_activity_discount' ) ?>" class="form-control">

                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
        <div class='col-md-12'>
            <div class="form-group form-group-icon-left">
                <i class="fa fa-link  input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_activity_external_booking' ) ?></label>
                <input id="external_url" name="external_url" type="text"
                       placeholder="URL" class="form-control">

                <div class="st_msg console_msg_external"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language( 'user_create_activity_best_price_guarantee' ) ?></label>

                <div class="checkbox checkbox-switch">
                    <label>
                        <input name="best-price-guarantee" class="i-check"
                               type="checkbox"/><?php st_the_language( 'user_create_activity_on_off' ) ?></label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language( 'user_create_activity_best_price_guarantee_text' ) ?></label>
                <textarea class="form-control" name="best-price-guarantee-text"></textarea>
            </div>
        </div>
    </div>
    <?php
    $custom_field = st()->get_option( 'st_activity_unlimited_custom_field' );
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
                                   placeholder="<?php _e( $v[ 'title' ] , ST_TEXTDOMAIN ) ?>" class="form-control">
                        <?php } ?>
                        <?php if($v[ 'type_field' ] == "date-picker") { ?>
                            <input id="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $key ) ?>" type="text"
                                   placeholder="<?php _e( $v[ 'title' ] , ST_TEXTDOMAIN ) ?>"
                                   class="date-pick form-control">
                        <?php } ?>
                        <div class="st_msg console_msg_"></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <input type="button" id="btn_check_insert_activity" class="btn btn-primary"
           value="<?php st_the_language( 'user_create_activity_submit' ) ?>">
    <input name="btn_insert_post_type_activity" id="btn_insert_post_type_activity" type="submit"
           class="btn btn-primary hidden" hidden="" value="SUBMIT">
</form>


<script>
    jQuery(function ($) {
        var type_price = $('#type_price').val();
        if (type_price == 'activity_price') {
            $('.activity_price').show();
            $('.people_price').hide();

        } else {
            $('.activity_price').hide();
            $('.people_price').show();
        }
        $('#type_price').change(function () {
            var type_price = $(this).val();
            if (type_price == 'activity_price') {
                $('.activity_price').show();
                $('.people_price').hide();

            } else {
                $('.activity_price').hide();
                $('.people_price').show();
            }
        });
    });
</script>