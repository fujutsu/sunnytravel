<?php 
$st_location_num = apply_filters('st_location_rental_num' , 5);
$st_location_order = apply_filters('st_location_rental_order' , "DESC");
$st_location_orderby = apply_filters('st_location_rental_order_by' , "ID");
$st_location_style = apply_filters('st_location_rental_style' , "list");
if (st()->get_option('location_posts_per_page')){$st_location_num = st()->get_option('location_posts_per_page') ; }
if (st()->get_option('location_order')){$st_location_order = st()->get_option('location_order') ; }
if (st()->get_option('location_order_by')){$st_location_orderby = st()->get_option('location_order_by') ; }
$query=array(
    'post_type' => 'st_rental',
    'posts_per_page'=>$st_location_num,
    'order'=>$st_location_order,
    'orderby'=>$st_location_orderby,
    'post_status'=>'publish',
    'meta_value'=>get_the_ID()
);
$return = "";
if (STInput::request('style')){$st_location_style = STInput::request('style');};

if($st_location_style == 'list'){
    $return .="<ul class='booking-list loop-tours style_list loop-rental-location'>";
}
else{
    $return .='<div class="row row-wrap grid-rental-location">';
}
$data = array (
    'query'=>$query,
    'style'=>$st_location_style
    );
$return .=st()->load_template('vc-elements/st-location/location-list' , 'rental', $data);

if($st_location_style == 'list'){
    $return .="</ul>";
}
else{
    $return .='</div>';
}    

$link = STLocation::get_total_text_footer('st_rental');
$return .= balancetags($link);
echo "<div class='col-md-12 col-xs-12'>".balancetags($return)."</div>";
