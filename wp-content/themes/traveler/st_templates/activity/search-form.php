<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Activity search form
 *
 * Created by ShineTheme
 *
 */
$activity=new STActivity();
$fields=$activity->get_search_fields();
?>
<h3><?php st_the_language('search_for_activity'); ?></h3>
<form role="search" method="get" class="search" action="<?php echo home_url( '/' ); ?>">
    <input type="hidden" name="s" value="">
    <input type="hidden" name="post_type" value="st_activity">
    <input type="hidden" name="layout" value="<?php echo STInput::get('layout') ?>">
    <input type="hidden" name="style" value="<?php echo STInput::get('style') ?>">
    <div class="row">
        <?php
        if(!empty($fields))
        {
            foreach($fields as $key=>$value)
            {
                $name=$value['activity_field_search'];
                $size=$value['layout_col'];

                ?>
                <div class="col-md-<?php echo esc_attr($size);
                ?>">
                    <?php echo st()->load_template('activity/elements/search/field',$name,array('data'=>$value)) ?>
                </div>
            <?php
            }
        }?>
    </div>
    <button class="btn btn-primary btn-lg" type="submit"><?php st_the_language('search_for_activity'); ?></button>
</form>
