<?php

namespace Flynt\Components\BlockCallToAction;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name' => 'blockCallToAction',
        'label' => __('Block: Call to Action', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Eyebrow Text', 'flynt'),
                'instructions' => __('Small red uppercase text displayed above the main heading, e.g. "Serving Eagle County & Surrounding Areas".', 'flynt'),
                'name' => 'eyebrow',
                'type' => 'text',
                'required' => 0,
            ],
            [
                'label' => __('Main Content / Heading', 'flynt'),
                'instructions' => __('Primary heading and/or body content. Use H2 for the main headline.', 'flynt'),
                'name' => 'contentHtml',
                'type' => 'wysiwyg',
                'delay' => 0,
                'media_upload' => 0,
                'required' => 0,
            ],
            [
                'label' => __('Subheading Text', 'flynt'),
                'instructions' => __('Optional descriptive text displayed below the main heading and above the buttons. Supports bold, italic, and links.', 'flynt'),
                'name' => 'subheading',
                'type' => 'wysiwyg',
                'delay' => 0,
                'media_upload' => 0,
                'required' => 0,
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
                        'instructions' => __('Supports full URLs (https://example.com), internal paths (/about), or protocol URLs (tel:1231231234).', 'flynt'),
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
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'choices' => [
                            'red'           => __('Red — Red bg, White text', 'flynt'),
                            'white'         => __('White — White bg, Red text', 'flynt'),
                            'outline-red'   => __('Outlined Red — Red border & text', 'flynt'),
                            'outline-white' => __('Outlined White — White border & text', 'flynt'),
                            'outline-black' => __('Outlined Black — Black border & text', 'flynt'),
                        ],
                        'default_value' => 'red',
                        'wrapper' => ['width' => '22'],
                    ],
                    [
                        'label' => __('Open in New Tab', 'flynt'),
                        'instructions' => __('Enable for external or third-party links (e.g. booking engines).', 'flynt'),
                        'name' => 'newWindow',
                        'type' => 'true_false',
                        'default_value' => 0,
                        'ui' => 1,
                        'wrapper' => ['width' => '10'],
                    ],
                ],
            ],
            [
                'label' => __('Background Image', 'flynt'),
                'instructions' => __('Optional. Fills the component background. Tip: also set Background Theme to "Dark" so text stays white and readable over the image.', 'flynt'),
                'name' => 'backgroundImage',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp',
                'required' => 0,
            ],
            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    array_merge(
                        FieldVariables\getTheme(),
                        [
                            'label' => __('Background Theme', 'flynt'),
                            'instructions' => __('Leave as (none) for a white background, or select Dark for a black background. When using a background image, Dark is recommended.', 'flynt'),
                        ]
                    ),
                    [
                        'label' => __('Image Overlay Color', 'flynt'),
                        'instructions' => __('Adds a semi-transparent color layer over the background image to improve text readability. Has no effect without a background image.', 'flynt'),
                        'name' => 'overlayColor',
                        'type' => 'select',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'choices' => [
                            'none'  => __('None', 'flynt'),
                            'red'   => __('Red', 'flynt'),
                            'black' => __('Black', 'flynt'),
                        ],
                        'default_value' => 'none',
                    ],
                    [
                        'label' => __('Overlay Opacity', 'flynt'),
                        'instructions' => __('Strength of the overlay. Only applies when an overlay color is selected above.', 'flynt'),
                        'name' => 'overlayOpacity',
                        'type' => 'range',
                        'min' => 10,
                        'max' => 90,
                        'step' => 5,
                        'default_value' => 50,
                        'append' => '%',
                    ],
                    FieldVariables\getSize('medium'),
                    [
                        'label' => __('Reduce Spacing', 'flynt'),
                        'instructions' => __('Use half the normal top and bottom spacing for this component.', 'flynt'),
                        'name' => 'halfSpacing',
                        'type' => 'true_false',
                        'default_value' => 0,
                        'ui' => 1,
                    ],
                ],
            ],
        ],
    ];
}
