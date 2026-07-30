<?php

use ACFComposer\ACFComposer;

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'pageContentMode',
        'title' => __('Page Content Mode', 'flynt'),
        'style' => 'seamless',
        'menu_order' => -3,
        'fields' => [
            [
                'label' => __('Build with Page Components', 'flynt'),
                'instructions' => __('Off (default): use the Classic Editor content and Featured Image below as the page body/hero — best for existing pages. On: build this page from scratch using Hero Components / Page Components below instead. Full Width Components and the sidebar promo are available either way.', 'flynt'),
                'name' => 'useComponents',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
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
