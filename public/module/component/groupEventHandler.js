/**
 * enableEditGroupBtn関数
 * グループ編集ボタンを入力フィールドの内容に応じて有効化または無効化する
 */

export const enableEditGroupBtn = ()=>{
    // 編集フィールドと編集ボタンのDOM要素を取得
    const field     = document.querySelector(".js_edit_group")
    const edit_btn  = document.querySelector(".js_group_edit_btn")

    // 初期化: データ変数を空文字列で初期化
    let data = ""
    field.addEventListener("input", (e)=>{
        // 入力された値を取得
        data = e.target.value
        // 入力フィールドが空でない場合は編集ボタンを有効化、空の場合は無効化
        if(data !== ""){
            edit_btn.classList.remove("disabled_btn")
            edit_btn.disabled = false
        }else{
            edit_btn.classList.add("disabled_btn")
            edit_btn.disabled = true
        }
    })
}