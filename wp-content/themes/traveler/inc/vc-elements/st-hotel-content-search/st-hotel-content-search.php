<?php
    if(function_exists('vc_map')){
        vc_map( array(
            "name" => __("ST Hotel Search Result", ST_TEXTDOMAIN),
            "base" => "st_search_hotel_result",
            "content_element" => true,
            "icon" => "icon-st",
            "category"=>"Shinetheme",
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Style", ST_TEXTDOMAIN),
                    "param_name" => "style",
                    "description" =>"",
                    "value" => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('List',ST_TEXTDOMAIN)=>'list',
                        __('Grid',ST_TEXTDOMAIN)=>'grid',
                    ),
                )
            )
        ) );
    }
    if(!function_exists('st_vc_search_hotel_result')){
        function st_vc_search_hotel_result($arg=array())
        {
            $default=array(
                'style'=>'grid'
            );
            $arg=wp_parse_args($arg,$default);

            if(!get_post_type()=='st_hotel' and get_query_var('post_type')!="st_hotel") return;

            return st()->load_template('hotel/search-elements/result',false,array('arg'=>$arg));
        }
    }
    st_reg_shortcode('st_search_hotel_result','st_vc_search_hotel_result');
