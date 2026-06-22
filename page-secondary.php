<?php

/**
 * Template Name: Secondary Page
 * Template Post Type: page
 */

use Timber\Timber;

$context = Timber::context();

Timber::render('templates/page-secondary.twig', $context);
