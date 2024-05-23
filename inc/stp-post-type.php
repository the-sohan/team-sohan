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
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => 'edit.php?post_type=team-sohan',
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('team-s-short', $args);
}
