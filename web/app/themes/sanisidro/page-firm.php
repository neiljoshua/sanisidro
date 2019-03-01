<?php
/**
* Template Name: Firm Page
*/

$post = new TimberPost();
$data = Timber::get_context();
$data['post'] = $post;
Timber::render('page-firm.twig', $data);
