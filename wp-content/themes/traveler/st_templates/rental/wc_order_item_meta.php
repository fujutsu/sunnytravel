<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 14/07/2015
 * Time: 3:17 CH
 */
$item_data=isset($item['item_meta'])?$item['item_meta']:array();
?>
<ul class="wc-order-item-meta-list">
    <?php if(isset($item_data['_st_check_in'])): $data=st_wc_parse_order_item_meta($item_data['_st_check_in']); ?>
        <li>
            <span class="meta-label"><?php _e('Date:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php
                echo @date_i18n(get_option('date_format'),strtotime($data));
                ?>
                <?php if(isset($item_data['_st_check_out'])){ $data=st_wc_parse_order_item_meta($item_data['_st_check_out']); ?>
                    <i class="fa fa-long-arrow-right"></i>
                    <?php echo @date_i18n(get_option('date_format'),strtotime($data));?>
                <?php }?>


            </span>
        </li>
    <?php endif;?>

    <?php if(isset($item_data['_st_adult'])):?>
        <li>
            <span class="meta-label"><?php _e('Adult:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php echo st_wc_parse_order_item_meta($item_data['_st_adult']) ?></span>
        </li>
    <?php endif;?>
    <?php if(isset($item_data['_st_children'])):?>
        <li>
            <span class="meta-label"><?php _e('Children:',ST_TEXTDOMAIN) ?></span>
            <span class="meta-data"><?php echo st_wc_parse_order_item_meta($item_data['_st_children']) ?></span>
        </li>
    <?php endif;?>
</ul>