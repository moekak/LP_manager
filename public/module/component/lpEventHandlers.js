import {fetchOperation2} from "@index/index.js";


// LP一覧のLP編集処理(編集ボタンをおしたらその行の各データ欄が修正できるようになる)
export function setupEditButton(editBtns) {
  editBtns.forEach((editBtn) => {
    // 各行ごとの初期値を保持するオブジェクトを作成
    let values = {
      name: "",
      domain: "",
      text: "",
    };

    editBtn.addEventListener("click", (e) => {
      let target = e.target;
      let parentElement = target.parentElement.parentElement;
      let targetFields = parentElement.querySelectorAll(".js_input_edit");
      let targetLinks = parentElement.querySelectorAll(".js_link");
      let create_btn =
      parentElement.parentElement.parentElement.parentElement.parentElement.querySelector(
          ".js_update_btn"
        );


      let value_box = parentElement.querySelector(".js_lp_data");

      value_box.value = "";

      if (editBtn.innerHTML == "編集") {
        // UI変更
  
        changeStyleWithEdit(targetLinks, targetFields, create_btn, editBtn);

        // 現在の値を保持
        values["name"] = targetFields[0].value;
        values["domain"] = targetFields[1].value;
        values["text"] = targetFields[2].value;
      
      } else {

        // UI変更
        changeStyleWithCancel(targetLinks, targetFields, editBtn, values);

        // 値を元に戻す
        targetFields[0].value = values["name"];
        targetFields[1].value = values["domain"];
        targetFields[2].value = values["text"];

        // すべてキャンセルされたらボタンの非表示
        diableCreateBtn(create_btn, parentElement);
      }
    });
  });
}

const changeStyleWithEdit = (elements1, elements2, btn, edit_btn) => {
  // // ボタンを有効にする
  // btn.classList.remove("hidden");

  // リンクスタイルの変更
  elements1.forEach((element) => {
    element.querySelector(".txt_link").parentElement.removeAttribute("href");
    element.querySelector(".txt_link").style.color = "#000";
    element.querySelector(".txt_link").style.textDecoration = "none";
  });

  // inputのスタイル変更
  elements2.forEach((element2) => {
    // ないかしら入力されたらボタンを有効にする
    element2.addEventListener("input", ()=>{
      btn.classList.remove("hidden");
    })
    element2.readOnly = false;
    element2.style.background = "#fff";
    element2.style.border = "1px solid rgba(128, 128, 128, 0.315)";
    element2.style.pointerEvents = "auto";
  });

  edit_btn.innerHTML = "取消";
};


const changeStyleWithCancel = (elements1, elements2, edit_btn, values) => {
  elements1.forEach((element1) => {
    element1.querySelector(".txt_link").style.color = "#0d6efd";
    element1.querySelector(".txt_link").style.textDecoration = "underline";
    element1.querySelector(
      ".txt_link"
    ).parentElement.href = `https://${values["domain"]}`;
  });

  elements2.forEach((element2) => {
    element2.readOnly = true;
    element2.style.background = "transparent";
    element2.style.border = "none";
    element2.style.pointerEvents = "none";
  });

  edit_btn.innerHTML = "編集";
};

export const diableCreateBtn = (btn, parentElement) => {
  const btns = parentElement.parentElement.querySelectorAll(".js_edit_btn");

  let isEditable = false;
  for (let i = 0; i < Array.from(btns).length; i++) {
    if (btns[i].innerHTML == "取消") {
      isEditable = true;
    }
  }

  if (!isEditable) {
    btn.classList.add("hidden");
  }
};


export const changeGroupIDToFiled = (element, element2) =>{
  let id = element.getAttribute("data-group-id")
  let lp_id = element2.getAttribute("data-id");
  let data = { group_id:id, lp_id:lp_id }

  fetchOperation2(data, "fetchGroupId.php")

}

