<?php    
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Register Custom Taxonomies
add_action('init', 'create_team_taxonomies', 0);

function create_team_taxonomies() {
    // Department Taxonomy
    $labels = array(
        'name'              => _x('Departments', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Department', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Departments', 'textdomain'),
        'all_items'         => __('All Departments', 'textdomain'),
        'parent_item'       => __('Parent Department', 'textdomain'),
        'parent_item_colon' => __('Parent Department:', 'textdomain'),
        'edit_item'         => __('Edit Department', 'textdomain'),
        'update_item'       => __('Update Department', 'textdomain'),
        'add_new_item'      => __('Add New Department', 'textdomain'),
        'new_item_name'     => __('New Department Name', 'textdomain'),
        'menu_name'         => __('Department', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'department'),
    );

    register_taxonomy('department', array('team-sohan'), $args);

    // Designation Taxonomy
    $labels = array(
        'name'              => _x('Designations', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Designation', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Designations', 'textdomain'),
        'all_items'         => __('All Designations', 'textdomain'),
        'parent_item'       => __('Parent Designation', 'textdomain'),
        'parent_item_colon' => __('Parent Designation:', 'textdomain'),
        'edit_item'         => __('Edit Designation', 'textdomain'),
        'update_item'       => __('Update Designation', 'textdomain'),
        'add_new_item'      => __('Add New Designation', 'textdomain'),
        'new_item_name'     => __('New Designation Name', 'textdomain'),
        'menu_name'         => __('Designation', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'designation'),
    );

    register_taxonomy('designation', array('team-sohan'), $args);
}