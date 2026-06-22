<?php

namespace Flynt\Components\BlockServices;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name' => 'blockServices',
        'label' => __('Block: Services', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Heading / Intro', 'flynt'),
                'instructions' => __('Optional content displayed above the services grid.', 'flynt'),
                'name' => 'preContentHtml',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'delay' => 0,
                'media_upload' => 0,
            ],
            [
                'label' => __('Services', 'flynt'),
                'name' => 'services',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Add Service', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Icon', 'flynt'),
                        'instructions' => __('Font Awesome 6 class, e.g. "fa-solid fa-wrench" or "fa-solid fa-house"', 'flynt'),
                        'name' => 'serviceIcon',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '25'],
                    ],
                    [
                        'label' => __('Title', 'flynt'),
                        'name' => 'serviceTitle',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '75'],
                    ],
                    [
                        'label' => __('Description', 'flynt'),
                        'instructions' => __('Brief description. Add a link to the full service page.', 'flynt'),
                        'name' => 'serviceDescription',
                        'type' => 'wysiwyg',
                        'toolbar' => 'full',
                        'delay' => 0,
                        'media_upload' => 0,
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
                            'instructions' => __('None = white cards, Dark = dark gray cards, SVG Pattern = gray diagonal background.', 'flynt'),
                            'choices' => [
                                ''      => __('(none)', 'flynt'),
                                'light' => __('Light', 'flynt'),
                                'dark'  => __('Dark', 'flynt'),
                                'svg'   => __('SVG Pattern (Gray)', 'flynt'),
                            ],
                            'wrapper' => ['width' => '34'],
                        ]
                    ),
                    [
                        'label' => __('Icon Color', 'flynt'),
                        'name' => 'iconColor',
                        'type' => 'select',
                        'allow_null' => 0,
                        'choices' => [
                            'red'   => __('Red', 'flynt'),
                            'black' => __('Black', 'flynt'),
                            'white' => __('White', 'flynt'),
                        ],
                        'default_value' => 'red',
                        'wrapper' => ['width' => '33'],
                    ],
                    [
                        'label' => __('Rounded Card Corners', 'flynt'),
                        'name' => 'roundedCards',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 1,
                        'wrapper' => ['width' => '33'],
                    ],
                ],
            ],
        ],
    ];
}
