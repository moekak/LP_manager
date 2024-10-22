<?php

require_once dirname(__FILE__) . "/../Services/utils/DatabaseConnection.php";
require_once dirname(__FILE__) . "/../Services/utils/SystemFeedback.php";
require_once dirname(__FILE__) . "/../../src/config/conf.php";

class LpModel
{
    public $pdo;
    public $feedback;
    public function __construct()
    {
        $dbConnection = DatabaseConnection::getInstance();
        // PDOインスタンス（データベース接続）を取得
        $this->pdo = $dbConnection->getConnection();
        $this->feedback = new SystemFeedback();
    }

    // ドメインがすでに登録されてるか確認
    public function checkDomainExists($data)
    {
        try {
            $statement = $this->pdo->prepare(
                "SELECT EXISTS (SELECT 1 FROM `lp_sites` WHERE `domain` = :domain AND is_deleted = '0');
        ");
            $statement->bindValue(':domain', $data);
            $statement->execute();
            $result = $statement->fetchColumn();
            return $result == 1;

        } catch (PDOException $e) {
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" . ROUTE_PATH . "error");
            exit;
        }
    }
    // LPのデータをデータベースに登録する
    public function insertLPdata($data)
    {
        try {
            $statement = $this->pdo->prepare(
                "INSERT INTO
                    `lp_sites` (`group_id`, `title`, `domain`, `content`)
                VALUES
                    (:group_id, :title, :domain, :content)
            ");
            $statement->bindValue(':group_id', $data["group_id"]);
            $statement->bindValue(':title', "");
            $statement->bindValue(':domain', $data["domain"]);
            $statement->bindValue(':content', $data["content"]);
            $statement->execute();
            return $this->pdo->lastInsertId();

        } catch (PDOException $e) {
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" . ROUTE_PATH . "error");
            exit;
        }
    }
    // LPのデータとグループを取り出す
    public function selectLPdataWithGroup($category_id)
    {
        try {
            $statement = $this->pdo->prepare(
                "SELECT
                    lp_sites.domain,
                    lp_sites.content,
                    lp_sites.title AS lp_title,
                    groups.title AS group_title,
                    lp_sites.created_at AS lp_created_at,
                    lp_sites.updated_at AS lp_updated_at,
                    lp_sites.id AS lp_id,
                    groups.id AS group_id
                FROM
                    lp_sites
                LEFT JOIN
                    groups
                ON
                    lp_sites.group_id = groups.id
                WHERE
                    lp_sites.is_deleted = '0'
                AND
                    groups.category_id = :category_id
                ORDER BY 
                CASE
                WHEN groups.title REGEXP '^[0-9]' THEN 1  -- 数字
                WHEN groups.title REGEXP '^[a-zA-Z]' THEN 2  -- アルファベット
                WHEN groups.title REGEXP '^[ぁ-ん]' THEN 3  -- ひらがな
                WHEN groups.title REGEXP '^[ァ-ン]' THEN 4  -- カタカナ
                ELSE 5
                END,
                    groups.title ASC;
                ");

            $statement->bindValue(':category_id', $category_id);
            $statement->execute();

            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            // データの成型
            $groupedData = [];
            foreach ($results as $row) {
                $groupId = $row['group_id'];
                if (!isset($groupedData[$groupId])) {
                    $groupedData[$groupId] = [
                        'group_id' => $groupId,
                        'group_title' => $row['group_title'],
                        'lp_sites' => [],
                    ];
                }
                if ($row['lp_id'] !== null) { // lp_sitesのデータがある場合のみ追加
                    $groupedData[$groupId]['lp_sites'][] = [
                        'lp_id' => $row['lp_id'],
                        'lp_title' => $row['lp_title'],
                        'lp_domain' => $row['domain'],
                        'lp_content' => $row['content'],
                        'lp_created_at' => $row['lp_created_at'],
                        'lp_updated_at' => $row['lp_updated_at'],
                    ];
                }
            }

             // 各グループのlp_sitesを新しい順に並べ替える
    foreach ($groupedData as &$group) {
        usort($group['lp_sites'], function ($a, $b) {
            return strtotime($b['lp_created_at']) - strtotime($a['lp_created_at']);
        });
    }
    unset($group); // 参照を解除

    return $groupedData;

        } catch (PDOException $e) {
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" . ROUTE_PATH . "error");
            exit;
        }
    }
      // LPIDが存在するか確認
      public function checkLpIDExists($lp_id){
        try{
            $statement = $this->pdo->prepare(
                "SELECT EXISTS (SELECT 1 FROM `lp_sites` WHERE `id` = :id AND is_deleted = '0');
        ");
            $statement->bindValue(':id', $lp_id);
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
      // LPデータの更新
      public function updateLPData($data){
        $query = "UPDATE lp_sites SET ";
        $fields = [];
        $params = [];
    
        if (isset($data["lp_title"]) && $data["lp_title"] !== "") {
            $fields[] = "title = :title";
            $params[':title'] = $data["lp_title"];
        }
        if (isset($data["domain"]) && $data["domain"] !== "") {
            $fields[] = "domain = :domain";
            $params[':domain'] = $data["domain"];
        }
        if (isset($data["content"]) && $data["content"] !== "") {
            $fields[] = "content = :content";
            $params[':content'] = $data["content"];
        }
    
        // フィールドが設定されていない場合は更新しない
        if (empty($fields)) {
            header("Location:" . ROUTE_PATH . "category/?id=" . $_SESSION["category_id"]);
            exit;
        }
    
        // 動的に生成されたフィールドをクエリに追加
        $query .= implode(", ", $fields);
        $query .= " WHERE id = :id";
        $params[':id'] = $data["lp_id"];
    
        try {
            $statement = $this->pdo->prepare($query);
            foreach ($params as $key => $value) {
                $statement->bindValue($key, $value);
            }
            $statement->execute();
        } catch (PDOException $e) {
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" . ROUTE_PATH . "error");
            exit;
        }
    }
    
    
    // 特定のLPのデータを取得する
    public function selectSpecificLpData($id){
        try {
            $statement = $this->pdo->prepare(
                "SELECT
                   *
                FROM
                    lp_sites
                WHERE 
                    id = :id
                AND 
                    is_deleted = '0'
                ");

            
            $statement->bindValue(":id", $id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
            $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
            header("Location:" . ROUTE_PATH . "error");
            exit;
        }

}
public function deleteLpData($group_id){
    try{
        $statement = $this->pdo->prepare(
            "UPDATE lp_sites SET is_deleted = '1' WHERE id = :id
    ");
        $statement->bindValue(':id', $group_id);
        $statement->execute();
        
    }catch(PDOException $e){
        SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
        $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
        header("Location:" .ROUTE_PATH . "error");
        exit;
    }
}
public function updategroupId($group_id, $lp_id){
    try{
        $statement = $this->pdo->prepare(
            "UPDATE lp_sites SET group_id = :group_id WHERE id = :id
    ");
        $statement->bindValue(':id', $lp_id);
        $statement->bindValue(':group_id', $group_id);
        $statement->execute();
        
    }catch(PDOException $e){
        SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
        $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
        header("Location:" .ROUTE_PATH . "error");
        exit;
    }
}
// LPwを削除する
public function deletLP($id){
    try {
        $statement = $this->pdo->prepare(
            "DELETE FROM lp_sites WHERE id = :id
            ");

        
        $statement->bindValue(":id", $id);
        $statement->execute();

    } catch (PDOException $e) {
        SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
        $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
        header("Location:" . ROUTE_PATH . "error");
        exit;
    }

}

}