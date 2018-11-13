<?php 
/*
Template Name: kak-zabronirovat-tur
*/?>
<?php get_header(); ?> 
    <div class="container">
        <br>
            <h2 class="wpb_heading wpb_accordion_heading">Как забронировать тур</h2>
        <br>
         <article> 
 
                <?php
                    if ( have_posts() ) : // если имеются записи в блоге.
                      query_posts('cat=62');   // указываем ID рубрик, которые необходимо вывести.
                      while (have_posts()) : the_post();  // запускаем цикл обхода материалов блога
                ?>

        <div class="container">
            <div class="row wpb_accordion wpb_content_element  not-column-inherit" id="container">
                <div class="col-md-12 wpb_accordion_section group "  id="accordion">
                    <div class="col-md-12 ui-widget-content item" >
                        <input type="checkbox" class="accordion_toggle" id="toggle-05" hidden>
                             <h3 style="text-align: left;font-family:Montserrat;font-weight:400;font-style:normal;margin-bottom: 35px;margin-top: 10px;" class="vc_custom_heading">
                                 <i class="fa fa-angle-right" aria-hidden="true" style="color: #75d69c;"></i> 
                                     <a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a>
                            </h3>
                            <div class="col-md-10"><?php the_excerpt(); ?>
                            </div>         
                                <div class="col-md-2" style="float: right; margin-left: -17px;">
                                    <a  class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-color-juicy-pink" href="<?php the_permalink(); ?>">Подробнее</a>
                                </div>
                    </div>
                             <?php tem ?>
                </div>
            </div>
          </div>
                <?php   
                    endwhile; 
                    endif;
                    wp_reset_query();                
                 ?> 
          
        </article>  
    </div>

<?php get_footer(); ?>
