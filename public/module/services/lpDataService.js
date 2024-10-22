import { fetchOperation, showModal } from "@index/index.js";

/**
 * fetchAndDisplayGLPData関数
 * 指定されたLPIDを使用してグループデータをフェッチし、フォームフィールドに表示する
 *
 * @param {Event} e - イベントオブジェクト（クリックイベントなど）
 */

export const fetchAndDisplayLpData = (e) => {
  let lp_id = e.target.getAttribute("data-id");
  let data = { id: lp_id, type: "lp" };

  console.log(data);

  fetchOperation(data, "fetchLp.php").then((res) => {
    populateLPFields(res[0]).then(() => {
      // 削除モーダル
      showModal("js_deleteLP_modal");
    });
  });
};

/**
 * populateLPFields関数
 * フェッチしたLPデータをフォームフィールドに設定する
 *
 * @param {Object} data - フェッチされたグループデータオブジェクト
 */

const populateLPFields = async (data) => {
    document.querySelector(".js_title_delete").innerHTML = `${data["title"]}`;
    document.querySelector(".js_domain_delete").innerHTML = `${data["domain"]}`;
    document.querySelector(".js_domain_delete").href = `http://${data["domain"]}`;
    document.querySelector(".js_lp_id_delete").value = data["id"];
  };