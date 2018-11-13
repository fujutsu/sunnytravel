<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity element form book
 *
 * Created by ShineTheme
 *
 */

//check is booking with modal
$st_is_booking_modal = apply_filters( 'st_is_booking_modal' , false );
$type_price          = get_post_meta( get_the_ID() , 'type_price' , true );
$type_activity       = get_post_meta( get_the_ID() , 'type_activity' , true );
?>
<?php echo STTemplate::message(); ?>

<div class="info-activity">

    <?php
    $activity_time = get_post_meta( get_the_ID() , 'activity-time' , true );
    if(!empty( $activity_time ) and $type_activity != 'daily_activity'):
        ?>
        <div class="info">
            <span class="head"><i class="fa fa-clock-o"></i> <?php st_the_language( 'activity_time' ) ?> : </span>
            <span><?php echo esc_html( $activity_time ); ?> </span>
        </div>
    <?php endif; ?>
    <?php
/*    $duration = get_post_meta( get_the_ID() , 'duration' , true );
    if(!empty( $duration )):
        */?><!--
        <div class="info">
            <span class="head"><i class="fa fa-clock-o"></i> <?php /*st_the_language( 'duration' ) */?> : </span>
            <span><?php /*echo esc_html( $duration ); */?> </span>
        </div>
    --><?php /*endif; */?>
    <?php

    if($type_activity != 'daily_activity') {
        $check_in  = get_post_meta( get_the_ID() , 'check_in' , true );
        $check_out = get_post_meta( get_the_ID() , 'check_out' , true );
        if(!empty( $check_in ) and !empty( $check_out )):
            ?>
            <div class="info">
                <span class="head"><i class="fa fa-calendar"></i> <?php st_the_language( 'availability' ) ?> : </span>
            <span>
                <?php echo date( TravelHelper::getDateFormat() , strtotime( $check_in ) ) ?>
                <i class="fa fa-arrow-right"></i>
                <?php echo date( TravelHelper::getDateFormat() , strtotime( $check_out ) ) ?>
            </span>
            </div>
        <?php endif;
    }


    $facilities = get_post_meta( get_the_ID() , 'venue-facilities' , true );
    if(!empty( $facilities )):
        ?>
        <div class="info">
            <span class="head"><i class="fa fa-cogs"></i> <?php st_the_language( 'venue_facilities' ) ?> : </span>
            <span><?php echo esc_html( $facilities ); ?> </span>
        </div>
    <?php endif; ?>
</div>
<?php

$info_price = STActivity::get_info_price();
$count_sale = $info_price[ 'discount' ];

?>
<div class="package-info-wrapper">
    <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
    <form method="get" action="" class="activity_booking_form" data-activity-type="<?php echo esc_attr($type_activity); ?>">
        <div class="message_box"></div>
        <?php
        if(!get_option( 'permalink_structure' )) {
            echo '<input type="hidden" name="st_activity"  value="' . st_get_the_slug() . '">';
        }
        ?>
        <input type="hidden" name="action" value="activity_add_to_cart">
        <input type="hidden" name="item_id" value="<?php echo get_the_ID() ?>">
        <input type="hidden" name="discount" value="<?php echo esc_attr( $count_sale ) ?>">
        <input name="price" value="<?php echo get_post_meta( get_the_ID() , 'price' , true ) ?>" type="hidden">
        <input type="hidden" name="type_price" value="<?php echo esc_html( $type_price ) ?>">
        <input name="type_activity" type="hidden"
               value="<?php echo get_post_meta( get_the_ID() , 'type_activity' , true ) ?>">

        <div class="book_form">
            <span style=" display: none;"><?php st_the_language( 'guests' ) ?> :</span>
            <input name="number" class="number_room number_activity_1" type="number" min="1" value="1"
                   style=" display: none; width: 50px; height: 44px;">
            <?php
            if($type_activity == 'daily_activity') {
                $booking_period = get_post_meta(get_the_ID(), 'activity_booking_period', true);
                if(empty($booking_period) || $booking_period <= 0) $booking_period = 0;
            ?>
                <div class="input-daterange"
                     data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" data-booking-period="<?php echo $booking_period; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <span><?php _e( 'Check In' , ST_TEXTDOMAIN ) ?>: </span>
                            <input class="form-control check_in"
                                   placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" type="text"
                                   value="" name="start">
                        </div>
                        <div class="col-md-6">
                            <span><?php _e( 'Check Out' , ST_TEXTDOMAIN ) ?>: </span>
                            <input class="form-control check_out"
                                   placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" type="text"
                                   value="" name="end">
                        </div>
                        <div class="col-md-12">
                            <span><?php _e( 'Activity Time' , ST_TEXTDOMAIN ) ?>: </span>
                            <select name="activity_time" class="form-control">
                                <option <?php if(STInput::request( 'activity_time' ) == '12:00 AM')
                                    echo 'selected'; ?> value="12:00 AM"><?php _e( "Midnight" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '12:30 AM')
                                    echo 'selected'; ?> value="12:30 AM"><?php _e( "12:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '01:00 AM')
                                    echo 'selected'; ?> value="01:00 AM"><?php _e( "1:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '01:30 AM')
                                    echo 'selected'; ?> value="01:30 AM"><?php _e( "1:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '02:00 AM')
                                    echo 'selected'; ?> value="02:00 AM"><?php _e( "2:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '02:30 AM')
                                    echo 'selected'; ?> value="02:30 AM"><?php _e( "2:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '03:00 AM')
                                    echo 'selected'; ?> value="03:00 AM"><?php _e( "3:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '03:30 AM')
                                    echo 'selected'; ?> value="03:30 AM"><?php _e( "3:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '04:00 AM')
                                    echo 'selected'; ?> value="04:00 AM"><?php _e( "4:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '04:30 AM')
                                    echo 'selected'; ?> value="04:30 AM"><?php _e( "4:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '05:00 AM')
                                    echo 'selected'; ?> value="05:00 AM"><?php _e( "5:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '05:30 AM')
                                    echo 'selected'; ?> value="05:30 AM"><?php _e( "5:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '06:00 AM')
                                    echo 'selected'; ?> value="06:00 AM"><?php _e( "6:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '06:30 AM')
                                    echo 'selected'; ?> value="06:30 AM"><?php _e( "6:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '07:00 AM')
                                    echo 'selected'; ?> value="07:00 AM"><?php _e( "7:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '07:30 AM')
                                    echo 'selected'; ?> value="07:30 AM"><?php _e( "7:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '08:00 AM')
                                    echo 'selected'; ?> value="08:00 AM"><?php _e( "8:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '08:30 AM')
                                    echo 'selected'; ?> value="08:30 AM"><?php _e( "8:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '09:00 AM')
                                    echo 'selected'; ?> value="09:00 AM"><?php _e( "9:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '09:30 AM')
                                    echo 'selected'; ?> value="09:30 AM"><?php _e( "9:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '10:00 AM')
                                    echo 'selected'; ?> value="10:00 AM"><?php _e( "10:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '10:30 AM')
                                    echo 'selected'; ?> value="10:30 AM"><?php _e( "10:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '11:00 AM')
                                    echo 'selected'; ?> value="11:00 AM"><?php _e( "11:00 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '11:30 AM')
                                    echo 'selected'; ?> value="11:30 AM"><?php _e( "11:30 AM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '12:00 PM')
                                    echo 'selected'; ?> value="12:00 PM"><?php _e( "Noon" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '12:30 PM')
                                    echo 'selected'; ?> value="12:30 PM"><?php _e( "12:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '01:00 PM')
                                    echo 'selected'; ?> value="01:00 PM"><?php _e( "1:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '01:30 PM')
                                    echo 'selected'; ?> value="01:30 PM"><?php _e( "1:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '02:00 PM')
                                    echo 'selected'; ?> value="02:00 PM"><?php _e( "2:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '02:30 PM')
                                    echo 'selected'; ?> value="02:30 PM"><?php _e( "2:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '03:00 PM')
                                    echo 'selected'; ?> value="03:00 PM"><?php _e( "3:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '03:30 PM')
                                    echo 'selected'; ?> value="03:30 PM"><?php _e( "3:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '04:00 PM')
                                    echo 'selected'; ?> value="04:00 PM"><?php _e( "4:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '04:30 PM')
                                    echo 'selected'; ?> value="04:30 PM"><?php _e( "4:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '05:00 PM')
                                    echo 'selected'; ?> value="05:00 PM"><?php _e( "5:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '05:30 PM')
                                    echo 'selected'; ?> value="05:30 PM"><?php _e( "5:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '06:00 PM')
                                    echo 'selected'; ?> value="06:00 PM"><?php _e( "6:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '06:30 PM')
                                    echo 'selected'; ?> value="06:30 PM"><?php _e( "6:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '07:00 PM')
                                    echo 'selected'; ?> value="07:00 PM"><?php _e( "7:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '07:30 PM')
                                    echo 'selected'; ?> value="07:30 PM"><?php _e( "7:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '08:00 PM')
                                    echo 'selected'; ?> value="08:00 PM"><?php _e( "8:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '08:30 PM')
                                    echo 'selected'; ?> value="08:30 PM"><?php _e( "8:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '09:00 PM')
                                    echo 'selected'; ?> value="09:00 PM"><?php _e( "9:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '09:30 PM')
                                    echo 'selected'; ?> value="09:30 PM"><?php _e( "9:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '10:00 PM')
                                    echo 'selected'; ?> value="10:00 PM"><?php _e( "10:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '10:30 PM')
                                    echo 'selected'; ?> value="10:30 PM"><?php _e( "10:30 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '11:00 PM')
                                    echo 'selected'; ?> value="11:00 PM"><?php _e( "11:00 PM" , ST_TEXTDOMAIN ) ?></option>
                                <option <?php if(STInput::request( 'activity_time' ) == '11:30 PM')
                                    echo 'selected'; ?> value="11:30 PM"><?php _e( "11:30 PM" , ST_TEXTDOMAIN ) ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <input name="activity_start" type="hidden" class="activity_check_in"
                       value="<?php echo get_post_meta( get_the_ID() , 'check_in' , true ) ?>">
                <input name="activity_end" type="hidden" class="activity_check_out"
                       value="<?php echo get_post_meta( get_the_ID() , 'check_out' , true ) ?>">
                <input name="activity_time" type="hidden" class="activity_time"
                       value="<?php echo get_post_meta( get_the_ID() , 'activity-time' , true ) ?>">

            <?php } ?>

            <?php if($type_price == 'people_price') { ?>
                <div class="row line_ald">
                    <div class="col-md-6">
                        <span><?php _e( 'Adults' , ST_TEXTDOMAIN ) ?>: </span>
                        <select class="form-control st_tour_adult" name="adult_number" required>
                            <?php for( $i = 1 ; $i <= 20 ; $i++ ) {
                                echo "<option value='{$i}'>{$i}</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <span><?php _e( 'Children' , ST_TEXTDOMAIN ) ?>: </span>
                        <select class="form-control st_tour_children" name="children_number" required>
                            <?php for( $i = 0 ; $i <= 20 ; $i++ ) {
                                echo "<option value='{$i}'>{$i}</option>";
                            } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>
            <br>
            <?php if($st_is_booking_modal) { ?>
                <a href="#activity_booking_<?php the_ID() ?>" class="btn btn-primary popup-text btn_activity"
                   data-effect="mfp-zoom-out"><?php st_the_language( 'book_now' ) ?></a>
            <?php } else { ?>

                <?php echo STActivity::activity_external_booking_submit(); ?>

            <?php } ?>
            <?php
            $best_price = get_post_meta( get_the_ID() , 'best-price-guarantee' , true );
            if($best_price == 'on') {
                ?>
                <div class="btn btn-ghost btn-info tooltip_2 tooltip_2-effect-1 activity" style="font-size: 16px">
                <span class="">
                    <?php st_the_language( 'best_price_guarantee' ) ?>
                    <i class="fa  fa-check-square-o fa-lg  primary"></i>
                </span>
                <span class="tooltip_2-content clearfix title">
                    <?php echo get_post_meta( get_the_ID() , 'best-price-guarantee-text' , true ) ?>
                </span>
                </div>
            <?php } ?>
        </div>

    </form>
</div>    
<?php
if($st_is_booking_modal) {
    ?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="activity_booking_<?php the_ID() ?>">
        <?php echo st()->load_template( 'activity/modal_booking' ); ?>
    </div>

<?php } ?>
<script>
    jQuery(function ($) {
        $('.btn_activity').click(function () {
            $('.number_activity_2').val($('.number_activity_1').val())
        });
    });
</script>