<?php
require_once dirname(__FILE__) . "/../../Services/category/CategoryValidation.php";
require_once dirname(__FILE__) . "/../../Models/CategoryModel.php";
require_once dirname(__FILE__) . "/../../Services/utils/DataValidation.php";

class CategoryController{
    public $category_model;

    public function __construct()
    {
        $this->category_model = new CategoryModel();
    }
    public function index(){
        Security::generateCsrfToken();

        $_SESSION["categories"] = $this->category_model->selectCategories();
        require_once dirname(__FILE__) . "/../../../src/views/group.php";
    }
    public function create(){
        // バリデーションチェック
        CategoryValidation::createValidation();

        // データの挿入
        $title = DataValidation::sanitizeInput($_POST["category"]);
        $this->category_model->insertCategory($title);
        $_SESSION["success"] = SUCCESS_CREATE_CATEGORY;
        header("Location:" . ROUTE_PATH . "category");
        exit;

    }


    public function edit(){


               

        $id = "";
        if(isset($_POST["category_id"])){
            $id = $_POST["category_id"];
        }

         // バリデーションチェック
         CategoryValidation::editValidation($id);

        $title = DataValidation::sanitizeInput($_POST["category"]);
        $this->category_model->updateCategoryData($id, $title);
        $_SESSION["success"] = SUCCESS_EDIT_CATEGORY;
        header("Location:" . ROUTE_PATH . "category");
        exit;


    }
}