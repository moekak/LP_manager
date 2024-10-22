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
        $data = ["domain", "content"];
        $maxLength = [253, 256];
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
        $data = ["domain"];
        $hasValue = true;

        for ($i=0; $i < count($data) ; $i++) {
            if(!CommonRequest::hasValue($_POST[$data[$i]])){
                SystemFeedback::catchError("$data[$i]の" . EMPTYVALUE_ERROR_MESSAE);
                $hasValue = false;
            }
        }

         return $hasValue;
    }
    // 送信されてきたデータが空かチェック(編集)
    public static function checkEmptyValueForEdit(){
        $data = ["lp_title", "domain"];
        $hasValue = true;

        for ($i=0; $i < count($data) ; $i++) {


            if(!CommonRequest::hasValue($_POST[$data[$i]])){
                SystemFeedback::catchError("$data[$i]の" . EMPTYVALUE_ERROR_MESSAE);
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
    public static function isDomainAlreadyExisted($type){
        $lp_model = new LpModel();
        $domain = DataValidation::sanitizeInput($type["domain"]);

        $formatted_domain = filter_var($domain, FILTER_VALIDATE_URL) ? parse_url($domain)["host"] . (isset(parse_url($domain)["path"]) ? parse_url($domain)["path"] : '') . (isset(parse_url($domain)["query"]) ? '?' . parse_url($domain)["query"] : '') : $domain;
        $formtted_domain = rtrim($formatted_domain, '/');

        if($lp_model->checkDomainExists($formtted_domain)){
            SystemFeedback::catchError(DOMAIN_EXISTED_ERROR . "ドメイン: $formtted_domain");
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