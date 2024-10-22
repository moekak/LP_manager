<?php

require_once dirname(__FILE__) . "/../../Services/utils/Security.php";
require_once dirname(__FILE__) . "/CommonRequest.php";
require_once dirname(__FILE__) . "/../../Services/utils/SystemFeedback.php";
require_once dirname(__FILE__) . "/../../../src/config/conf.php";

class GroupRequest{

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
        if(CommonRequest::checkLength($_POST["group_title"], 40)){
            return true;
        }else{
            SystemFeedback::catchError("group_titleが" . MAXLENGTH_ERROR_MESSAGE);
            return false;
        }
    }

    // 送信されてきたデータが空かチェック
    public static function checkEmptyValue(){
        if(CommonRequest::hasValue($_POST["group_title"])){
            return true;
        }else{
            SystemFeedback::catchError("group_titleの" . EMPTYVALUE_ERROR_MESSAE);
            return false;
        }
    }

    // 送られてきたIDが有効なデータ型かチェック
    public static function isValidID($id){
        if(!DataValidation::isValidID($id)){
            SystemFeedback::catchError(INVALID_DATA_ERROR . "group_id: $id");
            return false;
        }else{
            return true;
        }
    }


    // 選択されたグループIDが存在するかチェック
    public static function isGroupIDExisted(){
        $group_model = new GroupModel();
        $group_id = intval($_POST["group_id"]);
        if(!$group_model->checkGroupIDExists($group_id)){
            SystemFeedback::catchError(GROUPID_NOT_FOUND . "グループID: $group_id");
            return false;
        }else{
            return true;
        }
    }

}