<?php

require_once(dirname(__FILE__) . "/../Services/utils/DatabaseConnection.php");
require_once(dirname(__FILE__) . "/../Services/utils/SystemFeedback.php");



class GroupModel{
    public $pdo;
    public $feedback;
    public function __construct(){
        $dbConnection = DatabaseConnection::getInstance();
        // PDOインスタンス（データベース接続）を取得
        $this->pdo = $dbConnection->getConnection();
        $this->feedback = new SystemFeedback();
    }

    // グループのデータを挿入する
    public function insertGroupData($title){
        try{
            $statement = $this->pdo->prepare(
                "INSERT INTO 
                    `groups` (`title`) 
            VALUES 
                (:title)
        ");
            $statement->bindValue(':title', $title);
            $statement->execute();
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }
    // グループの全てのデータを取得する
    public function selectGroupData(){
        try{
            $statement = $this->pdo->prepare("SELECT * FROM `groups`");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }
    // 特定のグループのデータを取得する
    public function selectSpecificGroupData($group_id){
        try{
            $statement = $this->pdo->prepare("SELECT * FROM `groups` WHERE id = :id");
            $statement->bindValue(':id', $group_id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }

 
     // グループIDが存在するか確認
     public function checkGroupIDExists($group_id){
        try{
            $statement = $this->pdo->prepare(
                "SELECT EXISTS (SELECT 1 FROM `groups` WHERE `id` = :id)
        ");
            $statement->bindValue(':id', $group_id);
            $statement->execute();
            $result =  $statement->fetchColumn();
            return $result == 1;
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }
     public function updateGroupData($group_id, $title){
        try{
            $statement = $this->pdo->prepare(
                "UPDATE groups SET title = :title WHERE id = :id
        ");
            $statement->bindValue(':id', $group_id);
            $statement->bindValue(':title', $title);
            $statement->execute();
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }
}

