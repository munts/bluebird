<?php

namespace Flynt\Components\SidebarPromo;

use ACFComposer\ACFComposer;
use Flynt\Utils\Options;

function getPromoFields(): array
{
    return [
        [
            'label' => __('Eyebrow / Badge Text', 'flynt'),
            'instructions' => __('e.g. "Limited Time Offer"', 'flynt'),
            'name' => 'eyebrow',
            'type' => 'text',
            'required' => 0,
            'conditional_logic' => [
                [
                    [
                        'fieldPath' => 'contentType',
                        'operator' => '==',
                        'value' => 'text',
                    ],
                ],
            ],
        ],
        [
            'label' => __('Heading', 'flynt'),
            'instructions' => __('e.g. "Make Today a BlueBird Day"', 'flynt'),
            'name' => 'heading',
            'type' => 'text',
            'required' => 0,
        ],
        [
            'label' => __('Bird Icon', 'flynt'),
            'instructions' => __('Upload an SVG or PNG icon (transparent background recommended).', 'flynt'),
            'name' => 'birdIcon',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'thumbnail',
            'library' => 'all',
            'mime_types' => 'svg,png',
            'required' => 0,
            'conditional_logic' => [
                [
                    [
                        'fieldPath' => 'contentType',
                        'operator' => '==',
                        'value' => 'text',
                    ],
                ],
            ],
        ],
        [
            'label' => __('Intro Text', 'flynt'),
            'instructions' => __('e.g. "It starts with a free, no-pressure quote."', 'flynt'),
            'name' => 'intro',
            'type' => 'textarea',
            'rows' => 2,
            'required' => 0,
        ],
        [
            'label' => __('Promo Content Type', 'flynt'),
            'instructions' => __('Choose whether the promo box below the intro shows the offer text (eyebrow, tiers, footnote) or a single image. It is always one or the other, never both.', 'flynt'),
            'name' => 'contentType',
            'type' => 'button_group',
            'choices' => [
                'text' => __('Text', 'flynt'),
                'image' => __('Image', 'flynt'),
            ],
            'default_value' => 'text',
        ],
        [
            'label' => __('Offer Tiers', 'flynt'),
            'instructions' => __('e.g. Number: "5", Unit: "Windows", Discount: "10%". For a non-numeric row (e.g. Siding), leave Unit blank and put the word in Number, e.g. Number: "Siding", Discount: "20%".', 'flynt'),
            'name' => 'tiers',
            'type' => 'repeater',
            'layout' => 'table',
            'button_label' => __('Add Tier', 'flynt'),
            'conditional_logic' => [
                [
                    [
                        'fieldPath' => 'contentType',
                        'operator' => '==',
                        'value' => 'text',
                    ],
                ],
            ],
            'sub_fields' => [
                [
                    'label' => __('Number', 'flynt'),
                    'name' => 'quantityNumber',
                    'type' => 'text',
                    'wrapper' => ['width' => '34'],
                ],
                [
                    'label' => __('Unit', 'flynt'),
                    'name' => 'quantityUnit',
                    'type' => 'text',
                    'required' => 0,
                    'wrapper' => ['width' => '33'],
                ],
                [
                    'label' => __('Discount', 'flynt'),
                    'name' => 'discountValue',
                    'type' => 'text',
                    'wrapper' => ['width' => '33'],
                ],
            ],
        ],
        [
            'label' => __('Footnote', 'flynt'),
            'instructions' => __('e.g. "(3 window minimum)"', 'flynt'),
            'name' => 'footnote',
            'type' => 'text',
            'required' => 0,
            'conditional_logic' => [
                [
                    [
                        'fieldPath' => 'contentType',
                        'operator' => '==',
                        'value' => 'text',
                    ],
                ],
            ],
        ],
        [
            'label' => __('Promo Image', 'flynt'),
            'instructions' => __('Shown instead of the offer box above when Promo Content Type is set to Image.', 'flynt'),
            'name' => 'promoImage',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'mime_types' => 'jpg,jpeg,png,svg,webp',
            'required' => 0,
            'conditional_logic' => [
                [
                    [
                        'fieldPath' => 'contentType',
                        'operator' => '==',
                        'value' => 'image',
                    ],
                ],
            ],
        ],
        [
            'label' => __('Primary Button Label', 'flynt'),
            'name' => 'primaryButtonLabel',
            'type' => 'text',
            'required' => 0,
            'wrapper' => ['width' => '50'],
        ],
        [
            'label' => __('Primary Button URL', 'flynt'),
            'name' => 'primaryButtonUrl',
            'type' => 'text',
            'required' => 0,
            'wrapper' => ['width' => '50'],
        ],
        [
            'label' => __('Secondary Link Label', 'flynt'),
            'name' => 'secondaryLinkLabel',
            'type' => 'text',
            'required' => 0,
            'wrapper' => ['width' => '50'],
        ],
        [
            'label' => __('Secondary Link URL', 'flynt'),
            'name' => 'secondaryLinkUrl',
            'type' => 'text',
            'required' => 0,
            'wrapper' => ['width' => '50'],
        ],
    ];
}

add_filter('Flynt/addComponentData?name=SidebarPromo', function (array $data): array {
    $pageId = get_queried_object_id();
    $overrideEnabled = $pageId ? get_field('sidebarPromoOverrideEnabled', $pageId) : false;

    if ($overrideEnabled) {
        $data = array_merge($data, get_field('sidebarPromoOverridePromo', $pageId) ?: []);
    } else {
        $data = array_merge($data, Options::getTranslatable('SidebarPromo'));
    }

    if (!empty($data['tiers'])) {
        $data['tiers'] = array_map(function (array $tier): array {
            $tier['isNumeric'] = is_numeric(trim($tier['quantityNumber'] ?? ''));
            return $tier;
        }, $data['tiers']);
    }

    return $data;
});

Options::addTranslatable('SidebarPromo', getPromoFields());

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'sidebarPromoOverride',
        'title' => __('Sidebar Promo Override', 'flynt'),
        'style' => 'seamless',
        'fields' => [
            [
                'label' => __('Override Sidebar Promo', 'flynt'),
                'instructions' => __('By default, every page shows the global sidebar promo (edited under Translatable Options → SidebarPromo). Enable this to show a custom promo on this page instead.', 'flynt'),
                'name' => 'sidebarPromoOverrideEnabled',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
            ],
            [
                'name' => 'sidebarPromoOverridePromo',
                'type' => 'group',
                'label' => '',
                'sub_fields' => getPromoFields(),
                'conditional_logic' => [
                    [
                        [
                            'fieldPath' => 'sidebarPromoOverrideEnabled',
                            'operator' => '==',
                            'value' => 1,
                        ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page'
                ],
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'default'
                ],
                [
                    'param' => 'page_type',
                    'operator' => '!=',
                    'value' => 'front_page'
                ],
            ],
        ],
    ]);
});
