<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity success payment item row
 *
 * Created by ShineTheme
 *
 */
$object_id        = $key;
$order_token_code = STInput::get( 'order_token_code' );

if($order_token_code) {
    $order_code = STOrder::get_order_id_by_token( $order_token_code );

}

$check_in  = get_post_meta( $order_code , 'check_in' , true );
$check_out = get_post_meta( $order_code , 'check_out' , true );

$price               = get_post_meta( $order_code , 'item_price' , true );
$number              = get_post_meta( $order_code , 'number' , true );
$total               = get_post_meta( $order_code , 'total_price' , true );
$type_activity       = get_post_meta( $order_code , 'type_activity' , true );
$title_type_activity = '';
if($type_activity == 'specific_date')
    $title_type_activity = __('Specific Date',ST_TEXTDOMAIN);
if($type_activity == 'daily_activity')
    $title_type_activity = __('Daily Activity',ST_TEXTDOMAIN);

if(isset( $object_id ) and $object_id) {
    $link = get_permalink( $object_id );
}

?>
<?php $type_price = get_post_meta( $object_id , 'type_price' , true ); ?>
<tr>
    <td><?php echo esc_html( $i ) ?></td>
    <td>
        <a href="<?php echo esc_url( $link ) ?>" target="_blank">
            <?php echo get_the_post_thumbnail( $key , array(
                360 ,
                270 ,
                'bfi_thumb' => true
            ) , array( 'style' => 'max-width:100%;height:auto' ) ) ?>
        </a>
    </td>
    <td>
        <p>
            <strong><?php st_the_language( 'booking_address' ) ?></strong> <?php echo get_post_meta( $object_id , 'address' , true ) ?>
        </p>

        <p>
            <strong><?php st_the_language( 'booking_web' ) ?></strong> <?php echo get_post_meta( $object_id , 'contact_web' , true ) ?>
        </p>

        <p>
            <strong><?php st_the_language( 'booking_email' ) ?></strong> <?php echo get_post_meta( $object_id , 'contact_email' , true ) ?>
        </p>

        <p>
            <strong><?php st_the_language( 'booking_phone' ) ?></strong> <?php echo get_post_meta( $object_id , 'contact_phone' , true ) ?>
        </p>

        <p><strong><?php st_the_language( 'booking_activity' ) ?></strong> <?php echo get_the_title( $object_id ) ?></p>

        <?php if($type_price == 'people_price') { ?>
            <p><strong><?php _e( 'Adult Price' , ST_TEXTDOMAIN ) ?>: </strong>
                <?php echo get_post_meta( $order_id , 'adult_number' , true ); ?> x
                <?php echo TravelHelper::format_money( get_post_meta( $order_code , 'adult_price' , true ) ); ?>
            </p>
            <p><strong><?php _e( 'Child Price' , ST_TEXTDOMAIN ) ?>: </strong>
                <?php echo get_post_meta( $order_id , 'child_number' , true ); ?> x
                <?php echo TravelHelper::format_money( get_post_meta( $order_code , 'child_price' , true ) ); ?>
            </p>
        <?php } else { ?>
            <p><strong><?php st_the_language( 'booking_amount' ) ?></strong> <?php echo esc_html( $number ) ?></p>
            <p><strong><?php st_the_language( 'booking_price' ) ?></strong> <?php
                echo TravelHelper::format_money( $price );
                ?></p>
        <?php } ?>
        <p><strong><?php _e( "Activity Type:" ) ?></strong> <?php echo esc_html( $title_type_activity ) ?></p>
        <?php $activity_time = get_post_meta($order_code,'activity_time',true); ?>
        <?php if(!empty($activity_time)){ ?>
            <p><strong><?php _e( "Activity Time:" ) ?></strong> <?php echo esc_html( $activity_time ) ?></p>
        <?php }?>
        <p>
            <strong><?php st_the_language( 'booking_check_in' ) ?></strong> <?php echo @date( get_option( 'date_format' ) , strtotime( $check_in ) ) ?>
        </p>
        <p>
            <strong><?php st_the_language( 'booking_check_out' ) ?></strong> <?php echo @date( get_option( 'date_format' ) , strtotime( $check_out ) ) ?>
        </p>
        <?php
        if(isset($data['data']['deposit_money']))
        {
            $deposit=$data['data']['deposit_money'];
            $orgine_price=STCart::get_item_total($data,$object_id);
            ?>

            <p ><strong><?php echo __('Origin Price',ST_TEXTDOMAIN); ?>:</strong> <?php echo TravelHelper::format_money($orgine_price)?></p>
            <p ><strong><?php printf(__('Deposit %s',ST_TEXTDOMAIN),$deposit['type']) ?>:</strong> <?php
                switch($deposit['type']){
                    case "percent":
                        echo $deposit['amount'].' %';
                        break;
                    case "amount":
                        echo TravelHelper::format_money($deposit['amount']);
                        break;

                }
                ?></p>
        <?php
        }

        ?>
    </td>
</tr>