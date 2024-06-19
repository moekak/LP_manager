import {
  showModal,
  hideModal,
  setupEditButton,
  changeView,
  fetchAndDisplayGroupData,
  enableEditGroupBtn,
  fetchAndDisplayLpData,
  enableDragging,
  disableDragging
} from "@index/index.js";




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

  // // LP削除
  // const deleteLP_btns = document.querySelectorAll(".js_delete_btn");

  // deleteLP_btns.forEach((btn) => {
  //   btn.addEventListener("click", () => {
  //     showModal("js_deleteLP_modal");
  //   });
  // });

  // モーダル非表示
  hideModal();
}

// ############################################################################
// ################### スクリーンショットページの切り替え ########################
// ###########################################################################

changeView();

// ############################################################################
// ################### 処理成功メッセージの処理 ################################
// ###########################################################################

const success = document.querySelector(".js_success");

if (success.innerHTML !== "") {
  success.classList.remove("hidden");
  setTimeout(() => {
    success.classList.add("hidden");
  }, 2000);
}

// ##################################################################################
//  HTMLテーブル内の行に対して動的にデータを管理し、入力フィールドの変更をリアルタイムで追跡
// ##################################################################################

// 行ごとのデータを格納するオブジェクト
let dataObj = {};

// 各行のデータIDを取得してdataObjに初期化
document.querySelectorAll(".js_tr").forEach((tr) => {
  let id = tr.getAttribute("data-id");
  if (!dataObj.hasOwnProperty(id)) {
    dataObj[id] = { lp_id: id };
  }
});

const elements = ["lp_title", "domain", "content"];
// 各要素にイベントリスナーを追加してdataObjを更新
elements.forEach((elementName) => {
  document.querySelectorAll(`.js_${elementName}`).forEach((element) => {
    let id = element.getAttribute("data-id");

    element.addEventListener("input", (e) => {
      dataObj[id][elementName] = e.target.value;
      elementName == "domain"
        ? setData(element.parentElement)
        : setData(element);
    });
  });
});

// データを設定する関数
const setData = (element) => {
  let lp_data_box =
    element.parentElement.parentElement.querySelector(".js_lp_data");
  let id = lp_data_box.getAttribute("data-id");
  lp_data_box.value = JSON.stringify(dataObj[id]);
};

// ##################################################################################
//  ######################### LPグループ編集の処理 ####################################
// ##################################################################################

// グループ新規作成
const edit_group_btns = document.querySelectorAll(".js_editGroup_btn");
edit_group_btns.forEach((edit_group_btn) => {
  edit_group_btn.addEventListener("click", (e) => {
    // グループ編集フィールドの初期化
    document.querySelector(".js_edit_group").value = ""
    document.querySelector(".js_group_id").value = ""
    
    fetchAndDisplayGroupData(e)
    enableEditGroupBtn()
  });
});



// ##################################################################################
//  ######################### LP削除の処理 ####################################
// ##################################################################################// LP削除
  const deleteLP_btns = document.querySelectorAll(".js_delete_btn");

  deleteLP_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {

      document.querySelector(".js_title_delete").innerHTML = ""
    document.querySelector(".js_domain_delete").innerHTML = ""
      fetchAndDisplayLpData(e)
    });
  });


enableDragging()

// LP一覧の編集のUI処理
const edit_btn = document.querySelectorAll(".js_edit_btn");
// edit_btn.forEach((btn)=>{
//   btn.addEventListener("click", ()=>{
//     if(btn.innerHTML == "編集"){
//       disableDragging()
//     }else{
//       enableDragging()
//     }
//   })
// })
setupEditButton(edit_btn);