<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Tours info
 *
 * Created by ShineTheme
 *
 */
                 global $post;
//check is booking with modal
$st_is_booking_modal=apply_filters('st_is_booking_modal',false);

$type_price = get_post_meta(get_the_ID(),'type_price',true);
$type_tour = get_post_meta(get_the_ID(),'type_tour',true);

if($type_price=='people_price')
{
    $info_price=STTour::get_price_person(get_the_ID());
}else{
    $info_price = STTour::get_info_price(get_the_ID());

}
echo STTemplate::message();
?>
<div class="package-info-wrapper pull-left" style="width: 100%">
    <div class="overlay-form"><i class="fa fa-refresh text-color"></i></div>
    <div class="row">
               <div class="col-md-6">
            <div class="package-book-now-button">

               <img src="<?php bloginfo('stylesheet_directory'); ?>/thumb_logic.php?src=<?php echo get_image_url_id($post->ID); ?>&amp;h=300&amp;w=550&amp;zc=1" >


            </div>
        </div>
        <div class="col-md-6 tout_l_left" style="font-size: 17px; color: #000;"> <?php
                    $cantry =     get_post_meta(get_the_ID(), 'to_cantry', false);
                    $city =     get_post_meta(get_the_ID(), 'to_city', false);
                    $otels =     get_post_meta(get_the_ID(), 'to_otels', false);
                    $peoples =     get_post_meta(get_the_ID(), 'peoples', false);
                    $food =     get_post_meta(get_the_ID(), 'food', false);
                    $to_date =     get_post_meta(get_the_ID(), 'to_date', false);
                    $price2 =     get_post_meta(get_the_ID(), 'price2', false);
                     $id_location = get_the_ID();
                ?>

                          <h2 class="lh1em featured_single featured_single_tour" style="font-size: 34px;">
                        <?php echo $post->post_title ?>
                    </h2>


                        <?php if($cantry[0] != "") { ?>
                            <span class="font_name_tours">Страна:</span> <?php echo $cantry[0]; ?> <br>
                            <?php } ?>


                        <?php if($city[0] != "") { ?>
                            <span class="font_name_tours">Город:</span> <?php echo $city[0]; ?>   <br>
                            <?php } ?>



                        <?php if($otels[0] != "") { ?>


                          <span class="font_name_tours">Отель:</span>  <?php echo $otels[0]; ?>  <br>
                           <?php } ?>


                        <?php if($to_date[0] != "") { ?>


                           <span class="font_name_tours">До:</span>  <?php echo $to_date[0]; ?>  <br>
                           <?php } ?>




                            <?php if($peoples[0] != "") { ?>
                           <span class="font_name_tours">Кол. чел.:</span> <?php echo $peoples[0]; ?>  <br>
                           <?php } ?>

                           <?php if($food[0] != "") { ?>
                           <span class="font_name_tours">Питание:</span>  <?php echo $food[0]; ?>  <br>
                           <?php } ?>


                            <p class="mb0 text-darken">
                                <i class="fa fa-money"></i>
                                <?php _e("<span class='font_name_tours'>Цена</span> ",ST_TEXTDOMAIN) ?>:
                                <!--?php echo STTour::get_price_html(false,false,' <br> -'); ?-->
                                 <?php echo $price2[0] ;  ?>   <br>
                            </p>



                          <div style="display:none" class="fancybox-hidden call-form">
                                  <div id="contact_form_tour<?= get_the_ID() ?>">
                        <?php echo do_shortcode( "[contact-form-7 id='5' title='Контактная форма 1']" ); ?>
                                  </div>
                                  </div>

                           <a href="#contact_form_tour<?= get_the_ID() ?>" style="color: #000;" type="button" class="fancybox btn btn-primary "><?php _e('Подобрать тур',ST_TEXTDOMAIN) ?> <i class="fa fa-shopping-cart"></i></a> <br>  <br>


</div>
</div>


    <?php if(!empty($info_price['discount'])){ ?>
        <span class="box_sale sale_small btn-primary"> <?php echo esc_html($info_price['discount']) ?>% </span>
    <?php } ?>

<div class="row">
<div class="col-md-12" style="margin-top: 30px; ">
                  <h2 style="text-align: center; font-size: 28.985px;"><span style="color: #ff9900;">Программа тура</span></h2>
           <div class="wpb_wrapper" style='color: rgb(115, 115, 115); font-family: "Open Sans",Tahoma,Arial,helvetica,sans-serif; font-size: 14px; line-height: 1.6em; font-weight: 400;'>
                             <?php echo $post->post_content ?>
</div>
</div>
</div>
</div>
<?php
if($st_is_booking_modal){?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="tour_booking_<?php the_ID()?>">
        <?php echo st()->load_template('tours/modal_booking');?>
    </div>

<?php }?>

