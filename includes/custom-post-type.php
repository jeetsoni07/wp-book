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

// Register the custom hierarchical taxonomy "Book Category"
function register_book_category_taxonomy() {
    $labels = array(
        'name' => 'Book Categories',
        'singular_name' => 'Book Category',
        'search_items' => 'Search Book Categories',
        'all_items' => 'All Book Categories',
        'parent_item' => 'Parent Book Category',
        'parent_item_colon' => 'Parent Book Category:',
        'edit_item' => 'Edit Book Category',
        'update_item' => 'Update Book Category',
        'add_new_item' => 'Add New Book Category',
        'new_item_name' => 'New Book Category Name',
        'menu_name' => 'Book Categories',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => 'book-category',
        'rewrite' => array('slug' => 'book-category'),
    );

    register_taxonomy('book_category', 'book', $args);
}
add_action('init', 'register_book_category_taxonomy');

// Associate the "Book Category" taxonomy with the "Book" custom post type
function associate_taxonomy_with_post_type() {
    register_taxonomy_for_object_type('book_category', 'book');
}
add_action('init', 'associate_taxonomy_with_post_type');
