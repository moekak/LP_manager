// LP一覧のLP編集処理(編集ボタンをおしたらその行の各データ欄が修正できるようになる)
export function setupEditButton(editBtns) {
  editBtns.forEach((editBtn) => {

    let values = {
        name : "",
        domain: "",
        text: ""
    }

    editBtn.addEventListener("click", (e) => {

      let target = e.target;
      let parentElement = target.parentElement.parentElement;
      let targetFields = parentElement.querySelectorAll(".js_input_edit");
      let targetLinks = parentElement.querySelectorAll(".js_link");
      let create_btn = parentElement.parentElement.parentElement.parentElement.querySelector(".js_update_btn")

      if (editBtn.innerHTML == "編集") {
        create_btn.classList.remove("hidden")
        targetLinks.forEach((link) => {
          link.querySelector(".txt_link").parentElement.removeAttribute("href")
          link.querySelector(".txt_link").style.color = "#000";
          link.querySelector(".txt_link").style.textDecoration = "none";
        });

        targetFields.forEach((editField) => {
          editField.readOnly = false;
          editField.style.background = "#fff";
          editField.style.border = "1px solid rgba(128, 128, 128, 0.315)";
          editField.style.pointerEvents = "auto"
        });

        values["name"] = targetFields[0].value
        values["domain"] = targetFields[1].value
        values["text"] = targetFields[2].value
        editBtn.innerHTML = "取消";

      } else {

        targetFields[0].value = values["name"]
        targetFields[1].value = values["domain"]
        targetFields[2].value = values["text"]

        targetLinks.forEach((link) => {
            link.querySelector(".txt_link").style.color = "#0d6efd";
            link.querySelector(".txt_link").style.textDecoration = "underline";
            link.querySelector(".txt_link").parentElement.href = `https://${values["domain"]}`
          });
  
          targetFields.forEach((editField) => {
            editField.readOnly = true;
            editField.style.background = "transparent";
            editField.style.border = "none";
            editField.style.pointerEvents = "none"
          });

          editBtn.innerHTML = "編集";
          diableCreateBtn(create_btn, parentElement)
      }
    });
  });
}

export const diableCreateBtn = (btn, parentElement)=>{

    const btns = parentElement.parentElement.querySelectorAll(".js_edit_btn")

    let isEditable = false
     for(let i = 0; i < Array.from(btns).length; i ++){
        if(btns[i].innerHTML == "取消"){
            isEditable = true
        }
     }

     if(!isEditable){
            btn.classList.add("hidden")
     }
}

