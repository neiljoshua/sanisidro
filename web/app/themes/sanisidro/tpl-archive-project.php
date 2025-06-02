<?php

/**
 * Template Name: Project Archive
 */

include('src/inc/constants.php');

$post = Timber::get_post();
$data = Timber::context();
$data['post'] = $post;

$args = array(
          'post_type' => 'project',
          // 'posts_per_page' => 8,
          'order' => 'DESC',
          'orderby' => 'post_date',
        );
$data['projects'] = Timber::get_posts($args);

Timber::render('tpl-archive-project.twig', $data);

