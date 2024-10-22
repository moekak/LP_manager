<div class="modal_container js_createCategory_modal hidden js_modal">
    <div class="modal_flex">
        <h3 class="modal_title">カテゴリー追加</h3>

    </div>
    <p class="error_txt red js_error_txt hidden"></p>
    
    <div class="modal-form-area">
        <form action="<?= ROUTE_PATH?>category/create" class="g-3" method="post">
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="inputAddress" class="form-label">名称 <span class="required">※</span></label>
                <input type="text" class="form-control" maxlength="40" id="inputAddress" placeholder="他社" name="category">
            </div>
            <div class="col-12" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary">追加</button>
            </div>
        </form>
    </div>
</div>

