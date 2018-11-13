<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 14/07/2015
 * Time: 3:17 CH
 */
$item_data=isset($item['item_meta'])?$item['item_meta']:array();
//var_dump($item_data);
$_st_data_price_cars=st_wc_parse_order_item_meta($item_data['_st_data_price_cars']);
$_st_data_price_cars=unserialize($_st_data_price_cars);
?>
<ul class="wc-order-item-meta-list">

    <?php if(isset($item_data['_st_price_old'])):?>
        <li>
            <span class="meta-label"><?php _e('Price:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php echo TravelHelper::format_money(st_wc_parse_order_item_meta($item_data['_st_price_old'])) ?></span>
        </li>
    <?php endif;?>
    <?php if(isset($item_data['_st_price_unit'])):?>
        <li>
            <span class="meta-label"><?php _e('Price Unit:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php echo STCars::get_price_unit_by_unit_id(st_wc_parse_order_item_meta($item_data['_st_price_unit'])) ?></span>
        </li>
    <?php endif;?>

    <?php if(isset($_st_data_price_cars->location_id_pick_up) and $_st_data_price_cars->location_id_pick_up ){?>
    <li>
        <span class="meta-label"><?php _e('Pick-up:',ST_TEXTDOMAIN) ?></span>
        <span class="meta-data"><?php
            if($_st_data_price_cars->location_id_pick_up){
                echo get_the_title($_st_data_price_cars->location_id_pick_up);
            }

             ?></span>
    </li>
    <?php }elseif(isset($_st_data_price_cars->pick_up) and $_st_data_price_cars->pick_up){?>
        <li>
            <span class="meta-label"><?php _e('Pick-up:',ST_TEXTDOMAIN) ?></span>
        <span class="meta-data"><?php
            if($_st_data_price_cars->pick_up)
            {
                echo esc_html($_st_data_price_cars->pick_up);
            }

            ?></span>
        </li>
    <?php }?>

    <?php if(isset($_st_data_price_cars->location_id_drop_off) and $_st_data_price_cars->location_id_drop_off ){?>
    <li>
        <span class="meta-label"><?php _e('Drop-off:',ST_TEXTDOMAIN) ?></span>
        <span class="meta-data"><?php
            if($_st_data_price_cars->location_id_drop_off){
                echo get_the_title($_st_data_price_cars->location_id_drop_off);
            }

             ?></span>
    </li>
    <?php }elseif(isset($_st_data_price_cars->drop_off) and $_st_data_price_cars->drop_off){?>
        <li>
            <span class="meta-label"><?php _e('Drop-off:',ST_TEXTDOMAIN) ?></span>
        <span class="meta-data"><?php
            if($_st_data_price_cars->drop_off)
            {
                echo esc_html($_st_data_price_cars->drop_off);
            }

            ?></span>
        </li>
    <?php }?>


    <?php if(isset($item_data['_st_check_in_timestamp'])):?>
    <li>
        <span class="meta-label"><?php _e('Date:',ST_TEXTDOMAIN) ?></span>
        <span class="meta-data"><?php echo date_i18n(get_option('date_format').' '.get_option('time_format'),st_wc_parse_order_item_meta($item_data['_st_check_in_timestamp'])) ?>
            <?php if(isset($item_data['_st_check_out_timestamp'])){?>
                <i class="fa fa-long-arrow-right"></i>
                <?php echo date_i18n(get_option('date_format').' '.get_option('time_format'),st_wc_parse_order_item_meta($item_data['_st_check_out_timestamp'])) ?>
            <?php }?>
        </span>
    </li>
    <?php endif;?>
    <?php if(isset($item_data['_st_selected_equipments'])):

        $selected_equipment=st_wc_parse_order_item_meta($item_data['_st_selected_equipments']);
        if($selected_equipment and $selected_equipment=unserialize($selected_equipment)){
            if(is_array($selected_equipment) and !empty($selected_equipment)){

                ?>
                <li>
                    <span class="meta-label"><?php _e('Equipments:',ST_TEXTDOMAIN) ?></span>
                    <span class="meta-data">
                        <br>
                            <?php
                            foreach($selected_equipment as $key=>$data){
                                $price_unit=$data->price_unit;
                                $price_unit_html='';
                                switch($price_unit)
                                {
                                    case "per_hour":
                                        $price_unit_html=__('/hour',ST_TEXTDOMAIN);
                                        break;
                                    case "per_day":
                                        $price_unit_html=__('/day',ST_TEXTDOMAIN);
                                        break;
                                    default:
                                        $price_unit_html='';
                                        break;
                                }
                                echo "&nbsp;&nbsp;&nbsp;- ".$data->title.": ".TravelHelper::format_money($data->price).$price_unit_html." <br>";

                            }
                            ?>
                    </span>
                </li>
            <?php
            }
        }
         endif;?>

</ul>