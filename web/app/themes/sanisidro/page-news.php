<?php
/**
*Template Name: News Page
**/
$post = new TimberPost();
$data = Timber::get_context();
$data['post'] = $post;
$args = array(
          'post_type' => 'newsblog',
          'posts_per_page' => 10,
          'order' => 'DESC',
          'orderby' => 'post_date'
        );
$data['news'] = Timber::get_posts($args);
Timber::render('page-news.twig', $data);
