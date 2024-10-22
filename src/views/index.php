<?php
require_once dirname(__FILE__) . "/../config/conf.php";


$success_msg = "";
if(isset($_SESSION["success"])){
    $success_msg = $_SESSION["success"];
}

$groups = "";
if(isset($_SESSION["group"])){
    $groups = $_SESSION["group"];
}
unset($_SESSION["success"]);



$lps = "";
if(isset($_SESSION["lp"])){
    $lps = $_SESSION["lp"];
}

$error = "";
if(isset($_SESSION["error"])){
    $error = $_SESSION["error"];
}
unset($_SESSION["error"]);

$saved_LPdata = [];
if(isset($_SESSION["saved_data"])){
    $saved_LPdata = $_SESSION["saved_data"];
}
unset($_SESSION["saved_data"]);

$saved_groupData = [];
if(isset($_SESSION["saved_groupData"])){
    $saved_groupData = $_SESSION["saved_groupData"];
}
unset($_SESSION["saved_groupData"]);

$saved_groupDataEdit = [];
if(isset($_SESSION["saved_groupDataEdit"])){
    $saved_groupDataEdit = $_SESSION["saved_groupDataEdit"];
}

unset($_SESSION["saved_groupDataEdit"]);

$screenshots = [];
if(isset($_SESSION["screenshots"])){
    $screenshots = $_SESSION["screenshots"];
}

$category = "";
if(isset($_SESSION["category"])){
    $category = $_SESSION["category"];
}



// print_r($screenshots);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include dirname(__FILE__) . "/common/header.php";?>

</head>

<body>
    <input type="hidden" value="<?= isset($error["errorMsg"]) ? $error["errorMsg"] : ""?>" class="js_error_msg">
    <input type="hidden" value="<?= isset($error["errorCode"]) ? $error["errorCode"] : ""?>" class="js_error_code">
    <div id="marker"
        style="position: fixed; width: 10px; height: 10px; background-color: red; border-radius: 50%; pointer-events: none; display: none; z-index:999;">
    </div>

    <div class="contents relative">
        <p class="success_msg js_success hidden"><?= $success_msg?></p>
        <div class="bg-gray hidden"></div>
        <div class="area">
            <!-- 左側メニューバー -->
            <?php include dirname(__FILE__) . "/common/menu.php";?>
            <div class="index_container">
                <div class="padding_box border_bottom top_title">
                    <h1>LP一覧 / <?= $category?></h1>
                </div>
                <div class="padding_box js_index_page">
                    <?php foreach($lps as $lp) {?>

                    <div class="table-container">
                        <h2><span class="border_bottom group_title"><?= $lp["group_title"]?><img
                                    src="<?=IMG_PATH?>edit.png" alt=""
                                    style="margin-bottom: 8px; width: 20px; cursor: pointer;" class="js_editGroup_btn"
                                    data-group-id="<?= $lp["group_id"]?>"></span></h2>
                        <form class="table_area" action="<?= ROUTE_PATH?>lp/edit" method="post">
                            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
                            <div class="table_flex">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="sticky_tab">
                                            <th scope="col" width="250" class="align-middle">名称</th>
                                            <th scope="col" class="align-middle">ドメイン</th>
                                            <th scope="col" class="align-middle">備考</th>
                                            <th scope="col" class="align-middle">作成日</th>
                                            <th scope="col" class="align-middle">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody class="dropzone" data-group-id="<?= $lp["group_id"]?>">
                                        <?php foreach($lp["lp_sites"] as $index => $lp_site) {?>
                                        <tr class="yes-drop drag-drop js_tr" data-id="<?= $lp_site["lp_id"]?>">
                                            <input type="hidden" name="lp_data<?= $index?>" value="" class="js_lp_data"
                                                data-id="<?=$lp_site["lp_id"]?>">
                                            <td class="align-middle">
                                     
                                                <input type="text" readonly value="<?= $lp_site["lp_title"]?>"
                                                    class="js_input_edit input_edit js_lp_title"
                                                    data-id="<?= $lp_site["lp_id"]?>" maxlength="40"
                                                    name="lp_title">
                                             
                                            </td>
                                            <td class="align-middle"><a href="http://<?= $lp_site["lp_domain"]?>"
                                                    target="_blank" class="js_link"><input type="text" readonly
                                                        class="js_input_edit input_edit txt_link js_domain"
                                                        value="<?= $lp_site["lp_domain"]?>"
                                                        data-id="<?= $lp_site["lp_id"]?>" maxlength="253"
                                                        name="domain"></a></td>
                                            <td class="align-middle">
                                                <input type="text" class="free_txt js_input_edit input_edit js_content"
                                                    readonly value="<?= $lp_site["lp_content"]?>"
                                                    data-id="<?= $lp_site["lp_id"]?>" maxlength="256" name="content">
                                            </td>
                                            <td class="align-middle">
                                                <?php
                                                $date = new DateTime($lp_site["lp_created_at"]);
                                                // フォーマットした文字列を返す
                                                echo $date->format('Y年n月j日');
                                            ?>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-primary js_edit_btn">編集</button>
                                                <button type="button" class="btn btn-danger js_delete_btn"
                                                data-id="<?= $lp_site["lp_id"]?>">削除</button>
                                            </td>
                                        </tr>
                                        <?php }?>

                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-success js_update_btn hidden btn_update">まとめて更新</button>
                        </form>
                    </div>
                    <?php }?>

                </div>
                <!-- スクリーンショット一覧 -->
                <?php include dirname(__FILE__) . "/screenshot.php";?>
            </div>
        </div>


        <!-- LP作成モーダル -->
        <?php include dirname(__FILE__) . "/modal/lp_create.php";?>
        <!-- グループ作成モーダル -->
        <?php include dirname(__FILE__) . "/modal/group_create.php";?>
        <!-- グループ編集モーダル -->
        <?php include dirname(__FILE__) . "/modal/group_edit.php";?>
        <!-- LP削除モーダル -->
        <?php include dirname(__FILE__) . "/modal/lp_delete.php";?>
        <!-- LP削除モーダル -->
        <?php include dirname(__FILE__) . "/modal/wait.php";?>
        <!-- カテゴリー作成モーダル -->
        <?php include dirname(__FILE__) . "/modal/category.php";?>

        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
        <script src="<?=ROUTE_PATH?>dist/index.js"></script>


</body>

</html>