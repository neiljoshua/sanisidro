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

	// check if the repeater field has rows of data
	if( have_rows('news_content') ):

	 	// loop through the rows of data
	    while ( have_rows('news_content') ) : the_row();
	  		// vars
				$image = get_sub_field('news_image');
				$title = get_sub_field('news_title');
				?>
				<div class="image-news" style="background-image: url(<?php the_sub_field('news_image') ?>)">
						
						<a href="<?php the_permalink() ?>" class="center">
						<?php echo $title; ?>
						</a>
				</div>
	     
			<?php 	
	    endwhile;

	else :

	    // no rows found

	endif;

	?>
	</section>
	
</main>	

<?php

get_footer(); 