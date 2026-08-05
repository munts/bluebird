<?php

namespace Flynt\Components\BlockFeatureCards;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name' => 'blockFeatureCards',
        'label' => __('Block: Feature Cards', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Heading', 'flynt'),
                'name' => 'heading',
                'type' => 'text',
                'required' => 0,
            ],
            [
                'label' => __('Description', 'flynt'),
                'instructions' => __('Optional short description displayed below the heading.', 'flynt'),
                'name' => 'description',
                'type' => 'textarea',
                'rows' => 3,
                'required' => 0,
            ],
            [
                'label' => __('Cards', 'flynt'),
                'name' => 'cards',
                'type' => 'repeater',
                'min' => 1,
                'layout' => 'block',
                'button_label' => __('Add Card', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Title', 'flynt'),
                        'name' => 'cardTitle',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '40'],
                    ],
                    [
                        'label' => __('Text', 'flynt'),
                        'instructions' => __('1-2 sentences.', 'flynt'),
                        'name' => 'cardText',
                        'type' => 'textarea',
                        'rows' => 2,
                        'required' => 1,
                        'wrapper' => ['width' => '60'],
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
                            'instructions' => __('None = white section, gray cards. Light = gray section, white cards. Dark = charcoal section, gray cards.', 'flynt'),
                        ]
                    ),
                    FieldVariables\getSpacing(),
                ],
            ],
        ],
    ];
}
