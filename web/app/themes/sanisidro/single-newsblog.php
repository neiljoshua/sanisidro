<?php
/**
* Template Name: Single Page Newsblog
*/
$post = Timber::get_post();
$data = Timber::context();
$args = array(
          'post_type' => 'project',
          'order' => 'DESC',
          'orderby' => 'post_date',
        );
$data['post'] = $post;
Timber::render('single-newsblog.twig', $data);


