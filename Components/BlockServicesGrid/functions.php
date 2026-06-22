<?php

namespace Flynt\Components\BlockServicesGrid;

use Flynt\FieldVariables;
use Timber\Timber;

add_filter('Flynt/addComponentData?name=BlockServicesGrid', function (array $data): array {
    $posts = Timber::get_posts([
        'post_status'    => 'publish',
        'post_type'      => 'service',
        'posts_per_page' => 8,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    $data['services'] = [];
    $schemaItems      = [];

    if ($posts) {
        foreach ($posts->to_array() as $post) {
            $iconImageRaw = get_field('serviceIconImage', $post->ID);
            $oneLiner     = get_field('serviceOneLiner', $post->ID) ?: '';
            $bulletRows   = get_field('serviceBullets', $post->ID) ?: [];
            $bullets      = array_filter(array_column($bulletRows, 'bulletText'));

            $data['services'][] = [
                'title'     => $post->post_title,
                'link'      => get_permalink($post->ID),
                'iconClass' => get_field('serviceIconClass', $post->ID),
                'iconImage' => $iconImageRaw ? [
                    'src'    => $iconImageRaw['url'],
                    'alt'    => $iconImageRaw['alt'],
                    'width'  => $iconImageRaw['width'],
                    'height' => $iconImageRaw['height'],
                ] : null,
                'oneLiner'  => $oneLiner,
                'bullets'   => $bulletRows,
            ];

            // Build description for schema: one-liner + bullets for richer AI context.
            $description = $oneLiner;
            if (!empty($bullets)) {
                $description .= ($description ? ' ' : '') . implode('. ', array_map('sanitize_text_field', $bullets)) . '.';
            }

            $schemaItem = [
                '@type'       => 'Offer',
                'itemOffered' => [
                    '@type' => 'Service',
                    'name'  => $post->post_title,
                    'url'   => get_permalink($post->ID),
                ],
            ];

            if (!empty($description)) {
                $schemaItem['itemOffered']['description'] = wp_strip_all_tags($description);
            }

            $schemaItems[] = $schemaItem;
        }
    }

    if (!empty($schemaItems)) {
        $schema = [
            '@context'        => 'https://schema.org',
            '@type'           => 'OfferCatalog',
            'name'            => get_bloginfo('name') . ' Services',
            'itemListElement' => $schemaItems,
        ];

        $data['schemaJson'] = wp_json_encode(
            $schema,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );
    }

    return $data;
});

function getACFLayout(): array
{
    return [
        'name' => 'blockServicesGrid',
        'label' => __('Block: Services Grid', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Heading / Intro', 'flynt'),
                'instructions' => __('Optional content displayed above the services grid. Services are pulled automatically from the Services post type, ordered by menu order.', 'flynt'),
                'name' => 'preContentHtml',
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
                    array_merge(
                        FieldVariables\getTheme(),
                        [
                            'label' => __('Background Theme', 'flynt'),
                            'instructions' => __('None = white, Dark = black, SVG Pattern = gray with diagonal SVG background.', 'flynt'),
                            'choices' => [
                                ''    => __('(none)', 'flynt'),
                                'light' => __('Light', 'flynt'),
                                'dark' => __('Dark', 'flynt'),
                                'svg' => __('SVG Pattern (Gray)', 'flynt'),
                            ],
                        ]
                    ),
                    [
                        'label' => __('Icon Color', 'flynt'),
                        'instructions' => __('Applies to Font Awesome icons only. Uploaded icon images use their native color.', 'flynt'),
                        'name' => 'iconColor',
                        'type' => 'select',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'choices' => [
                            'red'   => __('Red', 'flynt'),
                            'black' => __('Black', 'flynt'),
                            'white' => __('White', 'flynt'),
                        ],
                        'default_value' => 'red',
                    ],
                ],
            ],
        ],
    ];
}
