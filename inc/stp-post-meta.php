<?php


// Add meta boxes for team-sohan custom post type
add_action('add_meta_boxes', 'team_sohan_meta_boxes');

function team_sohan_meta_boxes() {
    add_meta_box(
        'team_sohan_phone_meta',
        __('Phone', 'textdomain'),
        'team_sohan_phone_meta_callback',
        'team-sohan',
        'normal',
        'default'
    );

    add_meta_box(
        'team_sohan_email_meta',
        __('Email', 'textdomain'),
        'team_sohan_email_meta_callback',
        'team-sohan',
        'normal',
        'default'
    );
}

// Callback function for phone meta box
function team_sohan_phone_meta_callback($post) {
    // Add a nonce field so we can check for it later
    wp_nonce_field('team_sohan_phone_meta_nonce', 'team_sohan_phone_meta_nonce');

    // Retrieve current phone meta value
    $phone = get_post_meta($post->ID, '_team_sohan_phone', true);

    // Display the field
    echo '<label for="team_sohan_phone">' . __('Phone Number:', 'textdomain') . '</label>';
    echo '<input type="text" id="team_sohan_phone" name="team_sohan_phone" value="' . esc_attr($phone) . '" size="25" />';
}

// Callback function for email meta box
function team_sohan_email_meta_callback($post) {
    // Add a nonce field so we can check for it later
    wp_nonce_field('team_sohan_email_meta_nonce', 'team_sohan_email_meta_nonce');

    // Retrieve current email meta value
    $email = get_post_meta($post->ID, '_team_sohan_email', true);

    // Display the field
    echo '<label for="team_sohan_email">' . __('Email Address:', 'textdomain') . '</label>';
    echo '<input type="email" id="team_sohan_email" name="team_sohan_email" value="' . esc_attr($email) . '" size="25" />';
}

// Save meta data when the post is saved
add_action('save_post', 'save_team_sohan_meta_data');

function save_team_sohan_meta_data($post_id) {
    // Check if the nonce is set
    if (!isset($_POST['team_sohan_phone_meta_nonce']) || !isset($_POST['team_sohan_email_meta_nonce'])) {
        return;
    }

    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['team_sohan_phone_meta_nonce'], 'team_sohan_phone_meta_nonce') || !wp_verify_nonce($_POST['team_sohan_email_meta_nonce'], 'team_sohan_email_meta_nonce')) {
        return;
    }

    // If this is an autosave, do nothing
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Update phone meta data
    if (isset($_POST['team_sohan_phone'])) {
        update_post_meta($post_id, '_team_sohan_phone', sanitize_text_field($_POST['team_sohan_phone']));
    }

    // Update email meta data
    if (isset($_POST['team_sohan_email'])) {
        update_post_meta($post_id, '_team_sohan_email', sanitize_email($_POST['team_sohan_email']));
    }
}





// Add meta boxes for team-s-short custom post type(Shortcode Meta)
// Register the meta box
add_action('add_meta_boxes', 'team_s_short_meta_box');

function team_s_short_meta_box() {
    add_meta_box(
        'team_s_short_meta',           // Unique ID
        __('Member Details', 'textdomain'),  // Box title
        'team_s_short_meta_box_callback',  // Content callback
        'team-s-short',                 // Post type
        'normal',                       // Context
        'default'                       // Priority
    );
}

// Display the meta box
function team_s_short_meta_box_callback($post) {
    // Add a nonce field so we can check for it later
    wp_nonce_field('team_s_short_meta_box_nonce', 'team_s_short_meta_box_nonce');

    // Get the current value of the meta field
    $value = get_post_meta($post->ID, '_team_s_short_radio', true);

    // Display the radio button
    echo '<label for="team_s_short_radio">' . __('Select an option:', 'textdomain') . '</label><br>';
    echo '<input type="radio" id="team_s_short_radio_1" name="team_s_short_radio" value="option1" ' . checked($value, 'layout1', false) . '> ';
    echo '<label for="team_s_short_radio_1">' . __('Layout 1', 'textdomain') . '</label><br>';
    echo '<input type="radio" id="team_s_short_radio_2" name="team_s_short_radio" value="option2" ' . checked($value, 'layout2', false) . '> ';
    echo '<label for="team_s_short_radio_2">' . __('Layout 2', 'textdomain') . '</label>';
}




// Save the meta data
add_action('save_post', 'team_s_short_save_meta_box_data');

function team_s_short_save_meta_box_data($post_id) {
    // Check if our nonce is set
    if (!isset($_POST['team_s_short_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['team_s_short_meta_box_nonce'], 'team_s_short_meta_box_nonce')) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Make sure that it is set
    if (!isset($_POST['team_s_short_radio'])) {
        return;
    }

    // Sanitize user input
    $my_data = sanitize_text_field($_POST['team_s_short_radio']);

    // Update the meta field in the database
    update_post_meta($post_id, '_team_s_short_radio', $my_data);
}


