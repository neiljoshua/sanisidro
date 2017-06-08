
	<ul class="home-gallery clear-float">

	<?php 		foreach( $posts as $post ): 
			        setup_postdata( $post );
					$title = get_the_title(); 
					$image =  get_field('project_image');  
					$location = get_field('project_location');
	?>
		            <li class="gallery-image" >
		                <a href="<?php the_permalink() ?>">
		                     <img class="lazy" data-original="<?php echo $image; ?>" wifth="270" height="170">
		                </a>
		                <p><?php echo $title ?></p>
		            </li>
	<?php 		endforeach; ?>

	<?php wp_reset_postdata();?>

	</ul>
				
