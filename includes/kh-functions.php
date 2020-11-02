<?php
class mainKibdHeart {
    //create the API route
    public static function apiRoutes() {
        //url = https://lekkihill.com/wp-json/api/benefitiary;
        register_rest_route( 'api', 'benefitiary',array(
            'methods'  => 'POST',
            'callback' => array("benefitiary",'add_api')
        ));
        //url = https://lekkihill.com/wp-json/api/volunteer;
        register_rest_route( 'api', 'volunteer',array(
            'methods'  => 'POST',
            'callback' => array("volunteer",'add_api')
        ));
        //url = https://lekkihill.com/wp-json/api/planningCommittee;
        register_rest_route( 'api', 'planningCommittee',array(
            'methods'  => 'POST',
            'callback' => array("planningCommittee",'add_api')
        ));
    }
    
    //get all the  menus  and  submenu
    public static function kh_add_menu() {
        add_menu_page(
            "Planning Committee",
            "Planning Committee",
            "kh_manage_planning_committee",
            "kh-manage-planning-committee",
            array('planningCommittee','manage'),
            "dashicons-format-aside",'2.2.9',
            4
        );
        add_menu_page(
            "Beneficiaries",
            "Beneficiaries",
            "kh_manage_benefitiary",
            "kh-manage-benefitiary",
            array('benefitiary','manage'),
            "dashicons-money-alt",'2.2.9',
            3
        );
        add_menu_page(
            "Groups",
            "Groups",
            "kh_manage_group",
            "kh-manage-group",
            array('group','manage'),
            "dashicons-groups",'2.2.9',
            2
        );

        add_menu_page(
            "Volunteer",
            "Volunteer",
            "kh_manage_volunteer",
            "kh-manage-volunteer",
            array('volunteer','manage'),
            "dashicons-buddicons-groups",'2.2.9',
            1
        );

        // $user_info = get_user_meta(3);
        // echo "<pre>";
        // print_r($user_info);
    }

    public static function kh_install () {
        // create the tables
        $planningCommittee  = new planningCommittee;
        $benefitiary        = new benefitiary;
        $volunteer          = new volunteer;

        $planningCommittee->initialize_table();
        $benefitiary->initialize_table();
        $volunteer->initialize_table();
        // create the  admin role

		add_role(
			'kindHeart_admin',
			__( 'KindHeart Admin' ),
			array(
				'read'		=> true
			)
        );
        
        $kindHeart_admin = get_role( "kindHeart_admin" );
        $kindHeart_admin->add_cap( 'kh_manage_volunteer' );
        $kindHeart_admin->add_cap( 'kh_manage_group' );
        $kindHeart_admin->add_cap( 'kh_manage_planning_committee' );
        $kindHeart_admin->add_cap( 'kh_manage_benefitiary' );
        $kindHeart_admin->add_cap( 'manage_woocommerce' );
        $kindHeart_admin->add_cap( 'view_woocommerce_reports' );

		add_role(
			'kindHeart_store_admin',
			__( 'KindHeart Store Manager' ),
			array(
				'read'		=> true
			)
        );
        
        $kindHeart_manager = get_role( "kindHeart_store_admin" );
        $kindHeart_manager->add_cap( 'manage_woocommerce' );
        $kindHeart_manager->add_cap( 'view_woocommerce_reports' );

		add_role(
			'kindHeart_group',
			__( 'KindHeart Groups' ),
			array(
				'read'		=> true
			)
        );
        
        $kindHeart_group = get_role( "kindHeart_group" );
        $kindHeart_group->add_cap( 'kh_manage_group' );

		add_role(
			'kindHeart_planning_committee',
			__( 'KindHeart Planning Committee Admin' ),
			array(
				'read'		=> true
			)
        );
        
        $kindHeart_planning = get_role( "kindHeart_planning_committee" );
        $kindHeart_planning->add_cap( 'kh_manage_planning_committee' );

		add_role(
			'kindHeart_voluteer',
			__( 'KindHeart Volunteer' ),
			array(
				'read'		=> true
			)
        );
        
        $kindHeart_volunteer = get_role( "kindHeart_voluteer" );
        $kindHeart_volunteer->add_cap( 'kh_manage_volunteer' );

		add_role(
			'kindHeart_benefitiary',
			__( 'KindHeart Benefitiary Admin' ),
			array(
				'read'		=> true
			)
        );
        
        $kindHeart_benefitiary = get_role( "kindHeart_benefitiary" );
        $kindHeart_benefitiary->add_cap( 'kh_manage_benefitiary' );

		//add roles to admin
		$administrator		= get_role('administrator');
        $administrator->add_cap( 'kh_manage_volunteer' );
        $administrator->add_cap( 'kh_manage_group' );
        $administrator->add_cap( 'kh_manage_planning_committee' );
        $administrator->add_cap( 'kh_manage_benefitiary' );
    }

    public static function kh_deactivate() {
        // remove the admin roles
        self::remove_cap();
        self::remove_role();
    }

    public static function kh_uninstall() {
        // delete the tables
    }

    // Remove the plugin-specific custom capability
    private static function remove_cap() {
        $roles = get_editable_roles();
        foreach ($GLOBALS['wp_roles']->role_objects as $key => $role) {
            if (isset($roles[$key]) && $role->has_cap('kh_manage_volunteer')) {
                $role->remove_cap('kh_manage_volunteer');
            }
            if (isset($roles[$key]) && $role->has_cap('kh_manage_group')) {
                $role->remove_cap('kh_manage_group');
            }
            if (isset($roles[$key]) && $role->has_cap('kh_manage_planning_committee')) {
                $role->remove_cap('kh_manage_planning_committee');
            }
            if (isset($roles[$key]) && $role->has_cap('kh_manage_benefitiary')) {
                $role->remove_cap('kh_manage_benefitiary');
            }
        }
    }
	
	//remove plugin specific roles
	private static function remove_role() {
		if ( get_role('kindHeart_admin') ){
			remove_role( 'kindHeart_admin' );
		}
		if ( get_role('kindHeart_store_admin') ){
			remove_role( 'kindHeart_store_admin' );
		}
		if ( get_role('kindHeart_group') ){
			remove_role( 'kindHeart_group' );
		}
		if ( get_role('kindHeart_planning_committee') ){
			remove_role( 'kindHeart_planning_committee' );
		}
		if ( get_role('kindHeart_voluteer') ){
			remove_role( 'kindHeart_voluteer' );
		}
		if ( get_role('kindHeart_benefitiary') ){
			remove_role( 'kindHeart_benefitiary' );
		}
    }
    
	//external scripts and CSS
	public static function admin_styles_and_script() {
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

	public static function kindheart_save_data( $user_id ) {
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
    
	public static function kindheart_registration_errors( $errors, $sanitized_user_login, $user_email ) {
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
    
	public static function kindheart_registration_form() {
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
				<?php esc_html_e( 'Have you ever been involved in any support group? if yes, tell us your experience?', 'country' ) ?> <br/>
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
}
?>