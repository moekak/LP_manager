<?php

require_once dirname(__FILE__) . "/../Services/utils/DatabaseConnection.php";
require_once dirname(__FILE__) . "/../Services/utils/SystemFeedback.php";
require_once dirname(__FILE__) . "/../../src/config/conf.php";

class LpScreenshotModel
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



// LPスクリーンショットを取り出す
public function selectScreenshotWithGroup($category_id)
{
    try {
        $statement = $this->pdo->prepare(
            "SELECT
                lp_screenshots.id AS lp_screenshots_ID,
                lp_screenshots.created_at AS lp_screenshots_created_at,
                lp_screenshots.updated_at AS lp_screenshots_updated_at,
                lp_screenshots.screenshot AS screenshot,
                groups.title AS group_title,
                groups.id AS group_id,
                lp_sites.domain AS domain,
                lp_sites.title AS lp_title
            FROM
                lp_screenshots
            LEFT JOIN
                lp_sites
            ON
                lp_screenshots.lp_id = lp_sites.id
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
            WHEN 
                groups.title REGEXP '^[0-9]' THEN 1  -- 数字
            WHEN 
                groups.title REGEXP '^[a-zA-Z]' THEN 2  -- アルファベット
            WHEN 
                groups.title REGEXP '^[ぁ-ん]' THEN 3  -- ひらがな
            WHEN 
                groups.title REGEXP '^[ァ-ン]' THEN 4  -- カタカナ
            ELSE 
                5
            END,
                groups.title ASC;"
        );
        

        $statement->bindValue(':category_id', $category_id);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $groupedScreenshot = [];
        foreach ($results as $row) {
            $groupId = $row['group_id'];
            if (!isset($groupedScreenshot[$groupId])) {
                $groupedScreenshot[$groupId] = [
                    'group_id' => $groupId,
                    'group_title' => $row['group_title'],
                    'screenshots' => [],
                ];
            }
            if ($row['lp_screenshots_ID'] !== null) { // lp_sitesのデータがある場合のみ追加
                $groupedScreenshot[$groupId]['screenshots'][] = [
                    'lp_screenshots_ID' => $row['lp_screenshots_ID'],
                    'screenshot' => $row['screenshot'],
                    'screenshot_created_at' => $row['lp_screenshots_created_at'],
                    'screenshot_updated_at' => $row['lp_screenshots_updated_at'],
                    'domain' => $row["domain"],
                    "lp_title" =>$row["lp_title"]
                ];
            }
        }

         // 各グループのlp_sitesを新しい順に並べ替える
foreach ($groupedScreenshot as &$group) {
    usort($group['screenshots'], function ($a, $b) {
        return strtotime($b['screenshot_created_at']) - strtotime($a['screenshot_created_at']);
    });
}
unset($group); // 参照を解除

return $groupedScreenshot;

    } catch (PDOException $e) {
        SystemFeedback::catchError(SERVER_ERROR . $e->getMessage());
        $_SESSION["error"] =  ["errorCode" => "500", "errorMsg" => ERROR_500];
        header("Location:" . ROUTE_PATH . "error");
        exit;
    }
}




}