<?php
if(function_exists( 'vc_map' )) {
    $list_taxonomy = st_list_taxonomy( 'st_tours' );
    $list_taxonomy = array_merge( array( "---Select---" => "" ) , $list_taxonomy );

    $list_location                                              = TravelerObject::get_list_location();
    $list_location_data[ __( '-- Select --' , ST_TEXTDOMAIN ) ] = '';
    if(!empty( $list_location )) {
        foreach( $list_location as $k => $v ) {
            $list_location_data[ $v[ 'title' ] ] = $v[ 'id' ];
        }
    }

    $params  = array(
        array(
            "type"             => "textfield" ,
            "holder"           => "div" ,
            "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
            "param_name"       => "title" ,
            "description"      => "" ,
            "value"            => "" ,
            'edit_field_class' => 'vc_col-sm-6' ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Font Size" , ST_TEXTDOMAIN ) ,
            "param_name"       => "font_size" ,
            "description"      => "" ,
            "value"            => array(
                __('--Select--',ST_TEXTDOMAIN)=>'',
                __( "H1" , ST_TEXTDOMAIN ) => '1' ,
                __( "H2" , ST_TEXTDOMAIN ) => '2' ,
                __( "H3" , ST_TEXTDOMAIN ) => '3' ,
                __( "H4" , ST_TEXTDOMAIN ) => '4' ,
                __( "H5" , ST_TEXTDOMAIN ) => '5' ,
            ) ,
            'edit_field_class' => 'vc_col-sm-6' ,
        ) ,
        array(
            "type"        => "textfield" ,
            "holder"      => "div" ,
            "heading"     => __( "List ID in Tour" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_ids" ,
            "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
            'value'       => "" ,
        ) ,
        array(
            "type"        => "textfield" ,
            "holder"      => "div" ,
            "heading"     => __( "Number tour" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_number_tour" ,
            "description" => "" ,
            'value'       => 4 ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_orderby" ,
            "description"      => "" ,
            'edit_field_class' => 'vc_col-sm-6' ,
            'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by(
                array(
                    __( 'Price' , ST_TEXTDOMAIN )            => 'sale' ,
                    __( 'Rate' , ST_TEXTDOMAIN )             => 'rate' ,
                    __( 'Discount rate' , ST_TEXTDOMAIN )    => 'discount' ,
                    __( 'Last Minute Deal' , ST_TEXTDOMAIN ) => 'last_minute_deal' ,
                )
            ) : array() ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_order" ,
            'value'            => array(
                __('--Select--',ST_TEXTDOMAIN)=>'',
                __( 'Asc' , ST_TEXTDOMAIN )  => 'asc' ,
                __( 'Desc' , ST_TEXTDOMAIN ) => 'desc'
            ) ,
            'edit_field_class' => 'vc_col-sm-6' ,
            "description"      => __( "" , ST_TEXTDOMAIN )
        ) ,
        array(
            "type"        => "dropdown" ,
            "holder"      => "div" ,
            "heading"     => __( "Style Tour" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_style" ,
            "description" => "" ,
            'value'       => array(
                __('--Select--',ST_TEXTDOMAIN)=>'',
                __( 'Style 1' , ST_TEXTDOMAIN ) => 'style_1' ,
                __( 'Style 2' , ST_TEXTDOMAIN ) => 'style_2' ,
                __( 'Style 3' , ST_TEXTDOMAIN ) => 'style_3' ,
                __( 'Style 4' , ST_TEXTDOMAIN ) => 'style_4' ,
            ) ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Number tour of row" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_tour_of_row" ,
            'edit_field_class' => 'vc_col-sm-12' ,
            "value"            => array(
                __('--Select--',ST_TEXTDOMAIN)=>'',
                __( 'Four' , ST_TEXTDOMAIN )  => '4' ,
                __( 'Three' , ST_TEXTDOMAIN ) => '3' ,
                __( 'Two' , ST_TEXTDOMAIN )   => '2' ,
            ) ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Only in Featured Location" , ST_TEXTDOMAIN ) ,
            "param_name"       => "only_featured_location" ,
            'edit_field_class' => 'vc_col-sm-12' ,
            "value"            => array(
                __('--Select--',ST_TEXTDOMAIN)=>'',
                __( 'No' , ST_TEXTDOMAIN )  => 'no' ,
                __( 'Yes' , ST_TEXTDOMAIN ) => 'yes' ,
            ) ,
        ) ,
        array(
            "type"        => "dropdown" ,
            "holder"      => "div" ,
            "heading"     => __( "Location" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_location" ,
            "description" => __( "Location" , ST_TEXTDOMAIN ) ,
            'value'       => $list_location_data ,
        ) ,
        array(
            "type"        => "dropdown" ,
            "holder"      => "div" ,
            "heading"     => __( "Sort By Taxonomy" , ST_TEXTDOMAIN ) ,
            "param_name"  => "sort_taxonomy" ,
            "description" => "" ,
            "value"       => $list_taxonomy ,
        ) ,
    );
    $data_vc = STTour::get_taxonomy_and_id_term_tour();
    $params  = array_merge( $params , $data_vc[ 'list_vc' ] );
    vc_map( array(
        "name"            => __( "ST List Tour" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_tour" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => "Shinetheme" ,
        "params"          => $params
    ) );
}
if(!function_exists( 'st_vc_list_tour' )) {
    function st_vc_list_tour( $attr , $content = false )
    {
        $data_vc = STTour::get_taxonomy_and_id_term_tour();
        $param   = array(
            'st_ids'                 => '' ,
            'st_number_tour'         => 4 ,
            'st_order'               => '' ,
            'st_orderby'             => '' ,
            'st_tour_of_row'         => '' ,
            'st_style'               => 'style_1' ,
            'only_featured_location' => 'no' ,
            'st_location'            => '' ,
            'sort_taxonomy'          => '' ,
            'title'                  => '' ,
            'font_size'              => '3' ,
        );
        $param   = array_merge( $param , $data_vc[ 'list_id_vc' ] );
        $data    = shortcode_atts( $param , $attr , 'st_list_tour' );
        extract( $data );

        $page = STInput::request( 'paged' );
        if(!$page) {
            $page = get_query_var( 'paged' );
        }
        $query = array(
            'post_type'      => 'st_tours' ,
            'posts_per_page' => $st_number_tour ,
            'paged'          => $page ,
            'order'          => $st_order ,
            'orderby'        => $st_orderby
        );
        if(!empty( $st_ids )) {
            $query[ 'post__in' ] = explode( ',' , $st_ids );
        }
        if($st_orderby == 'sale') {
            $query[ 'meta_key' ] = 'price';
            $query[ 'orderby' ]  = 'meta_value';
        }
        if($st_orderby == 'rate') {
            $query[ 'meta_key' ] = 'rate_review';
            $query[ 'orderby' ]  = 'meta_value';
        }
        if($st_orderby == 'discount') {
            $query[ 'meta_key' ] = 'discount';
            $query[ 'orderby' ]  = 'meta_value';
        }
        if($st_orderby == 'last_minute_deal') {

            /*$query['meta_key']='discount';
            $query['orderby']='meta_value';
            $query['order']='DESC';*/
            $query[ 'meta_query' ][ ] = array(
                'key'     => 'is_sale_schedule' ,
                'value'   => 'on' ,
                'compare' => "="
            );

        }
        if(!empty( $sort_taxonomy )) {
            if(isset( $attr[ "id_term_" . $sort_taxonomy ] )) {
                $id_term              = $attr[ "id_term_" . $sort_taxonomy ];
                $query[ 'tax_query' ] = array(
                    array(
                        'taxonomy' => $sort_taxonomy ,
                        'field'    => 'id' ,
                        'terms'    => explode( ',' , $id_term )
                    ) ,
                );
            }
        }

        if($only_featured_location == 'yes') {

            $STLocation = new STLocation();
            $featured   = $STLocation->get_featured_ids();

            $query[ 'meta_query' ][ ] = array(
                'key'     => 'id_location' ,
                'value'   => $featured ,
                'compare' => "IN"
            );
        }
        if(!empty( $st_location )) {
            $query[ 'meta_query' ][ ] = array(
                'key'     => 'id_location' ,
                'value'   => $st_location ,
                'compare' => "IN"
            );
        }


        query_posts( $query );

        if($st_style == 'style_1') {
            $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop' , '' , $data ) . "</div>";
        }
        if($st_style == 'style_2') {
            $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop2' , '' , $data ) . "</div>";
        }
        if($st_style == 'style_3') {
            $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop3' , '' , $data ) . "</div>";
        }
        if($st_style == 'style_4') {
            $r = "<div class='list_tours'>" . st()->load_template( 'vc-elements/st-list-tour/loop4' , '' , $data ) . "</div>";
        }
        wp_reset_query();

        if(!empty( $title ) and !empty( $r )) {
            $r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
        }
        return $r;
    }
}
st_reg_shortcode( 'st_list_tour' , 'st_vc_list_tour' );