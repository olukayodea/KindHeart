<?php
class planningCommittee extends commonMethods {
    public static $return = array();
    public static $list = array();
    public static $viewData = array();
    public static $message;
    public static $error_message;
    public static $successResponse = array("status" => 200, "message" => "OK");
    public static $notFound = array("status" => 404, "message" => "Not Found");
    public static $NotModified = array("status" => 304, "message" => "Not Modified");
    public static $Unauthorized = array("status" => 401, "message" => "Unauthorized");
    public static $NotAcceptable = array("status" => 406, "message" => "Not Acceptable");
    public static $BadReques = array("status" => 400, "message" => "Bad Reques");
    public static $internalServerError = array("status" => 500, "message" => "Internal Server Error");
    
    public static function add_api($request) {
        $parameters = $request->get_params();
        if (!$parameters) {
            self::$BadReques['additional_message'] = "some input values are missing";
            self::$return = self::$BadReques;
            return self::$return;
        }

        $add = self::create($parameters);
        if ($add) {
            self::$successResponse['additional_message'] = "planning Committee saved successfully";
            self::$return = self::$successResponse;
            self::$return['ID'] = $add;
            error_log("The Planning Committee API was successful");
        } else {
            self::$BadReques['additional_message'] = "there was an error performing this action";
            self::$return = self::$BadReques;
            error_log("The Planning Committee API was not successful");
        }

        return self::$return;
    }

    static function manage() {
        if ((isset($_REQUEST['open'])) || (isset($_REQUEST['edit']))) {
            if (isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
                self::$viewData = self::listOne($id);
            }
        } else if (isset($_POST['submit'])) {
            unset($_POST['submit']);
            $add = self::create($_POST);
            if ($add) {
                self::$message = "Committee member created successfully";
                self::$viewData = array();
            } else {
                self::$error_message = "there was an error performing this action";
            }
        }
        self::$list = self::getList();
		include_once(KH_PLUGIN_DIR."includes/pages/planningCommittee/manage.php");
    }

    static function create($array) {
        return self::insert(kh_table_prefix."planningCommittee", $array);
    }

    static function modifyOne($tag, $value, $id, $ref="ref") {
        return self::updateOne(kh_table_prefix."planningCommittee", $tag, $value, $id, $ref);
    }
    
    static function getList($start=false, $limit=false, $order="ref", $dir="DESC", $type="list") {
        return self::lists(kh_table_prefix."planningCommittee", $start, $limit, $order, $dir, false, $type);
    }

    static function getSingle($name, $tag="patient_id", $ref="ref") {
        return self::getOneField(kh_table_prefix."planningCommittee", $name, $ref, $tag);
    }

    static function listOne($id) {
        return self::getOne(kh_table_prefix."planningCommittee", $id, "ref");
    }

    static function getSortedList($id, $tag, $tag2 = false, $id2 = false, $tag3 = false, $id3 = false, $order = 'ref', $dir = "ASC", $logic = "AND", $start = false, $limit = false) {
        return self::sortAll(kh_table_prefix."planningCommittee", $id, $tag, $tag2, $id2, $tag3, $id3, $order, $dir, $logic, $start, $limit);
    }

    public function initialize_table() {
        //create database
        $query = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".kh_table_prefix."planningCommittee` (
            `ref` INT NOT NULL AUTO_INCREMENT, 
            `email` varchar(255) NULL,
            `full_name` varchar(255) NULL,
            `phone` varchar(50) NULL, 
            `sex` varchar(10) NULL,
            `dob` varchar(10) NULL,
            `address` varchar(255) NULL,
            `qualification` varchar(255) NULL,
            `occupation` varchar(255) NULL,
            `employer` varchar(50) NULL,
            `expectations` text NULL,
            `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `modify_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`ref`)
        ) ENGINE = InnoDB DEFAULT CHARSET=utf8;";

        $this->query($query);
    }

    public function clear_table() {
        //clear database
        $query = "TRUNCATE `".DB_NAME."`.`".kh_table_prefix."planningCommittee`";

        $this->query($query);
    }

    public function delete_table() {
        //clear database
        $query = "DROP TABLE IF EXISTS `".DB_NAME."`.`".kh_table_prefix."planningCommittee`";

        $this->query($query);
    }
}
?>