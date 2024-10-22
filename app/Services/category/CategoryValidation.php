<?php
require_once dirname(__FILE__) . "/../../Http/Requests/CategoryRequest.php";
require_once dirname(__FILE__) . "/../utils/SystemFeedback.php";

class CategoryValidation
{
    public static function createValidation()
    {
        // CSRFトークンチェック
        if(!CategoryRequest::csrfError()){
            SystemFeedback::handleError("403", ERROR_403, "error");
        }
        // フォームバリデーション
        if (!CategoryRequest::formValidation()) {
            $_SESSION["saved_categoryData"] = $_POST;
            SystemFeedback::handleError("400_category", ERROR_400, "category");
        }
    }
    public static function indexValidation($id)
    {
        // フォームバリデーション
        if (!CategoryRequest::isValidID($id) || !CategoryRequest::isCategoryIDExisted($id)) {
            SystemFeedback::handleError("404", ERROR_404, "error");
        }
    }


    public static function editValidation($id){
         // CSRFトークンチェック
         if(!CategoryRequest::csrfError()){
            SystemFeedback::handleError("403", ERROR_403, "error");
        }
        // フォームバリデーション
       
        if (!CategoryRequest::formValidation()) {
            $_SESSION["saved_categoryData"] = $_POST;
            SystemFeedback::handleError("400_category", ERROR_400, "category");
        }
        if (!CategoryRequest::isValidID($id) || !CategoryRequest::isCategoryIDExisted($id)) {
            SystemFeedback::handleError("403", ERROR_403, "error");
        }


    }


}