<?php
require_once dirname(__FILE__) . "/../config/conf.php";


$categories = "";
if(isset($_SESSION["categories"])){
    $categories = $_SESSION["categories"];
}
$success_msg = "";
if(isset($_SESSION["success"])){
    $success_msg = $_SESSION["success"];
}
unset($_SESSION["success"]);

$error = "";
if(isset($_SESSION["error"])){
    $error = $_SESSION["error"];
}

$saved_categoryData = [];
if(isset($_SESSION["saved_categoryData"])){
    $saved_categoryData = $_SESSION["saved_categoryData"];
}

unset($_SESSION["saved_categoryData"]);
unset($_SESSION["error"]);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include dirname(__FILE__) . "/common/header.php";?>

</head>

<body>
    <input type="hidden" value="<?= isset($error["errorMsg"]) ? $error["errorMsg"] : ""?>" class="js_error_msg">
    <input type="hidden" value="<?= isset($error["errorCode"]) ? $error["errorCode"] : ""?>" class="js_error_code">
    <div class="contents relative">
        <p class="success_msg js_success hidden"><?= $success_msg?></p>
        <div class="bg-gray hidden"></div>
        <div class="area">
            <!-- 左側メニューバー -->
            <?php include dirname(__FILE__) . "/common/menu.php";?>
            <div class="index_container">
                <div class="padding_box border_bottom">
                    <h1>カテゴリー一覧</h1>
                </div>
                <div class="padding_box2">
                    <div class="category_container">
                        <?php foreach($categories as $category) {?>
                        <div class="category_wrapper relative">
                            <a href="<?= ROUTE_PATH . "category/?id=" .$category["id"]?>"
                                style="text-decoration: none; color: #123459" class="<?= $category["category"]?>">
                                <div class="category_area">
                                    <div class="icon_box">
                                        <img src="<?=IMG_PATH?>category.png" alt="" class="category-icon">
                                    </div>
                                </div>
                            </a>
                            <p class="c absolute category_txt" style="padding-top: 10px; font-size: 18px;"><img src="<?= IMG_PATH?>pen.png"
                                    alt="" class="js_edit_category_btn pen-icon" data-id="<?= $category["id"]?>"
                                    data-name="<?= $category["category"]?>"><?= $category["category"]?></p>
                        </div>

                        <?php }?>
                    </div>


                </div>

            </div>

        </div>
    </div>
    <!-- カテゴリー作成モーダル -->
    <?php include dirname(__FILE__) . "/modal/category.php";?>
    <!-- カテゴリー編集モーダル -->
    <?php include dirname(__FILE__) . "/modal/category_edit.php";?>


    <script src="<?=ROUTE_PATH?>dist/group.js"></script>
</body>

</html>