<?php

/**
 * Template Name: Secondary Page Alt
 * Template Post Type: page
 */

use Timber\Timber;

$context = Timber::context();

Timber::render('templates/page-secondary-alt.twig', $context);
