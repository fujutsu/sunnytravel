<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STPaymentGateways
 *
 * Created by ShineTheme
 *
 */

if(!class_exists('STPaymentGateways'))
{
    class STPaymentGateways
    {
        static $_payment_gateways=array();
        static function _init()
        {
            //load abstract class
            STTraveler::load_libs(array(
                'abstract/class-abstract-payment-gateway'
            ));

            //Load default gateways
            self::_load_default_gateways();

            self::$_payment_gateways=array(
                'st_submit_form'=>new STGatewaySubmitform(),
                'st_paypal'=>new STGatewayPaypal(),
            );

            add_action('init',array(__CLASS__,'_do_add_gateway_options'));
        }
        static function _do_add_gateway_options()
        {
            if(function_exists('ot_settings_id'))
            add_filter( ot_settings_id() . '_args', array(__CLASS__,'_add_gateway_options') );
        }

        static function _add_gateway_options($settings=array())
        {
            $option_fields=array();

            $all=self::get_payment_gateways();
            if(is_array($all) and !empty($all))
            {
                foreach($all as $key=>$value)
                {
                    $field=$value->get_option_fields();

                    $default=array(
                        array(

                           'id'     => 'pm_gway_'.$key.'_tab',
                           'label'  =>sprintf(__('%s Options',ST_TEXTDOMAIN),$value->get_name()),
                            'type'  =>'tab',
                            'section'  =>'option_pmgateway'
                        ),
                        array(

                           'id'     => 'pm_gway_'.$key.'_enable',
                           'label'  =>sprintf(__('Enable %s',ST_TEXTDOMAIN),$value->get_name()),
                            'type'  =>'on-off',
                            'std'   =>$value->get_default_status()?'on':'off',
                            'section'  =>'option_pmgateway'
                        )

                    );

                    $option_fields=array_merge($option_fields,$default);

                    if($field and is_array($field))
                    {
                        $option_fields=array_merge($option_fields,$field);
                    }
                }
            }

            if(!empty($option_fields)){
                $settings['sections'][]=array(
                    'id'          => 'option_pmgateway',
                    'title'       => __( '<i class="fa fa-money"></i> Payment Options', ST_TEXTDOMAIN )
                );

                $settings['settings']=array_merge($settings['settings'],$option_fields);
            }

            return $settings;
        }

        static function get_payment_gateways()
        {
            return apply_filters('st_payment_gateways',self::$_payment_gateways);
        }
        /**
         *
         *
         * @since 1.0.1
         * @update 1.1.7
        */
        static function get_payment_gateways_html($post_id=false)
        {

            $all=self::get_payment_gateways();
                    
            if(is_array($all) and !empty($all))
            {
                $i=1;
                $available=array();

                foreach($all as $key=>$value)
                {
                    if(method_exists($value,'is_available') and $value->is_available())
                    {

                        if(!$post_id){
                            $post_id=STCart::get_booking_id();
                        }
                        if($value->is_available($post_id)){
                            $available[]=$value;
                        }

                    }
                }
                if(!empty($available))
                {
                    foreach($available as $key=>$value){
                        echo "<div class='payment_gateway_item'>  ";
                        $value->html();
                        echo "</div>";

                        if($i<count($available)){
                            echo '<div class="st-hr text-center m20" >
                                <hr>
                                <span class="st-or">'.__('Or',ST_TEXTDOMAIN).'</span>
                            </div>';
                        }
                        $i++;
                    }
                }
            }
        }

        /**
         *
         *
         * @param $id
         * @param bool $post_id
         * @return mixed
         */
        static function get_gateway($id,$post_id=false)
        {
            $all=self::get_payment_gateways();
            if(isset($all[$id]))
            {
                $value=$all[$id];
                if(method_exists($value,'is_available') and $value->is_available($post_id))
                {
                    return $value;
                }
            }

        }

        static function get_gatewayname($id)
        {
            $all=self::get_payment_gateways();
            if(isset($all[$id]))
            {
                $value=$all[$id];
                if(method_exists($value,'get_name'))
                {
                    return $value->get_name();
                }else return $id;
            }
        }

        /**
         * Check if a gateway is allow to show the booking infomation by gived gateway id
         *
         * @param $id: GateWay Name
         *
         * @result bool
         *
         * @since 1.0.8
         *
         * */
        static function gateway_success_page_validate($id=false)
        {
            $all=self::get_payment_gateways();
            if(isset($all[$id]))
            {
                $value=$all[$id];
                if(method_exists($value,'get_name'))
                {
                    return $value->success_page_validate();
                }

            }else{
                STTemplate::set_message(__('Sorry! Your Payment Gateway is not valid',ST_TEXTDOMAIN),'danger');
            }
        }


        static function _load_default_gateways()
        {

            $path = STTraveler::dir('gateways');
            $results = scandir($path);

            foreach ($results as $result) {
                if ($result === '.' or $result === '..') continue;
                if (is_dir($path . '/' . $result)) {

                    $file=$path.'/'.$result.'/'.$result.'.php';
                    if(file_exists($file))
                    {
                        include_once $file;
                    }

                }
            }
        }
    }

    STPaymentGateways::_init();
}
