<?php
/**
 * Plugin Name: Sohan Team Plugin
 * Plugin URI: https://example.com/wp-team-plugin
 * Description: This is test plugin.
 * Version: 1.0
 * Author: Sohan
 * Author URI: https://example.com
 * Text Domain: sohan-team-plugin
 * License: GPL2
 * 
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load plugin Scripts. 
require_once 'inc/stp-front-scripts.php';

// Team Post Type
require_once 'inc/stp-post-type.php';
require_once 'inc/stp-post-type-taxonomy.php';

// Team Post Meta
require_once 'inc/stp-post-meta.php';

// Team Shortcode
require_once 'inc/stp-post-shortcodes.php';


// Flush rewrite rules on activation
function wp_team_plugin_activate() {
    create_team_sohan_post_type();
    create_team_taxonomies();
    create_team_sohan_shortcodes_post_type();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'sohan_team_plugin_activate');

// Flush rewrite rules on deactivation
function wp_team_plugin_deactivate() {
    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'sohan_team_plugin_deactivate');
