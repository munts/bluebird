<?php

use ACFComposer\ACFComposer;

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'homepageSidebar',
        'title' => __('Homepage Sidebar', 'flynt'),
        'style' => 'seamless',
        'menu_order' => -3,
        'fields' => [
            [
                'label' => __('Enable Right Sidebar', 'flynt'),
                'instructions' => __('Off (default): Page Components below render full width, same as today. On: they narrow to fit a sticky right sidebar (Sidebar Promo), which releases once the page reaches Full Width Components. Safe to toggle back off at any time — no components are lost either way.', 'flynt'),
                'name' => 'homepageSidebarEnabled',
                'type' => 'true_false',
                'ui' => 1,
                'default_value' => 0,
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
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page'
                ],
            ],
        ],
    ]);
});
