<?php

require_once dirname(__FILE__) . "/../../Services/utils/Security.php";
require_once dirname(__FILE__) . "/CommonRequest.php";
require_once dirname(__FILE__) . "/../../Services/utils/SystemFeedback.php";
require_once dirname(__FILE__) . "/../../../src/config/conf.php";
require_once dirname(__FILE__) . "/../../Models/LpModel.php";
require_once dirname(__FILE__) . "/../../Models/GroupModel.php";
require_once dirname(__FILE__) . "/../../Services/utils/DataValidation.php";

class LpRequest{

    // CSRFのチェック
    public static function csrfError(){
        if(Security::checkCSRF()){
            return true;
        }else{
            SystemFeedback::catchError(CSRF_ERROR_MESSAGE);
            return false;
        }
    }

    public static function formValidation($name){
        return self::checkMaxLength($name) && self::checkEmptyValue() && self::isValidID($_POST["group"]);
    }


    // 送信されてきたデータが制限を超えてるかチェック
    public static function checkMaxLength($name){
        $data = ["lp_title", "domain", "content"];
        $maxLength = [20, 253, 256];
        $isValid = true;

        for ($i=0; $i < count($data); $i++) { 
            if(isset($name[$data[$i]]) && $name[$data[$i]] !== ""){
                 if(!CommonRequest::checkLength($_POST[$data[$i]], $maxLength[$i])){
                    SystemFeedback::catchError("$data[$i]が" . MAXLENGTH_ERROR_MESSAGE);
                    $isValid = false;
                 }
            }
        }
        return $isValid;
    }

    // 送信されてきたデータが空かチェック
    public static function checkEmptyValue(){
        $data = ["lp_title", "domain"];
        $hasValue = true;

        for ($i=0; $i < count($data) ; $i++) { 
            if(!CommonRequest::hasValue($_POST[$data[$i]])){
                SystemFeedback::catchError("$data[$i]の" . MAXLENGTH_ERROR_MESSAGE);
                $hasValue = false;
            }
        }
         return $hasValue;
    }

    public static function isValidID($id){
        if(!DataValidation::isValidID($id)){
            SystemFeedback::catchError(INVALID_DATA_ERROR . "group_id: $id");
            return false;
        }else{
            return true;
        }
    }

    // すでにドメインが登録されてるかチェック
    public static function isDomainAlreadyExisted(){
        $lp_model = new LpModel();
        $data = DataValidation::sanitizeInput($_POST["domain"]);


        if($lp_model->checkDomainExists($data)){
            SystemFeedback::catchError(DOMAIN_EXISTED_ERROR . "ドメイン: $data");
            return false;
        }else{
            return true;
        }
    }

    // 選択されたグループIDが存在するかチェック
    public static function isGroupIDExisted(){
        $group_model = new GroupModel();
        $group_id = intval($_POST["group"]);
        if(!$group_model->checkGroupIDExists($group_id)){
            SystemFeedback::catchError(GROUPID_NOT_FOUND . "グループID: $group_id");
            return false;
        }else{
            return true;
        }
    }

    // 選択されたLPIDが存在するかチェック
    public static function isLpIDExisted($lp_id){
        $lp_model = new LpModel();
        if(!$lp_model->checkLPIDExists($lp_id)){
            SystemFeedback::catchError(LPID_NOT_FOUND  . "LPID: $lp_id");
            return false;
        }else{
            return true;
        }
    }

}