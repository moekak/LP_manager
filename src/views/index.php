<?php
require_once dirname(__FILE__) . "/../config/conf.php";
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
        <div class="bg-gray hidden"></div>
        <div class="area">
            <!-- 左側メニューバー -->
            <?php include dirname(__FILE__) . "/common/menu.php";?>
            <div class="index_container">
                <div class="padding_box border_bottom">
                    <h1>LP一覧</h1>
                </div>
                <div class="padding_box js_index_page">
                    <div class="table-container">
                        <h2><span class="border_bottom group_title">スマホ副業ナビ <img src="<?=IMG_PATH?>edit.png" alt=""
                                    style="margin-bottom: 8px; width: 20px; cursor: pointer;" class="js_editGroup_btn"></span></h2>
                        <div class="table_area">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="250" class="align-middle">名称</th>
                                        <th scope="col" class="align-middle">LP名</th>
                                        <th scope="col" class="align-middle">備考</th>
                                        <th scope="col" class="align-middle">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="outer-dropzone" class="dropzone">
                                    <tr class="yes-drop drag-drop">
                                        <td class="align-middle"><input type="text" readonly value="最低でも当日"
                                                class="js_input_edit input_edit">
                                        </td>
                                        <td class="align-middle"><a href="https://echo-meadow.biz" target="_blank"
                                                class="js_link"><input type="text" readonly
                                                    class="js_input_edit input_edit txt_link"
                                                    value="echo-meadow.biz" style="width: max-content;"></a></td>
                                        <td class="align-middle">
                                            <input type="text" class="free_txt js_input_edit input_edit" readonly
                                                value="新タグ管理画面仕様">
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary js_edit_btn">編集</button>
                                            <button type="button" class="btn btn-danger js_delete_btn">削除</button>
                                        </td>
                                    </tr>
                                    <tr class="yes-drop drag-drop">
                                        <td class="align-middle"><input type="text" readonly value="モニター記念キャンペーン"
                                                class="js_input_edit input_edit">
                                        </td>
                                        <td class="align-middle"><a href="https://frost-orchid.info" target="_blank"
                                                class="js_link"><input type="text" readonly
                                                    class="js_input_edit input_edit txt_link"
                                                    value="frost-orchid.info" style="width: max-content;"></a></td>
                                        <td class="align-middle">
                                            <input type="text" class="free_txt js_input_edit input_edit" readonly
                                                value="新タグ管理画面仕様">
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary js_edit_btn">編集</button>
                                            <button type="button" class="btn btn-danger js_delete_btn">削除</button>
                                        </td>
                                    </tr>
                                    <tr class="yes-drop drag-drop">
                                        <td class="align-middle"><input type="text" readonly value="副業プレゼントアンケート"
                                                class="js_input_edit input_edit">
                                        </td>
                                        <td class="align-middle"><a href="https://lupine-kudu.biz" target="_blank"
                                                class="js_link"><input type="text" readonly
                                                    class="js_input_edit input_edit txt_link"
                                                    value="lupine-kudu.biz" style="width: max-content;"></a></td>
                                        <td class="align-middle">
                                            <input type="text" class="free_txt js_input_edit input_edit" readonly
                                                value="新タグ管理画面仕様">
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary js_edit_btn">編集</button>
                                            <button type="button" class="btn btn-danger js_delete_btn">削除</button>
                                        </td>
                                    </tr>
                                  
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success js_update_btn hidden">まとめて更新</button>
                        </div>
                    </div>
                    <div class="table-container" style="margin-top: 50px;">
                        <h2><span class="border_bottom group_title">副業モニター係 <img src="<?=IMG_PATH?>edit.png" alt=""
                                    style="margin-bottom: 8px; width: 20px; cursor: pointer;" class="js_editGroup_btn"></span></h2>
                        <div class="table_area">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col" width="250" class="align-middle">名称</th>
                                        <th scope="col" class="align-middle">LP名</th>
                                        <th scope="col" class="align-middle">備考</th>
                                        <th scope="col" class="align-middle">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="outer-dropzone" class="dropzone">
                                    <tr class="yes-drop drag-drop">
                                        <td class="align-middle"><input type="text" readonly value="人生逆転した秘密を大公開！"
                                                class="js_input_edit input_edit">
                                        </td>
                                        <td class="align-middle"><a href="https://raindrops.work" target="_blank"
                                                class="js_link"><input type="text" readonly
                                                    class="js_input_edit input_edit txt_link"
                                                    value="raindrops.work" style="width: max-content;"></a></td>
                                        <td class="align-middle">
                                            <input type="text" class="free_txt js_input_edit input_edit" readonly
                                                value="新タグ管理画面仕様">
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary js_edit_btn">編集</button>
                                            <button type="button" class="btn btn-danger js_delete_btn">削除</button>
                                        </td>
                                    </tr>
                                    <tr class="yes-drop drag-drop">
                                        <td class="align-middle"><input type="text" readonly value="LINEで副業ナビ"
                                                class="js_input_edit input_edit">
                                        </td>
                                        <td class="align-middle"><a href="https://neon-forest.space" target="_blank"
                                                class="js_link"><input type="text" readonly
                                                    class="js_input_edit input_edit txt_link"
                                                    value="neon-forest.space" style="width: max-content;"></a></td>
                                        <td class="align-middle">
                                            <input type="text" class="free_txt js_input_edit input_edit" readonly
                                                value="新タグ管理画面仕様">
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary js_edit_btn">編集</button>
                                            <button type="button" class="btn btn-danger js_delete_btn">削除</button>
                                        </td>
                                    </tr>
                                    <tr class="yes-drop drag-drop">
                                        <td class="align-middle"><input type="text" readonly value="副業適性診断"
                                                class="js_input_edit input_edit">
                                        </td>
                                        <td class="align-middle"><a href="https://velvet-sparrow.space" target="_blank"
                                                class="js_link"><input type="text" readonly
                                                    class="js_input_edit input_edit txt_link"
                                                    value="velvet-sparrow.space" style="width: max-content;"></a></td>
                                        <td class="align-middle">
                                            <input type="text" class="free_txt js_input_edit input_edit" readonly
                                                value="新タグ管理画面仕様">
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn btn-primary js_edit_btn">編集</button>
                                            <button type="button" class="btn btn-danger js_delete_btn">削除</button>
                                        </td>
                                    </tr>
                                  
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success js_update_btn hidden">まとめて更新</button>
                        </div>
                    </div>
                </div>
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
    <script>
    // tr要素をドラッグ可能に設定

    interact('.drag-drop').draggable({
        inertia: true,
        // modifiers: [
        //       interact.modifiers.restrictRect({
        //             endOnly: true
        //       })
        // ],
        autoScroll: true,
        onstart: function(event) {
            event.target.classList.add('is-dragging');
        },
        onmove: function(event) {
            const target = event.target;
            const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
            const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

            target.style.transform = `translate(${x}px, ${y}px)`;
            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);

        },
        onend: function(event) {
            event.target.style.transform = '';



            event.target.removeAttribute('data-x');
            event.target.removeAttribute('data-y');


            event.target.classList.remove('is-dragging');
        }
    });



    function getClosestElement(x, y, elements) {
        let closestElement = null;
        let closestDistance = Infinity;

        elements.forEach(element => {
            //要素のビューポート内での位置とサイズを取得
            const rect = element.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            const distance = Math.sqrt((centerX - x) ** 2 + (centerY - y) ** 2);

            if (distance < closestDistance) {
                closestDistance = distance;
                closestElement = element;
            }
        });

        return closestElement;
    }



    // 全てのtbodyをドロップゾーンとして設定
    interact('.dropzone').dropzone({
        accept: '.drag-drop',
        overlap: 0.50,
        ondrop: function(event) {
            const dragged = event.relatedTarget; // ドラッグされたtr要素

            // ドロップされた位置に最も近いtbodyを探すために座標を取得
            const clientX = event.dragEvent.clientX; // ドラッグイベントからX座標を取得
            const clientY = event.dragEvent.clientY; // ドラッグイベントからY座標を取得

            const targetElements = document.querySelectorAll('.dropzone');
            const dropzone = getClosestElement(clientX, clientY, targetElements);

            // マーカー要素を取得
            const marker = document.getElementById('marker');

            // マーカーの位置を更新
            marker.style.left = `${clientX}px`;
            marker.style.top = `${clientY}px`;
            marker.style.display = 'block'; // マーカーを表示

            if (!dropzone) {
                console.error('適切なドロップゾーンが見つかりませんでした。');
                return; // 適切なドロップゾーンが見つからなければ処理を中断
            }

            const afterElement = getDropPosition(dropzone, dragged);
            if (afterElement) {
                dropzone.insertBefore(dragged, afterElement);
            } else {
                dropzone.appendChild(dragged);
            }
        }


    });

    // ドロップ位置を決定する関数
    function getDropPosition(dropzone, dragged) {
        const rows = Array.from(dropzone.querySelectorAll('tr'));
        let afterElement = null;
        const draggedRect = dragged.getBoundingClientRect();

        for (let row of rows) {
            const rect = row.getBoundingClientRect();
            if (draggedRect.top < rect.top) {
                afterElement = row;
                break;
            }
        }

        return afterElement; // ドラッグされた行が末尾に配置される場合はnullを返す
    }
    </script>
</body>

</html>