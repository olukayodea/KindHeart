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
$common = new commonMethods;

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
        //create additional links in plugin menu 
        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( "mainKibdHeart", 'kh_plugin_link'), 10, 5 );
        
        
        //registration hooks
        register_activation_hook( __FILE__, 'mainKibdHeart::kh_install' );
        register_deactivation_hook( __FILE__, 'mainKibdHeart::kh_deactivate' );
        register_uninstall_hook( __FILE__, 'mainKibdHeart::kh_install' );
    }
}

add_action( 'register_form', 'kindheart_registration_form' );
add_filter( 'registration_errors', 'kindheart_registration_errors', 10, 3 );
add_action( 'user_register', 'kindheart_save_data' );

function kindheart_save_data( $user_id ) {
	if ( ! empty( $_POST['first_name'] ) ) {
		update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) ) ;		
	}

	if ( ! empty( $_POST['last_name'] ) ) {
		update_user_meta( $user_id, 'last_name', trim( $_POST['last_name'] ) );
	}

	if ( ! empty( $_POST['gender'] ) ) {
		update_user_meta( $user_id, 'gender', trim( $_POST['gender'] ) );
	}

	if ( ! empty( $_POST['d_o_b'] ) ) {
		update_user_meta( $user_id, 'd_o_b', trim( $_POST['d_o_b'] ) );
	}

	if ( ! empty( $_POST['phone_number'] ) ) {
		update_user_meta( $user_id, 'phone_number', trim( $_POST['phone_number'] ) );
	}

	if ( ! empty( $_POST['address'] ) ) {
		update_user_meta( $user_id, 'address', trim( $_POST['address'] ) );
	}

	if ( ! empty( $_POST['city'] ) ) {
		update_user_meta( $user_id, 'city', trim( $_POST['city'] ) );
	}

	if ( ! empty( $_POST['state'] ) ) {
		update_user_meta( $user_id, 'state', trim( $_POST['state'] ) );
	}

	if ( ! empty( $_POST['country'] ) ) {
		update_user_meta( $user_id, 'country', trim( $_POST['country'] ) );
	}

	if ( ! empty( $_POST['treatment_status'] ) ) {
		update_user_meta( $user_id, 'treatment_status', trim( $_POST['treatment_status'] ) );
	}

	if ( ! empty( $_POST['type'] ) ) {
		update_user_meta( $user_id, 'type', trim( $_POST['type'] ) );
	}

	if ( ! empty( $_POST['stage'] ) ) {
		update_user_meta( $user_id, 'stage', trim( $_POST['stage'] ) );
	}

	if ( ! empty( $_POST['experience'] ) ) {
		update_user_meta( $user_id, 'experience', trim( $_POST['experience'] ) );
	}

	if ( ! empty( $_POST['feelings'] ) ) {
		update_user_meta( $user_id, 'feelings', trim( $_POST['feelings'] ) );
	}

	if ( ! empty( $_POST['purpose'] ) ) {
		update_user_meta( $user_id, 'purpose', trim( $_POST['purpose'] ) );
	}
}
function kindheart_registration_errors( $errors, $sanitized_user_login, $user_email ) {
	if ( empty( $_POST['first_name'])  ) {
		$errors->add( 'first_name', __( '<strong>ERROR</strong>: First name is missing', 'wedevs' ) );
	}
	if (empty( $_POST['last_name'])  ) {
		$errors->add( 'last_name', __( '<strong>ERROR</strong>: Lastname name is missing', 'wedevs' ) );
	}
	if (empty( $_POST['gender'])  ) {
		$errors->add( 'gender', __( '<strong>ERROR</strong>: Gender is missing', 'wedevs' ) );
	}
	if (empty( $_POST['d_o_b'])  ) {
		$errors->add( 'd_o_b', __( '<strong>ERROR</strong>: Date of Birth is missing', 'wedevs' ) );
	}
	if (empty( $_POST['phone_number'])  ) {
		$errors->add( 'phone_number', __( '<strong>ERROR</strong>: Phone number is missing', 'wedevs' ) );
	}
	if (empty( $_POST['address'])  ) {
		$errors->add( 'address', __( '<strong>ERROR</strong>: Address is missing', 'wedevs' ) );
	}
	if (empty( $_POST['city'])  ) {
		$errors->add( 'city', __( '<strong>ERROR</strong>: City is missing', 'wedevs' ) );
	}
	if (empty( $_POST['state'])  ) {
		$errors->add( 'state', __( '<strong>ERROR</strong>: State is missing', 'wedevs' ) );
	}
	if (empty( $_POST['country'])  ) {
		$errors->add( 'country', __( '<strong>ERROR</strong>: Country is missing', 'wedevs' ) );
	}
	if (empty( $_POST['treatment_status'])  ) {
		$errors->add( 'treatment_status', __( '<strong>ERROR</strong>: Treatment status is missing', 'wedevs' ) );
	}
	if (empty( $_POST['type'])  ) {
		$errors->add( 'type', __( '<strong>ERROR</strong>: Cancer type is missing', 'wedevs' ) );
	}
	if (empty( $_POST['stage'])  ) {
		$errors->add( 'stage', __( '<strong>ERROR</strong>: Stage of cancer is missing', 'wedevs' ) );
	}
	if (empty( $_POST['feelings'])  ) {
		$errors->add( 'feelings', __( '<strong>ERROR</strong>: Current feeling is missing', 'wedevs' ) );
	}
	if (empty( $_POST['experience'])  ) {
		$errors->add( 'experience', __( '<strong>ERROR</strong>: Support group experience is missing', 'wedevs' ) );
	}
	if (empty( $_POST['purpose'])  ) {
		$errors->add( 'purpose', __( '<strong>ERROR</strong>: Purpose of joining is missing', 'wedevs' ) );
	}

	return $errors;
}
function kindheart_registration_form() {
	?>
	<p>
		<label for="first_name">
			<?php esc_html_e( 'First Name', 'first_name' ) ?> <br/>
			<input type="text" class="regular_text" name="first_name" id="first_name" />
		</label>
	</p>
	<p>
		<label for="last_name">
			<?php esc_html_e( 'Last Name', 'last_name' ) ?> <br/>
			<input type="text" class="regular_text" name="last_name" id="last_name" />
		</label>
	</p>
	<p>
		<label for="gender">
			<?php esc_html_e( 'Gender', 'gender' ) ?> <br/>
			<select class="regular_text" name="gender" id="gender" >
				<option value="" selected>Select One</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
		</label>
	</p>
	<p>
		<label for="d_o_b">
			<?php esc_html_e( 'Date of Birth', 'd_o_b' ) ?> <br/>
			<input type="date" class="regular_text" name="d_o_b" id="d_o_b" />
		</label>
	</p>
	<p>
		<label for="phone_number">
			<?php esc_html_e( 'Phone Number', 'phone_number' ) ?> <br/>
			<input type="tel" class="regular_text" name="phone_number" id="phone_number" />
		</label>
	</p>
	<p>
		<label for="address">
			<?php esc_html_e( 'Address', 'address' ) ?> <br/>
			<input type="text" class="regular_text" name="address" id="address" />
		</label>
	</p>
	<p>
		<label for="city">
			<?php esc_html_e( 'City', 'city' ) ?> <br/>
			<input type="text" class="regular_text" name="city" id="city" />
		</label>
	</p>
	<p>
		<label for="state">
			<?php esc_html_e( 'State', 'state' ) ?> <br/>
			<input type="text" class="regular_text" name="state" id="state" />
		</label>
	</p>
	<p>
		<label for="country">
			<?php esc_html_e( 'Country', 'country' ) ?> <br/>
			<input type="text" class="regular_text" name="country" id="country" />
		</label>
	</p>
	<p>
		<label for="treatment_status">
			<?php esc_html_e( 'Treatment Status', 'treatment_status' ) ?> <br/>
			<select class="regular_text" name="treatment_status" id="treatment_status" >
				<option value="" selected>Select One</option>
				<option value="Considering Treatment">Considering Treatment</option>
				<option value="Active Treatment">Active Treatment</option>
				<option value="Post Treatment">Post Treatment</option>
				<option value="Palliative">Palliative</option>
				<option value="Survivor ">Survivor </option>
			</select>
		</label>
	</p>
	<p>
		<label for="type">
			<?php esc_html_e( 'Type of Cancer', 'type' ) ?> <br/>
			<input type="text" class="regular_text" name="type" id="type" />
		</label>
	</p>
	<p>
		<label for="stage">
			<?php esc_html_e( 'Stage of Cancer', 'stage' ) ?> <br/>
			<input type="text" class="regular_text" name="stage" id="stage" />
		</label>
	</p>
	<p>
		<label for="feelings">
			<?php esc_html_e( 'How you are feeling and how you are coping at this time', 'feelings' ) ?> <br/>
			<textarea class="regular_text" name="feelings" id="feelings"></textarea>
		</label>
	</p>
	<p>
		<label for="experience">
			<?php esc_html_e( 'Have you ever been involved in any support group? if yes, tell us your
experience?', 'country' ) ?> <br/>
			<textarea class="regular_text" name="experience" id="experience"></textarea>
		</label>
	</p>
	<p>
		<label for="purpose">
			<?php esc_html_e( 'What do you intend to gain from participating in this online support group?', 'purpose' ) ?> <br/>
			<textarea class="regular_text" name="purpose" id="purpose"></textarea>
		</label>
	</p>
	<?php
}

new mainKinHeartClass;
?>