<main>
     <div class="menu_bar">
            <a href="<?= ROUTE_PATH?>category" style="text-decoration: none;">
                  <div class="menu-box js_category_btn">
                        <img src="<?= IMG_PATH ?>home.png" alt="" class="menu-icon">
                        <p class="menu_txt">ホーム</p>
                  </div>
            </a>
            
            <?php if(preg_match(URL, $_SERVER['REQUEST_URI'])) {?>
                  <div class="menu-box js_home_btn">
                        <img src="<?= IMG_PATH ?>website.png" alt="" class="menu-icon">
                        <p class="menu_txt">LP一覧</p>
                  </div>
                  <div class="menu-box js_screenshot_btn">
                        <img src="<?= IMG_PATH ?>photo.png" alt="" class="menu-icon">
                        <p class="menu_txt">スクリーンショット</p>
                  </div>
                  <div class="menu-box js_createLP_btn">
                        <img src="<?= IMG_PATH ?>create2.png" alt="" class="menu-icon">
                        <p class="menu_txt">LP追加</p>
                  </div>
                  <div class="menu-box js_createGroup_btn">
                        <img src="<?= IMG_PATH ?>create.png" alt="" class="menu-icon">
                        <p class="menu_txt">グループ追加</p>
                  </div>
            <?php } else{?>
                  <div class="menu-box js_createCategory_btn">
                  <img src="<?= IMG_PATH ?>open-white.png" alt="" class="menu-icon">
                  <p class="menu_txt">カテゴリー追加</p>
            </div>
            <?php }?>
            
            
            <!-- <div class="menu-box">
                  <img src="<?= IMG_PATH ?>setting.png" alt="" class="menu-icon">
                  <p class="menu_txt">設定</p>
            </div> -->
     </div>
</main>