<?php

require_once(dirname(__FILE__) . "/../../src/config/conf.php");
require_once(dirname(__FILE__) . "/../Services/utils/SystemFeedback.php");
require_once(dirname(__FILE__) . "/../Models/GroupModel.php");


$group_model = new GroupModel();


$raw = file_get_contents('php://input'); // POSTされた生のデータを受け取る
$data = json_decode($raw, true); // json形式をphp変数に変換


$res = $data;

$result = $group_model->selectSpecificGroupData($res["id"]);
echo json_encode($result, true);
