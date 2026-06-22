<?php

namespace Flynt\Components\BlockLocationInfo;

use Flynt\FieldVariables;

function getACFLayout(): array
{
    return [
        'name'       => 'BlockLocationInfo',
        'label'      => 'Block: Location Info',
        'sub_fields' => [
            [
                'label'     => __('Content', 'flynt'),
                'name'      => 'contentTab',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ],
            [
                'label'        => __('Intro Content', 'flynt'),
                'name'         => 'introHtml',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual,text',
                'media_upload' => 0,
                'delay'        => 0,
                'instructions' => __('Heading and intro text displayed above the map and contact details.', 'flynt'),
            ],
            [
                'label'        => __('Google Maps Embed URL', 'flynt'),
                'name'         => 'mapEmbedUrl',
                'type'         => 'url',
                'required'     => 1,
                'instructions' => __('Paste the src URL from the Google Maps embed iframe. Go to Google Maps → Share → Embed a map → copy only the src attribute value from the iframe code.', 'flynt'),
            ],
            [
                'label'        => __('Info Panel Heading', 'flynt'),
                'name'         => 'infoHeading',
                'type'         => 'text',
                'instructions' => __('Optional heading at the top of the info panel, e.g. your business name.', 'flynt'),
                'wrapper'      => ['width' => '100'],
            ],
            [
                'label'        => __('Address', 'flynt'),
                'name'         => 'addressHtml',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual,text',
                'media_upload' => 0,
                'delay'        => 0,
            ],
            [
                'label'        => __('Get Directions URL', 'flynt'),
                'name'         => 'directionsUrl',
                'type'         => 'url',
                'instructions' => __('Optional. Links a "Get Directions" CTA under the address. Paste the Google Maps directions URL.', 'flynt'),
                'wrapper'      => ['width' => '100'],
            ],
            [
                'label'        => __('Hours', 'flynt'),
                'name'         => 'hoursHtml',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual,text',
                'media_upload' => 0,
                'delay'        => 0,
                'instructions' => __('Use a list or table for best formatting.', 'flynt'),
            ],
            [
                'label'        => __('Contact Info', 'flynt'),
                'name'         => 'contactHtml',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual,text',
                'media_upload' => 0,
                'delay'        => 0,
                'instructions' => __('Phone, email, and other contact details.', 'flynt'),
            ],
            [
                'label'         => __('CTA Button', 'flynt'),
                'name'          => 'cta',
                'type'          => 'link',
                'return_format' => 'array',
                'instructions'  => __('Optional. Leave blank to hide the button. Supports relative URLs.', 'flynt'),
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
                ],
            ],
        ],
    ];
}
