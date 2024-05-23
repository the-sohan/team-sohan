<?php


// Add meta boxes for phone and email fields
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
