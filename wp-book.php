<?php
/*
Plugin Name: WP Book
Description: A custom WordPress plugin for managing books.
Version: 1.0
Author: Jeet Soni
*/

require_once(plugin_dir_path(__FILE__) . 'includes/custom-post-type.php');

register_activation_hook(__FILE__, 'wp_book_activation');

function wp_book_activation() {
    wpb_register_book_post_type();
}


