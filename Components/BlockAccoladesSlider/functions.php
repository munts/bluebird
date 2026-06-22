<?php

namespace Flynt\Components\BlockAccoladesSlider;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=BlockAccoladesSlider', function (array $data): array {
    $data['jsonData'] = [
        'options' => $data['options'] ?? []
    ];
    return $data;
});

function getACFLayout(): array
{
    return [
        'name' => 'blockAccoladesSlider',
        'label' => __('Block: Accolades Slider', 'flynt'),
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
                'instructions' => __('Optional. Displayed centered above the slider.', 'flynt'),
                'name' => 'heading',
                'type' => 'text',
                'required' => 0,
            ],
            [
                'label' => __('Accolades', 'flynt'),
                'name' => 'accolades',
                'type' => 'repeater',
                'layout' => 'table',
                'min' => 1,
                'button_label' => __('Add Accolade', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Image', 'flynt'),
                        'instructions' => __('Logo, badge, or magazine cover. PNG, JPG, GIF, WebP.', 'flynt'),
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'mime_types' => 'png,jpg,jpeg,gif,webp',
                        'required' => 1,
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label' => __('Link URL', 'flynt'),
                        'instructions' => __('Optional. Links the image to a publication or article.', 'flynt'),
                        'name' => 'url',
                        'type' => 'url',
                        'required' => 0,
                        'wrapper' => ['width' => '50'],
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
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    FieldVariables\getTheme(),
                    [
                        'label' => __('Enable Autoplay', 'flynt'),
                        'name' => 'autoplay',
                        'type' => 'true_false',
                        'default_value' => 0,
                        'ui' => 1,
                        'wrapper' => ['width' => '25'],
                    ],
                    [
                        'label' => __('Autoplay Speed (ms)', 'flynt'),
                        'name' => 'autoplaySpeed',
                        'type' => 'number',
                        'min' => 1000,
                        'step' => 500,
                        'default_value' => 3000,
                        'wrapper' => ['width' => '25'],
                    ],
                ],
            ],
        ],
    ];
}
