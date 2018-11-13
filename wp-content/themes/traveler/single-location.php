<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Single blog
 *
 * Created by ShineTheme
 *
 */
get_header();
$location_id = get_the_ID();

?>
    <div class="container single-location" id="location-<?php echo get_the_ID() ; ?>">
        <div class="container">
            <div class="breadcrumb">
                <ul class="breadcrumb">
                    <?php st_breadcrumbs(); ?>
                </ul>
            </div>
        </div>
        <h2><?php the_title()?></h2>
        <div class="row" id="st_location_single">
            <?php 
            if (get_post_meta(get_the_ID() , 'post_sidebar_pos' , true) =='no'){
                $sidebar_pos = false ; 
            }
            if (!get_post_meta(get_the_ID() , 'post_sidebar_pos' , true)){
                $sidebar_pos = st()->get_option('blog_sidebar_pos', 'right');
            }

            $sidebar_mb = get_post_meta(get_the_ID() , 'post_sidebar_pos' , true) ; 
            $sidebar_op = st()->get_option('blog_sidebar_pos', 'right');

            $sidebar_pos = "right";
            if (st()->get_option('blog_sidebar_pos', 'right')){$sidebar_pos = st()->get_option('blog_sidebar_pos', 'right');}
            if (get_post_meta(get_the_ID() , 'post_sidebar_pos' , true)){$sidebar_pos = get_post_meta(get_the_ID() , 'post_sidebar_pos' , true) ;}

            if (!$sidebar_mb){
                $sidebar_pos = $sidebar_op; 
            }

            if($sidebar_pos=="left"){
                get_sidebar(get_post_meta(get_the_ID(),'post_sidebar'));
            }

            ?>

            <div class="<?php echo apply_filters('st_blog_sidebar','right')=='no'?'col-sm-12':'col-sm-9 col-xs-12'; ?>">
                
                <?php 
                echo st()->load_template('location/location_gallery' , NULL , array()); 
                echo st()->load_template('location/location_tab' , NUll , array()) ;
                ?>
            </div>

            <?php
            if($sidebar_pos=="right"){
                get_sidebar(get_post_meta(get_the_ID(),'post_sidebar'));
            }
            ?>
        </div>
    </div>
<?php
get_footer();