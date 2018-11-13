<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 03/06/2015
 * Time: 3:53 CH
 */
?>
<p class="booking-item-description">
    <?php echo __( 'Duration:' , ST_TEXTDOMAIN ); ?>
    <?php echo date_i18n( get_option( 'date_format' ) , strtotime( $st_booking_data[ 'check_in' ] ) ) ?>
    <i class="fa fa-long-arrow-right"></i>
    <?php echo date_i18n( get_option( 'date_format' ) , strtotime( $st_booking_data[ 'check_out' ] ) ) ?>

    <?php if($st_booking_data[ 'type_price' ] == 'people_price'): ?>
        </br>
        <?php echo __( 'Adult:' , ST_TEXTDOMAIN ); ?>
        <?php echo $st_booking_data[ 'adult_number' ];?>
        x
        <?php echo TravelHelper::format_money($st_booking_data['adult_price']) ?>
        <i class="fa fa-long-arrow-right"></i>
        <?php echo TravelHelper::format_money($st_booking_data['adult_price']*$st_booking_data[ 'adult_number' ]) ?>
        <br>
        <?php echo __( 'Children:' , ST_TEXTDOMAIN ); ?>

        <?php echo $st_booking_data[ 'child_number' ] ?>
        x
        <?php echo TravelHelper::format_money($st_booking_data['child_price']) ?>
        <i class="fa fa-long-arrow-right"></i>
        <?php echo TravelHelper::format_money($st_booking_data['child_number']*$st_booking_data[ 'child_price' ]) ?>

    <?php endif ?>
    <?php if(!empty($st_booking_data['activity_time'])): ?>
        </br>
        <?php echo __( 'Department Time:' , ST_TEXTDOMAIN ); ?>
        <?php echo $st_booking_data['activity_time'] ?>
    <?php endif ?>
</p>



