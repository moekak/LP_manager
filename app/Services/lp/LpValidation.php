<?php
require_once dirname(__FILE__) . "/../../Http/Requests/LpRequest.php";
require_once dirname(__FILE__) . "/../utils/SystemFeedback.php";

class LpValidation
{
    public static function createValidation()
    {
        // CSRFトークンチェック
        if (!LpRequest::csrfError()) {
            $_SESSION["saved_data"] = $_POST;
            SystemFeedback::handleError("403", ERROR_403, "error");
        }
        // フォームバリデーション
        if (!LpRequest::formValidation($_POST)) {
            $_SESSION["saved_data"] = $_POST;
            SystemFeedback::handleError("400_lp", ERROR_400, "category/?id=" .$_SESSION["category_id"]);
        }

        // すでにドメインが登録されてるかチェック
        if (!LpRequest::isDomainAlreadyExisted($_POST)) {
            $_SESSION["saved_data"] = $_POST;
            SystemFeedback::handleError("400_lp", ERROR_400_DATAEXISTED, "category/?id=" .$_SESSION["category_id"]);
        }
        // 選択されたグループが存在するかチェック
        if (!LpRequest::isGroupIDExisted()) {
            $_SESSION["saved_data"] = $_POST;
            SystemFeedback::handleError("400_lp", ERROR_400, "category/?id=" .$_SESSION["category_id"]);
        }
    }

    public static function editValidation($data)
    {
        // CSRFトークンチェック
        if (!LpRequest::csrfError()) {
            SystemFeedback::handleError("403", ERROR_403, "error");
        }
   
        foreach ($data as $lp) {
            if(isset($lp)){
          
                if (!LpRequest::checkMaxLength($lp) || !LpRequest::isValidID($lp["lp_id"]) || (isset($lp["domain"]) ? !LpRequest::isDomainAlreadyExisted($lp) : "")) { 
                    SystemFeedback::handleError("400_lp_edit", ERROR_400, "error");
                }
                // LPIDが存在するかチェック
                if (!LpRequest::isLpIDExisted($lp["lp_id"])) {
                    SystemFeedback::handleError("400_lp_edit", ERROR_400, "error");
                }
            }
        }
    }

    public static function deleteValidation($data)
    {
        // CSRFトークンチェック
        if (!LpRequest::csrfError()) {
            SystemFeedback::handleError("403", ERROR_403, "error");
        }
        // フォームバリデーション
        if (!isset($data) || !DataValidation::isValidID($data)) {
            SystemFeedback::handleError("400_lp", ERROR_400, "error");
        }
        
        // LPIDが存在するかチェック
        if (!LpRequest::isLpIDExisted($data)) {
            SystemFeedback::handleError("400_lp", ERROR_400, "error");
        }
    }
}