   <div class="tab-pane row active" id="tab_info">
      <!-- start description -->
      <div class='location_desc_container col-md-12 col-xs-12'>
         <div class='row'>
            <?php 
               if (get_post_meta(get_the_ID(), 'info_location_tab_item_enable' , true) =="on"){

                  $nav_position =  get_post_meta(get_the_ID() , 'info_location_tab_item_position' , true);
                  
                  
                  $array_class = array(
                        'nav_position' => $nav_position,                        
                     );

                  if ($nav_position == "left"){
                     echo st()->load_template('location/location_info/nav' , NULL , $array_class);
                     }
                  if ($nav_position == "top"){
                  echo st()->load_template('location/location_info/nav' , NULL , $array_class);
                  }
                  
                  echo st()->load_template('location/location_info/content' , NULL , $array_class);

                  if ($nav_position == "right"){
                     echo st()->load_template('location/location_info/nav' , NULL , $array_class);
                     }

               }else {
                  ?>
                  <div class='col-md-12'>
                     <?php while(have_posts()){
                    the_post();
                    the_content() ; 
                       if ( comments_open() || '0' != get_comments_number() ) :
                           comments_template();
                       endif;
                    }?>

                  </div>
                             
               <?php }
            ?>
         </div>
      </div>
      
      <!-- end description -->
   </div>
   <?php if (get_post_meta(get_the_ID() , 'map_tab' , true) =="on") {?>
      <div class="tab-pane row fade" id="google-map-tab"  data-lat = "<?php echo esc_attr(get_post_meta(get_the_ID() , 'map_lat' , true)); ?>" data-long = "<?php echo esc_attr(get_post_meta(get_the_ID() , 'map_lng' , true)); ?>">
         <div class='col-md-12 col-xs-12'>

            <?php if (get_post_meta(get_the_ID() , 'map_lat' , true) and get_post_meta(get_the_ID() , 'map_lng' , true) ){?>   
               <!-- <div class='location_map' data-zoom = "<?php echo st()->get_option('map_zoom_location') ;?>" ></div> -->

               <?php 
               $st_type ; 
               $number = get_post_meta(get_the_ID(),'max_post_type_num',true);
               if (!$number){$number = 36;} 

               $zoom = get_post_meta(get_the_ID(),'map_zoom_location' , true);
               if (!$zoom){$zoom = 15;}

               $map_height = get_post_meta(get_the_ID(),'map_height' , true);
               if (!$map_height){$map_height = 500;}               

               $map_location_style = get_post_meta(get_the_ID(),'map_location_style',true);
               if (!$map_location_style){$map_location_style = 'normal';}

               $list_post_type = STLocation::get_post_type_list_active();
               $shortcode_string = "";
               if (is_array($list_post_type) and !empty($list_post_type)) {
                foreach ($list_post_type as $key => $value) {
                     if(get_post_meta(get_the_ID(),'tab_enable_'.$value , true) =='on'){
                        $flag = $value; 
                     }
                     if ($key != 0){
                        $shortcode_string .= ",".$value;
                     }else {
                        $shortcode_string .= $value;
                     }
                  }
               };
               $show_data_list_map = apply_filters('show_data_list_map' , 'no');
               echo do_shortcode('[st_list_map 
                  st_type= "'.$shortcode_string.'" 
                  number="'.$number.'" 
                  zoom="'.$zoom.'" 
                  height="'.$map_height.'" 
                  style_map="'.$map_location_style.'" 
                  st_list_location="'.get_the_ID().'" 
                  show_data_list_map = "'.$show_data_list_map.'" 
                  show_search_box = "no"]');

               ?>

            <?php };?>
   

         </div>
      
      </div>

   <?php }?>

   <?php 

   $post_active = STLocation::get_post_type_list_active();
   if (is_array($post_active ) and !empty($post_active)){
   foreach ($post_active as $key => $value) {
      if (get_post_meta(get_the_ID() ,'tab_enable_'.$value, true) =="on"){
      ?>
      <div class="tab-pane row fade" id="<?php echo esc_attr($value);?>">
         <?php echo st()->load_template('location/location_tabcontent',$value);?>
      </div>         
      <?php }
      }
   }?>