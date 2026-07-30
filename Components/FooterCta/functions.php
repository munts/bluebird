<?php

namespace Flynt\Components\FooterCta;

use Flynt\FieldVariables;
use Flynt\Utils\Options;

add_filter('Flynt/addComponentData?name=FooterCta', function (array $data): array {
    return array_merge($data, Options::getTranslatable('FooterCta'));
});

Options::addTranslatable('FooterCta', [
    [
        'label' => __('Eyebrow Text', 'flynt'),
        'instructions' => __('Small uppercase text above the main heading.', 'flynt'),
        'name' => 'eyebrow',
        'type' => 'text',
        'required' => 0,
    ],
    [
        'label' => __('Main Content / Heading', 'flynt'),
        'instructions' => __('Primary headline and body copy for the left column. Use H2 for the main headline.', 'flynt'),
        'name' => 'contentHtml',
        'type' => 'wysiwyg',
        'delay' => 0,
        'media_upload' => 0,
        'required' => 0,
    ],
    [
        'label' => __('Subheading Logo', 'flynt'),
        'instructions' => __('Optional. Displayed in its own column to the left of the text.', 'flynt'),
        'name' => 'subheadingLogo',
        'type' => 'image',
        'return_format' => 'array',
        'preview_size' => 'thumbnail',
        'library' => 'all',
        'mime_types' => 'svg,png,jpg,jpeg,webp',
        'required' => 0,
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Subheading / Promo Text', 'flynt'),
        'instructions' => __('Optional. Displayed below the main content.', 'flynt'),
        'name' => 'subheading',
        'type' => 'wysiwyg',
        'delay' => 0,
        'media_upload' => 0,
        'required' => 0,
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Buttons', 'flynt'),
        'name' => 'buttons',
        'type' => 'repeater',
        'min' => 0,
        'max' => 3,
        'layout' => 'block',
        'button_label' => __('Add Button', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Label', 'flynt'),
                'name' => 'label',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '34'],
            ],
            [
                'label' => __('URL', 'flynt'),
                'instructions' => __('Supports full URLs, internal paths (/about), or tel: links.', 'flynt'),
                'name' => 'url',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '34'],
            ],
            [
                'label' => __('Button Style', 'flynt'),
                'name' => 'style',
                'type' => 'select',
                'allow_null' => 0,
                'choices' => [
                    'navy'          => __('Navy — Navy bg, White text', 'flynt'),
                    'white'         => __('White — White bg, Navy text', 'flynt'),
                    'outline-white' => __('Outlined White — White border & text', 'flynt'),
                    'outline-navy'  => __('Outlined Navy — Navy border & text', 'flynt'),
                    'outline-teal'  => __('Outlined Teal — Teal border, White text, 1px', 'flynt'),
                ],
                'default_value' => 'navy',
                'wrapper' => ['width' => '22'],
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
        'label' => __('Promo Content', 'flynt'),
        'instructions' => __('Optional. Displayed below the buttons — use for limited-time offers, fine print, or secondary messaging.', 'flynt'),
        'name' => 'promoHtml',
        'type' => 'wysiwyg',
        'delay' => 0,
        'media_upload' => 0,
        'required' => 0,
    ],
    [
        'label' => __('Background Image', 'flynt'),
        'instructions' => __('Fills the full component background. Use with Dark overlay for readability.', 'flynt'),
        'name' => 'backgroundImage',
        'type' => 'image',
        'return_format' => 'array',
        'preview_size' => 'thumbnail',
        'mime_types' => 'jpg,jpeg,png,webp',
        'required' => 0,
    ],
    [
        'label' => __('Form Heading', 'flynt'),
        'instructions' => __('Optional. Displayed above the form in the right column.', 'flynt'),
        'name' => 'formTitle',
        'type' => 'text',
        'required' => 0,
    ],
    [
        'label' => __('Form Shortcode', 'flynt'),
        'instructions' => __('Paste your Gravity Form shortcode, e.g. [gravityforms id="1" title="false" ajax="true"]', 'flynt'),
        'name' => 'formShortcode',
        'type' => 'text',
        'required' => 0,
    ],
    [
        'label' => __('Options', 'flynt'),
        'name' => 'options',
        'type' => 'group',
        'layout' => 'row',
        'sub_fields' => [
            array_merge(
                FieldVariables\getTheme('dark'),
                [
                    'label' => __('Background Theme', 'flynt'),
                    'instructions' => __('Dark recommended when using a background image.', 'flynt'),
                ]
            ),
            [
                'label' => __('Image Overlay Color', 'flynt'),
                'instructions' => __('Semi-transparent layer over the background image to improve readability.', 'flynt'),
                'name' => 'overlayColor',
                'type' => 'select',
                'allow_null' => 0,
                'choices' => [
                    'none'  => __('None', 'flynt'),
                    'navy'  => __('Navy', 'flynt'),
                    'black' => __('Black', 'flynt'),
                ],
                'default_value' => 'black',
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Overlay Opacity', 'flynt'),
                'instructions' => __('Strength of the overlay (10–90%).', 'flynt'),
                'name' => 'overlayOpacity',
                'type' => 'range',
                'min' => 10,
                'max' => 90,
                'step' => 5,
                'default_value' => 60,
                'append' => '%',
                'wrapper' => ['width' => '50'],
            ],
        ],
    ],
]);
