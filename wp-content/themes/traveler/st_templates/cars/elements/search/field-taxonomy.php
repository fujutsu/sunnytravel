<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Hotel field taxonomy
 *
 * Created by ShineTheme
 *
 */
$default=array(
    'title'=>'',
    'taxonomy'=>'',
    'is_required'=>'on',
);

if(isset($data)){
    extract(wp_parse_args($data,$default));
}else{
    extract($default);
}


$terms = get_terms($taxonomy);

if(!isset( $field_size ))
    $field_size = 'md';

if(!empty($terms)):
?>
<div class="form-group form-group-<?php echo esc_attr($field_size)?>" taxonomy="<?php echo esc_html($taxonomy) ?>">
    <label><?php echo esc_html( $title)?></label>
    <select class="form-control" id="taxonomy_car" name="filter_taxonomy[<?php echo esc_html($taxonomy) ?>]">
        <option value=""><?php _e('-- Select --',ST_TEXTDOMAIN) ?></option>
        <?php if(is_array($terms)){ ?>
            <?php foreach($terms as $k=>$v){ ?>
                <?php $is_taxonomy = STInput::request('filter_taxonomy');?>
                <option slug="<?php echo esc_attr($v->slug) ?>" <?php if(!empty($is_taxonomy[$taxonomy][$v->slug]) and $is_taxonomy[$taxonomy][$v->slug] == $v->term_id) echo 'selected'; ?>  value="<?php echo esc_attr($v->term_id) ?>">
                    <?php echo esc_html($v->name) ?>
                </option>
            <?php } ?>
        <?php } ?>
    </select>
</div>
<?php endif ?>
<script>
    jQuery(function($){
        var $this = $('#taxonomy_car');
        var name = $this.attr('name');
        var slug = $('option:selected', $this).attr('slug');
        $this.attr('name',name+ '['+slug+']')
        $this.change(function(){
            slug = $('option:selected', this).attr('slug');
            $(this).attr('name',name+ '['+slug+']')
        })
    })
</script>
