<?php 
/**
*Template Name: Projects Page
**/

add_action('projects_page_content', 'do_projects_page_content');

add_filter('body_class', 'add_projects_page_body_class');

function add_projects_page_body_class($classes) {
	
	$classes[] = 'projects_page_template';

	return $classes;

}

//add_theme_support('sanisidro-structural-wraps', array( 'header' , 'footer' , 'nav',) );

function do_projects_page_content() {
?>

<main>

<?php

	if( have_rows('project_content') ): ?>
	<?php // loop through the rows of data ?>
	<?php while ( have_rows('project_content') ) : the_row(); ?>

	<?php 	// check current row layout ?>
	<?php 	if( get_row_layout() == 'featured_properties'): ?>
			<section>
			
				<div class="featured_title"><p><?php the_sub_field('featured_title') ?> </p></div>
				<div class="feature_view "><p><?php the_sub_field('feature_view') ?> </p></div>
				
				<?php 
				$images = get_sub_field('featured_gallery'); 

				if( $images ): ?>
				    <ul class="home-gallery clear-float">
				        <?php foreach( $images as $image ): ?>
				            <li class="gallery-image" >
				                <a href="<?php echo $image['url']; ?>">
				                     <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
				                </a>
				                <p><?php echo $image['caption']; ?></p>
				            </li>
				        <?php endforeach; ?>
				    </ul>
				<?php endif; ?>
				
			</section>
	<?php endif; ?>	
	<?php endwhile; ?>

<?php else :	

	// do something

endif;	

?>	


</main>	


<?php

}


get_header(); 

do_action( 'projects_page_content' );

get_footer();