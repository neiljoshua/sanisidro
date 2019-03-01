<?php
/**
 * Template Name: Project Notfound
 */

add_action('projects_page_content', 'do_projects_page_content');

add_filter('body_class', 'add_projects_page_body_class');

function add_projects_page_body_class($classes) {

  $classes[] = 'projects';

  return $classes;

}

add_theme_support('sanisidro-structural-wraps', array( 'header' , 'footer' , 'nav',) );



get_header();

?>
  <main>
    <section>
      <div class="no-found">
        <div class="center">
          <img src="src/images/logo.png">
          <p> Properties not found</p>
        </div>
      </div>
    </section>
  </main>

<?php

get_footer();

?>
