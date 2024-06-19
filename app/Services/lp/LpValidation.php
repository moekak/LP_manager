<?php
require_once dirname(__FILE__) . "/../../Http/Requests/LpRequest.php";
require_once dirname(__FILE__) . "/../utils/SystemFeedback.php";

class LpValidation
{
    public static function createValidation()
    {
        // CSRFトークンチェック
        if (!LpRequest::csrfError()) {
            SystemFeedback::handleError("403", ERROR_403, "error");
        }
        // フォームバリデーション
        if (!LpRequest::formValidation($_POST)) {
            SystemFeedback::handleError("400", ERROR_400, "index");
        }

        // すでにドメインが登録されてるかチェック
        if (!LpRequest::isDomainAlreadyExisted()) {
            SystemFeedback::handleError("400", ERROR_400_DATAEXISTED, "index");
        }
        // 選択されたグループが存在するかチェック
        if (!LpRequest::isGroupIDExisted()) {
            SystemFeedback::handleError("400", ERROR_400, "index");
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
                // フォームバリデーション
                if (!LpRequest::checkMaxLength($lp) || !LpRequest::isValidID($lp["lp_id"])) {
            
                    SystemFeedback::handleError("400", ERROR_400, "index");
                }
                // LPIDが存在するかチェック
                if (!LpRequest::isLpIDExisted($lp["lp_id"])) {
                    SystemFeedback::handleError("400", ERROR_400, "index");
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
            SystemFeedback::handleError("400", ERROR_400, "index");
        }
        
        // LPIDが存在するかチェック
        if (!LpRequest::isLpIDExisted($data)) {
            SystemFeedback::handleError("400", ERROR_400, "index");
        }
    }
}