<?php 
/**
*Template Name: Projects Page
**/

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
  'post_type' => 'projects',
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
   <section class="hero-project">
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
	   		<div>
	   			<img class ="hero-image" src="<?php echo $imagelead; ?>">
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

   <div class="featured_title"><p>Projects</p></div>

   <section class="home-gallery clear-float">
	 	<?php include("partials/featured-blocks.php") ?>
   </section>		

</main>	

<?php


get_footer();
