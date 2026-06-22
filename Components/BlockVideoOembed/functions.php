<?php

namespace Flynt\Components\BlockVideoOembed;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=BlockVideoOembed', function ($data) {
    if (!empty($data['iframeCode'])) {
        // Strip attributes that would override CSS sizing
        $data['iframeCode'] = preg_replace('/\s*(style|width|height|data-ready)="[^"]*"/', '', $data['iframeCode']);
    }

    return $data;
});

function getACFLayout()
{
    return [
        'name' => 'blockVideoOembed',
        'label' =>  __('Block: Video Oembed', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => __('Eyebrow Text', 'flynt'),
                'name' => 'eyebrowText',
                'type' => 'text',
                'wrapper' => ['width' => '33'],
            ],
            [
                'label' => __('Heading', 'flynt'),
                'name' => 'headingText',
                'type' => 'text',
                'wrapper' => ['width' => '33'],
            ],
            [
                'label' => __('Subtitle', 'flynt'),
                'name' => 'subtitleText',
                'type' => 'text',
                'wrapper' => ['width' => '33'],
            ],
            [
                'label' => __('Primary Button Label', 'flynt'),
                'name' => 'ctaPrimaryLabel',
                'type' => 'text',
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Primary Button URL', 'flynt'),
                'name' => 'ctaPrimaryUrl',
                'type' => 'text',
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Secondary Button Label', 'flynt'),
                'name' => 'ctaSecondaryLabel',
                'type' => 'text',
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Secondary Button URL', 'flynt'),
                'name' => 'ctaSecondaryUrl',
                'type' => 'text',
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Poster Image (Desktop)', 'flynt'),
                'instructions' => __('Image-Format: JPG, PNG, WebP. Aspect Ratio: 16:9. Recommended Size: 1920px × 1080px.', 'flynt'),
                'name' => 'posterImage',
                'type' => 'image',
                'preview_size' => 'thumbnail',
                'mime_types' => 'jpg,jpeg,png,webp',
                'required' => 1,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Poster Image (Mobile)', 'flynt'),
                'instructions' => __('Image-Format: JPG, PNG, WebP. Aspect Ratio: 9:16 or square. Recommended Size: 768px × 1024px.', 'flynt'),
                'name' => 'posterImageMobile',
                'type' => 'image',
                'preview_size' => 'thumbnail',
                'mime_types' => 'jpg,jpeg,png,webp',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Video Source', 'flynt'),
                'instructions' => __('Direct: paste an MP4 file URL. Embed: paste a full iframe from Vimeo or YouTube.', 'flynt'),
                'name' => 'videoType',
                'type' => 'select',
                'choices' => [
                    'direct' => 'Direct MP4 File',
                    'iframe' => 'Embed Code (Vimeo / YouTube)',
                ],
                'default_value' => 'direct',
                'wrapper' => ['width' => '33'],
            ],
            [
                'label' => __('Video URL (Desktop)', 'flynt'),
                'name' => 'oembed',
                'type' => 'url',
                'required' => 0,
                'wrapper' => ['width' => '33'],
            ],
            [
                'label' => __('Video URL (Mobile)', 'flynt'),
                'instructions' => __('Optional. Falls back to desktop URL if blank.', 'flynt'),
                'name' => 'oembedMobile',
                'type' => 'url',
                'required' => 0,
                'wrapper' => ['width' => '34'],
            ],
            [
                'label' => __('Embed Code', 'flynt'),
                'instructions' => __('Paste the full iframe embed code. Any inline style attribute will be stripped automatically — sizing is handled by CSS.', 'flynt'),
                'name' => 'iframeCode',
                'type' => 'textarea',
                'rows' => 3,
                'wrapper' => ['width' => '100'],
            ],
            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    FieldVariables\getTheme(),
                    FieldVariables\getSize()
                ]
            ]
        ]
    ];
}
