import {
    showModal,
    hideModal,
    enableEditCategoryBtn
  } from "@index/index.js";
  
  // #####################################################################################
  // ############################### モーダル処理 #########################################
  // #####################################################################################
  {
    // カテゴリー新規作成
    const createCategory_btn = document.querySelector(".js_createCategory_btn");
    createCategory_btn.addEventListener("click", () => {
      showModal("js_createCategory_modal");
    });
  

  

  
    // モーダル非表示
    hideModal();
  }
  
 
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



const category_edit_btns = document.querySelectorAll(".js_edit_category_btn")

category_edit_btns.forEach((btn)=>{
  btn.addEventListener("click", (e)=>{
    e.preventDefault()
    
    let target = e.target
    let id = target.getAttribute("data-id")
    let name = target.getAttribute("data-name")

    const input_category = document.querySelector(".js_edit_category")
    const input_id  = document.querySelector(".js_category_id")
    
    input_category.value = name
    input_id.value = id


    console.log(input_category.value);
    showModal("js_editCategory_modal");





  })
})

enableEditCategoryBtn()




const error_code = document.querySelector(".js_error_code");
const error_msg = document.querySelector(".js_error_msg");
const errors = document.querySelectorAll(".js_error_txt");

if (error_code.value == "400_category") {
  showModal("js_editCategory_modal");
  errors.forEach((error) => {
    error.innerHTML = error_msg.value;
    error.classList.remove("hidden");
  });
}