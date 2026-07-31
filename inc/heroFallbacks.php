<?php

/**
 * Legacy hero image fallbacks for Classic Content mode pages (see page.twig).
 *
 * The old site's hero images were mostly a shared "pool" system (not unique
 * per page), except for these 15 pages, which had a genuinely unique hero
 * image. Bundled as theme assets (not re-uploaded to the media library) so
 * they deploy with the theme code to every environment without a separate
 * content migration step.
 *
 * A page's own Featured Image always takes priority over this fallback —
 * see get() below and its usage in page.php.
 */

namespace Flynt\HeroFallbacks;

use Flynt\Utils\Asset;

const MAP = [
    'siding'        => 'siding.webp',
    'thank-you'     => 'thank-you.jpg',
    'awning'        => 'awning.jpg',
    'hopper'        => 'hopper.jpg',
    'bow'           => 'bow.jpg',
    'garden'        => 'garden.jpg',
    'slider'        => 'slider.jpg',
    'picture'       => 'picture.jpg',
    'double-hung'   => 'double-hung.jpg',
    'casement'      => 'casement.jpg',
    'bay'           => 'bay.jpg',
    'storm-doors'   => 'storm-doors.jpg',
    'entry-doors'   => 'entry-doors.png',
    'patio-doors'   => 'patio-doors.jpg',
    'vinyl-windows' => 'vinyl-windows.jpg',
];

/**
 * Gets the fallback hero image URL for a page slug, if one exists.
 *
 * @param string $slug The page's slug (post_name).
 *
 * @return string|null
 */
function get(string $slug): ?string
{
    if (!isset(MAP[$slug])) {
        return null;
    }

    return Asset::requireUrl('assets/images/hero-fallbacks/' . MAP[$slug]);
}
