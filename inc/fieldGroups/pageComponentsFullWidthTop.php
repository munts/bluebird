<?php

use ACFComposer\ACFComposer;
use Flynt\Components;

add_action('Flynt/afterRegisterComponents', function (): void {
    ACFComposer::registerFieldGroup([
        'name' => 'pageComponentsFullWidthTop',
        'title' => __('Full Width Components (Top)', 'flynt'),
        'style' => 'seamless',
        'menu_order' => -2,
        'fields' => [
            [
                'name' => 'pageComponentsFullWidthTop',
                'label' => __('Full Width Components (Top)', 'flynt'),
                'instructions' => __('Rendered full width, above the sidebar layout below — e.g. a hero video/image that should span edge-to-edge before the sidebar begins. Homepage only.', 'flynt'),
                'type' => 'flexible_content',
                'button_label' => __('Add Component', 'flynt'),
                'layouts' => [
                    Components\HeroImageText\getACFLayout(),
                    Components\HeroImageTextBelow\getACFLayout(),
                    Components\BlockFeatureCards\getACFLayout(),
                    Components\BlockComparisonTable\getACFLayout(),
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
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page'
                ],
            ],
        ],
    ]);
});
