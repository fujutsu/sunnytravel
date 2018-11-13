<div class="row row-wrap">
    <?php
    while(have_posts()):
        the_post();
        $col = 12 / $st_tour_of_row;

        $info_price = STTour::get_info_price();
        $price = $info_price['price'];
        $count_sale = $info_price['discount'];
        if(!empty($count_sale)){
            $price = $info_price['price'];
            $price_sale = $info_price['price_old'];
        }
        ?>
        <div class="col-md-<?php echo esc_attr($col) ?> style_box col-sm-6 col-xs-12 st_fix_<?php echo esc_attr($st_tour_of_row); ?>_col"">
            <?php echo STFeatured::get_featured(); ?>
            <div class="thumb">
                <header class="thumb-header">
                    <?php if(!empty($count_sale)){ ?>
                        <span class="box_sale btn-primary"> <?php echo esc_html($count_sale) ?>% </span>
                    <?php } ?>
                    <a  class="hover-img">
                        <?php
                        $img = get_the_post_thumbnail( get_the_ID() , array(800,600,'bfi_thumb'=>true)) ;
                        if(!empty($img)){
                            echo balanceTags($img);
                        }else{
                            echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(get_template_directory_uri().'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                        }
                        ?>
                          <h5 style="color: rgb(0, 0, 0);" class="hover-title hover-hold" >
                            <?php the_title();; ?>
                        </h5>
                    </a>

                </header>
                <div class="thumb-caption to_font">

                <?php
                    $cantry =     get_post_meta(get_the_ID(), 'to_cantry', false);
                    $city =     get_post_meta(get_the_ID(), 'to_city', false);
                    $otels =     get_post_meta(get_the_ID(), 'to_otels', false);
                    $peoples =     get_post_meta(get_the_ID(), 'peoples', false);
                    $food =     get_post_meta(get_the_ID(), 'food', false);
                    $to_date =     get_post_meta(get_the_ID(), 'to_date', false);
                    $price2 =     get_post_meta(get_the_ID(), 'price2', false);
                     $id_location = get_the_ID();
                ?>

                    <div class="row mt10">
                        <div class="col-md-5 col-sm-5 col-xs-5">
                        <?php if($cantry[0] != "") { ?>
                            <span class="font_name_tours">Страна:</span> <?php echo $cantry[0]; ?>
                            <?php } ?>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-7 text-right">
                        <?php if($city[0] != "") { ?>
                            <span class="font_name_tours">Город:</span> <?php echo $city[0]; ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row mt10">
                        <div class="col-md-7 col-sm-7 col-xs-7">
                        <?php if($otels[0] != "") { ?>
                            <i class="fa fa-location-arrow"></i>

                          <span class="font_name_tours">Отель:</span>  <?php echo $otels[0]; ?>
                           <?php } ?>
                        </div>
                         <div class="col-md-5 col-sm-5 col-xs-5 text-right">
                        <?php if($to_date[0] != "") { ?>


                           <span class="font_name_tours">До:</span>  <?php echo $to_date[0]; ?>
                           <?php } ?>
                        </div>
                        </div>
                           <div class="row mt10">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <?php if($peoples[0] != "") { ?>
                           <span class="font_name_tours">Кол. чел.:</span> <?php echo $peoples[0]; ?>
                           <?php } ?>
                           </div>
                              <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                           <?php if($food[0] != "") { ?>
                           <span class="font_name_tours">Питание:</span>  <?php echo $food[0]; ?>
                           <?php } ?>

                        </div>

                    </div>
                    <div class="row mt10">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <p class="mb0 text-darken">
                                <i class="fa fa-money"></i>
                                <?php _e("<span class='font_name_tours'>Цена</span> ",ST_TEXTDOMAIN) ?>:
                                <!--?php echo STTour::get_price_html(false,false,' <br> -'); ?-->
                                 <?php echo $price2[0] ;  ?>
                            </p>
                             <a href="<?php echo get_permalink(get_the_ID())  ?>" style="color: #000;" type="button" class=" btn btn-primary "><?php _e('Программа тура',ST_TEXTDOMAIN) ?> </a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">

                          <br>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">


                          <div style="display:none" class="fancybox-hidden call-form">
                                  <div id="contact_form_tour<?= get_the_ID() ?>">
                        <?php echo do_shortcode( "[contact-form-7 id='5' title='Контактная форма 1']" ); ?>
                                  </div>
                                  </div>

                           <a href="#contact_form_tour<?= get_the_ID() ?>" style="color: #000;" type="button" class="fancybox btn btn-primary "><?php _e('Подобрать тур',ST_TEXTDOMAIN) ?> <i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    endwhile;
    ?>

</div>