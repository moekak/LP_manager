<div class="modal_container js_createLP_modal hidden js_modal">
    <div class="modal_flex">
        <h3 class="modal_title">LP追加</h3>
    </div>
    <p class="error_txt red js_error_txt hidden"></p>
    
    <div class="modal-form-area">
        <form action="<?= ROUTE_PATH?>lp/create" class="g-3" method="post">
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <!-- <div class="col-12" style="margin-bottom: 18px;">
                <label for="inputAddress" class="form-label">名称 <span class="required">※</span></label>
                <input type="text" class="form-control js_lp_name" id="inputAddress" maxlength="40" placeholder="40文字以内で入力してください" name="lp_title" value="<?= isset($saved_LPdata["lp_title"]) ? $saved_LPdata["lp_title"] : ""?>">
            </div> -->
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="inputAddress2" class="form-label">ドメイン <span class="required">※</span></label>
                <input type="text" class="form-control js_lp_domain" maxlength="253" id="inputAddress2" placeholder="ドメイン名またはURLを入力してください" name="domain" value="<?= isset($saved_LPdata["domain"]) ? $saved_LPdata["domain"] : ""?>">
            </div>
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="inputState" class="form-label">グループ名 <span class="required">※</span></label>
                <select id="inputState" class="form-select js_lp_group" name="group">
                    <option value="" selected disabled>グループを選択してください</option>
                    <?php foreach($groups as $group) {?>
                        <option class="select_group" value="<?= $group["id"]?>" id="<?= $group["id"]?>" <?= isset($saved_LPdata["group"]) && $saved_LPdata["group"] == $group["id"] ? 'selected' : ""?>><?= $group["title"]?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="exampleFormControlTextarea1" class="form-label">備考</label>
                <textarea class="form-control js_lp_content" maxlength="256" id="exampleFormControlTextarea1" rows="3" name="content" value="<?= isset($saved_LPdata["content"]) ? $saved_LPdata["content"] : ""?>" ><?= isset($saved_LPdata["content"]) ? $saved_LPdata["content"] : ""?></textarea>
            </div>
            <div class="col-12" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary js_create_lp">追加</button>
            </div>
        </form>
    </div>
</div>