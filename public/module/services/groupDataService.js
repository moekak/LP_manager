import { fetchOperation } from "@index/index.js";

/**
 * fetchAndDisplayGroupData関数
 * 指定されたグループIDを使用してグループデータをフェッチし、フォームフィールドに表示する
 * 
 * @param {Event} e - イベントオブジェクト（クリックイベントなど）
 */

export const fetchAndDisplayGroupData = (e)=>{
    let group_id = e.target.getAttribute("data-group-id");
    let data = { id: group_id, type: "group" };

    fetchOperation(data, "fetchLpGroups.php")
        .then((res) => {
            populateGroupFields(res[0])
        });
}
  
/**
 * populateGroupFields関数
 * フェッチしたグループデータをフォームフィールドに設定する
 * 
 * @param {Object} data - フェッチされたグループデータオブジェクト
 */
export const populateGroupFields = (data)=>{
    document.querySelector(".js_edit_group").value = data["title"]
    document.querySelector(".js_group_id").value = data["id"]
}