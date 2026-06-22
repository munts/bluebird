<?php

namespace Flynt\Components\NavigationFooter;

use Flynt\Utils\Options;
use Timber\Timber;

add_action('init', function (): void {
    register_nav_menus([
        'navigation_footer' => __('Navigation Footer', 'flynt')
    ]);
});

add_filter('Flynt/addComponentData?name=NavigationFooter', function (array $data): array {
    $data['menu'] = Timber::get_menu('navigation_footer') ?? Timber::get_pages_menu();

    return $data;
});

Options::addTranslatable('NavigationFooter', [
    [
        'label'     => __('Brand', 'flynt'),
        'name'      => 'brandTab',
        'type'      => 'tab',
        'placement' => 'top',
        'endpoint'  => 0,
    ],
    [
        'label'         => __('Logo', 'flynt'),
        'name'          => 'logo',
        'type'          => 'image',
        'return_format' => 'array',
        'preview_size'  => 'thumbnail',
        'mime_types'    => 'jpg,jpeg,png,svg,webp',
        'wrapper'       => ['width' => '50'],
    ],
    [
        'label'     => __('Contact', 'flynt'),
        'name'      => 'contactTab',
        'type'      => 'tab',
        'placement' => 'top',
        'endpoint'  => 0,
    ],
    [
        'label'   => __('Phone Number', 'flynt'),
        'name'    => 'phone',
        'type'    => 'text',
        'wrapper' => ['width' => '50'],
    ],
    [
        'label'        => __('Social Links', 'flynt'),
        'name'         => 'socialLinks',
        'type'         => 'repeater',
        'layout'       => 'table',
        'button_label' => __('Add Social Link', 'flynt'),
        'sub_fields'   => [
            [
                'label'        => __('Icon', 'flynt'),
                'instructions' => __('Font Awesome class, e.g. "fa-brands fa-instagram"', 'flynt'),
                'name'         => 'icon',
                'type'         => 'text',
                'required'     => 1,
                'wrapper'      => ['width' => '40'],
            ],
            [
                'label'    => __('URL', 'flynt'),
                'name'     => 'url',
                'type'     => 'url',
                'required' => 1,
                'wrapper'  => ['width' => '40'],
            ],
            [
                'label'   => __('Aria Label', 'flynt'),
                'instructions' => __('e.g. "Follow us on Instagram"', 'flynt'),
                'name'    => 'ariaLabel',
                'type'    => 'text',
                'wrapper' => ['width' => '20'],
            ],
        ],
    ],
    [
        'label'     => __('Bottom Bar', 'flynt'),
        'name'      => 'bottomTab',
        'type'      => 'tab',
        'placement' => 'top',
        'endpoint'  => 0,
    ],
    [
        'label'         => __('Privacy Policy Link', 'flynt'),
        'name'          => 'privacyPolicy',
        'type'          => 'link',
        'return_format' => 'array',
        'instructions'  => __('Label and URL for the privacy policy link. Supports relative URLs.', 'flynt'),
        'wrapper'       => ['width' => '50'],
    ],
    [
        'label'         => __('Copyright Text', 'flynt'),
        'name'          => 'copyrightText',
        'type'          => 'text',
        'instructions'  => __('e.g. "© 2026 BlueBird Windows & Doors. All Rights Reserved."', 'flynt'),
        'wrapper'       => ['width' => '50'],
    ],
    [
        'label'     => __('Labels', 'flynt'),
        'name'      => 'labelsTab',
        'type'      => 'tab',
        'placement' => 'top',
        'endpoint'  => 0,
    ],
    [
        'label'      => '',
        'name'       => 'labels',
        'type'       => 'group',
        'sub_fields' => [
            [
                'label'         => __('Nav Aria Label', 'flynt'),
                'name'          => 'ariaLabel',
                'type'          => 'text',
                'default_value' => __('Footer Navigation', 'flynt'),
                'required'      => 1,
                'wrapper'       => ['width' => '50'],
            ],
        ],
    ],
]);
