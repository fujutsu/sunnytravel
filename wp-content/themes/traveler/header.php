<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Header
 *
 * Created by ShineTheme
 *
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.7/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//sunnytravel.dp.ua/wp-content/themes/traveler/css/slick-theme.css"/>
    <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '156400174778613');
fbq('track', "PageView");</script>
<noscript>
		<img alt="facebook" height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=156400174778613&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<style>
	.to_blur {
		-webkit-filter: brightness(50%);
		-webkit-transition: all 1s ease;
		-moz-transition: all 1s ease;
		-o-transition: all 1s ease;
		-ms-transition: all 1s ease;
		transition: all 1s ease;
	}
	
	.form-header {
		font-family: cursive;
	}
	
	<?php if( is_home() or is_front_page() ): ?>
		.datepicker-from {
			padding: 0px 10px 0px 0px !important;
		}
		.datepicker-to {
			padding: 0px 10px 0px 0px !important;
		}
	<?php else: ?>
		.datepicker-from {
			padding: 0px 10px 0px 10px !important;
		}
		.datepicker-to {
			padding: 0px 10px 0px 10px !important;
		}
	<?php endif; ?>

	#contact_form_pop5{background-image: url(https://sunnytravel.dp.ua/wp-content/uploads/st_uploadfont/jpg-1.jpg); background-color: #f6d654}
	.nnnna5::-webkit-input-placeholder {color:#000;}
	.nnnna5::-moz-placeholder          {color:#000;}
	.nnnna5:-moz-placeholder           {color:#000;}
	.nnnna5:-ms-input-placeholder      {color:#000; }

	.nnnna5{background: #fff !important; border: 1px solid;}               
	.nnnna::-webkit-input-placeholder {color:#000;}
	.nnnna::-moz-placeholder          {color:#000;}
	.nnnna:-moz-placeholder           {color:#000;}
	.nnnna:-ms-input-placeholder      {color:#000;}
	.nnnna2::-webkit-input-placeholder {color:#fff; opacity: 1;
	font-weight: bold;}
	#nnnna2::-moz-placeholder          {color:#fff; opacity: 1;
	font-weight: bold;}
	#nnnna2:-moz-placeholder           {color:#fff; opacity: 1;
	font-weight: bold;}
	#nnnna2:-ms-input-placeholder      {color:#fff; opacity: 1;
	font-weight: bold;}

	#nnnna2  {background: transparent none repeat scroll 0% 0% !important;
	border: 1px solid;}
	#nnnna_btn{
		background: #f47555!important;
		color: #000 !important;
	}
	.menu .current-menu-item > a{ background-color: #353f3f !important;}
	.current-menu-ancestor > a{background-color: #353f3f !important;}
	.slimmenu ul li a:hover{background-color: #353f3f !important; }
	.slimmenu  li a:hover{background-color: #353f3f !important; }


	ul.slimmenu li.current-menu-item > a, ul.slimmenu li:hover > a, .menu .current-menu-ancestor > a, .product-info-hide .product-btn:hover {
		background: #353f3f  none repeat scroll 0% -4% ;
	color: #000;}

	input.wpcf7-text{ max-width: 300px;}

</style>

</head>
<body <?php body_class(); ?> >
	<div id="dark_background_popup" class="to_blur">
    <?php do_action('before_body_content')?>
    <div class="global-wrap header-wrap <?php echo apply_filters('st_container',true) ?>">
        <div class="row">
            <header id="main-header">
                <div class="header-top <?php echo apply_filters('st_header_top_class','') ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 logo-wrapper">
                                <a class="logo" <?php if( !is_front_page() ) echo 'href="' . home_url('/') . '"'; ?>>
                                    <img src="<?php echo st()->get_option('logo',get_template_directory_uri().'/img/logo.png') ?>" alt="logo" title="<?php bloginfo('name')?>">
                                </a>
                            </div>
                            <?php /*get_template_part('users/user','nav');*/?>
                            <div class="col-md-6 header-info">
                            	<p class="info-title">Туристическое агентство Sunny Travel</p>
                            	<p>г. Днепр</p>
                            	<hr>
                            	<div class="col-md-6"><p class="phone-number"><href=tel:+380680850990>+38 (068) 085-09-90</p></div>
                            	<div class="col-md-6"><p class="phone-number"><href=tel:+380667681814>+38 (066) 768-18-14</p></div>
                            </div>
                            <div class="col-md-3 call-button-wrapper">
                                <a class="fancybox btn btn-primary call-button" href="#contact_form_pop5">Заказать звонок</a>
                                <div style="display:none" class="fancybox-hidden call-form">
                                  <div id="contact_form_pop">
                                    <?php echo do_shortcode( '[contact-form-7 id="6299" title="podbor_home"]' ); ?>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main_menu_wrap">
                
                        <div class="nav">
                            <?php if(has_nav_menu('primary')){
                                wp_nav_menu(array('theme_location'=>'primary',
                                                  "container"=>"",
                                                  'items_wrap'      => '<ul id="slimmenu" class="%2$s slimmenu">%3$s</ul>',
                                ));
                            }
                            ?>
                        </div>
                  
                </div><!-- End .main_menu_wrap-->
                     <script type="text/javascript">
jQuery(document).ready(function() {
    jQuery(".fancybox3").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'autoScale'     	: false,
		'type'				: 'inline',
		'width'				: 500,
		'height'			: 500,
		'scrolling'   		: 'no'
	});
});
</script>

            </header>
        </div>
    </div>
<div class="global-wrap <?php echo apply_filters('st_container',true) ?>">
<div class="row">
