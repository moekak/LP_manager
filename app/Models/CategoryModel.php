<?php

require_once(dirname(__FILE__) . "/../Services/utils/DatabaseConnection.php");
require_once(dirname(__FILE__) . "/../Services/utils/SystemFeedback.php");



class CategoryModel{
    public $pdo;
    public $feedback;
    public function __construct(){
        $dbConnection = DatabaseConnection::getInstance();
        // PDOインスタンス（データベース接続）を取得
        $this->pdo = $dbConnection->getConnection();
        $this->feedback = new SystemFeedback();
    }

    // カテゴリーのデータを挿入する
    public function insertCategory($category){
        try{
            $statement = $this->pdo->prepare(
                "INSERT INTO 
                    `categories` (`category`) 
            VALUES 
                (:category)
        ");
            $statement->bindValue(':category', $category);
            $statement->execute();
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }

    // 全てのカテゴリーを取得する
    public function selectCategories(){
        try{
            $statement = $this->pdo->prepare(
                "SELECT *FROM  
                    `categories`
        ");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }
    
     // カテゴリーIDが存在するか確認
    public function checkCategoryIDExists($category_id){
        try{
            $statement = $this->pdo->prepare(
                "SELECT EXISTS (SELECT 1 FROM `categories` WHERE `id` = :id)
        ");
            $statement->bindValue(':id', $category_id);
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

    public function updateCategoryData($category_id, $category){
        try{
            $statement = $this->pdo->prepare(
                "UPDATE categories SET category = :category WHERE id = :id
        ");
            $statement->bindValue(':id', $category_id);
            $statement->bindValue(':category', $category);
            $statement->execute();
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }
    


    // 特定のカテゴリーを取り出す
    public function selectSpecificCategory($id){
        try{
            $statement = $this->pdo->prepare(
                "SELECT category FROM  
                    `categories` WHERE id = :id
        ");
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetchColumn();
            
        }catch(PDOException $e){
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            
            header("Location:" .ROUTE_PATH . "error");
            exit;
        }
    }
    
}