<?php
/**
* Template Name: Home Page
*/

$post = new TimberPost();
$data = Timber::get_context();
$data['post'] = $post;
$args = array(
          'post_type' => 'project',
          'posts_per_page' => 8,
          'order' => 'DESC',
          'orderby' => 'post_date',
          'meta_query' => array(
            array(
              'key' => 'project_featured',
              'value' => '1',
              'compare' => '=='
            )
          )
        );
$data['projects'] = Timber::get_posts($args);
Timber::render('page-home.twig', $data);
