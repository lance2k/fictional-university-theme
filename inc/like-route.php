<?php

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes()
{
    register_rest_route('university/v1', 'manageLike', [
        'methods' => 'POST',
        'callback' => 'createLike',
    ]);
    register_rest_route('university/v1', 'manageLike', [
        'methods' => 'DELETE',
        'callback' => 'deleteLike',
    ]);
}

function createLike($data)
{
    if (is_user_logged_in()) {
        $professor = sanitize_text_field($data['professorId']);

        $existQuery = new WP_Query([
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => [
                [
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => $professor,
                ],
            ],
        ]);

        if (0 == $existQuery->found_posts and 'professor' == get_post_type($professor)) {
            return wp_insert_post([
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => '2nd PHP Test',
                'meta_input' => [
                    'liked_professor_id' => $professor,
                ],
            ]);
        }

        exit('Invalid professor id');
    }

    exit('Only logged in users can create a like.');
}
function deleteLike($data)
{
    $likeId = sanitize_text_field($data['like']);
    if (get_current_user_id() == get_post_field('post_author', $likeId) and 'like' == get_post_type($likeId)) {
        wp_delete_post($likeId, true);

        return 'Congrats, like deleted.';
    }

    exit('You do not have permission to delete that.');
}
