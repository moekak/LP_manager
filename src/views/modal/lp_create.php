<div class="modal_container js_createLP_modal hidden js_modal">
    <div class="modal_flex">
        <h3 class="modal_title">LP追加</h3>

    </div>
    
    <div class="modal-form-area">
        <form action="<?= ROUTE_PATH?>lp/create" class="g-3" method="post">
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="inputAddress" class="form-label">名称 <span class="required">※</span></label>
                <input type="text" class="form-control" id="inputAddress" placeholder="スマホ副業ナビ" name="lp_title">
            </div>
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="inputAddress2" class="form-label">ドメイン <span class="required">※</span></label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="kiwi-muffin.site" name="domain">
            </div>
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="inputState" class="form-label">グループ名 <span class="required">※</span></label>
                <select id="inputState" class="form-select" name="group">
                    <option selected>グループを選択してください</option>
                    <?php foreach($groups as $group) {?>
                        <option value="<?= $group["id"]?>"><?= $group["title"]?></option>
                    <?php }?>
                </select>
            </div>
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="exampleFormControlTextarea1" class="form-label">備考</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
            </div>
            <div class="col-12" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary">追加</button>
            </div>
        </form>
    </div>
</div>