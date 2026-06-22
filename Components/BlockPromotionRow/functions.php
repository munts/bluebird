<?php

namespace Flynt\Components\BlockPromotionRow;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name' => 'blockPromotionRow',
        'label' => __('Block: Promotion Row', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Promos', 'flynt'),
                'name' => 'promos',
                'type' => 'repeater',
                'min' => 1,
                'max' => 4,
                'layout' => 'block',
                'button_label' => __('Add Promo', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Heading', 'flynt'),
                        'instructions' => __('Bold primary text, e.g. "24/7 Emergency Services"', 'flynt'),
                        'name' => 'heading',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label' => __('Sub Text', 'flynt'),
                        'instructions' => __('Supporting text below the heading, e.g. "Always Available"', 'flynt'),
                        'name' => 'subtext',
                        'type' => 'text',
                        'required' => 0,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label' => __('Font Awesome Icon Class', 'flynt'),
                        'instructions' => __('e.g. fa-solid fa-clock — takes priority over an uploaded image. Leave blank to use an uploaded icon instead.', 'flynt'),
                        'name' => 'iconClass',
                        'type' => 'text',
                        'required' => 0,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label' => __('Icon Image', 'flynt'),
                        'instructions' => __('Upload an SVG or PNG icon. Only used if no Font Awesome class is entered above. Uploaded images use their native color.', 'flynt'),
                        'name' => 'iconImage',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'mime_types' => 'svg,png,jpg,jpeg,webp',
                        'required' => 0,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label' => __('URL', 'flynt'),
                        'instructions' => __('Optional. Supports full URLs (https://example.com), internal paths (/about), or tel:1231231234. Leave blank for no link.', 'flynt'),
                        'name' => 'url',
                        'type' => 'text',
                        'required' => 0,
                        'wrapper' => ['width' => '80'],
                    ],
                    [
                        'label' => __('Open in New Tab', 'flynt'),
                        'name' => 'newWindow',
                        'type' => 'true_false',
                        'default_value' => 0,
                        'ui' => 1,
                        'wrapper' => ['width' => '20'],
                    ],
                ],
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
                            'instructions' => __('Leave as (none) for a white background, or select Dark for a black background. Text color adapts automatically.', 'flynt'),
                        ]
                    ),
                    [
                        'label' => __('Icon Color', 'flynt'),
                        'instructions' => __('Applies to Font Awesome icons only. Uploaded icon images use their native color.', 'flynt'),
                        'name' => 'iconColor',
                        'type' => 'select',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'choices' => [
                            'blue'  => __('Blue', 'flynt'),
                            'black' => __('Black', 'flynt'),
                            'white' => __('White', 'flynt'),
                        ],
                        'default_value' => 'blue',
                    ],
                ],
            ],
        ],
    ];
}
