<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Cars element search field drop off to
 *
 * Created by ShineTheme
 *
 */
$default=array(
    'title'=>'',
    'is_required'=>'on',
    'placeholder'=>''
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}
if($is_required == 'on'){
    $is_required = 'required';
}
if(!isset( $field_size ))
    $field_size = 'md';

$old_location=STInput::get('location_id_drop_off');
$location_name = (!empty($old_location)) ? '' : STInput::request('drop-off', '');
$locations = TravelHelper::getListFullNameLocation();
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?> form-group-icon-left">
    <i class="fa fa-map-marker input-icon"></i>
    <label><?php echo esc_html( $title)?></label>
    <div class="st-select-wrapper" data-location-name="<?php echo $location_name; ?>">
        <input type="hidden" class="location_name"  name="drop-off" value="<?php echo $location_name; ?>">
        <select name="location_id_drop_off" class="st-location-id selectize st-hidden" placeholder="<?php if($placeholder) echo $placeholder; ?>" tabindex="-1">
            <option value=""><?php echo __('City, Region, District'); ?></option>
            <?php 
                if(is_array($locations) && count($locations)):
                    foreach($locations as $key => $value):
            ?>
            <option <?php selected($value->ID, $old_location); ?> value="<?php echo $value->ID; ?>"><?php echo $value->title; ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>