<?php 

$check_in = TravelHelper::convertDateFormat(STInput::request('start'));
if(!$check_in){
    $check_in = date('m/d/Y', strtotime("now"));
}

$check_out = TravelHelper::convertDateFormat(STInput::request('end'));
if(!$check_out){
    $check_out = date('m/d/Y', strtotime("+1 day"));
}

$room_num_search = STInput::request('room_num_search');
if(!isset($room_num_search) || intval($room_num_search) <= 0) $room_num_search = 1;

$night = TravelHelper::dateDiff($check_in, $check_out);

$data_price = STRoom::get_room_price(get_the_ID(),$check_in,$check_out);

$html_price = $data_price['price'] * $room_num_search;

$default = array(
    'align' => 'right'
);
if (isset($attr)) {
    extract(wp_parse_args($attr, $default));
} else {
    extract($default);
}
?>
<?php 
    $room_id = get_the_ID();
    $item_id = get_post_meta(get_the_ID(), 'room_parent', true);
    $booking_period = intval(get_post_meta($item_id, 'hotel_booking_period', TRUE));
    $start = (STInput::request('start')) ? STInput::request('start') : date(TravelHelper::getDateFormat(), strtotime("now"));
    $end = (STInput::request('end')) ? STInput::request('end') : date(TravelHelper::getDateFormat(), strtotime("+1 day"));
    $check_in = TravelHelper::convertDateFormat($start);
    $check_out = TravelHelper::convertDateFormat($end);
?>
<div class="hotel-room-form">
    <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
    <div class="price bgr-main clearfix">
        <div class="pull-left">
            <span class="text-lg"><?php echo TravelHelper::format_money($html_price) ?></span>
        </div>
        <div class="pull-right">
            <?php printf(__('per %d Night(s)', ST_TEXTDOMAIN), $night); ?>
        </div>
    </div>
    <?php echo STTemplate::message()?>
    <form class="single-room-form" method="get">
        <?php wp_nonce_field('room_search','room_search')?>
        <div class="input-daterange" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" data-booking-period="<?php echo $booking_period; ?>">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                        <label><?php st_the_language('check_in')?></label>
                        <input data-post-id="<?php echo get_the_ID(); ?>" placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control checkin_hotel" value="<?php echo $start; ?>" name="start" type="text">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                        <label><?php st_the_language('check_out')?></label>
                        <input data-post-id="<?php echo get_the_ID(); ?>" placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" class="form-control checkout_hotel" value="<?php echo $end; ?>" name="end" type="text">
                    </div>
                </div>
            </div>
        </div>
       <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="form-group form-group-select-plus">
                    <label><?php st_the_language('rooms')?></label>
                    <?php $num_room = intval(get_post_meta($room_id, 'number_room', true)); 
                    ?>
                    <select name="room_num_search" class="form-control">
                        <?php

                        if(!$num_room || $num_room < 0)
                            $num_room = 9;
                        for($i = 1; $i <= $num_room; $i ++):?>
                            <option <?php selected( $i , $room_num_search,1); ?> value='<?php echo $i; ?>'><?php echo $i; ?></option>
                        <?php endfor;?>
                    </select>

                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group form-group-select-plus">
                    <label><?php st_the_language('adults')?></label>
                    <select name="adult_num" class="form-control">
                        <?php
                        $max=st()->get_option('hotel_max_adult',14);
                        for($i=1;$i<=$max;$i++):
                            $select = selected( $i , STInput::get('adult_num',1)); ?>
                        <option <?php echo $select; ?> value='<?php echo $i;?>'><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group form-group-select-plus">
                    <label><?php st_the_language('children')?></label>
                    
                    <select name="child_num" class="form-control">
                        <?php

                        $max=st()->get_option('hotel_max_child',14);
                        for($i=0;$i<=$max;$i++):
                            $select = selected($i,STInput::get('child_num',0));?>
                        <option <?php echo $select; ?> value='<?php echo $i; ?>'><?php echo $i; ?></option>
                        <?php endfor;?>
                    </select>
                </div>
            </div>
       </div>
        <div class="text-right">
            <input class=" btn btn-primary btn_hotel_booking" value="Book now" type="submit">
        </div>
        <input name="action" value="hotel_add_to_cart" type="hidden">
        <input name="item_id" value="<?php echo $item_id; ?>" type="hidden">
        <input name="room_id" value="<?php echo $room_id; ?>" type="hidden">
        <input type="hidden" name="data_price" value='<?php echo serialize($data_price) ?>'>
        <input name="price" value="<?php echo esc_attr($data_price['price']) ?>" type="hidden">
    </form>
</div>