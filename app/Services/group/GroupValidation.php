<?php
require_once dirname(__FILE__) . "/../../Http/Requests/GroupRequest.php";
require_once dirname(__FILE__) . "/../../Http/Requests/CategoryRequest.php";
require_once dirname(__FILE__) . "/../utils/SystemFeedback.php";

class GroupValidation
{
    public static function createValidation($id)
    {
       
        // CSRFトークンチェック
        if(!GroupRequest::csrfError()){
            SystemFeedback::handleError("403", ERROR_403, "error");
        }



        if (!CategoryRequest::isValidID($id) || !CategoryRequest::isCategoryIDExisted($id)) {
        
            SystemFeedback::handleError("403", ERROR_403, "error");
        }


        // フォームバリデーション
        if (!GroupRequest::formValidation()) {
            $_SESSION["saved_groupData"] = $_POST;
            SystemFeedback::handleError("400_group", ERROR_400, "category/?id=" .$_SESSION["category_id"]);
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
            $_SESSION["saved_groupDataEdit"] = $_POST;
            SystemFeedback::handleError("400_group_edit", ERROR_400,"category/?id=" .$_SESSION["category_id"]);
        }
        // データ型チェック
        if (!GroupRequest::isValidID($data)) {
            $_SESSION["saved_groupDataEdit"] = $_POST;
            SystemFeedback::handleError("400_group_edit", ERROR_400, "category/?id=" .$_SESSION["category_id"]);
        }
        // 選択されたグループが存在するかチェック
        if (!GroupRequest::isGroupIDExisted()) {
            $_SESSION["saved_groupDataEdit"] = $_POST;
            SystemFeedback::handleError("400_group_edit", ERROR_400, "category/?id=" .$_SESSION["category_id"]);
        }
        
    }
}