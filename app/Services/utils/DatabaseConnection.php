<?php

require_once(dirname(__FILE__). "/SystemFeedback.php");
require_once(dirname(__FILE__). "/../../../src/config/conf.php");
require_once(dirname(__FILE__). "/../../../vendor/autoload.php");

use Dotenv\Dotenv;


class DatabaseConnection{
    private $pdo;
    // なんで$Instanceにstaticつけるの？
    // →クラスのすべてのインスタンスで同じ$Instanceを共有するから。
    private static $instance = null;
    public $error_handler;

    private function __construct(){
         // .env ファイルを読み込む
         $dotenv = Dotenv::createImmutable(dirname(__FILE__) . '/../../../');
         $dotenv->load();
        try {
            //  throw new Exception("テスト例外");
            $dsn = "mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"] .  ";charset=utf8mb4";
            $this->pdo = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);

        } catch (\PDOException $e) {
            SystemFeedback::catchError(SERVER_ERROR. $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            // エラー表示させるページに遷移させる
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }
    // 特定のクラスのインスタンスがアプリケーション全体でただ一つだけ生成されることを保証する
    // 外部からインスタンス化できない
    // なぜ使う？→　データベース接続はリソースを多く消費するため。複数の接続を開く代わりに同じ接続を再利用できる。
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // PDOインスタンスへのアクセス
    public function getConnection() {
        return $this->pdo;
    }
}