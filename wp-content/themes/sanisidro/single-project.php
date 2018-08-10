
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

	<section >
		<div class="page-hero">
			<img class="page-hero__image" src="<?php echo $image ?>" />
		</div>
		<div class="projects-link-page">
			<a  href="http://san-isidro.local/projects/">View all </a>

			<?php next_post_link('%link',' Previous'); ?>

			<?php previous_post_link('%link','Next'); ?>
		</div>
	</section>

	<section>
		<h2 class="title"><?php echo $title; ?></h2>

		<p class="copy"> <?php echo $project_description; ?></p>
	</section>

<?php

	endwhile;

	else :
	echo '<p> No content found</p>';
	endif;

?>

</main>

<?php get_footer(); ?>
