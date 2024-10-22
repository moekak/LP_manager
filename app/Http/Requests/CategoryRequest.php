<?php

require_once dirname(__FILE__) . "/../../Services/utils/Security.php";
require_once dirname(__FILE__) . "/CommonRequest.php";
require_once dirname(__FILE__) . "/../../Services/utils/SystemFeedback.php";
require_once dirname(__FILE__) . "/../../../src/config/conf.php";
require_once dirname(__FILE__) . "/../../Models/CategoryModel.php";

class CategoryRequest{

    // CSRFのチェック
    public static function csrfError(){
        if(Security::checkCSRF()){
            return true;
        }else{
            SystemFeedback::catchError(CSRF_ERROR_MESSAGE);
            return false;
        }
    }

    public static function formValidation(){
        return self::checkMaxLength() && self::checkEmptyValue();
    }


    // 送信されてきたデータが制限を超えてるかチェック
    public static function checkMaxLength(){
        if(CommonRequest::checkLength($_POST["category"], 40)){
            return true;
        }else{
            SystemFeedback::catchError("categoryが" . MAXLENGTH_ERROR_MESSAGE);
            return false;
        }
    }

    // 送信されてきたデータが空かチェック
    public static function checkEmptyValue(){
        if(CommonRequest::hasValue($_POST["category"])){
            return true;
        }else{
            SystemFeedback::catchError("categoryの" . EMPTYVALUE_ERROR_MESSAE);
            return false;
        }
    }

    // 送られてきたIDが有効なデータ型かチェック
    public static function isValidID($id){

        if(!DataValidation::isValidID($id)){
            SystemFeedback::catchError(INVALID_DATA_ERROR . "category_id: $id");
            return false;
        }else{
            return true;
        }
    }


    // 選択されたカテゴリーIDが存在するかチェック
    public static function isCategoryIDExisted($id){
        $category_model = new CategoryModel();
        if(!$category_model->checkCategoryIDExists($id)){
            SystemFeedback::catchError(GROUPID_NOT_FOUND . "カテゴリーID: $id");
            return false;
        }else{
            return true;
        }
    }

}