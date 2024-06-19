<?php
require_once dirname(__FILE__) . "/../../Http/Requests/GroupRequest.php";
require_once dirname(__FILE__) . "/../utils/SystemFeedback.php";

class GroupValidation
{
    public static function createValidation()
    {
        // CSRFトークンチェック
        if(!GroupRequest::csrfError()){
            SystemFeedback::handleError("403", ERROR_403, "error");
        }
        // フォームバリデーション
        if (!GroupRequest::formValidation()) {
            SystemFeedback::handleError("400", ERROR_400, "index");
        }
    }

    public static function editValidation($data)
    {
        // CSRFトークンチェック
        if(!GroupRequest::csrfError()){
            SystemFeedback::handleError("403", ERROR_403, "error");
        }
        // フォームバリデーション
        if (!GroupRequest::formValidation()) {
            SystemFeedback::handleError("400", ERROR_400, "index");
        }
        // データ型チェック
        if (!GroupRequest::isValidID($data)) {
            SystemFeedback::handleError("400", ERROR_400, "index");
        }
        // 選択されたグループが存在するかチェック
        if (!GroupRequest::isGroupIDExisted()) {
            SystemFeedback::handleError("400", ERROR_400, "index");
        }
        
    }
}