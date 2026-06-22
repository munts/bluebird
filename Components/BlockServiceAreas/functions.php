<?php

namespace Flynt\Components\BlockServiceAreas;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name' => 'blockServiceAreas',
        'label' => __('Block: Service Areas', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Icon', 'flynt'),
                'instructions' => __('Font Awesome 6 class, e.g. "fa-solid fa-location-dot"', 'flynt'),
                'name' => 'cardIcon',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Card Title', 'flynt'),
                'instructions' => __('e.g. "Areas We Serve"', 'flynt'),
                'name' => 'cardTitle',
                'type' => 'text',
                'required' => 1,
                'wrapper' => ['width' => '75'],
            ],
            [
                'label' => __('Areas', 'flynt'),
                'name' => 'areas',
                'type' => 'repeater',
                'min' => 1,
                'max' => 3,
                'layout' => 'block',
                'button_label' => __('Add Area', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Area Name', 'flynt'),
                        'instructions' => __('e.g. "Eagle County" or "Roaring Fork Valley"', 'flynt'),
                        'name' => 'areaName',
                        'type' => 'text',
                        'required' => 1,
                    ],
                    [
                        'label' => __('Cities / Towns', 'flynt'),
                        'instructions' => __('One city per line.', 'flynt'),
                        'name' => 'areaCities',
                        'type' => 'textarea',
                        'rows' => 6,
                        'new_lines' => '',
                        'required' => 1,
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
                            'instructions' => __('None = white card, Dark = dark gray card.', 'flynt'),
                            'wrapper' => ['width' => '50'],
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
                        'wrapper' => ['width' => '50'],
                    ],
                ],
            ],
        ],
    ];
}
