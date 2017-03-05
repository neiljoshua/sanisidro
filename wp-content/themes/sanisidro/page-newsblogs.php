<?php 
/**
*Template Name: News Page
**/

add_action('news_page_content', 'do_news_page_content');

add_filter('body_class', 'add_news_page_body_class');

function add_news_page_body_class($classes) {
	
	$classes[] = 'news-content';

	return $classes;

}

add_theme_support('sanisidro-structural-wraps', array( 'header' , 'footer' , 'nav',) );

get_header(); 
?>

<main>

<section>
	<?php 
		$args = array(
		  'post_type' => 'newsblog',
		  'posts_per_page' => 8,
		  'order' => 'DESC',
		  'orderby' => 'post_date',
		  'meta_query' => array(
		  )
		);

		$posts = get_posts( $args );
	?>

	<?php foreach( $posts as $post ): 
			    setup_postdata( $post );
					$title = get_the_title(); 
	?>
					<div class="image-news" style="background-image: url(<?php the_field('image_news_blog'); ?>)">
						<a href="<?php the_permalink() ?>">
							<span class="center"><?php echo $title; ?></span>
						</a>
					</div>
		           
	<?php endforeach; ?>

	<?php wp_reset_postdata();?>

	</section>
	
</main>	

<?php

get_footer(); 