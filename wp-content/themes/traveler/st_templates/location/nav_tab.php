<div class='location_tab tabbable <?php echo esc_attr($tab_nav_class) ; ?>' >
   <ul class="nav nav-tabs ">      
      <li class="active">
         <a href="#tab_info" data-toggle="tab">
            <i class="<?php echo get_post_meta(get_the_ID() ,'tab_icon_info_icon', true); ?>"></i>
            <?php echo esc_attr(get_post_meta(get_the_ID() , 'information_text_title' ,true))?>
         </a>
      </li>
      <?php if (get_post_meta(get_the_ID() , 'map_tab' , true) =="on") {?>
      <li>
         <a href="#google-map-tab" data-toggle="tab">
            <i class="<?php echo esc_attr(get_post_meta(get_the_ID() , 'tab_icon_map' , true))?>"></i>
            <?php echo (get_post_meta(get_the_ID(), 'map_tab_name', true))?>
         </a>
      </li>
      <?php }?>
      <?php $post_active = STLocation::get_post_type_list_active() ; ?>
      <?php 
      if (is_array($post_active ) and !empty($post_active)){
      foreach ($post_active as $key => $value) {
         if (get_post_meta(get_the_ID() ,'tab_enable_'.$value, true) =="on"){
         ?>
            <li>
               <a href="#<?php echo esc_attr($value); ?>" data-toggle="tab">
                  <i class="<?php echo get_post_meta(get_the_ID() ,'tab_icon_'.$value, true); ?>"></i>
                  <?php echo get_post_meta(get_the_ID() ,'tab_name_'.$value, true) ?>
               </a>
            </li>
         <?php }
         }
      }?>
      
   </ul>
</div>