<?php
    if(function_exists('vc_map')){
        vc_map( array(
            "name" => __("ST Tour Search Results", ST_TEXTDOMAIN),
            "base" => "st_tour_content_search",
            "content_element" => true,
            "icon" => "icon-st",
            "category"=>'Shinetheme',
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Style", ST_TEXTDOMAIN),
                    "param_name" => "st_style",
                    "description" =>"",
                    "value" => array(
                        __('--Select--',ST_TEXTDOMAIN)=>'',
                        __('List',ST_TEXTDOMAIN)=>'1',
                        __('Grid',ST_TEXTDOMAIN)=>'2',
                    ),
                )
            )
        ) );
    }

    if(!function_exists('st_vc_tour_content_search')){
        function st_vc_tour_content_search($attr,$content=false)
        {
            $default=array(
                'st_style'=>1
            );
            $attr=wp_parse_args($attr,$default);
            //if(is_search())
            //{
                return st()->load_template('tours/content','tours',array('attr'=>$attr));
            //}
        }
    }
    st_reg_shortcode('st_tour_content_search','st_vc_tour_content_search');