<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'pageComponentsFullWidth',
        'title' => __('Full Width Components', 'flynt'),
        'style' => 'seamless',
        'fields' => [
            [
                'name' => 'pageComponentsFullWidth',
                'label' => __('Full Width Components', 'flynt'),
                'instructions' => __('Rendered full width, below the sidebar layout above.', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\HeroImageText\getACFLayout(),
                    Components\BlockAnchor\getACFLayout(),
                    Components\BlockCallToAction\getACFLayout(),
                    Components\BlockPromotionRow\getACFLayout(),
                    Components\BlockServicesGrid\getACFLayout(),
                    Components\BlockProductStylesGrid\getACFLayout(),
                    Components\AccordionDefault\getACFLayout(),
                    Components\BlockGoogleReviews\getACFLayout(),
                    Components\BlockParallaxCards\getACFLayout(),
                    Components\BlockServiceAreas\getACFLayout(),
                    Components\BlockServices\getACFLayout(),
                    Components\BlockShortcode\getACFLayout(),
                    Components\BlockImage\getACFLayout(),
                    Components\BlockImageText\getACFLayout(),
                    Components\BlockSpacer\getACFLayout(),
                    Components\BlockVideoOembed\getACFLayout(),
                    Components\BlockWysiwyg\getACFLayout(),
                    Components\BlockWysiwygTwoCol\getACFLayout(),
                    Components\GridImageText\getACFLayout(),
                    Components\GridPostsLatest\getACFLayout(),
                    Components\GridStaff\getACFLayout(),
                    Components\ListComponents\getACFLayout(),
                    Components\SliderImages\getACFLayout(),
                    Components\BlockPromoCards\getACFLayout(),
                    Components\BlockTestimonials\getACFLayout(),
                    Components\BlockAllLocationsMap\getACFLayout(),
                    Components\BlockAccoladesSlider\getACFLayout(),
                    Components\BlockCtaForm\getACFLayout(),
                    Components\BlockLocationInfo\getACFLayout()
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
