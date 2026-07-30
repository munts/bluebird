<?php

namespace Flynt\Components\NavigationMain;

use ACFComposer\ACFComposer;
use Flynt\Utils\Asset;
use Flynt\Utils\Options;
use Timber\Timber;

add_action('init', function (): void {
    register_nav_menus([
        'navigation_main' => __('Navigation Main', 'flynt'),
        'product_nav' => __('Product Navigation (Windows / Doors / Siding)', 'flynt'),
    ]);
});

add_filter('Flynt/addComponentData?name=NavigationMain', function (array $data): array {
    $data['menu'] = Timber::get_menu('navigation_main') ?? Timber::get_pages_menu();
    $data['logo'] = [
        'src' => get_theme_mod('custom_logo') ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full') : Asset::requireUrl('assets/images/logo.svg'),
        'alt' => get_bloginfo('name')
    ];

    $data['productNav'] = Timber::get_menu('product_nav');

    return $data;
});

// Icon fields directly on individual menu items (Appearance → Menus), so the
// same screen used to build the Product Navigation menu (structure, order,
// dropdown nesting) also sets its icons. Applies to items in ANY menu since
// ACF can't scope this to one specific menu ahead of a menu existing — only
// fill these in on the Product Navigation menu's top-level items (Windows,
// Doors, Siding); leave blank on dropdown children and on other menus.
add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'productNavMenuItemIcon',
        'title' => __('Product Nav Icon', 'flynt'),
        'fields' => [
            [
                'label' => __('Font Awesome Icon Class', 'flynt'),
                'instructions' => __('Product Navigation menu top-level items only (Windows, Doors, Siding). e.g. fa-solid fa-door-open — takes priority over an uploaded image. Leave blank to use an uploaded icon instead, or blank both for dropdown children.', 'flynt'),
                'name' => 'iconClass',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Icon Image', 'flynt'),
                'instructions' => __('Upload an SVG or PNG icon. Only used if no Font Awesome class is entered above.', 'flynt'),
                'name' => 'iconImage',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'mime_types' => 'svg,png',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'nav_menu_item',
                    'operator' => '==',
                    'value' => 'all',
                ],
            ],
        ],
    ]);
});

Options::addTranslatable('NavigationMain', [
    [
        'label' => __('Promo Bar', 'flynt'),
        'name' => 'promoBarTab',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0
    ],
    [
        'label' => '',
        'name' => 'promoBar',
        'type' => 'group',
        'layout' => 'row',
        'sub_fields' => [
            [
                'label' => __('Label', 'flynt'),
                'instructions' => __('e.g. "Now Hiring - Apply Now", "Latest Specials", "New Products". Leave blank (along with URL) to hide this bar entirely — it\'s meant to be used only when there\'s something to promote.', 'flynt'),
                'name' => 'label',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '34'],
            ],
            [
                'label' => __('URL', 'flynt'),
                'instructions' => __('Supports full URLs, internal paths (/specials/), or tel: links.', 'flynt'),
                'name' => 'url',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '33'],
            ],
            [
                'label' => __('Button Style', 'flynt'),
                'name' => 'style',
                'type' => 'select',
                'allow_null' => 0,
                'choices' => [
                    'navy'               => __('Navy — Navy bg, White text', 'flynt'),
                    'light-blue'         => __('Light Blue — Light blue bg, White text', 'flynt'),
                    'white-outline-blue' => __('White — White bg, Navy border & text', 'flynt'),
                ],
                'default_value' => 'navy',
                'wrapper' => ['width' => '23'],
            ],
            [
                'label' => __('New Tab', 'flynt'),
                'name' => 'newWindow',
                'type' => 'true_false',
                'default_value' => 0,
                'ui' => 1,
                'wrapper' => ['width' => '10'],
            ],
        ],
    ],
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
]);
