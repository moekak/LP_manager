<?php
require_once dirname(__FILE__) . "/../../Services/utils/Security.php";
require_once dirname(__FILE__) . "/../../Models/GroupModel.php";
require_once dirname(__FILE__) . "/../../Models/LpModel.php";
require_once dirname(__FILE__) . "/../Requests/LpRequest.php";
require_once dirname(__FILE__) . "/../../Services/lp/LpValidation.php";

class LpController
{
    public $lp_model;
    public $group_model;
    public function __construct()
    {
        $this->lp_model = new LpModel();
        $this->group_model = new GroupModel();
    }
    public function index()
    {
        Security::generateCsrfToken();
        $_SESSION["group"] = $this->group_model->selectGroupData();
        $_SESSION["lp"] = $this->lp_model->selectLPdataWithGroup();
        require_once dirname(__FILE__) . "/../../../src/views/index.php";
    }

    public function create()
    {
        // バリデーションチェック
        LpValidation::createValidation();

        $data = [
            "group_id" => intval($_POST["group"]),
            "lp_title" => DataValidation::sanitizeInput($_POST["lp_title"]),
            "domain" => DataValidation::sanitizeInput($_POST["domain"]),
            "content" => DataValidation::sanitizeInput($_POST["content"]),
        ];

        $this->lp_model->insertLPdata($data);
        $_SESSION["success"] = SUCCESS_CREATE_LP;
        header("Location:" . ROUTE_PATH . "index");
        exit;
    }

    public function edit()
    {
        $postData = $_POST;
        unset($postData['csrf_token']);
        $lp_data = [];

        foreach ($postData as $data) {
            $lp_data[] = json_decode($data, true);
        }
       
        // バリデーションチェック
        LpValidation::editValidation($lp_data);

        foreach ($lp_data as $lp) {
            if (isset($lp)) {
                $data = [
                    "lp_title" => DataValidation::sanitizeInput($lp["lp_title"]),
                    "domain" => DataValidation::sanitizeInput($lp["domain"]),
                    "content" => DataValidation::sanitizeInput($lp["content"]),
                    "lp_id" => intval($lp["lp_id"]),
                ];

                // LPの更新処理
                $this->lp_model->updateLPData($lp);
            }
        }
        $_SESSION["success"] = SUCCESS_EDIT_LP;
        header("Location:" . ROUTE_PATH . "index");
        exit;
    }

    public function delete(){
        LpValidation::deleteValidation($_POST["lp_id"]);

        $this->lp_model->deleteLpData(intval($_POST["lp_id"]));
        $_SESSION["success"] = SUCCESS_DELETE_LP;
        header("Location:" . ROUTE_PATH . "index");
        exit;
    }
}