<?php

namespace Flynt\Components\BlockPromoCards;

function getACFLayout(): array
{
    return [
        'name' => 'blockPromoCards',
        'label' => __('Block: Promo Cards', 'flynt'),
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
                'name' => 'eyebrowText',
                'type' => 'text',
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Heading', 'flynt'),
                'name' => 'heading',
                'type' => 'text',
                'wrapper' => ['width' => '50'],
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
                'layout' => 'block',
                'min' => 1,
                'max' => 6,
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
                        'label' => __('Image', 'flynt'),
                        'instructions' => __('Use either an image or an icon below — not both.', 'flynt'),
                        'name' => 'cardImage',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'mime_types' => 'jpg,jpeg,png,webp',
                        'wrapper' => ['width' => '25'],
                    ],
                    [
                        'label' => __('Icon (Font Awesome)', 'flynt'),
                        'instructions' => __('e.g. fa-solid fa-wrench — ignored if an image is set above.', 'flynt'),
                        'name' => 'cardIcon',
                        'type' => 'text',
                        'wrapper' => ['width' => '25'],
                    ],
                    [
                        'label' => __('Description', 'flynt'),
                        'name' => 'cardText',
                        'type' => 'textarea',
                        'rows' => 3,
                        'required' => 1,
                        'wrapper' => ['width' => '30'],
                    ],
                    [
                        'label' => __('Link', 'flynt'),
                        'instructions' => __('Optional. Adds a "Learn More" link at the bottom of the card.', 'flynt'),
                        'name' => 'cardLink',
                        'type' => 'link',
                        'return_format' => 'array',
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
                'label' => __('Reduce Spacing', 'flynt'),
                'name' => 'halfSpacing',
                'type' => 'true_false',
                'default_value' => 0,
                'ui' => 1,
            ],
        ],
    ];
}
