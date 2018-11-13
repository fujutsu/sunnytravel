<?php
    /**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * function
 *
 * Created by ShineTheme
 *
 */

if(!defined('ST_TEXTDOMAIN'))
define ('ST_TEXTDOMAIN','traveler');
$status=load_theme_textdomain(ST_TEXTDOMAIN,get_template_directory().'/language');

get_template_part('inc/class.traveler');

st();
get_template_part('demo/demo_functions');

if ( ! isset( $content_width ) ) $content_width = 900;
                                          function get_image_url_id($id){
	$image_id = get_post_thumbnail_id($id);
	$image_url = wp_get_attachment_image_src($image_id,'large');
	$image_url = $image_url[0];
	return $image_url;
	}

        function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit) {
  array_pop($words);
  return implode(' ', $words).""; } else {
 // return implode(' ', $words)."..."; } else {
  return implode(' ', $words); }
}

     function post_type_news() {
register_post_type(
                    'novosti',
                    array( 'public' => true,
					 		'publicly_queryable' => true,
							'has_archive' => true,
						  //	'hierarchical' => false,
							'menu_icon' => get_stylesheet_directory_uri() . '/images/car.png',
                    		'labels'=>array(
    									'name' => _x('Новости', 'post type general name'),
    									'singular_name' => _x('Новости', 'post type singular name'),
    									'add_new' => _x('Add New', 'Новости'),
    									'add_new_item' => __('Add New Новости'),
    									'edit_item' => __('Edit Новости'),
    									'new_item' => __('New Новости'),
    									'view_item' => __('View Новости'),
    									'search_items' => __('Search Новости'),
    									'not_found' =>  __('No Новости found'),
    									'not_found_in_trash' => __('No Новости found in Trash'),
    									'parent_item_colon' => ''
  										),
                            'show_ui' => true,
							'menu_position'=>5,
							'query_var' => true,
							'rewrite' => true,
							'rewrite' => array( 'slug' => 'novosti', 'with_front' => true,),

							'supports' => array(
							 			'title',
										'thumbnail',
                                        'custom-fields',
                                        'excerpt',
										'editor'
										)
							)
					);
				}
add_action('init', 'post_type_news');




add_action("admin_init", "my_fields", 1);
function my_fields() {
add_meta_box( "extra_fields", "Дополнительные поля для тура", "fields_box", "st_tours", "normal", "high" );
}
function fields_box(){
global $post;
$custom = get_post_custom($post->ID);
$price2 = $custom["price2"][0];
$to_date = $custom["to_date"][0];
$food = $custom["food"][0];
$peoples = $custom["peoples"][0];

$to_cantry = $custom["to_cantry"][0];
$to_city = $custom["to_city"][0];
$to_otels = $custom["to_otels"][0];


?>
<input type="text" name="to_cantry" value="<?php echo $to_cantry; ?>" />
<label><strong>Страна</strong></label><br>
<input type="text" name="to_city" value="<?php echo $to_city; ?>" />
<label><strong>Город</strong></label><br>
<input type="text" name="to_otels" value="<?php echo $to_otels; ?>" />
<label><strong>Отель</strong></label><br><br>


<input type="text" name="price2" value="<?php echo $price2; ?>" />
<label><strong>Цена</strong></label>
<br>
<input type="text" name="to_date" value="<?php echo $to_date; ?>" />
<label><strong>До какой даты</strong></label><br><br>
<input type="text" name="peoples" value="<?php echo $peoples; ?>" />
<label><strong>Количество человек</strong></label><br>
<input type="text" name="food" value="<?php echo $food; ?>" />
<label><strong>Тип питания</strong></label><br><br>
<?php
}
add_action('save_post', 'save_price', 0);
function save_price( $post_id ){
if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return false; // выходим если это автосохранение
if ( !current_user_can('edit_post', $post_id) ) return false; // выходим если юзер не имеет право редактировать запись
global $post;
update_post_meta($post->ID, "price2", $_POST["price2"]);
update_post_meta($post->ID, "to_date", $_POST["to_date"]);
update_post_meta($post->ID, "food", $_POST["food"]);
update_post_meta($post->ID, "peoples", $_POST["peoples"]);

update_post_meta($post->ID, "to_cantry", $_POST["to_cantry"]);
update_post_meta($post->ID, "to_city", $_POST["to_city"]);
update_post_meta($post->ID, "to_otels", $_POST["to_otels"]);
}

function dropdownlist_travel() {
	wp_register_style( 'dropdownlist_style_1', get_template_directory_uri() . '/css/generic.css', false, false ); 
	wp_register_style( 'dropdownlist_style_2', get_template_directory_uri() . '/css/style_dropdown.css', false, false );
	
	wp_register_script( 'dropdownlist_script_2', get_template_directory_uri() . '/js/select_demo2.js',array('jquery'), false, true ); 
	wp_register_script( 'jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery')); 
	
//	wp_enqueue_style( 'dropdownlist_style_1' );
	wp_enqueue_style( 'dropdownlist_style_2' );
	
	wp_enqueue_script( 'dropdownlist_script_2' );
	wp_enqueue_script( 'jquery-ui' );
}


add_action( 'wp_enqueue_scripts', 'dropdownlist_travel',99 );

 
function kama_excerpt( $args = '' ){
	global $post;

	$default = array(
		'maxchar'     => 100, // количество символов.
		'text'        => '',  // какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
							  // Если есть тег <!--more-->, то maxchar игнорируется и берется все до <!--more--> вместе с HTML
		'save_format' => false, // Сохранять перенос строк или нет. Если в параметр указать теги, то они НЕ будут вырезаться: пр. '<strong><a>'
		'more_text'   => 'Читать дальше...', // текст ссылки читать дальше
		'echo'        => true, // выводить на экран или возвращать (return) для обработки.
	);

	if( is_array($args) )
		$rgs = $args;
	else
		parse_str( $args, $rgs );

	$args = array_merge( $default, $rgs );

	extract( $args );

	if( ! $text ){
		$text = $post->post_excerpt ? $post->post_excerpt : $post->post_content;

		$text = preg_replace ('~\[[^\]]+\]~', '', $text ); // убираем шоткоды, например:[singlepic id=3]
		// $text = strip_shortcodes( $text ); // или можно так обрезать шоткоды, так будет вырезан шоткод и конструкция текста внутри него
		// и только те шоткоды которые зарегистрированы в WordPress. И эта операция быстрая, но она в десятки раз дольше предыдущей 
		// (хотя там очень маленькие цифры в пределах одной секунды на 50000 повторений)

		// для тега <!--more-->
		if( ! $post->post_excerpt && strpos( $post->post_content, '<!--more-->') ){
			preg_match ('~(.*)<!--more-->~s', $text, $match );
			$text = trim( $match[1] );
			$text = str_replace("\r", '', $text );
			$text = preg_replace( "~\n\n+~s", "</p><p>", $text );

			$more_text = $more_text ? '<a class="kexc_moretext" href="'. get_permalink( $post->ID ) .'#more-'. $post->ID .'">'. $more_text .'</a>' : '';

			$text = '<p>'. str_replace( "\n", '<br />', $text ) .' '. $more_text .'</p>';

			if( $echo )
				return print $text;

			return $text;
		}
		elseif( ! $post->post_excerpt )
			$text = strip_tags( $text, $save_format );
	}   

	// Обрезаем
	if ( mb_strlen( $text ) > $maxchar ){
		$text = mb_substr( $text, 0, $maxchar );
		$text = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
	}

	// Сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $save_format ){
		$text = str_replace("\r", '', $text );
		$text = preg_replace("~\n\n+~", "</p><p>", $text );
		$text = "<p>". str_replace ("\n", "<br />", trim( $text ) ) ."</p>";
	}

	//$out = preg_replace('@\*[a-z0-9-_]{0,15}\*@', '', $out); // удалить *some_name-1* - фильтр смайлов

	if( $echo ) return print $text;

	return $text;
}

