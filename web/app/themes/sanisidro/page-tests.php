<?php
/**
* Template Name: Test Page
*/

get_header();

$context = Timber::get_context();
$context['post'] = new TimberPost();
?>
<main>
<?php
  Timber::render('page-test-single.twig', $context);
?>
</main>

<?php get_footer();
