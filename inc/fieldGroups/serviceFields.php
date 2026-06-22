<?php

use ACFComposer\ACFComposer;

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'serviceFields',
        'title' => __('Service Details', 'flynt'),
        'fields' => [
            [
                'label' => __('Font Awesome Icon Class', 'flynt'),
                'instructions' => __('e.g. fa-solid fa-wrench — takes priority over an uploaded image if both are set.', 'flynt'),
                'name' => 'serviceIconClass',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Icon Image', 'flynt'),
                'instructions' => __('Upload an SVG or PNG icon. Only used if no Font Awesome class is entered above. Uploaded images use their native color.', 'flynt'),
                'name' => 'serviceIconImage',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'mime_types' => 'svg,png,jpg,jpeg,webp',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('One-Line Description', 'flynt'),
                'instructions' => __('Brief supporting text displayed below the service name in the Services Grid block, e.g. "Reliable solutions for every leak, clog, and installation"', 'flynt'),
                'name' => 'serviceOneLiner',
                'type' => 'text',
                'required' => 0,
            ],
            [
                'label' => __('Bullet Points', 'flynt'),
                'instructions' => __('Optional list items displayed below the description on the service card.', 'flynt'),
                'name' => 'serviceBullets',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => __('Add Item', 'flynt'),
                'min' => 0,
                'sub_fields' => [
                    [
                        'label' => __('Item', 'flynt'),
                        'name' => 'bulletText',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => ['width' => '100'],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'service',
                ],
            ],
        ],
    ]);
});
