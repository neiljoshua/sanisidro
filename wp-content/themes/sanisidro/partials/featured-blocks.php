
	<?php 
		$args = array(
		  'post_type' => 'project',
		  'posts_per_page' => 8,
		  'order' => 'DESC',
		  'orderby' => 'post_date',
		  'meta_query' => array(
		    array(
		      'key' => 'project_featured',
		      'value' => '1',
		      'compare' => '=='
		    )
		  )
		);

		$posts = get_posts( $args );
	?>

	<ul class="home-gallery clear-float">

	<?php 		foreach( $posts as $post ): 
			        setup_postdata( $post );
					$title = get_the_title(); 
					$image =  get_field('project_image');  
					$location = get_field('project_location');
	?>
		            <li class="gallery-image" >
		                <a href="<?php the_permalink() ?>">
		                     <img src="<?php echo $image; ?>" />
		                </a>
		                <p><?php echo $title ?></p>
		            </li>
	<?php 		endforeach; ?>

	<?php wp_reset_postdata();?>

	</ul>
				
