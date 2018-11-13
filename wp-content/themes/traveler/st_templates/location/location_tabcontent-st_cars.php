<?php 
$st_location_style = "list";
if (st()->get_option('location_posts_per_page')){$st_location_num = st()->get_option('location_posts_per_page') ; }
if (st()->get_option('location_order')){$st_location_order = st()->get_option('location_order') ; }
if (st()->get_option('location_order_by')){$st_location_orderby = st()->get_option('location_order_by') ; }
$query=array(
    'post_type' => 'st_cars',
    'meta_key' => 'id_location',
    'meta_value' => get_the_ID(),
    'post_status'=>'publish',
    'posts_per_page'=>$st_location_num,
    'order'=>$st_location_order,
    'orderby'=>$st_location_orderby,
);
$return = "";
$st_location_style = apply_filters("location_cars_style",$st_location_style );
$query  = apply_filters('location_cars_query',$query);

    if (STInput::request('style')){$st_location_style = STInput::request('style');};

    if ($st_location_style =="list"){
        $return .='<ul class="booking-list loop-cars style_list">' ; 
    }else {
        $return .='<div class="row row-wrap">';
    }
    
    query_posts($query);

    while(have_posts()){
        the_post();
        if ($st_location_style =="list"){
                $return .=st()->load_template('cars/elements/loop/loop-1');
            }else {
                $return .=st()->load_template('cars/elements/loop/loop-2');
            }
    }

    wp_reset_query();

    if ($st_location_style =="list"){
        $return .='</ul>' ; 
    }else {
        $return .="</div>";
    }

    $link = STLocation::get_total_text_footer('st_cars');
    $return .= balancetags($link);
echo "<div class='col-md-12 col-xs-12'>".balancetags($return)."</div>";