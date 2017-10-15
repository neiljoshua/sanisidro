<?php
/**
*Template Name: Projects Page
**/

include('src/inc/constants.php');

add_action('projects_page_content', 'do_projects_page_content');

add_filter('body_class', 'add_projects_page_body_class');

function add_projects_page_body_class($classes) {

	$classes[] = 'projects';

	return $classes;

}

add_theme_support('sanisidro-structural-wraps', array( 'header' , 'footer' , 'nav',) );


?>

<?php get_header(); ?>

<main>

<?php

$args = array(
	'post_type' => 'project',
	'posts_per_page' => 1,
	'order' => 'DESC',
	'orderby' => 'post_date',
	'meta_query' => array(
		array(
			'key' => 'project_lead',
			'value' => '1',
			'compare' => '=='
		)
	)
);

$posts = get_posts( $args );

?>
	<section >
		<!-- display lead image. -->
	<?php

	foreach ($posts as $post){
		setup_postdata( $post );
		$title = get_the_title();
		$imagelead =  get_field('project_image');
		$location = get_field('project_location');

		?>
		<?php
		$lead = get_field('project_lead');
		if ($lead){
		?>
			<div class="page-hero">
				<img class ="page-hero__image" src="<?php echo $imagelead; ?>">
			</div>
		<?php
		}
		?>
		<?php
		wp_reset_postdata();
	}
	?>
	</section>

	 <!-- display propject -->

	 <section class="project-filter">
		 <h2 class="title">Feature Projects</h2>
		 <?php
				$args = array(
					'post_type' => 'project',
					'posts_per_page' => 8,
					'order' => 'DESC',
					'orderby' => 'post_date'
				);

				$posts = get_posts( $args );
			?>

			<select name="states" class="dropk" class="state-select" data-select="state" tabindex="0">

				<option  class="filter-project" value="default" > Select State </option>

				<?php global $states ?>

				<?php foreach ($states as $state) { ?>

				<option class="filter-project"  value="<?php echo $state; ?>"> <?php echo $state; ?> </option>

				<?php } ?>

			</select>

			<select name="cities" class="dropk" class="city-select" data-select="city"  tabindex="1" id="disabled" disabled>

				<option class="cities-item" value="default" > Select City </option>

				<?php global $cities ?>

				<?php foreach ($cities as $city) { ?>

					<!-- // query each city for project -->
					<!-- // $projects_with_city -->
					<?php $projects_with_city = get_posts( array(
						'post_type' => 'project',
						'posts_per_page' => 1,
						'meta_query' => array(
							 array(
									'key' => 'city',
									'value' => $city,
									'compare' => '==' )
							 )
							)
						);
					?>
					<?php
					foreach($projects_with_city as $project)
					{
						$state = get_post_meta($project->ID, "state", true);
					}
					?>
					<!-- // for each project get state
					// apply data-state attribute to city option below -->
					?>

					<option class="cities-item" value="<?php echo strtolower($city); ?>" data-state="<?php echo $state; ?>"><?php echo $city; ?> </option>

				<?php } ?>

			</select>

			<form id="proj-search" class="projects-form" action="search">
				<input class="proj-search-input" type="input" name="projects" placeholder="Enter City, State or Project">
				<button class="proj-search-bttn" type="submit">SEARCH</button>
			</form>

		 	<?php include("partials/featured-blocks.php") ?>


	 </section>

</main>

<?php


get_footer();
