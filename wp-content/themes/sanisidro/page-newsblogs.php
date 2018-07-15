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
					<div class="news-block">
						<img class="lazy news-block__image" data-original="<?php the_field('image_news_blog'); ?>" alt="<?php echo $title; ?>">
						<a class="news-block__link" href="<?php the_permalink() ?>">
							<div class="news-copy center" >
								<p class="news-copy__caption"><?php echo $title; ?></p>
								<p class="news-copy__line"></p>
							</div>
						</a>
						<!-- <a href="<?php //the_permalink() ?>"> Read </a> -->
					</div>

	<?php endforeach; ?>

	<?php wp_reset_postdata();?>

	</section>

</main>

<?php

get_footer();
