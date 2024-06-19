<?php

// 開発環境
CONST PUBLIC_PATH = "/LP_system/public/";
CONST IMG_PATH = "/LP_system/public/img/";
CONST SCREENSHOT_PATH = "/LP_system/public/screenshot/";
CONST ROUTE_PATH = "/LP_system/";
CONST LOG_ERROR_FILE_PATH = "C:\\Users\\user\\Dropbox\\Lp_system\\logs\\error\\";
CONST LOG_ACCESS_FILE_PATH = "C:\\Users\\user\\Dropbox\\Lp_system\\logs\\access\\";

// 本番環境
// CONST PUBLIC_PATH = "/kido_test/LP_system/public/";
// CONST IMG_PATH = "/kido_test/LP_system/public/img/";
// CONST SCREENSHOT_PATH = "/kido_test/LP_system/public/screenshot/";
// CONST ROUTE_PATH = "/kido_test/LP_system/";



// ログファイル書き込みエラーメッセージ
CONST CSRF_ERROR_MESSAGE = "CSRFトークンエラーが発生しました。";
CONST MAXLENGTH_ERROR_MESSAGE = "文字数が制限を超えています。";
CONST EMPTYVALUE_ERROR_MESSAE = "値が空です。";
CONST SERVER_ERROR = "サーバーに接続できません。";
CONST DOMAIN_EXISTED_ERROR = "すでにドメインが登録されています。";
CONST GROUPID_NOT_FOUND = "選択されたグループIDが存在しません。";
CONST LPID_NOT_FOUND = "選択されたLPIDが存在しません。";
CONST INVALID_DATA_ERROR = "不正なデータが検知されました。";

// ユーザーの画面に出すエラーメッセージ
CONST ERROR_403 = "この操作を実行する権限がありません。";
CONST ERROR_400 = "入力情報にエラーがあります。再度ご確認ください。";
CONST ERROR_400_DATAEXISTED = "このドメインはすでに登録されています。";
CONST ERROR_500 = "システムエラーが発生しました。後ほど再試行してください。";

// ユーザーの画面に出す成功メッセージ
CONST SUCCESS_CREATE_GROUP = "グループの追加に成功しました。";
CONST SUCCESS_EDIT_GROUP = "グループの更新に成功しました。";
CONST SUCCESS_CREATE_LP = "LPの追加に成功しました。";
CONST SUCCESS_EDIT_LP = "LPの更新に成功しました。";
CONST SUCCESS_DELETE_LP = "LPの削除に成功しました。";
