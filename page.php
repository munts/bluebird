<?php

use Flynt\HeroFallbacks;
use Timber\Timber;

$context = Timber::context();

if (!$context['post']->thumbnail()) {
    $context['heroFallbackImage'] = HeroFallbacks\get($context['post']->post_name);
}

Timber::render('templates/page.twig', $context);
