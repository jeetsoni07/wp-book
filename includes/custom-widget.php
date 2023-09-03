<?php

class Book_Category_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'book_category_widget',
            'Book Category Widget',
            array('description' => 'Display books of a selected category.')
        );
    }

    // Widget output
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $category_slug = $instance['category'];

        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Query books based on the selected category
        $args_query = array(
            'post_type' => 'book',
            'posts_per_page' => 5,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'book_category',
                    'field' => 'slug',
                    'terms' => $category_slug,
                ),
            ),
        );

        $books_query = new WP_Query($args_query);

        if ($books_query->have_posts()) {
            echo '<ul>';
            while ($books_query->have_posts()) {
                $books_query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo 'No books found in this category.';
        }

        wp_reset_postdata();

        echo $args['after_widget'];
    }


    // Widget form
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $category = !empty($instance['category']) ? $instance['category'] : '';

        // Widget Title
        echo '<p><label for="' . $this->get_field_id('title') . '">Title:</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . esc_attr($title) . '" /></p>';

        // Category Dropdown
        echo '<p><label for="' . $this->get_field_id('category') . '">Select Category:</label>';
        echo '<select class="widefat" id="' . $this->get_field_id('category') . '" name="' . $this->get_field_name('category') . '">';

        $categories = get_terms('book_category', array('hide_empty' => false));
        foreach ($categories as $cat) {
            echo '<option value="' . $cat->slug . '" ' . selected($category, $cat->slug, false) . '>' . $cat->name . '</option>';
        }

        echo '</select></p>';
    }

    // Update widget settings
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['category'] = sanitize_text_field($new_instance['category']);
        return $instance;
    }
}

// Register the widget
function wp_book_register_category_widget() {
    register_widget('Book_Category_Widget');
}
add_action('widgets_init', 'wp_book_register_category_widget');