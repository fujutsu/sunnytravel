<?php 
/**
*@since 1.1.7
**/	
if(function_exists('vc_map')){
	vc_map( array(
        'name'      => __('ST Room Map', ST_TEXTDOMAIN),
        'base'      => 'st_room_map',
        'class'     => '',
        'icon' => 'icon-st',
        'category'=>'Shinetheme',
        'params'    => array(
        	array(
        		'type' => 'textfield',
        		'heading' => __('Zoom', ST_TEXTDOMAIN),
        		'param_name' => 'zoom',
        		'value' => 13
        	),
        ),
    ));   
}
if(!function_exists('st_room_map_fc')){
	function st_room_map_fc($attr = array(), $content = null){
		$default = array(
			'zoom' => 13
			);
		$attr = wp_parse_args( $attr, $default );

		if(is_singular('hotel_room' ) || is_singular('rental_room')){
			return st()->load_template('vc-elements/st-room-map/room_map', false, array('data' => $attr));
		}
		return '';
	}
}
st_reg_shortcode( 'st_room_map' , 'st_room_map_fc' );
?>