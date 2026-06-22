<?php

namespace Flynt\Components\BlockAllLocationsMap;

use Flynt\FieldVariables;
use Flynt\Utils\Options;

add_filter('Flynt/addComponentData?name=BlockAllLocationsMap', function (array $data): array {
    $data['apiKey']    = Options::getGlobal('GoogleMaps', 'apiKey') ?? '';
    $data['centerLat'] = $data['options']['centerLat'] ?? '';
    $data['centerLng'] = $data['options']['centerLng'] ?? '';
    $data['zoomLevel'] = $data['options']['zoomLevel'] ?? 10;
    $data['locations'] = $data['locations'] ?: [];

    return $data;
});

function getACFLayout(): array
{
    return [
        'name'       => 'blockAllLocationsMap',
        'label'      => __('Block: Service Area Map', 'flynt'),
        'sub_fields' => [
            [
                'label'     => __('Locations', 'flynt'),
                'name'      => 'locationsTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            [
                'label'        => __('Locations', 'flynt'),
                'name'         => 'locations',
                'type'         => 'repeater',
                'button_label' => __('Add Location', 'flynt'),
                'layout'       => 'table',
                'sub_fields'   => [
                    [
                        'label'   => __('City / Town', 'flynt'),
                        'name'    => 'label',
                        'type'    => 'text',
                        'wrapper' => ['width' => '40'],
                    ],
                    [
                        'label'       => __('Latitude', 'flynt'),
                        'name'        => 'lat',
                        'type'        => 'text',
                        'placeholder' => '39.6433',
                        'wrapper'     => ['width' => '30'],
                    ],
                    [
                        'label'       => __('Longitude', 'flynt'),
                        'name'        => 'lng',
                        'type'        => 'text',
                        'placeholder' => '-106.3781',
                        'wrapper'     => ['width' => '30'],
                    ],
                ],
            ],
            [
                'label'     => __('Options', 'flynt'),
                'name'      => 'optionsTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            [
                'label'      => '',
                'name'       => 'options',
                'type'       => 'group',
                'layout'     => 'row',
                'sub_fields' => [
                    FieldVariables\getTheme(),
                    [
                        'label'        => __('Map Center Latitude', 'flynt'),
                        'name'         => 'centerLat',
                        'type'         => 'text',
                        'placeholder'  => '39.6433',
                        'instructions' => __('Latitude for the initial map center point.', 'flynt'),
                        'wrapper'      => ['width' => '25'],
                    ],
                    [
                        'label'        => __('Map Center Longitude', 'flynt'),
                        'name'         => 'centerLng',
                        'type'         => 'text',
                        'placeholder'  => '-106.3781',
                        'instructions' => __('Longitude for the initial map center point.', 'flynt'),
                        'wrapper'      => ['width' => '25'],
                    ],
                    [
                        'label'        => __('Zoom Level', 'flynt'),
                        'name'         => 'zoomLevel',
                        'type'         => 'text',
                        'placeholder'  => '10',
                        'instructions' => __('1 (world) to 20 (building). 9–11 works well for a regional service area.', 'flynt'),
                        'wrapper'      => ['width' => '25'],
                    ],
                ],
            ],
        ],
    ];
}
