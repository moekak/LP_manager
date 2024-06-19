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


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include dirname(__FILE__) . "/common/header.php";?>

</head>

<body>
    <div id="marker"
        style="position: fixed; width: 10px; height: 10px; background-color: red; border-radius: 50%; pointer-events: none; display: none;">
    </div>

    <div class="contents relative">
        <p class="success_msg js_success hidden"><?= $success_msg?></p>
        <div class="bg-gray hidden"></div>
        <div class="area">
            <!-- 左側メニューバー -->
            <?php include dirname(__FILE__) . "/common/menu.php";?>
            <div class="index_container">
                <div class="padding_box border_bottom">
                    <h1>LP一覧</h1>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="250" class="align-middle">名称</th>
                                        <th scope="col" class="align-middle">LP名</th>
                                        <th scope="col" class="align-middle">備考</th>
                                        <th scope="col" class="align-middle">作成日</th>
                                        <th scope="col" class="align-middle">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="outer-dropzone" class="dropzone" data-group-id="<?= $lp["group_id"]?>">
                                    <?php foreach($lp["lp_sites"] as $index => $lp_site) {?>
                                    <tr class="yes-drop drag-drop js_tr" data-id="<?= $lp_site["lp_id"]?>">
                                        <input type="hidden" name="lp_data<?= $index?>" value="" class="js_lp_data"
                                            data-id="<?=$lp_site["lp_id"]?>">
                                        <td class="align-middle">
                                            <input type="text" readonly value="<?= $lp_site["lp_title"]?>"
                                                class="js_input_edit input_edit js_lp_title"
                                                data-id="<?= $lp_site["lp_id"]?>">
                                        </td>
                                        <td class="align-middle"><a href="https://<?= $lp_site["lp_domain"]?>"
                                                target="_blank" class="js_link"><input type="text" readonly
                                                    class="js_input_edit input_edit txt_link js_domain"
                                                    value="<?= $lp_site["lp_domain"]?>" style="width: max-content;"
                                                    data-id="<?= $lp_site["lp_id"]?>"></a></td>
                                        <td class="align-middle">
                                            <input type="text" class="free_txt js_input_edit input_edit js_content"
                                                readonly value="<?= $lp_site["lp_content"]?>"
                                                data-id="<?= $lp_site["lp_id"]?>">
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
                            <button type="submit" class="btn btn-success js_update_btn hidden ">まとめて更新</button>
                        </form>
                    </div>
                    <?php }?>
                    <!-- スクリーンショット一覧 -->
                    <?php include dirname(__FILE__) . "/screenshot.php";?>
                </div>
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

        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
        <script src="<?=ROUTE_PATH?>dist/index.js"></script>
        
</body>

</html>