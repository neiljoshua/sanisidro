
	<ul class="project-gallery">

	<?php 	foreach( $posts as $post ):
			    setup_postdata( $post );
					$title = get_the_title();
					$image =  get_field('project_image');
					$location = get_field('project_location');
					$city = get_field('city');
					$state = get_field('state');
					$city = strtolower($city);
					$state = strtolower($state);

	?>
		            <li class="gallery-image" data-state="<?php echo $state ;?>" data-city="<?php echo $city ;?>" >
		                <a href="<?php the_permalink() ?>">
		                     <img class="lazy" data-original="<?php echo $image; ?>" alt="<?php echo $title ;?>" >
		                </a>
		                <p><?php echo $title ?></p>
		            </li>
	<?php 		endforeach; ?>

	<?php wp_reset_postdata();?>

	</ul>

