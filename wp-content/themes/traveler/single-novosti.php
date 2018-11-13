<?php get_header() ?>
<?php get_template_part('breadcrumb');    ?>
  <div class = "container" style="margin-bottom: 20px;"> </div>
      <div class = "container">
 <div class="package-info-wrapper pull-left" style="width: 100%">

    <div class="row">
               <div class="col-md-4">
               <?php global $post ?>
            <div class="package-book-now-button">

               <img src="<?php bloginfo('stylesheet_directory'); ?>/thumb_logic.php?src=<?php echo get_image_url_id($post->ID); ?>&amp;h=300&amp;w=550&amp;zc=1" >
                  <?php
$title = get_the_title(); // заголовок
$summary = string_limit_words($post->post_content, 40); // анонс поста
$url =  get_the_permalink($post->ID); // ссылка на пост
$image_url = get_stylesheet_directory_uri().'/thumb_logic.php?src='.get_image_url_id($post->ID).'&amp;h=350&amp;w=550';
?>
    <div   class="rr" style="float: left; cursor: pointer;" onclick='window.open("http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo urlencode( $url ); ?>&p[title]=<?php echo $title ?>&p[summary]=<?php echo $summary ?>&p[images][0]=<?php echo $image_url ?>", "Поделиться ссылкой на Фейсбук", "toolbar=0, status=0, width=548, height=325"); return false' ><img src="<?php echo get_stylesheet_directory_uri() ?>/img/fb2.png" style="height: 40px;" alt="" /></div>
            </div>
        </div>
        <div class="col-md-8 tout_l_left" style="font-size: 17px; color: #000;">
                          <h2 class="lh1em featured_single featured_single_tour" style="font-size: 34px;">
                     <?php the_title() ?>                  </h2>

                            <p class="mb0" style="font-family: times new roman;">
                                   <?php echo __($post->post_content) ?>
                            </p>





</div>
</div>




</div>
     </div>

<?php get_footer() ?>