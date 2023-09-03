<?php

function wp_book_shortcode($atts) {

    $atts = shortcode_atts(array(
        'id' => '',
        'author_name' => '',
        'year' => '',
        'category' => '',
        'tag' => '',
        'publisher' => '',
    ), $atts);

    $args = array(
        'post_type' => 'book',
        'posts_per_page' => -1, 
        'post_status' => 'publish',
    );

    if (!empty($atts['id'])) {
        $args['p'] = intval($atts['id']); 
    }

    if (!empty($atts['author_name'])) {
        $args['meta_query'][] = array(
            'key' => '_book_author_name',
            'value' => sanitize_text_field($atts['author_name']),
            'compare' => '=',
        );
    }

    if (!empty($atts['year'])) {
        $args['meta_query'][] = array(
            'key' => '_book_year',
            'value' => intval($atts['year']),
            'compare' => '=',
        );
    }

    if (!empty($atts['category'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'book_category',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['category']),
        );
    }

    if (!empty($atts['tag'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'book_tag',
            'field' => 'slug',
            'terms' => sanitize_text_field($atts['tag']),
        );
    }

    if (!empty($atts['publisher'])) {
        $args['meta_query'][] = array(
            'key' => '_book_publisher',
            'value' => sanitize_text_field($atts['publisher']),
            'compare' => '=',
        );
    }

    // Query books based on the provided attributes
    $books_query = new WP_Query($args);

    // Output the book information
    $output = '';

    if ($books_query->have_posts()) {
        while ($books_query->have_posts()) {
            $books_query->the_post();

            // Customize the book information display as needed
            $output .= '<div class="book">';
            $output .= '<h2>' . get_the_title() . '</h2>';
            $output .= '<p><strong>Author:</strong> ' . get_post_meta(get_the_ID(), '_book_author_name', true) . '</p>';
            $output .= '<p><strong>Price:</strong> ' . get_post_meta(get_the_ID(), '_book_price', true) . '</p>';
            $output .= '<p><strong>Publisher:</strong> ' . get_post_meta(get_the_ID(), '_book_publisher', true) . '</p>';
            $output .= '<p><strong>Year:</strong> ' . get_post_meta(get_the_ID(), '_book_year', true) . '</p>';
            $output .= '<p><strong>Edition:</strong> ' . get_post_meta(get_the_ID(), '_book_edition', true) . '</p>';
            $output .= '<p><strong>URL:</strong> <a href="' . get_post_meta(get_the_ID(), '_book_url', true) . '">' . get_post_meta(get_the_ID(), '_book_url', true) . '</a></p>';
            $output .= '</div>';
        }

        wp_reset_postdata();
    } else {
        $output = 'No books found.';
    }

    return $output;
}

// Register the [book] shortcode
add_shortcode('book', 'wp_book_shortcode');