
<?php 

	add_action('projects_page_content', 'do_projects_page_content');

	add_filter('body_class', 'add_projects_page_body_class');

	function add_projects_page_body_class($classes) {
		
		$classes[] = 'projects';

		return $classes;

	}

?>
<?php get_header(); ?>

<main>

<?php 
		
	if(have_posts()) :
	while(have_posts()) : the_post();
	$title = get_the_title();
	$image = get_field('project_image');
	$project_description = get_field('project_description');
?>

	
	<section class="hero-project">
		<div>
			<img class="hero-image" src="<?php echo $image ?>" />
		</div>
	</section>

	<div class="featured_title"><p><?php echo $title; ?></p></div>
	
	<section>
		<a class="projects-link-page" href="http://san-isidro.local/projects/">View all Projects</a>	
		<div class="about-project">
			<p><?php echo $project_description; ?></p>
		</div>
	</section>
<?php 	

	endwhile;

	else :
	echo '<p> No content found</p>';
	endif;
?>

</main>

<?php get_footer(); ?>