<?php
/*
Plugin Name: KindHeart
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

//database
require_once KH_PLUGIN_DIR . 'includes/database/main.php';
database::connect();

//common functions and utilities
require_once KH_PLUGIN_DIR . 'includes/controllers/common.php';
require_once KH_PLUGIN_DIR . 'includes/controllers/planningCommittee.php';
require_once KH_PLUGIN_DIR . 'includes/controllers/groups.php';
require_once KH_PLUGIN_DIR . 'includes/controllers/benefitiary.php';
require_once KH_PLUGIN_DIR . 'includes/controllers/volunteer.php';
$common = new commonMethods;
$planningCommittee = new planningCommittee;
$groups = new groups;
$benefitiary = new benefitiary;
$volunteer = new volunteer;

//main functions
require_once KH_PLUGIN_DIR . 'includes/kh-functions.php';

class mainKinHeartClass extends mainKibdHeart {
    function __construct() {
        //add REST API
        add_action('rest_api_init', array( "mainKibdHeart", 'apiRoutes' ) );
        //add amin menu on initialization
        add_action( 'admin_menu', array( "mainKibdHeart", 'kh_add_menu' ) );
        //initialize the imported CDN based script
        add_action( 'admin_enqueue_scripts', array( "mainKibdHeart", 'admin_styles_and_script' ));
        
		add_action( 'register_form', array( "mainKibdHeart", 'kindheart_registration_form') );
		add_filter( 'registration_errors', array( "mainKibdHeart", 'kindheart_registration_errors'), 10, 3 );
		add_action( 'user_register', array( "mainKibdHeart", 'kindheart_save_data') );
        
        //registration hooks
        register_activation_hook( __FILE__, 'mainKibdHeart::kh_install' );
        register_deactivation_hook( __FILE__, 'mainKibdHeart::kh_deactivate' );
		register_uninstall_hook( __FILE__, 'mainKibdHeart::kh_install' );
	}
}

new mainKinHeartClass;
?>