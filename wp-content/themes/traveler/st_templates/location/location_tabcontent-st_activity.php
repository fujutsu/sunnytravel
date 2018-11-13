    <?php 
    $st_location_num = apply_filters('st_location_activity_num' , 5) ; 
    $st_location_order = apply_filters('st_location_activity_order' , "DESC") ; 
    $st_location_orderby = apply_filters('st_location_activity_orderby' , "ID");
    $st_location_style = apply_filters('st_location_activity_style' , "list");
    if (st()->get_option('location_posts_per_page')){$st_location_num = st()->get_option('location_posts_per_page') ; }
    if (st()->get_option('location_order')){$st_location_order = st()->get_option('location_order') ; }
    if (st()->get_option('location_order_by')){$st_location_orderby = st()->get_option('location_order_by') ; }
    $query=array(
        'post_type' => 'st_activity',
        'meta_key' => 'id_location',
        'meta_value' => get_the_ID(),
        'posts_per_page'=>$st_location_num,
        'order'=>$st_location_order,
        'orderby'=>$st_location_orderby,
        'post_status'=>'publish',
    );
    $return = "";
    if (STInput::request('style')){$st_location_style = STInput::request('style');};

    if($st_location_style == 'list'){
        $return .="<ul class='booking-list loop-tours style_list loop-activity-location'>";
    }
    else{
        $return .='<div class="row row-wrap grid-activity-location">';
    }
    query_posts($query);
    while(have_posts()){
        the_post();
        if($st_location_style == 'list'){
            $return .=st()->load_template('activity/elements/loop/loop-1' ,null , array('is_location'=>true) );
        }
        else{
            $return .=st()->load_template('activity/elements/loop/loop-2' ,null , array('is_location'=>true) );
        }
    }
    wp_reset_query();

    if($st_location_style == 'list'){
        $return .="</ul>";
    }
    else{
        $return .='</div>';
    }

    $link = STLocation::get_total_text_footer('st_activity');
    $return .= balancetags($link);
    echo "<div class='col-md-12 col-xs-12'>".balancetags($return)."</div>";