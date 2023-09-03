<?php

function wpb_register_book_post_type() {
    $labels = array(
        'name' => 'Books',
        'singular_name' => 'Book',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Book',
        'edit_item' => 'Edit Book',
        'new_item' => 'New Book',
        'view_item' => 'View Book',
        'search_items' => 'Search Books',
        'not_found' => 'No books found',
        'not_found_in_trash' => 'No books found in Trash',
        'parent_item_colon' => 'Parent Book:',
        'menu_name' => 'Books',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'book'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
    );

    register_post_type('book', $args);
}

// Hook the custom post type registration function to the 'init' action
add_action('init', 'wpb_register_book_post_type');

