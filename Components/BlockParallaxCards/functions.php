<?php

namespace Flynt\Components\BlockParallaxCards;

function getACFLayout(): array
{
    return [
        'name' => 'blockParallaxCards',
        'label' => __('Block: Cards', 'flynt'),
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
                'instructions' => __('Small text displayed above the headline.', 'flynt'),
                'name' => 'eyebrowText',
                'type' => 'text',
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Headline', 'flynt'),
                'name' => 'headline',
                'type' => 'text',
                'required' => 1,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Cards', 'flynt'),
                'name' => 'cards',
                'type' => 'repeater',
                'layout' => 'block',
                'min' => 1,
                'max' => 3,
                'button_label' => __('Add Card', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Card Image', 'flynt'),
                        'instructions' => __('Displayed at the top of the card. JPG, PNG, WebP. Aspect ratio 16:9 recommended.', 'flynt'),
                        'name' => 'cardImage',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'mime_types' => 'jpg,jpeg,png,webp',
                        'required' => 1,
                        'wrapper' => ['width' => '40'],
                    ],
                    [
                        'label' => __('Card Title', 'flynt'),
                        'name' => 'cardTitle',
                        'type' => 'text',
                        'wrapper' => ['width' => '30'],
                    ],
                    [
                        'label' => __('Card Text', 'flynt'),
                        'name' => 'cardText',
                        'type' => 'textarea',
                        'rows' => 3,
                        'required' => 1,
                        'wrapper' => ['width' => '30'],
                    ],
                    [
                        'label' => __('Button Label', 'flynt'),
                        'instructions' => __('e.g. "Explore Windows". Defaults to "Learn More" if left blank.', 'flynt'),
                        'name' => 'cardBtnLabel',
                        'type' => 'text',
                        'wrapper' => ['width' => '35'],
                    ],
                    [
                        'label' => __('Button URL', 'flynt'),
                        'name' => 'cardUrl',
                        'type' => 'text',
                        'wrapper' => ['width' => '35'],
                    ],
                ],
            ],
            [
                'label' => __('CTA Button', 'flynt'),
                'name' => 'ctaLink',
                'type' => 'link',
                'return_format' => 'array',
            ],
        ],
    ];
}
