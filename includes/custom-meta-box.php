<?php
// Hook to add the custom meta box to the "book" post type.
add_action('add_meta_boxes', 'wp_book_add_custom_meta_box');

function wp_book_add_custom_meta_box() {
    add_meta_box(
        'wp_book_meta_box',
        'Book Meta Information',
        'wp_book_render_meta_box',
        'book',
        'normal',
        'high'
    );
}

// Callback function to render the meta box contents.
function wp_book_render_meta_box($post) {
    // Retrieve the current values of the custom fields (if they exist).
    $author_name = get_post_meta($post->ID, '_book_author_name', true);
    $price = get_post_meta($post->ID, '_book_price', true);
    $publisher = get_post_meta($post->ID, '_book_publisher', true);
    $year = get_post_meta($post->ID, '_book_year', true);
    $edition = get_post_meta($post->ID, '_book_edition', true);
    $url = get_post_meta($post->ID, '_book_url', true);

    // Output the HTML for the custom fields.
    ?>
    <p>
        <label for="book_author_name">Author Name:</label>
        <input type="text" id="book_author_name" name="book_author_name" value="<?php echo esc_attr($author_name); ?>">
    </p>
    <p>
        <label for="book_price">Price:</label>
        <input type="text" id="book_price" name="book_price" value="<?php echo esc_attr($price); ?>">
    </p>
    <p>
        <label for="book_publisher">Publisher:</label>
        <input type="text" id="book_publisher" name="book_publisher" value="<?php echo esc_attr($publisher); ?>">
    </p>
    <p>
        <label for="book_year">Year:</label>
        <input type="text" id="book_year" name="book_year" value="<?php echo esc_attr($year); ?>">
    </p>
    <p>
        <label for="book_edition">Edition:</label>
        <input type="text" id="book_edition" name="book_edition" value="<?php echo esc_attr($edition); ?>">
    </p>
    <p>
        <label for="book_url">URL:</label>
        <input type="url" id="book_url" name="book_url" value="<?php echo esc_url($url); ?>">
    </p>
    <?php
}

// Hook to save the custom field data when the book is saved or updated.
add_action('save_post', 'wp_book_save_custom_meta');

function wp_book_save_custom_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Check if this is a book post type.
    if ('book' !== get_post_type($post_id)) return;

    if (isset($_POST['book_author_name'])) {
        update_post_meta($post_id, '_book_author_name', sanitize_text_field($_POST['book_author_name']));
        $author_name = sanitize_text_field($_POST['book_author_name']);
    } else {
        $author_name = '';
    }
    
    if (isset($_POST['book_price'])) {
        update_post_meta($post_id, '_book_price', sanitize_text_field($_POST['book_price']));
        $price = sanitize_text_field($_POST['book_price']);
    } else {
        $price = '';
    }
    
    if (isset($_POST['book_publisher'])) {
        update_post_meta($post_id, '_book_publisher', sanitize_text_field($_POST['book_publisher']));
        $publisher = sanitize_text_field($_POST['book_publisher']);
    } else {
        $publisher = '';
    }
    
    if (isset($_POST['book_year'])) {
        update_post_meta($post_id, '_book_year', sanitize_text_field($_POST['book_year']));
        $year = sanitize_text_field($_POST['book_year']);
    } else {
        $year = '';
    }
    
    if (isset($_POST['book_edition'])) {
        update_post_meta($post_id, '_book_edition', sanitize_text_field($_POST['book_edition']));
        $edition = sanitize_text_field($_POST['book_edition']);
    } else {
        $edition = '';
    }
    
    if (isset($_POST['book_url'])) {
        update_post_meta($post_id, '_book_url', esc_url($_POST['book_url']));
        $url = esc_url($_POST['book_url']);
    } else {
        $url = '';
    }

    // Prepare the data for insertion.
    $data = array(
        'book_id' => $post_id,
        'author_name' => $author_name,
        'price' => $price,
        'publisher' => $publisher,
        'year' => $year,
        'edition' => $edition,
        'url' => $url,
    );

    // Insert or update the data in the custom table.
    global $wpdb;
    $table_name = $wpdb->prefix . 'book_meta';
    $format = array('%d', '%s', '%f', '%s', '%d', '%s', '%s');
    
    if (get_post_meta($post_id, '_book_author_name', true)) {
        $wpdb->update($table_name, $data, array('book_id' => $post_id), $format, array('%d'));
    } else {
        $wpdb->insert($table_name, $data, $format);
    }
}

function wp_book_create_custom_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'book_meta';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        book_id bigint(20) NOT NULL,
        author_name varchar(255) DEFAULT '' NOT NULL,
        price decimal(10,2) DEFAULT '0.00' NOT NULL,
        publisher varchar(255) DEFAULT '' NOT NULL,
        year int(4) DEFAULT '0' NOT NULL,
        edition varchar(255) DEFAULT '' NOT NULL,
        url varchar(255) DEFAULT '' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

