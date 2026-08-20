<?php

namespace Flynt\Components\BlockCallToAction;

use Flynt\FieldVariables;

// The editor picks a heading level from the WYSIWYG's own Format dropdown,
// which doesn't stop them from re-using H1 on multiple instances of this
// component on the same page. The Heading Level field is the actual source
// of truth: rewrite whatever heading tag comes first in the saved HTML to
// match it, so the page never ends up with more than one intended H1.
add_filter('Flynt/addComponentData?name=BlockCallToAction', function (array $data): array {
    if (!empty($data['contentHtml']) && !empty($data['headingLevel'])) {
        $data['contentHtml'] = preg_replace(
            '/<h[1-6]([^>]*)>(.*?)<\/h[1-6]>/is',
            "<{$data['headingLevel']}$1>$2</{$data['headingLevel']}>",
            $data['contentHtml'],
            1
        );
    }
    return $data;
});

function getACFLayout(): array
{
    return [
        'name' => 'blockCallToAction',
        'label' => __('Block: Call to Action', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Eyebrow Text', 'flynt'),
                'instructions' => __('Small uppercase text displayed above the main heading, e.g. "Serving Eagle County & Surrounding Areas".', 'flynt'),
                'name' => 'eyebrow',
                'type' => 'text',
                'required' => 0,
            ],
            [
                'label' => __('Main Content / Heading', 'flynt'),
                'instructions' => __('Primary heading and/or body content. Format the headline with the Format dropdown (Heading 1 or Heading 2) — the Heading Level field below has final say over which tag actually ships.', 'flynt'),
                'name' => 'contentHtml',
                'type' => 'wysiwyg',
                'delay' => 0,
                'media_upload' => 0,
                'required' => 0,
            ],
            [
                'label' => __('Heading Level', 'flynt'),
                'instructions' => __('Overrides whatever heading tag is first in the content above. Use H1 once per page for the primary headline; use H2 for any additional instances of this component on the same page, to keep the page semantically/SEO correct.', 'flynt'),
                'name' => 'headingLevel',
                'type' => 'select',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'choices' => [
                    'h1' => __('H1 — Main page headline', 'flynt'),
                    'h2' => __('H2 — Secondary heading', 'flynt'),
                ],
                'default_value' => 'h1',
            ],
            [
                'label' => __('Subheading Text', 'flynt'),
                'instructions' => __('Optional descriptive text displayed below the main heading and above the buttons. Supports bold, italic, and links.', 'flynt'),
                'name' => 'subheading',
                'type' => 'wysiwyg',
                'delay' => 0,
                'media_upload' => 0,
                'required' => 0,
            ],
            [
                'label' => __('Buttons', 'flynt'),
                'name' => 'buttons',
                'type' => 'repeater',
                'min' => 0,
                'max' => 3,
                'layout' => 'block',
                'button_label' => __('Add Button', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Label', 'flynt'),
                        'name' => 'label',
                        'type' => 'text',
                        'required' => 0,
                        'wrapper' => ['width' => '34'],
                    ],
                    [
                        'label' => __('URL', 'flynt'),
                        'instructions' => __('Supports full URLs (https://example.com), internal paths (/about), or protocol URLs (tel:1231231234).', 'flynt'),
                        'name' => 'url',
                        'type' => 'text',
                        'required' => 0,
                        'wrapper' => ['width' => '34'],
                    ],
                    [
                        'label' => __('Button Style', 'flynt'),
                        'name' => 'style',
                        'type' => 'select',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'choices' => [
                            'navy'               => __('Navy — Navy bg, White text', 'flynt'),
                            'light-blue'         => __('Light Blue — Light blue bg, White text', 'flynt'),
                            'white-outline-blue' => __('White — White bg, Navy border & text', 'flynt'),
                        ],
                        'default_value' => 'navy',
                        'wrapper' => ['width' => '22'],
                    ],
                    [
                        'label' => __('Open in New Tab', 'flynt'),
                        'instructions' => __('Enable for external or third-party links (e.g. booking engines).', 'flynt'),
                        'name' => 'newWindow',
                        'type' => 'true_false',
                        'default_value' => 0,
                        'ui' => 1,
                        'wrapper' => ['width' => '10'],
                    ],
                ],
            ],
            [
                'label' => __('Background Image', 'flynt'),
                'instructions' => __('Optional. Fills the component background. Tip: also set Background Theme to "Dark" so text stays white and readable over the image.', 'flynt'),
                'name' => 'backgroundImage',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp',
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
                            'instructions' => __('Leave as (none) for a white background, or select Dark for a black background. When using a background image, Dark is recommended.', 'flynt'),
                        ]
                    ),
                    [
                        'label' => __('Image Overlay Color', 'flynt'),
                        'instructions' => __('Adds a semi-transparent color layer over the background image to improve text readability. Has no effect without a background image.', 'flynt'),
                        'name' => 'overlayColor',
                        'type' => 'select',
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'choices' => [
                            'none'  => __('None', 'flynt'),
                            'navy'  => __('Navy', 'flynt'),
                            'black' => __('Black', 'flynt'),
                        ],
                        'default_value' => 'none',
                    ],
                    [
                        'label' => __('Overlay Opacity', 'flynt'),
                        'instructions' => __('Strength of the overlay. Only applies when an overlay color is selected above.', 'flynt'),
                        'name' => 'overlayOpacity',
                        'type' => 'range',
                        'min' => 10,
                        'max' => 90,
                        'step' => 5,
                        'default_value' => 50,
                        'append' => '%',
                    ],
                    FieldVariables\getSize('medium'),
                    FieldVariables\getAlignment(['default' => 'center']),
                    FieldVariables\getTextAlignment(['default' => 'center']),
                    [
                        'label' => __('Reduce Spacing', 'flynt'),
                        'instructions' => __('Use half the normal top and bottom spacing for this component.', 'flynt'),
                        'name' => 'halfSpacing',
                        'type' => 'true_false',
                        'default_value' => 0,
                        'ui' => 1,
                    ],
                ],
            ],
        ],
    ];
}
