<?php
/**
* Template Name: Single Page Project
*/
$post = new TimberPost();
$data = Timber::get_context();
$data['post'] = $post;
Timber::render('single-project.twig', $data);
