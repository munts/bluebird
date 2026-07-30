<?php

namespace Flynt\Components\BlockProductStylesGrid;

function getACFLayout(): array
{
    return [
        'name' => 'blockProductStylesGrid',
        'label' => __('Block: Product Styles Grid', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Heading', 'flynt'),
                'instructions' => __('e.g. "Find the Perfect Window Style". Add one instance of this block per product line (Windows, Doors, Siding) to group them.', 'flynt'),
                'name' => 'heading',
                'type' => 'text',
                'required' => 0,
            ],
            [
                'label' => __('Intro Text', 'flynt'),
                'instructions' => __('Optional supporting copy displayed below the heading.', 'flynt'),
                'name' => 'intro',
                'type' => 'textarea',
                'rows' => 3,
                'required' => 0,
            ],
            [
                'label' => __('Items', 'flynt'),
                'instructions' => __('Drag to reorder — e.g. put your best sellers first.', 'flynt'),
                'name' => 'items',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Add Item', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Title', 'flynt'),
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label' => __('Page URL', 'flynt'),
                        'instructions' => __('Where this card links to — supports full URLs or internal paths (/windows/awning-window/).', 'flynt'),
                        'name' => 'url',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label' => __('Short Description', 'flynt'),
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                        'required' => 0,
                    ],
                    [
                        'label' => __('Image', 'flynt'),
                        'instructions' => __('Small preview image for the card. The linked page can use a larger, higher-resolution image of its own.', 'flynt'),
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'mime_types' => 'jpg,jpeg,png,webp,svg',
                        'required' => 0,
                    ],
                ],
            ],
        ],
    ];
}
