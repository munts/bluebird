<?php

namespace Flynt\Components\FooterColumns;

use Flynt\Utils\Options;

Options::addTranslatable('FooterColumns', [
    [
        'label' => __('Column 1 – Contact Info', 'flynt'),
        'name' => 'col1Tab',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0,
    ],
    [
        'label' => __('Phone Number', 'flynt'),
        'name' => 'phone',
        'type' => 'text',
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Email Address', 'flynt'),
        'name' => 'email',
        'type' => 'text',
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Hours Text', 'flynt'),
        'instructions' => __('e.g. "Open 24 x 7"', 'flynt'),
        'name' => 'hoursText',
        'type' => 'text',
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Service Area Text', 'flynt'),
        'instructions' => __('e.g. "Vail, Summit & the Roaring Fork Valley"', 'flynt'),
        'name' => 'hoursText',
        'type' => 'text',
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Prefer to Call? — Subtext', 'flynt'),
        'instructions' => __('Small text below the "Prefer to Call?" heading. e.g. "Our team is available 24/7. Speak with a real person — not a machine."', 'flynt'),
        'name' => 'preferToCallSubtext',
        'type' => 'text',
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('License Numbers', 'flynt'),
        'instructions' => __('One per line. e.g. "PC.0004658"', 'flynt'),
        'name' => 'licenseNumbers',
        'type' => 'textarea',
        'rows' => 3,
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Column 2 – Logo & Links', 'flynt'),
        'name' => 'col2Tab',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0,
    ],
    [
        'label' => __('Contact Heading', 'flynt'),
        'instructions' => __('e.g. "CONTACT US"', 'flynt'),
        'name' => 'contactHeading',
        'type' => 'text',
        'default_value' => __('Contact Us', 'flynt'),
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Logo', 'flynt'),
        'name' => 'logo',
        'type' => 'image',
        'return_format' => 'array',
        'preview_size' => 'thumbnail',
        'mime_types' => 'jpg,jpeg,png,svg,webp',
        'wrapper' => ['width' => '50'],
    ],
    [
        'label' => __('Social Links', 'flynt'),
        'name' => 'socialLinks',
        'type' => 'repeater',
        'layout' => 'table',
        'button_label' => __('Add Social Link', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Icon', 'flynt'),
                'instructions' => __('Font Awesome class, e.g. "fa-brands fa-instagram"', 'flynt'),
                'name' => 'icon',
                'type' => 'text',
                'required' => 1,
                'wrapper' => ['width' => '40'],
            ],
            [
                'label' => __('URL', 'flynt'),
                'name' => 'url',
                'type' => 'url',
                'required' => 1,
                'wrapper' => ['width' => '40'],
            ],
            [
                'label' => __('Aria Label', 'flynt'),
                'instructions' => __('e.g. "Follow us on Instagram"', 'flynt'),
                'name' => 'ariaLabel',
                'type' => 'text',
                'wrapper' => ['width' => '20'],
            ],
        ],
    ],
    [
        'label' => __('CTA Button', 'flynt'),
        'name' => 'ctaLink',
        'type' => 'link',
        'return_format' => 'array',
    ],
    [
        'label' => __('Column 3 – Contact Form', 'flynt'),
        'name' => 'col3Tab',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0,
    ],
    [
        'label' => __('Form Shortcode', 'flynt'),
        'instructions' => __('Paste your Gravity Forms or other form shortcode here. e.g. [gravityforms id="1"]', 'flynt'),
        'name' => 'formShortcode',
        'type' => 'text',
    ],
]);
