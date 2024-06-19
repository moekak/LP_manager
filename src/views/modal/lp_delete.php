<div class="modal_container js_deleteLP_modal  js_modal hidden">
    <h5>本当に削除しますか？</h3>
    <p style="margin-top: 20px;" class="js_title_delete">名称: スマホ副業ナビ</p>
    <p class="js_domain_delete">ドメイン: echo-meadow.biz</p>
    
    <div class="modal-btn-area">
        <form action="<?= ROUTE_PATH?>lp/delete" method="post">
            <input type="hidden" name="lp_id" class="js_lp_id_delete">
            <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
        
        <button type="button" class="btn btn-secondary">いいえ</button>
    </div>
</div>