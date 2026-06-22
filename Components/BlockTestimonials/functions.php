<?php

namespace Flynt\Components\BlockTestimonials;

function getACFLayout(): array
{
    return [
        'name' => 'blockTestimonials',
        'label' => __('Block: Testimonials', 'flynt'),
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
                'default_value' => 'What Our Clients Say',
                'wrapper' => ['width' => '70'],
            ],
            [
                'label' => __('Testimonials', 'flynt'),
                'name' => 'testimonials',
                'type' => 'repeater',
                'layout' => 'block',
                'min' => 1,
                'max' => 6,
                'button_label' => __('Add Testimonial', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Avatar', 'flynt'),
                        'instructions' => __('Square or round headshot. Minimum 100×100px.', 'flynt'),
                        'name' => 'avatar',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'mime_types' => 'jpg,jpeg,png,webp',
                        'wrapper' => ['width' => '20'],
                    ],
                    [
                        'label' => __('Quote', 'flynt'),
                        'name' => 'quote',
                        'type' => 'textarea',
                        'rows' => 3,
                        'required' => 1,
                        'wrapper' => ['width' => '60'],
                    ],
                    [
                        'label' => __('Reviewer Name', 'flynt'),
                        'name' => 'reviewerName',
                        'type' => 'text',
                        'required' => 1,
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
                'label' => __('Reduce Spacing', 'flynt'),
                'name' => 'halfSpacing',
                'type' => 'true_false',
                'default_value' => 0,
                'ui' => 1,
            ],
        ],
    ];
}
