<div class="padding_box js_screenshot_page hidden">
    <?php foreach($screenshots as $screenshot) {?>
    <div class="screenshot-container">
        <h2><span class="border_bottom group_title"><?= $screenshot["group_title"]?></span></h2>
        <div class="screenshot_area">
            <?php foreach($screenshot["screenshots"] as $img) {?>
            <div class="screenshot_box">
                <a target="_blank" href="http://<?= $img["domain"]?>">
                    <div class="lp_img">
                        <img src="<?=SCREENSHOT_PATH . $img["screenshot"]?>" alt="" class="screenshot">
                    </div>
                </a>
                <p class="screenshot_txt"><?= $img["lp_title"]?></p>
            </div>
            <?php }?>
        </div>
    </div>
    <?php }?>



</div>