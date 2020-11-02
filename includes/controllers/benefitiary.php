<?php
class benefitiary extends commonMethods {
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
            self::$successResponse['additional_message'] = "Benefitiary saved successfully";
            self::$return = self::$successResponse;
            self::$return['ID'] = $add;
        } else {
            self::$BadReques['additional_message'] = "there was an error performing this action";
            self::$return = self::$BadReques;
        }

        return self::$return;
    }

    static function manage() {
        if ((isset($_REQUEST['open'])) || (isset($_REQUEST['edit']))) {
            if (isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
                self::$viewData = self::listOne($id);
            }
        } else if ($_POST['submit']) {
            unset($_POST['submit']);
            $add = self::create($_POST);
            if ($add) {
                self::$message = "Benefitiary added created successfully";
                self::$viewData = array();
            } else {
                self::$error_message = "there was an error performing this action";
            }
        }
        self::$list = self::getList();
		include_once(KH_PLUGIN_DIR."includes/pages/benefitiary/manage.php");
    }

    static function create($array) {
        return self::insert(kh_table_prefix."benefitiary", $array);
    }

    static function modifyOne($tag, $value, $id, $ref="ref") {
        return self::updateOne(kh_table_prefix."benefitiary", $tag, $value, $id, $ref);
    }
    
    static function getList($start=false, $limit=false, $order="ref", $dir="DESC", $type="list") {
        return self::lists(kh_table_prefix."benefitiary", $start, $limit, $order, $dir, false, $type);
    }

    static function getSingle($name, $tag="patient_id", $ref="ref") {
        return self::getOneField(kh_table_prefix."benefitiary", $name, $ref, $tag);
    }

    static function listOne($id) {
        return self::getOne(kh_table_prefix."benefitiary", $id, "ref");
    }

    static function getSortedList($id, $tag, $tag2 = false, $id2 = false, $tag3 = false, $id3 = false, $order = 'ref', $dir = "ASC", $logic = "AND", $start = false, $limit = false) {
        return self::sortAll(kh_table_prefix."benefitiary", $id, $tag, $tag2, $id2, $tag3, $id3, $order, $dir, $logic, $start, $limit);
    }

    public function initialize_table() {
        //create database
        $query = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".kh_table_prefix."benefitiary` (
            `ref` INT NOT NULL AUTO_INCREMENT, 
            `email` varchar(255) NULL,
            `full_name` varchar(255) NULL,
            `sex` varchar(10) NULL,
            `dob` varchar(10) NULL,
            `phone` varchar(50) NULL, 
            `occupation` varchar(50) NULL,
            `employer` varchar(50) NULL,
            `position` varchar(50) NULL,
            `work_address` varchar(255) NULL,
            `cancer_type` varchar(255) NULL,
            `cancer_stage` varchar(255) NULL,
            `hospital` varchar(255) NULL,
            `hospital_details` varchar(255) NULL,
            `extra_message` varchar(255) NULL,
            `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `modify_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`ref`)
        ) ENGINE = InnoDB DEFAULT CHARSET=utf8;";

        $this->query($query);
    }

    public function clear_table() {
        //clear database
        $query = "TRUNCATE `".DB_NAME."`.`".kh_table_prefix."benefitiary`";

        $this->query($query);
    }

    public function delete_table() {
        //clear database
        $query = "DROP TABLE IF EXISTS `".DB_NAME."`.`".kh_table_prefix."benefitiary`";

        $this->query($query);
    }
}
?>