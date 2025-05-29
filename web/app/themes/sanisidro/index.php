<?php
  $post= Timber::context();
  $post['post'] = new Timber\Post();
  Timber::render('index.twig', $post);
  {{ dump() }}
