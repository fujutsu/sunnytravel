<?php 
	$title = $instance['title'];
	$location = $instance['location'];
	if (!$instance['location']){$location = get_the_ID();}
	$post_type = $instance['post_type'];
	$count_review_s = $instance['count_review'];	



?>
<h4><?php if (!$title){echo __("Largest Selection" , ST_TEXTDOMAIN) ; }else {echo esc_html($title) ; }?></h4>
<p>
	
	
	<?php 
		if (is_array($post_type) and !empty($post_type)){	
			$count_review = 0 ; 
			foreach ($post_type as $key => $value) {

			if ($key!=0){echo "<br>";}			
				$result = (STLocation::get_info_by_post_type(get_the_ID() , $value , $location));
				echo STLocation::round_count_reviews($result['offers'])." ".$result['post_type_name'];				
				$count_review += $result['reviews'];
				
				
			}
		}
		
	?>
	<?php if ($count_review_s =="on"){?>
		<br><?php echo __("Over",ST_TEXTDOMAIN)  ;?> <?php echo esc_attr(STLocation::round_count_reviews($count_review)) ;?> <?php if ($count_review >=2){echo __("reviews" , ST_TEXTDOMAIN) ;}else{echo __("review" , ST_TEXTDOMAIN) ;}?>

	<?php }?>
</p>