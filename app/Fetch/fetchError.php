<?php

require_once(dirname(__FILE__) . "/../../src/config/conf.php");
require_once(dirname(__FILE__) . "/../Services/utils/SystemFeedback.php");

session_start();



$raw = file_get_contents('php://input'); // POSTされた生のデータを受け取る
$data = json_decode($raw, true); // json形式をphp変数に変換



$res = $data;
SystemFeedback::catchError($res);
SystemFeedback::handleError("500", ERROR_500, "error");

