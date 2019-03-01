<?php

/**
 * Template Name: Project Archive
 */


// include('src/inc/constants.php');

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

   <section>

     <h2 class="title">Projects</h2>

     <?php

      $args = array(
        'post_type' => 'project',
        'posts_per_page' => 50,
        'order' => 'DESC',
        'orderby' => 'post_date'
      );

      $posts = get_posts( $args );
      wp_reset_postdata();
      ?>

     <?php include("partials/featured-blocks.php") ?>

   </section>

</main>

<?php

get_footer();

?>
