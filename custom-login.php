<?php 
/*
* Plugin Name: Custom Login
* Description: This is custom login plugin for login student and teacher
* Plugin URI: https://example.com/custom-login
* Author: Arvind Yadav
* Version: 1.0

*/
// Plugin code goes here
/*****************Yoga Classes Custom Code*****************************/

function for_stylesheet() {
    wp_register_style('bootstrap', plugins_url('assets/css/bootstrap.css',__FILE__ ));
    wp_enqueue_style('bootstrap');
    wp_register_style('bootstrap_min', plugins_url('assets/css/bootstrap.min.css',__FILE__ ));
    wp_enqueue_style('bootstrap_min');
    wp_register_style('style', plugins_url('assets/css/style.css',__FILE__ ));
    wp_enqueue_style('style');
    wp_register_script( 'bootstrap_js', plugins_url('assets/js/bootstrap.js',__FILE__ ));
    wp_enqueue_script('bootstrap_js');
    wp_register_script( 'myjquery', plugins_url('assets/js/jquery-2.2.3.min.js',__FILE__ ));
    wp_enqueue_script('myjquery');
    wp_register_script( 'jquery_min', plugins_url('assets/js/jquery.magnific-popup.min.js',__FILE__ ));
    wp_enqueue_script('jquery_min');
}

add_action( 'wp_enqueue_scripts','for_stylesheet');
// CPT for yoga classes
function create_yoga_classes_cpt() {
  $labels = array(
      'name' => 'Yoga Classes',
      'singular_name' => 'Yoga Class',
      'menu_name' => 'Yoga Classes',
      'add_new_item' => 'Add New Yoga Class',
      'edit_item' => 'Edit Yoga Class',
      'new_item' => 'New Yoga Class',
      'view_item' => 'View Yoga Class',
      'search_items' => 'Search Yoga Class',
      'not_found' => 'No Yoga Class found',
      'not_found_in_trash' => 'No Yoga Classes found in Trash',
  );

  $args = array(
      'label' => 'Yoga Classes',
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'yogaclasses'),
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => false,
      'menu_position' => 5,
      'supports' => array('title', 'editor', 'thumbnail', 'custom-fields' ),
  );

  register_post_type('yoga-classes', $args);
}
add_action('init', 'create_yoga_classes_cpt');
//....End Yoga classes CPT...........
// ........CPT for Booking......
function booking_cpt() {
    $labels = array(
        'name' => 'Bookings',
        'singular_name' => 'Booking',
        'menu_name' => 'Bookings',
        'add_new_item' => 'Add New Booking',
        'edit_item' => 'Edit Booking',
        'new_item' => 'New Booking',
        'view_item' => 'View Booking',
        'search_items' => 'Search Booking',
        'not_found' => 'No Booking found',
        'not_found_in_trash' => 'No Bookings found in Trash',
    );
  
    $args = array(
        'label' => 'Bookings',
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'yogaclasses'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields' ),
    );
  
    register_post_type('bookings', $args);
  }
  add_action('init', 'booking_cpt');
  //....End Booking CPT...........
/*****************Start of adding custom field and save in our CPT(yoga-classes) admin*****************************/
// Add Meta Box for Custom Fields
function add_field_for_yoga_services() {
  add_meta_box(
      'custom_fields_meta_box',
      'Yoga Additional Services',
      'display_custom_fields_meta_box',
      'yoga-classes',
      'normal',
      'high'
  );
}
add_action('add_meta_boxes', 'add_field_for_yoga_services');

// Display Custom Fields Meta Box
function display_custom_fields_meta_box($post) {
  // Retrieve existing values from the database
  $duration = get_post_meta($post->ID, '_duration', true);
  $fees = get_post_meta($post->ID, '_fees', true);
  $timings = get_post_meta($post->ID, '_timings', true);

  // HTML for the custom field
  ?>
  <label for="custom_field">Duration:</label>
  <input type="text" id="duration" name="duration" value="<?php echo esc_attr($duration); ?>">
  <label for="custom_field">Fees:</label>
  <input type="text" id="fees" name="fees" value="<?php echo esc_attr($fees); ?>">
  <label for="yogatimings">Timings:</label>
<select name="timings" id="timings">
    <optgroup label="Morning Time">
        <option value="5am-6am" <?php selected($timings, '5am-6am'); ?>>5am - 6am</option>
        <option value="6am-7am" <?php selected($timings, '6am-7am'); ?>>6am - 7am</option>
        <option value="7am-8am" <?php selected($timings, '7am-8am'); ?>>7am - 8am</option>
        <option value="8am-9am" <?php selected($timings, '8am-9am'); ?>>8am - 9am</option>
        <option value="9am-10am" <?php selected($timings, '9am-10am'); ?>>9am - 10am</option>
    </optgroup>
    <optgroup label="Evening Time">
        <option value="5pm-6pm" <?php selected($timings, '5pm-6pm'); ?>>5pm - 6pm</option>
        <option value="6pm-7pm"<?php selected($timings, '6pm-7pm'); ?>>6pm - 7pm</option>
        <option value="7pm-8pm"<?php selected($timings, '7pm-8pm'); ?>>7pm - 8pm</option>
        <option value="8pm-9pm"<?php selected($timings, '8pm-9pm'); ?>>8pm - 9pm</option>
        <option value="9pm-10pm"<?php selected($timings, '9pm-10pm'); ?>>9pm - 10pm</option>
    </optgroup>
</select>

  
  <?php
}

// Save Custom Fields
function save_yoga_services_data($post_id) {
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  // Check if the current user has permission to save the post
  if (!current_user_can('edit_post', $post_id)) return;

  // Save custom field values
  $yogaservices = array('duration', 'fees', 'timings');

  foreach ($yogaservices as $yoga) {
      if (isset($_POST[$yoga])) {
          update_post_meta($post_id, '_' . $yoga, sanitize_text_field($_POST[$yoga]));
      }
  }
}
add_action('save_post', 'save_yoga_services_data');


add_filter( 'manage_edit-yoga-classes_columns', 'custom_column' );
function custom_column( $columns ) {
    // Define the desired column order
    $new_column = array(
        'cb'       => $columns['cb'],
        'title'    => $columns['title'],
        'duration' => 'Duration',
        'fees'     => 'Fees',
        'timings'  => 'Timings',
        'date'     => $columns['date'], // Include the 'Date' column if needed
    );

    return $new_column;
}

add_action('manage_yoga-classes_posts_custom_column', 'custom_column_content', 10, 2);
function custom_column_content($column, $post_id) {
    switch ($column) {
        case 'duration':
            echo get_post_meta($post_id, '_duration', true);
            break;

        case 'fees':
            echo get_post_meta($post_id, '_fees', true);
            break;

        case 'timings':
            echo get_post_meta($post_id, '_timings', true);
            break;
    }
}
/*****************End of adding custom field and save in our CPT admin*****************************/
/*****************for include  shortcode-yoga-classes.php*****************************/
function custom_template_include($template) {
    if (is_single() && get_post_type() == 'yoga-classes') {
        $template_path = plugin_dir_path(__FILE__) . 'templates/single-yoga-classes.php';
        if (file_exists($template_path)) {
            return $template_path;
        }
    }
    return $template;
}
add_filter('template_include', 'custom_template_include');

include( 'shortcode-yoga-classes.php');
/***End for include  shortcode-yoga-classes.php******/
/*****Start of adding custom field and save in our CPT(yoga-classes) admin******/
// Add Meta Box for Custom Fields
function add_field_for_bookings() {
  add_meta_box(
      'custom_fields_meta_box',
      'Update Bookings Details',
      'display_custom_fields_bookings',
      'bookings',
      'normal',
      'high'
  );
}
add_action('add_meta_boxes', 'add_field_for_bookings');

// Display Custom Fields Meta Box
function display_custom_fields_bookings($post) {
  // Retrieve existing values from the database
  $name = get_post_meta($post->ID, '_name', true);
  $email = get_post_meta($post->ID, '_email', true);
  $phone = get_post_meta($post->ID, '_phone', true);

  // HTML for the custom field
  ?>
  <label for="custom_field">Name:</label>
  <input type="text" name="name" value="<?php echo esc_attr($name); ?>">
  <label for="custom_field">Email:</label>
  <input type="email" name="email" value="<?php echo esc_attr($email); ?>">
  <label for="yogatimings">Phone:</label>
  <input type="text" name="phone" value="<?php echo esc_attr($phone); ?>">
  
  <?php
}

// Save Custom Fields
function save_booking_data($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Save custom field values
    $bookings = array('name', 'email', 'phone');

    foreach ($bookings as $booking) {
        if (isset($_POST[$booking])) {
            update_post_meta($post_id, '_' . $booking, sanitize_text_field($_POST[$booking]));
        }
    }
}
add_action('save_post', 'save_booking_data');


add_filter( 'manage_edit-bookings_columns', 'booking_column' );
function booking_column( $columns ) {
    // Define the desired column order
    $new_column = array(
        'cb'       => $columns['cb'],
        'title'    => $columns['title'],
        'name' => 'Booked By',
        'email'     => 'Email',
        'phone'  => 'Phone',
        'date'     => $columns['date'], // Include the 'Date' column if needed
    );

    return $new_column;
}

add_action('manage_bookings_posts_custom_column', 'booking_content', 10, 2);
function booking_content($column, $post_id) {
    switch ($column) {
        case 'name':
            echo get_post_meta($post_id, '_name', true);
            break;

        case 'email':
            echo get_post_meta($post_id, '_email', true);
            break;

        case 'phone':
            echo get_post_meta($post_id, '_phone', true);
            break;
    }
}
/***End of adding custom field and save in our CPT admin***/


?>