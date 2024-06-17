// modalの表示処理
export const showModal = (modal_class)=>{
    document.querySelector(`.${modal_class}`).classList.remove("hidden")
    document.querySelector(".bg-gray").classList.remove("hidden")
}

// modalの非表示処理
export const hideModal = ()=>{
    const bg = document.querySelector(".bg-gray")
    const all_modals = document.querySelectorAll(".js_modal")
    bg.addEventListener("click", ()=>{
        all_modals.forEach((modal)=>{
              modal.classList.add("hidden")
        })
        bg.classList.add("hidden")
  })
}

export const changeView = ()=>{
    const home_btn = document.querySelector(".js_home_btn")
    const screenshot_btn = document.querySelector(".js_screenshot_btn")
    const home_page = document.querySelector(".js_index_page")
    const screenshot_page = document.querySelector(".js_screenshot_page")

    home_btn.addEventListener("click", ()=>{
        home_page.classList.remove("hidden")
        screenshot_page.classList.add("hidden")
    })

    screenshot_btn.addEventListener("click", ()=>{
        home_page.classList.add("hidden")
        screenshot_page.classList.remove("hidden")
    })
}