<?php
/**
*Template Name: Home Page
**/

// add_action('home_page_content', 'do_home_page_content');

add_filter('body_class', 'add_home_page_body_class');

function add_home_page_body_class($classes) {

	$classes[] = 'home';

	return $classes;

}

add_theme_support('sanisidro-structural-wraps', array( 'header' , 'footer' , 'nav',) );

// function do_home_page_content() {

get_header();
?>

<main>

<?php
	$lead = get_field('hero_image');
	if ($lead){
  ?>

  <section>
		<div class="hero">
			<img class="lazy page-hero__image" data-original="<?php echo $lead; ?>"" alt="Hero Image">
			<div class="logo">
				<img src="<?php the_field('hero_logo') ?>" alt="Logo"/>
			</div>
		</div>
  </section>

  <?php
  }
  ?>

  <?php
	 	$sliderHome = get_field('slider_home_page');
	 	if ($sliderHome){
	  ?>

 		 <section id="startchange">
 		 	<h2 class="title"> San Isidro </h2>
 		 	<p class="copy"> <?php the_field('hero_content');?> </p>

			<?php if( have_rows('slider_home_page') ): ?>

			 	<div class="home-slider">

				<?php while( have_rows('slider_home_page') ): the_row(); ?>
					<?php $imageLink = get_sub_field('slider_image');?>

						 <div class="slick-container">
							 <img class="lazy" data-original="<?php echo $imageLink; ?>" width="900"  alt="<?php the_sub_field('slider_name')?>" >
							 	<p> <?php the_sub_field('slider_name')?></p>
						 </div>

				<?php endwhile; ?>

				</div>

			<?php endif; ?>

		</section>

  <?php
  }
  ?>

  <?php
 	$aboutTitle = get_field('about_title');
 	if ($aboutTitle){
  ?>

	  <section>
	 		<h2 class="title"> <?php echo $aboutTitle; ?></h2>
	 		<p class="copy"> <?php the_field('about_content');?></p>
	 	</section>

  <?php
  }
  ?>

  <?php
  $feautred_page = get_field('featured_page_option');
  if($feautred_page) {
  ?>

	  <section>
			<h2 class="title">Featured </h2>
			<a class="featured_link" href="/index.php?page_id=251"> View Projects</a>
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
			<?php include("partials/featured-blocks.php") ?>
		</section>

	<?php
	}
	?>

</main>

<?php

get_footer();
