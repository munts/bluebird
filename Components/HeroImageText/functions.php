<?php

namespace Flynt\Components\HeroImageText;

add_filter('Flynt/addComponentData?name=HeroImageText', function (array $data): array {
    $showBreadcrumbs = $data['options']['showBreadcrumbs'] ?? false;

    $data['breadcrumbs'] = $showBreadcrumbs && function_exists('yoast_breadcrumb')
        ? yoast_breadcrumb('', '', false)
        : '';

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'heroImageText',
        'label' => __('Hero: Image Text', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => __('Images', 'flynt'),
                'type' => 'group',
                'name' => 'images',
                'layout' => 'table',
                'sub_fields' => [
                    [
                        'label' => __('Desktop Image', 'flynt'),
                        'instructions' => __('Image-Format: JPG, PNG, SVG, WebP. Aspect Ratio: 32:9. Recommended resolution greater than 2560 × 720 px.', 'flynt'),
                        'name' => 'imageDesktop',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'mime_types' => 'jpg,jpeg,png,svg,webp',
                        'required' => 1,
                    ],
                    [
                        'label' => __('Mobile Image', 'flynt'),
                        'instructions' => __('Image-Format: JPG, PNG, SVG, WebP. Aspect Ratio: 4:3. Recommended resolution greater than 1440 × 1080 px.', 'flynt'),
                        'name' => 'imageMobile',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'mime_types' => 'jpg,jpeg,png,svg,webp',
                        'required' => 1,
                    ]
                ]
            ],
            [
                'label' => __('Text', 'flynt'),
                'instructions' => __('The content overlaying the image. Character Recommendations: Title: 30-100, Content: 80-250.', 'flynt'),
                'name' => 'contentHtml',
                'type' => 'wysiwyg',
                'delay' => 0,
                'media_upload' => 0,
                'required' => 1,
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
                    [
                        'label'         => __('Show Breadcrumbs', 'flynt'),
                        'instructions'  => __('Displays the page breadcrumb trail below the heading. Requires Yoast SEO to be installed and breadcrumbs enabled under SEO → Settings → Breadcrumbs.', 'flynt'),
                        'name'          => 'showBreadcrumbs',
                        'type'          => 'true_false',
                        'ui'            => 1,
                        'default_value' => 0,
                    ],
                ],
            ],
        ]
    ];
}
