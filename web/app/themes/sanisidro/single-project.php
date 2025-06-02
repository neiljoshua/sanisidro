<?php
/**
* Template Name: Single Page Project
*/
$post = Timber::get_post();
$data = Timber::context();
$data['post'] = $post;
Timber::render('single-project.twig', $data);
