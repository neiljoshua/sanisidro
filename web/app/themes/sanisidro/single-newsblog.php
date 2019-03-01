<?php
/**
* Template Name: Single Page Newsblog
*/
$post = new TimberPost();
$data = Timber::get_context();
$args = array(
          'post_type' => 'project',
          'order' => 'DESC',
          'orderby' => 'post_date',
        );
$data['post'] = $post;
Timber::render('single-newsblog.twig', $data);


