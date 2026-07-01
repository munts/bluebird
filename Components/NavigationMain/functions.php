<?php

namespace Flynt\Components\NavigationMain;

use Flynt\Utils\Asset;
use Flynt\Utils\Options;
use Timber\Timber;

add_action('init', function (): void {
    register_nav_menus([
        'navigation_main' => __('Navigation Main', 'flynt')
    ]);
});

add_filter('Flynt/addComponentData?name=NavigationMain', function (array $data): array {
    $data['menu'] = Timber::get_menu('navigation_main') ?? Timber::get_pages_menu();
    $data['logo'] = [
        'src' => get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : Asset::requireUrl('assets/images/logo.svg'),
        'alt' => get_bloginfo('name')
    ];

    $data['productNav'] = Options::getTranslatable('NavigationMain')['productNav'] ?? [];

    return $data;
});

Options::addTranslatable('NavigationMain', [
    [
        'label' => __('Labels', 'flynt'),
        'name' => 'labelsTab',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0
    ],
    [
        'label' => '',
        'name' => 'labels',
        'type' => 'group',
        'sub_fields' => [
            [
                'label' => __('Aria Label', 'flynt'),
                'name' => 'ariaLabel',
                'type' => 'text',
                'default_value' => __('Main Navigation', 'flynt'),
                'required' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
            ],
        ],
    ],
    [
        'label' => __('Utility Bar', 'flynt'),
        'name' => 'utilityBarTab',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0
    ],
    [
        'label' => '',
        'name' => 'utilityBar',
        'type' => 'group',
        'layout' => 'row',
        'sub_fields' => [
            [
                'label' => __('Phone', 'flynt'),
                'name' => 'phone',
                'type' => 'text',
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Email', 'flynt'),
                'name' => 'email',
                'type' => 'email',
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Free Estimate Button Label', 'flynt'),
                'name' => 'ctaFreeEstimateLabel',
                'type' => 'text',
                'default_value' => __('Free Estimate', 'flynt'),
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Free Estimate Form ID', 'flynt'),
                'instructions' => __('Gravity Form ID to load in the modal.', 'flynt'),
                'name' => 'freeEstimateFormId',
                'type' => 'number',
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Emergency Phone Number', 'flynt'),
                'instructions' => __('Phone number for the 24/7 emergency hotline. Displays as "24/7 Emergency Services" in the utility bar.', 'flynt'),
                'name' => 'ctaEmergency',
                'type' => 'text',
                'wrapper' => ['width' => '25'],
            ],
        ],
    ],
    [
        'label' => __('Product Nav', 'flynt'),
        'name' => 'productNavTab',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0
    ],
    [
        'label' => __('Product Nav Items', 'flynt'),
        'instructions' => __('Service category links displayed in the dark bar below the main navigation.', 'flynt'),
        'name' => 'productNav',
        'type' => 'repeater',
        'layout' => 'table',
        'button_label' => __('Add Item', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Label', 'flynt'),
                'name' => 'label',
                'type' => 'text',
                'wrapper' => ['width' => '34'],
            ],
            [
                'label' => __('Page', 'flynt'),
                'instructions' => __('Select the page this item links to.', 'flynt'),
                'name' => 'url',
                'type' => 'page_link',
                'wrapper' => ['width' => '33'],
            ],
            [
                'label' => __('Icon', 'flynt'),
                'instructions' => __('Upload a PNG icon (recommended: 64×64px, transparent background)', 'flynt'),
                'name' => 'icon',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'mime_types' => 'png',
                'wrapper' => ['width' => '33'],
            ],
        ],
    ],
]);
