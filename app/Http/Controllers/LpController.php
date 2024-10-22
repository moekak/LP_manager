<?php
require_once dirname(__FILE__) . "/../../Services/utils/Security.php";
require_once dirname(__FILE__) . "/../../Models/GroupModel.php";
require_once dirname(__FILE__) . "/../../Models/LpModel.php";
require_once dirname(__FILE__) . "/../../Models/LpScreenshotModel.php";
require_once dirname(__FILE__) . "/../../Models/CategoryModel.php";
require_once dirname(__FILE__) . "/../Requests/LpRequest.php";
require_once dirname(__FILE__) . "/../../Services/lp/LpValidation.php";
require_once dirname(__FILE__) . "/../../Services/category/CategoryValidation.php";
require_once dirname(__FILE__) . "/../../Services/utils/DatabaseConnection.php";
require_once dirname(__FILE__) . "/../../Services/screenshot/PythonRequestHandler.php";

class LpController
{
    public $lp_model;
    public $group_model;
    public $category_modal;
    public $screenshot;
    public $lp_screenshot_model;
    public $pdo;

    public function __construct(){
        $this->lp_model = new LpModel();
        $this->group_model = new GroupModel();
        $this->lp_screenshot_model = new LpScreenshotModel();
        $this->screenshot = new PythonRequestHandler();
        $this->category_modal = new CategoryModel();

        $dbConnection = DatabaseConnection::getInstance();
        // PDOインスタンス（データベース接続）を取得
        $this->pdo = $dbConnection->getConnection();
    }

    public function index(){

        if(!isset($_SESSION['csrf_token'])){
            header("Location:" . ROUTE_PATH . "category");
            exit();
        }

        $category_id = "";
        if(isset($_GET["id"])){
            $category_id = $_GET["id"];
        }
        
        // バリデーションチェック
        CategoryValidation::indexValidation($category_id);
    
        $_SESSION["category_id"] = $category_id;
        $_SESSION["group"] = $this->group_model->selectGroupData(intval($category_id));
        $_SESSION["lp"] = $this->lp_model->selectLPdataWithGroup($category_id);
        $_SESSION["screenshots"] = $this->lp_screenshot_model->selectScreenshotWithGroup($category_id);
        $_SESSION["category"] = $this->category_modal->selectSpecificCategory($category_id);
        require_once dirname(__FILE__) . "/../../../src/views/index.php";
    }


    public function create(){
        // バリデーションチェック
        LpValidation::createValidation();

        $domain = DataValidation::sanitizeInput($_POST["domain"]);
        $formatted_domain = filter_var($domain, FILTER_VALIDATE_URL) ? parse_url($domain)["host"] . (isset(parse_url($domain)["path"]) ? parse_url($domain)["path"] : '') . (isset(parse_url($domain)["query"]) ? '?' . parse_url($domain)["query"] : '') : $domain;
        $formtted_domain = rtrim($formatted_domain, '/');

        echo $formtted_domain;


        $data = [
            "group_id" => intval($_POST["group"]),
            // "lp_title" => DataValidation::sanitizeInput($_POST["lp_title"]),
            "domain" => $formtted_domain,
            "content" => DataValidation::sanitizeInput($_POST["content"]),
        ];

        $lp_id = $this->lp_model->insertLPdata($data);



            $sendData = [
                "lp_id" => $lp_id,
                "group_id" => intval($_POST["group"]),
                "domain" => $domain
            ];

            if($this->screenshot->sendRequest($sendData)){
                $_SESSION["success"] = SUCCESS_CREATE_LP;
                header("Location:" . ROUTE_PATH . "category/?id=" . $_SESSION["category_id"]);
                exit;
            }else{
                $this->lp_model->deletLP($lp_id);
                $_SESSION["saved_data"] = $_POST;
                SystemFeedback::handleError("400_lp", ERROR_SCREENSHOT, "category/?id=" .$_SESSION["category_id"]);
                throw new Exception("Failed to send screenshot request.");
            }
        
        }

        



    public function edit(){
        
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

        

                $formtted_domain = "";

                if(isset($lp["domain"])){

                    $domain = DataValidation::sanitizeInput($lp["domain"]);
                    $formatted_domain = filter_var($domain, FILTER_VALIDATE_URL) ? parse_url($domain)["host"] . (isset(parse_url($domain)["path"]) ? parse_url($domain)["path"] : '') . (isset(parse_url($domain)["query"]) ? '?' . parse_url($domain)["query"] : '') : $domain;
                    $formtted_domain = rtrim($formatted_domain, '/');

                }
                

                $data = [
                    "lp_title" => isset($lp["lp_title"]) ? DataValidation::sanitizeInput($lp["lp_title"]) : "",
                    "domain" => $formtted_domain,
                    "content" => isset($lp["content"]) ? DataValidation::sanitizeInput($lp["content"]) : "",
                    "lp_id" => intval($lp["lp_id"]),
                ];
 
        

                // LPの更新処理
                $this->lp_model->updateLPData($data);
            }
        }

        $_SESSION["success"] = SUCCESS_EDIT_LP;
        header("Location:" . ROUTE_PATH . "category/?id=" . $_SESSION["category_id"]);
        exit;
    }

    public function delete(){
        LpValidation::deleteValidation($_POST["lp_id"]);

        $this->lp_model->deleteLpData(intval($_POST["lp_id"]));
        $_SESSION["success"] = SUCCESS_DELETE_LP;
        header("Location:" . ROUTE_PATH . "category/?id=" . $_SESSION["category_id"]);
        exit;
    }
}