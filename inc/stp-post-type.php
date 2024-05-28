<?php    
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Register team-sohan Custom Post Type
add_action('init', 'create_team_sohan_post_type');

function create_team_sohan_post_type() {

    $labels = array(
        'name'                  => _x('All Teams', 'textdomain'),
        'singular_name'         => _x('Team', 'textdomain'),
        'add_new'               => _x('Add new', 'textdomain'),
        'add_new_item'               => _x('Add new member', 'textdomain'),
        'menu_name'             => _x('Teams', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-groups',
    );

    register_post_type('team-sohan', $args);
}




// Register team-sohan-shortcodes Custom Post Type
add_action('init', 'create_team_sohan_shortcodes_post_type');
function create_team_sohan_shortcodes_post_type() {
    $labels = array(
        'name'                  => _x('Shortcodes', 'Post type general name', 'textdomain'),
        'singular_name'         => _x('Team Sohan Shortcode', 'Post type singular name', 'textdomain')
    );

    $args = array(
        'labels'             => $labels,
        'show_ui'            => true,
        'show_in_menu'       => 'edit.php?post_type=team-sohan',
        'supports'           => array('title'),
    );

    register_post_type('team-s-short', $args);
}

// Hook into the edit form after title action
add_action('edit_form_after_title', 'ssp_team_s_short_notice_after_title');

function ssp_team_s_short_notice_after_title($post) {
    // Check if we are on the 'team-s-short' custom post type add/edit page
    if ($post->post_type == 'team-s-short') {
        // Get the post ID and title
        $post_id = $post->ID;
        $post_title = get_the_title($post_id);

        // Display the notice
        ?>
        <div class="notice notice-success is-dismissible">
            <h2><?php printf(__('Use the shortcode: [sohan_team id="%d" title="%s"]', 'simple-switch-plugin'), $post_id, esc_html($post_title)); ?></h2>
        </div>
        <?php
    }
}


// Add custom column to 'team-s-short' post type
add_filter('manage_team-s-short_posts_columns', 'ssp_add_team_s_short_columns');
function ssp_add_team_s_short_columns($columns) {
    // Add a new column for the shortcode
    $columns['shortcode'] = __('Shortcode', 'simple-switch-plugin');
    return $columns;
}

// Populate custom column with the shortcode
add_action('manage_team-s-short_posts_custom_column', 'ssp_team_s_short_custom_column', 10, 2);
function ssp_team_s_short_custom_column($column, $post_id) {
    if ($column == 'shortcode') {
        // Get the post title
        $post_title = get_the_title($post_id);

        // Display the shortcode with post ID and title
        echo sprintf('[sohan_team id="%d" title="%s"]', $post_id, esc_html($post_title));
    }
}
