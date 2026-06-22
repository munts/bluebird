<?php

namespace Flynt\Components\BlockMapEmbed;

use Flynt\Utils\Options;

add_filter('Flynt/addComponentData?name=BlockMapEmbed', function (array $data): array {
    $data['apiKey'] = Options::getGlobal('GoogleMaps', 'apiKey') ?? '';

    $locations = [];
    foreach ($data['locations'] ?? [] as $row) {
        $map = $row['location'] ?? [];
        if (!empty($map['lat']) && !empty($map['lng'])) {
            $locations[] = [
                'lat'   => (float) $map['lat'],
                'lng'   => (float) $map['lng'],
                'title' => $row['markerTitle'] ?? '',
                'info'  => $row['markerInfo'] ?? '',
            ];
        }
    }
    $data['locationsJson'] = wp_json_encode($locations);

    return $data;
});


function getACFLayout(): array
{
    return [
        'name'       => 'BlockMapEmbed',
        'label'      => 'Block: Map Embed',
        'sub_fields' => [
            [
                'label'        => __('Content', 'flynt'),
                'name'         => 'contentHtml',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual,text',
                'media_upload' => 1,
                'delay'        => 0,
                'instructions' => __('Content displayed above the map. Title: 30–100 chars, Content: 80–250 chars.', 'flynt'),
            ],
            [
                'label'        => __('Map Locations', 'flynt'),
                'name'         => 'locations',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => __('Add Location', 'flynt'),
                'sub_fields'   => [
                    [
                        'label'      => __('Location', 'flynt'),
                        'name'       => 'location',
                        'type'       => 'google_map',
                        'center_lat' => '',
                        'center_lng' => '',
                        'zoom'       => '',
                        'height'     => '',
                    ],
                    [
                        'label'   => __('Marker Title', 'flynt'),
                        'name'    => 'markerTitle',
                        'type'    => 'text',
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'label'        => __('Marker Info Window', 'flynt'),
                        'name'         => 'markerInfo',
                        'type'         => 'text',
                        'instructions' => __('Text displayed when the marker is clicked.', 'flynt'),
                        'wrapper'      => ['width' => '50'],
                    ],
                ],
            ],
        ],
    ];
}
