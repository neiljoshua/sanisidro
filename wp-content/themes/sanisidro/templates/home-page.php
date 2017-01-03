<?php 
/**
*Template Name: Home Page
**/

add_action('home_page_content', 'do_home_page_content');

add_filter('body_class', 'add_home_page_body_class');

function add_home_page_body_class($classes) {
	
	$classes[] = 'home_page_template';

	return $classes;

}

// add_theme_support('sanisidro-structural-wraps', array( 'header' , 'footer' , 'nav',) );

function do_home_page_content() {
?>

<main>

<?php

// Check if the flexible content field has rows of data 
if( have_rows('home_content') ): ?>

	<?php // loop through the rows of data ?>
	<?php while ( have_rows('home_content') ) : the_row(); ?>

	<?php 	// check current row layout ?>
	<?php 	if( get_row_layout() == 'hero'): ?>
			<section>
				<div class="hero" style="background-image: url(<?php the_sub_field('hero_image') ?>)">
					<div class="logo">
						<img src="<?php the_sub_field('hero_logo') ?>" />
					</div>
				</div>
			</section>
	<?php endif; ?>		

	<?php 	// check current row layout ?>
	<?php 	if( get_row_layout() == 'slider-home'): ?>
			<section id="startchange">
			<div class="text-slider">
				 <?php the_sub_field('slider_description'); ?> 
			</div>

			<?php if( have_rows('slider_home') ): ?>
			
			 <div class="slider-for">

				<?php while( have_rows('slider_home') ): the_row(); ?>
					<?php $imageLink = get_sub_field('slider_image');?>

						 <div class="slick-container">
						 	<img src="<?php echo $imageLink; ?>" alt="<?php echo $imageLink; ?>"/>
						 	<p> <?php the_sub_field('slider_description')?></p>
						 </div>

				<?php endwhile; ?>
				
			</div>
			<div class="text-left">
				<p><?php the_sub_field('slider_about')?></p>
			</div>
			<?php endif; ?>

			</section>
	<?php endif; ?>		

	<?php 	// check current row layout ?>
	<?php 	if( get_row_layout() == 'about_home'): ?>
			<section>
			<div class="about-text">
				<div class="text-left"><h1><?php the_sub_field('about_title') ?> </h1></div>
				<div class="text-right"><p><?php the_sub_field('about_description') ?> </p></div>
			</div>		
			</section>
	<?php endif; ?>		

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

do_action( 'home_page_content' );

get_footer(); 