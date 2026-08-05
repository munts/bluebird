<?php

namespace Flynt\Components\HeroImageTextBelow;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name' => 'heroImageTextBelow',
        'label' => __('Hero: Image, Text Below', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Image', 'flynt'),
                'instructions' => __('Optional. Full width band above the content. Image-Format: JPG, PNG, WebP. Recommended resolution greater than 2560 × 720 px.', 'flynt'),
                'name' => 'image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp',
                'required' => 0,
            ],
            [
                'label' => __('Heading', 'flynt'),
                'name' => 'heading',
                'type' => 'text',
                'required' => 0,
            ],
            [
                'label' => __('Intro Text', 'flynt'),
                'instructions' => __('Optional content displayed below the heading and above the checklist.', 'flynt'),
                'name' => 'introHtml',
                'type' => 'wysiwyg',
                'delay' => 0,
                'media_upload' => 0,
                'required' => 0,
            ],
            [
                'label' => __('Checklist Items', 'flynt'),
                'name' => 'checklistItems',
                'type' => 'repeater',
                'min' => 0,
                'layout' => 'block',
                'button_label' => __('Add Item', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Text', 'flynt'),
                        'name' => 'text',
                        'type' => 'text',
                        'required' => 1,
                    ],
                ],
            ],
            [
                'label' => __('Body Text', 'flynt'),
                'instructions' => __('Optional content displayed below the checklist.', 'flynt'),
                'name' => 'contentHtml',
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
                        'instructions' => __('When Background Theme is Dark, all buttons display as Light Blue / White regardless of this setting.', 'flynt'),
                        'name' => 'style',
                        'type' => 'select',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'choices' => [
                            'navy'               => __('Navy — Navy bg, White text', 'flynt'),
                            'light-blue'         => __('Light Blue — Light blue bg, White text', 'flynt'),
                            'white-outline-blue' => __('White — White bg, Navy border & text', 'flynt'),
                        ],
                        'default_value' => 'navy',
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
                            'instructions' => __('Leave as (none) for a white background, or select Dark for a charcoal background with a yellow heading.', 'flynt'),
                        ]
                    ),
                    FieldVariables\getSpacing(),
                ],
            ],
        ],
    ];
}
