<?php

namespace Flynt\Components\BlockImageText;

add_filter('Flynt/addComponentData?name=BlockImageText', function (array $data): array {
    if (!empty($data['vimeoUrl'])) {
        preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $data['vimeoUrl'], $matches);
        $videoId = $matches[1] ?? '';
        if ($videoId) {
            $data['vimeoEmbedUrl'] = "https://player.vimeo.com/video/{$videoId}?badge=0&autopause=0&player_id=0";
            wp_enqueue_script('vimeo-player', 'https://player.vimeo.com/api/player.js', [], null, true);
        }
    }
    return $data;
});

function getACFLayout(): array
{
    return [
        'name' => 'blockImageText',
        'label' => __('Block: Image Text', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Image Position', 'flynt'),
                'name' => 'imagePosition',
                'type' => 'button_group',
                'choices' => [
                    'left' => sprintf('<i class=\'dashicons dashicons-align-left\' title=\'%1$s\'></i>', __('Image on the left', 'flynt')),
                    'right' => sprintf('<i class=\'dashicons dashicons-align-right\' title=\'%1$s\'></i>', __('Image on the right', 'flynt'))
                ]
            ],
            [
                'label' => __('Media Type', 'flynt'),
                'name' => 'mediaType',
                'type' => 'select',
                'choices' => [
                    'image' => __('Image', 'flynt'),
                    'video' => __('Video (Vimeo)', 'flynt'),
                ],
                'default_value' => 'image',
                'wrapper' => ['width' => '25'],
            ],
            [
                'label' => __('Image', 'flynt'),
                'instructions' => __('Used when Media Type is set to Image. JPG, PNG, SVG, WebP.', 'flynt'),
                'name' => 'image',
                'type' => 'image',
                'preview_size' => 'thumbnail',
                'required' => 0,
                'mime_types' => 'jpg,jpeg,png,svg,webp',
                'wrapper' => ['width' => '75'],
            ],
            [
                'label' => __('Vimeo URL', 'flynt'),
                'instructions' => __('Used when Media Type is set to Video. Paste the Vimeo page URL, e.g. https://vimeo.com/975038266', 'flynt'),
                'name' => 'vimeoUrl',
                'type' => 'url',
                'required' => 0,
                'wrapper' => ['width' => '100'],
            ],
            [
                'label' => __('Button Label', 'flynt'),
                'instructions' => __('Optional. Displayed below the image or video. Leave blank to hide the button.', 'flynt'),
                'name' => 'mediaBtnLabel',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Button URL', 'flynt'),
                'name' => 'mediaBtnUrl',
                'type' => 'url',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
            [
                'label' => __('Text', 'flynt'),
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
                'endpoint' => 0
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    [
                        'label' => __('Theme', 'flynt'),
                        'name' => 'theme',
                        'type' => 'select',
                        'allow_null' => 0,
                        'choices' => [
                            ''      => __('(none)', 'flynt'),
                            'light' => __('Light', 'flynt'),
                            'dark'  => __('Dark', 'flynt'),
                            'black' => __('Black', 'flynt'),
                        ],
                        'default_value' => '',
                    ],
                    [
                        'label' => __('Image Size', 'flynt'),
                        'instructions' => __('Controls the maximum width of the image.', 'flynt'),
                        'name' => 'imageSize',
                        'type' => 'select',
                        'choices' => [
                            'full'   => 'Full (no cap)',
                            'large'  => 'Large (500px)',
                            'medium' => 'Medium (380px)',
                            'small'  => 'Small (260px)',
                        ],
                        'default_value' => 'full',
                        'wrapper' => ['width' => '25'],
                    ],
                    [
                        'label' => __('Round Image Corners', 'flynt'),
                        'name' => 'roundedImage',
                        'type' => 'true_false',
                        'ui' => 1,
                        'default_value' => 0,
                        'wrapper' => ['width' => '25'],
                    ],
                ]
            ]
        ]
    ];
}
