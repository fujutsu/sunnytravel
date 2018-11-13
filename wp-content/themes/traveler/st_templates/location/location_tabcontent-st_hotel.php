<?php 
$st_location_style = "list";
if (st()->get_option('location_posts_per_page')){$st_location_num = st()->get_option('location_posts_per_page') ; }
if (st()->get_option('location_order')){$st_location_order = st()->get_option('location_order') ; }
if (st()->get_option('location_order_by')){$st_location_orderby = st()->get_option('location_order_by') ; }
$query=array(
    'post_type' => 'st_hotel',
    'posts_per_page'=>$st_location_num,
    'order'=>$st_location_order,
    'orderby'=>$st_location_orderby,
    'post_status'=>'publish',
    'meta_query' => array(
    	'relation' => 'OR',
    	array(
			'key' => 'multi_location',
			'value' => '_'.get_the_ID().'_',
			'compare' => 'LIKE',
		),
    	array(
			'key' => 'id_location',
			'value' => get_the_ID(),
			'compare' => 'IN',
		),
    )
);
$return = "";
$st_location_style = apply_filters('location_hotel_style' , $st_location_style);
$query  = apply_filters('location_hotel_query' , $query);

$data['query'] = $query;   
$data['style'] =$st_location_style;  

$return .=st()->load_template('vc-elements/st-location/location','list-hotel',$data);              

$link = STLocation::get_total_text_footer('st_hotel');
$return .= balancetags($link);

echo "<div class='col-md-12 col-xs-12'>".balancetags($return)."</div>";

