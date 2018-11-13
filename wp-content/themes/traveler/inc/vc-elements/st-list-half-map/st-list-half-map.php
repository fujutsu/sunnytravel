<?php
/**
 *
 *
 * @since 1.1.5
 * */
if(function_exists( 'vc_map' )) {
    vc_map( array(
        "name"     => __( "ST List Half Map" , ST_TEXTDOMAIN ) ,
        "base"     => "st_list_half_map" ,
        "class"    => "" ,
        "icon"     => "icon-st" ,
        "category" => "Shinetheme" ,
        "params"   => array(
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Title" , ST_TEXTDOMAIN ) ,
                "param_name" => "title" ,
                "value"      => '' ,
            ) ,
            array(
                "type"        => "st_post_type_location_2" ,
                "holder"      => "div" ,
                "heading"     => __( "Select Location" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_list_location" ,
                "description" => "" ,
            ) ,
            array(
                "type"        => "dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Type" , ST_TEXTDOMAIN ) ,
                "param_name"  => "st_type" ,
                "description" => "" ,
                'value'       => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Hotel' , ST_TEXTDOMAIN ) => 'st_hotel' ,
                    __( 'Car' , ST_TEXTDOMAIN )        => 'st_cars' ,
                    __( 'Tour' , ST_TEXTDOMAIN )       => 'st_tours' ,
                    __( 'Rental' , ST_TEXTDOMAIN )     => 'st_rental' ,
                    __( 'Activities' , ST_TEXTDOMAIN ) => 'st_activity' ,
                ) ,
                'edit_field_class'=>'vc_col-sm-6',
            ) ,
            array(
                "type"        => "dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Show Search Box" , ST_TEXTDOMAIN ) ,
                "param_name"  => "show_search_box" ,
                "description" => "" ,
                'value'       => array(
                    __( 'Yes' , ST_TEXTDOMAIN ) => 'yes' ,
                    __( 'No' , ST_TEXTDOMAIN )        => 'no' ,
                ) ,
                'edit_field_class'=>'vc_col-sm-6',
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Number" , ST_TEXTDOMAIN ) ,
                "param_name" => "number" ,
                "value"      => 12 ,
                'edit_field_class'=>'vc_col-sm-3',
            ) ,
            array(
                "type"       => "textfield" ,
                "holder"     => "div" ,
                "class"      => "" ,
                "heading"    => __( "Zoom" , ST_TEXTDOMAIN ) ,
                "param_name" => "zoom" ,
                "value"      => 13 ,
                'edit_field_class'=>'vc_col-sm-3',
            ) ,
            array(
                "type"        => "dropdown" ,
                "holder"      => "div" ,
                "class"       => "" ,
                "heading"     => __( "Map Position" , ST_TEXTDOMAIN ) ,
                "param_name"  => "map_position" ,
                "description" => "Map Position" ,
                "value"       => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Left' , ST_TEXTDOMAIN )  => "left" ,
                    __( 'Right' , ST_TEXTDOMAIN ) => "right" ,
                ) ,
                'edit_field_class'=>'vc_col-sm-3',
            ) ,
            array(
                "type"        => "textfield" ,
                "holder"      => "div" ,
                "class"       => "" ,
                "heading"     => __( "Map Height" , ST_TEXTDOMAIN ) ,
                "param_name"  => "height" ,
                "description" => "pixels" ,
                "value"       => 500 ,
                'edit_field_class'=>'vc_col-sm-3',
            ) ,
            array(
                "type"        => "dropdown" ,
                "holder"      => "div" ,
                "heading"     => __( "Style Map" , ST_TEXTDOMAIN ) ,
                "param_name"  => "style_map" ,
                "description" => "" ,
                'value'       => array(
                    __('--Select--',ST_TEXTDOMAIN)=>'',
                    __( 'Normal' , ST_TEXTDOMAIN )      => 'normal' ,
                    __( 'Midnight' , ST_TEXTDOMAIN )    => 'midnight' ,
                    __( 'Family Fest' , ST_TEXTDOMAIN ) => 'family_fest' ,
                    __( 'Open Dark' , ST_TEXTDOMAIN )   => 'open_dark' ,
                    __( 'Riverside' , ST_TEXTDOMAIN )   => 'riverside' ,
                    __( 'Ozan' , ST_TEXTDOMAIN )        => 'ozan' ,
                ) ,
            ) ,
        )
    ) );
}

if(!function_exists( 'st_list_half_map' )) {
    function st_list_half_map( $attr , $content = false )
    {
        $data = shortcode_atts(
            array(
                'title'             => '' ,
                'st_list_location'  => '' ,
                'st_type'           => 'st_hotel' ,
                'zoom'              => '13' ,
                'height'            => '500' ,
                'number'            => '12' ,
                'map_position'      => 'left' ,
                'style_map'         => 'normal' ,
                'custom_code_style' => '' ,
                'show_search_box' => 'yes' ,
            ) , $attr , 'st_list_map' );
        extract( $data );

        $ids  = explode( ',' , $st_list_location );
        $html = '';
        if(!empty( $ids ) and is_array( $ids )) {
            $query = array(
                'post_type'      => $st_type ,
                'posts_per_page' => $number ,
                'post_status'    => 'publish' ,
                'meta_query'     => array(
                    'relation' => 'OR' ,
                    array(
                        'key'     => 'id_location' ,
                        'value'   => explode( ',' , $st_list_location ) ,
                        'compare' => 'IN' ,
                    ) ,
                    array(
                        'key'     => 'location_id' ,
                        'value'   => explode( ',' , $st_list_location ) ,
                        'compare' => 'IN' ,
                    ) ,
                    array(
                        'key'     => 'multi_location' ,
                        'value'   => "_{$st_list_location}_" ,
                        'compare' => "LIKE" ,
                    ),
                ) ,
            );

            $map_lat         = get_post_meta( $ids[ 0 ] , 'map_lat' , true );
            $map_lng         = get_post_meta( $ids[ 0 ] , 'map_lng' , true );
            $location_center = '[' . $map_lat . ',' . $map_lng . ']';

            $data_map = array();
            query_posts( $query );
            $stt = 0;
            while( have_posts() ) {
                the_post();
                $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
                $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
                if(!empty( $map_lat ) and !empty( $map_lng )) {
                    $post_type                       = get_post_type();
                    $data_map[ $stt ][ 'id' ]        = get_the_ID();
                    $data_map[ $stt ][ 'name' ]      = get_the_title();
                    $data_map[ $stt ][ 'post_type' ] = $post_type;
                    $data_map[ $stt ][ 'lat' ]       = $map_lat;
                    $data_map[ $stt ][ 'lng' ]       = $map_lng;
                    $post_type_name                  = get_post_type_object( $post_type );
                    $post_type_name->label;
                    switch( $post_type ) {
                        case"st_hotel";
                            $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                            $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                        case"st_rental";
                            $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_brown.png' );
                            $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                        case"st_cars";
                            $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                            $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                        case"st_tours";
                            $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_tours_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_purple.png' );
                            $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                        case"st_activity";
                            $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                            $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                            break;
                    }
                    $stt++;
                }

            }
            wp_reset_query();

            $data_tmp               = array(
                'st_list_location' => $st_list_location ,
                'location_center'  => $location_center ,
                'zoom'             => $zoom ,
                'data_map'         => $data_map ,
                'height'           => $height ,
                'map_position'     => $map_position ,
                'style_map'        => $style_map ,
                'st_type'          => $st_type ,
                'number'           => $number ,
                'title'            => $title ,
                'show_search_box'            => $show_search_box ,
            );
            $data_tmp[ 'data_tmp' ] = $data_tmp;
            $html                   = st()->load_template( 'vc-elements/st-list-half-map/html' , '' , $data_tmp );
        }
        return $html;
    }
}

st_reg_shortcode( 'st_list_half_map' , 'st_list_half_map' );


if(!function_exists( 'st_search_list_half_map' )) {
    function st_search_list_half_map( $attr , $content = false )
    {

        $post_type = STInput::request( 'post_type' );
        $zoom      = STInput::request( 'zoom' );
        $number    = STInput::request( 'number',8 );
        $style_map = STInput::request( 'style_map' );

        $query           = array(
            'post_type'      => $post_type ,
            'posts_per_page' => $number ,
            'post_status'    => 'publish' ,
            's'              => '' ,
        );
        $map_lat_center  = 0;
        $map_lng_center  = 0;
        $location_center = '[0,0]';
        $address_center  = '';
        if(STInput::request( 'location_name' )) {
            $ids_location = TravelerObject::_get_location_by_name( STInput::get( 'location_name' ) );
            if(!empty( $ids_location )) {
                $_REQUEST['location_name'] = implode(',',$ids_location);
                $map_lat_center  = get_post_meta( $ids_location[ 0 ] , 'map_lat' , true );
                $map_lng_center  = get_post_meta( $ids_location[ 0 ] , 'map_lng' , true );
                $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
                $address_center  = get_the_title( $ids_location[ 0 ] );
            }
        }
        if(STInput::request( 'pick-up' )) {
            $ids_location = TravelerObject::_get_location_by_name( STInput::get( 'pick-up' ) );
            if(!empty( $ids_location )) {
                $_REQUEST['pick-up'] = implode(',',$ids_location);
                $map_lat_center  = get_post_meta( $ids_location[ 0 ] , 'map_lat' , true );
                $map_lng_center  = get_post_meta( $ids_location[ 0 ] , 'map_lng' , true );
                $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
                $address_center  = get_the_title( $ids_location[ 0 ] );
            }
        }
        if(STInput::request( 'location_id' )) {
            $map_lat_center  = get_post_meta( STInput::request( 'location_id' ) , 'map_lat' , true );
            $map_lng_center  = get_post_meta( STInput::request( 'location_id' ) , 'map_lng' , true );
            $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
            $address_center  = get_the_title( STInput::request( 'location_id' ) );
        }
        if(STInput::request( 'location_id_pick_up' )) {
            $map_lat_center  = get_post_meta( STInput::request( 'location_id_pick_up' ) , 'map_lat' , true );
            $map_lng_center  = get_post_meta( STInput::request( 'location_id_pick_up' ) , 'map_lng' , true );
            $location_center = '[' . $map_lat_center . ',' . $map_lng_center . ']';
            $address_center  = get_the_title( STInput::request( 'location_id_pick_up' ) );
        }
        $data_map = array();
        global $wp_query , $st_search_query;
        switch( $post_type ) {
            case"st_hotel":
                $hotel    = new STHotel();
                add_action( 'pre_get_posts' , array( $hotel , 'change_search_hotel_arg' ) );
                break;
            case"st_rental":
                $rental   = new STRental();
                add_action( 'pre_get_posts' , array( $rental , 'change_search_arg' ) );
                break;
            case"st_cars":
                $cars     = new STCars();
                add_action( 'pre_get_posts' , array( $cars , 'change_search_cars_arg' ) );
                break;
            case"st_tours":
                $tour     = new STTour();
                add_action( 'pre_get_posts' , array( $tour , 'change_search_tour_arg' ) );
                break;
            case"st_activity":
                $activity = new STActivity();
                add_action( 'pre_get_posts' , array( $activity , 'change_search_activity_arg' ) );
                break;
        }
        query_posts( $query );
        $stt = 0;
        while( have_posts() ) {
            the_post();

            $map_lat = get_post_meta( get_the_ID() , 'map_lat' , true );
            $map_lng = get_post_meta( get_the_ID() , 'map_lng' , true );
            if(!empty( $map_lat ) and !empty( $map_lng )) {
                $post_type                       = get_post_type();
                $data_map[ $stt ][ 'id' ]        = get_the_ID();
                $data_map[ $stt ][ 'name' ]      = get_the_title();
                $data_map[ $stt ][ 'post_type' ] = $post_type;
                $data_map[ $stt ][ 'lat' ]       = $map_lat;
                $data_map[ $stt ][ 'lng' ]       = $map_lng;
                $post_type_name                  = get_post_type_object( $post_type );
                $post_type_name->label;
                switch( $post_type ) {
                    case"st_hotel";
                        $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_hotel_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_black.png' );
                        $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/hotel' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_rental";
                        $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_rental_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_brown.png' );
                        $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/rental' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_cars";
                        $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_cars_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_green.png' );
                        $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/car' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_tours";
                        $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_tours_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_purple.png' );
                        $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/tour' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                    case"st_activity";
                        $data_map[ $stt ][ 'icon_mk' ]      = st()->get_option( 'st_activity_icon_map_marker' , 'http://maps.google.com/mapfiles/marker_yellow.png' );
                        $data_map[ $stt ][ 'content_html' ] = preg_replace( '/^\s+|\n|\r|\s+$/m' , '' , st()->load_template( 'vc-elements/st-list-half-map/loop/activity' , false , array( 'post_type' => $post_type_name->label ) ) );
                        break;
                }
                $stt++;
            }
        }
        $st_search_query = $wp_query;
        switch( $post_type ) {
            case"st_hotel":
                remove_action( 'pre_get_posts' , array( $hotel , 'change_search_hotel_arg' ) );
                break;
            case"st_rental":
                remove_action( 'pre_get_posts' , array( $rental , 'change_search_arg' ) );
                break;
            case"st_cars":
                remove_action( 'pre_get_posts' , array( $cars , 'change_search_cars_arg' ) );
                break;
            case"st_tours":
                remove_action( 'pre_get_posts' , array( $tour , 'change_search_tour_arg' ) );
                break;
            case"st_activity":
                remove_action( 'pre_get_posts' , array( $activity , 'change_search_activity_arg' ) );
                break;
        }
        if(!empty($_REQUEST['st_test'])){}
        wp_reset_query();
        if($location_center =='[,]')$location_center='[0,0]';
        $data_tmp = array(
            'location_center' => $location_center ,
            'zoom'            => $zoom ,
            'data_map'        => $data_map ,
            'style_map'       => $style_map ,
            'number'          => $number ,
            'address_center'  => $address_center ,
            'map_lat_center'  => $map_lat_center ,
            'map_lng_center'  => $map_lng_center ,
        );


        echo json_encode( $data_tmp );

        die();
    }
}
add_action( 'wp_ajax_st_search_list_half_map' , 'st_search_list_half_map' );
add_action( 'wp_ajax_nopriv_st_search_list_half_map' , 'st_search_list_half_map' );
