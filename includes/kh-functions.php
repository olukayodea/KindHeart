<?php
class mainKibdHeart {
    //create the API route
    public static function apiRoutes() {
        //url = https://lekkihill.com/wp-json/api/users/login;
        register_rest_route( 'api', 'users/login',array(
            'methods'  => 'POST',
            'callback' => array("users",'login')
        ));
        //url = https://lekkihill.com/wp-json/api/users/ID;
        register_rest_route( 'api', 'users/(?P<user_id>\d+)',array(
            'methods'  => 'GET',
            'callback' => array("users",'listAllUsers')
        ));
        //url = https://lekkihill.com/wp-json/api/users;
        register_rest_route( 'api', 'users',array(
            'methods'  => 'GET',
            'callback' => array("users",'listUsers')
        ));
    }

    //get all the  menus  and  submenu
    public function  kh_add_menu() {
        add_menu_page(
            "Groups",
            "Groups",
            "manage_group",
            "lh-manage-group",
            array('group','manage'),
            "dashicons-admin-home",'2.2.9',
            2
        );

        add_menu_page(
            "Volunteer",
            "Volunteer",
            "manage_volunteer",
            "lh-manage-volunteer",
            array('volunteer','manage'),
            "dashicons-id",'2.2.9',
            1
        );
    }

    public static function kh_install () {
        // create the tables

        // create the  admin role
    }

    public static function kh_deactivate() {
        // remove the admin roles
    }

    public static function kh_uninstall() {
        // delete the tables
    }
    
	//external scripts and CSS
	function admin_styles_and_script() {
		wp_enqueue_script( 'load-fa', 'https://kit.fontawesome.com/f905a65f30.js' );
		wp_enqueue_style( 'load-select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css' );
		wp_enqueue_script( 'load-select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js' );
		wp_enqueue_style( 'load-datatables-css', 'https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css' );
        wp_enqueue_script( 'load-datatables-js', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js' );
        wp_enqueue_script( 'editable-select-js', 'https://rawgit.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js' );
		wp_enqueue_style( 'editable-select-css', 'https://rawgit.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css' );
        
		wp_enqueue_style( 'load-main-css', plugins_url( 'css/main.css' , __FILE__ ) );
		wp_enqueue_style( 'load-datepicker-css', plugins_url( 'css/jquery.datetimepicker.css' , __FILE__ ) );
        wp_enqueue_script( 'load-datepicker-js', plugins_url( 'js/jquery.datetimepicker.js' , __FILE__ ));
        wp_enqueue_script('suggest');

        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );
    }
    
	//add settings link to the pluginPage
	function kh_plugin_link( $actions, $plugin_file ) {
		static $plugin;
		if (!isset($plugin))
		$plugin		=	plugin_basename(__FILE__);
		if ($plugin == $plugin_file) {
			$settings	=	array('settings' => '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=lh-settings') ) .'">Settings</a>');
			$actions	=	array_merge($settings, $actions);
		}
		
		return $actions;
	}
}
?>