<?php

namespace Flynt\Components\BlockGoogleReviews;

use Flynt\FieldVariables;

add_filter('Flynt/addComponentData?name=BlockGoogleReviews', function ($data) {
    $data['uuid'] = $data['uuid'] ?? wp_generate_uuid4();

    $reviews = [];
    $data['overallRating'] = 0;
    $data['totalReviewCount'] = 0;

    $googlePlaceId = $data['googlePlaceId'] ?? '';
    $googleApiKey = $data['googleApiKey'] ?? '';
    $cacheDuration = !empty($data['cacheDuration']) ? (int) $data['cacheDuration'] : 12;

    // Fetch Google reviews
    if (!empty($googlePlaceId) && !empty($googleApiKey)) {
        $transientKey = 'velento_google_reviews_' . md5($googlePlaceId);
        $cached = get_transient($transientKey);

        if ($cached !== false) {
            $apiData = $cached;
        } else {
            $apiData = fetchGoogleReviews($googlePlaceId, $googleApiKey);
            if ($apiData !== null) {
                set_transient($transientKey, $apiData, $cacheDuration * HOUR_IN_SECONDS);
            }
        }

        if ($apiData !== null) {
            $data['overallRating'] = $apiData['rating'] ?? 0;
            $data['totalReviewCount'] = $apiData['userRatingCount'] ?? 0;

            if (!empty($apiData['reviews'])) {
                foreach ($apiData['reviews'] as $review) {
                    $reviews[] = [
                        'author' => $review['authorAttribution']['displayName'] ?? __('Anonymous', 'flynt'),
                        'rating' => $review['rating'] ?? 5,
                        'text' => $review['text']['text'] ?? '',
                        'relativeTime' => $review['relativePublishTimeDescription'] ?? '',
                        'source' => 'google',
                        'profilePhoto' => $review['authorAttribution']['photoUri'] ?? null,
                        'googleMapsUri' => $review['googleMapsUri'] ?? null,
                    ];
                }
            }
        }
    }

    // Merge manual reviews
    $manualReviews = $data['manualReviews'] ?? [];
    if (!empty($manualReviews)) {
        foreach ($manualReviews as $manual) {
            if (empty($manual['reviewerName'])) {
                continue;
            }
            $reviews[] = [
                'author' => $manual['reviewerName'],
                'rating' => (int) ($manual['reviewRating'] ?? 5),
                'text' => $manual['reviewText'] ?? '',
                'relativeTime' => $manual['reviewDate'] ?? '',
                'source' => 'manual',
                'profilePhoto' => null,
            ];
        }
    }

    // Sort by rating (highest first)
    usort($reviews, function ($a, $b) {
        return $b['rating'] - $a['rating'];
    });

    $data['reviews'] = $reviews;

    // Pagination config passed to JS via JSON
    $perPage = !empty($data['options']['reviewsPerPage']) ? (int) $data['options']['reviewsPerPage'] : 12;
    $data['jsonData'] = [
        'perPage' => $perPage,
        'totalReviews' => count($reviews),
    ];

    return $data;
});

function fetchGoogleReviews($placeId, $apiKey)
{
    $url = 'https://places.googleapis.com/v1/places/' . urlencode($placeId);

    $response = wp_remote_get($url, [
        'headers' => [
            'X-Goog-Api-Key' => $apiKey,
            'X-Goog-FieldMask' => 'reviews,rating,userRatingCount',
        ],
        'timeout' => 10,
    ]);

    if (is_wp_error($response)) {
        error_log('BlockGoogleReviews API error: ' . $response->get_error_message());
        return null;
    }

    $statusCode = wp_remote_retrieve_response_code($response);
    $body = wp_remote_retrieve_body($response);

    if ($statusCode !== 200) {
        error_log('BlockGoogleReviews API error (HTTP ' . $statusCode . '): ' . substr($body, 0, 500));
        return null;
    }

    $decoded = json_decode($body, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('BlockGoogleReviews JSON decode error: ' . json_last_error_msg());
        return null;
    }

    return $decoded;
}

function getACFLayout()
{
    return [
        'name' => 'blockGoogleReviews',
        'label' => __('Block: Google Reviews', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => __('Title', 'flynt'),
                'instructions' => __('Optional title or intro text above the reviews.', 'flynt'),
                'name' => 'preContentHtml',
                'type' => 'wysiwyg',
                'tabs' => 'visual,text',
                'media_upload' => 0,
                'delay' => 0,
            ],
            [
                'label' => __('Google API', 'flynt'),
                'name' => 'googleApiTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => __('Google Place ID', 'flynt'),
                'instructions' => __('The Google Place ID for your business. Find it at https://developers.google.com/maps/documentation/places/web-service/place-id', 'flynt'),
                'name' => 'googlePlaceId',
                'type' => 'text',
            ],
            [
                'label' => __('Google API Key', 'flynt'),
                'instructions' => __('Your Google Places API key. Must have Places API (New) enabled.', 'flynt'),
                'name' => 'googleApiKey',
                'type' => 'text',
            ],
            [
                'label' => __('Cache Duration (hours)', 'flynt'),
                'instructions' => __('How long to cache API results. Default: 12 hours.', 'flynt'),
                'name' => 'cacheDuration',
                'type' => 'number',
                'default_value' => 12,
                'min' => 1,
                'step' => 1,
            ],
            [
                'label' => __('Manual Reviews', 'flynt'),
                'name' => 'manualReviewsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => __('Manual Reviews', 'flynt'),
                'instructions' => __('Add reviews manually as a fallback or supplement to Google reviews.', 'flynt'),
                'name' => 'manualReviews',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Add Review', 'flynt'),
                'sub_fields' => [
                    [
                        'label' => __('Reviewer Name', 'flynt'),
                        'name' => 'reviewerName',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => [
                            'width' => 33
                        ],
                    ],
                    [
                        'label' => __('Rating (1-5)', 'flynt'),
                        'name' => 'reviewRating',
                        'type' => 'number',
                        'default_value' => 5,
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                        'wrapper' => [
                            'width' => 33
                        ],
                    ],
                    [
                        'label' => __('Date', 'flynt'),
                        'instructions' => __('e.g. "2 months ago" or "January 2024"', 'flynt'),
                        'name' => 'reviewDate',
                        'type' => 'text',
                        'wrapper' => [
                            'width' => 33
                        ],
                    ],
                    [
                        'label' => __('Review Text', 'flynt'),
                        'name' => 'reviewText',
                        'type' => 'textarea',
                        'rows' => 4,
                    ],
                ],
            ],
            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    FieldVariables\getTheme(),
                    [
                        'label' => __('Reviews Per Page', 'flynt'),
                        'name' => 'reviewsPerPage',
                        'type' => 'number',
                        'default_value' => 12,
                        'min' => 1,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
            ],
        ]
    ];
}
