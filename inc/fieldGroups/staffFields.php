<?php

use ACFComposer\ACFComposer;

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'staffFields',
        'title' => __('Staff Details', 'flynt'),
        'fields' => [
            [
                'label' => __('Title / Position', 'flynt'),
                'instructions' => __('e.g. "CEO & Owner", "Lead Technician", "Intern"', 'flynt'),
                'name' => 'staffPosition',
                'type' => 'text',
                'required' => 0,
                'wrapper' => ['width' => '50'],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'staff',
                ],
            ],
        ],
    ]);
});
