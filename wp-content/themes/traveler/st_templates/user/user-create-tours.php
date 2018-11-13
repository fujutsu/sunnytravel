<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User create tours
 *
 * Created by ShineTheme
 *
 */
?>
<div class="st-create">
    <h2><?php st_the_language('user_create_tour') ?></h2>
</div>
<div class="msg">
    <?php echo STUser_f::get_msg(); ?>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <?php wp_nonce_field('user_setting','st_insert_post_tours'); ?>
    <div class="form-group form-group-icon-left">
        <i class="fa  fa-file-text input-icon input-icon-hightlight"></i>
        <label><?php st_the_language('user_create_tour_title') ?></label>
        <input id="title" name="title" type="text" placeholder="<?php st_the_language('user_create_tour_title') ?>" class="form-control">
        <div class="st_msg console_msg_title"></div>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php st_the_language('user_create_tour_content') ?></label>
        <?php wp_editor('','st_content'); ?>
    </div>
    <div class="form-group form-group-icon-left">
        <label><?php st_the_language('user_create_tour_description') ?></label>
        <textarea id="desc" name="desc" class="form-control"></textarea>
        <div class="st_msg console_msg_desc"></div>
    </div>
    <div class="form-group form-group-icon-left">
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
        <label> <?php st_the_language('user_create_tour_featured_image') ?></label>
        <input id="featured-image" name="featured-image" type="file" class="">
    </div>
    <h4><?php st_the_language('user_create_tour_general') ?></h4>
    <div class="row">
        <?php
        $taxonomies = (get_object_taxonomies('st_tours'));
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
                <label><?php st_the_language('user_create_tour_email') ?></label>
                <input id="email" name="email" type="email" placeholder="<?php st_the_language('user_create_tour_email') ?>" class="form-control">
                <div class="st_msg console_msg_email"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-youtube input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_tour_video') ?></label>
                <input id="video" name="video" type="text" placeholder="<?php st_the_language('user_create_tour_video') ?>" class="form-control">
                <div class="st_msg console_msg_email"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_tour_style_gallery') ?></label>
                <select id="gallery_style" name="gallery_style" class="form-control">
                    <option selected="selected" value="grid"><?php st_the_language('user_create_tour_grid')?></option>
                    <option value="slider"><?php st_the_language('user_create_tour_slider') ?></option>
                </select>
                <div class="st_msg console_msg_email"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_create_tour_gallery') ?></label>
                <input id="gallery" name="gallery[]" type="file" multiple class="">
                <div class="st_msg console_msg_email"></div>
            </div>
        </div>
    </div>
    <h4><?php st_the_language('user_create_tour_location') ?></h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_create_tour_location') ?></label>
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
                <!-- <input type="text" name="id_location" placeholder="<?php st_the_language('user_create_tour_location_search') ?>" id="id_location" class="st_post_select" data-post-type="location" style="width: 100%"> -->
                <div class="st_msg console_msg_id_location"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-home input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_tour_address') ?></label>
                <input id="address" name="address" type="text" placeholder="<?php st_the_language('user_create_tour_address') ?>" class="form-control">
                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-rocket input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_tour_latitude') ?></label>
                <input id="map_lat" name="map_lat" type="text" placeholder="<?php st_the_language('user_create_tour_latitude')  ?>" class="form-control">
                <div class="st_msg console_msg_map_lat"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-rocket input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_tour_longitude') ?></label>
                <input id="map_lng" name="map_lng" type="text" placeholder="<?php st_the_language('user_create_tour_longitude')  ?>" class="form-control">
                <div class="st_msg console_msg_map_lng"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-plus-square input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_tour_map_zoom') ?></label>
                <input id="map_zoom" name="map_zoom" type="text" placeholder="<?php st_the_language('user_create_tour_map_zoom') ?>" class="form-control" value="13">
                <div class="st_msg console_msg_map_zoom"></div>
            </div>
        </div>
        <div class="col-md-6"></div>
    </div>
    <h4><?php st_the_language('user_create_tour_price') ?></h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Type Price",ST_TEXTDOMAIN) ?></label>
                <select id="type_price" name="type_price" class="form-control">
                    <option selected="selected" value="tour_price"><?php _e("Price / Tour",ST_TEXTDOMAIN )?></option>
                    <option value="people_price"><?php _e("Price / Person",ST_TEXTDOMAIN )?></option>
                </select>
                <div class="st_msg console_msg_tour_type"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="tour_price">
            <div class="col-md-12">
                <div class="form-group form-group-icon-left">
                    <i class="fa fa-money input-icon input-icon-hightlight"></i>
                    <label><?php st_the_language('user_create_tour_price') ?></label>
                    <input id="price" name="price" type="text" placeholder="<?php st_the_language('user_create_tour_price') ?>" class="form-control">
                    <div class="st_msg console_msg_id_location"></div>
                </div>
            </div>
        </div>
        <div class="people_price">
            <div class="col-md-6">
                <div class="form-group form-group-icon-left">
                    <i class="fa fa-money input-icon input-icon-hightlight"></i>
                    <label><?php _e("Adult Price",ST_TEXTDOMAIN) ?></label>
                    <input id="adult_price" name="adult_price" type="text" placeholder="<?php _e("Adult Price",ST_TEXTDOMAIN) ?>" class="form-control">
                    <div class="st_msg console_msg_adult_price"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-icon-left">
                    <i class="fa fa-money input-icon input-icon-hightlight"></i>
                    <label><?php _e("Child Price",ST_TEXTDOMAIN) ?></label>
                    <input id="child_price" name="child_price" type="text" placeholder="<?php _e("Child Price",ST_TEXTDOMAIN) ?>" class="form-control">
                    <div class="st_msg console_msg_child_price"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-star input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_tour_discount') ?></label>
                <input id="discount" name="discount" type="text" placeholder="<?php st_the_language('user_create_tour_discount') ?>" class="form-control">
                <div class="st_msg console_msg_address"></div>
            </div>            
            <div class="form-group form-group-icon-left">
                <label><?php _e("Sale Schedule",ST_TEXTDOMAIN) ?></label>
                <div class="checkbox checkbox-switch " id="is_sale_schedule">
                    <label>
                        <input class="i-check" name="is_sale_schedule" type="checkbox" /><?php _e("On/Off",ST_TEXTDOMAIN) ?></label>
                </div>
            </div>
            <div class="form-group form-group-icon-left">
                <i class="fa fa-link  input-icon input-icon-hightlight"></i>
                <label><?php st_the_language( 'user_create_tour_external_booking' ) ?></label>
                <input id="external_url" name="external_url" type="text"
                       placeholder="URL" class="form-control">

                <div class="st_msg console_msg_external"></div>
            </div>
        </div>

        <div class="data_sale">
            <div class="col-md-6">
                <div class="form-group form-group-icon-left" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>">
                    <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                    <label><?php _e("Sale Start Date",ST_TEXTDOMAIN) ?></label>
                    <input name="sale_price_from" class="date-pick form-control"  type="text" />
                    <div class="st_msg console_sale_price_from"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-icon-left" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>">
                    <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                    <label><?php _e("Sale End Date",ST_TEXTDOMAIN) ?></label>
                    <input name="sale_price_to" class="date-pick form-control"  type="text" />
                    <div class="st_msg console_sale_price_to"></div>
                </div>
            </div>
        </div>

    </div>
    <h4><?php st_the_language('user_create_tour_info') ?></h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa  fa-cogs input-icon input-icon-hightlight"></i>
                <label><?php _e("Tour Type",ST_TEXTDOMAIN) ?></label>
                <select id="tour_type" name="tour_type" class="form-control">
                    <option selected="selected" value="specific_date"><?php _e("Specific Date",ST_TEXTDOMAIN )?></option>
                    <option  value="daily_tour"><?php _e("Daily Tour",ST_TEXTDOMAIN )?></option>
                </select>
                <div class="st_msg console_msg_tour_type"></div>
            </div>
        </div>
    </div>
    <div class="row data_specific_date">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <label><?php _e("Departure date",ST_TEXTDOMAIN) ?></label>
                <input id="check_in" name="check_in" type="text" class="form-control date-pick" placeholder="<?php _e("Departure date",ST_TEXTDOMAIN) ?>">
                <div class="st_msg console_msg_check_in"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                <label><?php _e("Arrive date",ST_TEXTDOMAIN) ?></label>
                <input id="check_out" name="check_out" type="text"  class="form-control date-pick" placeholder="<?php _e("Arrive date",ST_TEXTDOMAIN) ?>">
                <div class="st_msg console_msg_check_out"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-user input-icon input-icon-hightlight"></i>
                <label><?php st_the_language('user_create_tour_max_people') ?></label>
                <input id="max_people" name="max_people" type="text" placeholder="<?php st_the_language('user_create_tour_max_people') ?>" class="form-control">
                <div class="st_msg console_msg_id_location"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-star input-icon input-icon-hightlight"></i>
                <label><?php _e("Default Duration",ST_TEXTDOMAIN) ?></label>
                <input id="duration" name="duration" type="text" placeholder="<?php _e("Default Duration",ST_TEXTDOMAIN) ?>" class="form-control">
                <div class="st_msg console_msg_address"></div>
            </div>
        </div>
    </div>
    <h4><?php st_the_language('user_create_tour_program') ?></h4>
    <div class="row">
        <div class=""  id="data_program">
        </div>
        <div class="col-md-8">
            <div class="form-group form-group-icon-left">
                 <button id="btn_add_program" type="button" class="btn btn-info"><?php st_the_language('user_create_tour_add_program') ?></button><br>
            </div>
        </div>
    </div>
    <?php
    $custom_field = st()->get_option( 'tours_unlimited_custom_field' );
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
    <input  type="button" id="btn_check_insert_post_type_tours"  class="btn btn-primary" value="<?php st_the_language('user_create_tour_submit') ?>">
    <input name="btn_insert_post_type_tours" id="btn_insert_post_type_tours" type="submit"  class="btn btn-primary hidden" hidden="" value="SUBMIT">
</form>
<div id="html_program" style="display: none">
    <div class="item">
        <div class="col-md-4">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_create_tour_program_title') ?></label>
                <input id="title" name="program_title[]" type="text" class="form-control">
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group form-group-icon-left">
                <label><?php st_the_language('user_create_tour_program_desc') ?></label>
                <textarea name="program_desc[]" class="form-control h_35"></textarea>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group form-group-icon-left">
                <div class="btn btn-danger btn_del_program" style="margin-top: 27px">
                    <?php st_the_language('user_create_tour_program_del') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(function($){
        var type_price = $('#type_price').val();
        if(type_price == 'tour_price'){
              $('.tour_price').show(500);
              $('.people_price').hide(500);

        }else{
            $('.tour_price').hide(500);
            $('.people_price').show(500);
        }
        $('#type_price').change(function(){
            var type_price = $(this).val();
            if(type_price == 'tour_price'){
                $('.tour_price').show(500);
                $('.people_price').hide(500);

            }else{
                $('.tour_price').hide(500);
                $('.people_price').show(500);
            }
        });

        $(function(){
            var is_sale_schedule = $('#is_sale_schedule').find('div').hasClass("checked");
            if(is_sale_schedule == true){
                $('.data_sale').show();
            }else{
                $('.data_sale').hide();
            }

            $('#is_sale_schedule .iCheck-helper').click(function(){
                var is_sale_schedule = $('#is_sale_schedule').find('div').hasClass("checked");
                if(is_sale_schedule == true){
                    $('.data_sale').show();
                }else{
                    $('.data_sale').hide();
                }
            })
        })


        var tour_type = $('#tour_type').val();
        if(tour_type == 'specific_date'){
            $('.data_specific_date').show(500);
        }else{
            $('.data_specific_date').hide(500);
        }
        $('#tour_type').change(function(){
            var tour_type = $(this).val();
            if(tour_type == 'specific_date'){
                $('.data_specific_date').show(500);
            }else{
                $('.data_specific_date').hide(500);
            }
        })




    });
</script>