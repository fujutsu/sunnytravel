<?php
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Search custom activity
     *
     * Created by ShineTheme
     *
     */
    get_header();
    global $wp_query,$st_search_query;
    $activity=new STActivity();
    add_action('pre_get_posts',array($activity,'change_search_activity_arg'));
    query_posts(
        array(
            'post_type'=>'st_activity',
            's'=>get_query_var('s'),
            'paged'     => get_query_var('paged')
        )
    );
$st_search_query=$wp_query;
    remove_action('pre_get_posts',array($activity,'change_search_activity_arg'));
    get_template_part('breadcrumb');
    $result_string='';
    echo st()->load_template('search-loading');
?>
<?php ?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template('activity/search-form');?>
    </div>
    <div class="container">
        <h3 class="booking-title"><?php echo balanceTags($activity->get_result_string())?>
            <small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out"><?php echo __('Change search',ST_TEXTDOMAIN)?></a></small>
        </h3>
        <?php
            $tours_layout_layout=st()->get_option('activity_search_layout');
            if(!empty($_REQUEST['layout_id'])){
                $tours_layout_layout = $_REQUEST['layout_id'];
            }
            if($tours_layout_layout)
            {
                echo  STTemplate::get_vc_pagecontent($tours_layout_layout);
            }
        ?>
    </div>
<?php

    get_footer();
?>