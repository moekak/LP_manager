<?php

require_once(dirname(__FILE__) . "/../../src/config/conf.php");
require_once(dirname(__FILE__) . "/../Services/utils/SystemFeedback.php");
require_once(dirname(__FILE__) . "/../Models/LpModel.php");


$lp_model = new LpModel();


$raw = file_get_contents('php://input'); // POSTされた生のデータを受け取る
$data = json_decode($raw, true); // json形式をphp変数に変換


$res = $data;

$lp_model->updategroupId($res["group_id"], $res["lp_id"]);

