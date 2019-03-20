<?php
/**
* Template Name: Projects Page
*/

include('src/inc/constants.php');

$post = new TimberPost();
$data = Timber::get_context();
$data['post'] = $post;
$data['states'] = $states;
$data['cities'] = $cities;
$citieslist = array(
          'post_type' => 'project',
          'order' => 'DESC',
          'orderby' => 'city',
        );
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
$data['citieslist'] = Timber::get_posts($citieslist);
Timber::render('page-projects.twig', $data);
