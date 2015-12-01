<?php
function get_the_slug($id = null) {
    if (empty($id)) {
        global $post;
        if (empty($post))
            return ''; // No global $post var available.
        $id = $post->ID;
    }

    $slug = basename(get_permalink($id));
    return $slug;
}

/**
 * Display the page or post slug
 *
 * Uses get_the_slug() and applies 'the_slug' filter.
 */
function the_slug($id = null) {
    echo apply_filters('the_slug', get_the_slug($id));
}