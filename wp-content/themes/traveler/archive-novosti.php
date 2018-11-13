<?get_header();
?>
    <div class="container">
        <h1 class="page-title">Новости</h1>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <?php           $args = array(

                              	'post_type' => 'novosti',
                              	'posts_per_page' => 10,
                                 'order' => 'DESC',



                              );
                              $posts = get_posts( $args ); ?>


                                                      <?php  foreach( $posts as $pst ){  ?>

                    <div class="post article" >

        <header class="post-header">

           <a class="hover-img" href="<?php echo get_the_permalink($pst->ID)?>">
           <img src="<?php echo get_stylesheet_directory_uri() ?>/thumb_logic.php?src=<?php echo get_image_url_id($pst->ID); ?>&amp;h=350&amp;w=550" class="attachment-post-thumbnail wp-post-image"  height="350" width="550">
    <?php // the_post_thumbnail() ?>
    <i class="fa fa-link box-icon-# hover-icon round"></i>
</a>


        </header>

<div class="post-inner">


   <h4 class="post-title"><a class="text-darken" href="<?php echo  get_the_permalink($pst->ID)?>"><?php echo get_the_title($pst->ID)?></a></h4>


    <div class="post-desciption" style="min-height: 180px;">
        <?php echo __(string_limit_words($pst->post_content, 40)) ?>...
    </div>
    <a class="btn btn-small btn-primary" href="<?php echo get_the_permalink($pst->ID)?>"><?php st_the_language('Читать новость')?></a>
           <?php
$title = get_the_title($pst->ID); // заголовок
$summary = string_limit_words($pst->post_content, 10); // анонс поста
$url =  get_the_permalink(); // ссылка на пост
$image_url = get_stylesheet_directory_uri().'/thumb_logic.php?src='.get_image_url_id($pst->ID).'&amp;h=350&amp;w=550';
?>
    <div   class="rr" style="float: right; cursor: pointer;" onclick='window.open("http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo urlencode( $url ); ?>&p[title]=<?php echo $title ?>&p[summary]=<?php echo $summary ?>&p[images][0]=<?php echo $image_url ?>", "Поделиться ссылкой на Фейсбук", "toolbar=0, status=0, width=548, height=325"); return false' ><img src="<?php echo get_stylesheet_directory_uri() ?>/img/fb2.png" style="height: 40px;" alt="" /></div>

</div>
</div>


                      <?php
                    }
                    TravelHelper::paging();

                ?>
            </div>

        </div>
    </div>

     <script type="text/javascript">
     /*
jQuery(document).ready(function (){

              setTimeout(function(){jQuery('.rr').removeClass('fancybox').removeClass('image')},5000);






});



   *

</script>
<?php
get_footer();?>