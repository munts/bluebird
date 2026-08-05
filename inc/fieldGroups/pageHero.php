<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function (): void {
    $heroImageTextLayout = Components\HeroImageText\getACFLayout();
    $heroImageTextLayout['max'] = 1;

    $heroImageTextBelowLayout = Components\HeroImageTextBelow\getACFLayout();
    $heroImageTextBelowLayout['max'] = 1;

    ACFComposer::registerFieldGroup([
        'name' => 'pageHero',
        'title' => __('Hero Components', 'flynt'),
        'style' => 'seamless',
        'menu_order' => -2,
        'fields' => [
            [
                'name' => 'pageHero',
                'label' => __('Hero Components', 'flynt'),
                'instructions' => __('Displayed full width, anchored just below the header, above Page Components. Optional — leave empty for no hero on this page.', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'max' => 1,
                'layouts' => [
                    $heroImageTextLayout,
                    $heroImageTextBelowLayout,
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'default'
                ],
                [
                    'param' => 'page_type',
                    'operator' => '!=',
                    'value' => 'front_page'
                ],
            ],
        ],
    ]);
});
