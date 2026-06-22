<?php

namespace Flynt\Components\GridStaff;

use Flynt\FieldVariables;
use Timber\Timber;

add_filter('Flynt/addComponentData?name=GridStaff', function (array $data): array {
    $postsPerPage = $data['options']['maxPosts'] ?? 6;

    $posts = Timber::get_posts([
        'post_status'    => 'publish',
        'post_type'      => 'staff',
        'posts_per_page' => $postsPerPage,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    $data['posts'] = $posts ? $posts->to_array() : [];

    return $data;
});

function getACFLayout(): array
{
    return [
        'name' => 'gridStaff',
        'label' => __('Grid: Staff', 'flynt'),
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
                'instructions' => __('Optional content displayed above the staff grid.', 'flynt'),
                'name' => 'preContentHtml',
                'type' => 'wysiwyg',
                'tabs' => 'visual,text',
                'media_upload' => 0,
                'delay' => 0,
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
                        'label' => __('Max Staff Members', 'flynt'),
                        'name' => 'maxPosts',
                        'type' => 'number',
                        'default_value' => 6,
                        'min' => 1,
                        'step' => 1,
                    ],
                ],
            ],
        ],
    ];
}
