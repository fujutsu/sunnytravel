<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 12/15/14
 * Time: 9:44 AM
 */

/**
 * ST Thumbnail Tour
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Thumbnail" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_thumbnail_tours' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array()
        )
    );
}

if(!function_exists( 'st_thumbnail_tours_func' )) {
    function st_thumbnail_tours_func()
    {
        if(is_singular( 'st_tours' )) {
            return st()->load_template( 'tours/elements/image' , 'featured' );
        }
    }

    st_reg_shortcode( 'st_thumbnail_tours' , 'st_thumbnail_tours_func' );
}

/**
 * ST Excerpt Tour
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Excerpt" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_excerpt_tour' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
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
            )
        )
    );
}
if(!function_exists( 'st_excerpt_tours_func' )) {
    function st_excerpt_tours_func( $attr = array() )
    {
        if(is_singular( 'st_tours' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => '3' ,
            );
            extract( wp_parse_args( $attr , $default ) );
            $html = '<blockquote class="center">' . get_the_excerpt() . "</blockquote>";
            if(!empty( $title ) and !empty( $html )) {
                $html = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $html;
            }
            return $html;
        }
    }

    st_reg_shortcode( 'st_excerpt_tour' , 'st_excerpt_tours_func' );
}


/**
 * ST Tour Content
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Content" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_content' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
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
            )
        )
    );
}
if(!function_exists( 'st_tour_content_func' )) {
    function st_tour_content_func( $attr = array() )
    {
        if(is_singular( 'st_tours' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => 1 ,
            );
            extract( wp_parse_args( $attr , $default ) );
            $html = st()->load_template( 'tours/elements/content' , 'tours' );
            if(!empty( $title ) and !empty( $html )) {
                $html = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $html;
            }
            return $html;
        }
    }

    st_reg_shortcode( 'st_tour_content' , 'st_tour_content_func' );
}

/**
 * ST Info Tour
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Info" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_info_tours' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array()
        )
    );
}
if(!function_exists( 'st_info_tours_func' )) {
    function st_info_tours_func()
    {
        if(is_singular( 'st_tours' )) {
            return st()->load_template( 'tours/elements/info' , 'tours' );
        }
    }

    st_reg_shortcode( 'st_info_tours' , 'st_info_tours_func' );
}

/**
 * ST Tour Detail Map
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Detailed Tour Map" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_detail_map' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array()
        )
    );
}

if(!function_exists( 'st_tour_detail_map' )) {
    function st_tour_detail_map()
    {
        if(is_singular( 'st_tours' )) {

            $lat  = get_post_meta( get_the_ID() , 'map_lat' , true );
            $lng  = get_post_meta( get_the_ID() , 'map_lng' , true );
            $zoom = get_post_meta( get_the_ID() , 'map_zoom' , true );
            $html = ' <div style="width:100%; height:500px;" class="st_google_map" data-type="2" data-lat="' . $lat . '"
                         data-lng="' . $lng . '"
                         data-zoom="' . $zoom . '"
                        ></div>';
            return $html;
        }
    }
}

/**
 * ST Tour Detail Review Summary
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Review Summary" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_detail_review_summary' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array()
        )
    );
}
if(!function_exists( 'st_tour_detail_review_summary' )) {
    function st_tour_detail_review_summary()
    {

        if(is_singular( 'st_tours' )) {
            return st()->load_template( 'tours/elements/review_summary' );
        }
    }
}

/**
 * ST Tour Detail Review Detail
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Detailed Tour Review" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_detail_review_detail' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array()
        )
    );
}
if(!function_exists( 'st_tour_detail_review_detail' )) {
    function st_tour_detail_review_detail()
    {
        if(is_singular( 'st_tours' )) {
            return st()->load_template( 'tours/elements/review_detail' );
        }
    }
}


/**
 * ST Tour Program
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Program" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_program' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
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
            )
        )
    );
}
if(!function_exists( 'st_tour_program' )) {
    function st_tour_program( $attr = array() )
    {
        if(is_singular( 'st_tours' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => '3' ,
            );
            extract( wp_parse_args( $attr , $default ) );
            $html = st()->load_template( 'tours/elements/program' );
            if(!empty( $title ) and !empty( $html )) {
                $html = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $html;
            }
            return $html;

        }
    }
}
st_reg_shortcode( 'st_tour_program' , 'st_tour_program' );

/**
 * ST Tour Share
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Share" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_share' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array()
        )
    );
}
if(!function_exists( 'st_tour_share' )) {
    function st_tour_share()
    {
        if(is_singular( 'st_tours' )) {
            return '<div class="package-info tour_share" style="clear: both;text-align: right">
                    ' . st()->load_template( 'hotel/share' ) . '
                </div>';
        }
    }
}
st_reg_shortcode( 'st_tour_share' , 'st_tour_share' );


/**
 * ST Tour Review
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Review" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_review' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
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
            )
        )
    );
}

if(!function_exists( 'st_tour_review' )) {
    function st_tour_review( $attr = array() )
    {
        if(is_singular( 'st_tours' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => '3' ,
            );
            extract( wp_parse_args( $attr , $default ) );
            if(comments_open() and st()->get_option( 'activity_tour_review' ) != 'off') {
                ob_start();
                comments_template( '/reviews/reviews.php' );
                $html = @ob_get_clean();
                if(!empty( $title ) and !empty( $html )) {
                    $html = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $html;
                }
                return $html;
            }

        }
    }
}


/**
 * ST Tour Price
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Price" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_price' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array()
        )
    );
}

if(!function_exists( 'st_tour_price' )) {

    function st_tour_price( $attr = array() )
    {
        if(is_singular( 'st_tours' )) {
            return st()->load_template( 'tours/elements/price' );
        }
    }
}


/**
 * ST Tour Video
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Video" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_video' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => false ,
            'params'                  => array()
        )
    );
}
if(!function_exists( 'st_tour_video' )) {
    function st_tour_video( $attr = array() )
    {
        if(is_singular( 'st_tours' )) {
            if($video = get_post_meta( get_the_ID() , 'video' , true )) {
                return "<div class='media-responsive'>" . wp_oembed_get( $video ) . "</div>";
            }
        }
    }
}

/**
 * ST Tour Nearby
 * @since 1.1.0
 **/
if(function_exists( 'vc_map' )) {
    vc_map(
        array(
            'name'                    => __( "ST Tour Nearby" , ST_TEXTDOMAIN ) ,
            'base'                    => 'st_tour_nearby' ,
            'content_element'         => true ,
            'icon'                    => 'icon-st' ,
            'category'                => 'Tour' ,
            'show_settings_on_create' => true ,
            'params'                  => array(
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
            )
        )
    );
}
if(!function_exists( 'st_tour_nearby' )) {
    function st_tour_nearby( $arg = array() )
    {
        if(is_singular( 'st_tours' )) {
            $default = array(
                'title'     => '' ,
                'font_size' => '3' ,
            );
            extract( $data = wp_parse_args( $arg , $default ) );
            return st()->load_template( 'tours/elements/nearby' , '' , $data );
        }
    }
}


st_reg_shortcode( 'st_tour_nearby' , 'st_tour_nearby' );


st_reg_shortcode( 'st_tour_video' , 'st_tour_video' );

st_reg_shortcode( 'st_tour_price' , 'st_tour_price' );


st_reg_shortcode( 'st_tour_review' , 'st_tour_review' );

st_reg_shortcode( 'st_tour_detail_list_schedules' , 'st_tour_detail_list_schedules' );


st_reg_shortcode( 'st_tour_detail_review_detail' , 'st_tour_detail_review_detail' );
st_reg_shortcode( 'st_tour_detail_review_summary' , 'st_tour_detail_review_summary' );

st_reg_shortcode( 'st_tour_detail_map' , 'st_tour_detail_map' );

