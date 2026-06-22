<?php

namespace Flynt\Components\BlockShortcode;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name' => 'blockShortcode',
        'label' => __('Block: Shortcode', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Text Above', 'flynt'),
                'instructions' => __('Optional content to display above the shortcode.', 'flynt'),
                'name' => 'contentAbove',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'delay' => 0,
                'media_upload' => 0,
            ],
            [
                'label' => __('Shortcode', 'flynt'),
                'instructions' => __('Paste your shortcode here, e.g. [trustindex-show-reviews-summary ...]', 'flynt'),
                'name' => 'shortcode',
                'type' => 'text',
                'required' => 1,
            ],
            [
                'label' => __('Text Below', 'flynt'),
                'instructions' => __('Optional content to display below the shortcode.', 'flynt'),
                'name' => 'contentBelow',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'delay' => 0,
                'media_upload' => 0,
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
                    FieldVariables\getTheme(),
                    FieldVariables\getSize(),
                    FieldVariables\getAlignment(),
                    FieldVariables\getTextAlignment(),
                    [
                        'label' => __('Background Color', 'flynt'),
                        'name' => 'backgroundColor',
                        'type' => 'radio',
                        'layout' => 'horizontal',
                        'choices' => [
                            'white' => __('White', 'flynt'),
                            'black' => __('Black', 'flynt'),
                        ],
                        'default_value' => 'white',
                    ],
                ],
            ],
        ],
    ];
}
