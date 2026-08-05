<?php

namespace Flynt\Components\BlockComparisonTable;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name' => 'blockComparisonTable',
        'label' => __('Block: Comparison Table', 'flynt'),
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
                'label' => __('Column 1 Label', 'flynt'),
                'instructions' => __('Dark blue header background.', 'flynt'),
                'name' => 'column1Label',
                'type' => 'text',
                'default_value' => 'Whole Home',
                'required' => 1,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Column 2 Label', 'flynt'),
                'instructions' => __('Black header background.', 'flynt'),
                'name' => 'column2Label',
                'type' => 'text',
                'default_value' => 'Partial',
                'required' => 1,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Rows', 'flynt'),
                'name' => 'rows',
                'type' => 'repeater',
                'min' => 1,
                'layout' => 'block',
                'button_label' => __('Add Row', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Column 1 Text', 'flynt'),
                        'name' => 'column1Text',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label' => __('Column 2 Text', 'flynt'),
                        'name' => 'column2Text',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '50'],
                    ],
                ],
            ],
            [
                'label' => __('Closing Text', 'flynt'),
                'instructions' => __('Optional content displayed below the table.', 'flynt'),
                'name' => 'closingHtml',
                'type' => 'wysiwyg',
                'delay' => 0,
                'media_upload' => 0,
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
                    FieldVariables\getSpacing(),
                ],
            ],
        ],
    ];
}
