<?php
/*
Plugin Name: WP Book
Description: A custom WordPress plugin for managing books.
Version: 1.0
Author: Jeet Soni
*/

require_once(plugin_dir_path(__FILE__) . 'includes/custom-post-type.php');
require_once(plugin_dir_path(__FILE__) . 'includes/custom-meta-box.php');
require_once(plugin_dir_path(__FILE__) . 'includes/custom-setting-page.php');
require_once(plugin_dir_path(__FILE__) . 'includes/custom-shortcode.php');
require_once(plugin_dir_path(__FILE__) . 'includes/custom-widget.php');

register_activation_hook(__FILE__, 'wp_book_activation');

function wp_book_activation() {
    //register book post
    wpb_register_book_post_type();

    //create table for metabox
    wp_book_create_custom_table();
}

