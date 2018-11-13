<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STLocation
 *
 * Created by ShineTheme
 *
 */
if (!class_exists('STLocation')) {
    class STLocation extends TravelerObject
    {
        public $post_type = 'location';
        function init()
        {
            
            parent::init();
            //$this->init_metabox();
            add_action('init', array(
                $this,
                'init_metabox'
            ), 9);
            
            add_action('wp_ajax_st_search_location', array(
                $this,
                'search_location'
            ));
            add_action('wp_ajax_nopriv_st_search_location', array(
                $this,
                'search_location'
            ));
            add_action('widgets_init', array(
                $this,
                'add_sidebar'
            ));
            add_action('wp_enqueue_scripts', array(
                $this,
                'add_script'
            ));
            add_action('wp_enqueue_scripts', array(
                __CLASS__,
                'get_list_post_type'
            ));

            add_action('save_post', array($this, 'save_location'), 50);
        }
        public function save_location(){
            if(get_post_type() == 'location'){

                update_option('st_allow_save_location', 'allow' );

                update_option('st_allow_save_cache_location', 'allow');
            }
        }
        public function add_script()
        {
            if(is_singular('location'))
            wp_enqueue_script('location_script', get_template_directory_uri() . '/js/location.js', array('jquery'), null, true);
            //wp_enqueue_script('location_script', get_template_directory_uri() . '/js/location2.js', array('jquery'), null, true);
        }
        static public function get_post_type_list_active()
        {
            $array = array();
            if (st_check_service_available('st_cars')) {
                $array[] = 'st_cars';
            }
            if (st_check_service_available('st_hotel')) {
                $array[] = 'st_hotel';
            }
            if (st_check_service_available('st_tours')) {
                $array[] = 'st_tours';
            }
            if (st_check_service_available('st_rental')) {
                $array[] = 'st_rental';
            }
            if (st_check_service_available('st_activity')) {
                $array[] = 'st_activity';
            }
            if (st_check_service_available('hotel_room')) {
                $array[] = 'hotel_room';
            }
            
            return $array;
        }
        
        function get_featured_ids($arg = array())
        {
            $default = array(
                'posts_per_page' => 10,
                'post_type' => 'location'
            );
            
            extract(wp_parse_args($arg, $default));
            
            $ids = array();
            
            $query = array(
                'posts_per_page' => $posts_per_page,
                'post_type' => $post_type,
                'meta_key' => 'is_featured',
                'meta_value' => 'on'
            );
            
            $q = new WP_Query($query);
            
            while ($q->have_posts()) {
                $q->the_post();
                $ids[] = get_the_ID();
            }
            
            //wp_reset_query();
            
            return $ids;
        }
        
        function search_location()
        {
            //Small security
            check_ajax_referer('st_search_security', 'security');
            
            $s   = STInput::get('s');
            $arg = array(
                'post_type' => 'location',
                'posts_per_page' => 10,
                's' => $s
            );
            
            if ($s) {
            }
            
            global $wp_query;
            
            query_posts($arg);
            $r = array();
            
            while (have_posts()) {
                the_post();
                
                $r['data'][] = array(
                    'title' => get_the_title(),
                    'id' => get_the_ID(),
                    'type' => __('Location', ST_TEXTDOMAIN)
                );
            }
            wp_reset_query();
            echo json_encode($r);
            
            die();
        }
        
        function init_metabox()
        {
            $metabox        = array(
                'id' => 'st_location',
                'title' => __('Location Setting', ST_TEXTDOMAIN),
                'pages' => array(
                    'location'
                ),
                'context' => 'normal',
                'priority' => 'high',
                'fields' => array(
                    array(
                        'label' => __('Location Information', ST_TEXTDOMAIN),
                        'id' => 'detail_tab',
                        'type' => 'tab'
                    ),
                    array(
                        'label' => __('Logo', ST_TEXTDOMAIN),
                        'id' => 'logo',
                        'type' => 'upload',
                        'desc' => __('logo', ST_TEXTDOMAIN)
                    ),
                    array(
                        'label' => __('Set as Featured', ST_TEXTDOMAIN),
                        'id' => 'is_featured',
                        'type' => 'on-off',
                        'desc' => __('Set this location is featured', ST_TEXTDOMAIN),
                        'std' => 'off'
                    ),
                    array(
                        'label' => __('Zip Code', ST_TEXTDOMAIN),
                        'id' => 'zipcode',
                        'type' => 'text',
                        'desc' => __('Zip code of this location', ST_TEXTDOMAIN)
                    ),
                    array(
                        'label' => __('Latitude', ST_TEXTDOMAIN),
                        'id' => 'map_lat',
                        'type' => 'text',
                        'desc' => __('Latitude <a href="http://www.latlong.net/" target="_blank">Get here</a>', ST_TEXTDOMAIN)
                    ),
                    
                    array(
                        'label' => __('Longitude', ST_TEXTDOMAIN),
                        'id' => 'map_lng',
                        'type' => 'text',
                        'desc' => __('Longitude', ST_TEXTDOMAIN)
                    ),
                    array(
                        'label' => __('Location gallery display', ST_TEXTDOMAIN),
                        'id' => 'location_gallery_setting',
                        'type' => 'tab'
                    ),
                    array(
                        'label' => __('Location gallery style', ST_TEXTDOMAIN),
                        'id' => 'location_gallery_style',
                        'type' => 'select',
                        'desc' => __('Select your location style', ST_TEXTDOMAIN),
                        'choices' => array(
                            array(
                                'value' => '',
                                'label' => __('--- Select ---', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => '1',
                                'label' => __('Fotorama stage', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => '2',
                                'label' => __('Fotorama stage without nav', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => '3',
                                'label' => __('Light box gallery', ST_TEXTDOMAIN)
                            )
                        )
                    ),
                    array(
                        'label' => __('Images per row', ST_TEXTDOMAIN),
                        'id' => 'image_count',
                        'type' => 'select',
                        'desc' => 'Choose your count num',
                        'condition' => 'location_gallery_style:is(3)',
                        'choices' => array(
                            array(
                                'value' => '',
                                'label' => __(' --- Select ---', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => '3',
                                'label' => __('3 images', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => '4',
                                'label' => __('4 images', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => '6',
                                'label' => __('6 images', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => '12',
                                'label' => __('12 images', ST_TEXTDOMAIN)
                            )
                        )
                    ),
                    array(
                        'label' => __('Location tab setting', ST_TEXTDOMAIN),
                        'id' => 'location_tab_setting',
                        'type' => 'tab'
                    ),
                    array(
                        'label' => __('Tab navigation position', ST_TEXTDOMAIN),
                        'id' => 'tab_position',
                        'type' => 'select',
                        'desc' => 'Choose your tab Navigation position',
                        'choices' => array(
                            array(
                                'value' => '',
                                'label' => __(' --- Select ---', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'top',
                                'label' => __('Top', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'right',
                                'label' => __('Right', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'left',
                                'label' => __('Left', ST_TEXTDOMAIN)
                            )
                        )
                    ),
                    array(
                        'label' => __("Information text title"),
                        'id' => 'information_text_title',
                        'type' => 'text',
                        'desc' => "Name of Information tab",
                        'std' => __("Location Information")
                    ),
                    array(
                        'label' => __("Information icon class"),
                        'id' => 'tab_icon_info_icon',
                        'type' => 'text',
                        'std' => __("fa fa-info")
                    ),
                    array(
                        'label' => __('Show Information tab item', ST_TEXTDOMAIN),
                        'id' => 'info_location_tab_item_enable',
                        'type' => 'on-off',
                        'desc' => '<b>Enable </b> it add item into information tab, <b>Disable </b> to get content of Location',
                        'std' => 'off'
                    ),
                    array(
                        'label' => __('Information tab item position', ST_TEXTDOMAIN),
                        'id' => 'info_location_tab_item_position',
                        'type' => 'select',
                        'choices' => array(
                            array(
                                'value' => '',
                                'label' => __(' --- Select ---', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'top',
                                'label' => __('Top', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'right',
                                'label' => __('Right', ST_TEXTDOMAIN)
                            ),
                            array(
                                'value' => 'left',
                                'label' => __('Left', ST_TEXTDOMAIN)
                            )
                        ),
                        'condition' => 'info_location_tab_item_enable:is(on)',
                        'std' => 'on'
                    ),
                    array(
                        'label' => __('Information tab Item', ST_TEXTDOMAIN),
                        'id' => 'info_tab_item',
                        'type' => 'list-item',
                        'desc' => 'Add new item',
                        'condition' => 'info_location_tab_item_enable:is(on)',
                        'settings' => array(
                            array(
                                'id' => 'post_info_select',
                                'label' => __('Post from', ST_TEXTDOMAIN),
                                'type' => 'select',
                                'choices' => self::get_list_post_location_info()
                            )
                        ),
                        array(
                            'id' => 'post_info_icon',
                            'label' => __('icon ', ST_TEXTDOMAIN),
                            'type' => 'text'
                        )
                    ),
                    array(
                        'label' => __("Show Map tab", ST_TEXTDOMAIN),
                        'id' => 'map_tab',
                        'type' => 'on-off',
                        'desc' => __('On to enable map tab in Tab', ST_TEXTDOMAIN),
                        'std' => 'on'
                    ),
                    array(
                        'label' => __('Map tab name', ST_TEXTDOMAIN),
                        'id' => 'map_tab_name',
                        'type' => 'text',
                        'condition' => 'map_tab:is(on)',
                        'std' => 'Map'
                    ),
                    array(
                        'label' => __('Map tab icon', ST_TEXTDOMAIN),
                        'id' => 'tab_icon_map',
                        'type' => 'text',
                        'condition' => 'map_tab:is(on)',
                        'std' => 'fa fa-map-marker'
                    ),
                    array(
                        'label' => __('Map zoom', ST_TEXTDOMAIN),
                        'id' => 'map_zoom_location',
                        'type' => 'numeric-slider',
                        'condition' => 'map_tab:is(on)',
                        'min_max_step' => '0,21,1' ,
                        'std'   => 15
                    ),
                    array(
                        'label' => __('Map height', ST_TEXTDOMAIN),
                        'id' => 'map_height',
                        'type' => 'text',
                        'description'=>"px",
                        'condition' => 'map_tab:is(on)',
                        'std'   => 500
                    ),
                    array(
                        'label' => __('Maxium number of spots', ST_TEXTDOMAIN),
                        'id' => 'max_post_type_num',
                        'type' => 'text',
                        'condition' => 'map_tab:is(on)',
                        'std'   => 36
                    ),
                    array(
                        'label' => __('Map style', ST_TEXTDOMAIN),
                        'id' => 'map_location_style',
                        'type' => 'select',
                        'condition' => 'map_tab:is(on)',
                        'std'   => 'normal',
                        'choices'=>array(
                            array(
                                'value'=>'normal',
                                'label'=>__('Normal',ST_TEXTDOMAIN)
                            ),
                            array(
                                'value'=>'midnight',
                                'label'=>__('Midnight',ST_TEXTDOMAIN)
                            ),
                            array(
                                'value'=>'family_fest',
                                'label'=>__('Family fest',ST_TEXTDOMAIN)
                            ),
                            array(
                                'value'=>'open_dark',
                                'label'=>__('Open dark',ST_TEXTDOMAIN)
                            ),
                            array(
                                'value'=>'riverside',
                                'label'=>__('River side',ST_TEXTDOMAIN)
                            ),
                            array(
                                'value'=>'ozan',
                                'label'=>__('Ozan',ST_TEXTDOMAIN)
                            ),
                        )
                    ),

                )
            );
            $list_post_type = $this->get_post_type_list_active();
            if (is_array($list_post_type) and !empty($list_post_type)) {
                foreach ($list_post_type as $key => $value) {
                    
                    $metabox['fields'][] = array(
                        'label' => __("Show ", ST_TEXTDOMAIN) . self::get_post_type_name($value) . __(' tab', ST_TEXTDOMAIN),
                        'id' => 'tab_enable_' . $value,
                        'type' => 'on-off',
                        'desc' => __("Show ", ST_TEXTDOMAIN) . self::get_post_type_name($value) . __(' tab', ST_TEXTDOMAIN),
                        'std' => 'off'
                    );
                    $metabox['fields'][] = array(
                        'label' => self::get_post_type_name($value) . __(' tab name ', ST_TEXTDOMAIN),
                        'id' => 'tab_name_' . $value,
                        'type' => 'text',
                        'condition' => 'tab_enable_' . $value . ':is(on)',
                        'std' => self::get_post_type_name($value)
                    );
                    $metabox['fields'][] = array(
                        'label' => self::get_post_type_name($value) . __(' tab icon ', ST_TEXTDOMAIN),
                        'id' => 'tab_icon_' . $value,
                        'type' => 'text',
                        'condition' => 'tab_enable_' . $value . ':is(on)',
                        'std' => self::get_default_icon($value)
                    );
                }
                
            }
            ;
            $this->metabox[] = $metabox;
            
            
            
        }
        /**
         * @since 1.1.3
         * count post type in a location
         *
         */
        static function get_count_post_type($post_type, $location_id = null)
        {
            global $wpdb;
            $meta_key = "id_location";
            if ($post_type == "st_rental") {
                $meta_key = "location_id";
            }
            if (!$location_id) {
                $location_id = get_the_ID();
            }
            $sql     = "
                SELECT ID FROM `{$wpdb->posts}` join {$wpdb->postmeta} on {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID 
                where {$wpdb->posts}.post_type = '{$post_type}'
                and {$wpdb->posts}.post_status = 'publish'
                and {$wpdb->postmeta}.meta_key = '{$meta_key}'
                and {$wpdb->postmeta}.meta_value = '{$location_id}'
                group by {$wpdb->posts}.ID;
                ";
            $results = $wpdb->get_results($sql, OBJECT);
            wp_reset_query();
            return ($wpdb->num_rows);
            
        }
        
        /**
         * @since 1.1.3
         * text in footer location element
         *
         */
        
        static function get_total_text_footer($post_type)
        {
            /* Example 10 cars in paris*/
            
            $link            = STLocation::get_link_search($post_type);
            $count_post_type = STLocation::get_count_post_type($post_type);
            
            if ($post_type == "st_cars") {
                $post_type_names = __(' cars ', ST_TEXTDOMAIN);
                $post_type_name  = __(' car ', ST_TEXTDOMAIN);
            }
            if ($post_type == "st_hotel") {
                $post_type_names = __(' hotels ', ST_TEXTDOMAIN);
                $post_type_name  = __(' hotel ', ST_TEXTDOMAIN);
            }
            if ($post_type == "st_rental") {
                $post_type_names = __(' rentals ', ST_TEXTDOMAIN);
                $post_type_name  = __(' rental ', ST_TEXTDOMAIN);
            }
            if ($post_type == "st_tours") {
                $post_type_names = __(' tours ', ST_TEXTDOMAIN);
                $post_type_name  = __(' tour ', ST_TEXTDOMAIN);
            }
            if ($post_type == "st_activity") {
                $post_type_names = __(' activities ', ST_TEXTDOMAIN);
                $post_type_name  = __(' activity ', ST_TEXTDOMAIN);
            }
            
            $text = "";
            $return  = "";
            if ($count_post_type > 1) {
                $text .= esc_html($count_post_type) . $post_type_names;
            } else {
                $text .= esc_html($count_post_type) . $post_type_name;
            }
            $text .= __(" in ", ST_TEXTDOMAIN) . get_the_title() . " .";
            $return .= "
                    <div class='text-right'>
                        <span>" . $text . "</span>
                        <a href=" . esc_url($link) . ">" . __("View all", ST_TEXTDOMAIN) . "</a>
                    </div>
                ";
            return $return;
        }
        /**
         * @since 1.1.2
         * create new location static sidebar 
         * 
         *
         */
        function add_sidebar()
        {
            register_sidebar(array(
                'name' => __('Location sidebar ', ST_TEXTDOMAIN),
                'id' => 'location-sidebar',
                'description' => __('Widgets in this area will be show information in current Location', ST_TEXTDOMAIN),
                'before_title' => '<h4>',
                'after_title' => '</h4>',
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget' => '</div>'
            ));
        }
        static function get_info_by_post_type($id, $post_type = null, $location_id_s = NULL)
        {
            
            if (in_array($post_type, array(
                "hotel",
                "hotels",
                "st_hotels"
            ))) {
                $post_type = "st_hotel";
            }
            if (in_array($post_type, array(
                "car",
                "cars",
                "st_car"
            ))) {
                $post_type = "st_cars";
            }
            if (in_array($post_type, array(
                "rental",
                "rentals",
                "st_rentals"
            ))) {
                $post_type = "st_rental";
            }
            if (in_array($post_type, array(
                "activity",
                "activities",
                "st_activity"
            ))) {
                $post_type = "st_activity";
            }
            if (in_array($post_type, array(
                "tour",
                "tours",
                "st_tour"
            ))) {
                $post_type = "st_tours";
            }
            if (!$post_type) {
                return;
            }
            
            $location_meta_text = 'id_location';
            if ($post_type == 'st_rental') {
                $location_meta_text = 'location_id';
            }
            $location_id = get_the_ID();
            if ($location_id_s) {
                $location_id = $location_id_s;
            }
            global $wpdb;
            
            $sql = "SELECT ID
                FROM `{$wpdb->postmeta}` 
                JOIN `{$wpdb->posts}` 
                ON  {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id 
                    and {$wpdb->postmeta}.meta_key = '{$location_meta_text}' 
                    and {$wpdb->postmeta}.meta_value = '{$location_id}'
                    and {$wpdb->posts}.post_status = 'publish'
                    and {$wpdb->posts}.post_type = '{$post_type}'
                GROUP BY {$wpdb->posts}.ID";
            
            $results     = $wpdb->get_results($sql, OBJECT);
            $num_rows    = $wpdb->num_rows;
            // get review = count all comment number
            $comment_num = 0;
            foreach ($results as $row) {
                $comment_num = $comment_num + STReview::count_all_comment($row->ID);
            }
            ;
            wp_reset_query();
            if ($num_rows > 1) {
                $name = self::get_post_type_name($post_type);
            } else {
                $name = self::get_post_type_name($post_type, true);
            }
            return array(
                'post_type' => $post_type,
                'post_type_name' => $name,
                'reviews' => $comment_num,
                'offers' => $num_rows,
                'min_max_price' => self::get_min_max_price_location($post_type, $location_id)
            );
            
        }
        /**
         * @package Wordpress
         * @subpackage traveler
         * @since 1.1.3
         *
         */
        static function get_post_type_name($post_type, $is_single = NULL)
        {
            ob_start();
            
            if ($is_single) {
                if ($post_type == "st_cars") {
                    st_the_language("car");
                }
                if ($post_type == "st_tours") {
                    st_the_language("tour");
                }
                if ($post_type == "st_rental") {
                    st_the_language("rental");
                }
                if ($post_type == "st_activity") {
                    st_the_language("activity");
                }
                if ($post_type == "st_hotel") {
                    st_the_language("hotel");
                }
            } else {
                if ($post_type == "st_cars") {
                    st_the_language("cars");
                }
                if ($post_type == "st_tours") {
                    st_the_language("tours");
                }
                if ($post_type == "st_rental") {
                    st_the_language("rentals");
                }
                if ($post_type == "st_activity") {
                    st_the_language("activities");
                }
                if ($post_type == "st_hotel") {
                    st_the_language("hotels");
                }
            }
            $return = ob_get_clean();
            return $return;
        }
        /**
         *
         * since 1.1.2
         * get single price
         *
         */
        public static function get_item_price($post_id)
        {
            if (!$post_id) {
                $post_id = get_the_ID();
            }
            $post_type = get_post_type($post_id);
            $discount  = get_post_meta($post_id, 'discount', true);
            if ($post_type == "st_rental" or $post_type == "hotel_room") {
                $discount = get_post_meta($post_id, 'discount_rate', true);
            }
            $is_sale_schedule = get_post_meta($post_id, 'is_sale_schedule', true);
            
            if ($post_type == "st_cars") {
                $price = get_post_meta($post_id, 'cars_price', true);
            } else {
                $price = get_post_meta($post_id, 'price', true);
            }
            if ($is_sale_schedule == 'on') {
                $sale_from = get_post_meta($post_id, 'sale_price_from', true);
                $sale_to   = get_post_meta($post_id, 'sale_price_to', true);
                if ($sale_from) {
                    
                    $today     = date('Y-m-d');
                    $sale_from = date('Y-m-d', strtotime($sale_from));
                    $sale_to   = date('Y-m-d', strtotime($sale_to));
                    if (($today >= $sale_from) && ($today <= $sale_to)) {
                        
                    } else {
                        
                        $discount = 0;
                    }
                    
                } else {
                    $discount = 0;
                }
            }
            if ($discount) {
                if ($discount > 100)
                    $discount = 100;
                $new_price = $price - ($price / 100) * $discount;
            } else {
                $new_price = $price;
            }
            return apply_filters('location_single_price', $new_price);
            
        }
        public static function get_min_max_price_location($post_type, $location_id)
        {
            if (!in_array($post_type, array(
                'st_cars',
                'st_tours',
                'st_hotel',
                'st_activity',
                'st_rental'
            ))) {
                return;
            }
            $location_meta_text = 'id_location';
            if ($post_type == 'st_rental') {
                $location_meta_text = 'location_id';
            }
            global $wpdb;
            $sql = "
                select ID from {$wpdb->posts}
                join {$wpdb->postmeta} 
                on {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID                
                and {$wpdb->postmeta}.meta_key = '{$location_meta_text}'
                and {$wpdb->postmeta}.meta_value = '{$location_id}'
                and {$wpdb->posts}.post_status = 'publish'
                where {$wpdb->posts}.post_type = '{$post_type}'
                group by {$wpdb->postmeta}.post_id";
            
            $results = $wpdb->get_results($sql, OBJECT);
            
            $min_price = 999999999999;
            $max_price = 0;
            $detail    = array();
            
            if (!is_array($results) or empty($results)) {
                return;
            }
            
            
            if ($post_type == "st_hotel") {
                foreach ($results as $post_id) {
                    $post_id = $post_id->ID;
                    // call all room of current hotel
                    // coppy from hotel class and fixed . 
                    $query   = array(
                        'post_type' => 'hotel_room',
                        'meta_key' => 'room_parent',
                        'meta_value' => $post_id
                    );
                    $q       = new WP_Query($query);
                    while ($q->have_posts()) {
                        $q->the_post();
                        $price = self::get_item_price(get_the_ID());
                        if ($price < $min_price) {
                            $min_price                    = $price;
                            $detail['item_has_min_price'] = get_the_ID();
                        }
                    }
                    
                    wp_reset_query();
                }
                
            } else {
                foreach ($results as $post_id) {
                    $post_id          = $post_id->ID;
                    $price_text_field = "price";
                    if ($post_type == 'st_cars') {
                        $price_text_field = 'cars_price';
                    }
                    $price = self::get_item_price($post_id);
                    
                    if ($price < $min_price) {
                        $min_price                    = $price;
                        $detail['item_has_min_price'] = $post_id;
                    }
                    if ($price > $max_price) {
                        $max_price                    = $price;
                        $detail['item_has_max_price'] = $post_id;
                    }
                    
                }
            }
            return array(
                'price_min' => $min_price,
                'price_max' => $max_price,
                'detail' => $detail
            );
        }
        static function scrop_thumb($image)
        {
            $return = '<img src="' . esc_url($image) . '" style="width: 100%" alt = "' . get_the_title() . '" >';
            return apply_filters('location_item_crop_thumb', $return);
        }
        
        /**
         * @since 1.1.3
         * get location information
         *
         */
        
        static function get_slider($gallery_array)
        {
            $return;
            $gallery_array = explode(',', $gallery_array);
            $return .= '<div class="fotorama" data-allowfullscreen="true" data-nav="thumbs">';
            if (is_array($gallery_array) and !empty($gallery_array)) {
                foreach ($gallery_array as $key => $value) {
                    $return .= wp_get_attachment_image($value, array(
                        800,
                        600,
                    ));
                }
            }
            $return .= '</div>';
            return $return;
        }
        /**
         * @since 1.1.3
         * get link search location by post type 
         * 
         */
        static function get_link_search($post_type)
        {
            
            if ($post_type == "st_cars") {
                $post_type_s = "cars";
            }
            if ($post_type == "st_hotel") {
                $post_type_s = "hotel";
            }
            if ($post_type == "st_rental") {
                $post_type_s = "rental";
            }
            if ($post_type == "st_activity") {
                $post_type_s = "acitivity";
            }
            if ($post_type == "st_tours") {
                $post_type_s = "tours";
            }
            
            $layout_id = st()->get_option($post_type_s . '_search_result_page', true);
            $link      = esc_url(add_query_arg(array(
                'post_type' => $post_type,
                'location_name' => get_the_title(),
                'location_id' => get_the_ID(),
                's' => '',
                'layout' => $post_type == "st_hotel" ? $layout_id : ''
            ), home_url()));
            return $link;
        }
        /**
         * @since 1.1.3
         * static rate by location and rate
         * return array(1=>xx , 2=> xyz , 3=>sss  , 4=>ssss, 5+>ksfs)
         **/
        static function get_rate_count($star_array, $post_type_array)
        {
            global $wpdb;
            
            if (!$star_array) {
                $star_array = array(
                    5,
                    4,
                    3,
                    2,
                    1
                );
            }
            if (!$post_type_array) {
                $post_type_array = array(
                    'st_cars',
                    'st_hotel',
                    'st_rental',
                    'st_tours',
                    'st_activity'
                );
            }
            $post_type_list_sql;
            
            if (!empty($post_type_array) and is_array($post_type_array)) {
                $post_type_list_sql .= " and ( ";
                foreach ($post_type_array as $key => $value) {
                    if ($key == 0) {
                        $post_type_list_sql .= "{$wpdb->posts} .post_type = '{$value}' ";
                    } else {
                        $post_type_list_sql .= " or {$wpdb->posts} .post_type = '{$value}' ";
                    }
                }
                $post_type_list_sql .= " ) ";
            }
            
            
            $return      = array();
            $location_id = get_the_ID();
            
            if (is_array($star_array) and !empty($star_array)) {
                foreach ($star_array as $key => $value) {
                    $star    = $value;
                    $sql     = "
                        SELECT ID FROM {$wpdb->commentmeta}  
                        join {$wpdb->comments}  on {$wpdb->commentmeta} .comment_id = {$wpdb->comments} .comment_ID
                        join {$wpdb->posts}  on {$wpdb->comments} .comment_post_ID = {$wpdb->posts} .ID
                        where {$wpdb->commentmeta} .meta_key = 'comment_rate' and {$wpdb->commentmeta} .meta_value = {$star}
                        and {$wpdb->posts} .comment_status  = 'open'
                        and {$wpdb->posts} .post_status = 'publish'
                            " . $post_type_list_sql . "
                        and {$wpdb->comments} .comment_approved = 1
                        GROUP BY {$wpdb->commentmeta} .comment_id";
                    $results = $wpdb->get_results($sql, OBJECT);
                    //return ($wpdb->num_rows);
                    $i       = 0;
                    foreach ($results as $key => $value) {
                        if (get_post_type($value->ID) == "st_rental") {
                            $meta_key = "location_id";
                        } else {
                            $meta_key = "id_location";
                        }
                        if (get_post_meta($value->ID, $meta_key, true) == get_the_ID()) {
                            $i++;
                        }
                    }
                    $return[$star] = $i;
                }
            }
            
            return $return;
            
        }
        /**
         * @package wordpress
         * @subpackage traveler 
         * @since 1.1.3
         * @descript get random post type to show widget 
         */
        public static function get_random_post_type($location_id, $post_type)
        {
            if (!$location_id) {
                $location_id = get_the_ID();
            }
            if (!$post_type) {
                $post_type = "st_cars";
            }
            $meta_key = "id_location";
            if ($post_type == 'st_rental') {
                $meta_key = 'location_id';
            }
            
            $query = array(
                'posts_per_page' => 1,
                'post_type' => $post_type,
                'orderby' => 'rand',
                'post_status' => 'publish',
                'meta_key' => $meta_key,
                'meta_value' => $location_id
            );
            query_posts($query);
            while (have_posts()) {
                the_post();
                $id = get_the_ID();
            }
            wp_reset_query();
            return $id;
        }
        /**
         * since 1.1.4
         */
        static function get_default_icon($value)
        {
            if (!$value) {
                return;
            }
            $icon;
            if ($value == 'st_cars')
                $icon = 'fa fa-car';
            if ($value == 'st_tours')
                $icon = 'fa fa-flag-o';
            if ($value == 'st_hotel')
                $icon = 'fa fa-building-o';
            if ($value == 'st_rental')
                $icon = 'fa fa-home';
            if ($value == 'st_activity')
                $icon = 'fa fa-bolt';
            if ($value == 'hotel_room')
                $icon = 'fa fa-home';
            return $icon;
        }
        /**
         * get list post for Location description hightlights
         * since 1.1.5
         *
         */
        static function get_list_post_location_info()
        {
            if (!isset($_GET['post'])) {
                return;
            }
            global $wpdb;
            $location_id = $_GET['post'];
            $sql         = "
                select ID, post_title from {$wpdb->posts}
                join {$wpdb->postmeta} on {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id
                where {$wpdb->posts}.post_status = 'publish'
                and {$wpdb->posts}.post_type = 'post'
                and {$wpdb->postmeta}.meta_key = 'location_select'
                and {$wpdb->postmeta}.meta_value = '{$location_id}'
                group by {$wpdb->posts}.ID
                ";
            $results     = $wpdb->get_results($sql, OBJECT);
            wp_reset_query();
            $return = array();
            if (is_array($results) and !empty($results)) {
                foreach ($results as $key => $value) {
                    $return[] = array(
                        'value' => $value->ID,
                        'label' => $value->post_title
                    );
                }
            }
            return $return;
        }
        public function get_location_list()
        {
            $return = array();
            $arg    = array(
                'post_type' => 'location',
                'nopaging' => true,
                'orderby' => 'ID',
                'post_status' => 'publish'
            );
            foreach (query_posts($arg) as $key => $value) {
                $return[] = array(
                    'id' => $value->ID,
                    'title' => $value->post_title,
                    'post_parent' => $value->post_parent
                );
            }
            wp_reset_query();
            return $return;
            
        }
        /**
         * widget location statistical
         * since 1.1.5
         *
         */
        static function location_widget3($instance)
        {
            global $wpdb;
            $style = $instance['style'];
            if (!$style) {
                $add_sql = " order by {$wpdb->posts}.ID DESC";
            }
            if ($style == 'latest') {
                $add_sql = " order by {$wpdb->posts}.post_date_gmt DESC ";
            }
            if ($style == 'famous') {
                return self::get_famous_location($instance);
            }
            
            if (!$instance['location']) {
                $instance['location'] = get_the_ID();
            }
            $sql = "
                select ID from {$wpdb->posts} 
                join {$wpdb->postmeta}      
                on {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
                where 
                   (({$wpdb->postmeta}.meta_value  = {$instance['location']} and {$wpdb->postmeta}.meta_key = 'id_location')
                or ({$wpdb->postmeta}.meta_value  = {$instance['location']} and {$wpdb->postmeta}.meta_key = 'location_id'))
                ";
            $sql .= "
                and {$wpdb->posts}.post_status = 'publish'
                and {$wpdb->posts}.post_type = '{$instance['post_type']}' 
                group by {$wpdb->posts}.ID ";
            $sql .= $add_sql;
            $sql .= " limit 0 ,{$instance['count']} 
                ";
            $results = $wpdb->get_results($sql, OBJECT);
            wp_reset_query();
            return $results;
        }
        /**
         * @since 1.1.6
         * 
         *
         */
        static function get_famous_location($instance)
        {
            global $wpdb;
            $item_post_type = $instance['post_type'];
            $location_id    = $instance['location'];
            $count          = $instance['count'];
            $sql            = "
                 SELECT count({$wpdb->postmeta}.meta_value) as count , {$wpdb->postmeta}.meta_value as ID
                    FROM {$wpdb->posts} INNER JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID={$wpdb->postmeta}.post_id AND {$wpdb->postmeta}.meta_key='item_id'
                    INNER JOIN {$wpdb->postmeta} as mt1 ON mt1.post_id={$wpdb->posts}.ID AND mt1.meta_key='item_post_type' AND mt1.meta_value='{$item_post_type}' 
                    WHERE {$wpdb->postmeta}.meta_value in (select post_id from {$wpdb->postmeta} where ({$wpdb->postmeta}.meta_key = 'id_location' or {$wpdb->postmeta}.meta_key = 'location_id') and {$wpdb->postmeta}.meta_value= '{$location_id}') 
                    and {$wpdb->posts}.post_status = 'publish' 
                    group by  {$wpdb->postmeta}.meta_value
                    order by count({$wpdb->postmeta}.meta_value) DESC
             
                ";
            $results        = $wpdb->get_results($sql, OBJECT);
            wp_reset_query();
            
            $return = array();
            foreach ($results as $key => $value) {
                if ($key <= ($count - 1)) {
                    $return[] = $value;
                }
            }
            return $return;
        }
        /**
         * @since 1.1.6
         * 
         *
         */
        static function query_location_($post_parent)
        {
            global $wpdb;
            $query   = "select ID, post_parent, post_title from {$wpdb->posts} 
                where {$wpdb->posts}.post_status = 'publish'
                and {$wpdb->posts}.post_parent = {$post_parent}
                and {$wpdb->posts}.post_type = 'location'
                order by {$wpdb->posts}.post_parent";
            $results = $wpdb->get_results($query, OBJECT);
            wp_reset_query();
            return $wpdb->last_result;
            
        }
        /**
         * @since 1.1.6
         * 
         *
         */
        static function round_count_reviews($reviews_num)
        {
            if (!$reviews_num) {
                return;
            }
            if ($reviews_num >= 1000 and $reviews_num < 1000000) {
                $reviews_num = (round($reviews_num / 1000)) . "." . "000+ ";
            }
            if ($reviews_num >= 1000000) {
                $reviews_num = (round($reviews_num / 1000000)) . "." . "000.000+ ";
            }
            return $reviews_num;
        }
        /**
         * @since 1.1.6
         * create a list post type in this location . 
         * to gmap3
         */
        static function get_list_post_type()
        {
            
            if (!is_singular('location')) {
                return;
            }
            
            global $wpdb;
            $list_post_active = self::get_post_type_list_active();
            $post_type_sql = " and ( ";
            if(is_array($list_post_active) and !empty($list_post_active)){
                foreach ($list_post_active as $key => $value) {
                    if ($key !=0){
                        $post_type_sql .=" or {$wpdb->posts}.post_type = '{$value}' ";
                    }else{
                        $post_type_sql .=" {$wpdb->posts}.post_type = '{$value}' ";
                    }
                }
            }
            $post_type_sql .= " ) ";
            $location_id = get_the_ID();
            
            $sql = "
                select ID , post_title, post_type   from {$wpdb->posts} , {$wpdb->postmeta} 
                where {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID 
                and {$wpdb->postmeta}.meta_key = 'id_location' 
                and {$wpdb->postmeta}.meta_value = '{$location_id}' 
                and {$wpdb->posts}.post_status = 'publish' 
                ";
            $sql .= $post_type_sql;
            $sql .= "
                group by ID";
            $results = $wpdb->get_results($sql, OBJECT);
            wp_reset_query();
            //var_dump($wpdb->last_query);
            // get lat long
            $list_post_type = array();
            if (is_array($results) and !empty($results)) {
                foreach ($results as $key => $value) {
                    $array_flag['ID']  = $value->ID;
                    $array_flag['lat'] = get_post_meta($value->ID, 'map_lat', true);
                    $array_flag['lng'] = get_post_meta($value->ID, 'map_lng', true);
                    $array_flag['link']  = get_permalink($value->ID);                    
                    $array_flag['post_type']= $value->post_type;                    
                    $list_post_type[]          = $array_flag;
                }
            }
            $data_zoom_l  = get_post_meta(get_the_ID(),'map_zoom_location', true);
            if (!$data_zoom_l){$data_zoom_l = 15;}
            $current_location = array(
                'title'=>get_the_title(),
                'map_lat'=>get_post_meta(get_the_ID(), 'map_lat', true),
                'map_lng'=>get_post_meta(get_the_ID(), 'map_lng', true),
                'location_map_zoom'=>$data_zoom_l
                );
            
            /*wp_localize_script('jquery','default_icon_gmap3_location' , array(
                'st_cars'=>st()->get_option('st_cars_icon_map_marker'),
                'st_tours'=>st()->get_option('st_tours_icon_map_marker'),
                'st_hotel'=>st()->get_option('st_hotel_icon_map_marker'),
                'st_rental'=>st()->get_option('st_rental_icon_map_marker'),
                'st_activity'=>st()->get_option('st_activity_icon_map_marker'),
                ));*/
            wp_localize_script('jquery','current_location' ,$current_location);
            //wp_localize_script('jquery', 'list_post_type', $list_post_type);
        }
    }
    
    $a = new STLocation();
    $a->init();
}
