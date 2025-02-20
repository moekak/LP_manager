<?php 
require_once dirname(__FILE__) . "/../Requests/GroupRequest.php";
require_once dirname(__FILE__) . "/../../../src/config/conf.php";
require_once dirname(__FILE__) . "/../../Models/GroupModel.php";
require_once dirname(__FILE__) . "/../../Services/utils/DataValidation.php";
require_once dirname(__FILE__) . "/../../Services/group/GroupValidation.php";


class GroupController{
    public $group_model;

    public function __construct(){
        $this->group_model = new GroupModel();
    }

    public function create(){
        // バリデーションチェック
        GroupValidation::createValidation(intval($_SESSION["category_id"]));
        

       
        // データの挿入
        $title = DataValidation::sanitizeInput($_POST["group_title"]);
        $category_id = intval($_SESSION["category_id"]);
        $this->group_model->insertGroupData($title, $category_id);

        $_SESSION["success"] = SUCCESS_CREATE_GROUP;
        header("Location:" . ROUTE_PATH . "category/?id=" . $_SESSION["category_id"]);
        exit;
    }

    public function edit(){
        // バリデーションチェック
        GroupValidation::editValidation($_POST["group_id"]);

        $title   = DataValidation::sanitizeInput($_POST["group_title"]);
        $group_id = intval($_POST["group_id"]);

        $this->group_model->updateGroupData($group_id, $title);
        $_SESSION["success"] = SUCCESS_EDIT_GROUP;
        header("Location:" . ROUTE_PATH . "category/?id=" . $_SESSION["category_id"]);
        exit;
    }
}