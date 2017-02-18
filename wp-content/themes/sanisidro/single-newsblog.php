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
		
	if(have_posts('newsblogs')) :
	while(have_posts('newsblogs')) : the_post();
	$title = get_the_title();
	$image = get_field('image_news_blog');
	$news_content = get_field('news_blog_content');
?>

	
	<section >
		<div class="page-hero">
			<img class="hero-page-image" src="<?php echo $image ?>" />
		</div>
		<div class="projects-link-page">
			<?php next_post_link('%link',' Previous'); ?>
			
			<a  href="http://san-isidro.local/news/">View all</a>

			<?php previous_post_link('%link','Next'); ?>
		</div>	
	</section>

	<section>

		<div class="featured_title"><p><?php echo $title; ?></p></div>

		<div class="about-project">
			<?php echo $news_content; ?>
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