<?php 
    // default : list
    // for activity list related from 1.1.7
?>
<ul class='activity_list booking-list'>
    <?php 
    while(have_posts()):
        the_post();

        $price = get_post_meta(get_the_ID(),'price',true);        
        if ($price){
            $count_sale = get_post_meta(get_the_ID(),'discount',true);
        }
        if(!empty($count_sale)){
           $x = $price;
           $price_sale = $price - $price * ( $count_sale / 100 );
           $price = $price_sale;
           $price_sale = $x;
       }

        ?>
        <li class="item-nearby post-1616 st_activity type-st_activity status-publish has-post-thumbnail hentry st_activity_type-city-trips st_activity_type-ecoactivityism st_activity_type-escorted-activity st_activity_type-group-activity st_activity_type-ligula">
            <?php echo STFeatured::get_featured(); ?>
            <div class="booking-item booking-item-small">
                <div class="row">
                    <div class="col-xs-4">
                        <a class="hover-img" href="<?php the_permalink()?>">
                            <?php 
                            if(has_post_thumbnail()){
                                the_post_thumbnail(array(400,300));
                            }else{
                                echo st_get_default_image();
                            }
                            ?>
                            <!-- <h5 class="hover-title-center"><?php _e('Book Now',ST_TEXTDOMAIN)?></h5> -->
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <h5 class="booking-item-title"><a href="<?php echo get_permalink();?>"><?php the_title();?></a> </h5>
                        <ul class="icon-group booking-item-rating-stars">
                            <?php echo TravelHelper::rate_to_string(STReview::get_avg_rate());?>                      
                        </ul>
                    </div>
                    <div class="col-xs-4">
                        <span class="booking-item-price-from">from</span>                        
                        <div>
                            <?php if(!empty($is_sale)){ ?>
                                <span class="text-small lh1em  onsale">
                                                <?php echo TravelHelper::format_money( $price )?>
                                            </span>
                                <i class="fa fa-long-arrow-right"></i>
                            <?php } ?>
                            <?php
                            if(!empty($price)){
                                ?>
                                <span class="text-lg lh1em text-color">
                                   <?php echo STActivity::get_price_html(get_the_ID(),false,'<br>'); ?>
                               </span>
                                <?php 
                            }
                            ?>
                        </div>
                        <?php if(!empty( $count_sale )) { ?>
                            <span class="box_sale sale_small btn-primary"> <?php echo esc_html( $count_sale ) ?>% </span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </li>
        <?php
    endwhile;
    ?>
    
</ul>