import {
  showModal,
  hideModal,
  setupEditButton,
  changeView,
} from "@index/index.js";

// LP一覧の編集のUI処理
const edit_btn = document.querySelectorAll(".js_edit_btn");
setupEditButton(edit_btn);

// #####################################################################################
// ############################### モーダル処理 #########################################
// #####################################################################################
{
  // LP新規作成
  const createLP_btn = document.querySelector(".js_createLP_btn");
  createLP_btn.addEventListener("click", () => {
    showModal("js_createLP_modal");
  });

  // グループ新規作成
  const create_group_btn = document.querySelector(".js_createGroup_btn");
  create_group_btn.addEventListener("click", () => {
    showModal("js_createGroup_modal");
  });

  // グループ新規作成
  const edit_group_btns = document.querySelectorAll(".js_editGroup_btn");
  edit_group_btns.forEach((btn) => {
    btn.addEventListener("click", () => {
      showModal("js_editGroup_modal");
    });
  });

  // LP削除
  const deleteLP_btns = document.querySelectorAll(".js_delete_btn");

  deleteLP_btns.forEach((btn) => {
    btn.addEventListener("click", () => {
      showModal("js_deleteLP_modal");
    });
  });

  // モーダル非表示
  hideModal();
}

// ############################################################################
// ################### スクリーンショットページの切り替え ########################
// ###########################################################################
changeView();
