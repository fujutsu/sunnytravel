<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 14/07/2015
 * Time: 3:17 CH
 */
$item_data=isset($item['item_meta'])?$item['item_meta']:array();

$price_type=st_wc_parse_order_item_meta($item_data['_st_type_price']);
?>
<ul class="wc-order-item-meta-list">


    <?php if(isset($item_data['_st_check_in'])): $data=st_wc_parse_order_item_meta($item_data['_st_check_in']); ?>
        <li>
            <span class="meta-label"><?php _e('Date:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php
                echo @date_i18n(get_option('date_format').' '.get_option('time_format'),strtotime($data));
                ?>
                <?php if(isset($item_data['_st_check_out'])){ $data=st_wc_parse_order_item_meta($item_data['_st_check_out']); ?>
                    <i class="fa fa-long-arrow-right"></i>
                    <?php echo @date_i18n(get_option('date_format').' '.get_option('time_format'),strtotime($data));?>
                <?php }?>


            </span>
        </li>
    <?php endif;?>
    <?php if(isset($item_data['_st_price_old'])):?>
        <li>
            <span class="meta-label"><?php _e('Price:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php echo TravelHelper::format_money(st_wc_parse_order_item_meta($item_data['_st_price_old'])) ?></span>
        </li>
    <?php endif;?>

    <?php  if($price_type=='people_price'):?>
        <li>
            <span class="meta-label"><?php echo __( 'Adult:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo st_wc_parse_order_item_meta($item_data[ '_st_adult_number' ]);?>
                x
                <?php echo TravelHelper::format_money(st_wc_parse_order_item_meta($item_data['_st_adult_price'])) ?>
                <i class="fa fa-long-arrow-right"></i>
                <?php echo TravelHelper::format_money(st_wc_parse_order_item_meta($item_data['_st_adult_price'])*st_wc_parse_order_item_meta($item_data[ '_st_adult_number' ])) ?>
            </span>
        </li>
        <li>
            <span class="meta-label"><?php echo __( 'Children:' , ST_TEXTDOMAIN ); ?></span>
            <span class="meta-data">
                <?php echo st_wc_parse_order_item_meta($item_data[ '_st_child_number' ]);?>
                x
                <?php echo TravelHelper::format_money(st_wc_parse_order_item_meta($item_data['_st_child_number'])) ?>
                <i class="fa fa-long-arrow-right"></i>
                <?php echo TravelHelper::format_money(st_wc_parse_order_item_meta($item_data['_st_child_number'])*st_wc_parse_order_item_meta($item_data[ '_st_child_number' ])) ?>
            </span>
        </li>
    <?php endif;?>


</ul>