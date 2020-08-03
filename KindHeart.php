<?php
/*
Plugin Name: KindHeart HMS
Plugin URI: https://kindheartsng.com/
Description: Custom plugin to manage kindheartsng users and groups.
Version: 1.0.0
Author: Linnkstec
Author URI: https://linnkstec.com/
License: GPLv2 or later
Text Domain: lekkihill.com
*/
global $wpdb;

define( 'KH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define(  "kh_table_prefix", $wpdb->prefix."kindheart_" );
if (defined('WP_CONTENT_DIR') && !defined('WP_INCLUDE_DIR')){
    define('WP_INCLUDE_DIR', str_replace('wp-content', 'wp-includes', WP_CONTENT_DIR));
}
//common functions and utilities
require_once KH_PLUGIN_DIR . 'includes/controllers/common.php';
$common = new common;

//main functions
// require_once KH_PLUGIN_DIR . 'includes/kh-functions.php';

class mainClass extends main {
    function __construct() {
        //add REST API
        add_action('rest_api_init', array( "main", 'apiRoutes' ) );
        //add amin menu on initialization
        add_action( 'admin_menu', array( "main", 'kh_add_menu' ) );
        //initialize the imported CDN based script
        add_action( 'admin_enqueue_scripts', array( "main", 'admin_styles_and_script' ));
        //create additional links in plugin menu 
        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( "main", 'kh_plugin_link'), 10, 5 );
        
        
        //registration hooks
        register_activation_hook( __FILE__, 'main::kh_install' );
        register_deactivation_hook( __FILE__, 'main::kh_deactivate' );
        register_uninstall_hook( __FILE__, 'main::kh_install' );
    }
}

new mainClass;
?>