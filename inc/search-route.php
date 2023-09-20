<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch()
{
    register_rest_route('university/v1', 'search', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'universitySearchResults',
    ]);
}

function universitySearchResults($data)
{
    $mainQuery = new WP_Query([
        'post_type' => ['post', 'page', 'professor', 'program', 'campus', 'event'],
        's' => sanitize_text_field($data['term']),
    ]);

    $results = [
        'generalInfo' => [],
        'professors' => [],
        'programs' => [],
        'events' => [],
        'campuses' => [],
    ];

    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();
        if ('post' == get_post_type() or 'page' == get_post_type()) {
            array_push($results['generalInfo'], [
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ]);
        }
        if ('professor' == get_post_type()) {
            array_push($results['professors'], [
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ]);
        }
        if ('program' == get_post_type()) {
            array_push($results['programs'], [
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ]);
        }
        if ('campuse' == get_post_type()) {
            array_push($results['campuses'], [
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ]);
        }
        if ('event' == get_post_type()) {
            array_push($results['events'], [
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ]);
        }
    }

    return $results;
}
