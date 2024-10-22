<div class="modal_container js_editCategory_modal js_modal hidden">
    <div class="modal_flex">
        <h3 class="modal_title">カテゴリー編集</h3>
    </div>
    <p class="error_txt red js_error_txt hidden"></p>
    <div class="modal-form-area">
        <form action="<?= ROUTE_PATH?>category/edit" method="post" class="g-3">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <input type="hidden" name="category_id" class="js_category_id" >
            <div class="col-12" style="margin-bottom: 18px;">
                <label for="inputAddress" class="form-label">名称 <span class="required">※</span></label>
                <input type="text" class="form-control js_edit_category" maxlength="40" id="inputAddress"  name="category" value="<?= isset($saved_categoryData["category"]) ? $saved_categoryData["category"] : ""?>">
            </div>
            <div class="col-12" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary disabled_btn js_category_edit_btn" disabled>更新</button>
            </div>
        </form>
    </div>
</div>