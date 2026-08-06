<?php

use ACFComposer\ACFComposer;

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'homepageFooterCta',
        'title' => __('Homepage Footer CTA', 'flynt'),
        'style' => 'seamless',
        'menu_order' => -3,
        'fields' => [
            [
                'label' => __('Enable Footer CTA', 'flynt'),
                'instructions' => __('Off (default): homepage footer is just Navigation Footer, as today. On: adds the same Footer CTA band shown above the footer on other pages.', 'flynt'),
                'name' => 'homepageFooterCtaEnabled',
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
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page'
                ],
            ],
        ],
    ]);
});
