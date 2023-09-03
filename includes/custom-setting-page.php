<?php

// Hook to add the custom settings page to the admin menu.
add_action('admin_menu', 'wp_book_add_admin_menu');

function wp_book_add_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=book',
        'Book Settings',
        'Settings', 
        'manage_options', 
        'book-settings',
        'wp_book_render_settings_page' 
    );
}
function wp_book_render_settings_page() {
    ?>
    <div class="wrap">
        <h2>Book Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('wp_book_settings_group');
            do_settings_sections('wp_book_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
add_action('admin_init', 'wp_book_initialize_settings');

function wp_book_initialize_settings() {
    register_setting(
        'wp_book_settings_group', 
        'wp_book_currency' 
    );

    register_setting(
        'wp_book_settings_group',
        'wp_book_books_per_page'
    );

    // Add sections and fields for each setting
    add_settings_section(
        'wp_book_general_settings',
        'General Settings',
        'wp_book_general_settings_callback',
        'wp_book_settings'
    );

    add_settings_field(
        'wp_book_currency',
        'Currency',
        'wp_book_currency_field_callback',
        'wp_book_settings',
        'wp_book_general_settings'
    );

    add_settings_field(
        'wp_book_books_per_page',
        'Books Per Page',
        'wp_book_books_per_page_field_callback',
        'wp_book_settings',
        'wp_book_general_settings'
    );
}

// Callback functions for settings sections and fields
function wp_book_general_settings_callback() {
    echo 'General settings for books.';
}

function wp_book_currency_field_callback() {
    $currency = get_option('wp_book_currency', 'USD'); 
    echo '<input type="text" name="wp_book_currency" value="' . esc_attr($currency) . '" />';
}

function wp_book_books_per_page_field_callback() {
    $books_per_page = get_option('wp_book_books_per_page', 10); 
    echo '<input type="number" name="wp_book_books_per_page" value="' . esc_attr($books_per_page) . '" />';
}