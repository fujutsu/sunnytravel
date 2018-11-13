<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class Traver Helper
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('TravelHelper'))
{

    class TravelHelper{
        public static $all_currency;
        static function  init()
        {
            add_action( 'init',array(__CLASS__,'location_session'),1 );
            add_action('init',array(__CLASS__,'change_current_currency'));

            add_action('init',array(__CLASS__,'setLocationBySession'), 100);
            add_action('init',array(__CLASS__,'getListLocation'), 50);

            add_action('init',array(__CLASS__,'setListFullNameLocation'), 100);

            add_action('wp_ajax_st_format_money',array(__CLASS__,'_format_money'));
            add_action('wp_ajax_nopriv_st_format_money',array(__CLASS__,'_format_money'));

            add_action('wp_ajax_st_getOrderByYear', array(__CLASS__,'getOrderByYear'), 9999);
            add_action('wp_ajax_nopriv_st_getOrderByYear', array(__CLASS__,'getOrderByYear'), 9999);

            add_action('wp_ajax_st_getBookingPeriod', array(__CLASS__,'getBookingPeriod'), 9999);
            add_action('wp_ajax_nopriv_st_getBookingPeriod', array(__CLASS__,'getBookingPeriod'), 9999);


            self::$all_currency=array (
                'ALL' => 'Albania Lek',
                'AFN' => 'Afghanistan Afghani',
                'ARS' => 'Argentina Peso',
                'AWG' => 'Aruba Guilder',
                'AUD' => 'Australia Dollar',
                'AZN' => 'Azerbaijan New Manat',
                'BSD' => 'Bahamas Dollar',
                'BBD' => 'Barbados Dollar',
                'BDT' => 'Bangladeshi taka',
                'BYR' => 'Belarus Ruble',
                'BZD' => 'Belize Dollar',
                'BMD' => 'Bermuda Dollar',
                'BOB' => 'Bolivia Boliviano',
                'BAM' => 'Bosnia and Herzegovina Convertible Marka',
                'BWP' => 'Botswana Pula',
                'BGN' => 'Bulgaria Lev',
                'BRL' => 'Brazil Real',
                'BND' => 'Brunei Darussalam Dollar',
                'KHR' => 'Cambodia Riel',
                'CAD' => 'Canada Dollar',
                'KYD' => 'Cayman Islands Dollar',
                'CLP' => 'Chile Peso',
                'CNY' => 'China Yuan Renminbi',
                'COP' => 'Colombia Peso',
                'CRC' => 'Costa Rica Colon',
                'HRK' => 'Croatia Kuna',
                'CUP' => 'Cuba Peso',
                'CZK' => 'Czech Republic Koruna',
                'DKK' => 'Denmark Krone',
                'DOP' => 'Dominican Republic Peso',
                'XCD' => 'East Caribbean Dollar',
                'EGP' => 'Egypt Pound',
                'SVC' => 'El Salvador Colon',
                'EEK' => 'Estonia Kroon',
                'EUR' => 'Euro Member Countries',
                'FKP' => 'Falkland Islands (Malvinas) Pound',
                'FJD' => 'Fiji Dollar',
                'GHC' => 'Ghana Cedis',
                'GIP' => 'Gibraltar Pound',
                'GTQ' => 'Guatemala Quetzal',
                'GGP' => 'Guernsey Pound',
                'GYD' => 'Guyana Dollar',
                'HNL' => 'Honduras Lempira',
                'HKD' => 'Hong Kong Dollar',
                'HUF' => 'Hungary Forint',
                'ISK' => 'Iceland Krona',
                'INR' => 'India Rupee',
                'IDR' => 'Indonesia Rupiah',
                'IRR' => 'Iran Rial',
                'IMP' => 'Isle of Man Pound',
                'ILS' => 'Israel Shekel',
                'JMD' => 'Jamaica Dollar',
                'JPY' => 'Japan Yen',
                'JEP' => 'Jersey Pound',
                'KZT' => 'Kazakhstan Tenge',
                'KPW' => 'Korea (North) Won',
                'KRW' => 'Korea (South) Won',
                'KGS' => 'Kyrgyzstan Som',
                'LAK' => 'Laos Kip',
                'LVL' => 'Latvia Lat',
                'LBP' => 'Lebanon Pound',
                'LRD' => 'Liberia Dollar',
                'LTL' => 'Lithuania Litas',
                'MKD' => 'Macedonia Denar',
                'MYR' => 'Malaysia Ringgit',
                'MUR' => 'Mauritius Rupee',
                'MXN' => 'Mexico Peso',
                'MNT' => 'Mongolia Tughrik',
                'MZN' => 'Mozambique Metical',
                'NAD' => 'Namibia Dollar',
                'NPR' => 'Nepal Rupee',
                'ANG' => 'Netherlands Antilles Guilder',
                'NZD' => 'New Zealand Dollar',
                'NIO' => 'Nicaragua Cordoba',
                'NGN' => 'Nigeria Naira',
                'NOK' => 'Norway Krone',
                'OMR' => 'Oman Rial',
                'PKR' => 'Pakistan Rupee',
                'PAB' => 'Panama Balboa',
                'PYG' => 'Paraguay Guarani',
                'PEN' => 'Peru Nuevo Sol',
                'PHP' => 'Philippines Peso',
                'PLN' => 'Poland Zloty',
                'QAR' => 'Qatar Riyal',
                'RON' => 'Romania New Leu',
                'RUB' => 'Russia Ruble',
                'SHP' => 'Saint Helena Pound',
                'SAR' => 'Saudi Arabia Riyal',
                'RSD' => 'Serbia Dinar',
                'SCR' => 'Seychelles Rupee',
                'SGD' => 'Singapore Dollar',
                'SBD' => 'Solomon Islands Dollar',
                'SOS' => 'Somalia Shilling',
                'ZAR' => 'South Africa Rand',
                'LKR' => 'Sri Lanka Rupee',
                'SEK' => 'Sweden Krona',
                'CHF' => 'Switzerland Franc',
                'SRD' => 'Suriname Dollar',
                'SYP' => 'Syria Pound',
                'TWD' => 'Taiwan New Dollar',
                'THB' => 'Thailand Baht',
                'TTD' => 'Trinidad and Tobago Dollar',
                'TRY' => 'Turkey Lira',
                'TRL' => 'Turkey Lira',
                'TVD' => 'Tuvalu Dollar',
                'UAH' => 'Ukraine Hryvna',
                'AED' => 'United Arab Emirates',
                'GBP' => 'United Kingdom Pound',
                'USD' => 'United States Dollar',
                'UYU' => 'Uruguay Peso',
                'UZS' => 'Uzbekistan Som',
                'VEF' => 'Venezuela Bolivar',
                'VND' => 'Viet Nam Dong',
                'YER' => 'Yemen Rial',
                'ZWD' => 'Zimbabwe Dollar'
            );
        }
        /**
         *
         *
         * @since 1.1.3
         * */
        static function _format_money()
        {
            $data=STInput::post('money_data',array());

            if(!empty($data))
            {
                foreach($data as $key=>$value){
                    $data[$key]=TravelHelper::format_money($value);
                }
            }

            echo json_encode(
                array(
                    'status'=>1,
                    'money_data'=>$data
                )
            );
            die;
        }


        static function ot_all_currency()
        {
            $a=array();

            foreach(self::$all_currency as $key=>$value)
            {
                $a[]=array(
                    'value'=>$key,
                    'label'=>$value.'('.$key.' )'
                );
            }

            return $a;
        }

        /**
         * @todo Setup Session
         *
         *
         * */
        static function location_session () {
            if(!session_id()) {
                session_start();
            }
        }


        /**
         * Return All Currencies
         *
         *
         * */
        static function get_currency($theme_option=false)
        {
            $all= apply_filters('st_booking_currency', st()->get_option('booking_currency'));

            //return array for theme options choise
            if($theme_option){
                $choice=array();

                if(!empty($all) and is_array($all))
                {


                    foreach($all as $key=>$value)
                    {
                        $choice[]=array(

                            'label'=>$value['title'],
                            'value'=>$value['name']
                        );
                    }

                }
                return $choice;
            }
            return $all;
        }




        /**
         * return Default Currency
         *
         *
         * */
        static function get_default_currency($need=false)
        {

            $primary=st()->get_option('booking_primary_currency');

            $primary_obj=self::find_currency($primary);

            if($primary_obj )
            {
                if($need and isset($primary_obj[$need])) return $primary_obj[$need];
                return $primary_obj;
            }else{

                //If user dont set the primary currency, we take the first of list all currency
                $all_currency=self::get_currency();



                if(isset($all_currency[0])){
                    if($need and isset($all_currency[0][$need])) return $all_currency[0][$need];
                    return $all_currency[0];
                }
            }


        }

        /**
         * return Current Currency
         *
         *
         * */
        static function get_current_currency($need=false)
        {

            //Check session of user first

            if(isset($_SESSION['currency']['name']))
            {
                $name=$_SESSION['currency']['name'];

                if($session_currency=self::find_currency($name))
                {
                    if($need and isset($session_currency[$need])) return $session_currency[$need];
                    return $session_currency;
                }
            }

            return self::get_default_currency($need);
        }


        /**
         * @todo Find currency by name, return false if not found
         *
         *
         * */
        static  function find_currency($currency_name,$compare_key='name')
        {
            $currency_name=esc_attr($currency_name);

            $all_currency=self::get_currency();

            if(!empty($all_currency)){
                foreach($all_currency as $key)
                {
                    if($key[$compare_key]==$currency_name)
                    {
                        return $key;
                    }
                }
            }
            return false;
        }

        /**
         * Change Default Currency
         * @param currency_name
         *
         * */

        static function  change_current_currency()
        {

            if(isset($_GET['currency']) and $_GET['currency'] and $new_currency=self::find_currency($_GET['currency']))
            {
                $_SESSION['currency']=$new_currency;
            }
        }

        /**
         *
         * Conver money from default currency to current currency
         *
         *
         *
         * */
        static function convert_money($money=false)
        {
            if(!$money) $money=0;

            $current_rate=self::get_current_currency('rate');
            $current=self::get_current_currency('name');

            $default=self::get_default_currency('name');

            if($current!=$default)
                return $money*$current_rate;
            return $money;


        }

        /**
         *
         * Format Money
         *@since 1.1.1
         *
         *
         * */
        static function format_money($money=false,$need_convert=true,$precision=0)
        {
            $money=(float)$money;
            $precision=st()->get_option('booking_currency_precision',2);
            $thousand_separator =st()->get_option('thousand_separator','.');
            $decimal_separator =st()->get_option('decimal_separator',',');

            if($money == 0){
                return __("Free",ST_TEXTDOMAIN);
            }

            if($need_convert){
                $money=self::convert_money($money);
            }


            if($precision){
                $money=round($money,$precision);
            }

            $symbol=self::get_current_currency('symbol');

            $template=st()->get_option('booking_currency_pos');

            if(!$template)
            {
                $template='left';
            }
            
            $money=number_format((float)$money,$precision,$decimal_separator,$thousand_separator);
            switch($template)
            {


                case "right":
                    $money_string= $money.$symbol;
                    break;
                case "left_space":
                    $money_string=$symbol." ".$money;
                    break;

                case "right_space":
                    $money_string=$money." ".$symbol;
                    break;
                case "left":
                default:
                    $money_string= $symbol.$money;
                    break;


            }

            return $money_string;

        }

        static function format_money_raw($money,$symbol,$precision=2)
        {
            if($money == 0){
                return __("Free",ST_TEXTDOMAIN);
            }

            if(!$symbol){
                $symbol=self::get_current_currency('symbol');
            }

            if($precision){
                $money=round($money,$precision);
            }

            $template=st()->get_option('booking_currency_pos');

            if(!$template)
            {
                $template='left';
            }

            $money=number_format((float)$money,0);

            switch($template)
            {


                case "right":
                    $money_string= $money.$symbol;
                    break;
                case "left_space":
                    $money_string=$symbol." ".$money;
                    break;

                case "right_space":
                    $money_string=$money." ".$symbol;
                    break;
                case "left":
                default:
                    $money_string= $symbol.$money;
                    break;


            }

            return $money_string;
        }





        static function build_url($name,$value){
            $all=$_GET;
            $current_url=self::current_url();
            $all[$name]=$value;
            return esc_url($current_url.'?'.http_build_query ($all));
        }
        static function build_url_array($key,$name,$value,$add=true){
            $all=$_GET;

            $val=isset($all[$key][$name])?$all[$key][$name]:'';

            if($add)
            {
                if($val)
                    $value_array=explode(',',$val);
                else
                    $value_array=array();
                $value_array[]=$value;

            }else{

                $value_array=explode(',',$val);
                unset($value_array[$value]);
                if(!empty($value_array))
                {
                    foreach($value_array as $k=>$v){
                        if($v==$value) unset( $value_array[$k]);
                    }
                }

            }
            $all[$key][$name]=implode(',',$value_array);

            return esc_html(add_query_arg($all));
        }
        static function build_url_auto_key($key,$value,$add=true){
            $all=$_GET;
            $current_url=self::current_url();

            $val=isset($all[$key])?$all[$key]:'';
            $value_array=array();
            $url=$current_url;

            if($add){

                if($val){
                    $value_array=explode(',',$val);
                }
                $value_array[]=$value;

            }else{

                $value_array=explode(',',$val);
                if(!empty($value_array))
                {
                    foreach($value_array as $k=>$v){
                        if($v==$value) unset( $value_array[$k]);
                    }

                }

            }

            $new_val=implode(',',$value_array);
            if($new_val){
                $all[$key]=$new_val;
            }else{
                $all[$key]='';
            }

            $all['paged']='';

            $url= esc_url(add_query_arg($all,$url));

            return $url;
        }

        static function checked_array($key,$need)
        {
            $found=false;
            if(!empty($key))
            {
                foreach($key as $k=>$v){
                    if($need==$v){
                        return true;
                    }
                }
            }

            return $found;
        }

        static function get_time_format(){
            $format = st()->get_option('time_format','true');
            
            return $format;
        }

        /**
        * @since 1.1.1
        **/
        static function convertDateFormat($date){
            
            $format = self::getDateFormat();
            if(!empty($date)){
                $myDateTime = DateTime::createFromFormat($format, $date);
                return $myDateTime->format('m/d/Y');
            }
            return '';
        }

        /**
        * @since 1.1.1
        **/
        static function getDateFormat(){
            $format = st()->get_option('datetime_format','{mm}/{dd}/{yyyy}');
            $ori_format = array(
                '{d}' => 'j',
                '{dd}' => 'd',
                '{D}' => 'D',
                '{DD}' => 'l',
                '{m}' => 'n',
                '{mm}' => 'm',
                '{M}' => 'M',
                '{MM}' => 'F',
                '{yy}' => 'y',
                '{yyyy}' => 'Y'
            );
            preg_match_all("/({)[a-zA-Z]+(})/", $format, $out);

            $out = $out[0];
            foreach($out as $key => $val){
                foreach($ori_format as $ori_key => $ori_val){
                    if($val == $ori_key){
                        $format = str_replace($val, $ori_val, $format);
                    }
                }
            }

            
            return $format;
        }

        /**
        * @since 1.1.1
        **/
        static function getDateFormatJs(){
            $format = st()->get_option('datetime_format','{mm}/{dd}/{yyyy}');
            $format_js = str_replace(array('{', '}'), '', $format);
            return $format_js;
        }
        static function build_url_muti_array($key,$name,$name_2,$value){
            $all=$_GET;
            $all[$key][$name][$name_2]=$value;
            return add_query_arg($all);
        }

        static function current_url()
        {

            $pageURL = 'http';
            if (isset($_SERVER['HTTPS']) and $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"].parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            }
            $pageURL=rtrim($pageURL,'index.php');
            return $pageURL;
        }

        static function paging($query=false)
        {
            global $wp_query,$st_search_query;
            if($st_search_query){
                $query=$st_search_query;
            }else $query=$wp_query;

            // Don't print empty markup if there's only one page.
            if ( $query->max_num_pages < 2 ) {
                return;
            }

            $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
            $pagenum_link = html_entity_decode( get_pagenum_link() );
            $query_args   = array();
            $url_parts    = explode( '?', $pagenum_link );

            if ( isset( $url_parts[1] ) ) {
                wp_parse_str( $url_parts[1], $query_args );
            }

            $pagenum_link = esc_url(remove_query_arg( array_keys( $query_args ), $pagenum_link ));
            $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

            $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
            $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

            // Set up paginated links.
            $links = paginate_links( array(
                'base'     => $pagenum_link,
                'format'   => $format,
                'total'    => $query->max_num_pages,
                'current'  => $paged,
                'mid_size' => 1,
                // 'add_args' => array_map( 'urlencode', $query_args ),
                'add_args' =>$query_args,
                'prev_text' => __( 'Previous Page', ST_TEXTDOMAIN ),
                'next_text' => __( 'Next Page', ST_TEXTDOMAIN ),
                'type'      =>'list'
            ) );


            if ( $links ) :
                $links=str_replace('page-numbers','pagination', balanceTags ($links));
                $links=str_replace('<span','<a',$links);
                $links=str_replace('</span>','</a>',$links);
                ?>
                <?php echo str_replace('page-numbers','pagination', balanceTags ($links));//do not use esc_html() with  paginate_links() result ?>
            <?php
            endif;
        }
        static function comments_paging()
        {
            ob_start();

            paginate_comments_links(
                array('type'=>'list',
                    'prev_text' => __( 'Previous Page', ST_TEXTDOMAIN ),
                    'next_text' => __( 'Next Page', ST_TEXTDOMAIN ),));

            $links=@ob_get_clean();


            if ( $links ) :
                $links=str_replace('page-numbers','pagination pull-right', balanceTags ($links));
                $links=str_replace('<span','<a',$links);
                $links=str_replace('</span>','</a>',$links);
                ?>
                <?php echo str_replace('page-numbers','pagination', balanceTags ($links));//do not use esc_html() with  paginate_links() result ?>
            <?php
            endif;
        }

        static function comments_list($comment, $args, $depth )
        {
            //get_template_part('single/comment','list');

            $file=locate_template('single/comment-list.php');

            if(is_file($file))

                include($file);
        }

        static function cutnchar($str,$n)
        {
            if(strlen($str)<$n) return $str;
            $html = substr($str,0,$n);
            $html = substr($html,0,strrpos($html,' '));
            return $html.'...';
        }

        static function  get_orderby_list()
        {
            return array(
                'none'=>'None',
                'ID'=>"ID",
                'author'=>'Author',
                'title'=>'Title',
                'name'=>"Name",
                'date'=>"Date",
                'modified'=>'Modified Date',
                'parent'=>'Parent',
                'rand'=>'Random',
                'comment_count'=>'Comment Count',

            );

        }

        static function reviewlist()
        { 
            $file=locate_template('reviews/review-list.php');

            if(is_file($file))

                include($file);
        }

        static function rate_to_string($star,$max=5)
        {
            $html='';

            if($star>$max) $star=$max;

            $moc1=(int)$star;

            for($i=1;$i<=$moc1;$i++ )
            {
                $html.='<li><i class="fa fa-star"></i></li>';
            }

            $new=$max-$star;

            $du=$star-$moc1;
            if($du>=0.2 and $du<=0.9){
                $html.='<li><i class="fa fa-star-half-o"></i></li>';
            }elseif($du){
                $html.='<li><i class="fa fa-star-o"></i></li>';
            }

            for($i=1;$i<=$new;$i++ )
            {
                $html.='<li><i class="fa fa-star-o"></i></li>';
            }

            return apply_filters('st_rate_to_string',$html);

        }

        static function add_read_more($content,$max_string=200)
        {
            $all=strlen($content);

            if(strlen($content)<$max_string) return $content;
            $html = substr($content,0,$max_string);
            $html = substr($html,0,strrpos($html,' '));


            return $html.'<span class="booking-item-review-more">'.substr($content,-($all-strrpos($html,' '))).'</span>';


        }

        static function  cal_rate($number,$total)
        {
            if(!$total) return 0;
            return round(($number/$total)*100);
        }

        static function handle_icon($string)
        {
            if(strpos($string,'im-')===0)
            {
                $icon= "im ".$string;
            }elseif(strpos($string,'fa-')===0)
            {
                $icon= "fa ".$string;
            }elseif(strpos($string,'ion-')===0)
            {
                $icon= "ion ".$string;
            }
            else{
                $icon=$string;
            }

            //return "<i class=''>"
            return $icon;
        }

        static function find_in_array($item=array(),$item_key=false,$item_value=false,$need=false){
            if(!empty($item)){
                foreach($item as $key=>$value)
                {
                    if($item_value==$value[$item_key]){
                        if($need and isset($value[$need])) return $value[$need];
                        return $value;
                    }
                }
            }
        }

        static function get_location_temp($post_id=false)
        {

            $dataWeather=self::_get_location_weather($post_id);

            $c=0;
            if(isset($dataWeather->main->temp)){
                $k=$dataWeather->main->temp;
                $temp_format = st()->get_option('st_weather_temp_unit','c');
                $c = self::_change_temp($k,$temp_format);
            }
            $icon='';
            if(!empty($dataWeather->weather[0]->icon)){
                $icon = self::get_weather_icons($dataWeather->weather[0]->icon);
            }
            return array(
                'temp'=>$c,
                'icon'=>$icon
            );
        }
        static function _change_temp($value,$type='k'){
            if($type == 'c'){
                $value=$value-273.15;
            }
            if($type == 'f'){
                $c = $value-273.15;
                $value = $c * 1.8 + 32 ;
            }
            $value = number_format((float)$value,1);
            return $value;
        }
        static function get_weather_icons($id_icon=null){
            // API http://openweathermap.org/weather-conditions
            switch($id_icon){
                case "01d":
                    return '<i class="wi wi-solar-eclipse loc-info-weather-icon"></i>';
                    break;
                case "02d":
                    return '<i class="wi wi-day-cloudy loc-info-weather-icon"></i>';
                    break;
                case "03d":
                    return '<i class="wi wi-cloud loc-info-weather-icon"></i>';
                    break;
                case "04d":
                    return '<i class="wi wi-cloudy loc-info-weather-icon"></i>';
                    break;
                case "09d":
                    return '<i class="wi wi-snow-wind loc-info-weather-icon"></i>';
                    break;
                case "10d":
                    return '<i class="wi wi-day-rain-mix loc-info-weather-icon"></i>';
                    break;
                case "11d":
                    return '<i class="wi wi-day-storm-showers loc-info-weather-icon"></i>';
                    break;
                case "13d":
                    return '<i class="wi wi-showers loc-info-weather-icon"></i>';
                    break;
                case "50d":
                    return '<i class="wi wi-windy loc-info-weather-icon"></i>';
                    break;
                case "01n":
                    return '<i class="wi wi-night-clear loc-info-weather-icon"></i>';
                    break;
                case "02n":
                    return '<i class="wi wi-night-cloudy loc-info-weather-icon"></i>';
                    break;
                case "03n":
                    return '<i class="wi wi-cloud loc-info-weather-icon"></i>';
                    break;
                case "04n":
                    return '<i class="wi wi-cloudy loc-info-weather-icon"></i>';
                    break;
                case "09n":
                    return '<i class="wi wi-snow-wind loc-info-weather-icon"></i>';
                    break;
                case "10n":
                    return '<i class="wi wi-night-alt-rain-mix loc-info-weather-icon"></i>';
                    break;
                case "11n":
                    return '<i class="wi wi-day-storm-showers loc-info-weather-icon"></i>';
                    break;
                case "13n":
                    return '<i class="wi wi-showers loc-info-weather-icon"></i>';
                    break;
                case "50n":
                    return '<i class="wi wi-windy loc-info-weather-icon"></i>';
                    break;
            }

        }

        private static function _get_location_weather($post_id=false)
        {
            if(!$post_id) $post_id=get_the_ID();

            $lat=get_post_meta($post_id,'map_lat',true);
            $lng=get_post_meta($post_id,'map_lng',true);


            if($lat and $lng){
                $url="http://api.openweathermap.org/data/2.5/weather?lat=".$lat.'&lon='.$lng;
            }else{
                $url="http://api.openweathermap.org/data/2.5/weather?q=".get_the_title($post_id);
            }

            // fix multilanguage whene translate new location 

            $post_data = get_post($post_id, ARRAY_A);
            $slug = $post_data['post_name'];

            $cache=get_transient('st_weather_location_'.$slug);
            $hour = intval(st()->get_option('update_weather_by', 1));

            $dataWeather=null;

            if($cache===false){
                $raw_geocode = wp_remote_get($url);

                $body=wp_remote_retrieve_body($raw_geocode);
                $body=json_decode($body);
                if(isset($body->main->temp))
                    set_transient( 'st_weather_location_'.$post_id, $body, 60*60*$hour );
                $dataWeather=$body;
            }else{
                $dataWeather=$cache;
            }
            return $dataWeather;
        }

        private static function _change_weather_icon($icon_old,$icon_new){

            if(strpos($icon_old,'d')!==FALSE)
            {
                return str_replace('-night-','-day-',$icon_new);
            }else{
                return str_replace('-day-','-night-',$icon_new);
            }
        }


        static function get_weather_icon($location_id=fasle)
        {
            if(!$location_id) $location_id=get_the_ID();

            $dataWeather=self::_get_location_weather($location_id);

            $c=0;
            if(isset($dataWeather->weather->id)){
                $w_id=$dataWeather->weather->id;
                $old_icon=$dataWeather->weather->id;

                switch($w_id){
                    case 200:
                        //$c=self::_change_weather_icon('')
                }
            }

            return $c;
        }
        /**
        * @since 1.1.0
        * @param string post type
        * @param string type (null or option_tree)
        **/
        static function st_get_field_search($post_type, $type = '')
        {
            $list_field=array();
            if(!empty($post_type)){
                switch($post_type){
                    case "st_hotel":
                        $data_field = STHotel::get_search_fields_name();
                        break;
                    case "st_rental":
                        $data_field = STRental::get_search_fields_name();
                        break;
                    case "st_cars":
                        $data_field = STCars::get_search_fields_name();
                        break;
                    case "st_tours":
                        $data_field = STTour::get_search_fields_name();
                        break;
                    case "st_activity":
                        $data_field = STActivity::get_search_fields_name();
                        break;
                    case "st_rental":
                        $data_field = STRental::get_search_fields_name();
                        break;
                    default:
                        $data_field=apply_filters('st_search_fields_name',array(),$post_type);
                        break;
                }
                $list_field[__('--Select--',ST_TEXTDOMAIN)]='';
                if(!empty($data_field) and is_array($data_field) and $type==''){
                    foreach($data_field as $k => $v){
                        $list_field[$v['label']] =  $v['value'] ;
                    }
                    return $list_field;
                }
                if(!empty($data_field) and is_array($data_field) and $type=='option_tree'){
                    foreach($data_field as $k => $v){
                        $list_field[] = array(
                            'label' => $v['label'],
                            'value' => $v['value']
                            );
                    }
                    return $list_field;
                }
            }else{
                return false;
            }
        }

        /**
        *@since 1.1.3
        **/ 
        static function getOrderByYear(){
            global $wpdb;
            $post_id = intval(STInput::request('post_id', ''));
            if($post_id <= 0 || empty($post_id)){
                echo '';
                die();
            }
            if(!in_array(get_post_type($post_id), array('hotel_room', 'st_rental'))){
                echo '';
                die();
            }
            $meta_key = '';
            $meta_value = '';
            if(get_post_type($post_id) == 'st_rental'){
                $meta_key = '_st_st_booking_id';
                $meta_value = $post_id;
            }
            if(get_post_type($post_id) == 'hotel_room'){
                $meta_key = '_st_room_id';
                $meta_value = $post_id;
            }
            $year = STInput::request('year', date('Y'));
            $item_post_type = STInput::request('item_post_type','');
            $_st_st_booking_post_type = STInput::request('_st_st_booking_post_type','');
            if($item_post_type == '' or $_st_st_booking_post_type== ''){
                echo '';
                die();
            }
            $sql = "SELECT DISTINCT ".$wpdb->posts.".* FROM ".$wpdb->posts." INNER JOIN ".$wpdb->postmeta." ON ".$wpdb->posts.".ID=".$wpdb->postmeta.".post_id
                    INNER JOIN ".$wpdb->postmeta." as mt1 ON mt1.post_id=".$wpdb->posts.".ID AND mt1.meta_key='item_post_type' AND mt1.meta_value='{$item_post_type}'
                    INNER JOIN ".$wpdb->postmeta." as mt2 ON mt2.post_id=".$wpdb->posts.".ID AND mt2.meta_key='check_in' AND YEAR(mt2.meta_value)='{$year}'
                    INNER JOIN ".$wpdb->postmeta." as mt3 ON mt3.post_id=".$wpdb->posts.".ID AND mt3.meta_key='check_out' AND YEAR(mt3.meta_value)='{$year}'
                    INNER JOIN wp_postmeta as mt4 ON mt4.post_id=wp_posts.ID AND mt4.meta_key='st_booking_id'
                    AND mt4.meta_value='{$post_id}'
                    WHERE ".$wpdb->posts.".post_type='st_order'";
            $posts = $wpdb->get_results( $sql , OBJECT );       
            $result = array();
            if(is_array($posts) && count($posts)){
                foreach($posts as $post){
                    $start = date('Y/m/d', strtotime(get_post_meta($post->ID, 'check_in', 'true')));
                    $end = date('Y/m/d', strtotime(get_post_meta($post->ID, 'check_out', 'true')));
                    $result =array_merge(self::getListDate($start, $end),$result);
                }
            }
            $sql = "SELECT DISTINCT * FROM ".$wpdb->prefix."woocommerce_order_items 
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta 
                        ON ".$wpdb->prefix."woocommerce_order_items.order_item_id = ".$wpdb->prefix."woocommerce_order_itemmeta.order_item_id 
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as mt1 
                        ON mt1.order_item_id = ".$wpdb->prefix."woocommerce_order_items.order_item_id 
                        AND mt1.meta_key = '_st_st_booking_post_type' 
                        AND mt1.meta_value = '{$_st_st_booking_post_type}' 
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as mt4
                        ON mt4.order_item_id = ".$wpdb->prefix."woocommerce_order_items.order_item_id 
                        AND mt4.meta_key = '{$meta_key}'
                        AND mt4.meta_value = '{$meta_value}'
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as mt2  
                        ON mt2.order_item_id = ".$wpdb->prefix."woocommerce_order_items.order_item_id 
                        AND mt2.meta_key = '_st_check_in' 
                        AND YEAR(DATE_FORMAT(STR_TO_DATE(mt2.meta_value, '%m/%d/%Y'), '%Y/%m/%d')) = '{$year}' 
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as mt3 
                        ON mt3.order_item_id = ".$wpdb->prefix."woocommerce_order_items.order_item_id 
                        AND mt3.meta_key = '_st_check_out' 
                        AND YEAR(DATE_FORMAT(STR_TO_DATE(mt2.meta_value, '%m/%d/%Y'), '%Y/%m/%d')) = '{$year}' 
                    GROUP BY ".$wpdb->prefix."woocommerce_order_itemmeta.order_item_id";

            $posts = $wpdb->get_results( $sql);  
            if(is_array($posts) && count($posts)){
                foreach($posts as $post){
                    $item = $post->order_item_id;
                    $start = date('Y/m/d',strtotime(wc_get_order_item_meta($item, '_st_check_in')));
                    $end = date('Y/m/d',strtotime(wc_get_order_item_meta($item, '_st_check_out')));
                    $result =array_merge(self::getListDate($start, $end),$result);
                }
            }        
            echo json_encode($result);
            
            die();
        }

        /**
        *  @sicne 1.1.7 
        **/
        /**
        *@since 1.1.3
        **/ 
        static function getOrderByYear_2($year, $item_post_type, $_st_st_booking_post_type, $post_id){
            global $wpdb;
            if($post_id <= 0 || empty($post_id)){
                return array();
            }
            if(!in_array(get_post_type($post_id), array('hotel_room', 'st_rental'))){
                return array();
            }

            if($item_post_type == '' or $_st_st_booking_post_type== ''){
                return array();
            }
            if(get_post_type($post_id) == 'st_rental'){
                $meta_key = '_st_st_booking_id';
                $meta_value = $post_id;
            }
            if(get_post_type($post_id) == 'hotel_room'){
                $meta_key = '_st_room_id';
                $meta_value = $post_id;
            }
            $sql = "SELECT DISTINCT ".$wpdb->posts.".* FROM ".$wpdb->posts." INNER JOIN ".$wpdb->postmeta." ON ".$wpdb->posts.".ID=".$wpdb->postmeta.".post_id
                    INNER JOIN ".$wpdb->postmeta." as mt1 ON mt1.post_id=".$wpdb->posts.".ID AND mt1.meta_key='item_post_type' AND mt1.meta_value='{$item_post_type}'
                    INNER JOIN ".$wpdb->postmeta." as mt2 ON mt2.post_id=".$wpdb->posts.".ID AND mt2.meta_key='check_in' AND YEAR(mt2.meta_value)='{$year}'
                    INNER JOIN ".$wpdb->postmeta." as mt3 ON mt3.post_id=".$wpdb->posts.".ID AND mt3.meta_key='check_out' AND YEAR(mt3.meta_value)='{$year}'
                    INNER JOIN wp_postmeta as mt4 ON mt4.post_id=wp_posts.ID AND mt4.meta_key='st_booking_id'
                    AND mt4.meta_value='{$post_id}'
                    WHERE ".$wpdb->posts.".post_type='st_order'";
            $posts = $wpdb->get_results( $sql , OBJECT );       
            $result = array();
            if(is_array($posts) && count($posts)){
                foreach($posts as $post){
                    $start = date('Y/m/d', strtotime(get_post_meta($post->ID, 'check_in', 'true')));
                    $end = date('Y/m/d', strtotime(get_post_meta($post->ID, 'check_out', 'true')));
                    $result =array_merge(self::getListDate($start, $end),$result);
                }
            }
            $sql = "SELECT DISTINCT * FROM ".$wpdb->prefix."woocommerce_order_items 
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta 
                        ON ".$wpdb->prefix."woocommerce_order_items.order_item_id = ".$wpdb->prefix."woocommerce_order_itemmeta.order_item_id 
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as mt1 
                        ON mt1.order_item_id = ".$wpdb->prefix."woocommerce_order_items.order_item_id 
                        AND mt1.meta_key = '_st_st_booking_post_type' 
                        AND mt1.meta_value = '{$_st_st_booking_post_type}' 
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as mt4
                        ON mt4.order_item_id = ".$wpdb->prefix."woocommerce_order_items.order_item_id 
                        AND mt4.meta_key = '{$meta_key}'
                        AND mt4.meta_value = '{$meta_value}'
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as mt2  
                        ON mt2.order_item_id = ".$wpdb->prefix."woocommerce_order_items.order_item_id 
                        AND mt2.meta_key = '_st_check_in' 
                        AND YEAR(DATE_FORMAT(STR_TO_DATE(mt2.meta_value, '%m/%d/%Y'), '%Y/%m/%d')) = '{$year}' 
                    INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as mt3 
                        ON mt3.order_item_id = ".$wpdb->prefix."woocommerce_order_items.order_item_id 
                        AND mt3.meta_key = '_st_check_out' 
                        AND YEAR(DATE_FORMAT(STR_TO_DATE(mt2.meta_value, '%m/%d/%Y'), '%Y/%m/%d')) = '{$year}' 
                    GROUP BY ".$wpdb->prefix."woocommerce_order_itemmeta.order_item_id";

            $posts = $wpdb->get_results( $sql);  
            if(is_array($posts) && count($posts)){
                foreach($posts as $post){
                    $item = $post->order_item_id;
                    $start = date('Y/m/d',strtotime(wc_get_order_item_meta($item, '_st_check_in')));
                    $end = date('Y/m/d',strtotime(wc_get_order_item_meta($item, '_st_check_out')));
                    $result =array_merge(self::getListDate($start, $end),$result);
                }
            }        
            return $result;
            
        }

        /**
        *@since 1.1.7
        **/
        static function getBookingPeriod(){
            $booking_period = STInput::request('booking_period', 0);
            $list_date = array();
            if($booking_period > 0){
                for($i = 0; $i< $booking_period; $i++){
                    if($i <= 1){
                        $date = date(TravelHelper::getDateFormat(), strtotime("+".$i." day"));
                    }elseif($i > 1){
                        $date = date(TravelHelper::getDateFormat(), strtotime("+".$i." days"));
                    }
                    $list_date[] = $date;
                }
            }
            echo json_encode($list_date);
            die();
        }

        static function getListDate($start, $end){

            $start = new DateTime($start);
            $end = new DateTime($end . ' +1 day'); 
            $list = array();
            foreach (new DatePeriod($start, new DateInterval('P1D'), $end) as $day) {
                    $list[] = $day->format(TravelHelper::getDateFormat());
            }
            return $list;
        }

        static function substr($str, $length, $minword = 3)
        {
            $sub = '';
            $len = 0;
            foreach (explode(' ', $str) as $word)
            {
                $part = (($sub != '') ? ' ' : '') . $word;
                $sub .= $part;
                $len += strlen($part);
                if (strlen($word) > $minword && strlen($sub) >= $length)
                {
                  break;
                }
             }
                return $sub . (($len < strlen($str)) ? '...' : '');
        }

        static function getVersion(){
            $ver = wp_get_theme()->get('Version');
            $ver = preg_replace("/(\.)/", "", $ver);
            return intval($ver);
        }

        static function dateDiff($start, $end){
            $start_ts = date_create($start);
            $end_ts = date_create($end);
            $diff = date_diff($start_ts, $end_ts);
            return $diff->format('%d');
        }
        static function dateCompare($start, $end){
            $start_ts = strtotime($start);
            $end_ts = strtotime($end);

            return $end_ts - $start_ts;
        }

        /**
        *@since 1.1.7
        **/
        static function getLocationBySession(){
            if(isset($_SESSION['st_location'])){
                $result = stripslashes($_SESSION['st_location']);
                return json_decode($result);
            }else{
                return '';
            }

        }

        /**
        *@since 1.1.7
        **/
        static function setLocationBySession(){
            $current_language = '';
            if(defined('ICL_LANGUAGE_CODE')){
                $current_language = ICL_LANGUAGE_CODE;
            }elseif(function_exists('qtrans_getLanguage')){
                $current_language = qtrans_getLanguage();
            }
            if(get_option('st_allow_save_location') == false || get_option('st_allow_save_location') == 'allow' || !isset($_SESSION['st_current_language_1']) || $current_language != $_SESSION['st_current_language_1']){
                $locations = array();

                $query = array(
                    'post_type' => 'location',
                    'posts_per_page' => -1,
                    'post_status' => 'publish'
                    );
                query_posts( $query );
                while(have_posts()): the_post();
                    $locations[] = array(
                        'ID' => '_'.get_the_ID().'_',
                        'name' => get_the_title()
                        );
                endwhile;   
                wp_reset_postdata(); wp_reset_query();
                $_SESSION['st_location'] = json_encode($locations);

                $_SESSION['st_current_language_1'] = $current_language;
                update_option('st_allow_save_location', 'not_allow');
            }  
        }

        /**
        *@since 1.1.7
        **/
        static function getListLocation(){
            if(!is_admin()){
                $post_id = STInput::request('id');
            }else{
                $post_id = STInput::request('post');
            }
            if(empty($post_id) || !get_post_status($post_id)){
                $list_location = json_encode("");
            }else{
                $list_location = get_post_meta($post_id, 'multi_location', true);
            
                if(!empty($list_location)){
                    $list_location = preg_replace("/(\_)/", "", $list_location);
                    $list_location = explode(",",$list_location);
                    $list_location = json_encode($list_location);
                }else{
                    $list_location = get_post_meta($post_id, 'id_location', true);
                    if(!empty($list_location)){
                        $arr = array($list_location);
                        $list_location = json_encode($arr);  
                    }else{
                        $list_location = get_post_meta($post_id, 'location_id', true);
                        if(!empty($list_location)){
                            $arr = array($list_location);
                            $list_location = json_encode($arr);
                        }else{
                            $list_location = json_encode("") ;
                        }
                    }
                }
            }
            wp_localize_script('jquery','list_location',array(
                'list'=> $list_location
            ));
        }

        /**
        *@since 1.1.7
        **/
        static function getAllLocationByName(){
            global $wpdb;
            $name = STInput::request('name');
            $name = explode(',', $name);
            $where = '';
            if(is_array($name) && count($name)){
                foreach($name as $item){
                    $item = trim($item);
                    if(!empty($item)){
                        if($where == ''){
                            $where .= " AND ( {$wpdb->prefix}posts.post_title LIKE '%{$item}%'";
                        }else{
                            $where .= " OR {$wpdb->prefix}posts.post_title LIKE '%{$item}%'";
                        }
                    }    
                }
            }
            if(!empty($where)) $where = $where." )";
            $sql = "select {$wpdb->prefix}posts.ID FROM {$wpdb->prefix}posts
                    WHERE {$wpdb->prefix}posts.post_type = 'location' {$where}";

            $result = $wpdb->get_results($sql);
            $return = '';
            if(is_array($result) && count($result)){
                foreach($result as $item){
                    $list = '';
                    $v = $item->ID;
                    $n = get_the_title($item->ID).self::getRelationPost($list, $item->ID);
                    $return .= '<li class="st-select-list-item" data-value="'.$v.'" data-name="'.$n.'">'.self::highlight($n, $name).'<i class="ml5 fa fa-map-marker"></i></li>';
                }
            } 
            echo $return;
            die;
        }

        /**
        *@since 1.1.7
        **/
        static function highlight($text, $words) {
            if(is_array($words) && count($words)){
                foreach($words as $word){
                    $highlighted = preg_filter('/' . preg_quote(trim($word)) . '/i', '<b><span class="search-highlight">$0</span></b>', $text);
                    if (!empty($highlighted)) {
                        $text = $highlighted;
                    }
                }
            }else{
                $highlighted = preg_filter('/' . preg_quote($words) . '/i', '<b><span class="search-highlight">$0</span></b>', $text, -1, $count);
                if (!empty($highlighted)) {
                    $text = $highlighted;
                }
            }
            
            return $text;
        }

        /**
        *@since 1.1.7
        **/

        static function locationHtml($post_id = ''){
            $result = '';
            if(empty($post_id)){
                return '';
            }else{
                $list_location = get_post_meta($post_id, 'multi_location', true);
                if($list_location && !empty($list_location)){
                    $list_location = preg_replace("/(_)/", "", $list_location);
                    $list_location = explode(',', $list_location);
                    foreach($list_location as $item){
                        if(empty($result)){
                            $result .= get_the_title($item);
                        }else{
                            $result .= ', '.get_the_title($item);
                        }
                    }
                }else{
                    $list_location = get_post_meta($post_id, 'location_id', true);
                    if($list_location && !empty($list_location)){
                        $result = get_the_title($list_location);
                    }else{
                        $list_location = get_post_meta($post_id, 'id_location', true);
                        if($list_location && !empty($list_location)){
                            $result = get_the_title($list_location);
                        }
                    }
                }
            }
            return $result;
        }

        /** 
        *@since 1.1.7
        **/
        static function setListFullNameLocation(){
            $current_language = '';
            if(defined('ICL_LANGUAGE_CODE')){
                $current_language = ICL_LANGUAGE_CODE;
            }elseif(function_exists('qtrans_getLanguage')){
                $current_language = qtrans_getLanguage();
            }
            if(!is_admin() && (!isset($_SESSION['st_current_language']) || ($current_language != $_SESSION['st_current_language']) || !isset($_SESSION['st_cache_location']) || get_option('st_allow_save_cache_location') == 'allow' || get_option('st_allow_save_cache_location') == false)){
                $query = array(
                    'post_type' => 'location',
                    'posts_per_page' => -1,
                    'post_status' => 'publish'
                    );

                $result = array();

                query_posts($query);
                while(have_posts()) : the_post();
                    $list = '';
                    $result[] = array(
                        'ID' => get_the_ID(),
                        'title' => get_the_title().self::getRelationPost($list, get_the_ID()).self::getZipCodeHtml(get_the_ID())
                    );
                endwhile;
                wp_reset_query(); wp_reset_postdata();

                $_SESSION['st_cache_location'] = json_encode($result);
                update_option('st_allow_save_cache_location', 'notallow');
                $_SESSION['st_current_language'] = $current_language;
            }    
        }

        /**
        *@since 1.1.7
        **/
        static function getZipCodeHtml($post_id){
            $zipcode = get_post_meta($post_id, 'zipcode', true);
            if($zipcode && !empty($zipcode)){
                return '||'.$zipcode;
            }else{
                return '';
            }
        }

        /**
        *@since 1.1.7
        **/
        static function getListFullNameLocation(){
            if(isset($_SESSION['st_cache_location'])){
                $cache_location = $_SESSION['st_cache_location'];
                $cache_location = stripslashes($cache_location);
                return json_decode($cache_location);
            }else{
                return '';
            }
        }
        /**
        *@since 1.1.7   
        **/
        static function getRelationPost($list = '', $id = ''){
            $parent = wp_get_post_parent_id($id);
            if($parent > 0){
                return $list.= ', '.get_the_title($parent);
                self::getRelationPost($parent);
            }else{
                return $list;
            }
        }
    }

    TravelHelper::init();
}